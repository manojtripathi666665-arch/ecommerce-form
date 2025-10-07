<?php
// Connect to your Render PostgreSQL database
$host = "dpg-d3hkhchr0fns73cf897g-a.oregon-postgres.render.com";
$port = "5432";
$db = "ecommerce_db_35u4";
$user = "ecommerce_db_35u4_user";
$password = "6jdjiuP2viAWhPwIKyauk9JU3BaNbtkB";

$conn_string = "host=$host port=$port dbname=$db user=$user password=$password";
$conn = pg_connect($conn_string);

if (!$conn) {
    die("Failed to connect to the database.");
}

// Fetch all records
$result = pg_query($conn, "SELECT * FROM ecommerce_users ORDER BY id DESC");
if (!$result) {
    die("Error running query: " . pg_last_error($conn));
}

echo "<h2 style='text-align:center;'>📊 User Submissions</h2>";
echo "<table border='1' cellpadding='8' cellspacing='0' style='margin:auto; border-collapse:collapse;'>
<tr style='background:#eee;'>
<th>ID</th>
<th>Username</th>
<th>Password</th>
<th>Email</th>
<th>Category</th>
<th>Created At</th>
</tr>";

while ($row = pg_fetch_assoc($result)) {
    echo "<tr>
    <td>{$row['id']}</td>
    <td>{$row['username']}</td>
    <td>{$row['password']}</td>
    <td>{$row['email']}</td>
    <td>{$row['category']}</td>
    <td>{$row['created_at']}</td>
    </tr>";
}
echo "</table>";

pg_close($conn);
?>
