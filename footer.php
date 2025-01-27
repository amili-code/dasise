<?php
$inDir = get_template_directory_uri();
?>
<footer id="footer" class="footer dark-background">
    <div class="footer-top">
        <hr>
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">دسیسه</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>دسیسه با افتخار تقدیم می کند</p>
                        <p>ایران ، مشهد | اولین در جهان</p>
                        <p class="mt-3"><strong>پشتیبانی:</strong> <span>989397759440+</span></p>
                        <p><strong>ایمیل:</strong> <span>dasise.info@gmail.com</span></p>
                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>

                <!-- <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Terms of service</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Privacy policy</a></li>
                    </ul>
                </div> -->
<!-- 
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Marketing</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#"> Graphic Design</a></li>
                    </ul>
                </div> -->

                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>با پیامای قشنگتون انرژی بدین بهمون(:</h4>
                    <p>دسیسه رو برام تو چند کلمه توصیف کن.</p>
                    <form action="<?php echo get_template_directory_uri(); ?>/process_form.php" method="post">
                        <div class="newsletter-form">
                            <textarea name="user_text" placeholder="پیامتون..." style="background-color: black; color: aliceblue; width: 100%;" required></textarea>
                            <button type="submit" name="submit_form" class="btn-getstarted" style="background-color: black; border: 2px solid #ffc451; border-radius: 5px; color: aliceblue; margin-right: 1rem;">ارسال</button>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </div>

    <!-- <div class="copyright">
        <div class="container text-center">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">GP</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
           
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
            </div>
        </div>
    </div> -->

</footer>

<!-- Scroll Top -->
<a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Preloader -->
<div id="preloader"></div>

<!-- Vendor JS Files -->
<script src="<?= $inDir ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= $inDir ?>/assets/vendor/php-email-form/validate.js"></script>
<script src="<?= $inDir ?>/assets/vendor/aos/aos.js"></script>
<script src="<?= $inDir ?>/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="<?= $inDir ?>/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="<?= $inDir ?>/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
<script src="<?= $inDir ?>/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="<?= $inDir ?>/assets/vendor/purecounter/purecounter_vanilla.js"></script>

<!-- Main JS File -->
<script src="<?= $inDir ?>/assets/js/main.js"></script>

</body>

</html>