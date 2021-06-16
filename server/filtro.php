
<?php
/**Clase filtro
Esta clase sirve para obtener los jugadores filtrados por género y liga concretos.
Tiene 5 atributos privados  $liga, $base, $categoria, $genero y $arrayArrays.
 */
    class filtro{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $arrayArrays;
        

         /**
         * Constructor que toma como parámetros $liga y $base
         * @param base es la base de datos, se asigna al atributo privado base.
         * @param liga es el valor de la liga en formato siglas.
         * 
         * Posteriormente según el valor de liga pasado por parámetro lo transforma a
         * formato extenso asignando el género y la liga.
         * 
         * A continuación se realiza la consulta SQL a base de datos para obtener los jugadores elegidos.
         * 
         * Finalmente se extraen los datos de la consulta y se insertan en un array que
         * está compuesto de arrays de los jugadores.
         */
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
                    if($indice=="id_jugador"){
                        $array1[0]=$valor;
                    }
                    if($indice=="id_equipo"){
                        $array1[1]=$valor;
                    }
                    if($indice=="nombre_equipo"){
                        $array1[2]=$valor;
                    }   
                }
                $this->arrayArrays[$i] = $array1;
                $i++;
            }
        }

         /**
         * Función que devuelve arrayArrays que es un array que contiene
         * arrays con los datos de los jugadores elegidos.
         * @return arrayArrays
         */
        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }  
?>