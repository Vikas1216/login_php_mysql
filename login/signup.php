<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-yEPZ7jP9S0QKiUQ0m3jjsO4ProIW7wvR9gXkI7JOGa2XVsw53Yke2bsdkBbjmmiX" crossorigin="anonymous">
</head>
<body>
      <?php require 'partials/_nav.php'; 
      $showAlert = false;
      $showError = false;
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            include 'partials/_dbconnect.php';   
            $username = $_POST['username'];
            $password = $_POST['password'];
            $cpassword = $_POST['confirm_password'];
          
            $exit=false;
            $existsql = "SELECT * FROM `users` WHERE username = '$username'";
            $result = mysqli_query($conn, $existsql);
            $numExistRows = mysqli_num_rows($result);
            if($numExistRows>0){
                $showError = "Username already exists";
                $exit=true;
            }
           elseif(($password == $cpassword) && $exit==false){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO `users` (`username`, `password`) VALUES ('$username', '$hash')";
                $result = mysqli_query($conn, $sql);
                if($result){
                    $showAlert = true;
                }
                
            }
            else{
                $showError = "Passwords do not match";
            }
            
            // $existsql = "SELECT * FROM `users` WHERE username = '$username'";
            // $result = mysqli_query($conn, $existsql);
            
            if($showAlert){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You have been signed up successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
            if($showError){
                echo'
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $showError . '
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
            }
        }
        
    ?>    
        <div class="container">
            <h1 class="text-center">Sign Up to our Website</h1>
            <form action="signup.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password">
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js" integrity="sha384-WyOxWvTyr1QaMPfiPJSv76iReVthorl5uWlFtZPyK0IEB0hGzo9y5Bp9mYanr8Bu" crossorigin="anonymous"></script>
  </body>
</html>