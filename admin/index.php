<?php
session_start();

if(!isset($_SESSION['admin']))
{
	header('Location: login.php');
}

$username = $_SESSION['admin'];

define('INCLUDE_CHECK', true);
require 'connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link href="css/metro-bootstrap.css" rel="stylesheet">
    <script src="js/jquery/jquery.min.js"></script>
    <script src="js/jquery/jquery.widget.min.js"></script>
    <script src="js/load-metro.js"></script>
    <script src="js/github.info.js"></script>

    <title>Apigee TV Admin</title>

    <style>
        .container {
            width: 1040px;
        }
    </style>
</head>
<body class="metro">

<?php
echo '<a href = logout.php><button class="button place-right">LOGOUT</button></a>';
?>

   <div class="container">
        <header class="margin20 nrm nlm">
            <div class="clearfix">
		<a href="#">
			<center><br><br><img src="logo.png" height=100 /></center>
		</a>
            </div><br><br>
        </header>

	<?php

    		if($_GET['action']=='mainStory') 
		{
			mysql_query("DELETE FROM storyData WHERE sId='1'");

			$storySubject 	= $_POST['subject'];
			$storyDetails 	= $_POST['details'];
			$storyFooter 	= $_POST['footer'];

			date_default_timezone_set('Asia/Calcutta');
			$storyDate 	= date('H:i d M Y');

			mysql_query("INSERT INTO storyData (sSubject, sDetails, sFooter, sDate, sId) VALUES ('{$storySubject}','{$storyDetails}','{$storyFooter}', '{$storyDate}', '1')");

			header('Location: index.php');
    		}


    		if($_GET['action']=='addPost') 
		{
			$postSubject 	= $_POST['subject'];
			$postDetails 	= $_POST['details'];
			$postName 	= $_POST['name'];
			$postType 	= $_POST['type'];

			date_default_timezone_set('Asia/Calcutta');
			$postDate 	= date('H:i d M Y');

			$postDeadline	= date("d M Y", strtotime($_POST['deadline']));

			mysql_query("INSERT INTO gbmMinutes (mSubject, mDetails, mName, mDate, mDeadline, mType) VALUES ('{$postSubject}','{$postDetails}','{$postName}', '{$postDate}', '{$postDeadline}', '{$postType}')");

			header('Location: index.php');
    		}

    		if($_GET['action']=='addNotification') 
		{
			mysql_query("DELETE FROM notifications WHERE nId= '1' ");

			$notificationSubject 	= $_POST['subject'];
			$notificationDetails 	= $_POST['details'];
			$notificationFrequency 	= $_POST['frequency'];

			$notificationDeadline	= date("d M Y", strtotime($_POST['deadline']));

			mysql_query("INSERT INTO notifications (nSubject, nDetails, nFrequency, nDeadline, nId) VALUES ('{$notificationSubject}','{$notificationDetails}','{$notificationFrequency}', '{$notificationDeadline}', '1')");

			header('Location: index.php');
    		}

    		if($_GET['action']=='addVideo') 
		{
			mysql_query("DELETE FROM youTubeData WHERE yId= '1' ");

			$videoUrl 	= $_POST['youtubeUrl'];

			mysql_query("INSERT INTO youTubeData (yUrl, yFlag, yId) VALUES ('{$videoUrl}', '1', '1')");

			header('Location: index.php');
    		}

    		if($_GET['action']=='deletePost') 
		{
			if(!empty($_POST['delete'])) 
			{
				 foreach($_POST['delete'] as $postReference) 
				{
					mysql_query("DELETE FROM gbmMinutes WHERE mId='{$postReference}'");
				}
			}

			header('Location: index.php');
    		}

    		if($_GET['action']=='deleteNotification') 
		{
			mysql_query("DELETE FROM notifications WHERE nId='1'");

			header('Location: index.php');
    		}

    		if($_GET['action']=='deleteVideo') 
		{
			mysql_query("UPDATE youTubeData SET yFlag='0' WHERE yId='1'");

			header('Location: index.php');
    		}

echo'

                    <div class=" tripleF double-vertical fg-white" style="height: auto">
<center>
<button id="addPost" class="button success" style="margin-right: 10px">Add a Post</button><button id="mainStory" class="button success" style="margin-right: 10px">Change Main Story</button>
</center>
                        </div>

';

echo "

	<script>
                        $(\"#addPost\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=addPost\">' +
                                            '<div class=\"input-control text\"><input placeholder=\"Subject\" type=\"text\" name=\"subject\" required></div>' +                                            
					'<div class=\"input-control textarea\" data-role=\"input-control\"><textarea placeholder=\"Details (Keep blank when you are posting into Orange Feed.)\" name=\"details\"></textarea></div>' +

                                            '<div class=\"input-control text\"><input placeholder=\"Name of Person (Keep blank not to display your name)\" type=\"text\" name=\"name\"></div>' +
					    '<label style=\"color: #000000\">Expires at 23:59 HRS on:</label>' +
                                            '<div class=\"input-control text\"><input placeholder=\"Expires On\" type=\"date\" name=\"deadline\" required></div>' +
					    '<label style=\"color: #000000\">Type:</label>' +
'<div class=\"input-control select\" data-role=\"input-control\">' + 
'<input type=\"radio\" name=\"type\" value=\"1\" required> Common Feed (Orange)<br><input type=\"radio\" name=\"type\" value=\"2\" required> Apigee News & Events (Black)<br>' +					    
                                            '<br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Post\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Add a new Post\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>

	<script>
                        $(\"#mainStory\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=mainStory\">' +
					'<div class=\"input-control textarea\" data-role=\"input-control\"><textarea placeholder=\"Header \" name=\"subject\" required></textarea></div>' +
					'<div class=\"input-control textarea\" data-role=\"input-control\"><textarea placeholder=\"Details \" name=\"details\" required></textarea></div>' +
					'<div class=\"input-control textarea\" data-role=\"input-control\"><textarea placeholder=\"Footer \" name=\"footer\" required></textarea></div>' +    
                                            '<br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Save\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Change Main Story\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>


";
		$row = mysql_fetch_array(mysql_query("SELECT mId FROM gbmMinutes WHERE 1"));
		$count = 0;

echo '
		<center><h1 style="color: #444444; font-size: 30px; padding-top:50px;">POSTS</h1></center>  
';
		if($row["mId"])
		{
			$query = mysql_query("SELECT mId, mName, mSubject, mDetails, mDate, mDeadline, mType FROM gbmMinutes WHERE 1 ORDER BY mType");
echo '
            <div class="example">
		
                    <table class="table hovered">
                        <thead>
                        <tr>
                            <th class="text-left">Select</th>
                            <th class="text-left">Time-Stamp</th>
                            <th class="text-left">Type</th>
                            <th class="text-left">Subject</th>
                            <th class="text-left">Details</th>
                            <th class="text-left">Posted By</th>
                            <th class="text-left">Expires On</th>
                        </tr>
                        </thead>

                        <tbody>
			<form method="post" action="?action=deletePost">
';
			while($entry = mysql_fetch_assoc($query))
			{
				$reference 	= $entry['mId'];
				$date 		= $entry['mDate'];		
				$type	 	= $entry['mType'];
				$subject 	= $entry['mSubject'];
				$details	= $entry['mDetails'];
				$name	 	= $entry['mName'];
				$deadline 	= $entry['mDeadline'];

				if($type == 1)
				{
					if($name==NULL)
					{
						$name = "Anonymous";
					}

					echo'
					<tr><td><input type="checkbox" name="delete[]" value="'.$reference.'"></td><td class="right">'.$date.'</td><td class="right"><h123>Orange Feed</h123></td><td class="right">'.$subject.'</td><td class="right">-</td><td class="right">'.$name.'</td><td class="right">'.$deadline.'</td></tr>
					';
				}
				if($type == 2)
				{
					if($name==NULL)
					{
						$name = "Anonymous";
					}

					echo'
					<tr><td><input type="checkbox" name="delete[]" value="'.$reference.'"></td><td class="right">'.$date.'</td><td class="right"><h124>Black Feed</h124></td><td class="right">'.$subject.'</td><td class="right">'.$details.'</td><td class="right">'.$name.'</td><td class="right">'.$deadline.'</td></tr>
					';
				}
			}
echo'
			</tbody>
                    </table>
			<br><input type="submit" class="danger" value="Delete Selected Posts">
			</form>

	     </div>
';
		}
		else
		{
echo'
		<center><p style="font-size: 15px; color: #444444">There are no posts!</p></center>
';
		}

		$row = mysql_fetch_array(mysql_query("SELECT nId FROM notifications WHERE 1"));

echo '
		<center><h1 style="color: #444444; font-size: 30px; padding-top:50px;">ACTIVE NOTIFICATIONS</h1></center>  
';


		if($row["nId"])
		{
			$value = mysql_fetch_array(mysql_query("SELECT nSubject, nDetails, nDeadline, nFrequency FROM notifications WHERE 1"));
			$deadline = $value["nDeadline"];

			date_default_timezone_set('Asia/Calcutta');
			$startDate = date('d M Y');
			$endDate = date("d M Y", strtotime($deadline));

			if($startDate <= $endDate)
			{
				$isActive = 1;
			}
			else
			{
				$isActive = 0;
			}

		
		echo '
			<div class="example" style="margin-bottom: 50px">
			<h1 style="color: #ff4300; font-size: 25px; "><strong>'.$value["nSubject"].'</strong></h1>
			<p>'.$value["nDetails"].'</p>
		';
		if($isActive == 1)
		{
			echo'
				<h1 style="color: #088A29; font-size: 15px; ">Status : Has been displaying every '.($value["nFrequency"]/60000).' minutes on Apigee TV. Will be active until 23:59 HRS on '.$deadline.'.</h1><br><center><button id="deleteNotification" class="button danger" style="margin-right: 10px">Kill Notification</button><button id="addNotification" class="button success" style="margin-right: 10px">Change Notification</button></center>
			';
		}
		else
		{
			echo'
				<h1 style="color: #FF0000; font-size: 15px; ">Status : Not active. Expired at 23:59 HRS on '.$deadline.'.</h1><center><button id="addNotification" class="button primary" style="margin-right: 10px">Start a New Notification</button></center>
			';

		}
echo'
		</div>		
';

		}

		else
		{
echo'
		<div class="example" style="margin-bottom: 50px">
		<center><p style="font-size: 15px; color: #444444">There are no Running Notifications!</p>
<br>
<button id="addNotification" class="button primary" style="margin-right: 10px">Start a New Notification</button>
</center>	
		</div>
';
		}

// Story Dashboard

		$row = mysql_fetch_array(mysql_query("SELECT sSubject, sDetails, sFooter, sDate FROM storyData WHERE 1"));

echo'
		<center><h1 style="color: #444444; font-size: 30px; padding-top:50px;">MAIN STORY</h1></center>
		<div class="example" style="margin-bottom: 50px">
		<h1 style="color: #ff4300; font-size: 25px; "><strong>'.$row["sSubject"].'</strong></h1>
		<p>'.$row["sDetails"].'</p>
		<h1 style="color: #ff4300; font-size: 15px; ">- '.$row["sFooter"].'</h1>
		<h1 style="color: #444444; font-size: 15px; ">Last Updated: '.$row["sDate"].'</h1>
		</div>
';

//Graphs OR Video

		$row = mysql_fetch_array(mysql_query("SELECT yId, yUrl, yFlag FROM youTubeData WHERE 1"));
		$url = $row['yUrl'];
echo'
		<center><h1 style="color: #444444; font-size: 30px; padding-top:50px;">OPTIONAL VIDEO</h1></center>
';

		if($row['yFlag'] == 1)
		{
echo'		
		<div class="example" style="margin-bottom: 50px">
		<center>
		<h1 style="color: #088A29; font-size: 20px; ">The following video is displayed on Apigee TV Now!</h1>
		<iframe width="560" height="315" src="https://www.youtube.com/v/'.$url.'?version=3&loop=1&playlist='.$url.'&autoplay=1"></iframe><br>
		<button id="deleteVideo" class="button danger" style="margin-right: 10px">Kill Video</button><button id="addVideo" class="button success" style="margin-right: 10px">Change Video</button>
		</center>
		</div>
';
		}
		else
		{
echo'
		<center><p style="font-size: 15px; color: #444444">There is no Video displayed currently. The real time graphs are displayed on Apigee TV now!</p>
<br>
<button id="addVideo" class="button primary" style="margin-right: 10px">Display a Video</button>
</center>
<br><br>

';
		}


?>
                    
                </div>                
            </div>
        </div>
    </div>

<!-- To delete a Notification -->

<?php
echo"
	<script>
                        $(\"#deleteNotification\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=deleteNotification\">' +
					    '<label style=\"color: #000000\">Are you sure?</label>' +
                                            '<br><br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Yes\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Kill Notification\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>

	<script>
                        $(\"#deleteVideo\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=deleteVideo\">' +
					    '<label style=\"color: #000000\">Are you sure want to stop playing the video and show real time graphs?</label>' +
                                            '<br><br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Yes\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Kill Video\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>


	<script>
                        $(\"#addNotification\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=addNotification\">' +
                                            '<div class=\"input-control text\"><input placeholder=\"Subject\" type=\"text\" name=\"subject\" required></div>' +                                            
					'<div class=\"input-control textarea\" data-role=\"input-control\"><textarea placeholder=\"Details\" name=\"details\" required></textarea></div>' +

								'<label>Frequency</label>' +

'<div class=\"input-control select\" data-role=\"input-control\"><select name=\"frequency\" required><option value=\"60000\">Repeat every 1 Minute</option><option value=\"300000\">Repeat every 5 Minutes</option><option value=\"600000\">Repeat every 10 Minutes</option><option value=\"900000\">Repeat every 15 Minutes</option><option value=\"1800000\">Repeat every 30 Minutes</option><option value=\"2700000\">Repeat every 45 Minutes</option><option value=\"3600000\">Repeat every 1 Hour</option><option value=\"7200000\">Repeat every 2 Hours</option></select></div>' +

					    '<label style=\"color: #000000\">Expires at 23:59 HRS on:</label>' +
                                            '<div class=\"input-control text\"><input placeholder=\"Expires On\" type=\"date\" name=\"deadline\" required></div>' +
                                            '<br><br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Start Notifying\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Add a Notification\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>

	<script>
                        $(\"#addVideo\").on('click', function(){
                            $.Dialog({
                                overlay: true,
                                shadow: true,
                                flat: true,
                                draggable: true,
                                icon: '<img src=\"images/favicon.png\">',
                                title: 'Flat window',
                                content: '',
                                padding: 10,
                                onShow: function(_dialog){
                                    var content = '<form class=\"user-input\" method=\"post\" action=\"?action=addVideo\">' +
                                            '<div class=\"input-control text\"><input placeholder=\"YouTube Video ID\" type=\"text\" name=\"youtubeUrl\" required></div>' +                                            
                                            '<br><br><div class=\"form-actions\">' +
                                            '<input type=\"submit\" value=\"Save\">&nbsp;'+
                                            '<button class=\"button\" type=\"button\" onclick=\"$.Dialog.close()\">Cancel</button> '+
                                            '</div>'+
                                            '</form>';

                                    $.Dialog.title(\"Add a Video URL\");
                                    $.Dialog.content(content);
                                }
                            });
                        });
	</script>


";
?>

    <script src="js/hitua.js"></script>

</body>
</html>
