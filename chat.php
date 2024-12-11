<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Dashboard</title>

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

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                    <h4 class="mb-sm-0 font-size-18">Chat</h4>

                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Chat</a></li>
                                            <li class="breadcrumb-item active">Chat</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                            <div class="me-lg-12">
                                <div class="chat-leftsidebar me-lg-4">
                                    <div class=""> 
                                        <div class="search-box chat-search-box py-4">
                                            <div class="position-relative">
                                                <input type="text" class="form-control" id="searchMemberList" name="searchMemberList" placeholder="Search..." onkeyup="searhingList(this.value);">
                                                <i class="bx bx-search-alt search-icon"></i>
                                            </div>
                                        </div> 
                                        <div class="chat-leftsidebar-nav">
                                            <ul class="nav nav-pills nav-justified">
                                            </ul>
                                            <div class="tab-content py-4">
                                                <div class="tab-pane show active" id="chat" >
                                                    <div>
                                                        <h5 class="font-size-14 mb-3">Recent</h5>           
                                                        <ul class="list-unstyled chat-list" data-simplebar style="max-height: 410px;" id="result">
                                                            <?php 
                                                                $getsql = "SELECT *, m.status AS mstat, cr.status AS crstat, COUNT(cr.id) AS countnum FROM chat_room cr LEFT JOIN member m ON (cr.sender = m.member_id) OR(cr.receiver = m.member_id) WHERE cr.status = 0 AND ((cr.sender != 0) OR (cr.receiver != 0)) GROUP BY m.member_id";
                                                                $getqry = mysqli_query($conn, $getsql);
                                                                $i = 1;
                                                                if (mysqli_num_rows($getqry) > 0) {
                                                                    while ($row = mysqli_fetch_assoc($getqry)) {
                                                            ?>
                                                                <li style="border-bottom: 1px solid #1814140d;" >
                                                                    <a href="chat_room.php?member_id=<?php echo $row['member_id'];?>" target="_blank" class="getne" alt="<?php echo $row['member_id'];?>" >
                                                                        <div class="media" >
                                                                            <div class="align-self-center me-3">
                                                                                <img src="adminassets/images/users/avatar-2.jpg" class="rounded-circle avatar-xs" >
                                                                            </div> 
                                                                            <div class="media-body overflow-hidden">
                                                                                <h5 class="text-truncate font-size-14 mb-1" style="padding:13px 13px 13px 13px;"><?php echo $row['member_name'] . ' - ' .$row['member_mobile'];?></h5>
                                                                            </div>
                                                                            <div class="font-size-11"><?php echo $row['countnum']; ?></div>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                             <?php } } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                                </div>
                            <!-- end row --> 
                        </div> <!-- container-fluid -->
                    </div>
                    <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Chat.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Design & Develop by Themesbrand
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

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


        <!-- <script src="adminassets/libs/jquery/jquery.min.js"></script> -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
        <!-- <script src="adminassets/js/customjs.js?v=9051"></script> -->

        <script type="text/javascript">
            function searhingList(e) {
                $.ajax({
                    url : 'apiz/search_member_list.php',
                    type : "post",
                    data : {e},
                    success: function(data){
                        $("#result").html(data);
                    }
                });
            }

        </script>

    </body>

    </html>