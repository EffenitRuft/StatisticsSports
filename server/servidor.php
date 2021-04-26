<?php
include 'jugador_class.php';
include 'accion_class.php';
include 'BD_class.php';
include 'filtro.php';
include 'utilsServidor.php';
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
