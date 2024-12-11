<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
 {
   echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
 $usertype = $_SESSION['useradmin'];

$msg = "";
$error = "";



if (isset($_POST['add-slider'])) {


    //Upload Slider Image
    $temp = explode(".", $_FILES['slideimg']["name"]);
    $newfilename = round(microtime(true)) . '.' . end($temp);

    $post_tmp_img1 = $_FILES['slideimg']["tmp_name"];

    $name = "adminassets/images/fun_images/$newfilename";
    move_uploaded_file($post_tmp_img1,"$name");
    
    $sql="INSERT INTO funimage(offerimage, status) VALUES ('$name','Active')";
    
    if (!mysqli_query($conn,$sql)) {
            $error = "Fail to Add Image";
        }else{
            $msg = "Image Add Successfully";
        }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Fun Image Managment</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="adminassets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />

    <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
        
    <?php include 'includes/header.php';  ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                         <div class="col-md-12">
                    
                </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title d-flex align-items-center justify-content-between">Fun Image Management <a class="btn btn-primary btn-sm btn-float m-b-10" href="#addSliderImageModal" role="button" data-toggle="modal">Add Fun Image</a></h4>
                                    <span id="deleteBetListMsg"> 
                                    </span>
                                    <table id="slidimg" class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Image</th>
                                                <th>Status</th> 
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php

                                            $getsql = "SELECT * FROM funimage where status='Active'";
                                            // echo $getsql;die;
                                            $getqry = mysqli_query($conn, $getsql);

                                            $i = 1;
                                            if (mysqli_num_rows($getqry) > 0) {
                                                while ($row = mysqli_fetch_assoc($getqry)) {
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><a href="" target="_blank"><img src="<?php echo $row['offerimage']; ?>"style=" width: 200px;height: 120px;" ></a></td>
                                            <td><?php echo $row['status']; ?> </td>
                                            <td>
                                                <a href="#" alt="<?=$row['offerid']?>" onclick="deletemodelbtn(this)" data-toggle="modal" data-target="#deleteSlider"><i class="bx bx-trash-alt font-size-18"></i></a> 
                                            </td> 
                                        </tr>
                                    <?php $i++;} }else {
                                        echo " <tr>
                                            <td colspan='5' style='text-align:center;'>No  Image Found</td>
                                        </tr> ";
                                    }

                                ?>
                                        </tbody>
                                    </table>

                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="addSliderImageModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal_right_side" role="document">
                    <div class="modal-content col-12 col-md-5">
                        <div class="modal-header">
                            <h5 class="modal-title">Add Image</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form class="theme-form" method="post" enctype="multipart/form-data">
                                <div class="row">

                                    <div class="form-group col-12">
                                        <label for="">Image<span class="Img_ext">(Allow Only.jpeg,.jpg,.png)</span></label>
                                        <input class="form-control" name="slideimg" type="file" accept="jpeg/*,jpg/*,png/*" max-data-upload="1M" />
                                    </div>
                                    <div class="form-group col-12">
                                        <button type="submit" class="btn btn-primary waves-light m-t-10" name="add-slider">Submit</button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="error"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- delete model start is here -->  

            <div class="modal fade show" id="deleteSlider" style=" padding-right: 16px;" aria-modal="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Delete Fun Image !!</h5>
                            <button type="button" class="close" data-dismiss="modal"><span>×</span>
                            </button>
                        </div>
                        <form>
                            <div class="modal-body" style="padding: 20px 10px 10px 10px; text-align: center;">
                                <p style="font-size: 15px;">Are you sure ? You want to delete this Slider !!</p>
                            </div>

                            <div class="model-footer-change">
                                <button type="button" style="padding: 5px 15px 5px 15px;" class="btn light btn-info" data-dismiss="modal">Cancel</button>
                                <button type="button" data-dismiss="modal" id="sliderDelete" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning" >Delete</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- delete model end is here -->

            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> ©Matka.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">

                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="adminassets/libs/jquery/jquery.min.js"></script>
    <script src="adminassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="adminassets/libs/metismenu/metisMenu.min.js"></script>
    <script src="adminassets/libs/simplebar/simplebar.min.js"></script>
    <script src="adminassets/libs/node-waves/waves.min.js"></script>
    <script src="adminassets/libs/select2/js/select2.min.js"></script>
    <script src="adminassets/js/pages/form-advanced.init.js"></script>
    <!-- Required datatable js -->
    <script src="adminassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="adminassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="adminassets/libs/jszip/jszip.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

    <!-- Responsive examples -->
    <script src="adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="adminassets/js/pages/datatables.init.js"></script>
    <!-- App js -->
    <script src="adminassets/js/app.js"></script>
    <script src="adminassets/js/customjs.js?v=7903"></script>

    <style type="text/css">
        .model-footer-change
        {
            padding: 0px 20px 14px 0px;
            text-align: right;
        }
    </style>

    <script type="text/javascript">
        $(document).ready( function () {
            $('#slidimg').DataTable();
        } );
    </script>

     
    <script type="text/javascript">
        function deletemodelbtn(cd) {
            var id = $(cd).attr('alt');
            $("#sliderDelete").attr('alt',id);
        }
    </script>

    <script type="text/javascript">
        $("#sliderDelete").on('click',function(){
            var id = $(this).attr('alt');
            $.ajax({
                type:"POST",
                url:"apiz/delete_image_fun.php",
                data:{id},
                success:function(data) {
                    window.location.href="FunImage_management.php";
                    $("#deleteBetListMsg").html(data);
                    setTimeout(function(){ $("#deleteBetListMsg").html(null); }, 4000);
                    
                }
            });
        });
    </script> 

</body>

</html>