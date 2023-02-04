<?php 

    include_once '../core/Database.php';

    class Reservations extends Database{

        // === setResrvation === // 

        public function setReservation($user_refernce, $reservation_service,$reservation_date, $reservation_time,$barber_id) {

            $sql = "INSERT INTO reservations(reservation_date, reservation_time, reservation_service, reservation_customer_refernce, barber_id) VALUES (:reservationDate, :reservationTime, :reservationService , :customerReference, :barber_id)";

            $preparedSQL = $this->Dbh->prepare($sql);
            
            $preparedSQL->bindValue(":reservationDate", $reservation_date, PDO::PARAM_STR);
            $preparedSQL->bindValue(":reservationTime", $reservation_time , PDO::PARAM_INT);
            $preparedSQL->bindValue(":reservationService", $reservation_service, PDO::PARAM_STR);
            $preparedSQL->bindValue(":customerReference", $user_refernce, PDO::PARAM_INT);
            $preparedSQL->bindValue(":barber_id" , $barber_id, PDO::PARAM_INT);

            if($preparedSQL->execute()){
                return true;
            }else{
                return false;
            }
            
        } 

        // === updateReservation === //

        public function updateReservation($user_refernce, $reservation_service,$reservation_date, $reservation_time,$barber_id) {

            $sql = "UPDATE reservations SET reservation_date = :reservationDate, reservation_time = :reservationTime, reservation_service = :reservationService, reservation_customer_refernce = :customerReference, WHERE barber_id = :barber_id";

            $preparedSQL = $this->Dbh->prepare($sql);
            
            $preparedSQL->bindValue(":reservationDate", $reservation_date, PDO::PARAM_STR);
            $preparedSQL->bindValue(":reservationTime", $reservation_time , PDO::PARAM_INT);
            $preparedSQL->bindValue(":reservationService", $reservation_service, PDO::PARAM_STR);
            $preparedSQL->bindValue(":customerReference", $user_refernce, PDO::PARAM_INT);
            $preparedSQL->bindValue(":barber_id" , $barber_id, PDO::PARAM_INT);

            if($preparedSQL->execute()){
                return true;
            }else{
                return false;
            }
        }

        // === deleteReservation === //

        public function deleteReservation($reservationID){

            $sql = "DELETE FROM reservations WHERE reservation_id = :reservationID";
            $preparedSQL = $this->Dbh->prepare($sql);

            $preparedSQL->bindValue(":reservationID" , (int)$reservationID, PDO::PARAM_INT);

            if($preparedSQL->execute()){
                return true;
            }else{
                return false;
            }

        }

        // === displayReservations === // 

        public function displayReservations(){

            $sql = "SELECT * FROM reservations";
            $preparedSQL = $this->Dbh->prepare($sql);
            $preparedSQL->execute();
            $reservations = $preparedSQL->fetchAll(PDO::FETCH_OBJ);
            echo json_encode(array("reservations list :" => $reservations));

        }
    }

    $Reservation = new Reservations;

    if($_SERVER["REQUEST_METHOD"] === "POST"){
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        switch($_POST["type"]){

            case "setReservation":

                if(isset($_POST["reservationDate"]) && isset($_POST["reservationTime"]) && isset($_POST["reservationService"]) && isset($_POST["customerRefernce"]) && isset($_POST["barberID"])){

                    $setReservation = $Reservation->setReservation($_POST["customerRefernce"],$_POST["reservationService"],$_POST["reservationDate"],$_POST["reservationTime"],$_POST["barberID"]);

                    if($setReservation){
                        http_response_code(200);
                        echo json_encode(array("status" => "reservation has been made seccessfully" , "reservation" => $setReservation));
                    }else {
                        http_response_code(500);
                        echo json_encode(array("status" => "reservation setting has faild"));
                    }
                }
                break;

            case "updateReservation":

                if(isset($_POST["reservationDate"]) && isset($_POST["reservationTime"]) && isset($_POST["reservationService"]) && isset($_POST["customerRefernce"]) && isset($_POST["barberID"])){

                    $updateReservation = $Reservation->setReservation($_POST["customerRefernce"],$_POST["reservationService"],$_POST["reservationDate"],$_POST["reservationTime"],$_POST["barberID"]);

                    if($updateReservation){
                        http_response_code(200);
                        echo json_encode(array("status" => "reservation has been updated seccessfully" , "reservation" => $updateReservation));
                    }else {
                        http_response_code(500);
                        echo json_encode(array("status" => "reservation setting has faild"));
                    }
                }
                break;


            case "deleteReservation": 
                if(isset($_POST["reservationID"])){

                    $updateReservation = $Reservation->deleteReservation((int)$_POST["reservationID"]);

                    if($updateReservation){
                        http_response_code(200);
                        echo json_encode(array("status" => "reservation has been deleted seccessfully"));
                    }else {
                        http_response_code(500);
                        echo json_encode(array("status" => "reservation setting has faild"));
                    }
                }
                break;

            default :
                $Reservation->displayReservations();
                break;
                
        }
    }


    // Reservtions class => methods : setReservation, updateResrvation, deleteResrvation, readReservation 

    // Each method LOGIC => setReservation : 1- fetch the coming data from the view 
                                        //   2- filter the data 
                                        //   3-check if the date of the reservation and the user_refernce and the barber id are correct and not duplicated
                                        //   4- if true => insert the reservation to the dastabase 
                                        //   5- if false => flash a message the user 

                    // => updateReservation : 1- fetch the coming data from the view 
                                        //    2- filter the data
                                        //    3- check id the date of reservation and user_refernce and the barber id already exsits in the reservation table in the website's database
                                        //    4- if true => update the reservation row on the databse 
                                        //    5- if false => flash a message the user

                    // => deleteReservation : 1- fetch the data 
                                        //    2- check if the reservation id already exsits 
                                        //    3- if true => delete the row 
                                        //    4- if false => flash a message to the user 
                    
                    // readReservation : 1-> SELECT * FROM reservation table and that's it :) 
