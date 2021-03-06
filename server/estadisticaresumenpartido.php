
<?php
/**Clase estadisticaresumen partido
Esta clase sirve para devolver los valores de estadística de un jugador en un partido en concreto.
Tiene diecisiete atributos privados  $id_jugador, $nombre_jug, $nombreEquipo, $id_equipo, $puesto, $numcolocaciones,
$mediacolocaciones, $numrecibir, $mediarecibir, $numerodefender, $mediadefender, $numeroataque, $mediataque,
$numerobloquear, $mediabloquear, $numsaques, $mediasaques;
 */
    class estadisticaresumenpartido{       
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

        /**
         * * Constructor que toma como parámetros $idjug,$ideq,$nombreEquipo,$partido y $base.
         * @param idjug se asigna al atributo privado de la clase id_jugador
         * @param nombreEquipo se asigna al atributo privado de la clase nombreEquipo
         * @param ideq se asigna al atributo privado de la clase id_equipo
         * 
         * Posteriormente se realiza una consulta para obtener el número de set.
         * A continuación se inicializan todos los sets correspondientes a las acciones a 0.
         * Después se realizan consultas SQL a base de datos para obtener el número de cada acción.
         * A continuación se realiza una consulta en la que se devuelven todos los valores redondeados de las acciones
         * de un jugador en un partido en concreto.
         * Finalmente se recorre el resultado de la consulta y se asignan los valores.
         */
        function __construct($idjug,$ideq,$nombreEquipo,$partido,$base) {
            $this->id_jugador=$idjug;
            $this->nombreEquipo=$nombreEquipo;
            $this->id_equipo=$ideq;

            $set = 0;

            $base->consulta("SELECT DISTINCT max(num_set) as numSet FROM statisticssports.jugador where partido='$partido' and id_equipo='$ideq'");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="numSet"){
                        $set=$valor;
                    }
                }
            }

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
                    if($indice=="numerodefenderA"){
                        $set_def=$valor;
                    }
                }
            }
            $base->consulta("SELECT count(numeroataque) as numeroataqueA
            FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' and partido='$partido' and numeroataque !=0
            group by id_jugador,partido,id_equipo;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
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
        if($indice=="id_jugador"){
            $this->id_jugador=$valor;
        }
        if($indice=="nombre"){
            $this->nombre_jug=$valor;
        }
        if($indice=="puesto"){
            $this->puesto= $valor;
        }
        if($indice=="numcolocacionesA"){
            $this->numcolocaciones=$valor;
        }
        if($indice=="mediacolocacionesA"){
            $this->mediacolocaciones=$valor;
        }
        if($indice=="numrecibirA"){
            $this->numrecibir=$valor;
        }
        if($indice=="mediarecibirA"){
            $this->mediarecibir=$valor;
        }
        if($indice=="numerodefenderA"){
            $this->numerodefender=$valor;
        }
        if($indice=="mediadefenderA"){
            $this->mediadefender=$valor;
        }
        if($indice=="numeroataqueA"){
            $this->numeroataque=$valor;
        }
        if($indice=="mediaataqueA"){
            $this->mediataque=$valor;
        }
        if($indice=="numerobloquearA"){
            $this->numerobloquear=$valor;
        }
        if($indice=="mediabloquearA"){
            $this->mediabloquear=$valor;
        }
        if($indice=="numsaquesA"){
            $this->numsaques=$valor;
        }
        if($indice=="mediasaquesA"){
            $this->mediasaques=$valor;
        }
    }
}
}

/**
 * Funcion que devuelve un array con todos los valores del jugador
 * @return array
 */
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
    }
