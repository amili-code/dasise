<?php
$inDir = get_template_directory_uri();
get_header();

?>
<main class="main">


  <section id="hero" class="hero section dark-background">

    <img src="<?= $inDir ?>/assets/img/main.jpg" alt="" data-aos="fade-in">

    <div class="container">

      <div class="row justify-content-center text-center" data-aos="fade-up" data-aos-delay="100">
        <div class="col-xl-6 col-lg-8">
          <h2>رازها در دسیسه، منتظر شما هستند<span>!</span></h2>
          <p>جذابیت و هیجان کاوش در رازهای پنهانی و دسیسه‌های معماهای جنایی</p>
        </div>
      </div>

      <div class="row gy-4 mt-5 justify-content-center" data-aos="fade-up" data-aos-delay="200">
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="icon-box">
            <i class="bi bi-binoculars"></i>
            <h3><a target="_blank" href="/dasise/exam">سرعت عمل</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="400">
          <div class="icon-box">
            <i class="bi bi-bullseye"></i>
            <h3><a target="_blank" href="/dasise/texts">متن‌های‌زیبا</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="500">
          <div class="icon-box">
            <i class="bi bi-fullscreen-exit"></i>
            <h3><a target="_blank" href="/dasise/challenges">معما ها</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4" data-aos="fade-up" data-aos-delay="600">
          <div class="icon-box">
            <i class="bi bi-card-list"></i>
            <h3><a target="_blank" href="/dasise/sugestion">بنویس</a></h3>
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

  <!-- Clients Section -->
  <section id="clients" class="clients section dark-background">
    <div class="container section-title" data-aos="fade-up">
      <h2><a href="/dasise/challenges/">نمایش تمام معماها</a></h2>
      <p></p>
    </div><!-- End Section Title -->



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
            },
            "breakpoints": {
              "320": {
                "slidesPerView": 2,
                "spaceBetween": 20
              },
              "480": {
                "slidesPerView": 3,
                "spaceBetween": 20
              },
              "640": {
                "slidesPerView": 4,
                "spaceBetween": 20
              },
              "992": {
                "slidesPerView": 5,
                "spaceBetween": 20
              }
            }
          }
        </script>
      <div class="swiper-wrapper align-items-center">
    <?php
    // تنظیمات WP_Query
    $args = [
        'category_name' => 'story',
        'posts_per_page' => 10,
        'orderby' => 'date',
        'order' => 'DESC'
    ];
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full');
            if ($thumbnail) :
    ?>
                <style>
                    figure {
                        display: grid;
                        border-radius: 1rem;
                        overflow: hidden;
                        cursor: pointer;
                        transition: 0.4s;
                    }

                    figure>* {
                        grid-area: 1/1;
                        transition: 0.4s;
                    }

                    figure figcaption {
                        display: grid;
                        align-items: end;
                        font-size: 2.3rem;
                        font-weight: bold;
                        color: #0000;
                        padding: 0.75rem;
                        background: var(--c, #0009);
                        clip-path: inset(0 var(--_i, 100%) 0 0);
                        -webkit-mask:
                            linear-gradient(#000 0 0),
                            linear-gradient(#000 0 0);
                        -webkit-mask-composite: xor;
                        -webkit-mask-clip: text, padding-box;
                        margin: -1px;
                    }

                    figure:hover figcaption {
                        --_i: 0%;
                    }

                    figure:hover img {
                        transform: scale(1.2);
                    }

                    @supports not (-webkit-mask-clip: text) {
                        figure figcaption {
                            -webkit-mask: none;
                            color: #fff;
                        }
                    }
                </style>
                <div class="swiper-slide">
                    <a href="<?= esc_url(get_permalink()); ?>" style="text-decoration: none;">
                        <figure>
                            <img style="width: 200px; height: 200px;" src="<?= esc_url($thumbnail); ?>" alt="<?= esc_attr(get_the_title()); ?>">
                            <figcaption style="color: #fff;"><?= esc_html(get_the_title()); ?></figcaption>
                        </figure>
                    </a>
                </div>
    <?php
            endif;
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>

        <div class="swiper-pagination"></div>
      </div>
    </div>



    </div>

  </section><!-- /Clients Section -->

  <section id="clients" class="clients section dark-background">
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h3 style="color: #ffc451;text-align: center;">معما های پرطرفدار</h3>
        <br>
      <div class="swiper swiper-container" style="border-radius: 15px;">
        <div class="swiper-wrapper">
          <?php
          // تنظیمات WP_Query برای پست‌های پربازدید
          $args = [
            'category_name' => 'story', // فقط پست‌های کتگوری 'story'
            'posts_per_page' => 5,      // تعداد پست‌ها
            'meta_key' => 'postview',   // نام متا فیلد برای تعداد بازدید
            'orderby' => 'meta_value_num', // مرتب‌سازی بر اساس مقدار عددی متا
            'order' => 'DESC'           // ترتیب نزولی
          ];
          $query = new WP_Query($args);

          if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
              $thumbnail = get_the_post_thumbnail_url(get_the_ID(), 'full'); // تصویر شاخص پست
              $post_about = get_post_meta(get_the_ID(), 'about', true);      // مقدار متا فیلد 'about'
              $post_link = get_permalink(); // لینک پست
          ?>
              <div class="swiper-slide">
                <div class="slide-content" style="background-image: url('<?= esc_url($thumbnail); ?>'); background-size: cover; background-position: center;">
                  <div class="content-overlay">
                    <h2 style="color: #ffc451;"><?= esc_html(get_the_title()); ?></h2>
                    <p><?= esc_html($post_about); ?></p>
                    <a href="<?= esc_url($post_link); ?>" style="background-color: #ffc451;color: #000;" class="btn btn-primary">برو به این معما</a>
                  </div>
                </div>
              </div>
          <?php
            endwhile;
            wp_reset_postdata();
          else :
            echo '<p>No posts found.</p>';
          endif;
          ?>
        </div>
        <!-- کنترل‌های اسلایدر -->
        <div style="color: #ffc451;" class="swiper-button-next"></div>
        <div style="color: #ffc451;" class="swiper-button-prev"></div>
        <div style="color: #ffc451;" class="swiper-pagination"></div>
      </div>
    </div>
  </section>

  <style>
    /* تنظیمات استایل برای فیت‌شدن تصاویر */
    .swiper-slide {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 400px;
      /* ارتفاع اسلاید */
      position: relative;
    }

    .slide-content {
      width: 100%;
      height: 100%;
      position: relative;
      display: flex;
      flex-direction: column;
      justify-content: flex-end;
      padding: 20px;
      color: #fff;
      text-align: center;
      background: rgba(0, 0, 0, 0.5);
      /* شفافیت برای بهتر دیده‌شدن متن */
      border-radius: 10px;
    }

    .content-overlay {
      z-index: 2;
    }

    .btn-primary {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 20px;
      color: #fff;
      background-color: #fdd835;
      /* رنگ زرد */
      border: none;
      border-radius: 5px;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #ffc651;
    }
  </style>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const swiper = new Swiper('.swiper-container', {
        loop: true,
        slidesPerView: 1,
        spaceBetween: 10,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        on: {
          init: function() {
            // console.log('Swiper initialized');
          },
          slideChange: function() {
            // console.log('Slide changed to: ', this.activeIndex);
          }
        }
      });
    });
  </script>




  <!-- Call To Action Section -->
  <section id="call-to-action" class="call-to-action section dark-background" style="display:none;">

    <img src="assets/img/cta-bg.jpg" alt="">

    <div class="container">
      <div class="row justify-content-center" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-xl-10">
          <div class="text-center">
            <h3>Call To Action</h3>
            <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <a class="cta-btn" href="#">Call To Action</a>
          </div>
        </div>
      </div>
    </div>

  </section><!-- /Call To Action Section -->

  <!-- Portfolio Section -->
  <section id="portfolio" class="portfolio section"style="display:none;">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Portfolio</h2>
      <p>Check our Portfolio</p>
    </div><!-- End Section Title -->

    <div class="container">

      <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

        <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
          <li data-filter="*" class="filter-active">All</li>
          <li data-filter=".filter-app">App</li>
          <li data-filter=".filter-product">Card</li>
          <li data-filter=".filter-branding">Web</li>
        </ul><!-- End Portfolio Filters -->

        <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 1</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-1.jpg" title="App 1" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Product 1</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-2.jpg" title="Product 1" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Branding 1</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-3.jpg" title="Branding 1" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 2</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-4.jpg" title="App 2" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Product 2</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-5.jpg" title="Product 2" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Branding 2</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-6.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-app">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>App 3</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-7.jpg" title="App 3" data-gallery="portfolio-gallery-app" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Product 3</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-8.jpg" title="Product 3" data-gallery="portfolio-gallery-product" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

          <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-branding">
            <img src="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" class="img-fluid" alt="">
            <div class="portfolio-info">
              <h4>Branding 3</h4>
              <p>Lorem ipsum, dolor sit</p>
              <a href="assets/img/masonry-portfolio/masonry-portfolio-9.jpg" title="Branding 2" data-gallery="portfolio-gallery-branding" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
              <a href="portfolio-details.html" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
            </div>
          </div><!-- End Portfolio Item -->

        </div><!-- End Portfolio Container -->

      </div>

    </div>

  </section><!-- /Portfolio Section -->



  <section id="stats" class="stats section"style="display:none;">

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="row gy-4 align-items-center justify-content-between">

        <div class="col-lg-5">
          <img src="assets/img/stats-img.jpg" alt="" class="img-fluid">
        </div>

        <div class="col-lg-6">

          <h3 class="fw-bold fs-2 mb-3">Voluptatem dignissimos provident quasi</h3>
          <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Duis aute irure dolor in reprehenderit
          </p>

          <div class="row gy-4">

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-emoji-smile flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Happy Clients</strong> <span>consequuntur quae</span></p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-journal-richtext flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Projects</strong> <span>adipisci atque cum quia aut</span></p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-headset flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Hours Of Support</strong> <span>aut commodi quaerat</span></p>
                </div>
              </div>
            </div><!-- End Stats Item -->

            <div class="col-lg-6">
              <div class="stats-item d-flex">
                <i class="bi bi-people flex-shrink-0"></i>
                <div>
                  <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
                  <p><strong>Hard Workers</strong> <span>rerum asperiores dolor</span></p>
                </div>
              </div>
            </div><!-- End Stats Item -->

          </div>

        </div>

      </div>

    </div>

  </section><!-- /Stats Section -->



  <!-- Contact Section -->
  <section id="contact" class="contact section"style="display:none;">

    <!-- Section Title -->
    <div class="container section-title" data-aos="fade-up">
      <h2>Contact</h2>
      <p>Contact Us</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

      <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
        <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div><!-- End Google Maps -->

      <div class="row gy-4">

        <div class="col-lg-4">
          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
            <i class="bi bi-geo-alt flex-shrink-0"></i>
            <div>
              <h3>Address</h3>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
            <i class="bi bi-telephone flex-shrink-0"></i>
            <div>
              <h3>Call Us</h3>
              <p>+1 5589 55488 55</p>
            </div>
          </div><!-- End Info Item -->

          <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
            <i class="bi bi-envelope flex-shrink-0"></i>
            <div>
              <h3>Email Us</h3>
              <p>info@example.com</p>
            </div>
          </div><!-- End Info Item -->

        </div>

        <div class="col-lg-8">
          <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">

              <div class="col-md-6">
                <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
              </div>

              <div class="col-md-6 ">
                <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
              </div>

              <div class="col-md-12">
                <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
              </div>

              <div class="col-md-12">
                <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
              </div>

              <div class="col-md-12 text-center">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>

                <button type="submit">Send Message</button>
              </div>

            </div>
          </form>
        </div><!-- End Contact Form -->

      </div>

    </div>

  </section><!-- /Contact Section -->

</main>

<?= get_footer(); ?>