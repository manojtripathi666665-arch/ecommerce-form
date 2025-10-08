<?php
// Database credentials
$host = "dpg-d3hkhchr0fns73cf897g-a.oregon-postgres.render.com";
$port = "5432";
$db = "ecommerce_db_35u4";
$user = "ecommerce_db_35u4_user";
$password = "6jdjiuP2viAWhPwIKyauk9JU3BaNbtkB";

// Connection string
$conn_string = "host=$host port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    echo "An error occurred connecting to the database.";
    exit;
}

// Collect form data safely
$username = trim($_POST['username'] ?? '');
$password_form = trim($_POST['password'] ?? '');
$email = trim($_POST['email'] ?? '');

// Simple validation
if (!$username || !$password_form || !$email) {
    echo "Please fill in all fields.";
    exit;
}

// Hash the password before storing it (recommended)
$hashed_password = password_hash($password_form, PASSWORD_DEFAULT);

// Insert query (use prepared statements to avoid SQL injection)
$query = "INSERT INTO ecommerce_users (username, password, email) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($username, $hashed_password, $email));

if ($result) {
    echo "<h2>Thank you! Your data has been submitted.</h2>";
} else {
    echo "Error submitting data: " . pg_last_error($conn);
}

pg_close($conn);
?>
