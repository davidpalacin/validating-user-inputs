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

if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            nombre, fecha, genero, artista, productor
        FROM
            musica
        WHERE
            id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $nombre = '';
    $genero = 0;
    $fecha = date('Y');
    $artista = 0;
    $productor = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Musica</title>
 </head>
 <body>
    <?php
    if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
    }
    ?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=movie"
   method="post">
   <table>
    <tr>
     <td>Nombre: </td>
     <td><input type="text" name="nombre"
      value="<?php echo $nombre; ?>"/></td>
    </tr><tr>
     <td>Genero: </td>
     <td><select name="genero">
<?php

$query = 'SELECT id, genero FROM genero ORDER BY genero';

$result = mysqli_query($db, $query) or die(mysqli_error($db));

while ($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $value) {
        if ($row['id'] == $movie_type) {
            echo '<option value="' . $row['id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['id'] . '">';
        }
        echo $row['genero'] . '</option>';
    }
}
?>
      </select></td>
    </tr><tr>
     <td>Fecha: </td>
     <td><select name="fecha">
<?php
// populate the select options with years
for ($yr = date("Y"); $yr >= 1970; $yr--) {
    if ($yr == $fecha) {
        echo '<option value="' . $yr . '" selected="selected">' . $yr .
            '</option>';
    } else {
        echo '<option value="' . $yr . '">' . $yr . '</option>';
    }
}
?>
      </select></td>
    </tr>
    <tr>
     <td>Cantante: </td>
     <td><input type="text" name="artista"
      value="<?php echo $artista; ?>"/></td>
    </tr>
    <tr>
     <td>Productor: </td>
     <td><input type="text" name="productor"
      value="<?php echo $productor; ?>"/></td>
    </tr>

    <tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
