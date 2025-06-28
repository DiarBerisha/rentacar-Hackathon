<?php
include_once "header.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    $errors = [];

    if (!$name) {
        $errors[] = "Name is required.";
    }
    if (!$email || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "A valid email is required.";
    }
    if (!$message) {
        $errors[] = "Message cannot be empty.";
    }

    if (empty($errors)) {
        echo "<p style='color:green; max-width:600px; margin: 40px auto; font-weight:700;'>
                Thank you, $name! We have received your message and will notify you soon.</p>";
        echo "<script>
                setTimeout(function() {
                    window.location.href = 'index.php';
                }, 3000);
              </script>";
    } else {
        echo "<div style='color:red; max-width:600px; margin: 40px auto;'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    }
} else {
    header("Location: contact.php");
    exit;
}

include_once "footer.php";
