<?php
    namespace Actividades\A07\P11_con_jquery\Product_app\Backend;

    use Actividades\A07\P11_con_jquery\Product_app\Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Produtcs.php';

    $datos = file_get_contents('php://input');
    $jsonOBJ = json_decode($datos);

    $producto = new Products('marketzone');
    $producto->add($jsonOBJ);
    echo $producto->getData();
?>