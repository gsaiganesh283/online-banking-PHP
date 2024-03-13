<?php
session_start();
include('conf/config.php');

//register new account
if (isset($_POST['create_account'])) {
  //Register  Client
  $name = $_POST['name'];
  $gender= $_POST['gender'];
  $acc_type=$_POST['acc_type'];
  $client_national_id = $_POST['client_national_id'];
  $client_number = $_POST['client_number'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $address= $_POST['address'];
  $dob= $_POST['dob'];
  $pan_no = $_POST['pan_no'];
  $sign= $_POST['sign'];
  $password = sha1(md5($_POST['password']));

  //$profile_pic  = $_FILES["profile_pic"]["name"];
  //move_uploaded_file($_FILES["profile_pic"]["tmp_name"],"dist/img/".$_FILES["profile_pic"]["name"]);

  //Insert Captured information to a database table
  $query = "INSERT INTO iB_bankaccounts (name, gender,acc_type,client_national_id, client_number, phone, email,address,dob,pan_no,sign, password) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  //bind paramaters
  $rc = $stmt->bind_param('ssssssssssss', $name,$gender,$acc_type,$client_national_id,$client_number,$phone,$email,$address,$dob,$pan_no,$sign,$password);
  $stmt->execute();

  //declare a varible which will be passed to alert function
  if ($stmt) {
    $success = "Account Created";
  } else {
    $err = "Please Try Again Or Try Later";
  }
}

/* Persisit System Settings On Brand */
$ret = "SELECT * FROM `iB_SystemSettings` ";
$stmt = $mysqli->prepare($ret);
$stmt->execute(); //ok
$res = $stmt->get_result();
while ($auth = $res->fetch_object()) {
?>
  <!DOCTYPE html>
  <html><!-- Log on to codeastro.com for more projects! -->
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <?php include("dist/_partials/head.php"); ?>

  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <p><?php echo $auth->sys_name; ?> - Sign Up</p>
      </div>
      <!-- /.login-logo -->
      <div class="card">
        <div class="card-body login-card-body">
          <p class="login-box-msg">Sign Up To Use Our IBanking System</p>

          <form method="post">
            <div class="input-group mb-3">
              <input type="text" requried name="name" required class="form-control" placeholder="User Full Name">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" requried name="gender" required class="form-control" placeholder="Gender">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="acc_type" required class="form-control" placeholder="Account Type">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-user"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" required name="client_national_id" class="form-control" placeholder="Aadhar Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-tag"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3" style="display:none">
              <?php
              //PHP function to generate random
              $length = 4;
              $_Number =  substr(str_shuffle('0123456789'), 1, $length); ?>
              <input type="text" name="client_number" value="iBank-CLIENT-<?php echo $_Number; ?>" class="form-control" placeholder="User Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="phone" required class="form-control" placeholder="Phone Number">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-phone"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="text" name="address" required class="form-control" placeholder="Address">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-map-marker"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="email" name="email" required class="form-control" placeholder="Email ID">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <div class="input-group mb-3">
              <input type="text" name="dob" required class="form-control" placeholder="Data of Birth (dd/mm/yyyy)">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-marker"></span>
                </div>
              </div>
              <div class="input-group mb-3">
              <input type="text" name="pan_no" required class="form-control" placeholder="Pan Card No">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              <div class="input-group mb-3">
              <input type="text" name="sign" required class="form-control" placeholder="Signature">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
              
              </div>
            </div><!-- Log on to codeastro.com for more projects! -->
            <div class="input-group mb-3">
              <input type="password" name="password" required class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
              </div>
              <!-- /.col -->
              <div class="col-8">
                <button type="submit" name="create_account" class="btn btn-success btn-block">Sign Up</button>
              </div>
              <!-- /.col -->
            </div>
          </form>

          <p class="mb-0">
            <a href="pages_client_index.php" class="text-center">Login</a>
          </p>

        </div>
        <!-- /.login-card-body -->
      </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>

  </body>

  </html>
<?php
} ?>