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
      $login = false;
      $showError = false;
         if($_SERVER['REQUEST_METHOD'] == 'POST'){
            include 'partials/_dbconnect.php';   
            $username = $_POST['username'];
            $password = $_POST['password'];
          
            $sql = "SELECT * FROM `users` WHERE username = '$username' ";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if($num == 1){
               
                while($row = mysqli_fetch_assoc($result)){
                    if(password_verify($password, $row['password'])){
                        $login = true;
                        session_start();
                        $_SESSION['loggedin'] = true;
                        $_SESSION['username'] = $username;
                        header("location: welcome.php");
                    }
                    else{
                        $showError = "Invalid Credentials".$num;
                    }
                    
                }
            }
            else{
                $showError = "Invalid Credentials222";
            }
                               
           
            if($login){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You have been logged in successfully.
            }
            else{
                $showError = "Invalid Credentials"';
            }
                               
           
            if($login){
                echo'
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> You have been logged in successfully.
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
            <h1 class="text-center">Log In to our Website</h1>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp">
                </div>
                
                <div class="mb-3">
                    <label for="InputPassword1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="InputPassword1" name="password">
                </div>
               
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Log In</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.9/dist/js/bootstrap.bundle.min.js" integrity="sha384-WyOxWvTyr1QaMPfiPJSv76iReVthorl5uWlFtZPyK0IEB0hGzo9y5Bp9mYanr8Bu" crossorigin="anonymous"></script>
  </body>
</html>