<?php
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
    ?>

<?php
        if(isset($_GET['numero']))
        {
            $num = $_GET['numero'];
            $random = 1;

            while($random%$num != 0)
            {
                $random = rand(10, 1000);
            }

            echo "<p>El número encontrado es $random</p>";
        }
    ?>