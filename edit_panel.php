<?php

session_start();
require_once 'init.php';

// Odesłanie użytkownika do index.php w przypadku gdy nie został zalogowany w sesji
if (!isset($_SESSION['name'])){

  header('Location: index.php');
  exit();
}

$login = $_SESSION['name'];
$welcome = "<h2>User edition: ".$login.'</h2><br>';

$myDb = new database();
$DAO = new UserDAO($myDb);

$user = $DAO->getUser($login);
?>

<!doctype html>
<html lang="pl">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Edit panel</title>
  <link rel = "icon" href = "https://icons-for-free.com/iconfiles/png/512/chat+icon-1320184411998302345.png" type = "image/x-icon"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <style>
    p,h1,h3,h2 {color: #F5F5F5;}
    .container {
			display: flex;
			justify-content: center;
			align-items: center;
			margin-top: 200px;
			width:1000px;
    }
    body{
			background-color: #74EBD5;
  			background-image: linear-gradient(90deg, #74EBD5 0%, #9FACE6 100%);
		}
  </style>

</head>

  <body class="text-center">

    <!-- Panel użytkownika z bootstrapowym wyglądem-->
    <div class="container" style="width:400px; margin-top: 100px;" >
      <div class="shadow-lg p-3 mb-5 rounded">
        <form class="form-signin" action="edit.php" method="post">

          <img src="https://cdn.pixabay.com/photo/2017/06/06/00/33/edit-icon-2375785_1280.png" alt="" width="80" height="80"><br><br>
          <?php echo $welcome;?>
          <input type='hidden' name='login' value=<?php echo htmlspecialchars($login);?>>
          <label for="inputAvatar" class="sr-only">Icon address</label>
          <input id="inputAvatar" class="form-control" name="avatar"  placeholder="Icon address" required value=<?php echo htmlspecialchars($user->avatar);?>><br>
          <button class="btn btn-lg btn-light btn-block" type="submit">Change avatar</button><br>
        </form>

        <form class="form-signin" action="edit.php" method="post">
          <input type='hidden' name='login' value=<?php echo htmlspecialchars($login);?>>
          <label for="inputPassword" class="sr-only">Old password</label>
          <input id="inputPassword" class="form-control" name="old_password"  placeholder="Old password" type="password" required>
          <label for="inputPasswordNew" class="sr-only">New password</label>
          <input id="inputPasswordNew" class="form-control" name="new_password"  placeholder="New password" type="password" required><br>
          <?php
            //Miejsce pojawienia sie ewentualnego błędu przy niepoprawnym podaniu danych
            if(isset($_SESSION['error_edit'])) echo $_SESSION['error_edit'];
        	?>
          <button class="btn btn-lg btn-light btn-block" type="submit">Change password</button>
          <a href="chat.php" class="btn btn-lg btn-light btn-block">Back</a> 
        </form><br>
      </div>
    </div>
  </body>
</html>
