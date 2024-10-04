<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Práctica 4</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <ul>
        <li>$_myvar, $_7var, myvar, $myvar, $var7, $_element1, $house*5</li>
    </ul>
    <?php
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Inválida
        
        echo '<h4>Respuesta:</h4>';   
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dólar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>

    <h2>Ejercicio 2</h2>
    <p>Proporcionar los valores de $a, $b, $c como sigue:</p>
    <ul>
        <li>$a = "ManejadorSQL";</li>
        <li>$b = 'MySQL';</li>
        <li>$c = &amp;$a;</li>
    </ul>
    <?php
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;

        echo '<h4>Inciso A</h4>';
        echo '<p>Ahora muestra el contenido de cada variable</p>';
        echo '<p>$a: ' . $a . '</p>';
        echo '<p>$b: ' . $b . '</p>';
        echo '<p>$c: ' . $c . '</p>';

        $a = "PHP Server";
        $b = &$a;

        echo '<h4>Inciso C</h4>';
        echo '<p>Vuelve a mostrar el contenido de cada uno</p>';
        echo '<p>$a: ' . $a . '</p>';
        echo '<p>$b: ' . $b . '</p>';
        echo '<p>$c: ' . $c . '</p>';

        echo '<h4>Inciso D</h4>';
        echo '<p>Se reasignó el valor de la variable $a a "PHP Server", y ahora tanto $b como $c apuntan al mismo valor.</p>';
    ?>

    <h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente después de cada asignación:</p>
    <ul>
        <li>$a = "PHP5";</li>
        <li>$z[] = &amp;$a;</li>
        <li>$b = "5a version de PHP";</li>
        <li>$c = $b * 10;</li>
        <li>$a .= $b;</li>
        <li>$b *= $c;</li>
        <li>$z[0] = "MySQL";</li>
    </ul>
    <?php
        unset($a, $b, $c);
        $a = "PHP5";
        echo '<p>$a: ' . $a . '</p>';

        $z[] = &$a;
        echo '<pre>' . print_r($z, true) . '</pre>';

        $b = "5a version de PHP";
        echo '<p>$b: ' . $b . '</p>';

        $c = (int)$b * 10;
        echo '<p>$c: ' . $c . '</p>';

        $a .= $b;
        echo '<p>$a: ' . $a . '</p>';

        $b = (int) $b * $c;
        echo '<p>$b: ' . $b . '</p>';

        $z[0] = "MySQL";
        echo '<pre>' . print_r($z, true) . '</pre>';
    ?>

    <h2>Ejercicio 4</h2>
    <p>Lee y muestra los valores de las variables del ejercicio anterior usando $GLOBALS:</p>
    <?php
        echo '<p>$GLOBALS["a"]: ' . $GLOBALS['a'] . '</p>';
        echo '<p>$GLOBALS["b"]: ' . $GLOBALS['b'] . '</p>';
        echo '<p>$GLOBALS["c"]: ' . $GLOBALS['c'] . '</p>';
        echo '<pre>$GLOBALS["z"]: ' . print_r($GLOBALS['z'], true) . '</pre>';
    ?>

    <h2>Ejercicio 5</h2>
    <p>Dar el valor de las variables al final del script:</p>
    <?php
        unset($a, $b, $c);
        $a = "7 personas";
        $b = (int) $a;
        $a = "9E3";
        $c = (double) $a;
        echo '<p>$a: ' . $a . '</p>';
        echo '<p>$b: ' . $b . '</p>';
        echo '<p>$c: ' . $c . '</p>';
    ?>

    <h2>Ejercicio 6</h2>
    <p>Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e, y $f usando var_dump:</p>
    <?php
        $a = "0";
        $b = "TRUE";
        $c = false;
        $d = ($a || $b);
        $e = ($a && $c);
        $f = ($a xor $b);

        var_dump($a);
        var_dump($b);
        var_dump($c);
        var_dump($d);
        var_dump($e);
        var_dump($f);

        echo '<p>c: ' . var_export($c, true) . '</p>';
        echo '<p>e: ' . var_export($e, true) . '</p>';
    ?>

    <h2>Ejercicio 7</h2>
    <p>Usando $_SERVER, determina lo siguiente:</p>
    <ul>
        <li>La versión de Apache y PHP</li>
        <li>El nombre del sistema operativo del servidor</li>
        <li>El idioma del navegador</li>
    </ul>
    <?php
        echo '<p>Versión de Apache y PHP: ' . $_SERVER['SERVER_SOFTWARE'] . '</p>';
        echo '<p>Sistema operativo del servidor: ' . php_uname() . '</p>';
        echo '<p>Idioma del navegador: ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</p>';
    ?>
    <p>
        <a href="https://validator.w3.org/markup/check?uri=referer"><img
        src="https://www.w3.org/Icons/valid-xhtml11" alt="Valid XHTML 1.1" height="31" width="88" /></a>
    </p>
</body>
</html>