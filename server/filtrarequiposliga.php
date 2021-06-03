<?php
    class filtrarequiposliga{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $arrayArrays;
        

        
        function __construct($liga,$base) {
            $i = 0;
            $this->base=$base;
            if($liga=='SF'){
                $this->genero = "femenino";
                $this->liga = "superliga1";
            }else if($liga=='SM'){
                $this->genero = "masculino";
                $this->liga = "superliga1";
            }else if($liga=='SF2'){
                $this->genero = "femenino";
                $this->liga = "superliga2";
            }else if($liga=='SM2'){
                $this->genero = "masculino";
            $this->liga = "superliga2";
            }else if($liga=='TODO'){
                $this->genero = "todo";
                $this->liga = "todo";
            }
            $base->consulta("SELECT e.id_equipo, e.nombre_equipo FROM statisticssports.equipo e where genero='$this->genero' and liga='$this->liga' ORDER BY nombre_equipo ASC;");
            
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="id_equipo"){
                        $array1[0]=$valor;
                    }
                    if($indice=="nombre_equipo"){
                        $array1[1]=$valor;
                    }
                }
                $this->arrayArrays[$i] = $array1;
                $i++;
            }
        }

        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }