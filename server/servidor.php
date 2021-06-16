<?php
/**Este documento sirve para comprobar que valores llegan en las peticiones
y según los valores recibidos realiza unas funciones u otras.
 */
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
include 'estadisticaresumenpartido.php';
include 'jugadornuevo.php';
include 'filtroequipo.php';
include 'clasificacion.php';
include 'partidonuevo.php';
include 'puntosclasif.php';
include 'filtrarenindex.php';
include 'filtrarenindex2.php';
include 'filtrarequiposliga.php';
include 'filtroequipopartidos.php';
include 'filtroidpartido.php';

/**
 * Creamos la conexión a base de datos
 * @param base
 */
$base = new conexion("localhost", "root", "", "statisticssports", 3306, "");

/**
 * Si el valor enviado es array, se crea una nueva acción y tras
 * utilizar los métodos de esta clase se crea un jugador 
 * y se actualiza la acción.
 * @param array
 */
if (isset($_REQUEST['array'])) {
    $array = json_decode($_REQUEST['array']);
    $accion = new accion($array);
    $ideq = $accion->getEquipo();
    $idjug = $accion->getJugador();
    $campo = $accion->campo();
    $porcentaje = $accion->convertir();
    $jugador = new jugador($idjug, $ideq, "",$array[4],$array[5], $base);
    $jugador->actualizaraccion($campo, $porcentaje, $idjug, $base, $ideq,$array[4],$array[5]);
}

/**
 * Si el valor enviado es filtro y no ha sido enviado ni filtroEquipo ni filtroEquipopartido ni filtroPuesto
 * se utiliza la función busquedas y finalmente se devuelve el resultado.
 * @param filtro
 * @return resultado
 */
if ((isset($_REQUEST['filtro'])) && !(isset($_REQUEST['filtroEquipo'])) && !(isset($_REQUEST['filtroEquipopartido'])) && !(isset($_REQUEST['filtroPuesto']))){
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
    } else if ($_REQUEST['filtro'] == "todo") {
        $filtroBusqueda = $_REQUEST['filtro'];
        $resultado = busquedas($filtroBusqueda, $base);
        echo $resultado;
    }
    }  
   
    /**
     * Si el valor enviado es filtropartidos y no ha sido enviado filtroEquipopartido
     * se utiliza la función datosPartido y se devuelve el resultado.
     * @param filtropartidos
     * @return resultado
     */
    if (isset($_REQUEST['filtropartidos']) && !(isset($_REQUEST['filtroEquipopartido']))) {
            $filtroBusqueda = $_REQUEST['filtropartidos'];
            $resultado = datosPartido($filtroBusqueda, $base);
            echo $resultado;
        } 
        
        /**
         * Si el valor enviado es filtropartidoestadística se utiliza la función
         * busquedasResumenB y se devuelve el resultado.
         * @param filtropartidoestadistica
         * @return resultado
         */
        if (isset($_REQUEST['filtropartidoestadistica'])) {
            $filtroBusqueda = json_decode($_REQUEST['filtropartidoestadistica']);
            $resultado = busquedasResumenB($filtroBusqueda[0],$filtroBusqueda[1],$filtroBusqueda[2],$filtroBusqueda[3], $base);
            echo $resultado;
        } 

        /**
         * Si el valor enviado es filtrodirecto1 se utiliza la función
         * busquedasResumen y se devuelve el resultado.
         * @param filtrodirecto1
         * @return resultado
         */
        if (isset($_REQUEST['filtrodirecto1'])) {
            $filtroBusqueda = json_decode($_REQUEST['filtrodirecto1']);
            $resultado = busquedasResumen($filtroBusqueda[0],$filtroBusqueda[1],$filtroBusqueda[2], $base);
            echo $resultado;
        }

        /**
         * Si el valor enviado es puntosMas se utiliza la clase
         * partidos, se utiliza la función sumarPuntos y se devuelve ""PUNTOS ACTUALIZADOS"".
         * @param puntosMas
         * @return "PUNTOS ACTUALIZADOS"
         */
    if (isset($_REQUEST['puntosMas'])) {
        $arrayP = json_decode($_REQUEST['puntosMas']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarPuntos($arrayP[1],$arrayP[2],$base,1);
        echo "PUNTOS ACTUALIZADOS";
    }

    /**
     * Si el valor enviado es puntosMenos se utiliza la clase partidos,
     * posteriormente la función sumarPuntos y se devuelve "PUNTOS ACTUALIZADOS"
     * @param puntosMenos
     * @return "PUNTOS ACTUALIZADOS"
     */
    if (isset($_REQUEST['puntosMenos'])) {
        $arrayP = json_decode($_REQUEST['puntosMenos']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarPuntos($arrayP[1],$arrayP[2],$base,-1);
        echo "PUNTOS ACTUALIZADOS";
    }

    /**
     * Si el valor enviado es setMas se utiliza la clase partidos,
     * posteriormente la función sumarSet y se devuelve "SETS ACTUALIZADOS"
     * @param setMas
     * @return "SETS ACTUALIZADOS"
     */
    if (isset($_REQUEST['setMas'])) {
        $arrayP = json_decode($_REQUEST['setMas']);
        $partido = new partidos($arrayP[0],$base);
        $partido->sumarSet($arrayP[1],$base);
        echo "SETS ACTUALIZADOS";
    }

    /**
     * Si el valor enviado es login se utiliza la clase login.
     * @param login
     */
    if (isset($_REQUEST['login'])) {
        $arrayL = json_decode($_REQUEST['login']);
        $login = new login($arrayL[0],$arrayL[1],$base);
    }

    /**
     * Si el valor enviado es addJugador se utiliza la clase jugadornuevo
     * y devuelve OK.
     * @param addJugador
     * @return "OK"
     */
    if (isset($_REQUEST['addJugador'])) {
        $arrayP = json_decode($_REQUEST['addJugador']);
        $idjug = $arrayP[0];
        $ideq = $arrayP[1];
        $idpartido = $arrayP[2];
        $idset = $arrayP[3];
        $jugador = new jugadornuevo($idjug,$ideq,$idpartido,$idset,$base);
        echo 'OK';
    }

    /**
     * Si el valor enviado es addPartido se utiliza la clase partidonuevo
     * y devuelve OK.
     * @param addPartido
     * @return OK
     */
    if (isset($_REQUEST['addPartido'])) {
        $arrayP = json_decode($_REQUEST['addPartido']);
        $ideq1 = $arrayP[0];
        $ideq2 = $arrayP[1];
        $idpartido = $arrayP[2];
        $liga = $arrayP[3];
        $partido = new partidonuevo($ideq1,$ideq2,$idpartido,$liga,$base);
        echo 'OK';
    }

    /**
     * Si el valor enviado es finPartido se utiliza la clase puntosclasif
     * y devuelve "CLASIFICACION ACTUALIZADA"
     * @param finPartido
     * @return "CLASIFICACION ACTUALIZADA"
     */
    if (isset($_REQUEST['finPartido'])) {
        $arrayfp = json_decode($_REQUEST['finPartido']);
        $actualizar = new puntosclasif($arrayfp[0],$base,$arrayfp[1],$arrayfp[2]);
        echo "CLASIFICACION ACTUALIZADA";
    }

    /**
     * Si el valor enviado es clasificacion se utiliza la clase clasificacion,
     * posteriormente la función datosBusqueda y devuelve el resultado codificado
     * en json.
     * @param clasificacion
     * @return resultadoJson
     */
    if (isset($_REQUEST['clasificacion'])) {
       $liga = $_REQUEST['clasificacion'];
        $accion = new clasificacion($liga, $base);
        $array1 = $accion->datosBusqueda();
        $resultadoJson = json_encode($array1);
        echo $resultadoJson;
    }

    /**
     * Si el valor enviado es filtroEquipo y no ha sido enviado filtroPuesto
     * se utiliza la función busquedasEQ y se devuelve el resultado.
     * @param filtroEquipo
     * @return resultado
     */
    if ((isset($_REQUEST['filtroEquipo'])) && !(isset($_REQUEST['filtroPuesto']))){
        
            $filtroBusqueda = $_REQUEST['filtro'];
            $filtroEquipo = $_REQUEST['filtroEquipo'];
            $resultado = busquedasEQ($filtroBusqueda,$filtroEquipo, $base);
            echo $resultado;
    }
    
    /**
     * Si el valor enviado es filtroPuesto se utiliza la función busquedasPuesto
     * y se devuelve el resultado.
     * @param filtroPuesto
     * @return resultado
     */
    if (isset($_REQUEST['filtroPuesto'])){
        
        $filtroBusqueda = $_REQUEST['filtro'];
        $filtroEquipo = $_REQUEST['filtroEquipo'];
        $filtroPuesto = $_REQUEST['filtroPuesto'];
        $resultado = busquedasPUESTO($filtroBusqueda,$filtroEquipo,$filtroPuesto, $base);
        echo $resultado;
    } 

    /**
     * Si el valor enviado es equipoLiga y no ha sido enviado filtroEquipopartido
     * se utiliza la clase filtrarequiposliga, la función datosBusqueda y se 
     * devuelve el resultado codificado en json
     * @param equipoLiga
     * @return resultadoJson
     */
    if (isset($_REQUEST['equipoLiga']) && !(isset($_REQUEST['filtroEquipopartido']))) {
        $liga = $_REQUEST['equipoLiga'];
        $accion = new filtrarequiposliga($liga, $base);
        $arrayliga = $accion->datosBusqueda();
        $resultadoJson = json_encode($arrayliga);
        echo $resultadoJson;
    }

    /**
     * Si el valor enviado es filtroEquipopartido se utiliza
     * la función busquedasEQdos y se devuelve el resultado
     * @param filtroEquipopartido
     * @return resultado
     */
    if (isset($_REQUEST['filtroEquipopartido'])){
        $filtroBusqueda = $_REQUEST['filtro'];
        $filtroEquipo = $_REQUEST['filtroEquipopartido'];
        $resultado = busquedasEQdos($filtroBusqueda,$filtroEquipo, $base);
        echo $resultado; 
        
    }       

?>