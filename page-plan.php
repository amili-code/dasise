<?php
$inDir = get_template_directory_uri();
get_header();

// تابع برای دریافت نرخ دلار
$dollarRate = getDollarToTomanRate() / 10;
// echo $dollarRate;
if (!$dollarRate) {
    $dollarRate = 70000; // نرخ پیش‌فرض در صورت عدم دسترسی به نرخ لحظه‌ای
}

// چک کردن وضعیت کاربر و پلن
$current_user_id = get_current_user_id();
$is_user_logged_in = is_user_logged_in();
$user_expiry_date = $is_user_logged_in ? get_user_meta($current_user_id, 'premium_expiry_date', true) : null;

// تبدیل تاریخ انقضا به شمسی
$expiry_date_jalali = $user_expiry_date ? convertToJalali($user_expiry_date) : null;

// بررسی معتبر بودن پلن کاربر
$has_active_plan = $user_expiry_date && strtotime($user_expiry_date) > time();
?>

<!-- About Section -->
<section id="sugestion" class="sugestion section dark-background">
    <br>
    <br>
    <br>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h1 style="text-align: center;">پلن‌ها</h1>
        <br>
        <br>

        <div class="row">
            <?php if ($is_user_logged_in): ?>
                <?php if ($has_active_plan): ?>
                    <div class="col-12">
                        <p style="text-align: center; color: #ffc451;">شما یک پلن فعال دارید که تا تاریخ <strong><?php echo $expiry_date_jalali; ?></strong> معتبر است. امکان خرید پلن جدید وجود ندارد.</p>
                    </div>
                <?php else: ?>
                    <?php
                    // Query برای گرفتن پلن‌ها از دسته‌بندی plan
                    $args = array(
                        'category_name' => 'plan',
                        'post_type' => 'post',
                        'posts_per_page' => -1,
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();

                            // گرفتن مقادیر price و takh از کاستوم فیلدها
                            $price = get_post_meta(get_the_ID(), 'price', true); // قیمت به دلار
                            $takh = get_post_meta(get_the_ID(), 'takh', true); // درصد تخفیف
                            $day = get_post_meta(get_the_ID(), 'day', true); // تعداد روز
                            $mainTakh = $takh;

                            // تبدیل قیمت به تومان
                            $priceInToman = $price * $dollarRate;

                            // اعمال تخفیف
                            if ($takh) {
                                $priceWithDiscount = $priceInToman - ($priceInToman * ($takh / 100));
                            } else {
                                $priceWithDiscount = $priceInToman;
                            }
                    ?>
                            <div class="col-md-4">
                                <div class="plan-box" style="border: 1px solid #ffc451; padding: 20px; border-radius: 10px; margin-bottom: 20px; display: flex; flex-direction: column; height: 300px;">
                                    <h2><?php the_title(); ?> | <?= $day ?> روزه</h2>
                                    <p><?php the_excerpt(); ?></p>

                                    <?php if ($takh && $takh > 0): ?>
                                        <del style="color: red;">قیمت: <?php echo number_format($priceInToman); ?> تومان</del>
                                        <p>درصد <?= $mainTakh ?> تخفیف</p>
                                        <p style="color: #ffc451;">قیمت با تخفیف: <?php echo number_format($priceWithDiscount); ?> تومان</p>
                                    <?php else: ?>
                                        <p style="color: #ffc451;">قیمت: <?php echo number_format($priceInToman); ?> تومان</p>
                                    <?php endif; ?>

                                    <form method="POST" action="<?php echo esc_url(home_url('/purchase')); ?>" style="margin-top: auto;">
                                        <input type="hidden" name="plan_id" value="<?php echo get_the_ID(); ?>">
                                        <input type="hidden" name="price" value="<?php echo $priceWithDiscount; ?>">
                                        <input type="hidden" name="takh" value="<?php echo $takh; ?>">
                                        <input type="hidden" name="daye" value="<?php echo $day; ?>">
                                        <button type="submit" class="btn" style="width: 100%; background: #ffc451; color: black; border: none; border-radius: 5px; cursor: pointer;">خرید پلن</button>
                                    </form>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<p>پلنی برای نمایش وجود ندارد.</p>';
                    }

                    wp_reset_postdata();
                    ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="col-12">
                    <p style="text-align: center; color: #ffc451;">برای خرید پلن ابتدا وارد حساب کاربری خود شوید.</p>
                    <div style="text-align: center; margin-top: 20px;">
                        <a href="/dasise/login" class="btn" style="background: #ffc451; color: black; padding: 10px 20px; border-radius: 5px; text-decoration: none;">ورود به حساب کاربری</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

     


    </div>
</section><!-- /About Section -->

<?= get_footer(); ?>