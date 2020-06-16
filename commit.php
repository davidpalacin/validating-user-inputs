<?php
// Datos para conectar a la base de datos.
$servername = "localhost";
$database = "admin";
$username = "root";
$password = "root";

// Create connection
$db = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
echo 'Se ha conectado a la bd'; 
echo '<br>';
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
$email = $_POST['email'];
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'INSERT INTO
            musica
                (nombre, fecha, genero, artista,
                productor)
            VALUES
                ("' . $_POST['nombre'] . '",
                 ' . $_POST['fecha'] . ',
                 ' . $_POST['genero'] . ',
                 ' . $_POST['artista'] . ',
                 ' . $_POST['productor'] . ')';
        break;
    case 'people':
        $error = array();
        $nombre_completo = isset($_POST['nombre_completo']) ?
            trim($_POST['nombre_completo']) : '';
        if (empty($nombre_completo)) {
            $error[] = urlencode('Please enter a person name.');
        }
        $productor = isset($_POST['productor']) ? 
            trim($_POST['productor']) : '';
        if (!is_numeric($productor)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        $pais = isset($_POST['pais']) ? 
            trim($_POST['pais']) : '';
        if (!is_numeric($pais)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        if (empty($_POST["email"])) {
        $error[] = "El email es requerido <br>";
        } else {
        $email = $_POST['email'];
        // Formato de email expresion regular
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $error[] = "Formato de email incorrecto";
        }
        }
        if (empty($error)) {
        $query = 'INSERT INTO
            persona
                (nombre_completo, productor, pais)
            VALUES
                ("' . $_POST['nombre_completo'] . '",
                 ' . $_POST['productor'] . ',
                 ' . $_POST['pais'] . ')';
         } else {
          header('Location:people.php?action=add' .
              '&error=' . join($error, urlencode('<br/>')));
        }
        break;
    }
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'UPDATE musica SET
                nombre = "' . $_POST['nombre'] . '",
                fecha = ' . $_POST['fecha'] . ',
                genero = ' . $_POST['genero'] . ',
                artista = ' . $_POST['artista'] . ',
                productor = ' . $_POST['productor'] . '
            WHERE
                id = '.$_POST['id'];
        break;
    case 'people':
        $error = array();
        $nombre_completo = isset($_POST['nombre_completo']) ?
            trim($_POST['nombre_completo']) : '';
        if (empty($nombre_completo)) {
            $error[] = urlencode('Please enter a person name.');
        }
        $productor = isset($_POST['productor']) ? 
            trim($_POST['productor']) : '';
        if (!is_numeric($productor)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        $pais = isset($_POST['pais']) ? 
            trim($_POST['pais']) : '';
        if (!is_numeric($pais)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        if (empty($_POST["email"])) {
        $error[] = "El email es requerido <br>";
        } else {
        $email = $_POST['email'];
        // Queremos que el email tenga un formato adecuado
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $error[] = "Formato de email incorrecto";
        }
        }
        if (empty($error)) {
    $query = 'UPDATE persona SET
            nombre_completo = "' . $_POST['nombre_completo'] . '",
            productor = ' . $_POST['productor'] . ',
            pais = ' . $_POST['pais'] . '
        WHERE
            id ='.$_POST['id'];
        } else {
          header('Location:people.php?action=edit&id=' . $_POST['id'] .
              '&error=' . join($error, urlencode('<br/>')));
        }
        break;
    }
    break;
}
if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <p>Done!</p>
 </body>
</html>
