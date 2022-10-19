<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Care Record</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <h1>Add Care Record</h1>
<form method="post" action="care-add-save.php">
  <div class="mb-3">
    <label for="animal_id" class="form-label">Animal ID</label>
    <input type="text" class="form-control" id="animal_ID" aria-describedby="idHelp" name="iName">
    <div id="idHelp" class="form-text">Enter the Animal's ID who got care.</div>
  </div>
  <div class="mb-3">
    <label for="employee_id" class="form-label">Employee ID</label>
    <input type="text" class="form-control" id="employee_id" aria-describedby="eidHelp" name="eType">
    <div id="eidHelp" class="form-text">Enter the Employee ID who treated the Animal</div>
  </div>
  <div class="mb-3">
    <label for="servicetype" class="form-label">Service Type</label>
    <input type="text" class="form-control" id="servicetype" aria-describedby="serviceHelp" name="sType">
    <div id="serviceHelp" class="form-text">Enter the Type of Service</div>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
