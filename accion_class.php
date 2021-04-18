<?php
    class accion{     
        private $jugador;  
        private $accion;
        private $nota;
        
        function __construct($array) {
            $this->jugador=$array[0];
            $this->accion=$array[1];
            $this->nota=$array[2];
        
        }

        public function getJugador(){
            return $this->jugador;
        }

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
                    $resultado="MEDIATAQUE";;
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