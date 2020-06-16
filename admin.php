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
  <title>Base de datos musical!</title>
  <style type="text/css">
   th { background-color: #999;}
   .odd_row { background-color: #EEE; }
   .even_row { background-color: #FFF; }
  </style>
 </head>
 <body>
 <table style="width:100%;">
  <tr>
   <th colspan="2">Discos <a href="music.php?action=add">[ADD]</a></th>
  </tr>

<?php

$query = 'SELECT * FROM musica';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;

while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width:75%;">'; 
    echo $row['nombre'];
    echo '</td><td>';
    echo ' <a href="music.php?action=edit&id=' . $row['id'] . '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=movie&id=' . $row['id'] . '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  <tr>
    <th colspan="2">Personas <a href="people.php?action=add"> [ADD]</a></th>
  </tr>

<?php

$query = 'SELECT * FROM persona';
$result = mysqli_query($db, $query) or die (mysqli_error($db));
$odd = true;

while ($row = mysqli_fetch_assoc($result)) {
    echo ($odd == true) ? '<tr class="odd_row">' : '<tr class="even_row">';
    $odd = !$odd; 
    echo '<td style="width: 25%;">'; 
    echo $row['nombre_completo'];
    echo '</td><td>';
    echo ' <a href="people.php?action=edit&id=' . $row['id'] .
        '"> [EDIT]</a>'; 
    echo ' <a href="delete.php?type=people&id=' . $row['id'] .
        '"> [DELETE]</a>';
    echo '</td></tr>';
}
?>
  </table>
 </body>
</html>
