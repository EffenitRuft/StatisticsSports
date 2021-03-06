
<?php
/**Clase filtroequipopartidos
Esta clase sirve para obtener el idpartido de un equipo concreto para saber qué partidos ha jugado.
 */
    class filtroequipopartidos{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $eq;
        private $arrayArrays;
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
        private $nombreEquipo;

        

        /**
         * Constructor que toma como parámetros $liga $eq y $base
         * @param base es la base de datos, se asigna al atributo privado base.
         * @param eq es el id del equipo.
         * @param liga es el valor de la liga en formato siglas.
         * 
         * A continuación se realizan consultas teniendo en cuenta si se quiere mostrar todo o
         * si se quiere filtrar por equipo, que en ese caso primero se hace una consulta para
         * obtener el nombre del equipo a partir de su id y posteriormente se hace una consulta
         * para saber que partidos ha jugado ese equipo.
         * Finalmente se guardan los idpartido de los partidos del equipo buscado en un array.
         */
        function __construct($liga,$eq,$base) {
            $i = 0;
            $this->base=$base;
            $this->eq=$eq;
            $this->liga = $liga;

            if($this->eq == 'TODO'){
                $base->consulta("SELECT id_partido FROM statisticssports.partidos 
              where id_liga='$this->liga';");

            }else{
           $base->consulta("SELECT nombre_equipo FROM statisticssports.equipo WHERE id_equipo = '$this->eq';");  
            
           while ($fila = $base->extraer_registro()) {
            foreach ($fila as $indice => $valor) {
                if($indice=="nombre_equipo"){
                    $this->nombreEquipo =$valor;
                }
            }  
            }  
             $base->consulta("SELECT id_partido FROM statisticssports.partidos 
              where (equipo_1='$this->nombreEquipo' or equipo_2='$this->nombreEquipo')
              and id_liga='$this->liga';");
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
         * Función que devuelve arrayArrays que contiene el id_partido de todos
         * los partidos jugados por el equipo elegido.
         * @return arrayArrays
         */
        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }  
?>