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
            <!-- Form will be dynamically inserted here by JavaScript -->
        </form>
    </main>
    <script>
        // JSON data as a JavaScript object
        const formData = {
            "form": {
                "title": "Landee Deed Registry",
                "fields": [
                    {
                        "label": "First Name",
                        "type": "text",
                        "name": "Full_Name",
                        "placeholder": "Enter your first name",
                        "required": true
                    },
                    {
                        "label": "Last Name",
                        "type": "text",
                        "name": "Last_Name",
                        "placeholder": "Enter your last name",
                        "required": true
                    },
                    {
                        "label": "Email",
                        "type": "email",
                        "name": "Email",
                        "placeholder": "Enter your email",
                        "required": true
                    },
                    {
                        "label": "Is this your primary residence?",
                        "type": "radio",
                        "name": "primary_residence",
                        "options": [
                            {"label": "Yes", "value": "yes"},
                            {"label": "No", "value": "no"}
                        ],
                        "required": true
                    },
                    {
                        "label": "Primary Residence Details",
                        "type": "text",
                        "name": "primary_residence_details",
                        "placeholder": "Enter details about your primary residence",
                        "required": true
                    },
                    {
                        "label": "County",
                        "type": "select",
                        "name": "county",
                        "options": [
                            "Bomi", "Bong", "Gbarpolu", "Grand Bassa", "Grand Cape Mount",
                            "Grand Gedeh", "Grand Kru", "Lofa", "Margibi", "Maryland",
                            "Montserrado", "Nimba", "River Cess", "River Gee", "Sinoe"
                        ],
                        "required": true
                    },
                    {
                        "label": "Land Location (City)",
                        "type": "text",
                        "name": "city",
                        "placeholder": "Enter the city",
                        "required": true
                    },
                    {
                        "label": "Land Size (in acres)",
                        "type": "number",
                        "name": "Land_Size",
                        "step": "0.01",
                        "min": "0.01",
                        "placeholder": "Enter the land size",
                        "required": true
                    },
                    {
                        "label": "Land Type",
                        "type": "checkbox",
                        "name": "land_type",
                        "options": [
                            {"label": "Residential", "value": "residential"},
                            {"label": "Farm", "value": "farm"},
                            {"label": "Commercial", "value": "commercial"}
                        ],
                        "required": true
                    }
                ],
                "submit": {
                    "label": "Submit",
                    "action": "",
                    "method": "POST"
                }
            }
        };

        // Function to create form elements based on JSON data
        function createForm(formData) {
            const form = document.forms['deed_registration'];
            form.action = formData.form.submit.action;
            form.method = formData.form.submit.method;

            // Create form title
            const title = document.createElement('h1');
            title.textContent = formData.form.title;
            form.appendChild(title);

            // Create form fields
            formData.form.fields.forEach(field => {
                const fieldWrapper = document.createElement('div');

                const label = document.createElement('label');
                label.textContent = field.label;
                label.htmlFor = field.name;
                fieldWrapper.appendChild(label);

                let input;
                if (field.type === 'textarea') {
                    input = document.createElement('textarea');
                } else if (field.type === 'radio') {
                    input = document.createElement('div');
                    field.options.forEach(option => {
                        const optionWrapper = document.createElement('label');
                        optionWrapper.textContent = option.label;

                        const radioInput = document.createElement('input');
                        radioInput.type = 'radio';
                        radioInput.name = field.name;
                        radioInput.value = option.value;
                        radioInput.required = field.required;

                        optionWrapper.prepend(radioInput);
                        input.appendChild(optionWrapper);
                    });
                } else if (field.type === 'checkbox') {
                    input = document.createElement('div');
                    field.options.forEach(option => {
                        const optionWrapper = document.createElement('label');
                        optionWrapper.textContent = option.label;

                        const checkboxInput = document.createElement('input');
                        checkboxInput.type = 'checkbox';
                        checkboxInput.name = field.name + '[]';
                        checkboxInput.value = option.value;
                        checkboxInput.required = field.required;

                        optionWrapper.prepend(checkboxInput);
                        input.appendChild(optionWrapper);
                    });
                } else if (field.type === 'select') {
                    input = document.createElement('select');
                    input.name = field.name;
                    input.required = field.required;

                    field.options.forEach(option => {
                        const optionElement = document.createElement('option');
                        optionElement.value = option;
                        optionElement.textContent = option;
                        input.appendChild(optionElement);
                    });
                } else {
                    input = document.createElement('input');
                    input.type = field.type;
                    input.name = field.name;
                    input.placeholder = field.placeholder;
                    input.required = field.required;
                }

                fieldWrapper.appendChild(input);
                form.appendChild(fieldWrapper);
            });

            // Create submit button
            const submitButton = document.createElement('input');
            submitButton.type = 'submit';
            submitButton.value = formData.form.submit.label;
            form.appendChild(submitButton);
        }

        // Function to validate form on the client side
        function validateForm(event) {
            event.preventDefault(); // Prevent form from submitting

            const form = event.target;
            let valid = true;
            let errorMessage = '';

            // Check each required field
            formData.form.fields.forEach(field => {
                if (field.required) {
                    const fieldElements = form.elements[field.name];
                    if (!fieldElements || !fieldElements.value) {
                        valid = false;
                        errorMessage += `${field.label} is required.<br>`;
                    }
                }
            });

            if (!valid) {
                document.getElementById('error-message').innerHTML = errorMessage;
            } else {
                form.submit(); // Submit the form if validation is successful
            }
        }

        // Initialize form
        createForm(formData);
    </script>
</body>
</html>
