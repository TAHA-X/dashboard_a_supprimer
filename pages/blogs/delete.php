<?php
session_start();
if(!isset($_SESSION["login"])){
     header("location:../../login.php");
   exit();
 }
   include "../../connect.php";
   $success_message = "";
   if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["num_blog"])){
        $get_num_blog = $_GET["num_blog"];
        // remove the img
             $blog = $conn->prepare("SELECT * from blogs where id='$get_num_blog'");
             $blog->execute();
             $blog = $blog->fetch();
             unlink("imgs/".$blog["img"]);
        // remove the page
        $stmt = $conn->prepare("delete from blogs where id='$get_num_blog'");
        $stmt->execute();
        header("location:index.php");
        exit;
     
   }
 
  
   
?>