<?php
$inDir = get_template_directory_uri();
get_header();


?>

<section id="challenges" class="challenges section dark-background">
    <br>
    <br>
    <br>
    <div class="container" data-aos="fade-up" data-aos-delay="100" style="text-align: center;">
        <br>
        <img src="<?= $inDir; ?>/pic/logo.png" alt="لوگوی دسیسه" style="width: 150px; margin-bottom: 20px;">
        <h1 style=" font-size: 36px; font-weight: bold;">پیام‌های تایید شده شما</h1>
        <p style="color: #ffc451; margin-top: 10px;">اینجا متن‌های مورد تایید شما نمایش داده می‌شود</p>

        <div class="messages-grid" style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; margin-top: 30px;">
            <?= display_approved_messages(); ?>
        </div>
        <div class="share-message" style="margin-top: 40px;">
            <p style="color: #fff; font-size: 18px;">
                اگر متنی دارید که می‌خواهید با ما به اشتراک بگذارید، از فرم زیر استفاده کنید.
            </p>
            <!-- <img src="<?= $inDir ?>/pic/1.svg" alt="" style="height: 50%; width: auto; transform: rotate(225deg);"> -->
        </div>
    </div>

</section>




<?= get_footer(); ?>