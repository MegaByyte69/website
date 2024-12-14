<?php
// Database connection details
$host = 'localhost';       // Hostname (default is 'localhost' for XAMPP)
$dbname = 'gurukul'; 
$username = 'root';        // Replace with your database username
$password = '';            // Replace with your database password

try {
    // Establish a database connection using PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize input values
        $firstName = htmlspecialchars($_POST['fname']);
        $lastName = htmlspecialchars($_POST['lname']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $subject = htmlspecialchars($_POST['subject']);
        $location = htmlspecialchars($_POST['location']);
        $experience = htmlspecialchars($_POST['experience']);

        // Prepare SQL query to insert data into the 'tutors' table
        $sql = "INSERT INTO tutors (first_name, last_name, email, password, subject, location, experience) 
                VALUES (:first_name, :last_name, :email, :password, :subject, :location, :experience)";
        $stmt = $db->prepare($sql);

        // Bind parameters to prevent SQL injection
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':experience', $experience);

        // Execute the query
        if ($stmt->execute()) {
            echo "Tutor details have been successfully added!";
        } else {
            echo "An error occurred while adding the tutor.";
        }
    }
} catch (PDOException $e) {
    // Display error message if the database connection or query fails
    echo "Error: " . $e->getMessage();
}
?>
