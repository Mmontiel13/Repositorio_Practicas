<?php
    class Cabecera { /*imprime un h1 con su estilo por defecto y su titulo*/
        private $titulo;
    
        public function __construct($title) {
            $this->titulo = $title;
        }
    
        public function graficar() {
            $estilo = 'text-align: center';
            echo '<h1 style="'.$estilo.'">'.$this->titulo.'</h1>';
        }
    }
    
    class Cuerpo { /*recibe lineas y los va insertando en el arreglo lineas y luego 
        las va mostrando*/
        private $lineas = array();
    
        public function insertar_parrafo($line) {
            $this->lineas[] = $line;
        }
    
        public function graficar() {
            for($i=0; $i<count($this->lineas); $i++) {
                echo '<p>'.$this->lineas[$i].'</p>';
            }
        }
    }
    
    class Pie {
        private $mensaje; /*recibe un mensaje y lo muestra*/
    
        public function __construct($msj) {
            $this->mensaje = $msj;
        }
    
        public function graficar() {
            $estilo = 'text-align: center';
            echo '<h4 style="'.$estilo.'">'.$this->mensaje.'</h4>';
        }
    }

    class Pagina{
        private $cabecera;
        private $cuerpo;
        private $pie;

        public function __construct($text1, $text2) {
            $this->cabecera = new Cabecera($text1);
            $this->cuerpo = new Cuerpo();
            $this->pie = new Pie($text2);
        }/*en este constructor se inician objetos de las otras clases*/

        public function insertar_cuerpo($text){
            $this->cuerpo->insertar_parrafo($text);/*como cuerpo es un objeto, se puede usar su metodo*/
        }

        public function graficar(){
            $this->cabecera->graficar();
            $this->cuerpo->graficar();
            $this->pie->graficar();
        }
    }
?>