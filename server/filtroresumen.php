<?php
    class filtroresumen{       
        private $base;
        private $ideq;
        private $arrayArrays;
        

        
        function __construct($ideq,$partido,$base) {
            $i=0;
            $this->ideq = $ideq;
            $base->consulta("SELECT DISTINCT id_jugador FROM statisticssports.jugador where id_equipo='$ideq' and partido='$partido'");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="id_jugador"){
                        $array1[0]=$valor;
                    } 
                }
                $this->arrayArrays[$i] = $array1;
                $i++;
            }
        }

        public function datosResumen(){
            return $this->arrayArrays;
        }
    }  
?>