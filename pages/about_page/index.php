<?php
 session_start();
 if(!isset($_SESSION["login"])){
    header("location:../../login.php");
    exit();
  }
  include "../../connect.php";
  $error = "";
  $success = "";
  /* get the informations of about page */
  $stmt = $conn->prepare("SELECT * from about_page LIMIT 1");
  $stmt->execute();
  $fetch = $stmt->fetch();

  $about_services = $conn->prepare("SELECT * from about_services");
  $about_services->execute();
  $about_services = $about_services->fetchAll();
 /* update the imgs */
  if(isset($_POST["update_imgs"])){
    if($_FILES["img1"]["name"]=="" && $_FILES["img2"]["name"]==""){
        $error = "select an img first";
    }
    else if($_FILES["img1"]["name"]!="" && $_FILES["img2"]["name"]==""){
        unlink("imgs/".$fetch["img1"]);
        $stmt = $conn->prepare("UPDATE about_page SET img1=:img1");
        $img1 = $_FILES["img1"]["name"];
        $stmt->bindParam(":img1",$img1);
        move_uploaded_file($_FILES["img1"]["tmp_name"],"imgs/".$img1);
        $stmt->execute();
        $success = "img1 is updated successfuly"; 
    }
    else if($_FILES["img1"]["name"]=="" && $_FILES["img2"]["name"]!=""){
        unlink("imgs/".$fetch["img2"]);
        $stmt = $conn->prepare("UPDATE about_page SET img2=:img2");
        $img2 = $_FILES["img2"]["name"];
        $stmt->bindParam(":img2",$img2);
        move_uploaded_file($_FILES["img2"]["tmp_name"],"imgs/".$img2);
        $stmt->execute();
        $success = "img2 is updated successfuly";
    }
    else{
        unlink("imgs/".$fetch["img1"]);
        unlink("imgs/".$fetch["img2"]);
        $stmt = $conn->prepare("UPDATE about_page SET img1=:img1,img2=:img2");
        $img1 = $_FILES["img1"]["name"];
        $img2 = $_FILES["img2"]["name"];
        $stmt->bindParam(":img1",$img1);
        $stmt->bindParam(":img2",$img2);
        move_uploaded_file($_FILES["img1"]["tmp_name"],"imgs/".$img1);
        move_uploaded_file($_FILES["img2"]["tmp_name"],"imgs/".$img2);
        $stmt->execute();
        $success = "the imgs are updated successfuly";
    }
  }
  
  // update the presentation
  if(isset($_POST["update_presentation"])){
         $presentation = $_POST["presentation"];
         $stmt = $conn->prepare("UPDATE about_page SET presentation=:presentation");
         $stmt->bindParam(":presentation",$presentation);
         $stmt->execute();
         $success = "the presentation are updated successfuly";
  }

  // update_services_about

    if(isset($_POST["update_services_about"])){
        $noData = false;
        if($_POST["maison"]=="" &&  $_POST["cuisine"]=="" && $_POST["toilette"]==""){
            $noData = true;
        } 
        if($noData){
            $error = "their is no data";
        }
        else{
         // maison
         if($_POST["maison"]!=""){
               $stmt = $conn->prepare("INSERT into about_services(title,type) values(:title,:type)");
               $title = $_POST["maison"];
               $type = "maison";
               $stmt->bindParam(":title",$title);
               $stmt->bindParam(":type",$type);
               $stmt->execute();    
         }
         // cuisine
         if($_POST["cuisine"]!=""){
                $stmt = $conn->prepare("INSERT into about_services(title,type) values(:title,:type)");
                $cuisine = $_POST["cuisine"];
                $type = "cuisine";
                $stmt->bindParam(":title",$cuisine);
                $stmt->bindParam(":type",$type);
                $stmt->execute();
         }
         // salle de bain
         if($_POST["toilette"]!=""){
                $stmt = $conn->prepare("INSERT into about_services(title,type) values(:title,:type)");
                $toilette = $_POST["toilette"];
                $type = "toilette";
                $stmt->bindParam(":title",$toilette);
                $stmt->bindParam(":type",$type);
                $stmt->execute();
              
         }
         $success = "services are updated successfuly";
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
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <!-- <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div> -->
                <div class="sidebar-brand-text mx-3">Dashboard</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

        
            <!-- Divider -->
            <hr class="sidebar-divider">
            <li class="nav-item">
                <a class="nav-link" href="../../index.php">
                <i style="font-size:16px;" class="bi bi-book"></i>
                    <span>Infomations</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../blogs/index.php">
                <i style="font-size:16px;" class="bi bi-file-earmark"></i>
                    <span>Blogs</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../services/index.php">
                <i style="font-size:16px;" class="bi bi-file-earmark"></i>
                    <span>Services</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../home_page/index.php">
                <i style="font-size:16px;" class="bi bi-file-earmark"></i>
                    <span>Home-page</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../about_page/index.php">
                <i style="font-size:16px;" class="bi bi-file-earmark"></i>
                    <span>About-page</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link" href="../../logout.php">
                <i style="font-size:16px;" class="bi bi-box-arrow-left"></i>
                    <span>logout</span></a>
            </li>
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->
          

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <h3 class="m-2">plomberie-maroc</h3>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                      <div class="d-flex justify-content-between">
                            <h1 class="m-2">About page</h1>
                      </div>
                      <?php
                                if($success != "") {
                                  echo "<div class='alert alert-success'>$success</div>";
                                  ?>
                                      <script>
                                          setTimeout(function() {
                                              window.location.href = "index.php";
                                          }, 2000);
                                      </script>
                                  <?php
                                }    
                                if($error != "") {
                                  echo "<div class='alert alert-danger'>$error</div>";
                                 
                                }
                      ?>
                      <form enctype="multipart/form-data" class="pt-2" method="post">      
                        <!-- les partenaires -->
                            <div class="w-100 m-2">
                                <div class="d-flex gap-2">
                                     <div class="w-100">
                                        <label class="form-label">img1 :</label>
                                       <input class="form-control" name="img1" type="file"/> <br/>
                                       <img style="height:130px; border-top-right-radius:10px; border-top-left-radius:10px; width:170px;" src="./imgs/<?php echo $fetch["img1"]; ?>" />
                                     </div>
                                     <div class="w-100">
                                       <label class="form-label">img2 :</label>
                                       <input class="form-control" name="img2" type="file"/> <br/>
                                       <img style="height:130px; border-top-right-radius:10px; border-top-left-radius:10px; width:170px;" src="./imgs/<?php echo $fetch["img2"]; ?>" />
                                     </div>
                                </div>
                            </div>
                            <button class="btn btn-success m-2" name="update_imgs" type="submit">update</button>
                      </form>

                      <form enctype="multipart/form-data" method="post">
                              <div class="w-100 m-2">
                                     <label class="form-label">présentation</label>
                                     <textarea id="editor" class="form-control" name="presentation"><?php echo $fetch["presentation"] ?></textarea>
                               </div>
                               <button name="update_presentation" class="btn btn-success">update</button>
                       </form>
                       <form enctype="multipart/form-data" method="post">
                               <div class="w-100 m-2">
                                     <label class="form-label">certaines services a afficher :</label>
                                     <div>

                                     <!--Maison-->

                                     <strong>Maison</strong>
                                     <input class="form-control m-2" name="maison"/>
                                        <div class="d-flex justify-content-around flex-wrap gap-2">
                                            <?php 
                                                foreach($about_services as $service){
                                                    if($service["type"]=="maison"){
                                                        ?>
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <div class="btn btn-primary">
                                                                <?php echo $service["title"]; ?>
                                                                <a onclick="return confirm('voulez vous vraiment supprimer cette service de l\'about page ?')" href="delete.php?num_service=<?php echo $service['id']; ?>" class="bi text-white bi-x-lg"></a>
                                                                </div>
                                                            </div> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                         
                                            
                                           
                                        </div>

                                        <!--Cuisine-->

                                        <strong>Pour Cuisine</strong>
                                        <input class="form-control m-2" name="cuisine" />
                                        <div class="d-flex justify-content-around flex-wrap gap-2">
                                            
                                        <?php 
                                                foreach($about_services as $service){
                                                    if($service["type"]=="cuisine"){
                                                        ?>
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <div class="btn btn-primary">
                                                                <?php echo $service["title"]; ?>
                                                                <a  onclick="return confirm('voulez vous vraiment supprimer cette service de l\'about page ?')" href="delete.php?num_service=<?php echo $service['id']; ?>" class="bi text-white bi-x-lg"></a>
                                                                </div>
                                                            </div> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>

                                        <!--Pour Salle de bain et Toilette-->

                                        <strong>Pour Salle de bain et Toilette</strong>
                                        <input class="form-control m-2" name="toilette"/>
                                        <div class="d-flex justify-content-around flex-wrap gap-2">
                                        <?php 
                                                foreach($about_services as $service){
                                                    if($service["type"]=="toilette"){
                                                        ?>
                                                            <div class="d-flex flex-wrap gap-2">
                                                                <div class="btn btn-primary">
                                                                <?php echo $service["title"]; ?>
                                                                <a  onclick="return confirm('voulez vous vraiment supprimer cette service de l\'about page ?')" href="delete.php?num_service=<?php echo $service['id']; ?>" class="bi text-white bi-x-lg"></a>
                                                                </div>
                                                            </div> 
                                                        <?php
                                                    }
                                                }
                                            ?>
                                        </div>
                                     </div>
                               </div>
                                
                           <button name="update_services_about" type="submit" class="btn m-2 btn-success">update</button>
                           </form>
                      </form>

 

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
          
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->

    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
 
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
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