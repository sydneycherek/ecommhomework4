<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Care Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Animal Care</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>Care ID</th>
      <th>Animal ID</th>
      <th>Employee ID</th>
      <th>Service Type</th>
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
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Care (animal_id, employee_id, servicetype) values (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $iName, $_POST['eType'], $_POST['sType']);
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Care added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Care set animal_id=?, employee_id=?, servicetype=? where care_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssi", $iName, $_POST['eType'],$_POST['sType'] $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Care edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Care where care_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Care deleted.</div>';
      break;
  }
}

$sql = "SELECT care_id, animal_id, employee_id, servicetype from Care";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["care_id"]?></td>
    <td><?=$row["animal_id"]?></td>
    <td><?=$row["employee_id"]?></td>
    <td><?=$row["servicetype"]?></td>
    <td>
      <form method="post" action="care-edit.php">
        <input type="hidden" name="iid" value="<?=$row["care_id"]?>">
        <input type="submit" value="Edit">
      </form>
    </td>
    <td>
      <form method="post" action="care-delete-save.php">
        <input type="hidden" name="iid" value="<?=$row["care_id"]?>">
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
    <a href="care-add.php" class="btn btn-primary">Add New Animal Care Record</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
