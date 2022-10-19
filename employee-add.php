<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Employee</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Add Employee</h1>
<form method="post" action="employee-add-save.php">
  <div class="mb-3">
    <label for="employeename" class="form-label">Employee Name</label>
    <input type="text" class="form-control" id="employeename" aria-describedby="eHelp" name="eName">
    <div id="eHelp" class="form-text">Enter the Employee Name</div>
  </div>
  <div class="mb-3">
    <label for="employeetitle" class="form-label">Title</label>
    <input type="text" class="form-control" id="employeetitle" aria-describedby="tHelp" name="tType">
    <div id="tHelp" class="form-text">Enter the Employee's Title.</div>
  </div>
  <div class="mb-3">
    <label for="employeegender" class="form-label">Gender</label>
    <input type="text" class="form-control" id="employeegender" aria-describedby="gHelp" name="gType">
    <div id="gHelp" class="form-text">Enter the Employee's Gender.</div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
