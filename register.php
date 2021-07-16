<?php
 include_once './layouts/main/header.php';

 require_once './core/Database.php';

 if($_SERVER['REQUEST_METHOD'] == 'POST') {
     $first_name = $_POST['first_name'];
     $last_name = $_POST['last_name'];
     $email = $_POST['email'];
     $password = $_POST['password'];
     $confirm_password = $_POST['confirm_password'];

     $errors = [];

     if(!$first_name) $errors['first_name'] = "This Field is required";
     if(!$last_name) $errors['last_name'] = "This Field is required";
     if(!$email) $errors['email'] = "This Field is required";
     if(!$password) $errors['password'] = "This Field is required";
     if(!$confirm_password) $errors['confirm_password'] = "This Field is required";

     if($email) {
         if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "This Field must be a valid email";
         }

     }

     if($password && $confirm_password) {
         if($password != $confirm_password) {
            $errors['confirm_password'] = "Passwords do not match";
         }
     }

     if(!$errors) {

         $sql = 'INSERT INTO user(first_name,last_name,email,password) VALUES(?,?,?,?)';
         $command = $db->prepare($sql);

         $password = password_hash($password,PASSWORD_DEFAULT);

         $result = $command->execute(array($first_name,$last_name,$email,$password));

         if($result) {
             $_SESSION['success'] = "Registration successfull";
             header('location: index.php');
         }
         else {
             $_SESSION['error'] = "Unable to Register";
         }
     }
 }



?>

<main class="container">
    <div class="row">
        <div class="col-12 col-sm-6 m-auto">

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
                <input type="submit" class="btn btn-primary" value="Submit" name="submit">
            </form>
        </div>
    </div>
</main>

<?php

include_once './layouts/main/footer.php';