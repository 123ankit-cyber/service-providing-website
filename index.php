<?php
// Database connection
$servername = "localhost";  // Database server
$username = "root";         // Database username
$password = "";             // Database password (default is empty for XAMPP/WAMP)
$dbname = "service_registration";  // Database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get data from the form and sanitize
    $full_name = htmlspecialchars($_POST['full_name']);
    $email = htmlspecialchars($_POST['email']);
    $contact_number = htmlspecialchars($_POST['contact_number']);
    $service_type = htmlspecialchars($_POST['service_type']);
    $location = htmlspecialchars($_POST['location']);
    $service_description = htmlspecialchars($_POST['service_description']);
    $preferred_contact = htmlspecialchars($_POST['preferred_contact']);
    $preferred_time = $_POST['preferred_time'];  // Assume the format is correct for datetime-local input

    // Prepare and bind to insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (full_name, email, contact_number, service_type, location, service_description, preferred_contact, preferred_time) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $full_name, $email, $contact_number, $service_type, $location, $service_description, $preferred_contact, $preferred_time);

    // Execute the query
    if ($stmt->execute()) {
        
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Registration Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.15)),
                url("form.jpg");  /* Background image set here */
            background-repeat: no-repeat;
            background-size: cover;
        }

        .navbar {
            background-color: #333;
            color: #00b894;
            overflow: hidden;
            position: sticky;
            top: 0;
            width: 100%;
            padding: 10px 0;
        }

        .navbar a {
            color: #00b894;
            padding: 14px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .form-container {
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 600px;
        }

        .form-container h2 {
            text-align: center;
            color: #333;
        }

        .form-container input, .form-container select, .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        .form-container input[type="submit"] {
            background-color: #4CAF50;
            color: #00b894;
            border: none;
            padding: 12px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .form-container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .ram {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <a href="Mind Spring.html" target="_blank">Home</a>
        <a href="service.html" target="_blank">Services</a>
        <a href="about.html" target="_blank">About</a>
        <a href="index.php" target="_blank">Contact</a>
    </div>
    <div class="form-container">
        <h2>Services Details</h2>
    </div>
    <div class="ram">
        <form action="index.php" method="POST">
            <label for="full_name">Full Name:</label><br>
            <input type="text" id="full_name" name="full_name" required><br><br>

            <label for="email">Email:</label><br>
            <input type="email" id="email" name="email" required><br><br>

            <label for="contact_number">Contact Number:</label><br>
            <input type="text" id="contact_number" name="contact_number" required><br><br>

            <label for="service_type">Service Type:</label><br>
            <select id="service_type" name="service_type" required>
                <option value="plumber">Plumber</option>
                <option value="construction">Construction</option>
                <option value="electrician">Electrician</option>
                <option value="carpenter">Carpenter</option>
                <option value="cleaning">Cleaning</option>
                <option value="Landscaping">Landscaping</option>
                <option value="Health services">Health services</option>
                <option value="Pest Control Services">Pest Control Services</option>
                <option value="Home Renovation and Remodeling Services">Home Renovation and Remodeling Services</option>
                <option value="Carpet and Upholstery Cleaning Services">Carpet and Upholstery Cleaning Services</option>
                <option value="Roofing Services">Roofing Services</option>
                <option value="Home Security System Installation">Home Security System Installation</option>
                <option value="Drywall and Painting Services">Drywall and Painting Services</option>
                <option value="Window and Door Repair">Window and Door Repair</option>
                <option value="Appliance Repair Services">Appliance Repair Services</option>
                <option value="Concrete and Masonry Services">Concrete and Masonry Services</option>
                <option value="Gutter Cleaning and Maintenance">Gutter Cleaning and Maintenance</option>
                <option value="Furniture Assembly Services">Furniture Assembly Services</option>
                <option value="Snow Removal Services">Snow Removal Services</option>
                <option value="Swimming Pool Maintenance and Cleaning">Swimming Pool Maintenance and Cleaning</option>
                <option value="Gardening">Gardening</option>
            </select><br><br>

            <label for="location">Location:</label><br>
            <input type="text" id="location" name="location" required><br><br>

            <label for="service_description">Service Description:</label><br>
            <textarea id="service_description" name="service_description" rows="4" required></textarea><br><br>

            <label for="preferred_contact">Preferred Contact Method:</label><br>
            <input type="radio" id="phone" name="preferred_contact" value="Phone" required>
            <label for="phone">Phone</label>
            <input type="radio" id="email_contact" name="preferred_contact" value="Email" required>
            <label for="email_contact">Email</label><br><br>

            <label for="preferred_time">Preferred Time for Service:</label><br>
            <input type="datetime-local" id="preferred_time" name="preferred_time" required><br><br>

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>
