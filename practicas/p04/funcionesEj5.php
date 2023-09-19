<?php
 function ejercicio5($edad, $sexo){
    if ($sexo === 'femenino' && $edad >= 18 && $edad <= 35) {
        echo '<p>Bienvenida, usted está en el rango de edad permitido.</p>';
    } else {
        echo '<p>No se pudo acceder no cumple los requisitos.</p>';
    }
 }
?>

