<?php

// Include the config.php file
include "config.php";
// Check if the form is submitted
if (isset($_POST['submit'])) {
  // Get the form data
  $name = $_POST['name'];
  $dob = $_POST['dob'];
  $id = $_POST['id'];
  $address = $_POST['address'];
  $county = $_POST['county'];
  $sub_county = $_POST['sub_county'];
  $gender = $_POST['gender'];
  $marital_status = $_POST['marital_status'];
  $kin_name = $_POST['kin_name'];
  $kin_dob = $_POST['kin_dob'];
  $kin_id = $_POST['kin_id'];
  $kin_gender = $_POST['kin_gender'];
  $kin_relationship = $_POST['kin_relationship'];

  // Validate the form data
  // You can add more validation rules as needed
  if (empty($name) || empty($dob) || empty($id) || empty($address) || empty($county) || empty($sub_county) || empty($gender) || empty($marital_status) || empty($kin_name) || empty($kin_dob) || empty($kin_id) || empty($kin_gender) || empty($kin_relationship)) {
    echo "Please fill in all the fields.";
  } else {
    // Sanitize the form data
    // You can add more sanitization rules as needed
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $dob = filter_var($dob, FILTER_SANITIZE_STRING);
    $id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    $address = filter_var($address, FILTER_SANITIZE_STRING);
    $county = filter_var($county, FILTER_SANITIZE_STRING);
    $sub_county = filter_var($sub_county, FILTER_SANITIZE_STRING);
    $gender = filter_var($gender, FILTER_SANITIZE_STRING);
    $marital_status = filter_var($marital_status, FILTER_SANITIZE_STRING);
    $kin_name = filter_var($kin_name, FILTER_SANITIZE_STRING);
    $kin_dob = filter_var($kin_dob, FILTER_SANITIZE_STRING);
    $kin_id = filter_var($kin_id, FILTER_SANITIZE_NUMBER_INT);
    $kin_gender = filter_var($kin_gender, FILTER_SANITIZE_STRING);
    $kin_relationship = filter_var($kin_relationship, FILTER_SANITIZE_STRING);

    // Include the config file to connect to the database
    require_once 'config.php';

    try {
      // Create a prepared statement to insert the data into the patients table
      $sql = "INSERT INTO patients (name, dob, id, address, county, sub_county, gender, marital_status, kin_name, kin_dob, kin_id, kin_gender, kin_relationship) VALUES (:name, :dob, :id, :address, :county, :sub_county, :gender, :marital_status, :kin_name, :kin_dob, :kin_id, :kin_gender, :kin_relationship)";
      $stmt = $pdo->prepare($sql);

      // Bind the parameters to the placeholders
      $stmt->bindParam(':name', $name);
      $stmt->bindParam(':dob', $dob);
      $stmt->bindParam(':id', $id);
      $stmt->bindParam(':address', $address);
      $stmt->bindParam(':county', $county);
      $stmt->bindParam(':sub_county', $sub_county);
      $stmt->bindParam(':gender', $gender);
      $stmt->bindParam(':marital_status', $marital_status);
      $stmt->bindParam(':kin_name', $kin_name);
      $stmt->bindParam(':kin_dob', $kin_dob);
      $stmt->bindParam(':kin_id', $kin_id);
      $stmt->bindParam(':kin_gender', $kin_gender);
      $stmt->bindParam(':kin_relationship', $kin_relationship);

      // Execute the statement
      if ($stmt->execute()) {
        // Get the reference number of the inserted row
        // This assumes that your table has a field named ref_no that is auto-incremented and unique
        // You can change this to match your table structure
        $ref_no = $pdo->lastInsertId();

        // Display a success message
        echo "Thank you for registering as a patient. Your reference number is: " . htmlspecialchars($ref_no);

        // Set the email subject
        $subject = "Patients Registration Confirmation";
        $body = "Dear " . htmlspecialchars($name) . ",\r\n";
        $body .= "Thank you for registering as a patient at our clinic.\r\n";
        $body .= "Your reference number is: " . htmlspecialchars($ref_no) . "\r\n";
        $body .= "Please keep this number for future reference.\r\n";
        $body .= "We look forward to serving you.\r\n";
        $body .= "Sincerely,\r\n";
        $body .= "The Clinic Team\r\n";

        // Set the email headers
        // You need to replace the sender email address with your own
        // You can also add more headers as needed
        // For example, you can add a reply-to header or a cc header
       // $headers = "From: clinic@example.com\r\n";

        // Send the email using the mail function
        // The mail function returns true if the email is sent successfully, or false otherwise
        //if (mail($email, $subject, $body, $headers)) {
          echo "An email has been sent to your address with your reference number and other details.";
        //} else {
          echo "There was an error sending the email. Please contact us for assistance.";
       // }
     // } else {
        echo "There was an error inserting the data into the database. Please try again later.";
      }
    } catch (PDOException $e) {
      // Handle any database errors
      echo "Database error: " . $e->getMessage();
    }
  }
}
?>
<style>
  body{
    margin: 5px;
    align-items: center;
  }
</style>


<!DOCTYPE html>
<html>
<head>
  <title>Patients Registration Form</title>
</head>
<body>
  <h1>Patients Registration Form</h1>
  <form action="" method="post">
    <p>
      <label for="name">Name:</label>
      <input type="text" id="name" name="name">
    </p>
    <p>
      <label for="dob">Date of Birth:</label>
      <input type="date" id="dob" name="dob">
    </p>
    <p>
      <label for="id">ID Number:</label>
      <input type="number" id="id" name="id">
    </p>
    <p>
      <label for="address">Address:</label>
      <input type="text" id="address" name="address">
    </p>
    <p>
      <label for="county">County:</label>
      <input type="text" id="county" name="county">
    </p>
    <p>
      <label for="sub_county">Sub County:</label>
      <input type="text" id="sub_county" name="sub_county">
    </p>
    <p>
      <label for="gender">Gender:</label>
      <select id="gender" name="gender">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>
    </p>
    <p>
      <label for="marital_status">Marital Status:</label>
      <select id="marital_status" name="marital_status">
        <option value="">Select</option>
        <option value="Single">Single</option>
        <option value="Married">Married</option>
        <option value="Divorced">Divorced</option>
        <option value="Widowed">Widowed</option>
      </select>
    </p>
    <h2>Next of Kin</h2>
    <p>
      <label for="kin_name">Name:</label>
      <input type="text" id="kin_name" name="kin_name">
    </p>
    <p>
      <label for="kin_dob">Date of Birth:</label>
      <input type="date" id="kin_dob" name="kin_dob">
    </p>
    <p>
      <label for="kin_id">ID Number:</label>
      <input type="number" id="kin_id" name="kin_id">
    </p>
    <p>
      <label for="kin_gender">Gender:</label>
      <select id="kin_gender" name="kin_gender">
        <option value="">Select</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
      </select>
    </p>
    <p>
      <label for="kin_relationship">Relationship:</label>
      <input type="text" id="kin_relationship" name="kin_relationship">
    </p>
    <p>
      <button type="submit" name="submit">Submit</button>
    </p>
  </form>
</body>
</html>