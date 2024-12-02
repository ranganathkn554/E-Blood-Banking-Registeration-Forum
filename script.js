document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form from submitting by default

    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const age = document.getElementById('age').value.trim();

    // Validate Full Name
    if (!validateName(fullName)) {
        alert("Please enter a valid full name. Only letters and spaces are allowed.");
        return;
    }

    // Validate Email
    if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
        return;
    }

    // Validate Phone Number
    if (!validatePhone(phone)) {
        alert("Phone number must be exactly 10 digits.");
        return;
    }

    // Validate Age (between 18 and 60)
    if (age < 18 || age > 60) {
        alert("Age must be between 18 and 60.");
        return;
    }

    // If all validations pass
    alert("Registration Successful!");
    this.reset(); // Reset the form fields
});

// Validation Functions
function validateName(name) {
    return /^[a-zA-Z\s]+$/.test(name); // Allows only letters and spaces
}

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // Basic email validation
}

function validatePhone(phone) {
    return /^[0-9]{10}$/.test(phone); // Ensures phone is exactly 10 digits
}
