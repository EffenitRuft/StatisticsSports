<?php
    class filtroidpartido{      
        private $base;
        private $id;
        

        
        function __construct($eq1,$eq2,$ligaA,$base) {
            $this->base=$base;
            $base->consulta("SELECT id_partido from statisticssports.partidos where equipo_1='$eq1' and equipo_2='$eq2' and id_liga='$ligaA';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="id_partido"){
                        $this->id=$valor;
                    }
                }
            }
        }

        public function getidpartido(){
            return $this->id;
        }
    }  
?>