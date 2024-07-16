<?php
    class projClass{
            
        private static $dbName = CONNDB;
        private static $dbHost = CONNHOST;
        private static $dbUser = CONNUSR;
        private static $dbPass = CONNPWD;

        public function connect(){
            try{
                $conn = new PDO("mysql:host=".self::$dbHost.";dbname=".self::$dbName."",self::$dbUser,self::$dbPass);
            }
            catch(PDOException $e){
                $conErr = "DB Connection Error - ".$e->getMessage();
                die(".$conErr.");
            }
            return $conn;
        }

        public function executeQ($conn,$q_param){

            $op = isset($q_param["op"]) ? $q_param["op"] : "";
            $params = isset($q_param["params"]) ? $q_param["params"] : "";
            $tableName = isset($q_param["tableName"]) ? $q_param["tableName"] : "";
            $whereCond = isset($q_param["whereCond"]) ? $q_param["whereCond"] : "";
            $orderBy = isset($q_param["orderBy"]) ? $q_param["orderBy"] : "";
            
            $res = false;
            if(!$conn){die("<div class='errorDiv'>Connessione non riuscita al DB</div>");}
            switch($op){
                case "create":{
                    $q = "INSERT INTO ".$tableName." ".$params." ";
                    $stmt = $conn->query($q);
                    return $stmt;
                }break;
                case "read":{
                    $q = "SELECT ".$params." FROM ".$tableName." ".$whereCond." ".$orderBy." ";
                    $result = [];
                    $stmt = $conn->query($q);
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){$result[] = $row;}
                    $res = $result;
                }break;
                case "update":{
                    $q = "UPDATE ".$tableName." SET ".$params." ".$whereCond." ";
                    $stmt = $conn->query($q);
                    $res = $stmt;
                }break;
                case "delete":{
                    $q = "DELETE FROM ".$tableName." ".$whereCond." ";
                    $stmt = $conn->query($q);
                    $res = $stmt;
                }break;
            }
            
            return $res;

        }

        public function sessionLogout(){
            $_SESSION = [];
        }

        function scanContentDir($folder){

            $res = [];
            $content = scandir($folder,1);
    
            foreach($content as $k => $c){
                if(($c != '.') && ($c != '..')){
                    $res[$k] = $c;
                    if(is_dir($c)){
                        $res[$k]["".$c.""] = scanContentDir($folder.$c);
                    }
                }
            }
            return $res;
        }

        function mailSending($to,$email_subject,$email_body,$headers){
            try{
                mail($to,$email_subject,$email_body,$headers);
                $mailSent = true;
                $responseValue = CONTACT_MSG_OK;
            }
            catch(Exception $e){
                $mailSent = false;
                $responseValue = CONTACT_MSG_KO." - ".$e->getMessage()."";
            }

            return $responseValue;
        }

    }
?>