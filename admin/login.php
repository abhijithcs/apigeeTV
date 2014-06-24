<?php
session_start();
$userError = 0;
if(isset($_SESSION['admin']))
{
	header('Location: index.php');
}
else
{
	if(isset($_POST['secPass']))
	{
		if($_POST['secPass'] == "iloveapis")
		{
			$_SESSION['admin'] = "admin";
			header('Location: index.php');			
		}
		else
		{		
			$userError = 1;
		}

	}	
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="favicon.png" type="image/x-icon">
    <link href="css/metro-bootstrap.css" rel="stylesheet">

    <title>Admin Login</title>

    <style>
        .container {
            width: 1000px;
        }
    </style>
</head>

<body class="metro">
   <div class="container">
        <header class="margin20 nrm nlm">
            <div class="clearfix">
		<a href="#">
			<center><br><br><img src="images/logo.png" height=100 /></center>
		</a>
            </div>

        </header>
	<br><br><br>

                    <div class="tile tripleF double-vertical bg-gray transparent" style="height: 220px" >
                        <div class="tile-content">
                            <div class="panel no-border">
                                <center><div class="panel-header bg-orange fg-white">ADMIN LOGIN</div></center>
							<center><br><br>
							<form method="post" action="login.php">
						            <fieldset>
								    <div class="input-control text size3" data-role="input-control">
								        <input type="password" name="secPass" placeholder="Enter Pass-code" required>
								    </div><br><br>
								<input type="submit" class="warning" value="Login">
						            </fieldset>
						        </form>
							
				<?php
				if($userError == 1)
				{
echo' <p style="color: #ffffff">Incorrect Pass-code.</p>';
				}
				?>
				</center>
                            </div>
                        </div>
                    </div>
	</div>
    <script src="js/hitua.js"></script>

</body>
</html>
