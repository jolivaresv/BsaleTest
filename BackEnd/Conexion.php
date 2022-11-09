<?PHP
class Connection{

    //variables para los datos de la base de datos
    public $server;
    public $userdb;
    public $passdb;
    public $dbname;
    
    public function __construct(){
        
        //Iniciar las variables con los datos de la base de datos
        $this->server = 'mdb-test.c6vunyturrl6.us-west-1.rds.amazonaws.com';
        $this->userdb = 'bsale_test';
        $this->passdb = 'bsale_test';
        $this->dbname = 'bsale_test';
    }
    
    public function get_connected(){
        
        //Para conectarnos a MySQL
        $con = mysql_connect($this->server, $this->userdb, $this->passdb);
        
        //Nos conectamos a la base de datos que vamos a usar
        mysql_select_db($this->dbname, $con);
                
        mysql_set_charset('utf8');        
    }    
}
?>