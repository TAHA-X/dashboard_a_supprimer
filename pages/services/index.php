<?php
session_start();
if(!isset($_SESSION["login"])){
    header("location:../../login.php");
   exit();
 }
  include "../../connect.php";
  $stmt = $conn->prepare("select * from services");
  $stmt->execute();
  $services = $stmt->fetchAll();
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
    <a class="nav-link" href="index.php">
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
                      <h1 class="m-2">Services</h1>
                      <a class="m-2" href="add.php">ajouter une service</a>
                    </div>
                    <div class="table-responsive">
                      <table class="m-2" id="table">
                        <thead>
                          <tr>
                            <th>numéro</th>
                            <th>img</th>
                            <th>title</th>
                            <th>actions</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php
                               foreach($services as $service){
                                    ?>
                                      <tr>
                                        <td><?php echo $service["id"] ?></td>
                                        <td><img style="width:150px; height:120px;" src="./imgs/<?php echo $service["img"] ?>"/></td>
                                        <td><?php echo $service["title"] ?></td>
                                        <td>
                                            <a href="edit.php?num_service=<?php echo $service['id']; ?>" class="btn btn-success">view</a>
                                            <a onclick="return confirm('voulez vous vraiment supprimer cette service ?')" class="btn btn-danger" href="delete.php?num_service=<?php echo $service['id']; ?>">delete</a>
                                        </td>
                                       </tr>
                                    <?php
                               }
                            ?>          
                        </tbody>
                      </table>
                    </div>
 

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