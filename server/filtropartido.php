<?php
    class filtropartido{      
        private $base;
        private $equipo1;
        private $equipo2;
        private $set_eq1;
        private $set_eq2;
        private $set1_eq1;
        private $set1_eq2;
        private $set2_eq1;
        private $set2_eq2;
        private $set3_eq1;
        private $set3_eq2;
        private $set4_eq1;
        private $set4_eq2;
        private $set5_eq1;
        private $set5_eq2; 
        private $liga;
        private $arrayArrays;
        

        
        function __construct($liga,$base) {
            $i = 0;
            $this->base=$base;
            if($liga=="todo"){
                $base->consulta("SELECT id_partido FROM statisticssports.partidos;");
            }else{
                $base->consulta("SELECT id_partido FROM statisticssports.partidos where id_liga='$liga';");
            }
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="id_partido"){
                        $array1[0]=$valor;
                    }
                }
                $this->arrayArrays[$i] = $array1;
                $i++;
            }
        }

        public function datosPartido(){
            return $this->arrayArrays;
        }
    }  
?>