<?php
// PostgreSQL credentials
$host = "dpg-d3hkhchr0fns73cf897g-a.oregon-postgres.render.com";
$port = "5432";
$db = "ecommerce_db_35u4";
$user = "ecommerce_db_35u4_user";
$password = "6jdjiuP2viAWhPwIKyauk9JU3BaNbtkB";

// Connect
$conn_string = "host=$host port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($conn_string);
if (!$conn) { echo "Error connecting to DB."; exit; }

// Get POST data
$username = trim($_POST['username'] ?? '');
$password_form = trim($_POST['password'] ?? '');
$email = trim($_POST['email'] ?? '');

if (!$username || !$password_form || !$email) { echo "Please fill all fields."; exit; }

// Hash password
$hashed_password = password_hash($password_form, PASSWORD_DEFAULT);

// Insert into DB
$query = "INSERT INTO ecommerce_users (username, password, email) VALUES ($1,$2,$3)";
$result = pg_query_params($conn,$query,array($username,$hashed_password,$email));

if ($result) echo "✅ Thank you, $username! Registration successful.";
else {
    $error = pg_last_error($conn);
    if (strpos($error,'23505')!==false) echo "Error: Username or Email already exists.";
    else echo "Error: ".$error;
}

pg_close($conn);
?>
