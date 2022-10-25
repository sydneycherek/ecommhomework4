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
    
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  switch ($_POST['saveType']) {
    case 'Add':
      $sqlAdd = "insert into Employee (employeename, employeetitle, employeegender) values (?,?,?)";
      $stmtAdd = $conn->prepare($sqlAdd);
      $stmtAdd->bind_param("sss", $_POST['eName'], $_POST['tType'], $_POST['gType']) ;
      $stmtAdd->execute();
      echo '<div class="alert alert-success" role="alert">New Employee added.</div>';
      break;
    case 'Edit':
      $sqlEdit = "update Employee set employeename=?, employeetitle=?, employeegender=? where employee_id=?";
      $stmtEdit = $conn->prepare($sqlEdit);
      $stmtEdit->bind_param("sssi", $_POST['eName'], $_POST['tType'], $_POST['gType'], $_POST['iid']);
      $stmtEdit->execute();
      echo '<div class="alert alert-success" role="alert">Employee edited.</div>';
      break;
    case 'Delete':
      $sqlDelete = "delete from Employee where employee_id=?";
      $stmtDelete = $conn->prepare($sqlDelete);
      $stmtDelete->bind_param("i", $_POST['iid']);
      $stmtDelete->execute();
      echo '<div class="alert alert-success" role="alert">Employee deleted.</div>';
      break;
  }
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
      <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editEmployee<?=$row["employee_id"]?>">
                Edit
              </button>
              <div class="modal fade" id="editEmployee<?=$row["employee_id"]?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editEmployee<?=$row["employee_id"]?>Label" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="editEmployee<?=$row["employee_id"]?>Label">Edit Employee</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <form method="post" action="">
                        <div class="mb-3">
                          <label for="editEmployee<?=$row["employee_id"]?>Name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="editEmployee<?=$row["employee_id"]?>Name" aria-describedby="editEmployee<?=$row["employee_id"]?>Help" name="eName" value="<?=$row['employeename']?>">
                          <div id="editEmployee<?=$row["employee_id"]?>Help" class="form-text">Enter the Employee's name.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editEmployee<?=$row["employee_id"]?>Name" class="form-label">Title</label>
                          <input type="text" class="form-control" id="editEmployee<?=$row["employee_id"]?>Name" aria-describedby="editEmployee<?=$row["employee_id"]?>Help" name="tType" value="<?=$row['employeetitle']?>">
                          <div id="editEmployee<?=$row["employee_id"]?>Help" class="form-text">Enter the Title of the Employee.</div>
                        </div>
                        <div class="mb-3">
                          <label for="editEmployee<?=$row["employee_id"]?>Name" class="form-label">Gender</label>
                          <input type="text" class="form-control" id="editEmployee<?=$row["employee_id"]?>Name" aria-describedby="editEmployee<?=$row["employee_id"]?>Help" name="gType" value="<?=$row['employeegender']?>">
                          <div id="editEmployee<?=$row["employee_id"]?>Help" class="form-text">Enter the Employee's Gender.</div>
                        </div>
                        <input type="hidden" name="iid" value="<?=$row['employee_id']?>">
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
        <input type="hidden" name="iid" value="<?=$row["employee_id"]?>">
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
    <a href="employee-add.php" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEmployee">Add New Employee</a>

 <!-- Modal -->
      <div class="modal fade" id="addEmployee" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addEmployeeLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="addEmployeeLabel">Add Employee</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="">
  <div class="mb-3">
    <label for="employeename" class="form-label">Name</label>
    <input type="text" class="form-control" id="employeename" aria-describedby="eHelp" name="eName">
    <div id="eHelp" class="form-text">Enter the Employee's name.</div>
  </div>
  <div class="mb-3">
    <label for="employeetitle" class="form-label">Title</label>
    <input type="text" class="form-control" id="employeetitle" aria-describedby="tHelp" name="tType">
    <div id="tHelp" class="form-text">Enter the Title of the Employee.</div>
  </div>
  <div class="mb-3">
    <label for="employeegender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="employeegender" aria-describedby="gHelp" name="gType">
    <div id="gHelp" class="form-text">Enter the Gender of the Employee.</div>
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
