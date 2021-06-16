
<?php
/**Clase filtroidpartido
Esta clase sirve para obtener el id_partido de un partido que están jugando dos equipos concretos.
Tiene dos atributos privados $base y $id.
 */
    class filtroidpartido{      
        private $base;
        private $id;
        

        /**
         * Constructor que toma como parámetros $eq1,$eq2,$ligaA y $base
         * @param base es la base de datos, se asigna al atributo privado base.
         * Posteriormente se realiza una consulta SQL a base de datos filtrando 
         * por los equipos elegidos y se guarda el id del partido en el atributo 
         * privado id de la clase.
         */
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

        /**
         * Función que devuelve el id del partido elegido.
         * @return id
         */
        public function getidpartido(){
            return $this->id;
        }
    }  
?>