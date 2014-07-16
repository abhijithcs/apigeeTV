<?php
$page = $_SERVER['PHP_SELF'];
$sec = "910";

define('INCLUDE_CHECK', true);
require 'connect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Apigee TV</title>

<link href="css/facebook/jquery.socialfeed.css" rel="stylesheet" type="text/css">
<link href="css/facebook/my_social_css.css" rel="stylesheet" type="text/css">
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

<script src="js/notification/jquery.js" type="text/javascript"></script>
<script src="js/notification/notifIt.js" type="text/javascript"></script>
<link href="css/notification/notifIt.css" type="text/css" rel="stylesheet">
<link href="css/notification/notify_main.css" type="text/css" rel="stylesheet">


<link rel="shortcut icon" href="images/fav.png" type="image/png" />
<link href='http://fonts.googleapis.com/css?family=Pontano+Sans' rel='stylesheet' type='text/css'>
<link href="css/main/default.css" rel="stylesheet" type="text/css" media="all" />

<link href="css/feed/bootstrap.css" rel="stylesheet">
<link href="css/feed/main.css" rel="stylesheet">
<link href="css/tweet/tweet.css" rel="stylesheet" type="text/css" media="all" />

</head>

<?php
	$test_notify = mysql_fetch_array(mysql_query("SELECT nDeadline, nFrequency FROM notifications WHERE 1"));
	date_default_timezone_set('Asia/Calcutta');
	$startDate = date('d M Y');
	$endDate = date("d M Y", strtotime($test_notify['nDeadline']));

	if($startDate <= $endDate)
	{
		echo ' <body onload="setInterval(function(){not7()}, '.$test_notify['nFrequency'].');"> ';
	}	
	else
	{
		echo ' <body> ';
	}
?>

    <script type="text/javascript" src="js/slide/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="js/slide/jssor.core.js"></script>
    <script type="text/javascript" src="js/slide/jssor.utils.js"></script>
    <script type="text/javascript" src="js/slide/jssor.slider.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/tweet/tweetie.js"></script>

<!-- FOR NOTIFICATIONS -->

<?php

$row_notify = mysql_fetch_array(mysql_query("SELECT nSubject, nDetails FROM notifications WHERE 1"));
echo "
    <script>

	function not7(){
			notif({
				type: \"info\",
				msg: \"<h3 style='font-size:24px; font-weight:bold; color:#ffffff'>".$row_notify['nSubject']."</h3>".$row_notify['nDetails']."\",
				position: \"center\",
				width: 1300,
				autohide: true,
				multiline: true,
				timeout: 10000,
				fade: true
			});
		}

    </script>

";

?>



    <!-- Slider -->
    <script>

        jQuery(document).ready(function ($) {
            var options = {
                $AutoPlay: true,
                $AutoPlaySteps: 1, 
                $AutoPlayInterval: 4000,
                $PauseOnHover: 1,
                $ArrowKeyNavigation: true, 
                $SlideDuration: 500,
                $MinDragOffsetToSlide: 20,
                $SlideSpacing: 5,
                $DisplayPieces: 1,
                $ParkingPosition: 0,
                $UISearchMode: 1,
                $PlayOrientation: 1,
                $DragOrientation: 3,
                $ThumbnailNavigatorOptions: {
                    $Class: $JssorThumbnailNavigator$,         
                    $ChanceToShow: 2,
                    $Loop: 2,
                    $AutoCenter: 3,                                 
                    $Lanes: 1,
                    $SpacingX: 4,
                    $SpacingY: 4,
                    $DisplayPieces: 4, 
                    $ParkingPosition: 0,
                    $Orientation: 2,
                    $DisableDrag: false
                }
            };

            var jssor_slider1 = new $JssorSlider$("slider1_container", options);
        });
    </script>

<div id="page">
	<div class="container1">

		<!-- Left Section -->

		<div class="boxA1">

			<div class="boxes-left margin-btm" style="height:490px">

				<div class="details">
					<!-- Start of Feeds 1 -->
<?php
					$row_orange = mysql_fetch_array(mysql_query("SELECT mId FROM gbmMinutes WHERE mType='1'"));
					if($row_orange["mId"])
					{
						$query = mysql_query("SELECT mSubject, mDeadline FROM gbmMinutes WHERE mType='1'");
echo '						
						<div id="nt-example1-container">
							<ul id="nt-example1">
';
							    while($feed = mysql_fetch_assoc($query))
							    {
								    echo '<li>'.$feed['mSubject'].'</li>';
							    }
echo '
							</ul>
				                </div>
';
					}
?>
					<!-- End of Feeds 1 -->
				</div><!-- /Details -->

				<h3>What is happening at <api>api</api><gee>gee</gee>?</h3>

				<div class="details">

					<!-- Start of Feeds 2 -->
<?php
					$row_black = mysql_fetch_array(mysql_query("SELECT mId FROM gbmMinutes WHERE mType='2'"));
					if($row_black["mId"])
					{
						$preserveFlag = 0;
						$query = mysql_query("SELECT mSubject, mDetails, mName, mDeadline FROM gbmMinutes WHERE mType='2'");
echo'
					<div id="nt-example2-container">
						<ul id="nt-example2">
';
							while($feed = mysql_fetch_assoc($query))
							{
							    $dataString = $feed['mDetails'];
echo '							    <li data-infos="'.$dataString.'"></i>
							    	'.$feed['mSubject'].'
							    </li>
';
							    if($preserveFlag == 0)
							    {
								$preserveData = $dataString;
							    }
							    $preserveFlag = 1;
							}
echo'						</ul>

		                		<div id="nt-example2-infos-container">
			                		<div id="nt-example2-infos-triangle"></div>
							<div id="nt-example2-infos" class="row">
								<div class="infos-text">'.$preserveData.'</div>
							</div>
		                		</div>
		            		</div>
';

					}
?>
					<!-- End of Feeds 2 -->
				
				</div><!-- /Details -->

			</div>
		</div>


		<!-- Right Section -->
		<div class="boxC1">
			<!-- Story Board -->
			<div class="boxes" style="height:200px;">
				<div class="details">
<?php
					$row_story = mysql_fetch_array(mysql_query("SELECT sSubject, sDetails, sFooter FROM storyData WHERE 1"));
echo'
					<h3 style="color:#ff4300; font-size:30px; padding-top:0px;">'.$row_story['sSubject'].'</h3>
					<p>'.$row_story['sDetails'].'</p>
					<h3 style="color:#ff4300; font-size:15px;"> - '.$row_story['sFooter'].'</h3>
';
?>
				</div>
			</div>

<?php
//Display Options
$check = mysql_fetch_array(mysql_query("SELECT yId, yUrl, yFlag FROM youTubeData WHERE 1"));
$videoFlag = $check['yFlag'];
$url = $check['yUrl'];

if($videoFlag == 1)
{
	//Display Video
echo '
			<div class="boxes" style="height:360px; background: #000000">
				<div class="details">

<center>
<iframe width="650" height="330" src="https://www.youtube.com/v/'.$url.'?version=3&loop=1&playlist='.$url.'&autoplay=1&showinfo=0&controls=0" frameBorder="0"></iframe>
</center>
';

}
else
{
	//Display Graphs

date_default_timezone_set('Asia/Calcutta'); 

$dateTo = date('Ymd');
$dateFrom = $dateTo - 7;

echo' 

			<!-- Graphs -->
			<div class="boxes" style="height:360px;">
				<div class="details">

<!-- GRAPH SLIDER BEGINS -->
<div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 770px; height: 330px; background: #000; overflow: hidden; ">

        <!-- Loading Screen -->
        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;

                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">

            </div>

            <div style="position: absolute; display: block; background: url(../img/loading.gif) no-repeat center center;



                top: 0px; left: 0px;width: 100%;height:100%;">

            </div>
        </div>


        <!-- Slides Container -->

        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 550px; height: 330px;
            overflow: hidden;">

            <div>
                <img u="image" src="https://dashboard.apigee.net/render/?fontName=Helvetica&majorGridLineColor=%23C0C0C0&height=308&hideLegend=true&colorList=298FC2%2CFC4C02&xFormat=%25a%2C%20%25m%2F%25d&from=00%3A00_'.$dateFrom.'&bgcolor=white&minorGridLineColor=%23E0E0E0&minorY=1&width=586&fontSize=14&showTarget=alias(dashed(timeShift(metrics.googleanalytics.all.visits%2C%20%221week%22))%2C%20%22Past%20week%22)&until=00%3A00_'.$dateTo.'&drawNullAsZero=false&areaAlpha=0.15&fgcolor=%23808080&areaMode=first&graphOnly=false&lineWidth=3&margin=10&target=alias(metrics.googleanalytics.all.visits%2C%20%22Current%20week%22)&target=alias(dashed(timeShift(metrics.googleanalytics.all.visits%2C%20%221week%22))%2C%20%22Past%20week%22)&_salt=1403171367.524" />
                <div u="thumb">
                    <div class="t">55,975</div>
                    <div class="c">visits per week ▼</div>
                </div>
            </div>
            <div>
                <img u="image" src="https://dashboard.apigee.net/render/?fontName=Helvetica&majorGridLineColor=%23C0C0C0&height=308&hideLegend=true&colorList=298FC2%2CFC4C02&xFormat=%25a%2C%20%25m%2F%25d&from=00%3A00_'.$dateFrom.'&bgcolor=white&minorGridLineColor=%23E0E0E0&minorY=1&width=586&fontSize=14&showTarget=alias(dashed(timeShift(summarize(sumSeries(metrics.apiplatform.orgs.apigee-internal.%7Bprod%2Cug%7D.apis.usergridproxy.message_count)%2C%221h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&until=00%3A00_'.$dateTo.'&drawNullAsZero=false&areaAlpha=0.15&fgcolor=%23808080&areaMode=first&graphOnly=false&lineWidth=3&margin=10&target=alias(summarize(sumSeries(metrics.apiplatform.orgs.apigee-internal.%7Bprod%2Cug%7D.apis.usergridproxy.message_count)%2C%221h%22)%2C%20%22Current%20week%22)&target=alias(dashed(timeShift(summarize(sumSeries(metrics.apiplatform.orgs.apigee-internal.%7Bprod%2Cug%7D.apis.usergridproxy.message_count)%2C%221h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&_salt=1403171498.194" />
                <div u="thumb">
                    <div class="t">9,070,617</div>
                    <div class="c">requests per week ▲</div>
                </div>
            </div>
            <div>
                <img u="image" src="https://dashboard.apigee.net/render/?fontName=Helvetica&majorGridLineColor=%23C0C0C0&height=308&hideLegend=true&colorList=298FC2%2CFC4C02&xFormat=%25a%2C%20%25m%2F%25d&from=00%3A00_'.$dateFrom.'&bgcolor=white&minorGridLineColor=%23E0E0E0&minorY=0&width=586&fontSize=10&showTarget=alias(dashed(timeShift(summarize(metrics.googleanalytics.appservices.visits%2C%222h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&until=00%3A00_'.$dateTo.'&drawNullAsZero=false&areaAlpha=0.15&hideYAxis=true&fgcolor=%23808080&areaMode=first&graphOnly=false&lineWidth=2&margin=0&target=alias(summarize(metrics.googleanalytics.appservices.visits%2C%222h%22)%2C%20%22Current%20week%22)&target=alias(dashed(timeShift(summarize(metrics.googleanalytics.appservices.visits%2C%222h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&_salt=1403171565.718" />
                <div u="thumb">

                   <div class="t">490</div>
                    <div class="c">App Services ▼</div>
                </div>
            </div>
            <div>
                <img u="image" src="https://dashboard.apigee.net/render/?fontName=Helvetica&majorGridLineColor=%23C0C0C0&height=308&hideLegend=true&colorList=298FC2%2CFC4C02&xFormat=%25a%2C%20%25m%2F%25d&from=00%3A00_'.$dateFrom.'&bgcolor=white&minorGridLineColor=%23E0E0E0&minorY=0&width=586&fontSize=10&showTarget=alias(dashed(timeShift(summarize(metrics.googleanalytics.marketing.visits%2C%222h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&until=00%3A00_'.$dateTo.'&drawNullAsZero=false&areaAlpha=0.15&hideYAxis=true&fgcolor=%23808080&areaMode=first&graphOnly=false&lineWidth=2&margin=0&target=alias(summarize(metrics.googleanalytics.marketing.visits%2C%222h%22)%2C%20%22Current%20week%22)&target=alias(dashed(timeShift(summarize(metrics.googleanalytics.marketing.visits%2C%222h%22)%2C%20%221week%22))%2C%20%22Past%20week%22)&_salt=1403171620.194" />
                <div u="thumb">
                    <div class="t">22,596</div>
                    <div class="c">Marketing ▼</div>
                </div>
            </div>
        </div>



        <!-- ThumbnailNavigator Skin Begin -->

        <div u="thumbnavigator" class="jssort11" style="position: absolute; width: 250px; height: 330px; left:525px; top:0px;">

            <!-- Thumbnail Item Skin Begin -->

            <style>


                .jssort11

                {
                	font-family: Arial, Helvetica, sans-serif;

			background: #ffffff;

                }
                .jssort11 .t, .jssort11 .pav:hover .t

                {
                	text-align: center;

                	color:#ff4300;
                	font-size:15px;

			padding-top: 10px;
                	font-weight:700;

                }

                .jssort11 .pav .t, .jssort11 .phv .t, .jssort11 .p:hover .t
                {

                	color:#444444;

                }
                .jssort11 .c, .jssort11 .pav:hover .c

                {

                	color:#fff;
                	font-size:13px;

                	overflow: hidden;

			padding-top: 5px;
                	text-align: center;



                }
                .jssort11 .pav .c, .jssort11 .phv .c, .jssort11 .p:hover .c
                {

                	color:#ff4300;
                }

                .jssort11 .t, .jssort11 .c

                {
                	transition: color 2s;

                    -moz-transition: color 2s;
                    -webkit-transition: color 2s;

                    -o-transition: color 2s;
                }

                .jssort11 .p:hover .t, .jssort11 .phv .t, .jssort11 .pav:hover .t, .jssort11 .p:hover .c, .jssort11 .phv .c, .jssort11 .pav:hover .c

                {
                	transition: none;

                    -moz-transition: none;
                    -webkit-transition: none;

                    -o-transition: none;
                }

                .jssort11 .p
                {

                	background:#181818;
                }
                .jssort11 .pav, .jssort11 .pdn

                {

                	background:#f2f2f2;
                }

                .jssort11 .p:hover, .jssort11 .phv, .jssort11 .pav:hover

                {

                	background:#333;
                }

            </style>
            <div u="slides" style="cursor: move;">

                <div u="prototype" class="p" style="position: absolute; width: 200px; height: 75px; top: 0; left: 0;">

                    <thumbnailtemplate style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></thumbnailtemplate>

                </div>
            </div>

            <!-- Thumbnail Item Skin End -->

        </div>

        <!-- ThumbnailNavigator Skin End -->
    </div>

<!-- GRAPH SLIDER ENDS -->
';
}

?>
				</div>
			</div>			
			
		</div>



		<!-- Left Bottom : Facebook and LinkedIn -->
		<div class="boxA1">
			<div class="boxes-left margin-btm" style="height:125px">

				<div class="details">
					<marquee behavior="scroll" direction="up" scrollamount="2" height="125" width="480">
					    <div class="container10">
						<div class="social-feed-container"></div>
					    </div>
					</marquee>
				</div><!-- /Details -->

			</div>
		</div>


		<!-- Right Bottom : Twitter -->
		<div class="boxC1">
			<div class="boxes" style="height:125px">
				<div class="details" style="padding:0px">

				    <!-- Twitter Feeds -->
				    <div class="twitterFeed">
					<div class="tweet"></div>
				    </div>

				    <script type="text/javascript">
					$('.twitterFeed .tweet').twittie({
					    username: 'Apigee',
					    list: 'c-oo-l-e-s-t-nerds-i-know',
					    dateFormat: '%b. %d, %Y',
					    template: '<strong class="date">{{date}}</strong> - {{screen_name}} {{tweet}}',
					    count: 10
					}, function () {
					    setInterval(function() {
						var item = $('.twitterFeed .tweet ul').find('li:first');

						item.animate( {marginLeft: '-220px', 'opacity': '0'}, 500, function() {
						    $(this).detach().appendTo('.twitterFeed .tweet ul').removeAttr('style');
						});
					    }, 5000);
					});
				    </script>

				</div>
			</div>
		</div>

	</div> <!-- Container1 End -->
</div> <!-- Page End -->



	<!-- Core JavaScript
    ================================================== -->

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="js/feed/jquery.newsTicker.js"></script>
    <script>
    		$('a[href*=#]').click(function(e) {
			    var href = $.attr(this, 'href');
			    if (href != "#") {
				    $('html, body').animate({
				        scrollTop: $(href).offset().top - 81
				    }, 500);
				}
				else {
					$('html, body').animate({
				        scrollTop: 0
				    }, 500);
				}
			    return false;
			});

    		$(window).load(function(){
	            $('code.language-javascript').mCustomScrollbar();
	        });
            var nt_title = $('#nt-title').newsTicker({
                row_height: 40,
                max_rows: 1,
                duration: 3000,
                pauseOnHover: 0
            });
            var nt_example1 = $('#nt-example1').newsTicker({
                row_height: 80,
                max_rows: 3,
                duration: 4000,
                prevButton: $('#nt-example1-prev'),
                nextButton: $('#nt-example1-next')
            });
            var nt_example2 = $('#nt-example2').newsTicker({
                row_height: 60,
                max_rows: 1,
                speed: 300,
                duration: 6000,
                prevButton: $('#nt-example2-prev'),
                nextButton: $('#nt-example2-next'),
                hasMoved: function() {
                	$('#nt-example2-infos-container').fadeOut(200, function(){
	                	$('#nt-example2-infos .infos-hour').text($('#nt-example2 li:first span').text());
	                	$('#nt-example2-infos .infos-text').text($('#nt-example2 li:first').data('infos'));
	                	$(this).fadeIn(400);
	                });
                },
                pause: function() {
                	$('#nt-example2 li i').removeClass('fa-play').addClass('fa-pause');
                },
                unpause: function() {
                	$('#nt-example2 li i').removeClass('fa-pause').addClass('fa-play');
                }
            });
            $('#nt-example2-infos').hover(function() {
                nt_example2.newsTicker('pause');
            }, function() {
                nt_example2.newsTicker('unpause');
            });
            var state = 'stopped';
            var speed;
            var add;
            var nt_example3 = $('#nt-example3').newsTicker({
                row_height: 80,
                max_rows: 1,
                duration: 0,
                speed: 10,
                autostart: 0,
                pauseOnHover: 0,
                hasMoved: function() {
                	if (speed > 700) {
                		$('#nt-example3').newsTicker("stop");
                		console.log('stop')
                		$('#nt-example3-button').text("RESULT: " + $('#nt-example3 li:first').text().toUpperCase());
                		setTimeout(function() {
                			$('#nt-example3-button').text("START");
                			state = 'stopped';
                		},2500);
                		
                	}
                	else if (state == 'stopping') {
                		add = add * 1.4;
                		speed = speed + add;
                		console.log(speed)
                		$('#nt-example3').newsTicker('updateOption', "duration", speed + 25);
                		$('#nt-example3').newsTicker('updateOption', "speed", speed);
                	}
                }
            });
            
            $('#nt-example3-button').click(function(){
            	if (state == 'stopped') {
	            	state = 'turning';
	            	speed = 1;
	            	add = 1;
	            	$('#nt-example3').newsTicker('updateOption', "duration", 0);
	            	$('#nt-example3').newsTicker('updateOption', "speed", speed);
	            	nt_example3.newsTicker('start');
	            	$(this).text("STOP");
	            }
	            else if (state == 'turning') {
	            	state = 'stopping';
	            	$(this).text("WAITING...");
	            }
            });
        </script>

<!-- FOR SOCIAL FACEBOOK -->
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="js/facebook/doT.min.js"></script>
    <script src="js/facebook/moment.min.js"></script>
    <script src="js/facebook/jquery.socialfeed.js"></script>

    <script>
    $(document).ready(function(){
        $('.social-feed-container').socialfeed({
                    //FACEBOOK
                    facebook:{
                        accounts:['@apigee','##apigee'], //usernames or id
                        limit:10,
                        token:'240696342763428|FgHgjfn7wWMNT15ONHP0tVdWm_k' 
                    },
                    //GENERAL SETTINGS
                    length:130,
                    show_media:true,
                    callback: function(){
                        console.log('all posts are collected');
                    }
                });
	  });
	</script>

</body>
</html>
