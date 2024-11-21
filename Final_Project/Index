<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="week8_ login_style.css">
    <Style>
        
    </Style>
    

    <script src="validate.js"></script> 
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>User Login Page</h1>

        <form name="frmLogin" id="frmLogin" method="post" action="week8_login.php" onsubmit="return validateForm();">

           <div id="div_message" class="errorMessage">
            

           

           <?php
                // Handle the form submission
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Get the email from the form
                    $email = $_POST['text_Email']; // Corrected variable assignment
                    // Get the password
                    $password = $_POST['txt_Password'];

                    require_once('db_connect.php');

                    // SQL query to check if the user's email and password exist in the database
                    $sql = "SELECT * FROM tblUser WHERE email = '$email' AND password = '$password'";

                    // Execute the SQL query
                    $result = mysqli_query($dbconn, $sql);

                    //check to see if value was returned (was a row returned)
                    $checl = mysqli_fetch_array($result);

                    // if isset($check is true, we have a match on the email and password)
                    // then we can let the user access the password protected part of the website
                    if (isset($check)){
                        echo "Success!";

                        // put the current session id into the session variable
                        $_SESSION['id'] = session_id();

                        // keep track of the email
                        // $_SESSION['is__logged_in'] = 'true';

                        $_SESSION['email'] = $email;

                        // another option would be to use a value to return by query
                        $_SESSION['email'] = $check['email'];

                        // redirect the user to the restricted part of the website
                        // header('location:index.php'); use a page that checks for the session variables

                    } // their records did not match any records in the database
                    else{
                        echo "please try your into again.";
                    }
                }
            ?>

</div> 

<!-- User email address field -->
 <label for="text_Email" id="lbl_email">Email</label>
 <input type="text" id="text_Email" name="text_Email" placeholder="Enter Email Address...">
 <br><br>

 <!-- Password field -->
  <label for="txt_Password" id="lbl_password">Password</label>
  <input type="password" id="text_Password" name="txt_Password">
 <br><br>

 <button type="submit">Login</button>
</form>
</main>
</body>
</html>
