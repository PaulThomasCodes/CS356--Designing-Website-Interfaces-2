// Validation function for the form
function validateForm(){
    // Create shortcuts to the form fields
    var email = document.frmLogin.text_Email.value;
    var password = document.frmLogin.txt_Password.value;

    // Create a shortcut to the message div
    var div_message = document.getElementById("div_message");

    // Clear any previous error messages
    div_message.textContent = "";

    // Reference to labels
    var lbl_email = document.getElementById("lbl_email");
    var lbl_password = document.getElementById("lbl_password");

    // Remove any background color from labels
    lbl_email.style.backgroundColor = "";
    lbl_password.style.backgroundColor = "";

    // Validate email
    if (email == "") {
        div_message.textContent = "User email cannot be empty!";
        lbl_email.style.backgroundColor = "yellow";
        return false;
    }

    // Validate password
    if (password.length < 8) {
        div_message.textContent = "Password cannot be empty or is too short!";
        lbl_password.style.backgroundColor = "yellow";
        return false;
    }

    // Validation passed, submit the form
    return true;
}

// Function to handle the response from PHP
function handleResponse(response) {
    // Get the message div
    var div_message = document.getElementById("div_message");

    if (response.status == 'success') {
        div_message.style.color = 'green';
        div_message.textContent = response.message; // Success message
    } else {
        div_message.style.color = 'red';
        div_message.textContent = response.message; // Error message
    }
}
