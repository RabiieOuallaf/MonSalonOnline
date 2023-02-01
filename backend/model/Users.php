<?php

    require_once '../core/Database.php';

    // header("Access-Control-Allow-Origin: *");
    // header("content-type: Application/json");
    // header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
    // header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-type, Access-Control-Allow-Methods, Authorization, X-Requested-With');

    class Users extends Database{

        // === Login === //

        public function login($userName, $userPwd) {
            $query = $this->Dbh->prepare("SELECT * FROM users WHERE user_name = ? AND user_pwd = ?");
            $query->bindParam(1, $userName);
            $query->bindParam(2, $userPwd); // bindParam returns a boolen

            if(!$query->bindParam(1, $userName) || !$query->bindParam(2, $userPwd)){
                error_log("Error in banding the params : " . $query->errorInfo());
                return false;
            }else {

                if($query->execute()){
                    if($query->rowCount() > 0){
                        return $query;
                    }else{
                        return false;
                    }
                }else {
                    return error_log("An error occurd in the excutaion of the query ! Err message :" . $query->errorInfo());
                }

            }            
            
        }

        // ===  Creating session === //

        public function createSession($user) {
            session_start();

            $_SESSION["Username"] = $user->user_name;
            if($user->user_role == "Admin"){
                $_SESSION["Role"] = $user->user_role;
                header("location: dashbaord.php");
            }else{
                header("location: index.php");
            }
            
        }

        // === Registe === //

        public function register($userName, $userEmail,$userPwd) {
            $query = $this->Dbh->prepare("INSERT INTO users(user_name, user_email, user_pwd) VALUES (?, ?, ?)");
            $query->bindParam(1,$userName);
            $query->bindParam(2,$userEmail);
            $query->bindParam(3,$userPwd);

            // Checking for any errors 

            if(!$query->bindParam(1,$username) || !$query->bindParam(2,$userEmail) || $query->bindParam(3, $userPwd)){
                return error_log("An error occured while binding the params , please check the register method , Err message : " . $query->errorInfo());
            }else {
                if($query->execute()){
                    if($query->rowCount() > 0){
                        return $query;
                    }else{
                        return false;
                    }
                }
            }

        }

        
    }

    $User = new Users();

    // Login Endpoint   

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
       
        if(isset($_POST['Email']) && isset($_POST['pwd'])){

            // Fetch data 

            $user = $User->login($_POST['Email'] , $_POST['pwd']);
            createSession($user);

            if($user){
                echo json_encode(array('status' => 'success', 'user' => $user));
            }else {
                http_response_code(404);
                echo json_encode(array('status' => 'User does not exsit !'));
            }
        }

    }else {
        echo "The request method isn't correct!";
    }
