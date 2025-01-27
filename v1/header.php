<?php
$inDir = get_template_directory_uri();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php wp_head(); ?>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <link href="<?= $inDir . './assets/pic/favicon.png' ?>" rel="icon">
    <link href="<?= $inDir . './assets/pic/apple-touch-icon.png' ?>" rel="apple-touch-icon">
    <link rel="stylesheet" href="<?= $inDir ?>/assets/css/bootstrap.rtl.min.css">
    <link href="<?= $inDir . './assets/lib/bootstrap-icons/bootstrap-icons.css"' ?> rel=" stylesheet">
    <link href="<?= $inDir ?>/assets/lib/aos/aos.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/lib/swiper/swiper-bundle.min.css" rel="stylesheet">
    <link href="<?= $inDir ?>/assets/lib/glightbox/css/glightbox.min.css" rel="stylesheet">


    <link rel="stylesheet" href="<?= $inDir ?>/style.css">

    <title>دسیسه</title>
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

<body>
    <header>
        <nav class="navbar navbar-expand-lg" style="background-color: black;">
            <div class="container">
                <a class="navbar-brand" href="/dasise">
                    <h1 style="color: aliceblue;">دسیسه</h1>
                </a>
                <button style="color: aliceblue;" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span style="color: aliceblue;" class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container' => false,
                            'items_wrap' => '%3$s', // حذف <ul> اضافی
                        ));
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>