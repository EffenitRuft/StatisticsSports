
<?php
/**Clase login
Esta clase sirve para comprobar si el usuario y la contraseña son correctos comprobándolo con los
valores en la base de datos.
 */
    class login{       
        private $user;
        private $pass;
        
        /**
         * Constructor que toma como parámetros $user,$pass y $base
         * @param user es el usuario.
         * @param pass es la contraseña.
         * @param base es la base de datos.
         * Posteriormente se realiza una consulta para saber la contraseña que le corresponde
         * a ese usuario.
         * A continuación se comprueba si el valor es correcto y devuelve CORRECTO o si 
         * es erróneo y devuelve ERROR.
         */
        function __construct($user,$pass,$base) {
            $this->base=$base;
            $contra_real="VACIA";
            $base->consulta("SELECT contra FROM statisticssports.login where nombre_club='".$user."';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="contra"){
                        $contra_real=$valor;
                    }              
                }
            }
            if($contra_real==$pass){
                $this->user=$user;
                $this->pass=$pass;
                echo "CORRECTO";
            }else{
                echo "ERROR";
            }
    } 
    }  
?>