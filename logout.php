<?php
session_start();

// Database connection
$server = "localhost";
$username = "root";
$password = "";
$dbname = "projtest";

// Create connection
$con = mysqli_connect($server, $username, $password, $dbname);

// Check if connection is successful
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// If the user is logged in, delete their cart
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    
    // SQL to delete the cart for the logged-in user
    $delete_cart_sql = "DELETE FROM projtest.cart WHERE user_id = '$user_id'";
    
    if ($con->query($delete_cart_sql) === TRUE) {
        // Cart deleted successfully
    } else {
        // Handle any errors (optional)
        echo "Error deleting cart: " . $con->error;
    }
}

// Close the database connection
$con->close();

// Destroy session and unset all session variables
session_unset();
session_destroy();

// Redirect to the originating page or home page
$redirect = isset($_GET['redirect']) ? $_GET['redirect'] : 'index3.php';
header("Location: $redirect");
exit();
?>
