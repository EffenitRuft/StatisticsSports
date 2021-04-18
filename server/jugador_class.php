<?php
    class jugador{       
        private $id_jugador;
        private $nombre;
        private $id_equipo;
        private $puesto;
        private $numcolocaciones;
        private $mediacolocaciones;
        private $numrecibir;
        private $mediarecibir;
        private $numerodefender;
        private $mediadefender;
        private $numeroataque;
        private $mediataque;
        private $numerobloquear;
        private $mediabloquear;
        private $numsaques;
        private $mediasaques;

        
        function __construct($id,$base) {
            $this->id=$id;
            $base->consulta("SELECT * FROM jugador where ID_JUGADOR='$id';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el equipo
                    if($indice=="ID_EQUIPO"){
                        $this->id_equipo=$valor;
                    }
                    //Guardamos el NOMBRE
                    if($indice=="NOMBRE"){
                        $this->nombre=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="PUESTO"){
                        $this->puesto=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMCOLOCACIONES"){
                        $this->numcolocaciones=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIACOLOCACIONES"){
                        $this->mediacolocaciones=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMRECIBIR"){
                        $this->numrecibir=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIARECIBIR"){
                        $this->mediarecibir=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMERODEFENDER"){
                        $this->numerodefender=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIADEFENDER"){
                        $this->mediadefender=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMEROATAQUE"){
                        $this->numeroataque=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIATAQUE"){
                        $this->mediataque=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMEROBLOQUEAR"){
                        $this->numerobloquear=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIABLOQUEAR"){
                        $this->mediabloquear=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="NUMSAQUES"){
                        $this->numsaques=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="MEDIASAQUES"){
                        $this->mediasaques=$valor;
                    }
                }
            }   
        
        }

        private function operacionesactualizar($accion,$media,$id,$base,$numero){
            $valor_anterior_Num;
            $base->consulta("SELECT $numero FROM jugador where ID_JUGADOR='$id';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice==$numero){
                        $valor_anterior_Num=$valor;
                    }
                }
            }
            $valor_nuevo_Num = $valor_anterior_Num+1;
            $base->consulta("UPDATE jugador SET $numero = '$valor_nuevo_Num' WHERE ID_Jugador = '$id';");
            $valor_anterior_Med;
            $base->consulta("SELECT $accion FROM jugador where ID_JUGADOR='$id';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice==$accion){
                        $valor_anterior_Med=$valor;
                    }
                }
            }
            if($valor_nuevo_Num==1){
                $valor_nuevo_Med = $media;
            }else{
                $valor_nuevo_Med = ($valor_anterior_Med+$media)/2;
            }
            $base->consulta("UPDATE jugador SET $accion = '$valor_nuevo_Med' WHERE ID_Jugador = '$id';");
        }
        
        public function actualizaraccion($accion,$media,$id,$base) {
            if($accion=='MEDIACOLOCACIONES'){
                $numero = 'NUMCOLOCACIONES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }else if($accion=='MEDIARECIBIR'){
                $numero = 'NUMRECIBIR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }else if($accion=='MEDIADEFENDER'){
                $numero = 'NUMERODEFENDER';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }else if($accion=='MEDIATAQUE'){
                $numero = 'NUMEROATAQUE';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }else if($accion=='MEDIABLOQUEAR'){
                $numero = 'NUMEROBLOQUEAR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }else if($accion=='MEDIASAQUES'){
                $numero = 'NUMSAQUES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero);
            }
        }
    }  
?>