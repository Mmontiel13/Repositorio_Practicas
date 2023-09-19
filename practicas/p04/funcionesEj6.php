<?php
 global $parqueVehicular;
 function agregarVehiculo(&$parqueVehicular, $matricula, $auto, $propietario){
    if (!isset($parqueVehicular[$matricula])) {
        $parqueVehicular[$matricula] = array(
            'Auto' => $auto,
            'Propietario' => $propietario
        );
    }
 }
?>