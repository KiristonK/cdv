<?php
session_start();
if (!empty($_POST['name']) && !empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['email2']) &&
  !empty($_POST['pass']) && !empty($_POST['pass2']) && !empty($_POST['birthday'])) {
  $error = 0;
  if (!isset($_POST['terms'])) {
    $error = 1;
    $_SESSION['error'] = 'Zaznacz regualmin !';
  }
  if ($_POST['email'] != $_POST['email2']) {
    $error = 1;
    $_SESSION['error'] = 'Adresy poczty elektronicznej są różne';
  }
  if ($_POST['pass'] != $_POST['pass2']) {
    $error = 1;
    $_SESSION['error'] = 'Hasłą są różne';
  }
  if ($error != 0) {
    ?>
    <script>
      history.back();
    </script>
    <?php
    exit();
  }
  $name = $_POST['name'];
  $surname = $_POST['surname'];
  $pass = $_POST['pass'];
  $email = $_POST['email'];
  $birthday = $_POST['birthday'];

  $city = 1;
  require_once 'connection.php';
  if ($conn->connect_errno) {
    $_SESSION['error'] = 'Avaria bazy danych';
    exit();
  }

  $sql = "select * from `users` where `email` = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s", $email);
  $stmt->execute();
  if ($stmt->affected_rows) {
    $_SESSION['error'] = 'Podany adres mailowy już istnieje';
    $conn->close();
    $stmt->close();
    ?>
    <script>
      history.back();
    </script>
    <?php
  } else {
    $sql = "INSERT INTO `users`(`name`, `surname`, `city_id`, `email`, `password`, `birthday`) VALUES (?,?,?,?,?,?);";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $name, $surname, $city, $email, $pass, $birthday);
    if ($stmt->execute()) {
      $conn->close();
      $stmt->close();
      header('location: ../?register=success');
    } else {
      $_SESSION['error'] = 'Bląd dodania użytkownika';
      $conn->close();
      $stmt->close();
      ?>
      <script>
        history.back();
      </script>
      <?php
    }
  }
} else {
  $_SESSION['error'] = 'Wypełnij wszystkie pola !';
  ?>
  <script>
    history.back();
  </script>
  <?php
}
?>
