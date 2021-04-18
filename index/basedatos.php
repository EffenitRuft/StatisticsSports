<?php
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="statisticssports";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

if (isset($_REQUEST['bt'])) {
    $p = $_REQUEST['p'];
    $que = mysqli_query($con,"SELECT * FROM jugador WHERE nombre = '$p' and id_equipo = '2'");
    while ($f = mysqli_fetch_assoc($que)) {
        echo $f["id_jugador"].",".$f["nombre"].",".$f["id_equipo"].",".$f["puesto"];
    }
    $con->close();
}
if (isset($_REQUEST["array"])){
    $array = $_REQUEST["array"];
    echo $array;
}
?>