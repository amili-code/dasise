<?php
/* Template Name: Login Page */
if (is_user_logged_in()) {
    wp_redirect(home_url()); // اگر کاربر وارد شده، به صفحه اصلی هدایت شود
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_user'])) {
    $creds = array(
        'user_login'    => $_POST['username'],
        'user_password' => $_POST['password'],
        'remember'      => isset($_POST['remember'])
    );

    $user = wp_signon($creds, false);

    if (is_wp_error($user)) {
        $error_message = $user->get_error_message();
    } else {
        wp_redirect(home_url()); // پس از ورود، به صفحه اصلی هدایت شود
        exit;
    }
}


$inDir = get_template_directory_uri();
?>

<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ورود به حساب</title>
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
            padding: 0 1rem;
            box-sizing: border-box;
        }

        .login-container {
            text-align: center;
            border: 2px solid #ffc451;
            padding: 2rem;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-sizing: border-box;
            background-color: #1a1a1a;
        }

        h2 {
            color: #ffc451;
            margin-bottom: 1.5rem;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        label {
            font-size: 1rem;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 0.5rem;
            font-family: peyda;
            background-color: gray;
            color: #ffc451;
            border: none;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="checkbox"] {
            margin-right: 0.5rem;
        }

        button {
            width: 100%;
            font-family: peyda;
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

        a {
            color: #ffc451;
            text-decoration: none;
        }

        a:hover {
            color: #e0b040;
        }

        .signup-link {
            display: inline-block;
            color: #ffc451;
            border: 1px solid #ffc451;
            border-radius: 5px;
            padding: 5px;
            margin-top: 1rem;
        }

        .signup-link:hover {
            background-color: #ffc451;
            color: black;
        }

        hr {
            border: 0;
            border-top: 1px solid #ffc451;
            margin: 1.5rem 0;
        }

        @media (min-width: 480px) {
            body {
                padding: 0 2rem;
            }

            .login-container {
                padding: 2.5rem;
            }
        }

        @media (min-width: 768px) {
            .login-container {
                max-width: 450px;
            }

            h2 {
                font-size: 1.8rem;
            }

            button {
                font-size: 1rem;
            }

            label {
                font-size: 1.1rem;
            }
        }

        @media (min-width: 1024px) {
            .login-container {
                padding: 3rem;
            }

            h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>ورود به حساب</h2>
        <?php if (!empty($error_message)): ?>
            <p style="color: red;">اطلاعات شما همخوانی ندارد</p>
        <?php endif; ?>
        <form method="POST">
            <label for="username">نام‌کاربری</label>
            <input type="text" name="username" id="username" required>
            <label for="password">رمزعبور</label>
            <input type="password" name="password" id="password" required>
            <label>
                من برای طولانی مدت در این حساب هستم<input type="checkbox" name="remember">
            </label>
            <button type="submit" name="login_user">ورود به حساب</button>
        </form>
        <p>درحال حاضر حسابی نداری؟ <a href="<?php echo site_url('/signup'); ?>" class="signup-link">ساخت حساب</a></p>
        <hr>
        <a href="/dasise">بازگشت به صفحه اصلی</a>
    </div>
</body>

</html>