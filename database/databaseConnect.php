<?php
    /**
     * 
     */
    class DatabaseConnect
    {
        private static $conn = null;
        
        public static function connect(){
            try{
                return $conn = new PDO("mysql:host=localhost;dbname=phpproject", "root", "");
            }catch(PDOException $e){
                echo "Connection failed: " . $e->getMessage();
                return null;
            }
        }

        public static function getResult($querySelect, $conn){
            if($conn != null){
                $stm = $conn->prepare($querySelect);
                $stm->execute();
                return $result = $stm->fetchAll();
            }
            else{
                printf("Fail get result. Connect fail");
                return null;
            }
        }

        public static function updateCustomerInfo($query, $conn){
            try{
                $stm = $conn->prepare($query);
                $stm->execute();
            }
            catch(PDOException $ex){
                echo $ex;
            }
        }

        public static function closeConnect($conn){
            if($conn != null){
                $conn = null;
            }
            else{
                printf("Fail to close connect");
            }
        }
    }        
    
?>