<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/Dasise/wp-load.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userMessage = $_POST['user_text'] ?? '';

    // اتصال به پایگاه داده
    $conn = new mysqli('localhost', 'root', '', 'dasise');

    if ($conn->connect_error) {
        die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }

    // ذخیره پیام
    $stmt = $conn->prepare("INSERT INTO wp_user_messages (message) VALUES (?)");
    $stmt->bind_param("s", $userMessage);
    
    if ($stmt->execute()) {
        echo "پیام شما با موفقیت ارسال شد!";
    } else {
        echo "خطا در ذخیره پیام.";
    }

    $stmt->close();
    $conn->close();
    wp_redirect('/dasise');
}
