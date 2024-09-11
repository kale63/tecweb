<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <p>$a = “ManejadorSQL”;</p>
    <p>$b = 'MySQL';</p>
    <p>$c = &$a;</p>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo '<h4>Inciso A</h4>';
        echo '<p>Ahora muestra el contenido de cada variable </p>';
        echo '$a: ', $a, '<br>';
        echo '$b: ', $b, '<br>';
        echo '$c: ', $c, '<br>';

        //inciso b
        $a = "PHP Server";
        $b = &$a;

        echo '<h4>Inciso C</h4>';
        echo '<p>Vuelve a mostrar el contenido de cada uno</p>';
        echo '$a: ', $a, '<br>';
        echo '$b: ', $b, '<br>';
        echo '$c: ', $c, '<br>';

        echo '<h4>Inciso D</h4>';
        echo '<p>Se reasignó el valor de la variable $a a "PHP Server", además $b pasó a estar asignada el valor de $a al igual que la variable $c, por lo que ahora todas tienen el valor de $a.</p>';
        
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación, 
    verificar la evolución del tipo de estas variables (imprime todos los componentes de los 
    arreglo): </p>
    <p>$a = “PHP5”; </p>
    <p>$z[] = &$a; </p>
    <p>$b = “5a version de PHP”;</p>
    <p>$c = $b*10;</p>
    <p>$a .= $b;</p>
    <p>$b *= $c; </p>
    <p>$z[0] = “MySQL”;</p>
    <?php
    $a = "PHP5";
    echo '$a: ', $a, '<br>';

    $z[] = &$a;
    echo '$z: ', $z[0], '<br>';

    $b = "5a version de PHP";
    echo '$b: ', $b, '<br>';

    $c = $b * 10;
    echo '$c: ', $c, '<br>';

    $a .= $b;
    echo '$a: ', $a, '<br>';

    $b *= $c;
    echo '$b: ', $b, '<br>';

    $z[0] = "MySQL";
    echo '$z: ', $z[0], '<br>'; 
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de 
    la matriz  $GLOBALS o del modificador global de PHP. </p>
    <?php
    echo '$GLOBALS["a"]: ', $GLOBALS['a'], '<br>';
    echo '$GLOBALS["b"]: ', $GLOBALS['b'], '<br>';
    echo '$GLOBALS["c"]: ', $GLOBALS['c'], '<br>';
    echo '$GLOBALS["z"]: ', print_r($GLOBALS['z'], true), '<br>';
    ?>

</body>
</html>