<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

    <h1>Welcome to the Zoo!</h1>
    
    <nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="animaltable.php">Animal Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="enclosuretable.php">Enclosure Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="caretable.php">Care Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="employeetable.php">Employee Page</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="secondcriteria2.php">Animal and Care recieved</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="animal-care.php">Joined Table</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
    
    <table class="table table-striped">
      <thead>
        <tr>
          <th>Animal ID</th>
          <th> Animal Name</th>
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

$sql = "SELECT * FROM Animal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
  <tr>
    <td><?=$row["animal_id"]?></td>
    <td><?=$row["animalname"]?></td>
    <td>
      <form method="post" action="postpage.php">
        <input type="hidden" name="id" value="<?=$row["animal_id"]?>" />
        <input type="submit" value="Care / Service Type" />
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
