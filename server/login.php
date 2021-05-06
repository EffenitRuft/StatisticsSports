<?php
    class login{       
        private $user;
        private $pass;
        
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