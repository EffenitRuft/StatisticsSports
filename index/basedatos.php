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
    $jugadores = array();
    $equipo = intval($_REQUEST['equip']);
    $que = mysqli_query($con,"SELECT idjugadorBase,nombre FROM jugadorbase WHERE id_equipo = '$equipo'");
    while ($f = mysqli_fetch_assoc($que)) {
        $jugadores[] = $f;
    }
    print json_encode($jugadores);
    $con->close();
}
if (isset($_REQUEST["array"])){
    $array = $_REQUEST["array"];
    echo $array;
}
?>