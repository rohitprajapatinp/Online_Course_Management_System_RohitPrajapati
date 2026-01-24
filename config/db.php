<?php 
    function dbConnect(){
        $server = "mysql:host=localhost;dbname=online_courses_db";
        $user = "root";
        $password = "";
        try{
            $con = new PDO($server, $user, $password);
            // echo "Database Connected Successfully";
            return $con;
        }catch(PDOException $e){
            die("Database Connection Failed : " .$e->getMessage());
        }
    }
    dbConnect();
 ?>