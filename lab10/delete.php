<?php
	session_start();
	session_destroy();
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<title>Dashboard with Storage</title>
</head>

<body class="bg-light">

	<div class="container">
		<div class="pt-5 pb-3 text-center">
			<h2>Confirmation</h2>
			<p class="lead"></p>
		</div>

		<div class="row">
			<div class="col-12">
				<h4 class="mb-3">Data Has Been Deleted</h4>

				Click <a href="dashboard.php">here to go back</a> to Dashboard.
				
			</div>
		</div>

		<footer class="my-5 text-muted text-center text-small">
			<p class="mb-1">&copy; 2019 ITP Web Dev</p>
		</footer>

	</div>
	
</body>
</html>