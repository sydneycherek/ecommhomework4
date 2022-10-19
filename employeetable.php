<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employee Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Employees</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Employee ID</th>
      <th>Employee Name</th>
      <th>Title</th>
      <th>Employee Gender</th>
    </tr>
  </thead>
  <tbody>
    <?php
$servername = "localhost";
$username = "sydneych_homework3";
$password = "BananaSunday";
$dbname = "sydneych_homework3";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT employee_id, employeename, employeetitle, employeegender from Employee";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["employee_id"]?></td>
    <td><?=$row["employeename"]?></a></td>
    <td><?=$row["employeetitle"]?></td>
    <td><?=$row["employeegender"]?></td>
    <td>
      <form method="post" action="employee-edit.php">
        <input type="hidden" name="iid" value="<?=$row["employee_id"]?>">
        <input type="submit" value="Edit">
      </form>
    </td>
    <td>
      <form method="post" action="employee-delete-save.php">
        <input type="hidden" name="iid" value="<?=$row["employee_id"]?>">
        <input type="submit" value="Delete" class="btn" onclick="return confirm('Are you sure?')">
      </form>
    </td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
 ?>
  </tbody>
    </table>
    <br />
    <a href="employee-add.php" class="btn btn-primary">Add New Employee</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
