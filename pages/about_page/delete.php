<?php
session_start();
 if(!isset($_SESSION["login"])){
   header("location:../../login.php");
   exit();
 }
   include "../../connect.php";
   $success_message = "";
   if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["num_service"])){
        $get_num_service = $_GET["num_service"];
        // remove the service(about)
        $stmt = $conn->prepare("delete from about_services where id='$get_num_service'");
        $stmt->execute();
        header("location:index.php");
        exit;
     
   }
 
  
   
?>