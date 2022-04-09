<?php
include('./function.php');

include('./header.php'); 

if(isset($_GET['fn']) && isset($_GET['em'])){
    $fn = $_GET['fn']; $em = $_GET['em']; 
     $toast= "success"; 
     echo "<script>location.href='login.php'</script>";
     //header("Refresh:3,url=login.php");
}
else{$toast= "fail"; echo "<script>location.href='register.php'</script>";}
?>
<body class="page-user" style="background-color: #fff !important;">
    <div class="row">
 <div class="col-12">
    <center>
    <h3>Welcome to Electrum <span style="border: 3px solid #FF880E; border-radius:50%;margin-left:1px; padding:2px; background:#FF880E; color:#fff;">FX</span></h3>!<br>
<p><big>You will be redirected to the Login if verification is successful. Otherwise you will be sent back to the registration page to register your correct details</big><br> 
<small>We wish you safe trade, swift and secure transactions with Electrum <span style="border: 3px solid #FF880E; border-radius:50%;margin-left:1px; padding:2px; background:#FF880E; color:#fff;">FX</span></small></p>
</center>
</div></div>
 

    <!-- jQuery 3 --> 
<script src="dist/js/jquery.min.js"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="dist/bootstrap/js/bootstrap.min.js"></script> 

<!-- template --> 
<script src="dist/js/niche.js"></script> 

<!-- jQuery UI 1.11.4 --> 
<script src="dist/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Toastr -->
<script src="dist/js/toastr.min.js"></script>
    </body>
    </html>
    <?php
if(isset($toast) && $toast==='success'){echo "<script>toastr.success('You will be redirected to login.', 'Successful Verification')</script>";}

if(isset($toast) && $toast==='fail'){echo "<script>toastr.error('Registration not successful, please attempt again.', 'Registration Error')</script>";}
?>

