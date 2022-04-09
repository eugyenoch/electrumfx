<?php
include('function.php');
//Define empty variables
$fname = $lname = $email = $pass = $cpass = "";

//Define empty error variables
$fnameErr = $lnameErr = $emailErr = $passErr = $cpassErr = $cpassesErr = $checkErr = ""; 

//Test for valid(empty) and invalid(non-empty) form fields
if($_SERVER['REQUEST_METHOD']=="POST"){
  if(empty($_POST['fname'])){
    $fnameErr = "Firstname is required";
  }
  else{
    $fname = sanitize($_POST['fname']);
  }

  if(empty($_POST['lname'])){
    $lnameErr = "Lastname is required";
  }
  else{
    $lname = sanitize($_POST['lname']);
  }

  if(empty($_POST['email'])){
    $emailErr = "Email is required";
  }
  else{
    $email = sanitize($_POST['email']);
  }

  if(empty($_POST['pwd'])){
    echo "<style>.note{display:none !important;</style>";
    $passErr = "Password is required";
  }
  else{
    $pass = md5($_POST['pwd']);
  }

  if(empty($_POST['cpwd'])){
    echo "<style>.note{display:none !important;</style>";
    $cpassErr = "Confirm password is required";
  }
  else{
    $cpass = md5($_POST['cpwd']);
  }

  if($pass !== $cpass){
    $cpassesErr = "Both passwords do not match";
  }

  if(!isset($_POST['agreement'])){
    $checkErr = "Please agree to our terms";
  }
}
?>
<?php
if(isset($_POST['reg'])){
  $affid = $_POST['affid'];
  if($pass===$cpass){
   // $active = "<a href='https://electrumfx.org/user/admin/login.php'>Login</a>";
    $sql_check_email_exists = "SELECT * FROM users WHERE user_email = '$email'";
    $sql_check_email_exec = $con->query($sql_check_email_exists);
    if(mysqli_num_rows($sql_check_email_exec)>0){$toast = "email";}
    else{
  $sqlIns = "INSERT INTO users(firstname,lastname,user_email,user_pass,affid)VALUES('$fname','$lname','$email','$cpass','$affid')";
  $sqlC = $con->query($sqlIns);

  $sqlIns2 = "INSERT INTO fund(user_email,amount,status)VALUES('$email',50,'approved')";
  $sqlC2 = $con->query($sqlIns2);
 if($sqlC){
  $toast = "success";header("Refresh:2,url=preloader.php?fn=$fname&em=$email");
}else{$toast = "fail";} 
}
}}
 $con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Member Registration | Electrum FX</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1" />

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="dist/bootstrap/css/bootstrap.min.css">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="dist/css/style.css">
<link rel="stylesheet" href="dist/css/font-awesome/css/font-awesome.min.css">
<link rel="stylesheet" href="dist/css/et-line-font/et-line-font.css">
<link rel="stylesheet" href="dist/css/themify-icons/themify-icons.css">
<link rel="stylesheet" href="dist/plugins/hmenu/ace-responsive-menu.css">
<link rel="icon" href="dist/img/p2pdarkicon.png">

<!--Toastr-->
<link rel="stylesheet" type="text/css" href="dist/css/toastr.css">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="../custom.css">
</head>
<body class="hold-transition login-page sty1">
<div class="login-box sty1">
  <div class="login-box-body sty1">
  <div class="login-logo m-t-0 p-t-0">
    <a href="../index.php"><span class="lead cursive">Electrum<span style="border: 3px solid #FF880E; border-radius:50%;margin-left:1px; padding:2px; background:#FF880E; color:#fff;">FX</span></span></a>
  </div>
    <p class="login-box-msg m-t-0 p-t-0">Fill the form to create a trading account</p>
     <form action="<?= htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" name="regForm">
      <div class="form-group has-feedback">
        <input type="hidden" name="affid" class="form-control sty1" value="<?= mt_rand(100000,999999);?>">
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="fname" class="form-control sty1" placeholder="Firstname" required>
        <span class="err"><?= $fnameErr; ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" name="lname" class="form-control sty1" placeholder="Lastname" required>
        <span class="err"><?= $lnameErr; ?></span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" name="email" class="form-control sty1" placeholder="Email" title="Your email is your username" required>
        <span class="err"><?= $emailErr; ?></span>        
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="pwd" class="form-control sty1" placeholder="Password"required>
      <span class="note"><small>Choose a strong password</small></span>
      <span class="err"><?= $passErr; ?></span>
    </div>

      <div class="form-group has-feedback">
        <input type="password" name="cpwd" class="form-control sty1" title="Confirm password must match the initial password entered in the box above" placeholder="Confirm Password" required><span class="note"><small>must match password entered in the box above</small></span>
        <span class="err"><?= $cpassErr; ?></span><br>
         <span class="err"><?= $cpassesErr; ?></span>
      </div>
      <div>
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" name="agreement" required>
               I agree to the <a href="https://electrumfx.org/docs/terms-of-use.php" title="View terms of use" target="_blank" rel="noopener noreferrer">Terms Of Use</a></label><br>
               <span class="err"><?= $checkErr; ?></span>
             </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <div class="">Already have an account? <a href="login.php" class="text-center">Sign In</a></div>
          <button type="submit" class="btn btn-lg btn-block btn-flat" style="background:#FF880E; color:#fff;" name="reg">Sign Up</button>
        </div>
        <!-- /.col --> 
      </div> 
    </form>
  </div>  
   </div>
  </div>
  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 

<!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script>

<!--Toastr-->
<script type="text/javascript" src="dist/js/toastr.min.js"></script>
</body>
</html>
<?php
if(isset($toast) && $toast==='success'){
  echo "<script>toastr.success('Hold on! Lets verify and create your account', 'Notice')</script>";
}

if(isset($toast) && $toast==='fail'){
  echo "<script>toastr.error('You have not been successfully registered', 'Failure')</script>";
}

if(isset($toast) && $toast==='email'){
  echo "<script>toastr.error('The email already exists', 'Failure')</script>";
}
?>