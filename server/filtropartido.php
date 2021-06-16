
<?php
/**Clase filtropartido
Esta clase sirve para obtener el id_partido de partidos filtrados por liga.
 */
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
        

        /**
         * Constructor que toma como parámetros $liga y $base
         * @param base es la base de datos, se asigna al atributo privado base.
         * Posteriormente se realiza una consulta a base de datos teniendo en cuenta 
         * si se quiere filtrar por liga o no.
         * A continuación se guardan los id_partido en un array.
         */
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

        /**
         * Función que devuelve arrayArrays que contiene los id_partido
         * de los partidos elegidos.
         * @return arrayArrays
         */
        public function datosPartido(){
            return $this->arrayArrays;
        }
    }  
?>