
<?php
/**Clase clasificacion
Esta clase sirve para extraer los datos de un equipo de genero y liga concretos.
Tiene cinco atributos privados, $liga, $base, $categoria, $genero y $arrayArrays.
 */
    class clasificacion{       
        private $liga;
        private $base;
        private $categoria="senior";
        private $genero;
        private $arrayArrays;
        

        /**
         * Constructor que toma como parámetros $liga y $base
         * @param $base es la conexión a base de datos
         * @param $liga es la liga en formato siglas
         * Este constructor se encarga de asignar a $liga en formato siglas el formato extenso
         * Posteriormente realiza la consulta a base de datos para extraer todos los datos de esa liga
         * A continuación recorre el resultado de la consulta y lo inserta en $arrayArrays
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
            $base->consulta("SELECT e.nombre_equipo, e.puntos, e.puntos_contra, e.puntos_favor, e.set_contra, e.set_favor, e.jugados, e.G3, e.G2, e.P1, e.P0  FROM statisticssports.equipo e where genero='$this->genero' and liga='$this->liga' ORDER BY puntos DESC;");
            
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="nombre_equipo"){
                        $array1[0]=$valor;
                    }
                    if($indice=="puntos"){
                        $array1[1]=$valor;
                    }
                    if($indice=="puntos_contra"){
                        $array1[2]=$valor;
                    }
                    if($indice=="puntos_favor"){
                        $array1[3]=$valor;
                    }  
                    if($indice=="set_contra"){
                        $array1[4]=$valor;
                    }  
                    if($indice=="set_favor"){
                        $array1[5]=$valor;
                    }
                    if($indice=="jugados"){
                        $array1[6]=$valor;
                    }
                    if($indice=="G3"){
                        $array1[7]=$valor;
                    }
                    if($indice=="G2"){
                        $array1[8]=$valor;
                    }
                    if($indice=="P1"){
                        $array1[9]=$valor;
                    }
                    if($indice=="P0"){
                        $array1[10]=$valor;
                    }
                }
                $this->arrayArrays[$i] = $array1;
                $i++;
            }
        }

        /**
         * Funcion que devuelve arrayArrays que está formado por 
         * arrays con los datos de los equipos elegidos
         * @return arrayArrays
         */
        public function datosBusqueda(){
            return $this->arrayArrays;
        }
    }
