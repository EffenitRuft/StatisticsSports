<?php
    class partidos{       
        private $partido;
        private $base;
        private $equipo1;
        private $equipo2;
        private $set_eq1;
        private $set_eq2;
        private $set1_eq1;
        private $set1_eq2;
        private $set2_eq1;
        private $set2_eq2;
        private $set3_eq1;
        private $set3_eq2;
        private $set4_eq1;
        private $set4_eq2;
        private $set5_eq1;
        private $set5_eq2;
        
        function __construct($numpartido,$base) {
            $this->base=$base;
            $this->partido=$numpartido;
            $base->consulta("SELECT * FROM statisticssports.partidos where id_partido=".$numpartido);
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="set1_eq1"){
                        $this->set1_eq1=$valor;
                    }
                    if($indice=="set2_eq1"){
                        $this->set2_eq1=$valor;
                    }
                    if($indice=="set3_eq1"){
                        $this->set3_eq1=$valor;
                    }
                    if($indice=="set4_eq1"){
                        $this->set4_eq1=$valor;
                    }
                    if($indice=="set5_eq1"){
                        $this->set5_eq1=$valor;
                    }
                    if($indice=="set1_eq2"){
                        $this->set1_eq2=$valor;
                    }
                    if($indice=="set2_eq2"){
                        $this->set2_eq2=$valor;
                    }
                    if($indice=="set3_eq2"){
                        $this->set3_eq2=$valor;
                    }
                    if($indice=="set4_eq2"){
                        $this->set4_eq2=$valor;
                    }
                    if($indice=="set5_eq2"){
                        $this->set5_eq2=$valor;
                    }
                    if($indice=="set_eq1"){
                        $this->set_eq1=$valor;
                    }
                    if($indice=="set_eq2"){
                        $this->set_eq2=$valor;
                    }
                    if($indice=="equipo_1"){
                        $this->equipo1=$valor;
                    }
                    if($indice=="equipo_2"){
                        $this->equipo2=$valor;
                    }
                }
            }
        }
        public function sumarPuntos($equipo,$set,$base,$num){
            $valor_anterior;
            $valor_nuevo;
            if($set==1 and $equipo==1){
                $base->consulta("SELECT set1_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set1_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set1_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==2 and $equipo==1){
                $base->consulta("SELECT set2_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set2_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set2_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==3 and $equipo==1){
                $base->consulta("SELECT set3_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set3_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set3_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==4 and $equipo==1){
                $base->consulta("SELECT set4_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set4_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set4_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==5 and $equipo==1){
                $base->consulta("SELECT set5_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set5_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set5_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            } else if($set==1 and $equipo==2){
                $base->consulta("SELECT set1_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set1_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set1_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==2 and $equipo==2){
                $base->consulta("SELECT set2_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set2_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set2_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==3 and $equipo==2){
                $base->consulta("SELECT set3_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set3_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set3_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==4 and $equipo==2){
                $base->consulta("SELECT set4_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set4_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set4_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($set==5 and $equipo==2){
                $base->consulta("SELECT set5_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set5_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+(1*$num);
                $base->consulta("UPDATE statisticssports.partidos SET set5_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }
        }
        public function sumarSet($equipo,$base){
            $valor_anterior;
            $valor_nuevo;
            if($equipo==1){
                $base->consulta("SELECT set_eq1 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set_eq1'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+1;
                $base->consulta("UPDATE statisticssports.partidos SET set_eq1 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }else if($equipo==2){
                $base->consulta("SELECT set_eq2 FROM statisticssports.partidos where id_partido='$this->partido';");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='set_eq2'){
                            $valor_anterior=$valor;
                        }
                    }
                }
                $valor_nuevo=$valor_anterior+1;
                $base->consulta("UPDATE statisticssports.partidos SET set_eq2 = '$valor_nuevo' WHERE id_partido = '$this->partido';");
            }
        }

        public function getPartido(){
            $array[0] = $this->set5_eq1;
            $array[1] = $this->set4_eq1;
            $array[2] = $this->set3_eq1;
            $array[3] = $this->set2_eq1;
            $array[4] = $this->set1_eq1;
            $array[5] = $this->set_eq1;
            $array[6] = $this->equipo1;
            $array[7] = $this->equipo2;
            $array[8] = $this->set_eq2;
            $array[9] = $this->set1_eq2;
            $array[10] = $this->set2_eq2;
            $array[11] = $this->set3_eq2;
            $array[12] = $this->set4_eq2;
            $array[13] = $this->set5_eq2;
            return $array;
        }
    }  
?>