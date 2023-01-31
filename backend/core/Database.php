<? 

    class Database {

        private $db_host;
        private $db_user;
        private $db_user_pwd;
        private $db_port;
        private $db_name;
        protected $Dbh;

        
        public function __construct() {

            $dsn = 'mysql:host='.$this->db_host.';port='.$this->db_port.';dbname='.$this->db_name;

            $options = array(
                PDO::ATTR_PERSISTENT => false,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // PDO instance 

            try{
                $this->Dbh = new PDO($dsn , $this->db_user_pwd, $this->db_user, $options);
            }catch(PDOException $e){
                $err = $e->getMessage();
                echo 'You have an error in your database connection , please check Database.php file, Error message :' .$this->$err;  
            }
        }

    }