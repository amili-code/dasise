<?php
/* Template Name: Signup Page */

if (is_user_logged_in()) {
    wp_redirect(home_url()); // اگر کاربر وارد شده، به صفحه اصلی هدایت شود
    exit;
}

$inDir = get_template_directory_uri();
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup_user'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error_message = 'رمز عبور و تایید رمز عبور یکسان نیستند.';
    } elseif (username_exists($username) || email_exists($email)) {
        $error_message = 'نام کاربری یا ایمیل قبلاً ثبت شده است.';
    } else {
        // ساخت کاربر جدید
        $user_id = wp_create_user($username, $password, $email);

        if (is_wp_error($user_id)) {
            $error_message = $user_id->get_error_message();
        } else {
            // ارسال ایمیل تایید ثبت‌نام
            $subject = 'ثبت‌نام شما انجام شد';
            $message = "کاربر گرامی، ثبت‌نام شما با موفقیت انجام شد.";
            $headers = ['Content-Type: text/html; charset=UTF-8'];

            wp_mail($email, $subject, $message, $headers);

            // ورود خودکار کاربر پس از ثبت‌نام
            wp_signon(['user_login' => $username, 'user_password' => $password]);
            wp_redirect(home_url());
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php wp_head(); ?>
    <style>
        @font-face {
            font-family: peyda;
            src: url("<?= $inDir ?>/assets/font/PeydaWeb-Bold.woff2");
        }

        body {
            font-family: peyda;
            background-color: black;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .signup-container {
            text-align: center;
            border: 2px solid #ffc451;
            padding: 2rem;
            border-radius: 10px;
            width: 90%;
            max-width: 400px;
            background-color: #1a1a1a;
        }

        h2 {
            color: #ffc451;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        input {
            width: 100%;
            padding: 0.5rem;
            background-color: gray;
            color: #ffc451;
            border: none;
            border-radius: 5px;
        }

        button {
            background-color: #ffc451;
            color: black;
            border: none;
            padding: 0.75rem;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #e0b040;
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <h2>ساخت حساب</h2>
        <?php if (!empty($error_message)): ?>
            <p style="color: red;"> <?php echo esc_html($error_message); ?> </p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">نام کاربری </label>
            <input type="text" name="username" id="username" required>

            <label for="email">آدرس ایمیل</label>
            <input type="email" name="email" id="email" required>

            <label for="password">رمز عبور</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">تکرار رمز عبور</label>
            <input type="password" name="confirm_password" id="confirm_password" required>
            <p>درحال حاضر حساب داری؟ <a href="<?php echo site_url('/login'); ?>" style="border: 1px solid #ffc451;text-decoration: none;color: #ffc451;padding: .5rem;border-radius: 5px;" class="signup-link">ورود به حساب</a></p>
            <button type="submit" name="signup_user" style="font-family: peyda;">ساخت حساب کاربری</button>
            <hr style="width: 100%;">
            <a href="/dasise" style="text-decoration: none;color: #ffc451;">بازگشت به صفحه اصلی</a>
        </form>
    </div>
    <?php wp_footer(); ?>
</body>

</html>
