<?php
// PostgreSQL credentials (replace with your actual Render credentials)
$host = "dpg-d3hkhchr0fns73cf897g-a.oregon-postgres.render.com";
$port = "5432";
$db = "ecommerce_db_35u4";
$user = "ecommerce_db_35u4_user";
$password = "6jdjiuP2viAWhPwIKyauk9JU3BaNbtkB";

// Connect to PostgreSQL
$conn_string = "host=$host port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    echo "Error: Could not connect to the database.";
    exit;
}

// Get POST data safely
$username = trim($_POST['username'] ?? '');
$password_form = trim($_POST['password'] ?? '');
$email = trim($_POST['email'] ?? '');

if (!$username || !$password_form || !$email) {
    echo "Please fill in all fields.";
    exit;
}

// Hash the password before storing
$hashed_password = password_hash($password_form, PASSWORD_DEFAULT);

// Prepare SQL insert query
$query = "INSERT INTO ecommerce_users (username, password, email) VALUES ($1, $2, $3)";
$result = pg_query_params($conn, $query, array($username, $hashed_password, $email));

if ($result) {
    echo "<h2>Thank you, " . htmlspecialchars($username) . "! Your registration was successful.</h2>";
} else {
    // Detect duplicate username or email error (Postgres unique violation error code = 23505)
    $error = pg_last_error($conn);
    if (strpos($error, '23505') !== false) {
        echo "Error: Username or Email already exists.";
    } else {
        echo "Error submitting data: " . htmlspecialchars($error);
    }
}

pg_close($conn);
?>
