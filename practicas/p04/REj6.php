<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 4</title>
</head>
<body>
    <?php
        include('funcionesEj6.php');
        //registros
        // Registro 1
            $matricula1 = "ABC1234";
            $marca1 = "Marca1";
            $modelo1 = "Modelo1";
            $tipo1 = "sedan";
            $propietarioNombre1 = "Propietario1";
            $ciudad1 = "Ciudad1";
            $direccion1 = "Dirección1";

            $auto1 = array(
                'Marca' => $marca1,
                'Modelo' => $modelo1,
                'Tipo' => $tipo1
            );

            $propietario1 = array(
                'Nombre' => $propietarioNombre1,
                'Ciudad' => $ciudad1,
                'Direccion' => $direccion1
            );

            agregarVehiculo($parqueVehicular, $matricula1, $auto1, $propietario1);

            // Registro 2
            $matricula2 = "XYZ5678";
            $marca2 = "Marca2";
            $modelo2 = "Modelo2";
            $tipo2 = "hachback";
            $propietarioNombre2 = "Propietario2";
            $ciudad2 = "Ciudad2";
            $direccion2 = "Dirección2";

            $auto2 = array(
                'Marca' => $marca2,
                'Modelo' => $modelo2,
                'Tipo' => $tipo2
            );

            $propietario2 = array(
                'Nombre' => $propietarioNombre2,
                'Ciudad' => $ciudad2,
                'Direccion' => $direccion2
            );

            agregarVehiculo($parqueVehicular, $matricula2, $auto2, $propietario2);

            // Registro 3
            $matricula3 = "123ABCD";
            $marca3 = "Marca3";
            $modelo3 = "Modelo3";
            $tipo3 = "camioneta";
            $propietarioNombre3 = "Propietario3";
            $ciudad3 = "Ciudad3";
            $direccion3 = "Dirección3";

            $auto3 = array(
                'Marca' => $marca3,
                'Modelo' => $modelo3,
                'Tipo' => $tipo3
            );

            $propietario3 = array(
                'Nombre' => $propietarioNombre3,
                'Ciudad' => $ciudad3,
                'Direccion' => $direccion3
            );

            agregarVehiculo($parqueVehicular, $matricula3, $auto3, $propietario3);

            // Registro 4
            $matricula4 = "EFG5678";
            $marca4 = "Marca4";
            $modelo4 = "Modelo4";
            $tipo4 = "sedan";
            $propietarioNombre4 = "Propietario4";
            $ciudad4 = "Ciudad4";
            $direccion4 = "Dirección4";

            $auto4 = array(
                'Marca' => $marca4,
                'Modelo' => $modelo4,
                'Tipo' => $tipo4
            );

            $propietario4 = array(
                'Nombre' => $propietarioNombre4,
                'Ciudad' => $ciudad4,
                'Direccion' => $direccion4
            );

            agregarVehiculo($parqueVehicular, $matricula4, $auto4, $propietario4);

            // Registro 5
            $matricula5 = "HIJ9012";
            $marca5 = "Marca5";
            $modelo5 = "Modelo5";
            $tipo5 = "hachback";
            $propietarioNombre5 = "Propietario5";
            $ciudad5 = "Ciudad5";
            $direccion5 = "Dirección5";

            $auto5 = array(
                'Marca' => $marca5,
                'Modelo' => $modelo5,
                'Tipo' => $tipo5
            );

            $propietario5 = array(
                'Nombre' => $propietarioNombre5,
                'Ciudad' => $ciudad5,
                'Direccion' => $direccion5
            );

            agregarVehiculo($parqueVehicular, $matricula5, $auto5, $propietario5);

            // Registro 6
            $matricula6 = "KLM3456";
            $marca6 = "Marca6";
            $modelo6 = "Modelo6";
            $tipo6 = "camioneta";
            $propietarioNombre6 = "Propietario6";
            $ciudad6 = "Ciudad6";
            $direccion6 = "Dirección6";

            $auto6 = array(
                'Marca' => $marca6,
                'Modelo' => $modelo6,
                'Tipo' => $tipo6
            );

            $propietario6 = array(
                'Nombre' => $propietarioNombre6,
                'Ciudad' => $ciudad6,
                'Direccion' => $direccion6
            );

            agregarVehiculo($parqueVehicular, $matricula6, $auto6, $propietario6);

            // Registro 7
            $matricula7 = "NOP7890";
            $marca7 = "Marca7";
            $modelo7 = "Modelo7";
            $tipo7 = "sedan";
            $propietarioNombre7 = "Propietario7";
            $ciudad7 = "Ciudad7";
            $direccion7 = "Dirección7";

            $auto7 = array(
                'Marca' => $marca7,
                'Modelo' => $modelo7,
                'Tipo' => $tipo7
            );

            $propietario7 = array(
                'Nombre' => $propietarioNombre7,
                'Ciudad' => $ciudad7,
                'Direccion' => $direccion7
            );

            agregarVehiculo($parqueVehicular, $matricula7, $auto7, $propietario7);

            // Registro 8
            $matricula8 = "QRS2345";
            $marca8 = "Marca8";
            $modelo8 = "Modelo8";
            $tipo8 = "hachback";
            $propietarioNombre8 = "Propietario8";
            $ciudad8 = "Ciudad8";
            $direccion8 = "Dirección8";

            $auto8 = array(
                'Marca' => $marca8,
                'Modelo' => $modelo8,
                'Tipo' => $tipo8
            );

            $propietario8 = array(
                'Nombre' => $propietarioNombre8,
                'Ciudad' => $ciudad8,
                'Direccion' => $direccion8
            );

            agregarVehiculo($parqueVehicular, $matricula8, $auto8, $propietario8);

            // Registro 9
            $matricula9 = "TUV1234";
            $marca9 = "Marca9";
            $modelo9 = "Modelo9";
            $tipo9 = "camioneta";
            $propietarioNombre9 = "Propietario9";
            $ciudad9 = "Ciudad9";
            $direccion9 = "Dirección9";

            $auto9 = array(
                'Marca' => $marca9,
                'Modelo' => $modelo9,
                'Tipo' => $tipo9
            );

            $propietario9 = array(
                'Nombre' => $propietarioNombre9,
                'Ciudad' => $ciudad9,
                'Direccion' => $direccion9
            );

            agregarVehiculo($parqueVehicular, $matricula9, $auto9, $propietario9);

            // Registro 10
            $matricula10 = "WXYZ5678";
            $marca10 = "Marca10";
            $modelo10 = "Modelo10";
            $tipo10 = "sedan";
            $propietarioNombre10 = "Propietario10";
            $ciudad10 = "Ciudad10";
            $direccion10 = "Dirección10";

            $auto10 = array(
                'Marca' => $marca10,
                'Modelo' => $modelo10,
                'Tipo' => $tipo10
            );

            $propietario10 = array(
                'Nombre' => $propietarioNombre10,
                'Ciudad' => $ciudad10,
                'Direccion' => $direccion10
            );

            agregarVehiculo($parqueVehicular, $matricula10, $auto10, $propietario10);

            // Registro 11
            $matricula11 = "UVW1234";
            $marca11 = "Marca11";
            $modelo11 = "Modelo11";
            $tipo11 = "hachback";
            $propietarioNombre11 = "Propietario11";
            $ciudad11 = "Ciudad11";
            $direccion11 = "Dirección11";

            $auto11 = array(
                'Marca' => $marca11,
                'Modelo' => $modelo11,
                'Tipo' => $tipo11
            );

            $propietario11 = array(
                'Nombre' => $propietarioNombre11,
                'Ciudad' => $ciudad11,
                'Direccion' => $direccion11
            );

            agregarVehiculo($parqueVehicular, $matricula11, $auto11, $propietario11);

            // Registro 12
            $matricula12 = "XYZ9876";
            $marca12 = "Marca12";
            $modelo12 = "Modelo12";
            $tipo12 = "camioneta";
            $propietarioNombre12 = "Propietario12";
            $ciudad12 = "Ciudad12";
            $direccion12 = "Dirección12";

            $auto12 = array(
                'Marca' => $marca12,
                'Modelo' => $modelo12,
                'Tipo' => $tipo12
            );

            $propietario12 = array(
                'Nombre' => $propietarioNombre12,
                'Ciudad' => $ciudad12,
                'Direccion' => $direccion12
            );

            agregarVehiculo($parqueVehicular, $matricula12, $auto12, $propietario12);

            // Registro 13
            $matricula13 = "LOL9876";
            $marca13 = "Marca13";
            $modelo13 = "Modelo13";
            $tipo13 = "camioneta";
            $propietarioNombre13 = "Propietario13";
            $ciudad13 = "Ciudad13";
            $direccion13 = "Dirección13";

            $auto13 = array(
                'Marca' => $marca13,
                'Modelo' => $modelo13,
                'Tipo' => $tipo13
            );

            $propietario13 = array(
                'Nombre' => $propietarioNombre13,
                'Ciudad' => $ciudad13,
                'Direccion' => $direccion13
            );

            agregarVehiculo($parqueVehicular, $matricula13, $auto13, $propietario13);

    ?>
</body>
</html>