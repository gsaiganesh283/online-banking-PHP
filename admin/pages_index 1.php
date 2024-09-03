<?php
session_start();
include('conf/config.php');

// Handle Login with Email/Password
if (isset($_POST['login'])) {
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $password = isset($_POST['password']) ? sha1(md5($_POST['password'])) : '';

    if (!empty($email) && !empty($password)) {
        $stmt = $mysqli->prepare("SELECT email, password, admin_id FROM iB_admin WHERE email=? AND password=?");
        $stmt->bind_param('ss', $email, $password);
        $stmt->execute();
        $stmt->bind_result($email, $password, $admin_id);
        $rs = $stmt->fetch();
        if ($rs) {
            $_SESSION['admin_id'] = $admin_id;
            header("location:pages_dashboard.php");
            exit();
        } else {
            $err = "Access Denied Please Check Your Credentials";
        }
    } else {
        $err = "Please fill in all required fields.";
    }
}

// Handle Fingerprint Authentication
if (isset($_POST['fingerprint_data'])) {
  $fingerprint_data = $_POST['fingerprint_data'];
  if (verify_fingerprint($fingerprint_data)) {
    $_SESSION['admin_id'] = get_admin_id_from_fingerprint($fingerprint_data);
    echo json_encode(['success' => true]);
  } else {
    echo json_encode(['success' => false]);
  }
  exit();
}

// Functions for Fingerprint Verification
function verify_fingerprint($fingerprint_data) {
  // Implement fingerprint verification logic
  return true; // placeholder
}

function get_admin_id_from_fingerprint($fingerprint_data) {
  // Implement logic to retrieve admin ID from fingerprint data
  return 1; // placeholder
}

// Fetch System Settings
$ret = "SELECT * FROM `iB_SystemSettings`";
$stmt = $mysqli->prepare($ret);
$stmt->execute();
$res = $stmt->get_result();
$auth = $res->fetch_object();
?>

<!DOCTYPE html>
<html>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<?php include("dist/_partials/head.php"); ?>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <p><?php echo $auth->sys_name; ?></p>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Log In To Start Administrator Session</p>

        <form id="login-form" method="post">
            <div id="login-fields" class="input-group mb-3">
                <input type="email" name="email" class="form-control" placeholder="Email">
                <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
                </div>
            </div>
          <div class="input-group mb-3">
              <input type="password" name="password" class="form-control" placeholder="Password">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-lock"></span>
                </div>
              </div>
            </div>
          <div id="fingerprint-section" class="d-none">
            <button type="button" id="fingerprint-login" class="btn btn-success btn-block">Login with Fingerprint</button>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="icheck-primary">
                <!-- <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label> -->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-8">
              <button type="submit" name="login" class="btn btn-danger btn-block">Log In as Admin</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <!-- /.social-auth-links -->

        <!-- <p class="mb-1">
          <a href="pages_reset_pwd.php">I forgot my password</a>
        </p> -->
        <!--
        Uncomment this line to allow account creations for admins
        
        <p class="mb-0">
          <a href="pages_signup.php" class="text-center">Register a new membership</a>
        </p>
        -->
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

  <!-- Fingerprint Script -->
  <script src="path/to/fingerprint.js"></script>
  <script>
    // Show the fingerprint login button if fingerprint sensor is available
    if (FingerprintSensor.isAvailable()) {
      document.getElementById('fingerprint-section').classList.remove('d-none');
    }

    document.getElementById('fingerprint-login').addEventListener('click', function() {
      FingerprintSensor.authenticate().then(function(result) {
        // Send the fingerprint result to the server for verification
        fetch('login.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            fingerprint_data: result.fingerprintData
          })
        }).then(response => response.json())
          .then(data => {
            if (data.success) {
              window.location.href = 'pages_dashboard.php';
            } else {
              alert('Fingerprint authentication failed');
            }
          });
      }).catch(function(error) {
        console.error('Fingerprint authentication error:', error);
      });
    });
  </script>

</body>
</html>
