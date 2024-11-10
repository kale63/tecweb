<?php
    namespace Actividades\A07\P11_con_jquery\Product_app\Backend\Myapi;

    use Actividades\A07\P11_con_jquery\Product_app\Backend\Myapi\DataBase;
    require_once __DIR__.'/DataBase.php';

    class Products extends DataBase{
        private $data = NULL;
        public function __construct($db, $user='root', $pass='californication'){
            $this->data = array();
            parent::__construct($db,$user,$pass);
        }

        public function add($jsonOBJ){
            $data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(!empty($jsonOBJ)) {
                
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                    if($this->conexion->query($sql)){
                        $data['status'] =  "success";
                        $data['message'] =  "Producto agregado";
                    } else {
                        $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }

                $result->free();
                // Cierra la conexion
                $this->conexion->close();
            }

            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $data;
        }

        public function  delete($art){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $data = array(
                'status'  => 'error',
                'message' => 'La consulta falló'
            );
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($art) ) {
                $id = $art;
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "UPDATE productos SET eliminado=1 WHERE id = {$id}";
                if ( $this->conexion->query($sql) ) {
                    $data['status'] =  "success";
                    $data['message'] =  "Producto eliminado";
                } else {
                    $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $data;
        }

        public function edit($jsonOBJ){
            $data = array(
                'status'  => 'error',
                'message' => 'Ya existe un producto con ese nombre'
            );
            if(!empty($jsonOBJ)) {
                
                // SE ASUME QUE LOS DATOS YA FUERON VALIDADOS ANTES DE ENVIARSE
                $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND id != '{$jsonOBJ->id}'AND eliminado = 0";
                $result = $this->conexion->query($sql);
                
                if ($result->num_rows == 0) {
                    $this->conexion->set_charset("utf8");
                    $sql = "UPDATE productos SET nombre = '{$jsonOBJ->nombre}', marca = '{$jsonOBJ->marca}', modelo = '{$jsonOBJ->modelo}', precio = {$jsonOBJ->precio}, detalles = '{$jsonOBJ->detalles}', unidades = {$jsonOBJ->unidades}, imagen = '{$jsonOBJ->imagen}' WHERE id = '{$jsonOBJ->id}'";
                    if($this->conexion->query($sql)){
                        $data['status'] =  "success";
                        $data['message'] =  "Producto actualizado";
                    } else {
                        $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($this->conexion);
                    }
                }
        
                $result->free();
                // Cierra la conexion
                $this->conexion->close();
            }
        
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $data;
        }

        public function list(){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $data = array();

            // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
            if ( $result = $this->conexion->query("SELECT * FROM productos WHERE eliminado = 0") ) {
                // SE OBTIENEN LOS RESULTADOS
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $data[$num][$key] = $value;
                        }
                    }
                }
                $result->free();
            } else {
                die('Query Error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $data;
        }

        public function search($search){
            // SE CREA EL ARREGLO QUE SE VA A DEVOLVER EN FORMA DE JSON
            $data = array();
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($search) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
                if ( $result = $this->conexion->query($sql) ) {
                    // SE OBTIENEN LOS RESULTADOS
                    $rows = $result->fetch_all(MYSQLI_ASSOC);

                    if(!is_null($rows)) {
                        // SE CODIFICAN A UTF-8 LOS DATOS Y SE MAPEAN AL ARREGLO DE RESPUESTA
                        foreach($rows as $num => $row) {
                            foreach($row as $key => $value) {
                                $data[$num][$key] = $value;
                            }
                        }
                    }
                    $result->free();
                } else {
                    die('Query Error: '.mysqli_error($this->conexion));
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $data;
        }

        public function single($art){
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($art) ) {
                $id = $art;
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE id = {$id}";
                $result = mysqli_query($this->conexion, $sql);
                if ( $this->conexion->query($sql) ) {
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
                    die('Query fallida');
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $json[0];
        }

        public function singleByName($name){
            // SE VERIFICA HABER RECIBIDO EL ID
            if( isset($name) ) {
                // SE REALIZA LA QUERY DE BÚSQUEDA Y AL MISMO TIEMPO SE VALIDA SI HUBO RESULTADOS
                $sql = "SELECT * FROM productos WHERE nombre = '{$name}' AND eliminado = 0";
                $result = mysqli_query($this->conexion, $sql);
                if ( $this->conexion->query($sql) ) {
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
                    die('Query fallida');
                }
                $this->conexion->close();
            } 
            
            // SE HACE LA CONVERSIÓN DE ARRAY A JSON
            $this->data = $json[0];
        }

        public function getData(){
            return json_encode($this->data,JSON_PRETTY_PRINT);
        }
    }

?>