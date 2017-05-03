<?php
$lc = "";     
if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($lc == "zh"){ $lang_file="lang.ch.php";  } 
else{   $lang_file="lang.en.php";  }
include('../'.$lang_file);

 
error_reporting(error_reporting() & ~E_NOTICE);
$config = include('../../config.php');
$delegate = $config['delegate_address'];
$lisk_host = $config['lisk_host'];

$lisk_host = "122.116.97.121";

$lisk_port = $config['lisk_port'];
$pool_fee = floatval(str_replace('%', '', $config['pool_fee']));
$pool_fee_payout_address = $config['pool_fee_payout_address'];
$mysqli=mysqli_connect($config['host'], $config['username'], $config['password'], $config['bdd']) or die("Database Error");
$task = "SELECT count(1) FROM blocks";
$response = mysqli_query($mysqli,$task)or die("Database Error");
$row = mysqli_fetch_row($response);
$minedblocks = $row[0];

  
//Retrive Public Key
$ch1 = curl_init('http://'.$lisk_host.':'.$lisk_port.'/api/accounts?address='.$delegate);                                                                      
curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");                                                                                      
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);     
$result1 = curl_exec($ch1);
$publicKey_json = json_decode($result1, true); 
$publicKey = $publicKey_json['account']['publicKey'];
$pool_balance = $publicKey_json['account']['balance'];
$username = $publicKey_json['account']['username'];
$balanceinlsk_p = floatval($pool_balance/100000000);


//Retrive voters
$ch1 = curl_init('http://'.$lisk_host.':'.$lisk_port.'/api/delegates/voters?publicKey='.$publicKey);
curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "GET");                                                                                      
curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);     
$result1 = curl_exec($ch1);
$voters = json_decode($result1, true); 
$voters_array = $voters['accounts'];
$voters_count = count($voters_array);
$total_voters_power = 0;

foreach ($voters_array as $key => $value) {
  $balance = $value['balance'];
  $total_voters_power = $total_voters_power + $balance;
}

$existQuery = "SELECT balance,address FROM miners ORDER BY balance DESC LIMIT 2000;";
$existResult = mysqli_query($mysqli,$existQuery)or die("Database Error");
while ($row=mysqli_fetch_row($existResult)){
    $balance = $row[0];
    $address = $row[1];
    $balanceinlsk = floatval($balance/100000000);
    $activeminers = $activeminers.'<br>&nbsp;&nbsp;&nbsp;&nbsp;<a href="/stats/miner/?address='.$address.'">'.$address.'</a> forged:'.$balanceinlsk.' LISK';
}

$servername = "localhost";
$username = "root";
$password = "0000";
$mysqli2= mysqli_connect($servername,$username,$password,"liskvote") or die ("could not connect to mysql"); 
//mysqli_select_db($mysqli2,"liskvote") or die ("no database"); 
//$sql_bal = "SELECT balance FROM balance,voterpower,username,address ORDER BY voter_id ASC;";
$sql_bal2 = "SELECT balance,voterpower,username,address FROM balance";
$Result2 = mysqli_query($mysqli2,$sql_bal2)or die("Database Error.");
 
//   $task = "SELECT count(50) FROM balance";
//$Result2 = mysqli_query($mysqli2,$task)or die("Database Error");


if(!isset($_SESSION['lang']))
    $_SESSION['lang'] = 'cn'; // Sets default language to 'cn'

if(isset($_GET['lang']) && in_array($_GET['lang'], array('en', 'cn')))
    $_SESSION['lang'] = $_GET['lang']; // Sets language based on URL


echo '<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Stats - LISK Delegate Vote Pool to Forge</title>
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="karek314">
    <meta property="og:type"               content="website" />
    <meta property="og:title"              content="Lisk.io"/>
    <meta property="og:description"        content="Lisk.io"/>
    <link rel="shortcut icon" href="../favicon.ico">  
    <meta name="keywords" content="">
    <!--link href="http://fonts.googleapis.com/css?family=MerriweatherMerriweather+Sans:700,300italic,400italic,700italic,300,400" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" -->
    <link href="../assets/css1/mrriweather.css" rel="stylesheet" type="text/css">
    <link href="../assets/css1/Russo.css" type="text/css">
    <link href="../assets/css1/opensans.css" rel="stylesheet" type="text/css" >
 
    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/plugins/bootstrap/css/bootstrap.min.css">   
    <!-- Plugins CSS -->    
    <link rel="stylesheet" href="../assets/plugins/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="../assets/plugins/elegant_font/css/style.css">
    <!-- Theme CSS -->
    <link id="theme-style" rel="stylesheet" href="../assets/css/styles-2.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
      <script src="../assets/css1/shiv.js"></script>
      <script src="../assets/css1/respond.js"></script>
    <style>
    .button-fill {
  text-align: center;
  background: #ccc;
  display: inline-block;
  position: relative;
  text-transform: uppercase;
  margin: 8px;
}
.button-fill.grey {
  background: #444B54;
  color: white;
}
.button-fill.orange .button-inside {
  color: #f26b43;
}
.button-fill.orange .button-inside.full {
  border: 1px solid #f26b43;
}
.button-text {
  padding: 0 25px;
  line-height: 56px;
  letter-spacing: .1em;
}
.button-inside {
  width: 0px;
  height: 54px;
  margin: 0;
  float: left;
  position: absolute;
  top: 1px;
  left: 50%;
  line-height: 54px;
  color: #445561;
  background: #fff;
  text-align: center;
  overflow: hidden;
  -webkit-transition: width 0.5s, left 0.5s, margin 0.5s;
  -moz-transition: width 0.5s, left 0.5s, margin 0.5s;
  -o-transition: width 0.5s, left 0.5s, margin 0.5s;
  transition: width 0.5s, left 0.5s, margin 0.5s;
}
.button-inside.full {
  width: 100%;
  left: 0%;
  top: 0;
  margin-right: -50px;
  border: 1px solid #445561;
}
.inside-text {
  text-align: center;
  position: absolute;
  right: 50%;
  letter-spacing: .1em;
  text-transform: uppercase;
  -webkit-transform: translateX(50%);
  -moz-transform: translateX(50%);
  -ms-transform: translateX(50%);
  transform: translateX(50%);
}

.rwd-table {
  margin: 1em 0;
  min-width: 300px;
}
.rwd-table tr {
  border-top: 1px solid #ddd;
  border-bottom: 1px solid #ddd;
}
.rwd-table th {
  display: none;
}
.rwd-table td {
  display: block;
}
.rwd-table td:first-child {
  padding-top: .5em;
}
.rwd-table td:last-child {
  padding-bottom: .5em;
}
.rwd-table td:before {
  content: attr(data-th) ": ";
  font-weight: bold;
  width: 6.5em;
  display: inline-block;
}
@media (min-width: 480px) {
  .rwd-table td:before {
    display: none;
  }
}
.rwd-table th, .rwd-table td {
  text-align: left;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    display: table-cell;
    padding: .25em .5em;
  }
  .rwd-table th:first-child, .rwd-table td:first-child {
    padding-left: 0;
  }
  .rwd-table th:last-child, .rwd-table td:last-child {
    padding-right: 0;
  }
}

body {
  padding: 0 2em;
  font-family: Montserrat, sans-serif;
  -webkit-font-smoothing: antialiased;
  text-rendering: optimizeLegibility;
  color: #444;
  background: #eee;
}

h1 {
  font-weight: normal;
  letter-spacing: -1px;
  color: #34495E;
}

.rwd-table {
  background: #34495E;
  color: #fff;
  border-radius: .4em;
  overflow: hidden;
}
.rwd-table tr {
  border-color: #46637f;
}
.rwd-table th, .rwd-table td {
  margin: .5em 1em;
}
@media (min-width: 480px) {
  .rwd-table th, .rwd-table td {
    padding: 1em !important;
  }
}
.rwd-table th, .rwd-table td:before {
  color: #dd5;
}



</style>
</head> 
<body class="blog-home-page">   
    <div class="header-wrapper header-wrapper-blog-home">
        <!-- ******HEADER****** --> 
        <header id="header" class="header navbar-fixed-top">  
            <div class="container">       
                <h1 class="logo">
                    <a href="../"><span class="highlight">Lisk</span>Vote</a> 
                </h1><!--//logo-->
                <nav class="main-nav navbar-right" role="navigation">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button><!--//nav-toggle-->
                    </div><!--//navbar-header-->
                    <div id="navbar-collapse" class="navbar-collapse collapse">
                       <ul class="nav navbar-nav">
                          <li class="nav-item"><a href="..">'.$lang['Home'].'</a></li>
													<li class="active nav-item"><a href="../stats">'.$lang['Stats'].'</a></li>
													<li class="nav-item"><a href="../voters">'.$lang['Voters'].'</a></li>
													<li class="nav-item"><a href="../forged">'.$lang['Forged'].'</a></li>
													<li class="nav-item"><a href="../charts">'.$lang['Charts'].'</a></li>
													<li class="nav-item"><a href="../stats/miner/">'.$lang['Balance'].'</a></li>              
													<li class="nav-item last"><a href="mailto:kylins@yahoo.com">'.$lang['Support'].'</a></li>
                        </ul><!--//nav-->
                    </div><!--//navabr-collapse-->
                </nav><!--//main-nav-->
            </div><!--//container-->
        </header><!--//header-->   
        
    <!-- ******Contact Section****** --> 
    <section class="contact-section section">
        <div class="container">
        <h2 class="title text-center"><br>'.$lang['STATS_HOME'].'</h2>
            <p class="intro text-left"></p>
             <p class="intro text-left"><font color="F22613"></p></font>
            <form id="contact-form" class="contact-form form" method="post" action="push.php">                    
                <div class="row text-left">
                    <div class="contact-form-inner col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">';                                                                                   

    echo '<center>';
    
    $total_voters_power_d = $total_voters_power/100000000000000;
    $total_voters_power_d = round( $total_voters_power_d,4)."%";
    $balanceinlsk_p2 = $balanceinlsk_p."  L";
    echo '<a href="/charts"><div class="button-fill grey" style="width:94%"><div class="button-text">'.$total_voters_power_d.'</b></div><div class="button-inside"><div class="inside-text">'.$lang['APPROVAL'].'</div></div></div></a>';

    
    echo '<a href="#"><div class="button-fill grey" style="width:94%"><div class="button-text">Liskpay</b></div><div class="button-inside"><div class="inside-text"><font size="3">'.$lang['DELEGATE_NAME'].'</font></div></div></div></a>';
    
    echo '<a href="https://explorer.lisk.io/address/'.$delegate.'" target="_blanklank"><div class="button-fill grey" style="width:94%"><div class="button-text">'.$delegate.'</b></div><div class="button-inside"><div class="inside-text">'.$lang['DELEGATE_ADDR'].'</div></div></div></a>';
    
    echo '<a href="#"><div class="button-fill grey" style="width:94%"><div class="button-text">'.$minedblocks.'</b></div><div class="button-inside"><div class="inside-text"><font size="3">'.$lang['FORGED_BLOCK'].'</font></div></div></div></a>';
    
    echo '<a href="#"><div class="button-fill grey" style="width:94%"><div class="button-text">'.$voters_count.'</b></div><div class="button-inside"><div class="inside-text"><font size="3">'.$lang['ACTIVE_VOTER'].'</font></div></div></div></a>';

    echo '<a href="https://explorer.lisk.io/address/'.$delegate.'" target="_blanklank"><div class="button-fill grey" style="width:94%"><div class="button-text">'.$balanceinlsk_p2.'</b></div><div class="button-inside"><div class="inside-text">'.$lang['POOL_BALANCE'].'</div></div></div></a>';
    
    
    echo '</center>';

 

  echo ' </table>       <br><br>
            <!--//row-->
                    </div>
                </div><!--//row-->
                <div id="form-messages"></div>
            </form><!--//contact-form-->
        </div><!--//container-->
    </section><!--//contact-section-->
    

 
            
   <!-- ******FOOTER****** --> 
    <footer class="footer">
        <div class="footer-content">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-md-3 col-sm-4 links-col">
                        <div class="footer-col-inner">
                            <h3 class="sub-title">Quick Links 
                         
                            </h3>
                            <ul class="list-unstyled">
                                <li><a href="..">'.$lang['Home'].'</a></li>
                                <li><a href="../stats">'.$lang['Stats'].'</a></li>
                                <li><a href="../voters">'.$lang['Voters'].'</a></li>
                                <li><a href="../forged">'.$lang['Forged'].'</a></li>
                                <li><a href="../charts">'.$lang['Charts'].'</a></li>
                                <li><a href="../stats/miner/">'.$lang['Balance'].'</a></li>                            
                                <li><a href="mailto:kylins@yahoo.com">'.$lang['Support'].'</a></li>
                            </ul>
                        </div><!--//footer-col-inner-->
                    </div><!--//foooter-col-->
                     <div class="footer-col col-md-6 col-sm-8 blog-col">
                                <br>
                            </div><!--//foooter-col--> 
                    <div class="footer-col col-md-3 col-sm-12 contact-col">
                        <div class="footer-col-inner">
                            <h3 class="sub-title"></h3>
                            <p class="intro"></p>
                            <div class="row">
                                <p class="adr clearfix col-md-12 col-sm-4">
                                    <span class="adr-group">
                                    </span>
                                </p>
                            </div> 
                        </div><!--//footer-col-inner-->            
                    </div><!--//foooter-col-->   
                </div>   
            </div>        
        </div><!--//footer-content-->
    
 
    <!-- Main Javascript -->          
    <script  type="text/javascript" src="../assets/plugins/jquery-1.11.2.min.js"></script>
    <script  type="text/javascript" src="../assets/plugins/jquery-migrate-1.2.1.min.js"></script>
    <script  type="text/javascript" src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script> 
    <script  type="text/javascript" src="../assets/plugins/bootstrap-hover-dropdown.min.js"></script>       
    <script  type="text/javascript" src="../assets/plugins/back-to-top.js"></script>             
    <script  type="text/javascript" src="../assets/plugins/jquery-placeholder/jquery.placeholder.js"></script>                                                                  
    <script  type="text/javascript" src="../assets/plugins/jquery-match-height/jquery.matchHeight-min.js"></script>     
    <script  type="text/javascript" src="../assets/plugins/FitVids/jquery.fitvids.js"></script>
    <script  type="text/javascript" src="../assets/js/main.js"></script>     
    
    <!-- Form Validation -->
    <script  type="text/javascript" src="../assets/plugins/jquery.validate.min.js"></script> 
    <script  type="text/javascript" src="../assets/js/form-validation-custom.js"></script> 
    
    <!-- Form iOS fix -->
    <script  type="text/javascript" src="../assets/plugins/isMobile/isMobile.min.js"></script>
    <script  type="text/javascript" src="../assets/js/form-mobile-fix.js"></script>  
    <script>
        $(".button-fill").hover(function () {
        $(this).children(".button-inside").addClass("full");
        }, function() {
        $(this).children(".button-inside").removeClass("full");
        });
    </script>

</body>
</html>';


?>
