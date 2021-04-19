<?php 
    include 'jugador_class.php';
    include 'accion_class.php';
    include 'BD_class.php';
    $base = new conexion("localhost","root","","statisticssports",3306,"");
    if($_REQUEST['array']!=null){
        $array = json_decode($_REQUEST['array']);
        $accion = new accion($array);
        $ideq= $accion->getEquipo();
        $idjug= $accion->getJugador();
        $campo= $accion->campo();
        $porcentaje= $accion->convertir();
        $jugador= new jugador($idjug,$ideq,$base);
        $jugador->actualizaraccion($campo,$porcentaje,$idjug,$base,$ideq);
    }
