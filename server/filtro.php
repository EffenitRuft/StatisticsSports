<?php
    class filtro{       
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
            }else if($liga=='todo'){
                $this->genero = "todo";
                $this->liga = "todo";
            }
            if($this->genero=="todo" && $this->liga=="todo"){
                $base->consulta("SELECT DISTINCT j.id_jugador, e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo;");
            }else{
                $base->consulta("SELECT DISTINCT j.id_jugador, e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                where e.liga='$this->liga' and e.genero='$this->genero';");
            }
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="id_jugador"){
                        $array1[0]=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="id_equipo"){
                        $array1[1]=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="nombre_equipo"){
                        $array1[2]=$valor;
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
?>