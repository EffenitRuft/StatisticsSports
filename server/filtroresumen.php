
<?php
/**Clase filtroresumen
Esta clase sirve para obtener el id_jugador de los jugadores filtrados por id del equipo y por partido.
 */
    class filtroresumen{       
        private $base;
        private $ideq;
        private $arrayArrays;
        

        /**
         * Constructor que toma como parámetros $ideq,$partido y $base
         * @param base es la base de datos, se asigna al atributo privado base.
         * Posteriormente se realiza una consulta SQL a base de datos para obtener
         * el id_jugador de un ideq y partido concretos.
         * A continuación se inserta el resultado en un array.
         */
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

        /**
         * Función que devuelve arrayArrays que contiene el id_jugador de los jugadores elegidos.
         * @return arrayArrays
         */
        public function datosResumen(){
            return $this->arrayArrays;
        }
    }  
?>