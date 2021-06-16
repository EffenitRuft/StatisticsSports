
<?php
/**Clase jugadornuevo
Esta clase sirve para obtener el nombre y el puesto de un jugador a partir de su id de jugador y el id de equipo
y crear el nuevo registro de jugador.
 */
    class jugadornuevo{       
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
         * Constructor que toma como parámetros $idjug,$ideq,$idpartido,$idset y $base
         * @param idjug es el id del jugador
         * @param ideq es el id del equipo
         * @param idpartido es el id del partido
         * @param idset es id del set.
         * @param base es la base de datos.
         * Posteriormente se lanza una consulta SQL a base de datos para obtener el nombre
         * y el puesto de un jugador según su id de jugador y el id del equipo.
         * A continuación se asignan los valores obtenidos a las variables.
         * Después se crea el jugador en la base de datos.
         */
        function __construct($idjug,$ideq,$idpartido,$idset,$base) {
            $nombrejug='hola';
            $puestojug='adios';
            $base->consulta("SELECT nombre, puesto FROM statisticssports.jugadorbase where idjugadorbase=$idjug and id_equipo = $ideq;");
            while ($fila = $base->extraer_registro()) {
                foreach ($fila as $indice => $valor) {
                    if($indice=="nombre"){
                        $nombrejug=$valor;
                    }
                    if($indice=="puesto"){
                        $puestojug=$valor;
                    }
                }
            }
            $base->consulta("INSERT INTO statisticssports.jugador 
            VALUES ($idjug,'$nombrejug',$ideq,'$puestojug',0,0,0,0,0,0,0,0,0,0,0,0,$idpartido,$idset);");
            
        }

    }  
?>