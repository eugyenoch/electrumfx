<?php
//Require my functions.php file
include('function.php');
//Begin cookie and include the cookie file
include('cookie.php');

//$sessEmail = $_SESSION['email'];

$sql_active_transact = "SELECT * FROM `transaction` WHERE `user_email`='$session_email' AND `status`='approved'";
$sql_active_exec = $con->query($sql_active_transact);
$sql_count_active_exec = mysqli_num_rows($sql_active_exec);

if(!isset($_SESSION['email'])){header('Location:login.php');}
?>
<?php include('header.php'); ?>
<body class="page-user">

<?php include('nav.php'); ?>

<div>
<div class="page-content">
<div class="container">
    <div class="row">
<div class="col-lg-12 col-12">
<div class="token-information card card-full-height" style="border-radius: 20px;">
<div class="token-info">
<h1 class="token-info-head text-dark lead cursive">Wallet Area</h1>
<div class="gaps-2x"></div>
<!-- <h5 class="token-info-sub"> <a href="#starter-pack" data-toggle="modal" data-target="#starter-pack" class="btn btn-sm btn-outline btn-light">
                                <span class="icon-s"><i data-feather="file"></i></span>
                                <span>Starter Pack</span>
                            </a> <a href="#premium-pack" data-toggle="modal" data-target="#premium-pack" class="btn btn-sm btn-outline btn-light">
                                <span class="icon-s"><i data-feather="file"></i></span>
                                <span>Premium Pack</span>
                            </a> <a href="#gold-pack" data-toggle="modal" data-target="#gold-pack" class="btn btn-sm btn-outline btn-light">
                                <span class="icon-s"><i data-feather="file"></i></span>
                                <span>Gold Pack</span>
                            </a>
                            <a href="#gold-plus" data-toggle="modal" data-target="#gold-plus" class="btn btn-sm btn-outline btn-light">
                                <span class="icon-s"><i data-feather="file"></i></span>
                                <span>Gold Plus</span>
                            </a>
                        </h5> -->
</div>
</div>
</div>
</div>

<div class="row">
<!-- <div class="col-lg-6 col-6">
<div class="token-information card card-full-height" style="border-radius: 20px;">
<div class="token-info">
<h1 class="token-info-head text-light">Total Trades</h1>
<div class="gaps-2x"></div>
<h5 class="token-info-sub"><?php //if(isset($sql_count_row_exec4) && $sql_count_row_exec4!==null){echo $sql_count_row_exec4;}?></h5> 
</div>
</div> -->
<!-- .card -->
</div><!-- .col -->
<!-- <div class="col-lg-6 col-6">
<div class="token-information card card-full-height" style="border-radius:20px;">
<div class="token-info">
<h1 class="token-info-head text-light">Active Trades</h1>
<div class="gaps-2x"></div>
<h5 class="token-info-sub"><?php //if(isset($sql_count_active_exec) && $sql_count_active_exec!==null){echo $sql_count_active_exec;}?></h5> -->
</div>
</div>
<!-- .card -->
</div><!-- .col -->
<!-- <div class="col-lg-4 col-12 col-md-6">
<div class="token-information card card-full-height " style="border-radius: 20px;">
<div class="token-info">
<h1 class="token-info-head text-light">Completed Trades</h1>
<div class="gaps-2x"></div>
<h5 class="token-info-sub"><?php //if(isset($sql_count_active_exec) && $sql_count_active_exec!==null){echo $sql_count_active_exec;}?></h5>
</div>
</div> -->
<!-- .card -->
</div><!-- .col -->
<div class="col-lg-12 col-12 col-md-12 m-auto">
<div class="token-statistics card card-token height-auto" style="border-radius: 20px;">
<div class="card-innr">
<div class="token-balance token-balance-with-icon">

</div>
<div class="token-balance token-balance-s2">

<h3><center><span class="orange" style="border: 3px solid #FF880E; border-radius:50%;margin:auto; padding:4%; font-size:140px;"><i class="fa fa-wallet"></i></span></center></h3><br><br>
<h3 class="card-sub-title m-auto"><center>Total Balances:<br>
    <?php if(isset($fund_info['amount']))?>
</center></h3><br>
<ul class="token-balance-list row">
<li class="token-balance-sub col-md-12 col-lg-6 mb-3" hidden><?php
    foreach($sql_withdraw_exec as $withdraw_info){extract($withdraw_info);?>
<span class="lead"><?php if(isset($withdraw_info['wstatus']) && $withdraw_info['wstatus']==="approved"){} ?></span>
<span class="sub"><?php if(isset($withdraw_info['wstatus']) && $withdraw_info['wstatus']==="approved"){}?></span>

<?php } ?>
</li>

<li class="token-balance-sub col-md-12 col-lg-12 mb-3">
    <?php
    foreach($sql_fund_exec as $fund_info){extract($fund_info);?>
   <ul class="list-group list-unstyled"> 
    <li class="list-group-item" style="background:transparent !important;"><span class="lead orange" style="font-family:tahoma;"><center><big>
        <?php if(isset($fund_info['currency_name']) && $fund_info['status']==="approved"){echo $fund_info['currency_name'];}?>&nbsp;&nbsp;
        <?php if(isset($fund_info['amount']) && $fund_info['status']==="approved"){
        echo $fund_info['amount'] ." ". $fund_info['currency'];
    } ?>
    <?php if(!isset($fund_info['currency_name']) && !isset($fund_info['amount']) && !isset($fund_info['status'])){echo
        "<table class='table-responsive table'>
        <tr><td>Bitcoin</td><td>0.00 BTC</td></tr>
        <tr><td>Ethereum</td><td>0.00 ETH</td></tr>
        <tr><td>Tether</td><td>0.00 USDT</td></tr>
        </table>
        ";

    }?>
        
    </big></center></span></li></ul>
<?php } ?>
</li>
  </ul>
</div>
</div>
</div>
</div><!-- .col -->
</div><!-- .col -->


<div class="row">
<div class="col-xl-12 col-lg-12">
<div class="token-transaction card card-full-height" style="border-radius: 20px;">
<div class="card-innr">
<div class="card-head has-aside">
<h2 class="card-title"><span class="orange">Live Market Data - <span class="small cursive">Electrum<span style="border: 3px solid #FF880E; border-radius:50%;margin-left:1px; padding:2px;" class="small orange">FX</span></span></h2>

</div>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
<div class="tradingview-widget-container__widget"></div>
<script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-screener.js" async>
{
"width": "100%",
"height": 490,
"defaultColumn": "overview",
"screener_type": "crypto_mkt",
"displayCurrency": "USD",
"colorTheme": "light",
"locale": "en"
}
</script>
</div>
<!-- TradingView Widget END -->
</div> </div>
</div>

</div>
<!-- .row -->

</div>
</div>

<!-- .container -->
</div>

<!-- .page-content -->
</div>

<div class="footer-bar">
<div class="container">
<div class="row align-items-center justify-content-center">
<div class="col-md-8">
<ul class="footer-links">

 <li><a href="https://electrumfx.org/docs/terms-of-use.php">Terms of Service</a></li>
        <li><a href="https://electrumfx.org/docs/about.php">About</a></li>
        <li><a href="https://electrumfx.org/docs/cookie-policy.php">Cookie Policy</a></li>
        <li><a href="https://electrumfx.org/docs/refund-policy.php">Refund Policy</a></li>
        <li><a href="https://electrumfx.org/docs/privacy-policy.php">Privacy Policy</a></li>
</ul>
</div>
<!-- .col -->
<div class="col-md-4 mt-2 mt-sm-0">
<div class="d-flex justify-content-between justify-content-md-end align-items-center guttar-25px pdt-0-5x pdb-0-5x">
<div class="copyright-text"><p><center><small>©&nbsp;<?= date('Y');?>&nbsp;<a href="#"><span class="orange">Electrum FX</span></a> | All rights reserved.&nbsp;<!-- Electrum FX - The easiest place to invest bitcoin. -->All rights reserved. Electrum FX is a registered investment platform providing digital asset investment management services to individuals, lending and investment, multicurrency and multifunctional online platform based on blockchain technology. Electrum FX is the easiest place to trade Bitcoin.</small></center></p></div>
</div>
</div>
<!-- .col -->
</div>
<!-- .row -->
</div>
<!-- .container -->
</div>
<!-- .footer-bar -->

<!-- Modal Centered -->

<!-- Modal End -->
<!-- Modal Centered -->


</div>
<!-- .modal-dialog -->
</div>
<!-- Modal End -->
<!-- JavaScript (include all script here) -->
<script src="https://transactright.com/js/app.js"></script>
<script src="./assets/js/jquery.bundle49f7.js"></script>
<script src="./assets/js/script49f7.js"></script>
</body>

</html>
