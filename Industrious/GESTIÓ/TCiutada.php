<?php
    class TCiutada {
        private $abd;

        public function __construct($host,$username,$password,$database,$port) {
            $var_abd = new taccesbd($host,$username,$password,$database,$port);
            $this->abd = $var_abd;
            $this->abd->connectar_BD();
        }

        public function obtenirBicicletesAgafades() {
            $query = "SELECT * FROM BICICLETA WHERE estat = 'Agafada'";
            $resultat = $this->accessbd->consulta($query);
            return $resultat;
        }
        public function llistatUsuarisFree()
        {
            $res = 0;
            $res = $this->llistaUsuaris("SELECT DNI,nom,telefon FROM ciutada WHERE DNI not in ( SELECT DNICiutada FROM bicicleta where DNICiutada is not null) ");            
            return $res;
        }

        public function llistaUsuaris($SQL)
        {
            $res = false;
            if ($this->abd->consulta_SQL($SQL))
            { 
                $fila = $this->abd->consulta_fila();
                if ($fila == null)
                {
                    $res = "<br><h2>Ciudadns amb bici.</h2><br>";
                }
                else
                {
                    $res = "<select  name='DNI'> ";
                    while ($fila != null)
                    {
                        $DNI = $this->abd->consulta_dada('DNI');
                        $nom = $this->abd->consulta_dada('nom'); 
                        $telefon = $this->abd->consulta_dada('telefon');
                        
                        $res = $res . "<option value='" . $DNI . "'>";
                        $res = $res . "DNI=$DNI - nom=$nom - telefon=$telefon  </option>";
                        $fila = $this->abd->consulta_fila();
                    }
                    $res = $res . "</select>";
                }
                $this->abd->tancar_consulta();
            }
            return $res;
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
