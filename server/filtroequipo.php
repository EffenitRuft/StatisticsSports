
<?php
/**Clase filtroequipo
Esta clase sirve para obtener el id_equipo de un equipo a partir de su nombre, liga y género
Tiene un atributo privado $idequipo.
 */
    class filtroequipo{       
        private $idequipo;

        /**
         * Constructor que toma como parámetros $eq,$ligaA y $base
         *  @param ligaA es el valor de la liga en formato siglas.
         * 
         * Posteriormente según el valor de liga pasado por parámetro lo transforma a
         * formato extenso asignando el género y la liga.
         * 
         * A continuación se realiza la consulta SQL a base de datos para obtener el equipo elegido.
         * Finalmente se guarda el idequipo y se asigna al atributo privado.
         */
        function __construct($eq,$ligaA,$base) {
            $genero;
            $liga;
            if($ligaA=='SF'){
                $genero = "femenino";
                $liga = "superliga1";
            }else if($ligaA=='SM'){
                $genero = "masculino";
                $liga = "superliga1";
            }else if($ligaA=='SF2'){
                $genero = "femenino";
                $liga = "superliga2";
            }else if($ligaA=='SM2'){
                $genero = "masculino";
                $liga = "superliga2";
            }
            $base->consulta("SELECT id_equipo FROM statisticssports.equipo where nombre_equipo='$eq' and genero='$genero' and liga='$liga'");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="id_equipo"){
                        $this->idequipo=$valor;
                    } 
                }
            }
        }

        /**
         * Función que devuelve el idequipo del equipo elegido.
         * @return idequipo
         */
        public function getidequipo(){
            return $this->idequipo;
        }
    }  
?>