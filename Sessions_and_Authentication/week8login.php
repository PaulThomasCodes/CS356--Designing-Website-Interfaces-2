<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="w3appcss.css">
    <link rel="header" href="header.php">
    <style>
        /* custom css class starts with a . */
       .errorMessage{
            color: red;
            padding: 2opx;
       } 
    </style>

    <script> src="validate.js" </script>
</head>
<body>
    <?php include 'header.php'; ?>

    <main>
        <h1>User Login</h1>

        <form name="frmLogin" id= "frmLogin" method="post" action="week8login.php" onsubmit="return validateForm();">
           <div id="div_message" class="errorMessage">
            <?php
             
  

                //we want to handle the form submission
                if ($_SERVER['REQUEST_METHOD']=='POST'){
                    class TableRows extends RecursiveIteratorIterator {
                        function __construct($it) {
                          parent::__construct($it, self::LEAVES_ONLY);
                        }
                    }
                    // get the email from the form
                    $email = $_POST['text_Email'];
                    // get the password
                    $password = $_POST['txt_Password'];

                    // require_once('db_connect.php');
                    // variables to connect to database. this will only work on the teacher's account. I'll have to enter my info
    $db_server_Name = "localhost:3306";
    $db_user_name = "root";
    $db_password = '';
    $db_name = "test";

// $dbconn= mysqli_connect($db_server_Name, $db_user_name, $db_password, $db_name);
// if(!$dbconn){
    // echo "Connection failed.";
// }
// 
// try {
    $conn = new PDO("mysql:host=$db_server_Name ;dbname=$db_name", $db_user_name, $db_password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully";
//   } catch(PDOException $e) {
    // echo "Connection failed: " . $e->getMessage();
//   }

                    // create a SQL query to see if the user's email and password exist in the database
                    // TODO change to a stored procedure
                    // $sql = "SELECT * FROM tblUser WHERE email = '$email' AND password = '$password'";

                    // execute the sql query
                    // $result = mysqli_query($dbconn, $sql);
                    $stmt = $conn->prepare("SELECT * FROM user_id WHERE email = '$email' AND password = '$password'");
                    $stmt->execute();
                  
                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
                      echo $v;
                    }
                    
                }
            ?>
           </div> 

           <!-- let's get the user's email adress  -->
            <label for="text_Email" id="lbl_email">Email</label>
            <input type="text" id="text_Email" name="text_Email" placeholder="Enter Email Address...">
            <br>
            <br>
            <!-- Then get the password -->
             <label for="txt_Password" id="lbl_password">Password</label>
             <input type="password" id="text_Password" name="txt_Password">
            <br>
            <br>
             <button type="submit">Login</button>

        </form>
    </main>
</body>
</html>
