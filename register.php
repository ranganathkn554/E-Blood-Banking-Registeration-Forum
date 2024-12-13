<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form - E-Blood Banking System</title>
    <style>
        <style>
    body {
        font-family: Arial, sans-serif;
        background: linear-gradient(135deg, rgb(163, 143, 143), #f06); 
        margin: 0;
        padding: 0;
        color: #333;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .form-container {
        max-width: 600px;
        margin: 50px auto;
        background: aquamarine;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    h1 {
        text-align: center;
        color: #f06;
        font-size: 2rem;
    }

    fieldset {
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 20px;
        padding: 15px;
    }

    legend {
        font-size: 1.4rem;
        color: #505ca1;
        padding: 0 10px;
    }

    label {
        display: block;
        margin-bottom: 5px;
        color: #555;
        font-weight: bold;
    }

    input, select {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #505ca1;
        border-radius: 5px;
        font-size: 1rem;
    }

    input:focus, select:focus {
        outline: none;
        border-color: #f06;
        box-shadow: 0 0 8px rgba(240, 6, 0, 0.6);
    }

    .radio-group {
        display: flex;
        gap: 20px;
        align-items: center;
        margin-bottom: 15px;
    }

    .radio-group input[type="radio"] {
        margin-right: 8px;
    }

    .btn {
        width: 100%;
        padding: 10px;
        background: linear-gradient(135deg, #f06, #ff7f50);
        border: none;
        color: #fff;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1.2rem;
        transition: all 0.3s ease;
    }

    .btn:hover {
        background: linear-gradient(135deg, #09e01b, #5cb85c);
        transform: scale(1.05);
    }

    .error {
        color: red;
        font-size: 0.9rem;
    }

    .success-message {
        display: none;
        text-align: center;
        padding: 20px;
        background: linear-gradient(135deg, #dff0d8, #c8e5bc);
        border-radius: 8px;
        color: #3c763d;
    }

    .success-message button {
        background-color: #5cb85c;
        border: none;
        color: white;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .success-message button:hover {
        background-color: #4cae4c;
    }

    @media (max-width: 600px) {
        body {
            padding: 15px;
        }

        .form-container {
            padding: 15px;
        }

        h1 {
            font-size: 1.8rem;
        }

        .btn {
            font-size: 1rem;
        }
    }
</style>

    </style>
</head>
<body>
    <?php
  
    $host = "localhost";
    $username = "root"; 
    $password = ""; 
    $dbname = "ebloodforum";

    
    $conn = new mysqli($host, $username, $password, $dbname);

    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullName = $conn->real_escape_string($_POST['fullName']);
        $email = $conn->real_escape_string($_POST['email']);
        $phone = $conn->real_escape_string($_POST['phone']);
        $bloodGroup = $conn->real_escape_string($_POST['bloodGroup']);
        $age = (int)$_POST['age'];
        $donationEligibility = $conn->real_escape_string($_POST['donationEligibility']);

      
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

   
    <div class="form-container" id="registrationForm">
        <h1>E-Blood Banking System Registration</h1>
        <form method="POST" onsubmit="return validateForm()">
            
            <fieldset>
                <legend>Personal Details</legend>
                <label for="fullName">Full Name</label>
                <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
        
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
        
                <label for="phone">Phone Number</label>
                <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
            </fieldset>
        
        
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

    
    <div class="success-message" id="successMessage">
        <h1>Registration Successful!</h1>
        <div id="userDetails"></div>
        <button onclick="window.location.href='register.php'">Go to Registration Page</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       
        function validateForm() {
            var age = document.getElementById("age").value;
            var phone = document.getElementById("phone").value;
            var phonePattern = /^[0-9]{10}$/;

           
            if (age < 18) {
                alert("You must be 18 years or older to register.");
                return false;
            }

           
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
<!-- http://localhost:8080/register.php 

CREATE DATABASE IF NOT EXISTS ebloodforum;

USE ebloodforum;

CREATE TABLE IF NOT EXISTS registrations (
    id INT AUTO_INCREMENT PRIMARY KEY, -- Unique identifier for each registration
    full_name VARCHAR(100) NOT NULL,   -- Full name of the registrant
    email VARCHAR(100) NOT NULL UNIQUE, -- Email address (unique to prevent duplicate registrations)
    phone VARCHAR(15) NOT NULL,        -- Phone number
    blood_group ENUM('A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-') NOT NULL, -- Blood group options
    age INT NOT NULL CHECK (age >= 18), -- Age (with a minimum requirement of 18 years)
    donation_eligibility ENUM('Yes', 'No') NOT NULL, -- Donation eligibility status
    registration_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP -- Timestamp of registration
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
-->
<!-- http://localhost:8080/phpmyadmin/index.php?route=/sql&pos=0&db=ebloodforum&table=registrations --> 
