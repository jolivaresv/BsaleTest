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

        public function FiltrarPorCategoria($idCategoria){            
           $query = "SELECT * FROM product WHERE category = $idCategoria ";
            $result = mysql_query($query) or die('Consulta fallida FiltrarPorCategoria: ' . mysql_error());

            return $result;
        }

        public function OrdenarPorPrecio($Orden){            
            $query = "SELECT * FROM product order by price $Orden ";
            $result = mysql_query($query) or die('Consulta fallida OrdenarPorPrecio: ' . mysql_error());

            return $result;          
        }


}