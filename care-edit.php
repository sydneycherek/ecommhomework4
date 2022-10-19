<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Care</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Care</h1>
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

$sql = "SELECT care_id, animal_id, employee_id, servicetype from Care where care_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['iid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="care-edit-save.php">
  <div class="mb-3">
    <label for="animal_id" class="form-label">Animal ID</label>
    <input type="text" class="form-control" id="animal_id" aria-describedby="idHelp" name="iName" value="<?=$row['animal_id']?>">
    <div id="idHelp" class="form-text">Edit the Animal's ID who got care.</div>
  </div>
  <div class="mb-3">
    <label for="employee_id" class="form-label">Employee ID</label>
    <input type="text" class="form-control" id="employee_id" aria-describedby="eidHelp" name="eType" value="<?=$row['employee_id']?>">
    <div id="eidHelp" class="form-text">Edit the Employee ID who treated the Animal</div>
  </div>
  <div class="mb-3">
    <label for="servicetype" class="form-label">Service Type</label>
    <input type="text" class="form-control" id="servicetype" aria-describedby="serviceHelp" name="sType" value="<?=$row['servicetype']?>">
    <div id="serviceHelp" class="form-text">Edit the Type of Service</div>
  </div>
  
  <input type="hidden" name="iid" value="<?=$row['care_id']?>">
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
