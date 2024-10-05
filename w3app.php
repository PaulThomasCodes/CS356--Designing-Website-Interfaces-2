<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landee Deed Registry</title>
    <link rel="stylesheet" href="w3appcss.css">
    <!-- Include Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <!-- JavaScript for Validation and Interaction -->
    <script>
        function validateForm(event) {
            event.preventDefault();

            // Form Field Variables
            const form = document.forms['deed_registration'];
            const fullName = form['Full_Name'];
            const lastName = form['Last_Name'];
            const email = form['Email'];
            const city = form['city'];
            const county = form['county'];
            const landSize = form['Land_Size'];
            const residenceRadios = form['primary_residence'];
            const primaryResidenceDetails = form['primary_residence_details'];
            const landTypeCheckboxes = form.querySelectorAll('input[name="land_type"]:checked');

            let errorMessages = [];
            let isValid = true;

            // Clear previous error styles
            document.querySelectorAll('.error').forEach(el => el.classList.remove('error'));
            document.getElementById('error-message').style.display = 'none';

            // Validation Logic
            if (fullName.value.trim() === '') {
                errorMessages.push('First Name is required.');
                fullName.classList.add('error');
                isValid = false;
            }

            if (lastName.value.trim() === '') {
                errorMessages.push('Last Name is required.');
                lastName.classList.add('error');
                isValid = false;
            }

            if (email.value.trim() === '' || !email.value.includes('@')) {
                errorMessages.push('A valid Email Address is required.');
                email.classList.add('error');
                isValid = false;
            }

            if (![...residenceRadios].some(radio => radio.checked)) {
                errorMessages.push('Please select your primary residence option.');
                document.getElementById('residence-options').classList.add('error');
                isValid = false;
            } else if (form['primary_residence'].value === 'no' && primaryResidenceDetails.value.trim() === '') {
                errorMessages.push('Please provide your primary place of residence.');
                primaryResidenceDetails.classList.add('error');
                isValid = false;
            }

            if (county.value === '') {
                errorMessages.push('Please select a county.');
                county.classList.add('error');
                isValid = false;
            }

            if (city.value.trim() === '') {
                errorMessages.push('City is required.');
                city.classList.add('error');
                isValid = false;
            }

            if (landSize.value.trim() === '' || isNaN(landSize.value) || parseFloat(landSize.value) <= 0) {
                errorMessages.push('Please enter a valid land size.');
                landSize.classList.add('error');
                isValid = false;
            }

            if (landTypeCheckboxes.length === 0) {
                errorMessages.push('Please select at least one land type.');
                document.getElementById('land-type-options').classList.add('error');
                isValid = false;
            }

            if (!isValid) {
                const errorMessageContainer = document.getElementById('error-message');
                errorMessageContainer.innerHTML = '<ul><li>' + errorMessages.join('</li><li>') + '</li></ul>';
                errorMessageContainer.style.display = 'block';
            } else {
                form.submit();
            }
        }

        function toggleResidenceDetails() {
            const noResidence = document.getElementById('primary_residence_no').checked;
            const detailsSection = document.getElementById('primary_residence_details_section');
            detailsSection.style.display = noResidence ? 'block' : 'none';
        }
    </script>
</head>
<body>
    <header>
        <h1>Landee Deed Registry</h1>
    </header>

    <main>
        <form name="deed_registration" onsubmit="validateForm(event)">
            <!-- Error Message Container -->
            <div id="error-message"></div>

            <!-- Personal Information Section -->
            <fieldset>
                <legend>Personal Information</legend>

                <label for="full_name">First Name</label>
                <input type="text" id="full_name" name="Full_Name" placeholder="Enter your first name">

                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="Last_Name" placeholder="Enter your last name">

                <label for="email">Email Address</label>
                <input type="text" id="email" name="Email" placeholder="Enter your email address">

                <label>Do you live in Liberia for 6 or more consecutive months at a time?</label>
                <div class="option-group" id="residence-options">
                    <label>
                        <input type="radio" name="primary_residence" value="yes" onclick="toggleResidenceDetails()">
                        Yes
                    </label>
                    <label>
                        <input type="radio" id="primary_residence_no" name="primary_residence" value="no" onclick="toggleResidenceDetails()">
                        No
                    </label>
                </div>

                <div id="primary_residence_details_section" style="display: none;">
                    <label for="primary_residence_details">Primary Place of Residence</label>
                    <input type="text" id="primary_residence_details" name="primary_residence_details" placeholder="Country and State/Province">
                </div>
            </fieldset>

            <!-- Land Information Section -->
            <fieldset>
                <legend>Land Information</legend>

                <label for="county">Land Location (County)</label>
                <select id="county" name="county">
                    <option value="">Select a county</option>
                    <option value="Bomi">Bomi</option>
                    <option value="Bong">Bong</option>
                    <option value="Gbarpolu">Gbarpolu</option>
                    <option value="Grand Bassa">Grand Bassa</option>
                    <option value="Grand Cape Mount">Grand Cape Mount</option>
                    <option value="Grand Gedeh">Grand Gedeh</option>
                    <option value="Grand Kru">Grand Kru</option>
                    <option value="Lofa">Lofa</option>
                    <option value="Margibi">Margibi</option>
                    <option value="Maryland">Maryland</option>
                    <option value="Montserrado">Montserrado</option>
                    <option value="Nimba">Nimba</option>
                    <option value="River Cess">River Cess</option>
                    <option value="River Gee">River Gee</option>
                    <option value="Sinoe">Sinoe</option>
                </select>

                <label for="city">Land Location (City)</label>
                <input type="text" id="city" name="city" placeholder="Enter the city">

                <label for="land_size">Land Size (in acres)</label>
                <input type="number" id="land_size" name="Land_Size" step="0.01" min="0.01" placeholder="Enter land size">

                <label>Land Type</label>
                <div class="option-group" id="land-type-options">
                    <label>
                        <input type="checkbox" name="land_type" value="residential">
                        Residential
                    </label>
                    <label>
                        <input type="checkbox" name="land_type" value="farm">
                        Farm
                    </label>
                    <label>
                        <input type="checkbox" name="land_type" value="commercial">
                        Commercial
                    </label>
                </div>
            </fieldset>

            <input type="submit" value="Submit">
        </form>
    </main>
</body>
</html>
