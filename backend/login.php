<?php
include 'db.php';

// Read POST data
$email = $_POST['email'];
$password = $_POST['password'];

// Check if user exists
$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User found → redirect to todo page
    echo "<script>
            alert('Login Successful!');
            window.location.href = '../frontend/todo.html';
          </script>";
} else {
    // User not found → show alert
    echo "<script>
            alert('Invalid email or password!');
            window.location.href = 'signin.html';
          </script>";
}

$conn->close();
?>
