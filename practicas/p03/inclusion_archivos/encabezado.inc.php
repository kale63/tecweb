<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<?php
    $variable1="PHP 5";
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8" />
        <?php
            echo "<title>Una página que contiene muchas inclusiones $variable</title>";
        ?>
    </head>
    <body>
        <?php
            $variableext = "Este texto proviene del archivo incluido";
            echo "<div><h1 style=\"border-width:5;border-style:double;background-color:#ffcc99;\">
            Bienvenido en el sitio $variableext</h1>";
            echo "<h3> $variableext</h3>";
            echo "Nombre de archivo ejecutado: ", $_SERVER['PHP_SELF'],"&nbsp;&nbsp;&nbsp";
            echo " Nombre del archivo incluido: ", __FILE__,"</div>";
        ?>