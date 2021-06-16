
<?php
/**Clase jugador
Esta clase sirve para obtener todos los datos del jugador según un id_jugador y un id_equipo concretos.
 */
    class jugador{       
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
         * Constructor que toma como parámetros $idjug,$ideq,$nombreEquipo,$partido,$set y $base
         * @param idjug es el id del jugador, se asigna al atributo privado id_jugador
         * @param ideq es el id del equipo, se asigna al atributo privado id_equipo.
         * @param nombreEquipo es el nombre del equipo, se asigna al atributo privado nombreEquipo.
         * @param partido es el partido.
         * @param set es el set.
         * @param base es la base de datos.
         * Posteriormente se realiza una consulta SQL a base de datos para obtener todos los datos
         * del jugador filtrados por su id jugador y el id del equipo.
         * A continuación se extraen los resultados y se insertan en un array.
         */
        function __construct($idjug,$ideq,$nombreEquipo,$partido,$set,$base) {
            $this->id_jugador=$idjug;
            $this->nombreEquipo=$nombreEquipo;
            $this->id_equipo=$ideq;

            
$base->consulta("SELECT id_jugador,nombre,puesto,sum(numcolocaciones) as numcolocacionesA,round((sum(case when numcolocaciones != 0 then mediacolocaciones else 0 end)/(case when (sum(case when numcolocaciones != 0 then 1 else 0 end))=0 then 1 else (sum(case when numcolocaciones != 0 then 1 else 0 end)) end)),2)
as mediacolocacionesA,sum(numrecibir) as numrecibirA, round((sum(case when numrecibir != 0 then mediarecibir else '0' end)/(case when (sum(case when numrecibir != 0 then 1 else 0 end))=0 then 1 else (sum(case when numrecibir != 0 then 1 else 0 end)) end)),2) as mediarecibirA,
sum(numerodefender) as numerodefenderA,round((sum(case when numerodefender != 0 then mediadefender else '0' end)/(case when (sum(case when numerodefender != 0 then 1 else 0 end))=0 then 1 else (sum(case when numerodefender != 0 then 1 else 0 end)) end)),2) as mediadefenderA,sum(numeroataque) as numeroataqueA,
round((sum(case when numeroataque != 0 then mediaataque else '0' end)/(case when (sum(case when numeroataque != 0 then 1 else 0 end))=0 then 1 else (sum(case when numeroataque != 0 then 1 else 0 end)) end)),2) as mediaataqueA, sum(numerobloquear) as numerobloquearA,round(( sum(case when numerobloquear != 0 then mediabloquear else '0' end)/(case when (sum(case when numerobloquear != 0 then 1 else 0 end))=0 then 1 else (sum(case when numerobloquear != 0 then 1 else 0 end)) end)),2)as mediabloquearA,
sum(numsaques) as numsaquesA,round(( sum(case when numsaques != 0 then mediasaques else '0' end)/(case when (sum(case when numsaques != 0 then 1 else 0 end))=0 then 1 else (sum(case when numsaques != 0 then 1 else 0 end)) end)),2) as mediasaquesA
 FROM statisticssports.jugador where id_jugador='$idjug' and id_equipo='$ideq' group by id_jugador,id_equipo;");
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
        * Función que toma como parámetros $accion,$media,$id,$base,$numero,$ideq,$partido,$set
        * y actualiza el valor del numero de esa acción en la base de datos teniendo en cuenta
        * que si hay más de un valor hay que hacer la media.
        */
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
        
         /**
         * Función que utiliza la función operacionesactualizar para actualizar el valor
         * de esa acción en la base de datos.
         */
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

         /**
         * Función que asigna los valores de los atributos privados a las diferentes posiciones de $array
         * y devuelve el array construido.
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
?>