<?php
    class filtroequipo{       
        private $idequipo;

        function __construct($eq,$ligaA,$base) {
            $genero;
            $liga;
            if($ligaA=='SF'){
                $genero = "femenino";
                $liga = "superliga1";
            }else if($ligaA=='SM'){
                $genero = "masculino";
                $liga = "superliga1";
            }else if($ligaA=='SF2'){
                $genero = "femenino";
                $liga = "superliga2";
            }else if($ligaA=='SM2'){
                $genero = "masculino";
                $liga = "superliga2";
            }
            $base->consulta("SELECT id_equipo FROM statisticssports.equipo where nombre_equipo='$eq' and genero='$genero' and liga='$liga'");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="id_equipo"){
                        $this->idequipo=$valor;
                    } 
                }
            }
        }

        public function getidequipo(){
            return $this->idequipo;
        }
    }  
?>