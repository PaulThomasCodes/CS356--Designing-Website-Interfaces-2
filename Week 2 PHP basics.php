<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Week 2 PHP Basics</title>
</head>
<body>
    <header>
        <h1>Welcome to my week 2 PHP basics page</h1>
    </header>

    <main>
        <h2>Variables</h2>

        <ul>
            <li>Containers for holding data </li>
            <li>No command for declaring variables</li>
            <li>PHP is loosely typed</li>
            <li>Variables should start with $ (then add the descriptive variable name)</li>
            <li>Only use alpha-numeric or _ underscores in variable names</li>
            <li>No spaces in variable names</li>
            <li>Case sensitive - $firstname and $firstName are different variables</li>
        </ul>

        <h3>PHP Data Types</h3>
         <ul>
            <li> sTRING, EX: "Paul"</li>
            <li>Integer</li>
             <li>Float</li>
            <li>Boolean, ex: True (or False)</li>
            <li>Array, Ex: bacon, eggs, turjey</li>
            <li>Object, Ex: Noun with things that describe it</li>
        </ul>
            
        <?php
            // camelCase variable naming
            $firstName = "Paul";
            // sname_case variable naming
            $first_name = "Paul";
            // avoid using all UPPERCASE variable nakes unless the value won't change - in other words- CONSTANT
        ?>

        <h3>Variable Scope</h3>
        <ul>
            <li>Local</li>
            <li>Global</li>
            <li>Static</li>
            <li>Function Parameters</li>
        </ul>
    </main>
</body>
</html>