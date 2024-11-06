<?php
    namespace Actividades\A07\P11_con_jquery\Product_app\Backend\Myapi;
    abstract class DataBase {
        protected $conexion;
        
        public function __construct($user, $pass, $db) {
            $this->conexion = @mysqli_connect(
                'localhost',
                $user,
                $pass,
                $db
            );

            if(!$this->conexion) {
                    die('¡Base de datos NO conextada!');
            }
        }
    }
?>