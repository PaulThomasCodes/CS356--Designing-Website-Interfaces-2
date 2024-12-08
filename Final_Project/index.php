<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <link rel="stylesheet" href="week8_login_style.css">
    <style>
        body {
            background-color: lightblue; /* Default background color */
        }
    </style>
    <!-- Include jQuery from CDN -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
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

                    // Check to see if value was returned (was a row returned)
                    $check = mysqli_fetch_array($result);

                    // If isset($check) is true, we have a match on the email and password
                    if (isset($check)) {
                        echo "Success!";

                        // Put the current session id into the session variable
                        $_SESSION['id'] = session_id();

                        // Keep track of the email
                        $_SESSION['email'] = $email;

                        // Redirect the user to the restricted part of the website
                        // header('location:index.php'); use a page that checks for the session variables
                    } else {
                        echo "Please try your info again.";
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

        <!-- Buttons to change and revert background color -->
        <button id="changeColor">Change Background Color</button>
        <button id="revertColor">Revert Background Color</button>
    </main>

    <script>
        $(document).ready(function() {
            // When the "Change Background Color" button is clicked
            $('#changeColor').click(function() {
                $('body').css('background-color', 'lightgreen');
            });

            // When the "Revert Background Color" button is clicked
            $('#revertColor').click(function() {
                $('body').css('background-color', 'lightblue');
            });
        });
    </script>
</body>
</html>
