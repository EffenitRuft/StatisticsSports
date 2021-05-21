<?php
    class jugadornuevo{       
        private $id_jugador;
        private $nombre_jug;
        private $nombreEquipo;
        private $id_equipo;
        private $puesto;
        private $numcolocaciones;
        private $mediacolocaciones;
        private $numrecibir;
        private $mediarecibir;
        private $numerodefender;
        private $mediadefender;
        private $numeroataque;
        private $mediataque;
        private $numerobloquear;
        private $mediabloquear;
        private $numsaques;
        private $mediasaques;

        
        function __construct($idjug,$ideq,$idpartido,$idset,$base) {
            $nombrejug='hola';
            $puestojug='adios';
            $base->consulta("SELECT nombre, puesto FROM statisticssports.jugadorbase where idjugadorbase=$idjug and id_equipo = $ideq;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="nombre"){
                        $nombrejug=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="puesto"){
                        $puestojug=$valor;
                    }
                }
            }
            $base->consulta("INSERT INTO statisticssports.jugador 
            VALUES ($idjug,'$nombrejug',$ideq,'$puestojug',0,0,0,0,0,0,0,0,0,0,0,0,$idpartido,$idset);");
            
        }

    }  
?>