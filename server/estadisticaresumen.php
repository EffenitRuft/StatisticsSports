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

        
        function __construct($idjug,$ideq,$idpartido,$num_set,$base) {
            $this->id_partido=$idpartido;
            $this->id_equipo=$ideq;
            $this->num_set=$num_set;
            $base->consulta("SELECT id_jugador,nombre,sum(numcolocaciones) as numcolocacionesA,avg(mediacolocaciones)
            as mediacolocacionesA,sum(numrecibir) as numrecibirA, avg(mediarecibir) as mediarecibirA,
            sum(numerodefender) as numerodefenderA,avg(mediadefender) as mediadefenderA,sum(numeroataque) as numeroataqueA,
            avg(mediaataque) as mediaataqueA, sum(numerobloquear) as numerobloquearA,avg(mediabloquear) as mediabloquearA,
            sum(numsaques) as numsaquesA,avg(mediasaques) as mediasaquesA
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