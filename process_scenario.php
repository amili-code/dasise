<?php

// بارگذاری وردپرس
require_once $_SERVER['DOCUMENT_ROOT'] . '/Dasise/wp-load.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $scenarioText = trim($_POST['scenario_text'] ?? '');

    if (empty($scenarioText)) {
        die("متن سناریو نمی‌تواند خالی باشد.");
    }

    // اطلاعات کاربر لاگین‌شده
    $current_user = wp_get_current_user();
    $user_id = $current_user->ID;

    // بررسی وضعیت لاگین
    if ($user_id === 0) { // کاربر لاگین نشده
        die("برای ارسال سناریو باید وارد حساب کاربری خود شوید.");
    }

    // اتصال به پایگاه داده
    $conn = new mysqli('localhost', 'root', '', 'dasise');

    if ($conn->connect_error) {
        die("خطا در اتصال به پایگاه داده: " . $conn->connect_error);
    }

    // ذخیره سناریو در دیتابیس
    $stmt = $conn->prepare("INSERT INTO wp_scenarios (user_id, scenario_text, created_at) VALUES (?, ?, NOW())");
    $stmt->bind_param("is", $user_id, $scenarioText);

    if ($stmt->execute()) {
        echo "سناریو شما با موفقیت ارسال شد!";
    } else {
        echo "خطا در ذخیره سناریو.";
    }

    $stmt->close();
    $conn->close();
    wp_redirect('/dasise/sugestion');
}
