<?php
/**
 * Este archivo sirve principalmente para la busqueda rapida de datos de 
    equipos,jugadores y ligas.
 */

// Conexion a la base de datos
$host="127.0.0.1";
$port=3306;
$socket="";
$user="root";
$password="";
$dbname="statisticssports";

$con = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

/**
 * Si el valor enviado es bt lo que hace es buscar el equipo
 * y devolver un array de jugadores.
 * @param bt
 */
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

/**
 * Si el valor enviado es array devuelve array como valor.
 * @param array
 */
if (isset($_REQUEST["array"])){
    $array = $_REQUEST["array"];
    echo $array;
}

/**
 * Si el valor enviado es buscarPartido este lo que hace es buscar el partido
 * en la base de datos y devolver los equipos.
 * @param buscarPartido
 */
if(isset($_REQUEST["buscarPartido"])){
    $idequipo = intval($_REQUEST['buscarPartido']);
    $que = mysqli_query($con, "SELECT nombre_equipo FROM equipo WHERE id_equipo = '$idequipo'");
    while ($f = mysqli_fetch_assoc($que)) {
        echo $f["nombre_equipo"];
    }
    $con->close();
}

/**
 * Si el valor enviado es equipoLiga aplica un filtro que dependiendo
 * de que liga sea devuelve el id del equipo y su nombre.
 * @param equipoLiga
 */
if(isset($_REQUEST["equipoLiga"])){
    $liga = $_REQUEST["equipoLiga"];
    if ($liga == "SM") {
        // MASCULINO SUPERLIGA 1
        $que = mysqli_query($con, "SELECT id_equipo, nombre_equipo FROM equipo WHERE genero = 'masculino' and liga = 'superliga1'");
        while ($f = mysqli_fetch_assoc($que)) {
            echo $f["id_equipo"]." - ". $f["nombre_equipo"].":" ;
        }
        $con->close();
    }else if($liga == "SF"){
        // FEMENINO SUPERLIGA 1
        $que = mysqli_query($con, "SELECT id_equipo, nombre_equipo FROM equipo WHERE genero = 'femenino' and liga = 'superliga1'");
        while ($f = mysqli_fetch_assoc($que)) {
            echo $f["id_equipo"]."-". $f["nombre_equipo"].":" ;
        }
        $con->close();
    }else if ($liga == "SM2"){
        // MASCULINO SUPERLIGA 2
        $que = mysqli_query($con, "SELECT id_equipo, nombre_equipo FROM equipo WHERE genero = 'masculino' and liga = 'superliga2'");
        while ($f = mysqli_fetch_assoc($que)) {
            echo $f["id_equipo"]."-". $f["nombre_equipo"].":" ;
        }
        $con->close();
    }else if ($liga == "SF2"){
        // FEMENINO SUPERLIGA 2
        $que = mysqli_query($con, "SELECT id_equipo, nombre_equipo FROM equipo WHERE genero = 'femenino' and liga = 'superliga2'");
        while ($f = mysqli_fetch_assoc($que)) {
            echo $f["id_equipo"]."-". $f["nombre_equipo"].":" ;
        }
        $con->close();
    }

}
