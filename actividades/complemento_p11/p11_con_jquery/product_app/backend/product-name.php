<?php
include_once __DIR__.'/database.php';

$response = ['exists' => false];  // Default a que no existe

if (isset($_GET['name'])) {
    $name = $_GET['name'];
    
    // Consulta SQL para verificar si el nombre ya existe
    $sql = "SELECT COUNT(*) as count FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
    $result = $conexion->query($sql);
    
    if ($result) {
        $row = $result->fetch_assoc();
        
        // Si el conteo es mayor que 0, el nombre ya existe
        if ($row['count'] > 0) {
            $response['exists'] = true;
        }
    } else {
        error_log("Query Error: " . mysqli_error($conexion));
    }
    
    $conexion->close();
}

    header('Content-Type: application/json');
    echo json_encode($response);
?>
