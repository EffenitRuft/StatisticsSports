
<?php
/**Clase filtrarequiposliga
Esta clase sirve para obtener los equipos filtrados por género y liga concretos.
Tiene cinco atributos privados $liga, $base, $categoria, $genero y $arrayArrays.
 */
    class filtrarequiposliga{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $arrayArrays;
        

        /**
         * Constructor que toma como parámetros $liga y $base
         * @param base es la base de dato, se asigna al atributo privado base.
         * @param liga es el valor de la liga en formato siglas.
         * 
         * Posteriormente según el valor de liga pasado por parámetro lo transforma a
         * formato extenso asignando el género y la liga.
         * 
         * A continuación se realiza la consulta SQL a base de datos para obtener los equipos.
         * 
         * Finalmente se extraen los datos de la consulta y se insertan en un array que
         * está compuesto de arrays de los equipos.
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

         /**
         * Función que devuelve arrayArrays que es un array que contiene
         * arrays con los datos de los equipos elegidos.
         * @return arrayArrays
         */
        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }