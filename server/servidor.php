<?php
include 'jugador_class.php';
include 'accion_class.php';
include 'BD_class.php';
include 'filtro.php';
include 'utilsServidor.php';
include 'partidos.php';
include 'login.php';
$base = new conexion("localhost", "root", "", "statisticssports", 3306, "");
if (isset($_REQUEST['array'])) {
    $array = json_decode($_REQUEST['array']);
    $accion = new accion($array);
    $ideq = $accion->getEquipo();
    $idjug = $accion->getJugador();
    $campo = $accion->campo();
    $porcentaje = $accion->convertir();
    $jugador = new jugador($idjug, $ideq, "", $base);
    $jugador->actualizaraccion($campo, $porcentaje, $idjug, $base, $ideq);
}
if (isset($_REQUEST['filtro'])) {
    if ($_REQUEST['filtro'] == "SF") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SM") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SF2") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SM2") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "TODO") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    }
    }   
    if (isset($_REQUEST['puntosMas'])) {
        $arrayP = json_decode($_REQUEST['puntosMas']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarPuntos($arrayP[1],$arrayP[2],$base,1);
        echo "PUNTOS ACTUALIZADOS";
    }
    if (isset($_REQUEST['puntosMenos'])) {
        $arrayP = json_decode($_REQUEST['puntosMenos']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarPuntos($arrayP[1],$arrayP[2],$base,-1);
        echo "PUNTOS ACTUALIZADOS";
    }
    if (isset($_REQUEST['setMas'])) {
        $arrayP = json_decode($_REQUEST['setMas']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarSet($arrayP[1],$base);
        echo "SET ACTUALIZADOS";
    }
    if (isset($_REQUEST['login'])) {
        $arrayL = json_decode($_REQUEST['login']);
        $login = new login($arrayL[0],$arrayL[1],$base);
    }
?>