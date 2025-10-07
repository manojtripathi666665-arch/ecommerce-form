<?php
// Render PostgreSQL DB credentials
$host = "dpg-d3hkhchr0fns73cf897g-a.oregon-postgres.render.com";
$port = "5432";
$db = "ecommerce_db_35u4";
$user = "ecommerce_db_35u4_user";
$password = "6jdjiuP2viAWhPwIKyauk9JU3BaNbtkB";

// Connect to PostgreSQL
$conn_string = "host=$host port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    echo "An error occurred connecting to the database.";
    exit;
}

// Get form data safely
$username = $_POST['username'] ?? '';
$password_form = $_POST['password'] ?? '';
$email = $_POST['email'] ?? '';
$category = $_POST['category'] ?? '';

// Simple validation (optional, you can improve)
if (!$username || !$password_form || !$email || !$category) {
    echo "Please fill in all fields.";
    exit;
}

// Insert into database with parameterized query
$query = "INSERT INTO ecommerce_users (username, password, email, category) VALUES ($1, $2, $3, $4)";
$result = pg_query_params($conn, $query, array($username, $password_form, $email, $category));

if ($result) {
    echo "<h2>Thank you! Your data has been submitted.</h2>";
} else {
    echo "Error submitting data: " . pg_last_error($conn);
}

pg_close($conn);
?>




