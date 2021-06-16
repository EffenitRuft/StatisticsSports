
<?php
/**Clase puntosclasif
Esta clase sirve para llevar la cuenta de los puntos para formar la clasificación.
 */
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

        /**
         * Constructor que toma como parámetros $numpartido,$base,$equipo1 y $equipo2
         * @param numpartido es el número del partido, se asigna al atributo privado partido
         * @param base es la base de datos, se asigna al atributo privado base
         * @param equipo1 es el equipo 1.
         * @param equipo2 es el equipo 2.
         * Posteriormente se realiza una consulta para obtener todos los datos de un partido concreto.
         * Estos datos se insertan en los valores de los atributos privados correspondientes.
         * Posteriormente se asignan los puntos correspondientes.
         * A continuación se realiza una consulta a base de datos para obtener los puntos de un equipo concreto.
         * Estos valores se guardan y finalmente se actualiza la base de datos.
         */
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
            
            $arrayResultado = [];
            $puntosF1 = $this->set1_eq1 + $this->set2_eq1 + $this->set3_eq1 + $this->set4_eq1 +$this->set5_eq1;
            $puntosF2 = $this->set1_eq2 + $this->set2_eq2 + $this->set3_eq2 + $this->set4_eq2 +$this->set5_eq2;
            if($this->set_eq1==3 &&($this->set_eq2==0 ||$this->set_eq2==1)){
                $arrayResultado= [$puntosF1,$puntosF2 ,intval($this->set_eq1),intval($this->set_eq2),1,0,0,0,0,0,0,1];
                $puntosg=3;
                $puntosp=0;
                $sets1=intval($this->set_eq1);
                $sets2=intval($this->set_eq2);
                $g3eq1=1;
                $g3eq2=0;
                $g2eq1=0;
                $g2eq2=0;
                $p1eq1=0;
                $p1eq2=0;
                $p0eq1=0;
                $p0eq2=1;
            }else if($this->set_eq2==3 &&($this->set_eq1==0 ||$this->set_eq1==1)){
                $arrayResultado= [$puntosF1,$puntosF2 ,intval($this->set_eq1),intval($this->set_eq2),0,1,0,0,0,0,1,0];
                $puntosg=0;
                $puntosp=3;
                $sets1=intval($this->set_eq1);
                $sets2=intval($this->set_eq2);
                $g3eq1=0;
                $g3eq2=1;
                $g2eq1=0;
                $g2eq2=0;
                $p1eq1=0;
                $p1eq2=0;
                $p0eq1=1;
                $p0eq2=0;
            }else if($this->set_eq1==3 && $this->set_eq2==2){
                $arrayResultado= [$puntosF1,$puntosF2 ,intval($this->set_eq1),intval($this->set_eq2),0,0,1,0,0,1,0,0];
                $puntosg=2;
                $puntosp=1;
                $sets1=intval($this->set_eq1);
                $sets2=intval($this->set_eq2);
                $g3eq1=0;
                $g3eq2=0;
                $g2eq1=1;
                $g2eq2=0;
                $p1eq1=0;
                $p1eq2=1;
                $p0eq1=0;
                $p0eq2=0;
            }else{
                $arrayResultado= [$puntosF1,$puntosF2 ,intval($this->set_eq1),intval($this->set_eq),0,0,0,1,1,0,0,0];
                $puntosg=1;
                $puntosp=2;
                $sets1=intval($this->set_eq1);
                $sets2=intval($this->set_eq2);
                $g3eq1=0;
                $g3eq2=0;
                $g2eq1=0;
                $g2eq2=1;
                $p1eq1=1;
                $p1eq2=0;
                $p0eq1=0;
                $p0eq2=0;
            }
            echo json_encode($arrayResultado);

            $valor_anteriorP;
            $valor_anteriorJ;
            $valor_anteriorPF;
            $valor_anteriorPF;
            $valor_anteriorSC;
            $valor_anteriorSF;
            $valor_anteriorG3;
            $valor_anteriorG2;
            $valor_anteriorP1;
            $valor_anteriorP0;

            $valor_nuevoP;
            $valor_nuevoJ;
            $valor_nuevoPC;
            $valor_nuevoPF;
            $valor_nuevoSC;
            $valor_nuevoSF;
            $valor_nuevoG3;
            $valor_nuevoG2;
            $valor_nuevoP1;
            $valor_nuevoP0;
                $base->consulta("SELECT puntos,jugados,puntos_contra,puntos_favor,set_contra,set_favor,G3,G2,P1,P0
                FROM statisticssports.equipo where id_equipo=$equipo1;");
                while ($fila = $base->extraer_registro()) {
                    foreach ($fila as $indice => $valor) {
                        if($indice=='puntos'){
                            $valor_anteriorP=$valor;
                        }
                        if($indice=='jugados'){
                            $valor_anteriorJ=$valor;
                        }
                        if($indice=='puntos_contra'){
                            $valor_anteriorPC=$valor;
                        }
                        if($indice=='puntos_favor'){
                            $valor_anteriorPF=$valor;
                        }
                        if($indice=='set_contra'){
                            $valor_anteriorSC=$valor;
                        }
                        if($indice=='set_favor'){
                            $valor_anteriorSF=$valor;
                        }
                        if($indice=='G3'){
                            $valor_anteriorG3=$valor;
                        }
                        if($indice=='G2'){
                            $valor_anteriorG2=$valor;
                        }
                        if($indice=='P1'){
                            $valor_anteriorP1=$valor;
                        }
                        if($indice=='P0'){
                            $valor_anteriorP2=$valor;
                        }
                    }
                }
                $valor_nuevoP=$valor_anteriorP+$puntosg;
                $valor_nuevoJ=$valor_anteriorJ+1;
                $valor_nuevoPC= $valor_anteriorPC + $puntosF2;
                $valor_nuevoPF= $valor_anteriorPF + $puntosF1;
                $valor_nuevoSC = $valor_anteriorSC + $sets2;
                $valor_nuevoSF = $valor_anteriorSF + $sets1;
                $valor_nuevoG3 = $valor_anteriorG3 + $g3eq1;
                $valor_nuevoG2 = $valor_anteriorG2 + $g2eq2;
                $valor_nuevoP1 = $valor_anteriorP1 + $p1eq1;
                $valor_nuevoP0 = $valor_anteriorP0 + $p0eq1;
;
                $base->consulta("UPDATE statisticssports.equipo
                SET
                puntos = $valor_nuevoP,
                puntos_contra = $valor_nuevoPC,
                puntos_favor = $valor_nuevoPF,
                set_contra = $valor_nuevoSC,
                set_favor = $valor_nuevoSF,
                G3 = $valor_nuevoG3,
                G2 = $valor_nuevoG2,
                P1 = $valor_nuevoP1,
                P0 = $valor_nuevoP0,
                jugados = $valor_nuevoJ
                WHERE id_equipo = $equipo1;");

                $valor_anteriorPa;
                $valor_anteriorJa;
                $valor_anteriorPFa;
                $valor_anteriorPFa;
                $valor_anteriorSCa;
                $valor_anteriorSFa;
                $valor_anteriorG3a;
                $valor_anteriorG2a;
                $valor_anteriorP1a;
                $valor_anteriorP0a;

                $valor_nuevoPa;
                $valor_nuevoJa;
                $valor_nuevoPFa;
                $valor_nuevoPFa;
                $valor_nuevoSCa;
                $valor_nuevoSFa;
                $valor_nuevoG3a;
                $valor_nuevoG2a;
                $valor_nuevoP1a;
                $valor_nuevoP0a;
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
                            if($indice=='puntos_contra'){
                                $valor_anteriorPCa=$valor;
                            }
                            if($indice=='puntos_favor'){
                                $valor_anteriorPFa=$valor;
                            }
                            if($indice=='set_contra'){
                                $valor_anteriorSCa=$valor;
                            }
                            if($indice=='set_favor'){
                                $valor_anteriorSFa=$valor;
                            }
                            if($indice=='G3'){
                                $valor_anteriorG3a=$valor;
                            }
                            if($indice=='G2'){
                                $valor_anteriorG2a=$valor;
                            }
                            if($indice=='P1'){
                                $valor_anteriorP1a=$valor;
                            }
                            if($indice=='P0'){
                                $valor_anteriorP2a=$valor;
                            }
                        }
                    }
                $valor_nuevoPa=$valor_anteriorPa+$puntosp;
                $valor_nuevoJa=$valor_anteriorJa+1;
                $valor_nuevoPCa= $valor_anteriorPCa + $puntosF1;
                $valor_nuevoPFa= $valor_anteriorPFa + $puntosF2;
                $valor_nuevoSCa = $valor_anteriorSCa + $sets1;
                $valor_nuevoSFa = $valor_anteriorSFa + $sets2;
                $valor_nuevoG3a = $valor_anteriorG3a + $g3eq2;
                $valor_nuevoG2a = $valor_anteriorG2a + $g2eq2;
                $valor_nuevoP1a = $valor_anteriorP1a + $p1eq2;
                $valor_nuevoP0a = $valor_anteriorP0a + $p0eq2;
                $base->consulta("UPDATE statisticssports.equipo
                SET
                puntos = $valor_nuevoPa,
                puntos_contra = $valor_nuevoPCa,
                puntos_favor = $valor_nuevoPFa,
                set_contra = $valor_nuevoSCa,
                set_favor = $valor_nuevoSFa,
                G3 = $valor_nuevoG3a,
                G2 = $valor_nuevoG2a,
                P1 = $valor_nuevoP1a,
                P0 = $valor_nuevoP0a,
                jugados = $valor_nuevoJa 
                WHERE id_equipo = $equipo2;");
                    }

        
  
    }  
?>