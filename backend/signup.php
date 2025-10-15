<?php
include 'db.php'; // connects to database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // ✅ Check if email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        // Email already exists
        echo "<script>alert('Email already registered. Please login instead.'); window.location.href='../frontend/login.html';</script>";
    } else {
        // ✅ Insert new user into database
        $stmt = $conn->prepare("INSERT INTO users (email, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            // ✅ Signup success → go to todo page
            echo "<script>alert('Signup successful! Redirecting to your todo page...'); window.location.href='../frontend/todo.html';</script>";
        } else {
            echo "<script>alert('Error during signup. Please try again.'); window.history.back();</script>";
        }

        $stmt->close();
    }

    $check->close();
}

$conn->close();
?>
