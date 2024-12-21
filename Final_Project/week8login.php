<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="w3appcss.css">
    <script src="validate.js"></script>
</head>
<body>
    <!-- Menu Bar -->
    <div class="menu-bar">
        <a href="index.php" class="active">Home</a> <!-- Home link -->
    </div>

    <!-- Split Screen Layout -->
    <div class="split">
        <!-- Left Side: Image Section -->
        <div class="left">
            <img src="landee_pic.jpeg" alt="Login Image" class="image">
        </div>

        <!-- Right Side: Login Form Section -->
        <div class="right">
            <h1>Owner Login</h1>

            <form name="frmLogin" id="frmLogin" method="post" action="week8login.php" onsubmit="return validateForm();">
                <div id="div_message" class="errorMessage"></div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $response = [];  // Create a response array

                    // Get the email and password
                    $email = $_POST['text_Email'];
                    $password = $_POST['txt_Password'];

                    // Database connection
                    $db_server_Name = "localhost:3306";
                    $db_user_name = "root";
                    $db_password = '';
                    $db_name = "test";

                    try {
                        $conn = new PDO("mysql:host=$db_server_Name;dbname=$db_name", $db_user_name, $db_password);
                        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Prepare the SQL query
                        $stmt = $conn->prepare("SELECT * FROM user_id WHERE email = :email AND password = :password");
                        $stmt->bindParam(':email', $email);
                        $stmt->bindParam(':password', $password);
                        $stmt->execute();

                        // Check if the user exists
                        if ($stmt->rowCount() > 0) {
                            $response['status'] = 'success';
                            $response['message'] = 'Login successful!';
                        } else {
                            $response['status'] = 'error';
                            $response['message'] = 'Invalid email or password.';
                        }
                    } catch (PDOException $e) {
                        $response['status'] = 'error';
                        $response['message'] = 'Connection failed: ' . $e->getMessage();
                    }

                    // Send the response as JSON
                    echo '<script>';
                    echo 'var responseData = ' . json_encode($response) . ';';
                    echo 'handleResponse(responseData);';
                    echo '</script>';
                }
                ?>

                <label for="text_Email" id="lbl_email">Email</label>
                <input type="text" id="text_Email" name="text_Email" placeholder="Enter Email Address...">
                <br><br>

                <label for="txt_Password" id="lbl_password">Password</label>
                <input type="password" id="txt_Password" name="txt_Password">
                <br><br>

                <button type="submit">Login</button>
            </form>
        </div>
    </div>

    <!-- Test Section -->
    <!-- <script> -->
        // Test function to simulate server response
        function testJSONResponse() {
            console.log("Running JSON response test...");

            // Simulated response
            const testResponse = {
                status: "success",
                message: "Test login successful!"
            };

            // Log the simulated response
            console.log("Simulated response:", testResponse);

            // Test handleResponse function
            handleResponse(testResponse);
        }

        // Run the test
        testJSONResponse();
    <!-- </script> -->
</body>
</html>
