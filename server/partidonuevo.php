<?php
    class partidonuevo{       
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

        
        function __construct($ideq1,$ideq2,$idpartido,$liga,$base) {
            $equipo1='';
            $equipo2='';
            $base->consulta("SELECT `equipo`.`nombre_equipo` FROM `statisticssports`.`equipo` where id_equipo = $ideq1");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="nombre_equipo"){
                        $equipo1=$valor;
                    }
                }
            }
            $base->consulta("SELECT `equipo`.`nombre_equipo` FROM `statisticssports`.`equipo` where id_equipo = $ideq2");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="nombre_equipo"){
                        $equipo2=$valor;
                    }
                }
            }
            $base->consulta("INSERT INTO `statisticssports`.`partidos`
            (`id_partido`,`equipo_1`,`equipo_2`,`set_eq1`,`set_eq2`,`set1_eq1`,`set1_eq2`,`set2_eq1`,`set2_eq2`,`set3_eq1`,
            `set3_eq2`,`set4_eq1`,`set4_eq2`,`set5_eq1`,`set5_eq2`,`id_liga`)
            VALUES
            ($idpartido,'$equipo1','$equipo2',0,0,0,0,0,0,0,0,0,0,0,0,'$liga');");
            
        }

    }  
?>