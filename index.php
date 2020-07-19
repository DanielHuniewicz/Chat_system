<?php
	
	// Odesłanie użytkownika do user_panel.php w przypadku gdy został już zalogowany w sesji
	session_start();	
	if ((isset($_SESSION['login'])) && ($_SESSION['login']==true) && ($_SESSION['admin']==false)){
		
		header('Location: chat.php');
		exit();
	}
	
?>

<!doctype html>
<html lang="pl">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link rel = "icon" href = "https://icons-for-free.com/iconfiles/png/512/chat+icon-1320184411998302345.png" type = "image/x-icon"> 
	<title>Log In</title>

	<style>
		.container {
			margin-top: 150px;
			width:350px;
		}
		button{
			display: block;
			margin: 0 auto;
			margin-bottom: 10px;
		}
		input{
			margin-bottom: 5px;
		}
		body{
			background-color: #74EBD5;
  			background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);
		}
	</style>
</head>

<body class="text-center">

	<!-- Formularz logowania uzytkownika z bootstrapowym wyglądem-->
	<div class="container">
		<div class="shadow-lg p-3 mb-5 rounded">
			<form class="form-signin" action="login.php" method="post">
				<img class="mb-4" src="https://icons-for-free.com/iconfiles/png/512/chat+icon-1320184411998302345.png" alt="" width="120" height="120">
				<h1 class="h3 mb-3 font-weight-normal" style="color:white;"><B>LOG IN</B></h1>
				<label for="inputEmail" class="sr-only">User name</label>
				<input id="inputEmail" class="form-control" name="name" placeholder="User name" required autofocus>
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" id="inputPassword" class="form-control" name="password" placeholder="Password" required><br>
				<button class="btn btn-lg btn btn-light" style="height:45px;width:250px" type="submit">Log in</button>
			</form>
			<form action="registration.php" method="post">
				<button  style="height:45px;width:250px" class="btn btn-lg btn btn-light" type="submit">Registration</button>
			</form>
		</div>
	</div>

	<?php

		//Miejsce pojawienia sie ewentualnego błędu przy niepoprawnym podaniu danych
		if(isset($_SESSION['error'])) echo $_SESSION['error'];
	?>
</body>
</html>
