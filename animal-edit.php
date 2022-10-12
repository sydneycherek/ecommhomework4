<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Animal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Animal</h1>
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

$sql = "SELECT animal_id, animalname, animaltype, animalgender from Animal where animal_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['iid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="animal-edit-save.php">
  <div class="mb-3">
    <label for="animalname" class="form-label">Name</label>
    <input type="text" class="form-control" id="animalname" aria-describedby="nameHelp" name="aName" value="<?=$row['animalname']?>">
    <div id="nameHelp" class="form-text">Edit the Animal's name.</div>
  </div>
  <div class="mb-3">
    <label for="animaltype" class="form-label">Type</label>
    <input type="text" class="form-control" id="animaltype" aria-describedby="typeHelp" name="aType" value="<?=$row['animaltype']?>">
    <div id="typeHelp" class="form-text">Edit the Type of Animal.</div>
  </div>
  <div class="mb-3">
    <label for="animalgender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="animalgender" aria-describedby="genderHelp" name="aGender" value="<?=$row['animalgender']?>">
    <div id="genderHelp" class="form-text">Edit the Animal's Gender.</div>
  </div>
  <input type="hidden" name="iid" value="<?=$row['animal_id']?>">
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
