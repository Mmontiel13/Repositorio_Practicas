<?php
class Tabla{ /*la idea es crear una tabla, y la forma en que se guardaran los datos sera en una matriz*/
    private $matriz = array(); /*arreglo vacio*/
    private $numFilas;
    private $numColumnas;
    private $estilo;

    public function __construct($rows, $cols, $style){
        $this->numFilas = $rows;
        $this->numColumnas = $cols;
        $this->estilo = $style;
    }

    public function cargar($row, $col, $val){
        $this->matriz[$row][$col] = $val; /*se da a entender que matriz es un arreglo bidimensional
        pero esto funciona gracias a que es php*/
    }
/*internamente, el usuario solo usa los publics pero el sistema puede usar otros para completar el trabaj*/
    private function inicio_tabla(){
        echo '<table style=" '.$this->estilo.'">';
    }

    private function inicio_fila(){
        echo '<tr>';
    }

    private function mostrar_dato($row, $col){
        echo '<td style="'.$this->estilo.'">'.
            $this->matriz[$row][$col].'</td>'; /*en esta columna se pone el valor de acuerdo al row y col 
            recibidos*/
    }

    private function fin_fila(){
        echo '</tr>';
    }

    private function fin_tabla(){
        echo '</table>';
    }

    public function graficar(){
        $this->inicio_tabla(); /*hace un echo '<table>'*/
        for ($i=0; $i < $this->numFilas; $i++){
            $this->inicio_fila();
            for($j=0; $j<$this->numColumnas; $j++){
                $this->mostrar_dato($i,$j);
            }
            $this->fin_fila();
        }
        $this->fin_tabla();
    }
}
?>