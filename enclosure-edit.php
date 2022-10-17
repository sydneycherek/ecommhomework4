<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Enclosure</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Edit Enclosure</h1>
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

$sql = "SELECT enclosure_id, enclosuretype, enclosuresize from Enclosure where enclosure_id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_POST['iid']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
<form method="post" action="enclosure-edit-save.php">
  <div class="mb-3">
    <label for="enclosuretype" class="form-label">Enclosure Type</label>
    <input type="text" class="form-control" id="enclosuretype" aria-describedby="typeHelp" name="tName" value="<?=$row['enclosuretype']?>">
    <div id="typeHelp" class="form-text">Edit the Enclosure Type.</div>
  </div>
  <div class="mb-3">
    <label for="enclosuresize" class="form-label">Size</label>
    <input type="text" class="form-control" id="enclosuresize" aria-describedby="sizeHelp" name="sType" value="<?=$row['enclosuresize']?>">
    <div id="sizeHelp" class="form-text">Edit the Size of the Enclosure.</div>
  </div>
 
  <input type="hidden" name="iid" value="<?=$row['enclosure_id']?>">
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
