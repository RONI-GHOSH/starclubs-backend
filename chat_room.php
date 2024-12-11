<?php include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) 
{
  echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

$member_id = $_GET['member_id'];

$getsql = "SELECT * FROM member WHERE member_id='$member_id'";
$getqry = mysqli_query($conn , $getsql);
$getrow = mysqli_fetch_array($getqry);
$membername = $getrow['member_name'];
$membernumber = $getrow['member_mobile'];

$usql = "UPDATE chat_room SET status = '1' WHERE (sender='$member_id' OR receiver='$member_id')";
$uqry = mysqli_query($conn , $usql);

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

        <style type="text/css">
            .chat-input{
                padding-right: 0px !important;
            }
            .display-none {
                display: none;
            }
            .label-bottem {
                margin-bottom: 0px;
            }
        </style>

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

                            <div class="d-lg-flex">
                                    <div class="w-100 user-chat">
                                        <div class="card">
                                            <div class="p-4 border-bottom ">
                                                <div class="row">
                                                    <div class="col-md-4 col-9">
                                                        <h5 class="font-size-15 mb-1"><?php echo $membername?></h5>
                                                        <input type="hidden" id="getmember_id" value="<?php echo $member_id?>">
                                                    </div>
                                                    <div class="col-md-8 col-3">
                                                        <ul class="list-inline user-chat-nav text-end mb-0"> 
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="chat-conversation p-3">
                                                    <ul class="list-unstyled mb-0 scroll" id="ulchat" data-simplebar style="overflow: scroll;max-height: 500px;">
                                                        <li> 
                                                            <div class="chat-day-title">
                                                                <span class="title">Waiting for Message</span>
                                                            </div>
                                                        </li>
                                                        <!-- <li>
                                                            <div class="conversation-list">
                                                                <div class="dropdown">
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Steven Franklin</div>
                                                                    <p>
                                                                        Hello!
                                                                    </p>
                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:00</p>
                                                                </div>
                                                                
                                                            </div>
                                                        </li>
                                                        <li class="right">
                                                            <div class="conversation-list">
                                                                <div class="dropdown">
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="#">Copy</a>
                                                                        <a class="dropdown-item" href="#">Save</a>
                                                                        <a class="dropdown-item" href="#">Forward</a>
                                                                        <a class="dropdown-item" href="#">Delete</a>
                                                                    </div>
                                                                </div>
                                                                <div class="ctext-wrap">
                                                                    <div class="conversation-name">Henry Wells</div>
                                                                    <p>
                                                                        Hi, How are you? What about our next meeting?
                                                                    </p>
            
                                                                    <p class="chat-time mb-0"><i class="bx bx-time-five align-middle me-1"></i> 10:02</p>
                                                                </div>
                                                            </div>
                                                        </li> -->
                                                    </ul>
                                                </div> 
                                            </div>
                                            <div class="p-3 chat-input-section">
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="position-relative">
                                                            <input type="text" id="messagebox" class="form-control chat-input" placeholder="Enter Message...">
                                                            <div class="chat-input-links" id="tooltip-container">
                                                                <ul class="list-inline mb-0">
                                                                    <!-- <li class="list-inline-item"><a href="#" title="Emoji"><i class="mdi mdi-emoticon-happy-outline"></i></a></li> -->
                                                                    <li class="list-inline-item"><label for="file" class="label-bottem"><i class="mdi mdi-file-image-outline" ><input onchange="uploadimage(this)" id="file" type="file" class="display-none" name="file"></i></label></li>
                                                                    <!-- <li class="list-inline-item"><a href="#" title="Add Files"><i class="mdi mdi-file-document-outline"></i></a></li> -->
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <button type="button" class="btn btn-primary btn-rounded chat-send w-md waves-effect waves-light sendmessage"><span class="d-none d-sm-inline-block me-2">Send</span> <i class="mdi mdi-send"></i></button>
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

        <script type="text/javascript">
            $(document).ready(function(){
                setInterval(function() {
                    var getmember_id = $('#getmember_id').val();
                    $.ajax({ //create an ajax request to display.php
                        type: "POST",
                        url: "apiz/getmemberchat.php",
                        data : {
                            getmember_id: getmember_id,
                        },
                        success: function(dataResult) {
                            $("#ulchat").html(dataResult);

                            // $(document).scrollTop($(document).height());

                            // $("ul li").each(function(i, value){
                            //             height += parseInt($(this).height());
                            //         });
                            // height += '';
                            $('#ulchat').scrollTop($('#ulchat')[0].scrollHeight);
                            
                            // $('#tabledata').DataTable( {
                            //     dataResult: dataResult,
                            // } );
                        }
                    });
                },1000);
            });
        </script>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.sendmessage').on('click', function() {
                    var message = $('#messagebox').val();
                    var getmember_id = $('#getmember_id').val();
                    $.ajax({ //create an ajax request to display.php
                        type: "POST",
                        url: "apiz/send_message.php",
                        data : {
                            getmember_id: getmember_id,
                            message: message,
                        },
                        success: function(dataResult) {
                            if (dataResult == "Send") {
                                document.getElementById("messagebox").value = "";
                                console.log(dataResult)
                            }else {
                                console.log(dataResult)
                                // alert("Not Send")
                            }
                        }
                    });
                });
            });
            
        </script>

        <script type="text/javascript">
            function uploadimage(e){
                // console.log(e)
            var fd = new FormData();
            var files = $('#file')[0].files;
            var getmember_id = $('#getmember_id').val();
            console.log(files , getmember_id)

            if(files.length > 0 ){
           fd.append('file',files[0]);
           fd.append('getmember_id', getmember_id);

            $.ajax({
                  url: 'apiz/uploadchatimage.php',
                  type: 'post',
                  data: fd,
                  enctype: 'multipart/form-data',
                  contentType: false,
                  processData: false,
                  success: function(response){
                     if(response != 0){
                        $("#img").attr("src",response); 
                        $(".preview img").show(); // Display image element
                        console.log(data)
                     }else{
                        alert('file not uploaded');
                        console.log(data)
                     }
                  },
               });
            }else{
               alert("Please select a file.");
            }
            }
        </script>

         <!-- <script>
            $(document).ready(function(){
                    $('.getne').on('click', function() {
                        var receiver = $("#receiver_id").val();
                        var id = $(this).attr('alt');
                        if (receiver == id) {}
                        else
                        {
                            var sender = <?php echo $EMP_Data[0]['id']?>;
                            $.ajax({
                                type:"POST",
                                url:"<?php echo base_url().'Chat/employee_click'?>",
                                data:{id,sender},
                                success:function(data)
                                {
                                    $(".loader_person").css('display','none');
                                    $("#window").html(data);
                                    $("div .chats").each(function(i, value){
                                        height += parseInt($(this).height());
                                    });
                                    height += '';
                                    $("div").animate({scrollTop: height});
                                    
                                } 
                            });
                        }
                });
            }); 
        </script>  -->

    </body>

    </html>