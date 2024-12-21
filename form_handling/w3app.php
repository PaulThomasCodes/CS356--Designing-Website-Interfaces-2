<?php
// Function to validate form data
function validate($data) {
    $errors = [];

    // Check if required fields are filled
    if (empty($data['Full_Name'])) $errors[] = 'First Name is required.';
    if (empty($data['Last_Name'])) $errors[] = 'Last Name is required.';
    if (empty($data['Email']) || !filter_var($data['Email'], FILTER_VALIDATE_EMAIL)) $errors[] = 'A valid Email is required.';
    if (empty($data['city'])) $errors[] = 'City is required.';
    if (empty($data['county'])) $errors[] = 'County is required.';
    if (empty($data['Land_Size']) || floatval($data['Land_Size']) <= 0) $errors[] = 'A valid Land Size is required.';
    if (!isset($data['primary_residence'])) $errors[] = 'Please select if this is your primary residence.';
    if (empty($data['primary_residence_details'])) $errors[] = 'Primary Residence Details are required.';
    if (empty($data['land_type'])) $errors[] = 'At least one Land Type is required.';

    return $errors;
}

$errors = [];
$successMessage = '';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = validate($_POST);

    // If no errors, show success message
    if (empty($errors)) {
        $successMessage = 'Form submitted successfully!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landee Deed Registry</title>
    <link rel="stylesheet" href="w3appcss.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        .error {
            border: 1px solid red;
        }
        #error-message {
            color: red;
            font-weight: bold;
            background-color: #f8d7da;
            padding: 10px;
            border: 1px solid red;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        #success-message {
            color: green;
            font-weight: bold;
            background-color: #d4edda;
            padding: 10px;
            border: 1px solid green;
            border-radius: 5px;
            margin-bottom: 20px;
        }
    </style>
    <script>
        // Function to validate form on the client side
        function validateForm(event) {
            event.preventDefault(); // Prevent form from submitting

            const form = document.forms['deed_registration'];
            const requiredFields = ['Full_Name', 'Last_Name', 'Email', 'city', 'county', 'Land_Size', 'primary_residence', 'primary_residence_details'];
            let errorMessages = [];
            let isValid = true;

            // Clear previous errors
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
            document.getElementById('error-message').style.display = 'none';

            // Validate required fields
            requiredFields.forEach(field => {
                const element = form[field];
                if (!element.value.trim()) {
                    errorMessages.push(${element.previousElementSibling.textContent} is required.);
                    element.classList.add('error');
                    isValid = false;
                }
            });

            // Validate email format with regex
            const email = form['Email'].value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(email)) {
                errorMessages.push('A valid Email is required.');
                form['Email'].classList.add('error');
                isValid = false;
            }

            // Validate land size
            if (parseFloat(form['Land_Size'].value) <= 0) {
                errorMessages.push('A valid Land Size is required.');
                form['Land_Size'].classList.add('error');
                isValid = false;
            }

            // Validate primary residence selection
            if (!form.querySelector('input[name="primary_residence"]:checked')) {
                errorMessages.push('Please select if this is your primary residence.');
                form['primary_residence'][0].parentElement.classList.add('error');
                isValid = false;
            }

            // Validate at least one land type is selected
            if (!form.querySelector('input[name="land_type"]:checked')) {
                errorMessages.push('At least one Land Type is required.');
                document.getElementById('land-type-options').classList.add('error');
                isValid = false;
            }

            // Show errors if any, else submit form
            if (!isValid) {
                document.getElementById('error-message').innerHTML = errorMessages.join('<br>');
                document.getElementById('error-message').style.display = 'block';
            } else {
                form.submit();
            }
        }
    </script>
</head>
<body>
    <header>
        <h1>Landee Deed Registry</h1>
    </header>
    <main>
        <?php if (!empty($errors)): ?>
            <div id="error-message"><?php echo implode('<br>', $errors); ?></div>
        <?php elseif ($successMessage): ?>
            <div id="success-message"><?php echo $successMessage; ?></div>
        <?php endif; ?>
        <form name="deed_registration" method="POST" action="" onsubmit="validateForm(event)">
            <fieldset>
                <legend>Personal Information</legend>
                <label for="Full_Name">First Name</label>
                <input type="text" id="Full_Name" name="Full_Name" value="<?php echo htmlspecialchars($_POST['Full_Name'] ?? ''); ?>">
                
                <label for="Last_Name">Last Name</label>
                <input type="text" id="Last_Name" name="Last_Name" value="<?php echo htmlspecialchars($_POST['Last_Name'] ?? ''); ?>">
                
                <label for="Email">Email</label>
                <input type="email" id="Email" name="Email" value="<?php echo htmlspecialchars($_POST['Email'] ?? ''); ?>">
            </fieldset>
            
            <fieldset>
                <legend>Land Information</legend>
                <label for="primary_residence">Is this your primary residence?</label>
                <input type="radio" id="primary_residence_yes" name="primary_residence" value="yes" <?php echo (isset($_POST['primary_residence']) && $_POST['primary_residence'] == 'yes') ? 'checked' : ''; ?>> Yes
                <input type="radio" id="primary_residence_no" name="primary_residence" value="no" <?php echo (isset($_POST['primary_residence']) && $_POST['primary_residence'] == 'no') ? 'checked' : ''; ?>> No
                
                <label for="primary_residence_details">Primary Residence Details</label>
                <input type="text" id="primary_residence_details" name="primary_residence_details" value="<?php echo htmlspecialchars($_POST['primary_residence_details'] ?? ''); ?>">
                
                <label for="county">County</label>
                <select id="county" name="county">
                    <option value="">Select County</option>
                    <?php
                    // List of counties
                    $counties = ["Bomi", "Bong", "Gbarpolu", "Grand Bassa", "Grand Cape Mount", "Grand Gedeh", "Grand Kru", "Lofa", "Margibi", "Maryland", "Montserrado", "Nimba", "River Cess", "River Gee", "Sinoe"];
                    foreach ($counties as $county) {
                        $selected = (isset($_POST['county']) && $_POST['county'] == $county) ? 'selected' : '';
                        echo "<option value=\"$county\" $selected>$county</option>";
                    }
                    ?>
                </select>

                <label for="city">Land Location (City)</label>
                <input type="text" id="city" name="city" value="<?php echo htmlspecialchars($_POST['city'] ?? ''); ?>">

                <label for="land_size">Land Size (in acres)</label>
                <input type="number" id="land_size" name="Land_Size" step="0.01" min="0.01" value="<?php echo htmlspecialchars($_POST['Land_Size'] ?? ''); ?>">

                <label>Land Type</label>
                <div class="option-group" id="land-type-options">
                    <?php
                    // Land type options
                    $landTypes = ["residential" => "Residential", "farm" => "Farm", "commercial" => "Commercial"];
                    foreach ($landTypes as $value => $label) {
                        $checked = (isset($_POST['land_type']) && in_array($value, $_POST['land_type'])) ? 'checked' : '';
                        echo "<label><input type=\"checkbox\" name=\"land_type[]\" value=\"$value\" $checked> $label</label>";
                    }
                    ?>
                </div>
            </fieldset>

            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>
