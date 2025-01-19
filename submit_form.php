<?php
// submit_form.php

// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Twilio credentials
    $account_sid = 'ACbf5dac40040ebef83d17d5833b5ffe48';
    $auth_token = 'e46a2efe99b1bd45d7ba2de188ccb084';
    $twilio_phone_number = '+17756286859';
    
    // Check if the form fields are set, if not assign default values to avoid warnings
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $phone = isset($_POST['phone']) ? $_POST['phone'] : '';
    $subject = isset($_POST['subject']) ? $_POST['subject'] : '';  // Default empty if not set
    $preferred_contact = isset($_POST['preferred_contact']) ? $_POST['preferred_contact'] : '';  // Default empty if not set
    $message = isset($_POST['message']) ? $_POST['message'] : '';

    // The message body to send via SMS
    $sms_body = "New contact form submission:\nName: $name\nEmail: $email\nPhone: $phone\nSubject: $subject\nPreferred Contact: $preferred_contact\nMessage: $message";

    // Include Twilio SDK (adjust path if necessary)
    require_once 'c:\xampp\htdocs\twilio-php-main\twilio-php-main\src\Twilio\autoload.php'; // Adjust the path

    // Send SMS using Twilio API
    $client = new \Twilio\Rest\Client($account_sid, $auth_token);

    try {
        $client->messages->create(
            '+916284890317',  // Replace with your phone number to receive the SMS
            [
                'from' => $twilio_phone_number,  // Your Twilio number
                'body' => $sms_body
            ]
        );
    } catch (Exception $e) {
        // You can optionally log the error, but no need to display it on the page
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Form</title>
  <style>
    /* Reset some default styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Arial', sans-serif;
      background-color: #f0f4f7;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .contact-form-container {
      background-color: white;
      padding: 40px;
      border-radius: 12px;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 700px;
      margin: 20px;
      box-sizing: border-box;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      font-size: 16px;
      font-weight: bold;
      margin-top: 10px;
      display: block;
      color: #333;
    }

    input, textarea, select {
      width: 100%;
      padding: 12px;
      margin: 8px 0;
      border: 1px solid #ddd;
      border-radius: 8px;
      font-size: 16px;
      box-sizing: border-box;
    }

    input[type="text"], input[type="email"], input[type="tel"] {
      font-size: 16px;
    }

    textarea {
      font-size: 16px;
      height: 150px;
    }

    select {
      font-size: 16px;
      padding: 10px;
    }

    .form-row {
      display: flex;
      justify-content: space-between;
      gap: 20px;
    }

    .form-row > div {
      flex: 1;
    }

    button {
      background-color: #4CAF50;
      color: white;
      padding: 15px 20px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    button:hover {
      background-color: #45a049;
    }

    .note {
      font-size: 14px;
      text-align: center;
      color: #888;
      margin-top: 20px;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
      .form-row {
        flex-direction: column;
      }

      .form-row > div {
        flex: none;
        width: 100%;
      }
    }
  </style>
</head>
<body>

  <div class="contact-form-container">
    <h2>Contact Us</h2>
    <form action="submit_form.php" method="POST">
      
      <!-- First and Last Name -->
      <div class="form-row">
        <div>
          <label for="name">Full Name:</label>
          <input type="text" id="name" name="name" required>
        </div>
        <div>
          <label for="email">Email:</label>
          <input type="email" id="email" name="email" required>
        </div>
      </div>
      
      <!-- Phone and Subject -->
      <div class="form-row">
        <div>
          <label for="phone">Phone Number:</label>
          <input type="tel" id="phone" name="phone" required>
        </div>
        <div>
          <label for="subject">Subject:</label>
          <input type="text" id="subject" name="subject">
        </div>
      </div>

      <!-- Preferred Contact Method -->
      <div>
        <label for="preferred_contact">Preferred Contact Method:</label>
        <select id="preferred_contact" name="preferred_contact">
          <option value="Phone">Phone</option>
          <option value="Email">Email</option>
        </select>
      </div>

      <!-- Message -->
      <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required></textarea>
      </div>

      <button type="submit">Submit</button>
    </form>
  </div>

</body>
</html>
