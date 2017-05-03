<?php
$lc = "";     
if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
    $lc = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
if($lc == "zh"){ $lang_file="lang.ch.php";  } 
else{   $lang_file="lang.en.php";  }
include('../'.$lang_file);

echo '<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->  
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->  
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->  
<head>
    <title>Charts - LISK Delegate Vote Pool to Forge</title>
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
													<li class="nav-item"><a href="../stats">'.$lang['Stats'].'</a></li>
													<li class="nav-item"><a href="../voters">'.$lang['Voters'].'</a></li>
													<li class="nav-item"><a href="../forged">'.$lang['Forged'].'</a></li>
													<li class="active nav-item"><a href="../charts">'.$lang['Charts'].'</a></li>
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
            <h2 class="title text-center"><br>'.$lang['CHARTS_HOME'].'</h2>
            <p class="intro text-left"></p>
             <p class="intro text-left"><font color="F22613"></p></font>
            <form id="contact-form" class="contact-form form" method="post" action="push.php">                    
                <div class="row text-left">
                    <div class="contact-form-inner col-md-8 col-sm-12 col-xs-12 col-md-offset-2 col-sm-offset-0 xs-offset-0">
                        <div class="row"> ';
                        echo '<div id="container"><center>'.$lang['LOAD_BAL_CHART'].'</center></div>';
                        echo '<br><br><div id="container_balance"><center>'.$lang['LOAD_BAL_CHART'].'</center></div><br><br>';
                        echo '<br><br><div id="container_miners"><center>'.$lang['LOAD_BAL_CHART'].'</center></div><br><br>';
                        echo '</div><!--//row-->
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
                            <h3 class="sub-title">Quick Links</h3>
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
    
    <!--  script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js" -->
   
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>

    <script src="./js/highstock.js"></script>
    <script src="./js/modules/exporting.js"></script> 
    '; ?>
    <script type="text/javascript">
$(function () {
    $.getJSON("/api/index.php?data=hashrate&range=max", function (data) {
        $("#container").highcharts("StockChart", {
            rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            },{
                type: 'hour',
                count: 12,
                text: '12h'
            },{
                type: 'day',
                count: 1,
                text: '1d'
            },{
                type: 'day',
                count: 3,
                text: '3d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'month',
                count: 1,
                text: '1m'
            }, {
                type: 'month',
                count: 6,
                text: '6m'
            }, {
                type: 'year',
                count: 1,
                text: '1y'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 3
        },
            chart: {
                backgroundColor: "#F5F5F5",
                polar: true,
                type: "area"
            },
            title : {
                text : "<?php echo $lang['VOTEPOWER'] ?>"
            },

            yAxis: {
                reversed: false,
                showFirstLabel: false,
                showLastLabel: true
            },

            series : [{
                name : "votepower",
                data : data,
                threshold: null,
                fillColor : {
                    linearGradient : {
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    },
                    stops : [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
        setTimeout(balance, 1);
    });
});


function balance() {
    $.getJSON("/api/index.php?data=pool_balance&range=max", function (data) {
        $("#container_balance").highcharts("StockChart", {
            rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            },{
                type: 'hour',
                count: 12,
                text: '12h'
            },{
                type: 'day',
                count: 1,
                text: '1d'
            },{
                type: 'day',
                count: 3,
                text: '3d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'month',
                count: 1,
                text: '1m'
            }, {
                type: 'month',
                count: 6,
                text: '6m'
            }, {
                type: 'year',
                count: 1,
                text: '1y'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 3
        },
            chart: {
                backgroundColor: "#F5F5F5",
                polar: true,
                type: "area"
            },
            title : {
                text : "<?php echo $lang['BALANCE_LEFT'] ?>"
            },

            yAxis: {
                reversed: false,
                showFirstLabel: false,
                showLastLabel: true
            },

            series : [{
                name : "Lisk",
                data : data,
                threshold: null,
                fillColor : {
                    linearGradient : {
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    },
                    stops : [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
        setTimeout(miners, 1);
    });

};

function miners() {
    $.getJSON("/api/index.php?data=pool_miners&range=max", function (data) {
        $("#container_miners").highcharts("StockChart", {
            rangeSelector: {
            buttons: [{
                type: 'hour',
                count: 1,
                text: '1h'
            },{
                type: 'hour',
                count: 12,
                text: '12h'
            },{
                type: 'day',
                count: 1,
                text: '1d'
            },{
                type: 'day',
                count: 3,
                text: '3d'
            }, {
                type: 'week',
                count: 1,
                text: '1w'
            }, {
                type: 'month',
                count: 1,
                text: '1m'
            }, {
                type: 'month',
                count: 6,
                text: '6m'
            }, {
                type: 'year',
                count: 1,
                text: '1y'
            }, {
                type: 'all',
                text: 'All'
            }],
            selected: 3
        },
            chart: {
                backgroundColor: "#F5F5F5",
                polar: true,
                type: "area"
            },
            title : {
                text : "<?php echo $lang['VOTERS1'] ?>"
            },

            yAxis: {
                reversed: false,
                showFirstLabel: false,
                showLastLabel: true
            },

            series : [{
                name : "voters count",
                data : data,
                threshold: null,
                fillColor : {
                    linearGradient : {
                        x1: 0,
                        y1: 1,
                        x2: 0,
                        y2: 0
                    },
                    stops : [
                        [0, Highcharts.getOptions().colors[0]],
                        [1, Highcharts.Color(Highcharts.getOptions().colors[0]).setOpacity(0).get('rgba')]
                    ]
                },
                tooltip: {
                    valueDecimals: 2
                }
            }]
        });
    });

};


function zip(a, b) {
    return a.map(function(x, i) {
    return [x, b[i]];
    });
}
</script>



</body>
</html> 

