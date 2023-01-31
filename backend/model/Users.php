<? 

    require_once '../core/Database.php';

    class Users extends Database{

        public function login($userName, $userPwd) {
            $query = $this->Dbh->prepare("SELECT * FROM users WHERE user_name = :username AND user_pwd = :userpwd");
            $query->bindParam(':username', $userName);
            $query->bindParam(':userpwd', $userPwd);

            
            $query->execute();

            
            if($query->rowCount()){
                return true;
            }else{
                return false;
            }
            

            
        }

        
    }

    $User = new Users();

    // Login Endpoint   

    if(isset($_POST['Email']) && isset($_POST['pwd'])){
        header('Content-Type: application/json');
        // Fetch data 

        $data = json_decode(file_get_contents("php://input"), true);


        $user = $User->login($data['Email'] , $data['Pwd']);

        if($user){
            echo json_encode(array('status' => 'success', 'user' => $user));
        }else {
            echo json_encode(array('status' => 'User does not exsit !'));
        }
    }