<?php session_start();

if(!isset($_SESSION["user_id"])) 
{
    header("Location: login.php");//agr user login nhi to redirect
    exit();
}?>

<h2 >Welcome, <?php echo $_SESSION["username"]; ?>!</h2>
<a href="logout.php">Logout</a>
<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  
  
  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- jQuery requred for datatable -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- data table js -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
</head>
<body class="bg-light">

<div class="container py-5">
  <h2 class="mb-4">👥 User Dashboard</h2>
  <a href="add.php" class="btn btn-primary mb-3">+ Add User</a>
  
  <table id="userTable" class="table table-bordered table-hover bg-white shadow">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Email</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $result = $conn->query("SELECT * FROM users");
      while ($row = $result->fetch_assoc()):
    ?>
      <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['username'] ?></td>
        <td><?= $row['email'] ?></td>
        <td>
          <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
          <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
        </td>
      </tr>
    <?php endwhile; ?>
    </tbody>
  </table>
</div>

<script>
  $(document).ready(function() {
    $('#userTable').DataTable();
  });
</script>



</body>
</html>


