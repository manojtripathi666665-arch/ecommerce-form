<?php
// Replace with your actual Render PostgreSQL DB credentials
$host = "your-render-db-host";
$db = "your-db-name";
$user = "your-db-user";
$password = "your-db-password";
$port = "5432"; // default PostgreSQL port

// Connect to PostgreSQL
$conn = pg_connect("host=$host dbname=$db user=$user password=$password port=$port");

if (!$conn) {
    echo "An error occurred connecting to the database.";
    exit;
}

// Get form data
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$category = $_POST['category'];

// Insert into database using parameterized query (safe from SQL injection)
$query = "INSERT INTO ecommerce_users (username, password, email, category) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($username, $password, $email, $category));

if ($result) {
    echo "<h2>Thank you! Your data has been submitted.</h2>";
} else {
    echo "Error submitting data.";
}

pg_close($conn);
?>
