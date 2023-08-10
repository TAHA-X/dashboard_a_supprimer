<?php
   session_start();
   $error = "";
   $success;
   if(isset($_POST["login"])){
        if($_POST["email"]=="" || $_POST["password"]==""){
             $error = "all the inputs are required";
        }
        else{
             include "./connect.php";
             $stmt = $conn->prepare("SELECT * from users where email=:email and password=:password");
             $email = $_POST["email"];
             $password = md5($_POST["password"]);
             $stmt->bindParam(":email",$email);
             $stmt->bindParam(":password",$password);
             $stmt->execute();
             $fetch = $stmt->fetch();
             if(empty($fetch)){
                  $error = "email or password are not correct";
             }
             else{
                   $_SESSION["login"] = true;
                   header("location:index.php");
                   exit();
             }
        }
   }
?>
<!DOCTYPE html>
<html lang="en">
<!-- <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Documents</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div> -->
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://cdn.ckeditor.com/ckeditor5/38.1.1/classic/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <title>Informations</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
     <style>
         body{
            display:grid; height:100vh; place-items:center;
         }
         form{
            box-shadow:10px 10px 10px #efeaea;
            padding:20px; border-radius:13px;
            transform:scale(1.2);
         }
     </style>
</head>
<body>

  <form method="post">
         <p class="text-center">PLOMBERIE APP</p>
         <input name="email" class="form-control mt-1" placeholder="email"/>
         <input name="password" type="password" class="form-control mt-1" placeholder="password"/>
         <?php
            if($error){
                 ?>
                    <div class="alert alert-danger mt-1"><?php echo $error; ?></div>
                 <?php
            }
            // if($success){

            // }
         ?>
         <button name="login" class="btn btn-primary mt-1">login</button>
  </form>






<script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
    <!-- Bootstrap core JavaScript-->

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function () {
            $("#table").DataTable();
            $("#trier").click(()=>{
                $("#trier-detaills").fadeIn();
                $("#trier").css("display","none");
            })
       
        
        })

   </script>

</body>

</html>