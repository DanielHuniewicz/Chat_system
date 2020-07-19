<?php

session_start();
require_once 'init.php';

$chat_id='';
if(isset($_POST['id'])){
  $chat_id = $_POST['id'];
  $_SESSION['chat_id'] = $chat_id;
} 

if(isset($_SESSION['chat_id'])){
  $chat_id = $_SESSION['chat_id'];
}

if (!isset($_SESSION['name'])){
  header('Location: index.php');
  exit();
}

$login = $_SESSION['name'];
$key = $_SESSION['key'];

$empty_icon = "https://cdn.icon-icons.com/icons2/1674/PNG/512/person_110935.png";

$myDb = new database();
$DAO = new UserDAO($myDb);
$user = $DAO->getUser($login);

$apiDAO = new ApiDao();
$getAll = $apiDAO->getAll();
$getActive = $apiDAO->getActive($login,$key);
$get = $apiDAO->get($login,$key); 
?>

<!doctype html>
<html lang="pl">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Chat Panel</title>
  <link rel = "icon" href = "https://icons-for-free.com/iconfiles/png/512/chat+icon-1320184411998302345.png" type = "image/x-icon"> 
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="chat.css">

</head>
<body>
<div class="container py-5">

  <header class="text-center">
    <!-- Pasek nawigacji-->
    <nav class="navbar navbar-light">
      <form class="form-inline">
        <div class="avatar"><img src=<?php 
        if(!empty($user->avatar)){
          echo $user->avatar;
        } else {
          echo $empty_icon;
        }
        ?> alt='user' width='50' class='rounded-circle'></div>
        <?php echo '<h4>'.$login.'</h4>';?>
        <a href='chat.php' class="btn btn-success">Home</a>
        <a href='edit_panel.php' class='btn btn-info'>Edit</a>
        <a href='logout.php' class='btn btn-warning'>Logout</a>
      </form>
      <form class="form-inline" action="join.php" method="post">
        <input class="form-control mr-sm-2" type="search" name="user" placeholder="Add user" aria-label="Add user" autocomplete="off" required autofocus>
        <button class="btn btn btn-info my-2 my-sm-0" type="submit">Add</button>
      </form>
      <form class="form-inline" action="create.php" method="post">
        <input class="form-control mr-sm-2" type="search" name="chat_name" placeholder="Create conversation" aria-label="Create conversation" autocomplete="off" required autofocus>
        <button class="btn btn btn-success my-2 my-sm-0" type="submit">Create</button>
      </form>
    </nav>
  </header>

  <div class="row rounded-lg overflow-hidden shadow">

    <!-- Panel uzytkownika-->
    <div class="col-3 px-0">
      <div class="bg-white">
        <div class="bg-gray px-4 py-2 bg-light">
          <p class="h5 mb-0 py-1">Conversations</p>
        </div>
        <div class="messages-box">
          <div class="list-group rounded-0">

            <!-- Lista rozmow -->
            <?php 
            foreach($getActive as $i => $row) {

              $chat_id_message = $row['id'];

              foreach(array_reverse($get['list']) as $i => $row2){

                if($row2['chat_id']==$chat_id_message){ 

                  $message_id = $row2['id'].' ';
                  $explode_id = explode(" ", $message_id);
                  $last_message = max($explode_id);
                }
              }

              if($row['id']==$chat_id){

                echo "<form action='' method='post'>
                <input type='hidden' name='id' value={$row['id']}>
                <button class='list-group-item list-group-item-action active text-white rounded-0'>";
                if(isset($last_message)){
                  foreach($get['list'] as $i => $row3) {
                    if($last_message==$row3['id']){
                      $date = $row3['date'];
                      $login_messege= $row3['login'];
                      foreach($getAll as $i => $row4) {
                        if($login_messege==$row4['login']){
                          $avatar_mess = $row4['icon'];
                          if(!empty($avatar_mess)){
                            echo "<div class='media'><img src='".$avatar_mess."' alt='user' width='50' class='rounded-circle'>";
                          } else {
                            echo "<div class='media'><img src='".$empty_icon."' alt='user' width='50' class='rounded-circle'>";
                          }
                        }
                      }
                    }
                  }
                } else {
                  echo "<div class='media'><img src='".$empty_icon."' alt='user' width='50' class='rounded-circle'>";
                }
                echo "<div class='media-body ml-4'>
                <div class='d-flex align-items-center justify-content-between mb-1'>
                <h6 class='mb-0'>{$row['name']}</h6>";
                foreach($get['list'] as $i => $row3) {
                  if(isset($last_message)){
                  if($last_message==$row3['id']){
                    
                    $date = $row3['date'];
                    $login_messege= $row3['login'];
                    echo "<small class='small font-weight-bold'>".substr($date,0,-9)."</small></div>";
                    echo "<p class='font-italic mb-0 text-small'>".$login_messege.": ".$row3['message']."</p>";
                    }
                  }
                }
                echo "</div>
                </div>
                </form>
                <form action='leave.php' method='post'>
                  <input type='hidden' name='id' value={$row['id']}>
                  <button class='btn btn-outline-danger' type='submit' style='width: 10%;'>X</button>
                </form>";
              } else { 
                echo "<form action='' method='post'>
                <input type='hidden' name='id' value={$row['id']}>
                <button class='list-group-item list-group-item-action list-group-item-light rounded-0'>";
                if(isset($last_message)){
                  foreach($get['list'] as $i => $row3) {
                    if($last_message==$row3['id']){
                      $date = $row3['date'];
                      $login_messege= $row3['login'];
                      foreach($getAll as $i => $row4) {
                        if($login_messege==$row4['login']){
                          $avatar_mess = $row4['icon'];
                          if(!empty($avatar_mess)){
                            echo "<div class='media'><img src='".$avatar_mess."' alt='user' width='50' class='rounded-circle'>";
                          } else {
                            echo "<div class='media'><img src='".$empty_icon."' alt='user' width='50' class='rounded-circle'>";
                          }
                        }
                      }
                    }
                  } 
                } else {
                  echo "<div class='media'><img src='".$empty_icon."' alt='user' width='50' class='rounded-circle'>";
                }
                echo "<div class='media-body ml-4'>
                <div class='d-flex align-items-center justify-content-between mb-1'>
                <h6 class='mb-0'>{$row['name']}</h6>";
                if(isset($last_message)){
                  foreach($get['list'] as $i => $row3) {
                    if($last_message==$row3['id']){
                      $date = $row3['date'];
                      echo "<small class='small font-weight-bold'>".substr($date,0,-9)."</small></div>";
                      echo "<p class='font-italic mb-0 text-small'>".$row3['login'].": ".$row3['message']."</p>";
                    }
                  }
                }
                echo "</div>
                </div>
                </form>
                <form action='leave.php' method='post'>
                  <input type='hidden' name='id' value={$row['id']}>
                  <button class='btn btn-outline-danger' type='submit' style='width: 10%;'>X</button>
                </form>";
              }
            }
            ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Panel wiadomosci-->
    <div class="col-6 px-0">
      <div class="px-4 py-5 chat-box bg-white" id="messageBody">
      
        <!-- Wiadomosc-->
        <?php 
          foreach(array_reverse($get['list']) as $i => $row) {
            if($row['chat_id']==$chat_id){
              if($row['login']==$login){
                echo "<div class='media w-50 ml-auto mb-3'>
                <div class='media-body'>
                  <div class='bg-primary rounded py-2 px-3 mb-2'>
                    <p class='ext-small mb-0 text-white'>{$row['message']}</p>
                  </div>
                  <p class='small text-muted'>{$row['date']}</p>
                </div>
              </div>";
              } else { 
                  foreach($getAll as $i => $row4) {
                    if($row['login']==$row4['login']){
                      $avatar_mess = $row4['icon'];
                      if(empty($avatar_mess)){
                        $avatar_mess = $empty_icon;
                      }
                    }
                  }
                  echo "<div class='media w-50 mb-3'><img src='".$avatar_mess."' width='50' class='rounded-circle'>
                  <div class='media-body ml-3'>
                    <div class='bg-light rounded py-2 px-3 mb-2'>
                      <p class='text-small mb-0 text-muted'>{$row['message']}</p>
                    </div>
                    <p class='small text-muted'>{$row['login']} {$row['date']}</p>
                  </div>
                </div>";
              }
            }
          }
        ?>
      </div>
      <!-- Pole formowania wiadomosci -->
      <form action='send.php' method='post' class="bg-light">
        <div class="input-group">
          <input type="text" name="message" placeholder="Type a message" aria-describedby="button-addon2" class="form-control rounded-0 border-0 py-4 bg-light" autocomplete="off" required autofocus>
          <div class="input-group-append">
          <button class="btn btn btn-success my-2 my-sm-0" style="width: 100px; margin-right: 15px;" type="submit">Send</button>
          </div>
        </div>
      </form>
    </div>

    <div class="col-3 px-0">
      <!-- Lista wszystkich uzytkownikow -->
      <div class="list">
        <table class = "table table-striped table-light mb-0">
          <thead>
              <tr>
                  <th>User</th>
                  <th>Status</th>
                  <th>Icon</th>
              </tr>
          </thead>
          <?php
            foreach($getAll as $i => $row) {

              if ($row['status']=="online"){

                $status="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7a/LACMTA_Circle_Green_Line.svg/512px-LACMTA_Circle_Green_Line.svg.png";

              } else {

                $status = "https://upload.wikimedia.org/wikipedia/commons/thumb/9/92/LACMTA_Circle_Red_Line.svg/768px-LACMTA_Circle_Red_Line.svg.png";
              }
              $avatar = $row['icon'];
              if(empty($avatar)){$avatar = $empty_icon;}
              echo "<tbody><tr><td>{$row['login']}</td><td><img width='35' height='35'  src='$status'></td><td><img width='35' height='35' src='$avatar'></td></tr></tbody>";
            }
          ?>
        </table>
      </div>
    </div>
  </div>
</div>
<script>

  var messageBody = document.querySelector('#messageBody');
  messageBody.scrollTop = messageBody.scrollHeight - messageBody.clientHeight;
</script>
</body>
</html>
