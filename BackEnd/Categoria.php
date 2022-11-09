<?PHP
require_once 'Conexion.php';

class Categoria{
	var $id;
    var $name;          
      
        public function MostrarNombreCategoria(){   
            $query = "SELECT * FROM category";
            $result = mysql_query($query) or die('Consulta fallida MostrarNombreCategoria: ' . mysql_error());

            return $result;          
        }
}