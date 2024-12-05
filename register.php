<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - E-Blood Banking System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #d534f; /* Red background */
            margin: 0;
            padding: 0;
        }
        .form-container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        fieldset {
            border: none;
            margin-bottom: 20px;
        }
        legend {
            font-size: 1.2em;
            color: #444;
            margin-bottom: 10px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .radio-group {
            display: flex;
            gap: 20px;
            align-items: center;
        }
        .btn {
            width: 100%;
            padding: 10px;
            background-color: #5cb85c;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
        .btn:hover {
            background-color: #09e01b;
        }
        .error {
            color: red;
        }
        .success-message {
            display: none;
            text-align: center;
        }
        .success-message button {
            background-color: #5cb85c;
            border-radius: 5px;
            padding: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <?php
    // Database connection
    $host = "localhost";
    $username = "root"; // Replace with your database username
    $password = ""; // Replace with your database password
    $dbname = "ebloodforum";

    // Create connection
    $conn = new mysqli($host, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $bloodGroup = $conn->real_escape_string($_POST['bloodGroup']);
        $age = (int)$_POST['age'];
        $donationEligibility = $conn->real_escape_string($_POST['donationEligibility']);

        // Insert data into the database
        $sql = "INSERT INTO registrations (full_name, email, phone, blood_group, age, donation_eligibility)
                VALUES ('$fullName', '$email', '$phone', '$bloodGroup', $age, '$donationEligibility')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>window.onload = function() { 
                    $('#registrationForm').hide(); 
                    $('#successMessage').show();
                    $('#userDetails').html('<p><strong>Full Name:</strong> $fullName</p><p><strong>Email:</strong> $email</p><p><strong>Phone:</strong> $phone</p><p><strong>Blood Group:</strong> $bloodGroup</p><p><strong>Age:</strong> $age</p><p><strong>Donation Eligibility:</strong> $donationEligibility</p>');
                }</script>";
        } else {
            echo "<script>alert('Error: " . $conn->error . "');</script>";
        }
    }

    $conn->close();
    ?>

    <!-- Registration Form -->
    <div class="form-container" id="registrationForm">
        <h1>E-Blood Banking System Registration</h1>
        <form method="POST" onsubmit="return validateForm()">
            <!-- Personal Details -->
            <fieldset>
                <legend>Personal Details</legend>
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
        
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </fieldset>
        
            <!-- Medical Details -->
            <fieldset>
                <legend>Medical Details</legend>
                <label for="bloodGroup">Blood Group</label>
                <select id="bloodGroup" name="bloodGroup" required>
                    <option value="">Select</option>
                    <option value="A+">A+</option>
                    <option value="A-">A-</option>
                    <option value="B+">B+</option>
                    <option value="B-">B-</option>
                    <option value="O+">O+</option>
                    <option value="O-">O-</option>
                    <option value="AB+">AB+</option>
                    <option value="AB-">AB-</option>
                </select>
        
                <label for="age">Age</label>
                <input type="number" id="age" name="age" placeholder="Enter your age" required>
        
                <label>Will You Agree to donate your blood?</label>
                <div class="radio-group">
                    <input type="radio" id="eligibleYes" name="donationEligibility" value="Yes" required>
                    <label for="eligibleYes">Yes</label>
                    <input type="radio" id="eligibleNo" name="donationEligibility" value="No">
                    <label for="eligibleNo">No</label>
                </div>
            </fieldset>
        
            <button type="submit" class="btn">Submit</button>
        </form>
    </div>

    <!-- Success Message -->
    <div class="success-message" id="successMessage">
        <h1>Registration Successful!</h1>
        <div id="userDetails"></div>
        <button onclick="window.location.href='register.php'">Go to Registration Page</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Form Validation for Age and Phone Number
        function validateForm() {
            var age = document.getElementById("age").value;
            var phone = document.getElementById("phone").value;
            var phonePattern = /^[0-9]{10}$/;

            // Validate age
            if (age < 18 && <60) {
                alert("You must be 18 years or older to register.");
                return false;
            }

            // Validate phone number (10 digits)
            if (!phonePattern.test(phone)) {
                alert("Phone number must be 10 digits.");
                return false;
            }

            return true;
        }
    </script>
</body>
</html>
<!-- http://localhost:8080/register.php -->
<!-- http://localhost:8080/phpmyadmin/index.php?route=/sql&pos=0&db=ebloodforum&table=registrations --> 
