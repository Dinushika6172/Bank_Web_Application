<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$dbname = "trustfund_bank";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) !== TRUE) {
    die("Error creating database: " . $conn->error);
}

// Select the database
$conn->select_db($dbname);

// Create table if it doesn't exist
$tableSql = "
CREATE TABLE IF NOT EXISTS loan_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    loan_amount DECIMAL(10, 2) NOT NULL,
    loan_purpose VARCHAR(50) NOT NULL,
    income DECIMAL(10, 2) NOT NULL,
    employment_status VARCHAR(50) NOT NULL,
    credit_score INT NOT NULL,
    loan_term INT NOT NULL
)";
if ($conn->query($tableSql) !== TRUE) {
    die("Error creating table: " . $conn->error);
}

// Get form data
$fullName = $_POST['fullName'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$loanAmount = $_POST['loanAmount'];
$loanPurpose = $_POST['loanPurpose'];
$income = $_POST['income'];
$employmentStatus = $_POST['employmentStatus'];
$creditScore = $_POST['creditScore'];
$loanTerm = $_POST['loanTerm'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO loan_applications (full_name, email, phone, loan_amount, loan_purpose, income, employment_status, credit_score, loan_term) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssissisi", $fullName, $email, $phone, $loanAmount, $loanPurpose, $income, $employmentStatus, $creditScore, $loanTerm);

// Execute the statement
if ($stmt->execute()) {
    // Redirect to homepage
    header("Location: Bankpage.html");
    exit();
} else {
    echo "Error: " . $stmt->error;
}

// Close connection
$stmt->close();
$conn->close();
?>
