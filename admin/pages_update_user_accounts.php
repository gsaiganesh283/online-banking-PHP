<?php
session_start();
include('conf/config.php');
include('conf/checklogin.php');
check_login();
$admin_id = $_SESSION['admin_id'];
//register new account
if (isset($_POST['update_account'])) {
    //Client open account
    $name = $_POST['name'];
    $account_number = $_POST['account_number'];
    $acc_type = $_POST['acc_type'];
    $acc_rates = $_POST['acc_rates'];
    $acc_status = $_POST['acc_status'];
    $acc_amount = $_POST['acc_amount'];
    $account_id  = $_GET['account_id'];
    $client_national_id = $_POST['client_national_id'];
    $client_name = $_POST['client_name'];
    $client_phone = $_POST['client_phone'];
    $client_number = $_POST['client_number'];
    $client_email  = $_POST['client_email'];
    $client_adr  = $_POST['client_adr'];
    $email=$_POST['email'];
    $contact=$_POST['contact'];
    $dob=$_POST['dob'];
    $gender=$_POST['gender'];
    $aadhar=$_POST['aadhar'];
    $pan_no=$_POST['pan_no'];
    $address=$_POST['address'];
    $signature=$_POST['signature'];

    //Insert Captured information to a database table
    $query = "UPDATE  iB_bankAccounts  SET name=?, account_number=?, acc_type=?, acc_rates=?, acc_status=?, acc_amount=?, 
    client_name=?, client_national_id=?, client_phone=?, client_number=?, 
    client_email=?, client_adr=?, email=?, contact=?, dob=?, gender=?, aadhar=?, pan_no=?, address=?, signature=? WHERE account_id =?";
    $stmt = $mysqli->prepare($query);
    //bind paramaters
    $rc = $stmt->bind_param('ssssssssssssssssssssi', $name, $account_number, $acc_type, $acc_rates, $acc_status, $acc_amount,
     $client_name, $client_national_id, $client_phone, $client_number, $client_email, $client_adr,
    $email,$contact,$dob,$gender,$aadhar,$pan_no,$address,$signature, $account_id);
    $stmt->execute();

    //declare a varible which will be passed to alert function
    if ($stmt) {
        $success = "iBank Account Updated";
    } else {
        $err = "Please Try Again Or Try Later";
    }
}

?>
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
        <?php
        $account_id = $_GET['account_id'];
        $ret = "SELECT * FROM  iB_bankAccounts WHERE account_id = ? ";
        $stmt = $mysqli->prepare($ret);
        $stmt->bind_param('i', $account_id);
        $stmt->execute(); //ok
        $res = $stmt->get_result();
        $cnt = 1;
        while ($row = $res->fetch_object()) {

        ?>
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                <h1>Update <?php echo $row->client_name; ?> iBanking Account</h1>
                            </div>
                            <div class="col-sm-6">
                                <ol class="breadcrumb float-sm-right">
                                    <li class="breadcrumb-item"><a href="pages_dashboard.php">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="pages_open_acc.php">iBanking Accounts</a></li>
                                    <li class="breadcrumb-item"><a href="pages_open_acc.php">Manage </a></li>
                                    <li class="breadcrumb-item active"><?php echo $row->client_name; ?></li>
                                </ol>
                            </div>
                        </div>
                    </div><!-- /.container-fluid -->
                </section>

                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <!-- left column -->
                            <div class="col-md-12">
                                <!-- general form elements -->
                                <div class="card card-purple">
                                    <div class="card-header">
                                        <h3 class="card-title">Fill All Fields</h3>
                                    </div>
                                    <!-- form start -->
                                    <form method="post" enctype="multipart/form-data" role="form">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Branch Name</label>
                                                    <input type="text" readonly name="client_name" value="<?php echo $row->client_name; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputPassword1">Branch Number</label>
                                                    <input type="text" readonly name="client_number" value="<?php echo $row->client_number; ?>" class="form-control" id="exampleInputPassword1">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Branch Phone Number</label>
                                                    <input type="text" readonly name="client_phone" value="<?php echo $row->client_phone; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputPassword1">Branch National ID No.</label>
                                                    <input type="text" readonly value="<?php echo $row->client_national_id; ?>" name="client_national_id" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Branch Email</label>
                                                    <input type="email" readonly name="client_email" value="<?php echo $row->client_email; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Branch Address</label>
                                                    <input type="text" name="client_adr" readonly value="<?php echo $row->client_adr; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>
                                            <!-- ./End Personal Details -->

                                            <!--Bank Account Details-->

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Name</label>
                                                    <input type="text" name="name" value="<?php echo $row->name; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                

                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Number</label>
                                                    <input type="text" readonly name="account_number" value="<?php echo $row->account_number; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                            </div>

                                            <div class = "row">
                                                
                                                <!-- <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Name</label>
                                                    <input type="text" name="name" value="<?php echo $row->name; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div> -->
                                                                         <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Email</label>
                                                                            <input type="text" name="email" value="<?php echo $row->email; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                 <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Contact</label>
                                                    <input type="text" name="contact" value="<?php echo $row->contact; ?>" required class="form-control" id="exampleInputEmail1">
                                                </div>
                                                                    </div>
                                                                    <div class = "row">
                                                                         <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Date of Birth</label>
                                                                            <input type="text" readonly name="dob" value="<?php echo $row->dob; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                        <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Gender</label>
                                                                            <!-- <select class="form-control" name="gender">
                                                                                <option>Select Gender</option>
                                                                                <option>Female</option>
                                                                                <option>Male</option>
                                                                            </select> -->
                                                                            <input type="text" readonly name="gender" value="<?php echo $row->gender; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                    </div>
                                                                    <div class = "row">
                                                                         <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Aadhar</label>
                                                                            <input type="text" readonly name="aadhar" value="<?php echo $row->aadhar; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                        <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Pan Number</label>
                                                                            <input type="text" readonly name="pan_no" value="<?php echo $row->pan_no; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                    </div>
                                                                    <div class = "row">
                                                                         <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Address</label>
                                                                            <input type="text" name="address" value="<?php echo $row->address; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                        <div class=" col-md-6 form-group">
                                                                            <label for="exampleInputEmail1">Account Signature</label>
                                                                            <input type="text" name="signature" value="<?php echo $row->signature; ?>" required class="form-control" id="exampleInputEmail1">
                                                                        </div>
                                                                    </div>

                                            <div class="row">
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Type</label>
                                                    <select class="form-control" onChange="getiBankAccs(this.value);" name="acc_type">
                                                        <option>Select Any Account types</option>
                                                        <?php
                                                        //fetch all iB_Acc_types
                                                        $ret = "SELECT * FROM  iB_Acc_types ORDER BY RAND() ";
                                                        $stmt = $mysqli->prepare($ret);
                                                        $stmt->execute(); //ok
                                                        $res = $stmt->get_result();
                                                        $cnt = 1;
                                                        while ($row = $res->fetch_object()) {

                                                        ?>
                                                            <option value="<?php echo $row->name; ?> "> <?php echo $row->name; ?> </option>
                                                        <?php } ?>
                                                    </select>

                                                </div>
                                                <div class=" col-md-6 form-group">
                                                    <label for="exampleInputEmail1">Account Type Rates (%)</label>
                                                    <input type="text" name="acc_rates" readonly required class="form-control" id="AccountRates">
                                                </div>

                                                <div class=" col-md-6 form-group" style="display:none">
                                                    <label for="exampleInputEmail1">Account Status</label>
                                                    <input type="text" name="acc_status" value="Active" readonly required class="form-control">
                                                </div>

                                                <div class=" col-md-6 form-group" style="display:none">
                                                    <label for="exampleInputEmail1">Account Amount</label>
                                                    <input type="text" name="acc_amount" value="0" readonly required class="form-control">
                                                </div>
                                                </div>

                                                </div>                                                

                                            </div>
                                            
                                        </div>
                                        
                                        <!-- /.card-body -->
                                        <div class="card-footer">
                                            <button type="submit" name="update_account" class="btn btn-success">Update iBanking Account</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /.card -->
                            </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
        <?php } ?>
        <!-- /.content-wrapper -->
        <?php include("dist/_partials/footer.php"); ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            bsCustomFileInput.init();
        });
    </script>
</body>

</html>