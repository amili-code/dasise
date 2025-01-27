<?php
$inDir = get_template_directory_uri();
get_header();


?>

<!-- About Section -->
<section id="about" class="about section dark-background">
    <br>
    <br>
    <br>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h1 style="text-align: center;">درباره ما</h1>
        <br>
        <br>

        <div class="row gy-4">
            <div class="col-lg-6 order-1 order-lg-2">
                <img src="<?= $inDir ?>/assets/img/part.jpg" class="img-fluid" alt="">
            </div>
            <div class="col-lg-6 order-2 order-lg-1 content">
                <h3>دسیسه چجوری شکل گرفت!</h3>
                <p class="">
                    ما سه تا دانش‌آموز توی شهر مشهد بودیم.امیر ، علی و امیرعلی. هممون هنرستانی بودیم و هنرستان مارو به هم رسوند
                </p>
                <ul>
                    <li><i class="bi bi-check2-all"></i> <span>هرسه‌تامون رشته شبکه و نرم افزار بودی.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>تصمیم سه نفرمون از تاریخ 22آذر 1403 جدی شد.</span></li>
                    <li><i class="bi bi-check2-all"></i> <span>و دسیسه استارتی بود برای محک‌زدن خودمون و شاد کردن و مردم عزیز ایران.</span></li>
                </ul>
                <hr>
                <p>
                    توی این راه افراد زیادی امدن و رفتن مثل پروژه ها اما ما مطمعن از روز اول پای حرفمون موندیم و با قدر بدون استراحت پیش رفتیم تا بتونیم پلتفرم دسیسه رو استارت کنیم.
                </p>
            </div>
        </div>

    </div>

</section><!-- /About Section -->



<!-- Stats Section -->
<!-- Team Section -->
<!-- <section id="team" class="team section dark-background">

    <div class="container section-title" data-aos="fade-up">
        <h2>Team</h2>
        <p>اعضای تیم</p>
    </div>

    <div class="container">

        <div class="row gy-4">

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
                <div class="team-member">
                    <div class="member-img">
                        <img src="assets/img/team/team-1.jpg" class="img-fluid" alt="">
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>امیرعلی قربانی</h4>
                        <span>ایده‌پرداز و برنامه‌نویس</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
                <div class="team-member">
                    <div class="member-img">
                        <img src="assets/img/team/team-2.jpg" class="img-fluid" alt="">
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>علی غنی‌زادی</h4>
                        <span>طراح و سناریونویس</span>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
                <div class="team-member">
                    <div class="member-img">
                        <img src="assets/img/team/team-3.jpg" class="img-fluid" alt="">
                        <div class="social">
                            <a href=""><i class="bi bi-twitter-x"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                    <div class="member-info">
                        <h4>امیرمحمد ظفرسعیدی</h4>
                        <span>مدیر پروژه و بازاریاب</span>
                    </div>
                </div>
            </div>


        </div>

    </div>

</section> -->


<!-- /Team Section -->


<!-- Testimonials Section -->
<section id="testimonials" class="testimonials section dark-background">

    <img src="<?= $inDir ?>/assets/img/team.jpg" class="testimonials-bg" alt="">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
            <script type="application/json" class="swiper-config">
                {
                    "loop": true,
                    "speed": 600,
                    "autoplay": {
                        "delay": 5000
                    },
                    "slidesPerView": "auto",
                    "pagination": {
                        "el": ".swiper-pagination",
                        "type": "bullets",
                        "clickable": true
                    }
                }
            </script>
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="<?= $inDir ?>/assets/img/amili.jpg" class="testimonial-img" alt="">
                        <h3>امیرعلی قربانی</h3>
                        <h4>برنامه‌نویس و ایده‌پرداز</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>هیجان همیشه باعث میشه ادم بهتری نسبت به قبل باشین. ریسک کنین و با هیجان زندگی کنین شاید زود بگذره اما خوش میگذره</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                    <div class="testimonial-item">
                        <img src="<?= $inDir ?>/assets/img/ali.jpg" class="testimonial-img" alt="">
                        <h3>علی‌غنی زاده</h3>
                        <h4>طراح</h4>
                        <div class="stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                        <p>
                            <i class="bi bi-quote quote-icon-left"></i>
                            <span>Export tempor illum tamen malis malis eram quae irure esse labore quem cillum quid cillum eram malis quorum velit fore eram velit sunt aliqua noster fugiat irure amet legam anim culpa.</span>
                            <i class="bi bi-quote quote-icon-right"></i>
                        </p>
                    </div>
                </div><!-- End testimonial item -->

               
                <!-- End testimonial item -->

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>


</section><!-- /Testimonials Section -->

<div class="testimonials section  dark-background" >
    
    <p style="text-align: center;color: aliceblue;">
        "شوخی کرد ، جدی شدن. جدی شد، بازی کردن. وارد بازی شد"
    </p>
</div>



<?= get_footer(); ?>