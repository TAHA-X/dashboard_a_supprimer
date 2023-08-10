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
        // remove the img
             $service = $conn->prepare("SELECT * from services where id='$get_num_service'");
             $service->execute();
             $service = $service->fetch();
             unlink("imgs/".$service["img"]);
        // remove the page
        $stmt = $conn->prepare("delete from services where id='$get_num_service'");
        $stmt->execute();
        header("location:index.php");
        exit;
   }
 
  
   
?>