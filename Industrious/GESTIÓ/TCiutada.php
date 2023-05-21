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

        // Otros métodos relacionados con la gestión de bicicletas...

    }
?>
