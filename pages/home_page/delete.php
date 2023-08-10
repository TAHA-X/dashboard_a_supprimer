<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:../../login.php");
   exit();
 }
   include "../../connect.php";
   $success_message = "";
   if($_SERVER["REQUEST_METHOD"]=="GET" && isset($_GET["num_img"])){
        $get_num_img = $_GET["num_img"];
        $table;
        $folder;
        if($_GET["type"]=="slider"){
               $table = "home_slider";
               $folder = "slider_imgs/";
        }
        else if($_GET["type"]=="partenaire"){
            $table = "home_partenaire";
            $folder = "partenaire_imgs/";
        }
        else{
            header("location:index.php");
            exit;
        }
        // remove the img
             $img = $conn->prepare("SELECT * from $table where id='$get_num_img'");
             $img->execute();
             $img = $img->fetch();
             unlink($folder.$img["img"]);
        // remove the page
        $stmt = $conn->prepare("delete from $table where id='$get_num_img'");
        $stmt->execute();
        header("location:index.php");
        exit;
     
   }
 
  
   
?>