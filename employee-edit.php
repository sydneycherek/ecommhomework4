<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Employee</h1>
<?php
$servername = "localhost";
$username = "sydneych_homework3";
$password = "BananaSunday";
$dbname = "sydneych_homework3";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT employee_id, employeename, employeetitle, employeegender from Employee where employee_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['iid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="employee-edit-save.php">
  <div class="mb-3">
    <label for="employeename" class="form-label">Employee Name</label>
    <input type="text" class="form-control" id="employeename" aria-describedby="eHelp" name="eName" value="<?=$row['employeename']?>">
    <div id="eHelp" class="form-text">Edit the Employee's Name.</div>
  </div>
  <div class="mb-3">
    <label for="employeetitle" class="form-label">Title</label>
    <input type="text" class="form-control" id="employeetitle" aria-describedby="tHelp" name="tType" value="<?=$row['employeetitle']?>">
    <div id="tHelp" class="form-text">Edit the Employee's Title.</div>
  </div>
  <div class="mb-3">
    <label for="employeegender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="employeegender" aria-describedby="gHelp" name="gType" value="<?=$row['employeegender']?>">
    <div id="gHelp" class="form-text">Edit the Employee's Gender.</div>
  </div>
 
  <input type="hidden" name="iid" value="<?=$row['employee_id']?>">
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
