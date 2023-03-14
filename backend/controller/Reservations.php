<?php 
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    if(file_exists('../model/Reservation.php')){
        require_once '../model/Reservation.php';
    }else{
        require_once 'model/Reservation.php';
    }
    class Reservations {
        protected $ReservationModel;

        public function __construct()
        {
            $this->ReservationModel = new Reservation();
        }
        // === Add a reservation === //
        public function setReservation($customerReference, $reservationService, $reservationDate, $barberID) 
        {
            $setReservation = $this->ReservationModel->setReservation($customerReference, $reservationService, $reservationDate, $barberID);
            if($setReservation) {
                return true;
            }else{
                return false;
            }
        }
        // === Update a reservation === //
        public function updateReservation($user_refernce, $reservation_service,$reservation_date,$reservation_id,$barber_id)
        {
            $updateReservation = $this->ReservationModel->updateReservation($user_refernce, $reservation_service,$reservation_date,$reservation_id,$barber_id);
            
            if($updateReservation){
                return $updateReservation;
            }else{
                return false;
            }
        }
        // === Delete(cancel) a reservation === //
        public function deleteReservation($reservationID) 
        {
            $deleteReservation = $this->ReservationModel->deleteReservation($reservationID);
            if($deleteReservation){
                return $deleteReservation;
            }else{
                return false;
            }
        }
        // === displayReservations === // 
        public function displayReservations() 
        {
            return $this->ReservationModel->displayReservations();
        }
        // === display Avialble hours === // 
        public function displayAvialbleHours($day)
        {
            return $this->ReservationModel->displayAvialbleHours($day);
        }

    }

    $Reservation = new Reservations();

    if($_SERVER["REQUEST_METHOD"] === "POST"){

        switch($_POST["type"]){

            case "setReservation":

                if(isset($_POST["reservationDate"]) && isset($_POST["reservationService"]) && isset($_POST["customerRefernce"]) && isset($_POST["barberID"])){

                    $setReservation = $Reservation->setReservation($_POST["customerRefernce"],$_POST["reservationService"],$_POST["reservationDate"],$_POST["barberID"]);

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

                if(isset($_POST['reservationDate'])&& isset($_POST['reservationService']) && isset($_POST['customerRefernce']) && isset($_POST['barberID'])){

                    $updateReservation = $Reservation->updateReservation($_POST['customerRefernce'],$_POST['reservationService'],$_POST['reservationDate'],$_POST['barberID'], $_POST['reservationId']);

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
    }else if($_SERVER['REQUEST_METHOD'] === 'GET'){
        if(isset($_GET['reservationDay'])){
            $avialbleReservationHours = $Reservation->displayAvialbleHours($_GET['reservationDay']);
            
            if($avialbleReservationHours){
                http_response_code(200);
                echo json_encode(array("hours" => $avialbleReservationHours));
            }else {
                http_response_code(400);
                echo json_encode("There's no avialble hours !");
            }
        }else{
            echo json_encode('The GET params are not avialble , please try another parameters');
            http_response_code(404);
        }
    }