<?php 
    
    function busquedas($filtrobusqueda,$base){
        $busqueda = new filtro($filtrobusqueda,$base);
        $array1 = $busqueda->datosBusqueda();
        $resultado;
        for ($i=0; $i < count($array1); $i++) { 
            $array2=$array1[$i];
            $jugador= new jugador($array2[0],$array2[1],$array2[2],$base);
            $arrayJugador = $jugador->getJugador();
            $resultado[$i]=$arrayJugador;
        }
        $resultadoJson = json_encode($resultado);
        return $resultadoJson;
    }
?>