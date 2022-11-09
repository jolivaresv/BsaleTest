<?PHP
require_once 'Conexion.php';

class Producto{
	var $id;
    var $name;
    var $url_image;
    var $price;
    var $discount;
    var $category;            
      
        public function MostrarProductos(){            
            $query = "SELECT * FROM product";
            $result = mysql_query($query) or die('Consulta fallida MostrarProductos: ' . mysql_error());

            return $result;          
        }

        public function MostrarCategoria($idCategoria){            
            $query = "SELECT * FROM product as p 
                        inner join category as c 
                        WHERE p.category = '".$idCategoria."' ";
            $result = mysql_query($query) or die('Consulta fallida MostrarCategory: ' . mysql_error());

            return $result;
        }
}