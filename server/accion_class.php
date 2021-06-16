<?php
/**
*Clase accion
*Esta clase sirve para asignar la nota a la acción seleccionada
*Tiene cuatro atributos privados, el equipo, el jugador, la acción y la nota.
*/
    class accion{     
        private $equipo;  
        private $jugador;  
        private $accion;
        private $nota;
        
        /**
         * Constructor de la clase accion
         * @param $array
         * Toma como parámetro un array que incluye los datos del equipo, el jugador, la acción y la nota.
         * Se asignan sus valores a los atributos privados.
         */
        function __construct($array) {
            $this->equipo=$array[0];
            $this->jugador=$array[1];
            $this->accion=$array[2];
            $this->nota=$array[3];
        
        }

        /**
         * Función que devuelve el valor del equipo
         * @return equipo
         */
        public function getEquipo(){
            return $this->equipo;
        }

        /**
         * Función que devuelve el valor del jugador
         * @return jugador.
         */
        public function getJugador(){
            return $this->jugador;
        }

        /**
         * Función para relacionar la acción con la media de datos de esa acción
         * que devuelve el resultado.
         * @return resultado.
         */
        public function campo(){
            $resultado="";
            switch ($this->accion) {
                case 'C':
                    $resultado="MEDIACOLOCACIONES";
                    break;
                case 'D':
                    $resultado="MEDIADEFENDER";
                    break;
                case 'R':
                    $resultado="MEDIARECIBIR";;
                    break;
                case 'A':
                    $resultado="MEDIAATAQUE";;
                    break;
                case 'B':
                    $resultado="MEDIABLOQUEAR";
                    break;
                case 'S':
                    $resultado="MEDIASAQUES";
                    break;
            }
            return $resultado;
        }

        /**
         * Función que sirve para convertir el valor de la nota (0,1,2,3,4)
         * en porcentaje (0, 25%, 50%, 75%, 100%) y devuelve el resultado.
         * @return resultado
         */
        public function convertir() {
            $resultado=0;
            switch ($this->nota) {
                case 0:
                    $resultado=0;
                    break;
                case 1:
                    $resultado=25;
                    break;
                case 2:
                    $resultado=50;
                    break;
                case 3:
                    $resultado=75;
                    break;
                case 4:
                    $resultado=100;
                    break;
            }
            return $resultado;
        }
    }  
?>