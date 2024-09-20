<?php
    function secuencia() {
        $impar1 = 0; $par = 0; $impar2 = 0; $M = 0;
        $found = false;
        $matriz = array();

        while (!$found) 
        {
            $impar1 = rand(10, 1000);
            $par = rand(10, 1000);
            $impar2 = rand(10, 1000);
            $M++;

            array_push($matriz, array($impar1, $par, $impar2));
            echo "<center>$impar1 $par $impar2</center>";
            
            if ($impar1%2 != 0 && $par%2 == 0 && $impar2%2 != 0)
            {
                $found = true;
            }
        }

        echo(count($matriz) * 3 . ' número obtenidos en ' . $M . ' iteraciones.');
        
    }

    function divisible($num) {
        $random = 1;

        while($random%$num != 0)
        {
            $random = rand(10, 1000);
        }

        echo "<p>El número encontrado es $random</p>";
    }

    function tabla_ASCII() {
        $abc = array();

        for($i = 97; $i <= 122; $i++)
        {
            $abc[$i] = chr($i);
        }

        echo "<table border='1'>";
        echo "<tr><th>Índice</th><th>Valor</th></tr>";
        foreach($abc as $key => $value)
        {
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    }

    function chicas($edad, $sexo) {
        if($sexo == "femenino" && $edad >= 18 && $edad <= 35)
        {
            echo "<p>Bienvenida, usted está en el rango de edad permitido.</p>";
        } 
        else 
        {
            echo "<p>No cumple con los criterios de aceptación.</p>";
        }
    }    
    
    function parque_Vehicular() {
        return array(
            'ABC1234' => array(
                'Auto' => array(
                    'Marca' => 'Toyota',
                    'Modelo' => 2020,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'Juanito',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'su casa'
                )
            ),
            'DEF5678' => array(
                'Auto' => array(
                    'Marca' => 'Honda',
                    'Modelo' => 2019,
                    'Tipo' => 'hatchback'
                ),
                'Propietario' => array(
                    'Nombre' => 'Daarick',
                    'Ciudad' => 'Lima',
                    'Dirección' => 'su casa tmb'
                )
            ),
            'GHI9101' => array(
                'Auto' => array(
                    'Marca' => 'Ford',
                    'Modelo' => 2018,
                    'Tipo' => 'camioneta'
                ),
                'Propietario' => array(
                    'Nombre' => 'Hormiga',
                    'Ciudad' => 'Parque',
                    'Dirección' => 'Hormiguero'
                )
            ),
            'JKL2345' => array(
                'Auto' => array(
                    'Marca' => 'Chevrolet',
                    'Modelo' => 2021,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'Brendon',
                    'Ciudad' => 'LA',
                    'Dirección' => 'su casa'
                )
            ),
            'MNO6789' => array(
                'Auto' => array(
                    'Marca' => 'Mazda',
                    'Modelo' => 2017,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'Dre',
                    'Ciudad' => 'Tlaxcalayork',
                    'Dirección' => 'su casita'
                )
            ),
            'PQR9999' => array(
                'Auto' => array(
                    'Marca' => 'BMW',
                    'Modelo' => 2023,
                    'Tipo' => 'hatchback'
                ),
                'Propietario' => array(
                    'Nombre' => 'Jane Doe',
                    'Ciudad' => 'D City',
                    'Dirección' => 'freedom av. 988'
                )
            ),
            'STU6789' => array(
                'Auto' => array(
                    'Marca' => 'Ford',
                    'Modelo' => 2015,
                    'Tipo' => 'camioneta'
                ),
                'Propietario' => array(
                    'Nombre' => 'Ever',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'redactado'
                )
            ),
            'VWX6789' => array(
                'Auto' => array(
                    'Marca' => 'Mercedes',
                    'Modelo' => 2077,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'V',
                    'Ciudad' => 'Night City',
                    'Dirección' => 'Chinatown'
                )
            ),
            'YXC6789' => array(
                'Auto' => array(
                    'Marca' => 'Toyota',
                    'Modelo' => 2022,
                    'Tipo' => 'camioneta'
                ),
                'Propietario' => array(
                    'Nombre' => 'Daniel',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'mi casa'
                )
            ),
            'ZZZ6789' => array(
                'Auto' => array(
                    'Marca' => 'Nissan',
                    'Modelo' => 2003,
                    'Tipo' => 'hatchback'
                ),
                'Propietario' => array(
                    'Nombre' => 'Anthony',
                    'Ciudad' => 'Lima',
                    'Dirección' => 'su casa'
                )
            ),
            'TDR2896' => array(
                'Auto' => array(
                    'Marca' => 'Audi',
                    'Modelo' => 2021,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'Alma',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'por ahi'
                )
            ),
            'JYP8827' => array(
                'Auto' => array(
                    'Marca' => 'Subaru',
                    'Modelo' => 2022,
                    'Tipo' => 'hatchback'
                ),
                'Propietario' => array(
                    'Nombre' => 'Meewis',
                    'Ciudad' => 'Mewing',
                    'Dirección' => 'su cueva'
                )
            ),
            'UKM8758' => array(
                'Auto' => array(
                    'Marca' => 'BYD',
                    'Modelo' => 2023,
                    'Tipo' => 'camioneta'
                ),
                'Propietario' => array(
                    'Nombre' => 'Pavo',
                    'Ciudad' => 'Turquía',
                    'Dirección' => 'corral'
                )
            ),
            'DCC1404' => array(
                'Auto' => array(
                    'Marca' => 'KIA',
                    'Modelo' => 2020,
                    'Tipo' => 'sedan'
                ),
                'Propietario' => array(
                    'Nombre' => 'Carlitos',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'su casita'
                )
            ),
            'SPX7999' => array(
                'Auto' => array(
                    'Marca' => 'Chevrolet',
                    'Modelo' => 1996,
                    'Tipo' => 'camioneta'
                ),
                'Propietario' => array(
                    'Nombre' => 'mi apa',
                    'Ciudad' => 'Puebla',
                    'Dirección' => 'mi cochera'
                )
            ),
        );
    }

    function mostrar_Coches($matricula = '') {
        $parqueVehicular = parque_Vehicular();

        if (!empty($matricula)) {
            if (isset($parqueVehicular[$matricula])) {
                $auto = $parqueVehicular[$matricula];
                echo "<h3>Información del vehículo con matrícula $matricula:</h3>";
                echo "<p>Marca: " . $auto['Auto']['Marca'] . "</p>";
                echo "<p>Modelo: " . $auto['Auto']['Modelo'] . "</p>";
                echo "<p>Tipo: " . $auto['Auto']['Tipo'] . "</p>";
                echo "<p>Propietario: " . $auto['Propietario']['Nombre'] . "</p>";
                echo "<p>Ciudad: " . $auto['Propietario']['Ciudad'] . "</p>";
                echo "<p>Dirección: " . $auto['Propietario']['Dirección'] . "</p>";
            } else {
                echo "<p>No se encontró ningún vehículo con esa matrícula.</p>";
            }
        } else {
            echo "<h3>Todos los vehículos registrados:</h3>";
            echo "<ul>";
            foreach ($parqueVehicular as $mat => $auto) {
                echo "<li>Matrícula: $mat - " . $auto['Auto']['Marca'] . " " . $auto['Auto']['Modelo'] . " (" . $auto['Auto']['Tipo'] . ") - Propietario: " . $auto['Propietario']['Nombre'] . "</li>";
            }
            echo "</ul>";
        }
    }
?>