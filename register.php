<?php
 include_once './layouts/main/header.php';

 // superglobal arrays
 // $_POST
 // $_GET
 // $_SERVER

 require_once './core/Database.php';

 
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
     $first_name = $_POST['first_name'];
     $last_name = $_POST['last_name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirm_password = $_POST['confirm_password'];

     $errors = array();

     foreach ($_POST as $key => $value ) {
         if($value == '') {
             $errors[$$key] = 'This field is required';
         }
     }

     if (! strcmp($password,$confirm_password) == 0) {
         $errors['password_confirm'] = "Passwords do not match";
     }

     if(strlen($password) < 8) {

     }
     else {
         $password = password_hash($password,PASSWORD_DEFAULT);
     }

     if($errors) {
         echo "Data not valid";
         exit();
     }

     if (!$errors) {

        try {

            $statement = "INSERT INTO user(first_name,last_name,email,password) values(?,?,?,?)";
            $data = array($first_name,$last_name,$email,$password);
            $query = $db->prepare($statement);
            $query->execute($data);
            $_SESSION['success'] = "User Registered Successfully";
            header('location: index.php');
        }
        catch(PDOException $e) {
            $_SESSION['success'] = "An error occurred";
        }
     }
 }


?>

<main class="container">
    <h1>Create an account</h1>
    <form action="" method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name" required>
        </div>

        <div class="mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name" required>
        </div>

        <div class="mb-3">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="confirm_password">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <div class="mb-3">
            <input type="submit" class="form-control btn btn-sm btn-primary" value="Submit" name="submit">
        </div>
    </form>
</main>

<?php

include_once './layouts/main/footer.php';