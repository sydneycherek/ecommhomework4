<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Size (sq. ft.)</th>
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

$sql = "SELECT enclosure_id, enclosuretype, enclosuresize from Enclosure";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["enclosure_id"]?></td>
    <td><?=$row["enclosuretype"]?></a></td>
    <td><?=$row["enclosuresize"]?></td>
    <td>
      <form method="post" action="enclosure-edit.php">
        <input type="hidden" name="id" value="<?=$row["enclosure_id"]?>">
        <input type="submit" value="Edit">
    </td>
  </tr>
<?php
  }
} else {
  echo "0 results";
}
$conn->close();
