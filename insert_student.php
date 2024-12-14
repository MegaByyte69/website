<?php
$host = 'localhost';          
$dbname = 'gurukul'; 
$username = 'root';       
$password = '';            

try {
    // Establish a connection to the MySQL database using PDO
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve and sanitize the form input values
        $firstName = htmlspecialchars($_POST['fname']);
        $lastName = htmlspecialchars($_POST['lname']);
        $email = htmlspecialchars($_POST['email']);
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $subject = htmlspecialchars($_POST['subject']);
        $location = htmlspecialchars($_POST['location']);

        

        // Prepare an SQL statement to insert the data into the students table
        $sql = "INSERT INTO students (first_name, last_name, email, password, subject, location) 
                VALUES (:first_name, :last_name, :email, :password, :subject, :location)";
        $stmt = $db->prepare($sql);

        // Bind the parameters to prevent SQL injection
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':location', $location);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Student details have been successfully added!";
        } else {
            echo "An error occurred while adding the student.";
        }
    }
} catch (PDOException $e) {
    // Display an error message if the database connection or query fails
    echo "Error: " . $e->getMessage();
}
?>
