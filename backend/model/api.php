<?php 

    require_once './Users.php';

    $users = new Users();

    $user = $users->login("Rabie@gmail.com", 123);

if($_SERVER['REQUEST_METHOD'] == 'GET'){


    if($user){
        return json_encode("good !");
    }else {
        return json_encode("Bad !");
    }


}
    