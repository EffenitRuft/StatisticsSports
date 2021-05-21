<?php
include 'jugador_class.php';
include 'accion_class.php';
include 'BD_class.php';
include 'filtro.php';
include 'utilsServidor.php';
include 'partidos.php';
include 'login.php';
include 'filtropartido.php';
include 'filtroresumen.php';
include 'estadisticaresumen.php';
include 'jugadornuevo.php';
include 'filtroequipo.php';
//HACER EL INCLUDE 
include 'clasificacion.php';


$base = new conexion("localhost", "root", "", "statisticssports", 3306, "");
if (isset($_REQUEST['array'])) {
    $array = json_decode($_REQUEST['array']);
    $accion = new accion($array);
    $ideq = $accion->getEquipo();
    $idjug = $accion->getJugador();
    $campo = $accion->campo();
    $porcentaje = $accion->convertir();
    //partido y set
    $jugador = new jugador($idjug, $ideq, "",$array[4],$array[5], $base);
    $jugador->actualizaraccion($campo, $porcentaje, $idjug, $base, $ideq,$array[4],$array[5]);
}
if (isset($_REQUEST['filtro'])) {
    if ($_REQUEST['filtro'] == "SF") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        //echo $filtroBusqueda;
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SM") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        //echo $filtroBusqueda;
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SF2") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        //echo $filtroBusqueda;
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "SM2") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        //echo $filtroBusqueda;
        echo $resultado;
    } else if ($_REQUEST['filtro'] == "todo") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        //echo $filtroBusqueda;
        echo $resultado;
    }
    }  
    //NUEVO
    if (isset($_REQUEST['filtropartidos'])) {
            $filtroBusqueda = $_REQUEST['filtropartidos'];
            $resultado = datosPartido($filtroBusqueda, $base);
            echo $resultado;
        } 
        /*////////////////////////////NUEVO MARTA//////////////////////*/
        if (isset($_REQUEST['filtropartidoestadistica'])) {
            $filtroBusqueda = json_decode($_REQUEST['filtropartidoestadistica']);
            $resultado = busquedasResumenB($filtroBusqueda[0],$filtroBusqueda[1],$filtroBusqueda[2],$filtroBusqueda[3], $base);
            echo $resultado;
        } 
        if (isset($_REQUEST['filtrodirecto1'])) {
            $filtroBusqueda = json_decode($_REQUEST['filtrodirecto1']);
            $resultado = busquedasResumen($filtroBusqueda[0],$filtroBusqueda[1],$filtroBusqueda[2], $base);
            echo $resultado;
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
        echo "SETS ACTUALIZADOS";
    }
    if (isset($_REQUEST['login'])) {
        $arrayL = json_decode($_REQUEST['login']);
        $login = new login($arrayL[0],$arrayL[1],$base);
    }
    if (isset($_REQUEST['addJugador'])) {
        $arrayJ = json_decode($_REQUEST['addJugador']);
        $idjug = $arrayJ[0];
        $ideq = $arrayJ[1];
        $idpartido = $arrayJ[2];
        $idset = $arrayJ[3];
        $jugador = new jugadornuevo($idjug,$ideq,$idpartido,$idset,$base);
        echo 'OK';
    }



    /**
     * LO DE LA CLASIFICIACION
     */
    if (isset($_REQUEST['clasificacion'])) {
       // $liga = $_REQUEST['clasificacion'];
       $liga = $_REQUEST['clasificacion'];
        $accion = new clasificacion($liga, $base);
        $array1 = $accion->datosBusqueda();
        $resultadoJson = json_encode($array1);
        echo $resultadoJson;
    }
