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
include 'clasificacion.php';
include 'partidonuevo.php';
include 'puntosclasif.php';
include 'filtrarenindex.php';
include 'filtrarenindex2.php';
include 'filtrarequiposliga.php';
include 'filtroequipopartidos.php';


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
if ((isset($_REQUEST['filtro'])) && !(isset($_REQUEST['filtroEquipo'])) && !(isset($_REQUEST['filtroEquipopartido'])) && !(isset($_REQUEST['filtroPuesto']))){
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
    if (isset($_REQUEST['filtropartidos']) && !(isset($_REQUEST['filtroEquipopartido']))) {
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
        $arrayP = json_decode($_REQUEST['addJugador']);
        $idjug = $arrayP[0];
        $ideq = $arrayP[1];
        $idpartido = $arrayP[2];
        $idset = $arrayP[3];
        $jugador = new jugadornuevo($idjug,$ideq,$idpartido,$idset,$base);
        echo 'OK';
    }
    if (isset($_REQUEST['addPartido'])) {
        $arrayP = json_decode($_REQUEST['addPartido']);
        $ideq1 = $arrayP[0];
        $ideq2 = $arrayP[1];
        $idpartido = $arrayP[2];
        $liga = $arrayP[3];
        $partido = new partidonuevo($ideq1,$ideq2,$idpartido,$liga,$base);
        echo 'OK';
    }

    //***************************ULTIMA PARTE MARTA*****************************************************************
    if (isset($_REQUEST['finPartido'])) {
        $arrayfp = json_decode($_REQUEST['finPartido']);
        $actualizar = new puntosclasif($arrayfp[0],$base,$arrayfp[1],$arrayfp[2]);
        echo "CLASIFICACION ACTUALIZADA";
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





    //**NUEVO BEA FILTRAR EQUIPO INDEX******************************* */
    if ((isset($_REQUEST['filtroEquipo'])) && !(isset($_REQUEST['filtroPuesto']))){
        
            $filtroBusqueda = $_REQUEST['filtro'];
            $filtroEquipo = $_REQUEST['filtroEquipo'];
            $resultado = busquedasEQ($filtroBusqueda,$filtroEquipo, $base);
            echo $resultado;
    }
    //**NUEVO BEA FILTRAR EQUIPO INDEX******************************* */
     if (isset($_REQUEST['filtroPuesto'])){
        
        $filtroBusqueda = $_REQUEST['filtro'];
        $filtroEquipo = $_REQUEST['filtroEquipo'];
        $filtroPuesto = $_REQUEST['filtroPuesto'];
        $resultado = busquedasPUESTO($filtroBusqueda,$filtroEquipo,$filtroPuesto, $base);
        echo $resultado;
    } 


    if (isset($_REQUEST['equipoLiga']) && !(isset($_REQUEST['filtroEquipopartido']))) {
        $liga = $_REQUEST['equipoLiga'];
        $accion = new filtrarequiposliga($liga, $base);
        $arrayliga = $accion->datosBusqueda();
        $resultadoJson = json_encode($arrayliga);
        echo $resultadoJson;
    }


    if (isset($_REQUEST['filtroEquipopartido'])){
        $filtroBusqueda = $_REQUEST['filtro'];
        $filtroEquipo = $_REQUEST['filtroEquipopartido'];
        $resultado = busquedasEQdos($filtroBusqueda,$filtroEquipo, $base);
        echo $resultado; 
        
    }       

?>