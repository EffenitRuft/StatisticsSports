<?php
    class accion{     
        private $equipo;  
        private $jugador;  
        private $accion;
        private $nota;
        
        function __construct($array) {
            $this->equipo=$array[0];
            $this->jugador=$array[1];
            $this->accion=$array[2];
            $this->nota=$array[3];
        
        }
        public function getEquipo(){
            return $this->equipo;
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