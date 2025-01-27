<?php
$inDir = get_template_directory_uri();
?>



<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>دسیسه</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="<?= $inDir ?>/assets/img/2.png" rel="icon">
    <link href="<?= $inDir ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= $inDir ?>/assets/vendor/bootstrap/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="<?= $inDir ?>/assets/css/main.css" rel="stylesheet">
    <link href="<?= $inDir ?>/style.css" rel="stylesheet">


</head>
<style>
    @font-face {
        font-family: peyda;
        src: url("<?= $inDir ?>/assets/font/PeydaWeb-Bold.woff2");
    }

    body {
        font-family: peyda;
    }
</style>





<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

            <a href="/dasise" class="logo d-flex align-items-center me-auto me-lg-0">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                 <div>
                     <!-- <img src="<?= $inDir; ?>/pic/logo.png" alt="لوگوی دسیسه" style="width: fit-content; margin-bottom: 20px;position: relative;top: 7px;"> -->
                 </div>
                دسیسه
            </a>

            <nav id="navmenu" class="navmenu">
                <?php
                wp_nav_menu([
                    'theme_location' => 'header', // مکان منوی ثبت‌شده
                    'menu_class' => '', // حذف کلاس پیش‌فرض وردپرس برای UL
                    'container' => false, // جلوگیری از ایجاد تگ container اضافی
                    'depth' => 3, // پشتیبانی از منوی چندسطحی
                    'walker' => new Custom_Nav_Walker(), // کلاس اختصاصی برای HTML
                ]);
                ?>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <?php
            if (is_user_logged_in()) {
                $current_user = wp_get_current_user();
                echo '<a href="/dasise/profile" class="btn-getstarted" style="height: 2rem;"><div style="border:none;">';
                echo '<p style="color:aliceblue;">' . esc_html($current_user->display_name) . '</p>';
                echo '</div></a>';
            } else {
                echo '<a class="btn-getstarted" href="/dasise/login">همین‌الان شروع‌کن</a>';
            }
            ?>

        </div>
    </header>