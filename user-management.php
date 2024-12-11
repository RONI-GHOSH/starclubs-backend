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
    <title>User Managment</title>

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
    <link href="adminassets/css/main-style.css" rel="stylesheet" type="text/css" />
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
                        <div class="col-12">
                            <div class="page-title-box d-flex align-items-center justify-content-between">
                                <h4 class="mb-0 font-size-18">User List</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboards</a></li>
                                        <li class="breadcrumb-item active">User List</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title d-flex align-items-center justify-content-between">&nbsp; <a href="un-approved-users-list.php" class="btn btn-primary waves-effect waves-light btn-sm">Un-approved Users List</a></h4>
                                <div class="table-responsive">
                                    <table id="userList" class="table table-bordered">
                                         <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Member Name</th>
                                            <th>Member Mobile No</th>
                                            <th>Member Referral Code</th>
                                            <th>Member Referrer Count</th>
                                            <th>Wallet Balance</th>
                                            <th>Betting</th>
                                            <th>Transfer</th>
                                            <th>Active</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    </table>
                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>
                    </div> 
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
    <script src="adminassets/js/customjs.js?v=7441"></script>

    <script type="text/javascript">
        var member_id = $('#member_id').val();
        $('#userList').DataTable({
            "ajax":"apiz/get_member_list.php",
            "data": [],
        });
    </script> 

    <script>
        dataTable.on('page.dt', function() {
            $('html, body').animate({
                scrollTop: $(".dataTables_wrapper").offset().top - 50
            }, 'slow');
        });
    </script>

    <script type="text/javascript">
        function userOneChange_status(cp) {
            var label = $(cp).attr('alt'); 
            $.post("apiz/user-status-one-change.php",
            {
                id  : $(cp).data('normalone'),
                status : $(cp).is(':checked')==true?'Active':'Pending'
            },
            function(data){
              if(data == 'fail'){
                $.notify("Status Not Changed", "error");

              }else{
                $("label[name="+label+"]").text(data);
              }
            });
        }
    </script>

    <script type="text/javascript">
        function userTwoChange_status(cp) {
            var label = $(cp).attr('alt'); 
            $.post("apiz/user-status-two-change.php",
            {
                id  : $(cp).data('normalone'),
                status : $(cp).is(':checked')==true?'Active':'Pending'
            },
            function(data){
              if(data == 'fail'){
                $.notify("Status Not Changed", "error");

              }else{
                $("label[name="+label+"]").text(data);
              }
            });
        }
    </script>

    <script type="text/javascript">
        function userThreeChange_status(cp) {
            var label = $(cp).attr('alt'); 
            $.post("apiz/user-status-three-change.php",
            {
                id  : $(cp).data('normalone'),
                status : $(cp).is(':checked')==true?'Active':'Pending'
            },
            function(data){
              if(data == 'fail'){
                $.notify("Status Not Changed", "error");

              }else{
                $("label[name="+label+"]").text(data);
              }
            });
        }
    </script>


</body>

</html>