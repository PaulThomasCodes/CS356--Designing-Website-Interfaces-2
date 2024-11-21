// Create a validation function for the form
function validateForm() {
    // Create a shortcut to the value in the Email
    var email = document.frmLogin.text_Email.value; // Correctly reference text_Email
    
    // Create a shortcut to the value in the password
    var password = document.frmLogin.txt_Password.value; // Correctly reference txt_Password
    
    // Create a shortcut to the message div
    var div_message = document.getElementById("div_message");
    
    // Clear any previous error messages
    div_message.textContent = "";

    // Access the labels for email and password
    var lbl_email = document.getElementById("lbl_email");
    var lbl_password = document.getElementById("lbl_password");

    

    // Remove any background color styles from the labels
    lbl_email.style.backgroundColor = "";
    lbl_password.style.backgroundColor = "";

    // If no email is entered
    if (email == "") {
        div_message.textContent = "User email cannot be empty!";
        lbl_email.style.backgroundColor = "yellow";
        return false;
    }

    // If email is invalid (basic check)
    var emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
    if (!emailPattern.test(email)) {
        div_message.textContent = "Please enter a valid email address!";
        lbl_email.style.backgroundColor = "yellow";
        return false;
    }

    // If password is too short or empty
    if (password == "" || password.length < 8) {
        div_message.textContent = "Password cannot be empty or is too short (minimum 8 characters)!";
        lbl_password.style.backgroundColor = "yellow";
        return false;
    }

    // Validation passed, so submit the form
    return true;
}
