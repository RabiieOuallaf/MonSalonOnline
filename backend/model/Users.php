<?php

    require_once '../core/Database.php';


    class Users extends Database{

        // === Login === //

        public function login($userRefernce) {

            $query = $this->Dbh->prepare("SELECT * FROM users WHERE user_refernce = :userrefernce");

            $query->bindValue(':userrefernce', $userRefernce, PDO::PARAM_STR);

                     
            if(!$query->execute()){
                error_log("Error in banding the params : " . $query->errorInfo());
                return false;
            }else {
            
                $user = $query->fetch(PDO::FETCH_ASSOC);

                // $query->execute();
                // $User = $query->fetch(PDO::FETCH_OBJ);
                // return $User;
                // $this->createSession($User);
                if(!empty($user)){
                    return $user;
                }else{
                    return false;
                }
                    
            }            
            
        }

        // ===  Creating session === //

        protected function createSession($user) {
            session_start();

            $_SESSION["Username"] = $user->user_name;
            if($user->user_role == "Admin"){
                $_SESSION["Role"] = $user->user_role;
                header("location: dashbaord.php");
            }else{
                header("location: index.php");
            }

        }

        
        
        
        public function register($userName, $userEmail, $userPwd){
            
            
            $sql = "INSERT INTO users(user_name, user_email, user_pwd, user_refernce) VALUES (:username, :useremail, :userpwd, :userrefernce)";

            $query = $this->Dbh->prepare($sql);
            $query->bindValue(":username", $userName, PDO::PARAM_STR);
            $query->bindValue(":useremail", $userEmail, PDO::PARAM_STR);
            $query->bindValue(":userpwd", $userPwd, PDO::PARAM_STR);
            $query->bindValue(":userrefernce" , $this->generateKey(), PDO::PARAM_STR);

            $userRegisterd = $query->execute();
            
            if(!$userRegisterd){
                return false;
                header("location: somewhere");              
            }else{
                return $userRegisterd;
                header("location: somewhere");              

            }
            
        }
        
        // === Generate the login reference key === // 

        public function generateKey() {
            $str = "78LmNOPAQRsUvwXYZ";

            $strLength = strlen($str);

            for($i = 0; $i < mt_rand(10,14); $i++){
                $baseRandomString []= $str[mt_rand(rand(0,10) , $strLength - 1)];
            }

            return implode($baseRandomString);

        }
        

        
    }

    $User = new Users();

    // Login Endpoint   

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        switch ($_POST['type']){
            case 'login':      

                if(isset($_POST['Email']) && isset($_POST['pwd'])){
                    // Fetch data 
                    $user = $User->login($_POST['Email'] , $_POST['pwd']);
                
                    if(!empty($user)){
                        echo json_encode(array('status' => 'success', 'user' => $user));
                    }else {
                        http_response_code(404);
                        echo json_encode(array('status' => 'User does not exsit !'));
                        
                    }
                }
                break;
            case 'register':

                if(isset($_POST['Email']) || !empty($_POST['username']) || !empty($_POST['pwd'])){
                    $user = $User->register($_POST['username'] , $_POST['Email'] , $_POST['pwd']);

                    if($user){
                        http_response_code(200);
                        echo json_encode(array('status' => 'user created successfully' , 'user' => $user));
                    }else{
                        http_response_code(404);
                        echo json_encode(array('status' => 'something went wrong!'));
                    }
                }
                break;

            default: 
                break;
        }

        

    }else {
        echo json_encode("The request method isn't valid!");
    }
