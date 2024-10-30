<?php
    include('database.php');
   
    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        
        $sql = "SELECT * FROM productos WHERE id = {$id}";
        $result = mysqli_query($conexion, $sql);
        if ( $conexion->query($sql) ) {
            $json = array();
            while($row = mysqli_fetch_array($result)){
                $json[] = array(
                    'id' => $row['id'],
                    'nombre' => $row['nombre'],
                    'precio' => $row['precio'],
                    'unidades' => $row['unidades'],
                    'modelo' => $row['modelo'],
                    'marca' => $row['marca'],
                    'detalles' => $row['detalles'],
                    'imagen' => $row['imagen']
                );
            }
		} else {
            die('bad query >:[');
        }
		$conexion->close();
    } 
    
    echo json_encode($json[0], JSON_PRETTY_PRINT);
?>