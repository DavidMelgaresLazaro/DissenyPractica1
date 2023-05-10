<?php
    class TParquing {
        private $accessbd;

        public function __construct($accessbd) {
            $this->accessbd = $accessbd;
        }

        public function obtenirParquingsAmbBicicletes() {
            $query = "SELECT * FROM PARQUING WHERE bicicletes_disponibles > 0";
            $resultat = $this->accessbd->consulta($query);
            return $resultat;
        }

        public function obtenirParquingsNoPlens() {
            $query = "SELECT * FROM PARQUING WHERE bicicletes_disponibles < capacitat_maxima";
            $resultat = $this->accessbd->consulta($query);
            return $resultat;
        }

        public function obtenirBicicletesParquing($parquingId) {
            $query = "SELECT * FROM BICICLETA WHERE parquing_id = $parquingId";
            $resultat = $this->accessbd->consulta($query);
            return $resultat;
        }

        // Otros métodos relacionados con la gestión de parquings...

    }
?>
