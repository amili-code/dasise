<?php
$inDir = get_template_directory_uri();
get_header();


?>

<section id="hero" class="hero section dark-background">

    <img src="<?= $inDir ?>/assets/img/404.jpg" alt="" data-aos="fade-in">

    <div class="container">

        <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
            <div class="col-xl-6 col-lg-8">
                <h2>404 error<span>!</span></h2>
                <p>موردی یافت نشد):</p>
            </div>
        </div>

        <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
            <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                    <i class="bi bi-binoculars"></i>
                    <h3><a target="_blank" href="https://www.psychologytoday.com/intl/blog/neuroscience-in-everyday-life/202110/what-are-the-best-exercises-brain-aging?msockid=2d3f3c51289c6319006a2f0729656206">خانه</a></h3>
                </div>
            </div>
            <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                    <i class="bi bi-bullseye"></i>
                    <h3><a target="_blank" href="https://www.psychologytoday.com/intl/blog/neuroscience-in-everyday-life/202110/what-are-the-best-exercises-brain-aging?msockid=2d3f3c51289c6319006a2f0729656206">معما ها</a></h3>
                </div>
            </div>
            <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                    <i class="bi bi-fullscreen-exit"></i>
                    <h3><a target="_blank" href="https://www.psychologytoday.com/intl/blog/neuroscience-in-everyday-life/202110/what-are-the-best-exercises-brain-aging?msockid=2d3f3c51289c6319006a2f0729656206">درباره‌ما</a></h3>
                </div>
            </div>
            <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
                <div class="icon-box">
                    <i class="bi bi-card-list"></i>
                    <h3><a target="_blank" href="https://www.psychologytoday.com/intl/blog/neuroscience-in-everyday-life/202110/what-are-the-best-exercises-brain-aging?msockid=2d3f3c51289c6319006a2f0729656206">پروفایل</a></h3>
                </div>
            </div>
            <!-- <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="700">
            <div class="icon-box">
              <i class="bi bi-gem"></i>
              <h3><a href="">Nemos Enimade</a></h3>
            </div>
          </div> -->
        </div>

    </div>

</section>

<?= get_footer(); ?>