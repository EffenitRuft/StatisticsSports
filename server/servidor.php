<?php 
    include 'jugador_class.php';
    include 'accion_class.php';
    include 'BD_class.php';
    $base = new conexion("localhost","root","","servidor",3306,"");
    if($_REQUEST['array']!=null){
        $array = json_decode($_REQUEST['array']);
        $accion = new accion($array);
        $id= $accion->getJugador();
        $campo= $accion->campo();
        $porcentaje= $accion->convertir();
        $jugador= new jugador($array[0],$base);
        $jugador->actualizaraccion($campo,$porcentaje,$id,$base);
    }
?>