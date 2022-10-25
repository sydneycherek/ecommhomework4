<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Enclosure Table</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Enclosures</h1>
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
    
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Enclosure (enclosuretype, enclosuresize) values (?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("ss", $_POST['tName'], $_POST['sType']) ;
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Enclosure added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Enclosure set enclosuretype=?, enclosuresize=? where enclosure_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("ssi", $_POST['tName'], $_POST['sType'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Enclosure edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Enclosure where enclosure_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Enclosure deleted.</div>';
      break;
  }
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
      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editEnclosure<?=$row["enclosure_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editEnclosure<?=$row["enclosure_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEnclosure<?=$row["enclosure_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editEnclosure<?=$row["enclosure_id"]?>Label">Edit Enclosure</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editEnclosure<?=$row["enclosure_id"]?>Name" class="form-label">Type</label>
                          <input type="text" class="form-control" id="editEnclosure<?=$row["enclosure_id"]?>Name" aria-describedby="editEnclosure<?=$row["enclosure_id"]?>Help" name="tName" value="<?=$row['enclosuretype']?>">
                          <div id="editEnclosure<?=$row["enclosure_id"]?>Help" class="form-text">Enter the Enclosure Type.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editEnclosure<?=$row["enclosure_id"]?>Name" class="form-label">Size</label>
                          <input type="text" class="form-control" id="editEnclosure<?=$row["enclosure_id"]?>Name" aria-describedby="editEnclosure<?=$row["enclosure_id"]?>Help" name="sType" value="<?=$row['enclosuresize']?>">
                          <div id="editEnclosure<?=$row["enclosure_id"]?>Help" class="form-text">Enter the Size of the Enclosure.</div>
                        </div>
                        
                        <input type="hidden" name="iid" value="<?=$row['enclosure_id']?>">
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
                <input type="hidden" name="iid" value="<?=$row["enclosure_id"]?>" />
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
    <a href="enclosure-add.php" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEnclosure">Add New Enclosure</a>

 <!-- Modal -->
      <div class="modal fade" id="addEnclosure" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEnclosureLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addEnclosureLabel">Add Enclosure</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
  <div class="mb-3">
    <label for="enclosuretype" class="form-label">Type</label>
    <input type="text" class="form-control" id="enclosuretype" aria-describedby="typeHelp" name="tName">
    <div id="typeHelp" class="form-text">Enter the Enclosure Type.</div>
  </div>
  <div class="mb-3">
    <label for="enclosuresize" class="form-label">Size</label>
    <input type="text" class="form-control" id="enclosuresize" aria-describedby="sizeHelp" name="sType">
    <div id="sizeHelp" class="form-text">Enter the Size of the Enclosure.</div>
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
