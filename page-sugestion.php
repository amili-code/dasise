<?php
$inDir = get_template_directory_uri();
get_header();


?>

<!-- About Section -->
<section id="sugestion" style="background-image:'<?= $inDir ?>/assets/img/main.jpg' ;" class="sugestion section dark-background">


    <br>
    <br>
    <br>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h1 style="text-align: center;">پیشنهادات</h1>
        <br>
        <br>

        <div class="row gy-4">
            <form action="<?= $inDir?>/process_scenario.php" method="post">
                <p>شما می‌توانید با نوشتن سناریو توکن دریافت کنید.</p>
                <textarea name="scenario_text" id="scenario_text"
                    style="border-radius: 5px; width: 100%; height: 12rem; border: 2px solid #ffc451; background-color: black; color: aliceblue; font-size: small;">
                  متن سناریو را اینجا وارد کنید...
                 </textarea>
                <button type="submit" style="width: 100%; text-align: center; border-radius: 5px; border: 2px solid #ffc451; background-color: #ffc451; color: black; padding: .7rem;">ارسال سناریو</button>
            </form>

        </div>
        <br>
        <hr>
        <br>
        <div class="row" style="text-align: center;">
            <p>
                سناریو های شما به سرور ارسال میشه اگر حداقل المان های سناریو نویسی در ان رعایت شده باشه به شما توکن داده میشه که دیگه لازم نباشه برای استفاده از امکانات ما پول بدین (;
            </p>
        </div>

    </div>

</section><!-- /About Section -->




<?= get_footer(); ?>