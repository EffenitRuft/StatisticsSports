<?php
/**
    *Clase conexion
    *Esta clase sirve para establecer la conexión con la base de datos.
    *Tiene siete atributos privados, $host, $port, $socket, $user, $password
    *$dbname y $descriptor.
 */
    class conexion{       
        private $host;
        private $port;
        private $socket;
        private $user;
        private $password;
        private $dbname;
        private $descriptor;
        
        /**
         * Constructor que toma como parametros los valores de $host, $port, $socket, $user,
         *  $password $dbname y $descriptor y se lo asigna a los atributos privados
         */
        function __construct($host,$user,$password,$dbname,$port,$socket) {
            $this->host=$host;
            $this->port=$port;
            $this->socket=$socket;
            $this->user=$user;
            $this->password=$password;
            $this->dbname=$dbname;
            $this->descriptor = new mysqli($this->host, $this->user, $this->password, $this->dbname, $this->port, $this->socket);
        
        }

        /**
         * Función que toma como parametro la consulta SQL y la lanza a la base de datos.
         */
        public function consulta($consulta) {
            $this->resultado = mysqli_query($this->descriptor, $consulta);
        }

        /**
         * Función que extrae los resultados de ejecutar la consulta SQL con la función anterior
         * y devuelve las filas.
         * @return fila
         */
        public function extraer_registro(){
            if ($fila =  mysqli_fetch_array($this->resultado, MYSQLI_ASSOC)) {
                return $fila;
            } else {
                return false;
            }
        }
    }
    
?>