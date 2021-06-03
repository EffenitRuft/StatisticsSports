<?php
    class filtroIndex2{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $eq;
        private $arrayArrays;
        private $puesto;
        

        
        function __construct($liga,$eq,$puesto,$base) {
            $i = 0;
            $this->base=$base;
            $this->eq=$eq;
            $this->puesto=$puesto;
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

                }else if($this->eq=="TODO" && $this->puesto!="TODO"){
                    $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                where e.liga='$this->liga' and j.puesto='$this->puesto' and e.genero='$this->genero';");

                }else if($this->eq=="TODO" && $this->puesto=="TODO"){
                    $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                    FROM statisticssports.jugador j 
                    inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                    where e.liga='$this->liga' and e.genero='$this->genero';");  
                }else if($this->eq!="TODO" && $this->puesto=="TODO"){
                        $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                        FROM statisticssports.jugador j 
                        inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                        where e.id_equipo='$this->eq' and e.liga='$this->liga' and e.genero='$this->genero';");  

            }else{
                $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                where e.id_equipo='$this->eq' and e.liga='$this->liga' and j.puesto='$this->puesto' and e.genero='$this->genero';");
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