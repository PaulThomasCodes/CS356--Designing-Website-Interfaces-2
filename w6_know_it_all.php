<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 6 Know It All</title>
</head>
<body>
    <!-- Menu, Logo, page title usually go inn the header section-->
    <header>
        <!-- Page Title, 1 and only 1 h1 tag on a page -->
        <h1>Know It All page</h1>
    </header>

    <main>
        <form action="w6_know_it_all.php" method="post"> 
            <label for="txt_question">Ask the Know it all a yes or no answer</label>
            <input type="text" id="txt_question" name="txt_question" placeholder="Type your question here..." required>
            <br>
            <input type="submit" value="Get the Answer">
        </form>
    </main>

    <?php
        // check to see if the form was posted
        if ($_SERVER["REQUEST_METHOD"] == "POST"){
            // ARRAY OF ANSWERS
            $ANSWERS = [
                "yES, definitely",
                "Ask again later",
                "better not tell you",
                "Don't count on it",

            ];
            // randomly select 1 of the elements from the array to be the answer
            $randomAnswer = $answers[array_rand(array: $answers)];

            // Display the selected answer
            echo '<div>';
            echo 'The Know it All says: ' . $randomAnswer;
            echo '</div>';
        }

        ECHO
    ?>
</body>
</html>