<?php 
    
    if(file_exists('../core/Database.php')){
        require_once '../core/Database.php';
    }else{
        require_once 'core/Database.php';
    }

    class Reservation extends Database{

        // === setResrvation === // 

        public function setReservation($user_refernce, $reservation_service,$reservation_date,$barber_id,$reservatioDateDay) {

            $sql = "INSERT INTO reservations(reservation_date,reservation_service,reservation_customer_reference,reservation_barber_id,reservation_date_day)VALUES(:reservationDate,:reservationService,:customerReference,:barber_id,:reservatioDateDay)";

            $preparedSQL = $this->Dbh->prepare($sql);
            
            $preparedSQL->bindValue(":reservationDate", (int)$reservation_date, PDO::PARAM_INT);
            $preparedSQL->bindValue(":reservationService", $reservation_service, PDO::PARAM_STR);
            $preparedSQL->bindValue(":customerReference", $user_refernce, PDO::PARAM_STR);
            $preparedSQL->bindValue(":reservatioDateDay", (int)$reservatioDateDay, PDO::PARAM_INT);
            $preparedSQL->bindValue(":barber_id" , $barber_id, PDO::PARAM_INT);

            $preparedSQL->execute();
            if($preparedSQL->rowCount() > 0){
                $updateReservationStatus = $this->updateReservationStatus($reservatioDateDay, $reservation_date);
                if($updateReservationStatus){
                    return true; 
                }
            }else{
                return false;
            }
            
        } 
        // === Update hour status from free to hold === // 
        public function updateReservationStatus($reservatioDateDay, $reservation_date) {
            $sql = "UPDATE full_schedule SET hour_availability = :hour_status WHERE day_id = :day_id AND hour_value = :hour_value";
            $preparedSQL = $this->Dbh->prepare($sql);
            $preparedSQL->bindValue(':hour_status', 'hold', PDO::PARAM_STR);
            $preparedSQL->bindValue(':day_id', $reservatioDateDay, PDO::PARAM_INT);
            $preparedSQL->bindValue(':hour_value', $reservation_date, PDO::PARAM_INT);

            $executedSQL = $preparedSQL->execute();
            if($executedSQL) {
                return true;
            }else {
                return false;
            }
           
        }
        // === updateReservation === //

        public function updateReservation($user_refernce, $reservation_service,$reservation_date,$reservation_id,$barber_id) {

            $sql = "UPDATE reservations SET reservation_date = :reservationDate, reservation_service = :reservationService, reservation_customer_refernce = :customerReference, reservation_barber_id = :barber_id WHERE reservation_id = :reservation_id";

            $preparedSQL = $this->Dbh->prepare($sql);
            
            $preparedSQL->bindValue(':reservationDate', $reservation_date, PDO::PARAM_STR);
            $preparedSQL->bindValue(':reservationService', $reservation_service, PDO::PARAM_STR);
            $preparedSQL->bindValue(':customerReference', $user_refernce, PDO::PARAM_INT);
            $preparedSQL->bindValue(':reservation_id ' , $reservation_id, PDO::PARAM_INT);
            $preparedSQL->bindValue(':barber_id ' , $barber_id, PDO::PARAM_INT);

            if($preparedSQL->execute()){
                return true;
            }else{
                return false;
            }
        }

        // === deleteReservation === //

        public function deleteReservation($reservationID){

            $sql = 'DELETE FROM reservations WHERE reservation_id = :reservationID';
            $preparedSQL = $this->Dbh->prepare($sql);

            $preparedSQL->bindValue(':reservationID' , (int)$reservationID, PDO::PARAM_INT);

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

        // === Get avialble days === // 

        public function displayAvialbleHours($day){
            $sql = "SELECT hour_value,hour_availability FROM full_schedule WHERE day_id = :day_id";
            $preparedSQL = $this->Dbh->prepare($sql);
            $preparedSQL->bindValue(':day_id', (int)$day, PDO::PARAM_INT);
            if($preparedSQL->execute()){
                return $preparedSQL->fetchAll(PDO::FETCH_OBJ);
            }else {
                echo ('Something went wrong , please try later');
            }
        }
        

        // === Display user's reservations === // 

        public function displayUserReservations($usetToken) 
        {
            $sql = "SELECT * FROM reservations WHERE reservation_costumer_reference = :reservation_costumer_reference";
            $preparedSQL = $this->Dbh->prepare($sql);
            $preparedSQL->bindValue(':reservation_costumer_reference', $usetToken, PDO::PARAM_STR);
            if($preparedSQL->execute()) {
                return $preparedSQL->fetchAll(PDO::FETCH_OBJ);
            }else{
                echo ("This user doesn't have any reservations for the moment!");
            }
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
