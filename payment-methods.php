<?php
include 'includes/config.php';

if (!isset($_SESSION['useradmin'])) {
    echo '<script>alert("Please Login First");window.location = "index.php";</script>';
}
$usertype = $_SESSION['useradmin'];

if (isset($_POST['add_method'])) {
    $method_name = $_POST['method_name'];
    $upi_id = $_POST['upi_id'];

    $sql = "INSERT INTO `payment_methods` (`method_name`, `upi_id`) VALUES ('$method_name', '$upi_id')";
    if (!mysqli_query($conn, $sql)) {
        $error = "Failed to Add Payment Method";
    } else {
        $msg = "Payment Method Added Successfully";
    }
}

if (isset($_POST['remove_method'])) {
    $method_id = $_POST['method_id'];

    $sql = "DELETE FROM `payment_methods` WHERE `id` = '$method_id'";
    if (!mysqli_query($conn, $sql)) {
        $error = "Failed to Remove Payment Method";
    } else {
        $msg = "Payment Method Removed Successfully";
    }
}

if (isset($_POST['edit_method'])) {
    $method_id = $_POST['method_id'];
    $new_upi_id = $_POST['upi_id'];

    $sql = "UPDATE `payment_methods` SET `upi_id` = '$new_upi_id' WHERE `id` = '$method_id'";
    if (!mysqli_query($conn, $sql)) {
        $error = "Failed to Update Payment Method";
    } else {
        $msg = "Payment Method Updated Successfully";
    }
}
if (isset($_POST['qrCodeUrl'])) {
    $qrCodeUrl = $_POST['qrCodeUrl'];

    // Update the database with the QR code URL
    $sql = "UPDATE payment_qr SET qr_code_url = ? WHERE id=1"; // Adjust as needed
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $qrCodeUrl);

    if ($stmt->execute()) {
        echo 'QR code URL updated successfully';
    } else {
        echo 'Error updating QR code URL: ' . $stmt->error;
    }

}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Payment Methods</title>
    
    <!-- Meta Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="adminassets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="adminassets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="adminassets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <!-- Datatables Css -->
    <link href="adminassets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="adminassets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
    
    <!-- App Css-->
    <link href="adminassets/css/app.min.css?v=2" id="app-style" rel="stylesheet" type="text/css" />
    <link href="adminassets/css/custom.css?v=11" rel="stylesheet" type="text/css" />
    

</head>

<body data-sidebar="dark">

    <!-- Layout Wrapper -->
    <div id="layout-wrapper">
        <?php include 'includes/header.php';  ?>

        <!-- Main Content -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Payment Methods List</h4>

                                    <!-- Add New Payment Method -->
                                    <div class="mb-3">
                                        <input type="text" id="method_name" placeholder="Payment Method Name" class="form-control mb-2" />
                                        <input type="text" id="upi_id" placeholder="UPI ID" class="form-control mb-2" />
                                        <button id="add_method" class="btn btn-primary">Add Payment Method</button>
                                    </div>
                                    <!-- QR Code Section -->
<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">QR Code</h4>

        <!-- QR Code Image View -->
        <div id="qrCodeContainer">
     <?php 
        $getsql = "SELECT qr_code_url FROM payment_qr WHERE id = 1";
        $getqry = mysqli_query($conn, $getsql);
        if (mysqli_num_rows($getqry) > 0) {
       while ($row = mysqli_fetch_assoc($getqry)) {
            $qrCodeUrl = $row['qr_code_url'];
        // No QR code URL found
        }
        }
        ?>
            <img id="qrCodeImage" src="<?php echo htmlspecialchars($qrCodeUrl); ?>" alt="QR Code" style="max-width: 30%; height: auto;" />
        </div>

        <!-- Upload QR Code Image -->
        <div class="mb-3 mt-3">
            <input type="file" id="qrCodeFile" class="form-control mb-2" />
            <button id="uploadQrCode" class="btn btn-primary">Upload QR Code</button>
        </div>
    </div>
</div>


                                    <!-- Table for Payment Methods -->
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered" id="paymentMethodList">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Method Name</th>
                                                    <th>UPI ID</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $getsql = "SELECT * FROM payment_methods ORDER BY id DESC";
                                                $getqry = mysqli_query($conn, $getsql);
                                                $i = 1;

                                                if (mysqli_num_rows($getqry) > 0) {
                                                    while ($row = mysqli_fetch_assoc($getqry)) {
                                                        $id = $row['id'];
                                                        $method_name = $row['method_name'];
                                                        $upi_id = $row['upi_id'];
                                                ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php echo $method_name; ?></td>
                                                            <td><?php echo $upi_id; ?></td>
                                                            <td>
                                                                <button class="btn btn-warning btn-edit" data-id="<?php echo $id; ?>" data-upi-id="<?php echo $upi_id; ?>">Edit</button>
                                                                <button class="btn btn-danger btn-remove" data-id="<?php echo $id; ?>">Remove</button>
                                                            </td>
                                                        </tr>
                                                <?php 
                                                        $i++;
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='4'>No payment methods found</td></tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- Edit Payment Method Modal -->
                                    <div id="editModal" style="display: none;">
                                        <h4>Edit Payment Method</h4>
                                        <input type="hidden" id="edit_method_id" />
                                        <input type="text" id="edit_upi_id" placeholder="UPI ID" class="form-control mb-2" />
                                        <button id="save_edit" class="btn btn-primary">Save</button>
                                        <button id="cancel_edit" class="btn btn-secondary">Cancel</button>
                                    </div>

                                    <div id="msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Matka.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-right d-none d-sm-block">
                                Designed & Developed by Your Company
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Snackbar -->
    <div id="snackbar"></div>
    <div id="snackbar-info"></div>
    <div id="snackbar-error"></div>
    <div id="snackbar-success"></div>

    <!-- Scripts -->
    <script src="adminassets/libs/jquery/jquery.min.js"></script>
    <script src="adminassets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="adminassets/libs/metismenu/metisMenu.min.js"></script>
    <script src="adminassets/libs/simplebar/simplebar.min.js"></script>
    <script src="adminassets/libs/node-waves/waves.min.js"></script>
    <script src="adminassets/libs/select2/js/select2.min.js"></script>
    <script src="adminassets/js/pages/form-advanced.init.js"></script>
    <script src="adminassets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="adminassets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="adminassets/libs/jszip/jszip.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="adminassets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="adminassets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <script src="adminassets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="adminassets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <script src="adminassets/js/pages/datatables.init.js"></script>
    <script src="adminassets/js/app.js"></script>
    <script src="adminassets/js/customjs.js?v=4428"></script>

 <!-- Firebase SDKs -->
    <script type="module">
        // Import the necessary Firebase modules
        import { initializeApp } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js';
        import { getStorage, ref, uploadBytes, getDownloadURL } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-storage.js';
        import { getFirestore, doc, setDoc } from 'https://www.gstatic.com/firebasejs/9.14.0/firebase-firestore.js';

        // Initialize Firebase
        const firebaseConfig = {
            apiKey: "AIzaSyBCGWV7SAYezqed4-FMzp2MUjLOHaXvsWQ",
            authDomain: "chat-42779.firebaseapp.com",
            databaseURL: "https://chat-42779-default-rtdb.asia-southeast1.firebasedatabase.app",
            projectId: "chat-42779",
            storageBucket: "chat-42779.appspot.com",
            messagingSenderId: "557414302603",
            appId: "1:557414302603:web:9baf81483b82ea06a7258e",
            measurementId: "G-QN59WSLSE8"
        };

        const app = initializeApp(firebaseConfig);
        const storage = getStorage(app);
        const firestore = getFirestore(app);

        document.getElementById('uploadQrCode').addEventListener('click', function () {
            const fileInput = document.getElementById('qrCodeFile');
            const file = fileInput.files[0];
            
            if (file) {
                const storageRef = ref(storage, 'qrCodes/' + file.name);
                
                uploadBytes(storageRef, file).then((snapshot) => {
                    console.log('Uploaded a file!');
                    return getDownloadURL(storageRef);
                }).then((downloadURL) => {
                    // Update the QR code image view
                    document.getElementById('qrCodeImage').src = downloadURL;

                    // Save the image URL to the database
                    saveQrCodeUrlToDatabase(downloadURL);
                }).catch((error) => {
                    console.error('Error uploading file:', error);
                });
            } else {
                alert('Please select an image file to upload.');
            }
        });

        function saveQrCodeUrlToDatabase(url) {
    // Replace with your code to save the URL to the database
    // Example with PHP:
    $.ajax({
        url: 'payment-methods.php', // PHP script to update the QR code URL
        method: 'POST',
        data: { qrCodeUrl: url },
        success: function (response) {
            // Handle success
            console.log('QR code URL saved successfully');
        },
        error: function (xhr, status, error) {
            // Handle error
            console.error('Error saving QR code URL:', error);
        }
    });
}
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#paymentMethodList').DataTable();

            // Add Payment Method
            $('#add_method').on('click', function() {
                var method_name = $('#method_name').val();
                var upi_id = $('#upi_id').val();

                if (method_name && upi_id) {
                    $.post("payment-methods.php", {
                        add_method: true,
                        method_name: method_name,
                        upi_id: upi_id
                    }, function(response) {
                        location.reload();  // Reload the page to see changes
                    });
                } else {
                    alert("Please enter all details");
                }
            });

            // Remove Payment Method
            $('.btn-remove').on('click', function() {
                var method_id = $(this).data('id');

                $.post("payment-methods.php", {
                    remove_method: true,
                    method_id: method_id
                }, function(response) {
                    location.reload();  // Reload the page to see changes
                });
            });

            // Edit Payment Method
            $('.btn-edit').on('click', function() {
                var method_id = $(this).data('id');
                var upi_id = $(this).data('upi-id');

                $('#edit_method_id').val(method_id);
                $('#edit_upi_id').val(upi_id);

                $('#editModal').show();
            });

            // Save Edit
            $('#save_edit').on('click', function() {
                var method_id = $('#edit_method_id').val();
                var upi_id = $('#edit_upi_id').val();

                if (upi_id) {
                    $.post("payment-methods.php", {
                        edit_method: true,
                        method_id: method_id,
                        upi_id: upi_id
                    }, function(response) {
                        location.reload();  // Reload the page to see changes
                    });
                } else {
                    alert("Please enter a new UPI ID");
                }
            });

            // Cancel Edit
            $('#cancel_edit').on('click', function() {
                $('#editModal').hide();
            });
        });
    </script>
</body>

</html>

