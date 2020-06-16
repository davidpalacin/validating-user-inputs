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
            nombre_completo, pais, productor
        FROM
            persona
        WHERE
            id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {

    $nombre_completo = '';
    $pais = 0;
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
  echo '<div id="error" style="background-color:black;color:white;text-align:center;padding:5px;">' . $_GET['error'] . '</div>';
  }
  ?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>Artista: </td>
     <td><input type="text" name="nombre_completo"
      value="<?php echo $nombre_completo; ?>"/></td>
    </tr><tr>
     <td>Pais: </td>
     <td><input type="text" name="pais"
      value="<?php echo $pais; ?>"/></td>
    </tr>
    <tr>
     <td>Email: </td>
     <td><input type="text" name="email"/></td>
    </tr>
    <tr>
     <td>Productor: </td>
     <td><input type="text" name="productor"
      value="<?php echo $productor; ?>"/></td>
    </tr>

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
