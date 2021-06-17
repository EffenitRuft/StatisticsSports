
<?php
/**Clase filtroIndex
Esta clase sirve para obtener los datos de jugadores filtrados por equipo, liga y género.
Tiene 6 atributos privados $liga, $base, $categoria, $genero, $eq y $arrayArrays.
 */
    class filtroIndex{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $eq;
        private $arrayArrays;
        

        /**
         * Constructor que toma como parámetros liga, eq y base
         * @param base es la base de datos, se asigna al atributo privado base.
         * @param eq es el equipo elegido.
         * @param liga es el valor de la liga en formato siglas.
         * 
         * Posteriormente según el valor de liga pasado por parámetro lo transforma a
         * formato extenso asignando el género y la liga.
         * A continuación se realiza una consulta de datos teniendo en cuenta diferentes
         * casos:
         *  -Que no se quiera filtrar y se quieran todos los resultados.
         *  -Que se quieran todos los jugadores de equipos de una liga y género concretos.
         *  -Que se quieran jugadores de un equipo concreto de una liga y género concretos.
         * 
         * Finalmente se extraen los datos de la consulta y se insertan en un array que
         * está compuesto de arrays de los equipos.
         */
        function __construct($liga,$eq,$base) {
            $i = 0;
            $this->base=$base;
            $this->eq=$eq;
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
            }else if($this->eq=="TODO"){  
                $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                where e.liga='$this->liga' and e.genero='$this->genero';");
            }else{
                $base->consulta("SELECT DISTINCT j.id_jugador,e.id_equipo, e.nombre_equipo
                FROM statisticssports.jugador j 
                inner join statisticssports.equipo e on j.ID_EQUIPO=e.id_equipo 
                where e.id_equipo='$this->eq' and e.liga='$this->liga' and e.genero='$this->genero';");
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
         * arrays con los datos de los equipos elegidos.
         * @return arrayArrays
         */
        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }  
?>