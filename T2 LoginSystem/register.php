<?php
include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST["username"];
  $email = $_POST["email"];
  $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

  $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
  $stmt->bind_param("sss", $username, $email, $password);

  if ($stmt->execute()) {
    $success = "Registration successful! <a href='login.php'>Login</a>";
  } else {
    $error = "Error: " . $stmt->error;
  }
}
?>

<link rel="stylesheet" href="style.css">
<div class="container">
  <h2>Register</h2>
  <?php 
    if (isset($error)) echo "<p style='color:red;'>$error</p>"; 
    if (isset($success)) echo "<p style='color:green;'>$success</p>"; 
  ?>
  <form method="POST">
    <input type="text" name="username" placeholder="Username" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Register</button>
  </form>
  <div class="link">
    <a href="login.php">Already have an account?</a>
  </div>
</div>
