<?php
  session_start();
  if (!empty($_POST['email']) && !empty($_POST['pass'])){
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    require_once 'connection.php';

    $sql = "select * from `users` where `email` = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();
    if ($res->num_rows == 1 ) {
      $user = $res->fetch_assoc();
      switch ($user['status_id']){
        case 1:
          if (password_verify($pass, $user['password'])){
            $_SESSION['logged']['name'] = $user['name'];
            header('location: ../pages/logged/admin.php');
            exit();
          }
          else {
            $error = 1;
            $_SESSION['error'] = "Blędny login lub hasło";
          }
          break;
        case 2:
          $_SESSION['error'] = "Konto nie jest nieaktywne<br>Enail:".$user['email'];
          break;
        case 3:
          $_SESSION['error'] = "Konto nie jest zablokowane !";
          break;
      }
      if ($user['status_id'] == 1) header('location: ../pages/logged/admin.php');
      else header('location: ../');
    } else {
      $error = 1;
      $_SESSION['error'] = 'Email nie znaleziony';
    }
    if ($error == 1){
      ?><script>history.back();</script><?php
      exit();
    }
  } else {
    $_SESSION['error'] = "Nie wypełnione wszystkie pola.";
  }
