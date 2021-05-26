<?php
    class estadisticaresumen{       
        private $id_jugador;
        private $nombre;
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
                //***************************CONSTRUCTOR*****************************************************************
        
        function __construct($idjug,$ideq,$idpartido,$num_set,$base) {
            $this->id_partido=$idpartido;
            $this->id_equipo=$ideq;
            $this->num_set=$num_set; 
            $set_col=0;
            $set_rec=0;
            $set_def=0;
            $set_ata=0;
            $set_blo=0;
            $set_saq=0;


            $base->consulta("SELECT count(numcolocaciones) as numcolocacionesA
            FROM statisticssports.jugador where partido='$idpartido'
            and id_jugador='$idjug' and id_equipo='$ideq' and numcolocaciones !=0
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
                    FROM statisticssports.jugador where partido='$idpartido'
                    and id_jugador='$idjug' and id_equipo='$ideq' and numrecibir !=0
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
                    FROM statisticssports.jugador where partido='$idpartido'
                    and id_jugador='$idjug' and id_equipo='$ideq' and numerodefender !=0
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
                    FROM statisticssports.jugador where partido='$idpartido' and
                    id_jugador='$idjug' and id_equipo='$ideq' and numeroataque !=0
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
                    FROM statisticssports.jugador where partido='$idpartido'
                    and id_jugador='$idjug' and id_equipo='$ideq' and numerobloquear !=0
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
                    FROM statisticssports.jugador where partido='$idpartido'
                    and id_jugador='$idjug' and id_equipo='$ideq' and numsaques !=0
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
                $set_col=$num_set;
            }
            if($set_rec==0){
                $set_rec=$num_set;
            }
            if($set_def==0){
                $set_def=$num_set;
            }
            if($set_ata==0){
                $set_ata=$num_set;
            }
            if($set_blo==0){
                $set_blo=$num_set;
            }
            if($set_saq==0){
                $set_saq=$num_set;
            }


            $base->consulta("SELECT id_jugador,nombre,sum(numcolocaciones) as numcolocacionesA,(sum(mediacolocaciones)/$set_col)
            as mediacolocacionesA,sum(numrecibir) as numrecibirA, (sum(mediarecibir)/$set_rec)as mediarecibirA,
            sum(numerodefender) as numerodefenderA,(sum(mediadefender)/$set_def) as mediadefenderA,sum(numeroataque) as numeroataqueA,
            (sum(mediaataque)/$set_ata) as mediaataqueA, sum(numerobloquear) as numerobloquearA,(sum(mediabloquear)/$set_blo)as mediabloquearA,
            sum(numsaques) as numsaquesA,(sum(mediasaques)/$set_saq) as mediasaquesA
             FROM statisticssports.jugador where partido='$idpartido'
            and id_jugador='$idjug' and id_equipo='$ideq' group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    //Guardamos el NOMBRE
                    if($indice=="id_jugador"){
                        $this->id_jugador=$valor;
                    }
                    //Guardamos el puesto
                    if($indice=="nombre"){
                        $this->nombre=$valor;
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

        public function getResumen(){
            $array[0] = $this->id_jugador;
            $array[1] = $this->nombre;
            $array[2] = $this->numcolocaciones;
            $array[3] = $this->mediacolocaciones;
            $array[4] = $this->numrecibir;
            $array[5] = $this->mediarecibir;
            $array[6] = $this->numerodefender;
            $array[7] = $this->mediadefender;
            $array[8] = $this->numeroataque;
            $array[9] = $this->mediataque;
            $array[10] = $this->numerobloquear;
            $array[11] = $this->mediabloquear;
            $array[12] = $this->numsaques;
            $array[13] = $this->mediasaques;
            return $array;
        }
    }  
?>