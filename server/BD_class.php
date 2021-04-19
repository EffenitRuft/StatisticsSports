<?php
    class conexion{       
        private $host;
        private $port;
        private $socket;
        private $user;
        private $password;
        private $dbname;
        private $descriptor;
        
        function __construct($host,$user,$password,$dbname,$port,$socket) {
            $this->host=$host;
            $this->port=$port;
            $this->socket=$socket;
            $this->user=$user;
            $this->password=$password;
            $this->dbname=$dbname;
            $this->descriptor = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port, $this->socket);
        
        }
        public function consulta($consulta) {
            $this->resultado = mysqli_query($this->descriptor, $consulta);
        }

        public function extraer_registro(){
            if ($fila =  mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)) {
                return $fila;
            } else {
                return false;
            }
        }
    }
    
?>