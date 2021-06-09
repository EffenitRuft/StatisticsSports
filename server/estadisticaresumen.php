<?php
    class estadisticaresumen{       
        private $id_jugador;
        private $nombre_jug;
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

//***************************ULTIMA PARTE MARTA*****************************************************************
//***************************TODO EL CONSTRUCTOR*****************************************************************

        
        function __construct($idjug,$ideq,$nombreEquipo,$partido,$set,$base) {
            $this->id_jugador=$idjug;
            $this->nombreEquipo=$nombreEquipo;
            $this->id_equipo=$ideq;

            $set_col=0;
            $set_rec=0;
            $set_def=0;
            $set_ata=0;
            $set_blo=0;
            $set_saq=0;


            $base->consulta("SELECT count(numcolocaciones) as numcolocacionesA
            FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numcolocaciones !=0
            group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numcolocacionesA"){
                        $set_col=$valor;
                    }
                }
            }
                    $base->consulta("SELECT count(numrecibir) as numrecibirA
                    FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numrecibir !=0
                    group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numrecibirA"){
                        $set_rec=$valor;
                    }
                }
            }
                    $base->consulta("SELECT count(numerodefender) as numerodefenderA
                    FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numerodefender !=0
                     group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numerodefenderA"){
                        $set_def=$valor;
                    }
                }
            }
                    $base->consulta("SELECT count(numeroataque) as numeroataqueA
                    FROM statisticssports.jugador where
                    id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numeroataque !=0
                    group by id_jugador,partido,id_equipo;");
                    while ($fila = $base->extraer_registro()) {
                     foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numeroataqueA"){
                        $set_ata=$valor;
                    }
                }
            }
                    $base->consulta("SELECT count(numerobloquear) as numerobloquearA
                    FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numerobloquear !=0
                    group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numerobloquearA"){
                        $set_blo=$valor;
                    }
                }
            }
                    $base->consulta("SELECT count(numsaques) as numsaquesA
                    FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numsaques !=0
                   group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="numsaquesA"){
                        $this->set_saq=$valor;
                    }
                }
            }
            if($set_col==0){
                $set_col=$set;
            }
            if($set_rec==0){
                $set_rec=$set;
            }
            if($set_def==0){
                $set_def=$set;
            }
            if($set_ata==0){
                $set_ata=$set;
            }
            if($set_blo==0){
                $set_blo=$set;
            }
            if($set_saq==0){
                $set_saq=$set;
            }

$base->consulta("SELECT id_jugador,nombre,puesto,sum(numcolocaciones) as numcolocacionesA,round((sum(mediacolocaciones)/$set_col),2)
as mediacolocacionesA,sum(numrecibir) as numrecibirA, round((sum(mediarecibir)/$set_rec),2) as mediarecibirA,
sum(numerodefender) as numerodefenderA,round((sum(mediadefender)/$set_def),2) as mediadefenderA,sum(numeroataque) as numeroataqueA,
round((sum(mediaataque)/$set_ata),2) as mediaataqueA, sum(numerobloquear) as numerobloquearA,round((sum(mediabloquear)/$set_blo),2)as mediabloquearA,
sum(numsaques) as numsaquesA,round((sum(mediasaques)/$set_saq),2) as mediasaquesA
 FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' group by id_jugador,id_equipo;");
while ($fila = $base->extraer_registro()) {
    foreach ($fila as $indice => $valor) {
        //Guardamos el NOMBRE
        if($indice=="id_jugador"){
            $this->id_jugador=$valor;
        }
        //Guardamos el puesto
        if($indice=="nombre"){
            $this->nombre_jug=$valor;
        }
        if($indice=="puesto"){
            $this->puesto= $valor;
        }
        //Guardamos el puesto
        if($indice=="numcolocacionesA"){
            $this->numcolocaciones=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediacolocacionesA"){
            $this->mediacolocaciones=$valor;
        }
        //Guardamos el puesto
        if($indice=="numrecibirA"){
            $this->numrecibir=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediarecibirA"){
            $this->mediarecibir=$valor;
        }
        //Guardamos el puesto
        if($indice=="numerodefenderA"){
            $this->numerodefender=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediadefenderA"){
            $this->mediadefender=$valor;
        }
        //Guardamos el puesto
        if($indice=="numeroataqueA"){
            $this->numeroataque=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediaataqueA"){
            $this->mediataque=$valor;
        }
        //Guardamos el puesto
        if($indice=="numerobloquearA"){
            $this->numerobloquear=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediabloquearA"){
            $this->mediabloquear=$valor;
        }
        //Guardamos el puesto
        if($indice=="numsaquesA"){
            $this->numsaques=$valor;
        }
        //Guardamos el puesto
        if($indice=="mediasaquesA"){
            $this->mediasaques=$valor;
        }
    }
}
        
        }

        private function operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set){
            $valor_anterior_Num;
            $base->consulta("SELECT $numero FROM jugador where ID_JUGADOR='$id' and ID_EQUIPO='$ideq' and partido='$partido' and num_set='$set';");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice==$numero){
                        $valor_anterior_Num=$valor;
                    }
                }
            }
            $valor_nuevo_Num = $valor_anterior_Num+1;
            $base->consulta("UPDATE jugador SET $numero = '$valor_nuevo_Num' WHERE ID_Jugador = '$id' and ID_EQUIPO='$ideq' and partido='$partido' and num_set='$set';");
            $valor_anterior_Med;
            $base->consulta("SELECT $accion FROM jugador where ID_JUGADOR='$id' and ID_EQUIPO='$ideq' and partido='$partido' and num_set='$set';");
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
            $base->consulta("UPDATE jugador SET $accion = '$valor_nuevo_Med' WHERE ID_Jugador = '$id' and ID_EQUIPO='$ideq' and partido='$partido' and num_set='$set';");
        }
        
        public function actualizaraccion($accion,$media,$id,$base,$ideq,$partido,$set) {
            if($accion=='MEDIACOLOCACIONES'){
                $numero = 'NUMCOLOCACIONES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }else if($accion=='MEDIARECIBIR'){
                $numero = 'NUMRECIBIR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }else if($accion=='MEDIADEFENDER'){
                $numero = 'NUMERODEFENDER';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }else if($accion=='MEDIAATAQUE'){
                $numero = 'NUMEROATAQUE';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }else if($accion=='MEDIABLOQUEAR'){
                $numero = 'NUMEROBLOQUEAR';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }else if($accion=='MEDIASAQUES'){
                $numero = 'NUMSAQUES';
                $this->operacionesactualizar($accion,$media,$id,$base,$numero,$ideq,$partido,$set);
            }
        }

        public function getJugador(){
            $array[0] = $this->id_jugador;
            $array[1] = $this->nombre_jug;
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
        public function getJugadorSinEquipo(){
            $array[0] = $this->id_jugador;
            $array[1] = $this->nombre_jug;
            $array[2] = $this->puesto;
            $array[3] = $this->numcolocaciones;
            $array[4] = $this->mediacolocaciones;
            $array[5] = $this->numrecibir;
            $array[6] = $this->mediarecibir;
            $array[7] = $this->numerodefender;
            $array[8] = $this->mediadefender;
            $array[9] = $this->numeroataque;
            $array[10] = $this->mediataque;
            $array[11] = $this->numerobloquear;
            $array[12] = $this->mediabloquear;
            $array[13] = $this->numsaques;
            $array[14] = $this->mediasaques;
            return $array;
        }
    }
