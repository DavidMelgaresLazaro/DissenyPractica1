<?php
    require_once('TAccessbd.php');
    require_once('TCiutada.php');
    require_once('TParquing.php');
    require_once('TBicicleta.php');

    class TControl {
        private $accessbd;

        public function __construct() {
            $this->accessbd = new TAccessbd();
        }

        public function mostrarMensaje($mensaje) {
            echo "<p>$mensaje</p>";
        }

        // Métodos para la opción "Agafar bicicleta"
        public function obtenirCiutadansSenseBicicleta() {
            $ciutada = new TCiutada($this->accessbd);
            return $ciutada->obtenirCiutadansSenseBicicleta();
        }

        public function obtenirParquingsAmbBicicletes() {
            $parquing = new TParquing($this->accessbd);
            return $parquing->obtenirParquingsAmbBicicletes();
        }

        // Métodos para la opción "Tornar una bicicleta"
        public function obtenirCiutadansAmbBicicleta() {
            $ciutada = new TCiutada($this->accessbd);
            return $ciutada->obtenirCiutadansAmbBicicleta();
        }

        public function obtenirParquingsNoPlens() {
            $parquing = new TParquing($this->accessbd);
            return $parquing->obtenirParquingsNoPlens();
        }

        // Métodos para la opción "Llistat de bicicletes agafades"
        public function obtenirBicicletesAgafades() {
            $bicicleta = new TBicicleta($this->accessbd);
            return $bicicleta->obtenirBicicletesAgafades();
        }

        // Métodos para la opción "Llistat de bicicletes a un pàrquing"
        public function obtenirBicicletesParquing($parquingId) {
            $parquing = new TParquing($this->accessbd);
            return $parquing->obtenirBicicletesParquing($parquingId);
        }
    }
?>