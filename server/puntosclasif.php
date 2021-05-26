<?php
    class puntosclasif{       
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
        private $liga;
        
        function __construct($numpartido,$base,$equipo1,$equipo2) {
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
                    if($indice=="id_liga"){
                        $this->liga=$valor;
                    }
                }
            }
//puntos equipo1,puntos equipo2, set equipo1, set equipo2,g3 equipo1,g3 equipo2,g2 equipo1,g2 equipo2,p1 equipo1,p1 equipo2,p0 equipo1,p0 equipo2.
            $arrayResultado = [];
            if($this->set_eq1==3 &&($this->set_eq2==0 ||$this->set_eq2==1)){
                //FALTA PUNTOS TOTALES, FALTA JUGADOS
                //puntos equipo1,puntos equipo2, set equipo1, set equipo2,g3 equipo1,g3 equipo2,g2 equipo1,g2 equipo2,p1 equipo1,p1 equipo2,p0 equipo1,p0 equipo2.
                $arrayResultado= [3,0,intval($this->set_eq1),intval($this->set_eq2),1,0,0,0,0,0,0,1];
            }else if($this->set_eq2==3 &&($this->set_eq1==0 ||$this->set_eq1==1)){
                $arrayResultado= [0,3,intval($this->set_eq1),intval($this->set_eq2),0,1,0,0,0,0,1,0];
            }else if($this->set_eq1==3 && $this->set_eq2==2){
                $arrayResultado= [2,1,intval($this->set_eq1),intval($this->set_eq2),0,0,1,0,0,1,0,0];
            }else{
                $arrayResultado= [1,2,intval($this->set_eq1),intval($this->set_eq),0,0,0,1,1,0,0,0];
            }
            echo json_encode($arrayResultado);
            $base->consulta("UPDATE statisticssports.equipo
            SET
            puntos_contra = $arrayResultado[1],
            puntos_favor = $arrayResultado[0],
            set_contra = $arrayResultado[3],
            set_favor = $arrayResultado[2],
            G3 = $arrayResultado[4],
            G2 = $arrayResultado[6],
            P1 = $arrayResultado[8],
            P0 = $arrayResultado[10]
            where id_equipo=$equipo1");
            $base->consulta("UPDATE statisticssports.equipo
            SET
            puntos_contra = $arrayResultado[0],
            puntos_favor = $arrayResultado[1],
            set_contra = $arrayResultado[2],
            set_favor = $arrayResultado[3],
            G3 = $arrayResultado[5],
            G2 = $arrayResultado[7],
            P1 = $arrayResultado[9],
            P0 = $arrayResultado[11]
             where id_equipo=$equipo2");

            $valor_anteriorP;
            $valor_anteriorJ;
            $valor_nuevoP;
            $valor_nuevoJ;
                $base->consulta("SELECT puntos,jugados
                FROM statisticssports.equipo where id_equipo=$equipo1;");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='puntos'){
                            $valor_anteriorP=$valor;
                        }
                        if($indice=='jugados'){
                            $valor_anteriorJ=$valor;
                        }
                    }
                }
                $valor_nuevoP=$valor_anteriorP+$arrayResultado[0];
                $valor_nuevoJ=$valor_anteriorJ+1;
                $base->consulta("UPDATE statisticssports.equipo
                SET
                puntos = $valor_nuevoP,
                jugados = $valor_nuevoJ
                WHERE id_equipo = $equipo1;");

                $valor_anteriorPa;
                $valor_anteriorJa;
                $valor_nuevoPa;
                $valor_nuevoJa;
                    $base->consulta("SELECT puntos,jugados
                    FROM statisticssports.equipo where id_equipo=$equipo2;");
                    while ($fila = $base->extraer_registro()) {
                        foreach ($fila as $indice => $valor) {
                            if($indice=='puntos'){
                                $valor_anteriorPa=$valor;
                            }
                            if($indice=='jugados'){
                                $valor_anteriorJa=$valor;
                            }
                        }
                    }
                $valor_nuevoPa=$valor_anteriorPa+$arrayResultado[1];
                $valor_nuevoJa=$valor_anteriorJa+1;
                $base->consulta("UPDATE statisticssports.equipo
                SET
                puntos = $valor_nuevoPa,
                jugados = $valor_nuevoJa 
                WHERE id_equipo = $equipo2;");
                    }

        
  
    }  
?>