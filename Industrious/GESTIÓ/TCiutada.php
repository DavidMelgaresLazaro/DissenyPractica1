<?php
    class TCiutada {
        private $accessbd;

        public function __construct($accessbd) {
            $this->accessbd = $accessbd;
        }

        public function obtenirBicicletesAgafades() {
            $query = "SELECT * FROM BICICLETA WHERE estat = 'Agafada'";
            $resultat = $this->accessbd->consulta($query);
            return $resultat;
        }

        function obtenerOpcionesCiutada() {
            $query = "SELECT DNI, nom FROM ciutada";
            $resultado = mysqli_query($conexion, $query);
            $opciones = array();
            while ($fila = mysqli_fetch_assoc($resultado)) {
                $opciones[$fila['DNI']] = $fila['nom'];
             }

        }

        // Otros métodos relacionados con la gestión de bicicletas...

    }
?>
