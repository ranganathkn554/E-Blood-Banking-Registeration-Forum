document.getElementById('registrationForm').addEventListener('submit', function (e) {
    e.preventDefault(); // Prevent form submission

    // Retrieve form data
    const fullName = document.getElementById('fullName').value.trim();
    const email = document.getElementById('email').value.trim();
    const phone = document.getElementById('phone').value.trim();
    const bloodGroup = document.getElementById('bloodGroup').value.trim();
    const age = parseInt(document.getElementById('age').value.trim());
    const donationEligibility = document.querySelector('input[name="donationEligibility"]:checked');

    // Validation conditions
    let errorMessage = "";

    if (!validateName(fullName)) {
        errorMessage += "Please enter a valid full name. Only letters and spaces are allowed.\n";
    }

    if (!validateEmail(email)) {
        errorMessage += "Please enter a valid email address.\n";
    }

    const phoneRegex = /^[6-9]\d{9}$/;
    if (!phoneRegex.test(phone)) {
        errorMessage += "Phone number must be a valid 10-digit number starting with 6-9.\n";
    }

    if (bloodGroup === "") {
        errorMessage += "Please select a valid blood group.\n";
    }

    if (isNaN(age) || age < 18 || age > 65) {
        errorMessage += "Age must be a number between 18 and 65.\n";
    }

    if (!donationEligibility) {
        errorMessage += "Please select your blood donation eligibility.\n";
    }

    // If validation fails, alert the errors
    if (errorMessage) {
        alert(errorMessage);
        return;
    }

    // If validation passes, display acknowledgment copy
    const userDetailsDiv = document.getElementById('userDetails');
    userDetailsDiv.innerHTML = `
        <p><strong>Full Name:</strong> ${fullName}</p>
        <p><strong>Email:</strong> ${email}</p>
        <p><strong>Phone:</strong> ${phone}</p>
        <p><strong>Blood Group:</strong> ${bloodGroup}</p>
        <p><strong>Age:</strong> ${age}</p>
        <p><strong>Donation Eligibility:</strong> ${donationEligibility.value}</p>
    `;

    // Hide the form and show acknowledgment
    document.querySelector('.form-container form').style.display = 'none';
    document.getElementById('acknowledgment').style.display = 'block';

    // Handle PDF download
    document.getElementById('downloadPdf').addEventListener('click', function () {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF();

        doc.text("Acknowledgment Copy", 10, 10);
        doc.text(`Full Name: ${fullName}`, 10, 20);
        doc.text(`Email: ${email}`, 10, 30);
        doc.text(`Phone: ${phone}`, 10, 40);
        doc.text(`Blood Group: ${bloodGroup}`, 10, 50);
        doc.text(`Age: ${age}`, 10, 60);
        doc.text(`Donation Eligibility: ${donationEligibility.value}`, 10, 70);

        doc.save('Acknowledgment_Copy.pdf');
    });
});

// Validation Functions
function validateName(name) {
    return /^[a-zA-Z\s]+$/.test(name); // Allows only letters and spaces
}

function validateEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email); // Basic email validation
}
