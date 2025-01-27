<?php
/*
Template Name: حل معما
*/

get_header();

echo '<section class="solve-challenge section dark-background">';
// بررسی اینکه آیا پست مربوط به دسته‌بندی story است
if (have_posts()) :
    while (have_posts()) : the_post();

        // بررسی اینکه پست در دسته‌بندی story قرار دارد
        if (in_category('story')) :

            $current_user_id = get_current_user_id();
            $premium_until = is_user_logged_in() ? get_user_meta($current_user_id, 'premium_expiry_date', true) : null;
            // گرفتن دسته‌بندی‌های پست
            $categories = get_the_category();
            $is_story = false;
            $is_product_story = false;

            foreach ($categories as $category) {
                if ($category->slug === 'story') {
                    $is_story = true;
                }
                if ($category->slug === 'productstoty') {
                    $is_product_story = true;
                }
            }

            // بررسی دسترسی کاربر
            $current_datetime = strtotime(current_time('mysql')); // تاریخ و زمان کنونی
            $premium_datetime = $premium_until ? strtotime($premium_until) : null;
            $has_access = false;

            if (!$is_product_story || !$is_story) {
                // اگر پست نیاز به پریمیوم نداشته باشد، دسترسی آزاد است
                $has_access = true;
            } elseif (is_user_logged_in()) {
                if (!empty($premium_datetime) && $premium_datetime >= $current_datetime) {
                    // کاربر دارای پریمیوم معتبر است
                    $has_access = true;
                }
            }

            if (!$has_access) :
?>
                    <br>
                    <br>
                    <br>
                    <br>
                    <br>
                    <div class="container story-single-template" style="padding: 20px; text-align: center;">
                        <h1 style="color: #ffc451;">این محتوا ویژه کاربران پریمیوم است</h1>
                        <br>
                        <p>برای دسترسی به این پست، لطفاً پلن پریمیوم تهیه کنید.</p>
                        <a href="<?php echo home_url('/plan'); ?>" class="btn btn-warning" style="padding: 10px 20px; margin-top: 20px; background-color: #ffc451; color: #000; text-decoration: none; border-radius: 5px;">
                            مشاهده پلن‌ها
                        </a>
                    </div>
                    <br>
                    <br>
                    <br>
            <?php
                // متوقف کردن نمایش محتوای دیگر
                break;
            endif;




            // خواندن فایل JSON
            $json_file = get_template_directory() . '/senario.json';
            $json_data = json_decode(file_get_contents($json_file), true);

            // یافتن داده‌های مرتبط با ID پست جاری
            $post_id = get_the_ID();
            $senarios = $json_data['senarios'];
            $current_senario = null;

            foreach ($senarios as $senario) {
                if (isset($senario[$post_id])) {
                    $current_senario = $senario[$post_id];
                    break;
                }
            }

            // تعداد آیتم‌ها در هر صفحه
            $items_per_page = 3;
            $total_items = $current_senario ? count($current_senario) : 0;
            $total_pages = ceil($total_items / $items_per_page);

            // گرفتن شماره صفحه از پارامتر `solve`
            $current_page = isset($_GET['solve']) ? max(1, intval($_GET['solve'])) : 1;
            $start_index = ($current_page - 1) * $items_per_page;
            $end_index = min($start_index + $items_per_page, $total_items);
            ?>
            <br>
            <br>
            <br>
            <div class="container">
                <h1 class="challenge-title"><?php the_title(); ?></h1>
                <p class="challenge-intro">سرنخ‌های مرتبط با این معما به ترتیب زیر ارائه شده‌اند:</p>

                <?php if ($current_senario) : ?>
                    <div class="clues">
                        <?php for ($i = $start_index; $i < $end_index; $i++) : ?>
                            <?php $item = $current_senario[$i]; ?>
                            <?php if (isset($item['text'])) : ?>
                                <div class="clue-text">
                                    <p style="text-align: center;"><?php echo esc_html($item['text']); ?></p>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($item['pic'])) : ?>
                                <div class="clue-pic">
                                    <img src="<?php echo esc_url(get_template_directory_uri() . '/' . $item['pic']); ?>" alt="سرنخ تصویری">
                                </div>
                            <?php endif; ?>

                            <?php if (isset($item['video'])) : ?>
                                <div class="clue-video">
                                    <video controls>
                                        <source src="<?php echo esc_url(get_template_directory_uri() . '/' . $item['video']); ?>" type="video/mp4">
                                        مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                                    </video>
                                </div>
                            <?php endif; ?>

                            <?php if (isset($item['audio'])) : ?>
                                <div class="clue-audio">
                                    <audio controls>
                                        <source src="<?php echo esc_url(get_template_directory_uri() . '/' . $item['audio']); ?>" type="audio/mpeg">
                                        مرورگر شما از پخش صوت پشتیبانی نمی‌کند.
                                    </audio>
                                </div>
                            <?php endif; ?>
                        <?php endfor; ?>
                    </div>

                    <!-- نمایش دکمه‌های صفحه‌بندی -->
                    <div class="pagination">
                        <?php if ($current_page > 1) : ?>
                            <a href="?solve=<?php echo $current_page - 1; ?>" class="pagination-prev">قبلی</a>
                        <?php endif; ?>

                        <?php if ($current_page < $total_pages) : ?>
                            <a href="?solve=<?php echo $current_page + 1; ?>" class="pagination-next">بعدی</a>
                        <?php endif; ?>
                    </div>
                <?php else : ?>
                    <p>هیچ سرنخی برای این معما در دسترس نیست.</p>
                <?php endif; ?>

                <h3>حدس شما:</h3>
                <form method="POST" action="" class="guess-form">
                    <input type="text" name="guess" placeholder="نام قاتل را وارد کنید..." required>
                    <button type="submit">ارسال حدس</button>
                </form>

                <?php
                // بررسی پاسخ کاربر
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['guess'])) {
                    $guess = sanitize_text_field($_POST['guess']);
                    $correct_answer = get_post_meta(get_the_ID(), 'correct_answer', true); // پاسخ صحیح
                    if (strtolower($guess) === strtolower($correct_answer)) {
                        echo "<p class='success-message'>تبریک! حدس شما صحیح است.</p>";
                    } else {
                        echo "<p class='error-message'>متاسفم، حدس شما اشتباه است.</p>";
                    }
                }
                ?>
            </div>
            </section>

            <style>
                .dark-background {
                    background-color: #121212;
                    color: #f0f0f0;
                    padding: 20px;
                }

                .challenge-title {
                    text-align: center;
                    color: #ffc451;
                    margin-bottom: 20px;
                }

                .challenge-intro {
                    text-align: center;
                    margin-bottom: 30px;
                }

                .clues {
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                }

                .clue-text p {
                    background-color: #333;
                    padding: 15px;
                    border-radius: 5px;
                }

                .clue-pic img {
                    max-width: 100%;
                    border: 3px solid #ffc451;
                    border-radius: 10px;
                }

                .clue-video video,
                .clue-audio audio {
                    width: 100%;
                    border: 3px solid #ffc451;
                    border-radius: 10px;
                }

                .pagination {
                    text-align: center;
                    margin-top: 20px;
                }

                .pagination a {
                    padding: 10px 20px;
                    margin: 0 5px;
                    text-decoration: none;
                    color: #000;
                    background-color: #ffc451;
                    border-radius: 5px;
                }

                .success-message {
                    color: green;
                    text-align: center;
                    margin-top: 20px;
                }

                .error-message {
                    color: red;
                    text-align: center;
                    margin-top: 20px;
                }
            </style>
<?php
        else :
            echo "<p>این صفحه مخصوص حل معماهای دسته‌بندی story است.</p>";
        endif;
    endwhile;
else :
    echo "<p>هیچ معمایی برای نمایش وجود ندارد.</p>";
endif;

get_footer();
