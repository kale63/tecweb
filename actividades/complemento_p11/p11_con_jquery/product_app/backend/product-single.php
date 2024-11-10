<?php
    include_once __DIR__.'/database.php';

    // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
    $data = array();

    if( isset($_POST['id']) ) {
        $id = $_POST['id'];
        // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
        if ( $result = $conexion->query("SELECT * FROM productos WHERE id = {$id}") ) {
            // SE OBTIENEN LOS RESULTADOS
            $row = $result->fetch_assoc();

            if(!is_null($row)) {
                // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                foreach($row as $key => $value) {
                    $data[$key] = utf8_encode($value);
                }
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }
        $conexion->close();
    }
    
    $data = array();
            if(isset($name) && !empty($name)) {
                error_log("Valor de name: " . $name);
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre LIKE '%{$name}%' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                if($result->num_rows > 0){
                    $data['status'] =  "error";
                    $data['message'] =  "Ya existe un producto con ese nombre";
                }else{
                    $data['status'] =  "success";
                    $data['message'] =  "Nombre de producto aceptado";
                }

    // SE HACE LA CONVERSIÓN DE ARRAY A JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>