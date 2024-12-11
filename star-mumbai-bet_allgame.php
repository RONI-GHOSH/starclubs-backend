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
    <title>Withdraw Report</title>

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

    <style type="text/css">
        .model-footer-change
        {
            padding: 0px 20px 14px 0px;
            text-align: right;
        }
    </style>

</head>

<body data-sidebar="dark">

    <div id="layout-wrapper">
        
        <?php include 'includes/header.php';  ?>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12 col-xl-12 col-md-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header p-t-15 p-b-15">
                                            <h5>Bet All Game</h5>
                                        </div>
                                        <div class="card-body">
                                            <form class="theme-form mega-form" id="withdrawReportFrm" name="withdrawReportFrm" method="post">
                                                <div class="row">
                                                    <div class="form-group col-md-2">
                                                        <label>Date</label>
                                                        <div class="date-picker">
                                                            <div class="input-group">
                                                                <input type="date" value="<?php echo $date?>" class="form-control" placeholder="Date" id="betdate" name="betdate" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label>&nbsp;</label>
                                                        <button type="button" class="btn btn-primary btn-block" onclick="getsubmit();">Submit
                                                        </button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                             <div class="card p-4">
                                <div class="header">
                                    <h2><strong>Member</strong> List </h2>
                                </div>
                                <span id="deleteMemberListMsg">
                                </span>
                                <span id="notupdateMsg" style="display: none;">
                                    <div class="alert alert-success alert-dismissible alert-alt fade show text-center">
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button> Market Not Updated Successfully !
                                    </div>
                                </span>
                                <span id="updateMsg" style="display: none;">
                                    <div class="alert alert-success alert-dismissible alert-alt fade show text-center">
                                        <button type="button" class="close h-100" data-dismiss="alert" aria-label="Close"><span><i class="mdi mdi-close"></i></span>
                                        </button> Market Updated Successfully !
                                    </div>
                                </span>
                                <div class="body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover js-basic-example dataTable" id="tabledata">
                                            <thead>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Member Name</th>
                                                    <th>Market Name</th>
                                                    <th>Number</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Sr No</th>
                                                    <th>Member Name</th>
                                                    <th>Market Name</th>
                                                    <th>Number</th>
                                                    <th>Amount</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                    <th>Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
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

    <!-- <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Change Bet Number</h4>
                </div>
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <form method="post" action="apiz/betlistChangeNumber.php">
                                <label for="market_name">Bet Number </label>
                                <input class="form-control" type="text" name="bet_number" id="bet_number">
                                <br>
                                <input type="hidden" name="get_id" id="savechange">

                                <button type="submit"  name="bet_submit" class="btn btn-default btn-round waves-effect">SAVE CHANGES</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <div class="modal fade" id="largeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title" id="largeModalLabel">Change Bet Number</h4>
                </div>
                <div class="modal-body"> 
                    <div class="row clearfix">
                        <div class="col-sm-4">
                            <form>
                                <label for="market_name">Bet Number </label>
                                <input class="form-control" type="text" name="bet_number" id="bet_number">
                                <br>
                                <input type="hidden" name="get_id" id="savechange">

                                <button type="button" name="bet_submit" data-dismiss="modal" onclick="changebetNumber(this);" class="btn btn-success btn-round waves-effect">SAVE CHANGES</button>
                                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">CLOSE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- delete model start is here -->  
    <div class="modal fade show" id="memberDeleteModal" style=" padding-right: 16px;" aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Member !!</h5>
                    <button type="button" class="close" data-dismiss="modal"><span>×</span>
                    </button>
                </div>
                <form>
                    <div class="modal-body" style="padding: 20px 10px 10px 10px; text-align: center;">
                        <p style="font-size: 15px;">Are you sure ? You want to delete this Member !!</p>
                    </div>

                    <div class="model-footer-change">
                        <button type="button" style="padding: 5px 15px 5px 15px;" class="btn light btn-info" data-dismiss="modal">Cancel</button>
                        <button type="button"  data-dismiss="modal" id="memberListDel" style="padding: 5px 15px 5px 15px;" class="btn light btn-warning" >Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- delete model end is here -->


    <input type="hidden" id="base_url" value="">
    <input type="hidden" id="admin" value="krisshmatka-admin">

    <div id="snackbar"></div>
    <div id="snackbar-info"></div>
    <div id="snackbar-error"></div>
    <div id="snackbar-success"></div>
    
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
    <script src="adminassets/js/customjs.js?v=6903"></script>

     <script type="text/javascript">
        function getsubmit()
        {
            var betdate = $('#betdate').val();
            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "apiz/stars_all_games_bet.php",
                data : {
                    betdate: betdate,
                },
                success: function(dataResult) {
                    $("#tabledata").DataTable({
                        destroy : true,
                        data : JSON.parse(dataResult).data,
                    });
                }
            }); 
        }
    </script>


    <script type="text/javascript">
        function idtrans(el) {
           var id = $(el).attr('alt');
           $("#savechange").val(id);
           var batting = $(el).data('batting');
            $("#bet_number").val(batting);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {    
            var CurrentUrl = window.location.origin+window.location.pathname;
            // alert (CurrentUrl);
                $('#NavMenu a').each(function(Key,Value)
                {
                    if(Value['href'] === CurrentUrl)
                    {
                        $(Value).parent().addClass('active');
                    }
                });
            });
    </script>

    <script type="text/javascript">
        function idMemberDelete(cd) {
            var id = $(cd).attr('alt'); 
            $("#memberListDel").attr('alt',id);
        }
    </script>

    <script type="text/javascript">
        $("#memberListDel").on('click',function(){
            var id = $(this).attr('alt');
            $.ajax({
                type:"POST",
                url:"apiz/delete_all_games_bet.php",
                data:{id},
                success:function(data) {
                    $("#deleteMemberListMsg").html(data);
                    setTimeout(function(){ $("#deleteMemberListMsg").html(null); }, 4000);
                    getsubmit();
                }
            });
        });
    </script>


    <script type="text/javascript">
        function changebetNumber(eb) {
            var bet_number = $("input[name=bet_number").val();
            var get_id = $("input[name=get_id]").val();

            $.ajax({ //create an ajax request to display.php
                type: "POST",
                url: "apiz/betlistChangeNumber.php",
                data : {
                    bet_number: bet_number,
                    get_id : get_id,
                },
                success: function(dataResult) {
                    if (dataResult == "Yes") {
                        $("#notupdateMsg").show();
                        setTimeout(function(){ $("#notupdateMsg").hide(); }, 3000);
                        getsubmit();
                    }
                    else
                    {
                        $("#updateMsg").show();
                        setTimeout(function(){ $("#updateMsg").hide(); }, 3000);
                        getsubmit();
                    }
                }
            });
        }
    </script>

</body>

</html>