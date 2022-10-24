<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructors</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Animals</h1>
<table class="table table-striped">
  <thead>
    <tr>
      <th>ID</th>
      <th>Name</th>
      <th>Type</th>
      <th>Gender</th>
    </tr>
  </thead>
  <tbody>
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Animal (animalname, animaltype, animalgender) values (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $_POST['aName'], $_POST['aType'], $_POST['aGender']) ;
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Animal added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Animal set animalname=?, animaltype=?, animalgender=? where animal_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("si", $_POST['aName'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Animal edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Animal where animal_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Animal deleted.</div>';
      break;
  }
}
    
    

$sql = "SELECT animal_id, animalname, animaltype, animalgender from Animal";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
?>
   <tr>
            <td><?=$row["animal_id"]?></td>
            <td><?=$row["animalname"]?></td>
            <td><?=$row["animaltype"]?></td>
            <td><?=$row["animalgender"]?></td>
            <td>
              <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editAnimal<?=$row["animal_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editAnimal<?=$row["animal_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAnimal<?=$row["animal_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editAnimal<?=$row["animal_id"]?>Label">Edit Animal</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editAnimal<?=$row["animal_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editAnimal<?=$row["animal_id"]?>Name" aria-describedby="editAnimal<?=$row["animal_id"]?>Help" name="aName" value="<?=$row['animalname']?>">
                          <div id="editAnimal<?=$row["animal_id"]?>Help" class="form-text">Enter the Animal's name.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editAnimal<?=$row["animal_id"]?>Name" class="form-label">Type</label>
                          <input type="text" class="form-control" id="editAnimal<?=$row["animal_id"]?>Name" aria-describedby="editAnimal<?=$row["animal_id"]?>Help" name="aType" value="<?=$row['animaltype']?>">
                          <div id="editAnimal<?=$row["animal_id"]?>Help" class="form-text">Enter the Type of Animal.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editAnimal<?=$row["animal_id"]?>Name" class="form-label">Gender</label>
                          <input type="text" class="form-control" id="editAnimal<?=$row["animal_id"]?>Name" aria-describedby="editAnimal<?=$row["animal_id"]?>Help" name="aGender" value="<?=$row['animalgender']?>">
                          <div id="editAnimal<?=$row["animal_id"]?>Help" class="form-text">Enter the Animal's Gender.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['animal_id']?>">
                        <input type="hidden" name="saveType" value="Edit">
                        <input type="submit" class="btn btn-primary" value="Submit">
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </td>
            <td>
              <form method="post" action="">
                <input type="hidden" name="iid" value="<?=$row["animal_id"]?>" />
                <input type="hidden" name="saveType" value="Delete">
                <input type="submit" class="btn" onclick="return confirm('Are you sure?')" value="Delete">
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
    <a href="animal-add.php" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAnimal">Add New Animal</a>
    
    
      <!-- Modal -->
      <div class="modal fade" id="addAnimal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAnimalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addAnimalLabel">Add Animal</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
  <div class="mb-3">
    <label for="animalname" class="form-label">Name</label>
    <input type="text" class="form-control" id="animalname" aria-describedby="nameHelp" name="aName">
    <div id="nameHelp" class="form-text">Enter the Animal's name.</div>
  </div>
  <div class="mb-3">
    <label for="animaltype" class="form-label">Type</label>
    <input type="text" class="form-control" id="animaltype" aria-describedby="typeHelp" name="aType">
    <div id="typeHelp" class="form-text">Enter the Type of Animal.</div>
  </div>
  <div class="mb-3">
    <label for="animalgender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="animalgender" aria-describedby="genderHelp" name="aGender">
    <div id="genderHelp" class="form-text">Enter the Gender of the Animal.</div>
  </div>
                <input type="hidden" name="saveType" value="Add">
                <button type="submit" class="btn btn-primary">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
   


