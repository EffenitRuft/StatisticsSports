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
        $busqueda = new filtroresumen($ideq,$base);
        $array1 = $busqueda->datosResumen();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $resumen= new estadisticaresumen($array2[0],$ideq,$partido,$sets,$base);
            $arrayResumen = $resumen->getResumen();
            $resultado[$i]=$arrayResumen;
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
        $busqueda = new filtroresumen($ideq,$base);
        $array1 = $busqueda->datosResumen();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $resumen= new estadisticaresumen($array2[0],$ideq,$partido,$sets,$base);
            $arrayResumen = $resumen->getResumen();
            $resultado[$i]=$arrayResumen;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }
?>