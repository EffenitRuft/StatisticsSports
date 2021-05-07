<?php
    class jugador{       
        private $id_jugador;
        private $nombre;
        private $nombreEquipo;
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

        
        function __construct($idjug,$ideq,$nombreEquipo,$base) {
            $this->id_jugador=$idjug;
            $this->nombreEquipo=$nombreEquipo;
            $this->id_equipo=$ideq;
            $base->consulta("SELECT * FROM statisticssports.jugador where ID_JUGADOR='$idjug' and ID_EQUIPO='$ideq';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="nombre"){
                        $this->nombre=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="puesto"){
                        $this->puesto=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numcolocaciones"){
                        $this->numcolocaciones=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediacolocaciones"){
                        $this->mediacolocaciones=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numrecibir"){
                        $this->numrecibir=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediarecibir"){
                        $this->mediarecibir=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numerodefender"){
                        $this->numerodefender=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediadefender"){
                        $this->mediadefender=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numeroataque"){
                        $this->numeroataque=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediaataque"){
                        $this->mediataque=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numerobloquear"){
                        $this->numerobloquear=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediabloquear"){
                        $this->mediabloquear=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="numsaques"){
                        $this->numsaques=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="mediasaques"){
                        $this->mediasaques=$valor;
                    }
                }
            }   
        
        }

        private function operacionesactualizar($accion,$media,$id,$base,$numero,$ideq){
            $valor_anterior_Num;
            $base->consulta("SELECT $numero FROM jugador where ID_JUGADOR='$id' and ID_EQUIPO='$ideq';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice==$numero){
                        $valor_anterior_Num=$valor;
                    }
                }
            }
            $valor_nuevo_Num = $valor_anterior_Num+1;
            $base->consulta("UPDATE jugador SET $numero = '$valor_nuevo_Num' WHERE ID_Jugador = '$id' and ID_EQUIPO='$ideq';");
            $valor_anterior_Med;
            $base->consulta("SELECT $accion FROM jugador where ID_JUGADOR='$id' and ID_EQUIPO='$ideq';");
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
            $base->consulta("UPDATE jugador SET $accion = '$valor_nuevo_Med' WHERE ID_Jugador = '$id' and ID_EQUIPO='$ideq';");
        }
        
        public function actualizaraccion($accion,$media,$id,$base,$ideq) {
            if($accion=='MEDIACOLOCACIONES'){
                $numero = 'NUMCOLOCACIONES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }else if($accion=='MEDIARECIBIR'){
                $numero = 'NUMRECIBIR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }else if($accion=='MEDIADEFENDER'){
                $numero = 'NUMERODEFENDER';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }else if($accion=='MEDIATAQUE'){
                $numero = 'NUMEROATAQUE';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }else if($accion=='MEDIABLOQUEAR'){
                $numero = 'NUMEROBLOQUEAR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }else if($accion=='MEDIASAQUES'){
                $numero = 'NUMSAQUES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq);
            }
        }

        public function getJugador(){
            $array[0] = $this->id_jugador;
            $array[1] = $this->nombre;
            $array[2] = $this->nombreEquipo;
            $array[3] = $this->puesto;
            $array[4] = $this->numcolocaciones;
            $array[5] = $this->mediacolocaciones;
            $array[6] = $this->numrecibir;
            $array[7] = $this->mediarecibir;
            $array[8] = $this->numerodefender;
            $array[9] = $this->mediadefender;
            $array[10] = $this->numeroataque;
            $array[11] = $this->mediataque;
            $array[12] = $this->numerobloquear;
            $array[13] = $this->mediabloquear;
            $array[14] = $this->numsaques;
            $array[15] = $this->mediasaques;
            return $array;
        }
    }  
?>