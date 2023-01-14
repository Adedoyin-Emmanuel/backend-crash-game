<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require_once("includes/autoload.php")?>
    <title>SignUp To Crash Game</title>
</head>
<body class="container-fluid p-3"> 
<form class="d-flex justify-content-between flex-column  width-toggle-3 m-auto">
    <h3 class="text-center text-capitalize fs-3 my-3">Signup to crash game</h3>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Username</label>
    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1">
  </div>

    <button type="submit" class="btn btn-primary text-capitalize my-3">signup</button>



  <p class="text-capitalize">already have an account? <a href="login.php">login</a>
</form>
</body>
</html>