<?php

    require_once '../core/Database.php';


    class Users extends Database{

        // === Login === //

        public function login($userName, $userPwd) {
            //  echo json_encode([
            //     "email" => $userName,
            //     "pwd" => $userPwd
            // ]);
            // exit;
            $query = $this->Dbh->prepare("SELECT * FROM users WHERE user_email = '$userName' AND user_pwd = '$userPwd'");

            $query->bindValue(':username', $userName, PDO::PARAM_STR);
            $query->bindValue(':userpwd', $userPwd, PDO::PARAM_STR); // bindParam returns a boolen

                     
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
        
        public function register($userName, $userEmail, $userPwd){
            if(empty($userName) || empty($userEmail) || empty($userPwd)){
                
            }

            $sql = "INSERT INTO users(user_name, user_email, user_pwd) VALUES (:username, :useremail, :userpwd)";
            $query = $this->Dbh->prepare($sql);
            $query->bindValue(":username", $userName, PDO::PARAM_STR);
            $query->bindValue(":useremail", $userEmail, PDO::PARAM_STR);
            $query->bindValue(":userpwd", $userPwd, PDO::PARAM_STR);

            if(!$query->execute()){
                return false;                
            }else{
                $user = $query->fetch(PDO::FETCH_ASSOC);

                if(!empty($user)){
                    return $user;
                }else{
                    return false;
                }
            }


        }
        

        
    }

    $User = new Users();

    // Login Endpoint   

    if($_SERVER['REQUEST_METHOD'] === 'POST'){

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        // var_dump($_POST);
        // exit;
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

    }else {
        echo json_encode("The request method isn't correct!");
    }
