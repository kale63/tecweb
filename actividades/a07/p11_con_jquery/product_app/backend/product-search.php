<?php
    namespace Actividades\A07\P11_con_jquery\Product_app\Backend;

    use Actividades\A07\P11_con_jquery\Product_app\Backend\Myapi\Products as Products;
    require_once __DIR__.'/myapi/Produtcs.php';

    $producto = new Products('marketzone');
    $producto->search($_GET['search']);
    //echo $producto->getData();
?>