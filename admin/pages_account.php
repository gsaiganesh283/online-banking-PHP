<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();

$admin_id = $_SESSION['admin_id'];

// Update logged in user account
if (isset($_POST['update_account'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $admin_id = $_SESSION['admin_id'];
    $profile_pic = '';

    $target_dir = "../admin/dist/img/";

    // Handle file upload
    if (!empty($_FILES["profile_pic"]["name"])) {
        $file_name = basename($_FILES["profile_pic"]["name"]);
        $target_file = $target_dir . $file_name;
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Validate file type (for example: only allow images)
        $allowed_types = array('jpg', 'jpeg', 'png', 'gif');
        if (in_array($file_type, $allowed_types)) {
            if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                $profile_pic = $file_name;
            } else {
                $err = "Sorry, there was an error uploading your file.";
            }
        } else {
            $err = "Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.";
        }
    }

    // Handle webcam capture
    if (!empty($_POST['profile_pic_data'])) {
        $img = str_replace('data:image/png;base64,', '', $_POST['profile_pic_data']);
        $img = str_replace(' ', '+', $img);
        $imgData = base64_decode($img);
        $profile_pic = "profile_" . $admin_id . ".png";
        file_put_contents($target_dir . $profile_pic, $imgData);
    }

    // Update user details in database
    $query = "UPDATE iB_admin SET name=?, email=?, profile_pic=? WHERE admin_id=?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param('sssi', $name, $email, $profile_pic, $admin_id);
        $stmt->execute();
        if ($stmt->affected_rows > 0) {
            $success = "Account Updated";
        } else {
            $err = "No changes detected or update failed.";
        }
        $stmt->close();
    } else {
        $err = "Database query failed.";
    }
}

// Change password
if (isset($_POST['change_password'])) {
    $old_password = sha1(md5($_POST['old_password']));
    $new_password = sha1(md5($_POST['new_password']));
    $admin_id = $_SESSION['admin_id'];

    // Validate old password (optional)
    $query = "SELECT password FROM iB_admin WHERE admin_id=?";
    $stmt = $mysqli->prepare($query);
    if ($stmt) {
        $stmt->bind_param('i', $admin_id);
        $stmt->execute();
        $stmt->bind_result($current_password);
        $stmt->fetch();
        if ($current_password !== $old_password) {
            $err = "Old password is incorrect.";
        } else {
            // Update password in database
            $query = "UPDATE iB_admin SET password=? WHERE admin_id=?";
            $stmt = $mysqli->prepare($query);
            if ($stmt) {
                $stmt->bind_param('si', $new_password, $admin_id);
                $stmt->execute();
                if ($stmt->affected_rows > 0) {
                    $success = "Password Updated";
                } else {
                    $err = "Password update failed.";
                }
                $stmt->close();
            } else {
                $err = "Database query failed.";
            }
        }
    } else {
        $err = "Database query failed.";
    }
}

?>
<!-- Log on to codeastro.com for more projects! -->
<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include("dist/_partials/nav.php"); ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include("dist/_partials/sidebar.php"); ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header with logged in user details (Page header) -->
            <?php
            $ret = "SELECT * FROM iB_admin WHERE admin_id = ?";
            $stmt = $mysqli->prepare($ret);
            if ($stmt) {
                $stmt->bind_param('i', $admin_id);
                $stmt->execute();
                $res = $stmt->get_result();
                while ($row = $res->fetch_object()) {
                    $profile_picture = $row->profile_pic == '' ? 
                        "<img class='img-fluid' src='dist/img/my_photo.jpg' alt='Admin profile picture'>" : 
                        "<img class='img-fluid' src='dist/img/$row->profile_pic' alt='Admin profile picture'>";
            ?>
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1><?php echo htmlspecialchars($row->name); ?> Profile</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pages_account.php">Profile</a></li>
                                    <li class="breadcrumb-item active"><?php echo htmlspecialchars($row->name); ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-3">
                                <!-- Profile Image -->
                                <div class="card card-purple card-outline">
                                    <div class="card-body box-profile">
                                        <div class="text-center">
                                            <?php echo $profile_picture; ?>
                                        </div>

                                        <h3 class="profile-username text-center"><?php echo htmlspecialchars($row->name); ?></h3>

                                        <p class="text-muted text-center">Admin@iBanking</p>

                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>Email: </b> <a class="float-right"><?php echo htmlspecialchars($row->email); ?></a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>Admin ID: </b> <a class="float-right"><?php echo htmlspecialchars($row->number); ?></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <!-- /.col -->
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header p-2">
                                        <ul class="nav nav-pills">
                                            <li class="nav-item"><a class="nav-link active" href="#update_Profile" data-toggle="tab">Update Profile</a></li>
                                            <li class="nav-item"><a class="nav-link" href="#Change_Password" data-toggle="tab">Change Password</a></li>
                                        </ul>
                                    </div><!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="tab-content">
                                            <!-- / Update Profile -->
                                            <div class="tab-pane active" id="update_Profile">
                                                <form method="post" class="form-horizontal" enctype="multipart/form-data">
                                                    <div class="form-group row">
                                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" required class="form-control" value="<?php echo htmlspecialchars($row->name); ?>" id="inputName">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                                        <div class="col-sm-10">
                                                            <input type="email" name="email" required value="<?php echo htmlspecialchars($row->email); ?>" class="form-control" id="inputEmail">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Admin ID</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->number; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Moblie Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_moblie_number; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Data of Birth</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_dob; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Aadhra Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_aadhra_number; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">PAN Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_pan_number; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Passport Number</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_passport_number; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Address</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" required readonly name="number" value="<?php echo $row->admin_address; ?>" id="inputName2">
                                                        </div>
                                                    </div>
                                                    <!-- Additional fields omitted for brevity -->
                                                    <div class="form-group row">
                                                        <label for="inputName2" class="col-sm-2 col-form-label">Profile Picture</label>
                                                        <div class="input-group col-sm-10">
                                                            <div class="custom-file">
                                                                <input type="file" name="profile_pic" class="form-control custom-file-input" id="exampleInputFile">
                                                                <label class="custom-file-label col-form-label" for="exampleInputFile">Choose file</label>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="input-group col-sm-10">
                                                            <div class="mt-3">
                                                                <input type="checkbox" id="use_webcam" name="use_webcam"> 
                                                                <label for="use_webcam">Use Webcam to Capture Photo</label>
                                                            </div>
                                                            <div id="webcam_container" style="display:none;" class="mt-6">
                                                                <video id="video" width="320" height="240" autoplay></video>
                                                                <button id="snap" type="button" class="btn btn-primary mt-2">Capture Photo</button>
                                                                <canvas id="canvas" width="320" height="240" style="display:none;"></canvas>
                                                            </div>
                                                            <input type="hidden" id="profile_pic_data" name="profile_pic_data">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-2 col-sm-10">
                                                            <button name="update_account" type="submit" class="btn btn-outline-success">Update Account</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <!-- /Change Password -->
                                            <div class="tab-pane" id="Change_Password">
                                                <form method="post" class="form-horizontal">
                                                    <div class="form-group row">
                                                        <label for="inputOldPassword" class="col-sm-2 col-form-label">Old Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="old_password" class="form-control" required id="inputOldPassword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputNewPassword" class="col-sm-2 col-form-label">New Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="new_password" class="form-control" required id="inputNewPassword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <label for="inputConfirmPassword" class="col-sm-2 col-form-label">Confirm New Password</label>
                                                        <div class="col-sm-10">
                                                            <input type="password" name="confirm_password" class="form-control" required id="inputConfirmPassword">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="offset-sm-2 col-sm-10">
                                                            <button type="submit" name="change_password" class="btn btn-outline-success">Change Password</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div><!-- /.card-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <?php
                }
                $stmt->close();
            }
            ?>
        </div><!-- /.content-wrapper -->
        <?php include("dist/_partials/footer.php"); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script>
        const useWebcamCheckbox = document.getElementById('use_webcam');
        const webcamContainer = document.getElementById('webcam_container');
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const snap = document.getElementById('snap');
        const profilePicData = document.getElementById('profile_pic_data');

        // Toggle webcam interface
        useWebcamCheckbox.addEventListener('change', function() {
            if (this.checked) {
                webcamContainer.style.display = 'block';
                startWebcam();
            } else {
                webcamContainer.style.display = 'none';
                stopWebcam();
            }
        });

        function startWebcam() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                })
                .catch(error => {
                    console.error("Error accessing webcam: ", error);
                });
        }

        function stopWebcam() {
            const stream = video.srcObject;
            const tracks = stream.getTracks();

            tracks.forEach(function(track) {
                track.stop();
            });

            video.srcObject = null;
        }

        // Capture photo from video stream
        snap.addEventListener('click', function() {
            canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataUrl = canvas.toDataURL('image/png');
            profilePicData.value = dataUrl;
            canvas.style.display = 'block';
        });
    </script>
</body>
</html>
