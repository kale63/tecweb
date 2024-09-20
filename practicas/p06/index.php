<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 6</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>
    <?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            if ($num%5==0 && $num%7==0)
            {
                echo '<h3>R= El número '.$num.' SÍ es múltiplo de 5 y 7.</h3>';
            }
            else
            {
                echo '<h3>R= El número '.$num.' NO es múltiplo de 5 y 7.</h3>';
            }
        }
    ?>

    <h2>Ejemplo de POST</h2>
    <form action="http://localhost/tecweb/tecweb/practicas/p06/index.php" method="post">
        Name: <input type="text" name="name"><br>
        E-mail: <input type="text" name="email"><br>
        <input type="submit">
    </form>
    <br>
    <?php
        if(isset($_POST["name"]) && isset($_POST["email"]))
        {
            echo $_POST["name"];
            echo '<br>';
            echo $_POST["email"];
        }
    ?>

    <h2>Ejercicio 2</h2>
    <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una
    secuencia compuesta por:<br><center>impar, par, impar</center></p>
    <?php
        include 'src/funciones.php';

        secuencia();
    ?>

    <h2>Ejercicio 3</h2>
    <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente,
    pero que además sea múltiplo de un número dado.</p>
    <?php
        if(isset($_GET['numero'])) {
            divisible($_GET['numero']); 
        }
    ?>

    <h2>Ejercicio 4</h2>
    <p>Crear un arreglo cuyos índices van de 97 a 122 y cuyos valores son las letras de la 'a'
    a la 'z'.</p>
    <?php
       tabla_ASCII();
    ?>

    <h2>Ejercicio 5</h2>
    <p>Usar las variables $edad y $sexo en una instrucción if para identificar una persona de
    sexo "femenino", cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de
    bienvenida apropiado.</p>
    <form action="http://localhost/tecweb/tecweb/practicas/p06/index.php" method="post">
        Edad: <input type="number" name="age"><br>
        <label for="sexo">Sexo:</label>
        <select id="sexo" name="gender" required>
            <option value="">Seleccione</option>
            <option value="femenino">Femenino</option>
            <option value="masculino">Masculino</option>
        </select><br><br>
        <input type="submit">
    </form>
    <?php
        if($_SERVER["REQUEST_METHOD"] == "POST") 
        {
            if(isset($_POST['age']) && isset($_POST['gender'])) 
            {
                $edad = $_POST['age'];
                $sexo = $_POST['gender'];
    
                chicas($edad, $sexo);
            } 
        }
    ?>
    
    <h2>Ejercicio 6</h2>
    <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de
    una ciudad. Cada vehículo debe ser identificado por:</p>
    <p><ul>
        <li>Matrícula</li>
        <li>Auto (Marca, Modelo, Tipo)</li>
        <li>Propietario (Nombre, Ciudad, Dirección)</li>
    </ul></p>
    <p>La matrícula debe tener el siguiente formato LLLNNNN, donde las L pueden ser letras de
    la A-Z y las N pueden ser números de 0-9.</p>
    
    <h3>Consulta el parque vehicular</h3>
    <p>Ingresa una matrícula o consulta el parque vehicular completo.</p>
    <form method="POST" action="">
        Buscar por matrícula: <input type="text" id="matricula" name="matricula" placeholder="Ingresa matrícula">
        <br><br>
        <input type="submit" value="Buscar">
    </form>
    <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['matricula'])) {
            $matricula = isset($_POST['matricula']);
            mostrar_Coches($matricula);
        }
    ?>
</body>
</html>