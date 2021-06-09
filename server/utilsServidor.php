<?php 
   


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

    //***************************bea************************* */
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
    
    function buscaridequipo($eq,$ligaA,$base){
        $busqueda = new filtroequipo($eq,$ligaA,$base);
        $ideq = $busqueda->getidequipo();
        return $ideq;
    }

    function busquedasResumenB($eq,$ligaA,$partido,$sets,$base){
        $ideq = (int)buscaridequipo($eq,$ligaA,$base);
        $busqueda = new filtroresumen($ideq,$partido,$base);
        $array1 = $busqueda->datosResumen();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new estadisticaresumen($array2[0],$ideq,$eq,$partido,$sets,$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }
?>