<?php 
    /**
     * Esta función toma como parámetros $filtrobusqueda y $base
     * @param filtrobusqueda es el filtro
     * @param base es la base de datos
     * Utiliza la clase filtro, la función datosBusqueda y getJugador.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedas($filtrobusqueda,$base){
        $busqueda = new filtro($filtrobusqueda,$base);
        $array1 = $busqueda->datosBusqueda();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new jugador($array2[0],$array2[1],$array2[2],2,1,$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }

    /**
     * Esta función toma como parámetros $filtrobusqueda, $filtroequipo y $base
     * @param filtrobusqueda es el filtro
     * @param filtroequipo es el id equipo
     * @param base es la base de datos
     * Utiliza la clase filtroIndex, la función datosBusqueda y getJugador.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedasEQ($filtrobusqueda,$filtroequipo,$base){
        $busqueda = new filtroIndex($filtrobusqueda,$filtroequipo,$base);
        $array1 = $busqueda->datosBusqueda();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new jugador($array2[0],$array2[1],$array2[2],2,1,$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }

    /**
     * Esta función toma como parámetros $filtrobusqueda, $filtroequipo y $base
     * @param filtrobusqueda es el filtro
     * @param filtroequipo es el id equipo
     * @param base es la base de datos
     * Utiliza la clase filtroequipopartidos, la función datosBusqueda y getPartido.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedasEQdos($filtrobusqueda,$filtroequipo,$base){
        $busqueda = new filtroequipopartidos($filtrobusqueda,$filtroequipo,$base);
        $array1 = $busqueda->datosBusqueda();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $partido= new partidos($array2[0],$base);
            $arrayPartido = $partido->getPartido();
            $resultado[$i]=$arrayPartido;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;

    }

    /**
     * Esta función toma como parámetros $filtrobusqueda, $filtroequipo filtroPuesto y $base
     * @param filtrobusqueda es el filtro
     * @param filtroequipo es el id equipo
     * @param filtroPuesto es el puesto del jugador
     * @param base es la base de datos
     * Utiliza la clase filtroIndex2, la función datosBusqueda y getJugador.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedasPUESTO($filtrobusqueda,$filtroequipo,$filtroPuesto,$base){
        $busqueda = new filtroIndex2($filtrobusqueda,$filtroequipo,$filtroPuesto,$base);
        $array1 = $busqueda->datosBusqueda();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new jugador($array2[0],$array2[1],$array2[2],2,1,$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }

    /**
     * Esta función toma como parámetros $filtrobusqueda y $base
     * @param filtrobusqueda es el filtro
     * @param base es la base de datos
     * Utiliza la clase filtropartido, la función datosPartido y getPartido.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function datosPartido($filtrobusqueda,$base){
        $busqueda = new filtropartido($filtrobusqueda,$base);
        $array1 = $busqueda->datosPartido();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $partido= new partidos($array2[0],$base);
            $arrayPartido = $partido->getPartido();
            $resultado[$i]=$arrayPartido;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }
    
    /**
     * Esta función toma como parámetros $ideq,$partido,$sets y $base
     * @param ideq es el id del equipo
     * @param partido es el numero de partido
     * @param sets es el set
     * @param base es la base de datos
     * Utiliza la clase filtroresumen, la función datosResumen
     * la clase estadisticaresumen y la función getJugadorSinEquipo.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedasResumen($ideq,$partido,$sets,$base){
        $busqueda = new filtroresumen($ideq,$partido,$base);
        $array1 = $busqueda->datosResumen();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new estadisticaresumen($array2[0],$ideq,'equipo',$partido,$sets,$base);
            $arrayJugador = $jugador->getJugadorSinEquipo();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }
    
     /**
     * Esta función toma como parámetros $eq,$ligaA y $base
     * @param eq es el nombre del equipo
     * @param ligaA es la liga
     * @param base es la base de datos
     * Utiliza la clase filtroequipo y la función getidequipo
     * Devuelve el id del equipo
     * @return ideq
     */
    function buscaridequipo($eq,$ligaA,$base){
        $busqueda = new filtroequipo($eq,$ligaA,$base);
        $ideq = $busqueda->getidequipo();
        return $ideq;
    }

    /**
     * Esta función toma como parámetros $eq1,$ligaA,$eq2,$opcion y $base
     * @param eq1 es el equipo 1
     * @param ligaA es la liga
     * @param eq2 es el equipo 2
     * @param opcion es una variable para diferenciar equipo 1 del 2
     * @param base es la base de datos
     * Utiliza la función buscaridequipo, la clase filtroresumen, 
     * la función datosResumen, la clase estadisticaresumenpartido
     * y la función getJugador.
     * Devuelve el resultado codificado en json.
     * @return resultadoJson
     */
    function busquedasResumenB($eq1,$ligaA,$eq2,$opcion,$base){
        $ideq = (int)buscaridequipo($eq1,$ligaA,$base);
        if($opcion=='a'){
            $idpartido = (int)buscaridpartido($eq1,$eq2,$ligaA,$base);
        }else if($opcion=='b'){
            $idpartido = (int)buscaridpartido($eq2,$eq1,$ligaA,$base);
        }
        $busqueda = new filtroresumen($ideq,$idpartido,$base);
        $array1 = $busqueda->datosResumen();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new estadisticaresumenpartido($array2[0],$ideq,$eq1,$idpartido,$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
        return $resultado;
    }

    /**
     * Esta función toma como parámetros $eq1,$eq2,$ligaA y $base
     * @param eq1 es el equipo 1
     * @param eq2 es el equipo 2
     * @param ligaA es la liga
     * @param base es la base de datos
     * Utiliza la clase filtroidpartido y la función getidpartido
     * Devuelve el id del partido
     * @return idpartido
     */
    function buscaridpartido($eq1,$eq2,$ligaA,$base){
        $busqueda = new filtroidpartido($eq1,$eq2,$ligaA,$base);
        $idpartido = $busqueda->getidpartido();
        return $idpartido;
    }
?>