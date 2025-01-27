<?php
if (isset($_GET['solve']) && in_array($_GET['solve'], range(1, 7))) {
    // دریافت اطلاعات پست جاری
    global $post;

    if ($post) {
        // نام پست (slug) را دریافت کنید
        $post_slug = $post->post_name;

        // مسیر فایل دینامیک بر اساس نام پست
        $template_file = get_template_directory() . '/single-' . $post_slug . '.php';

        // بررسی وجود فایل و اینکلود آن
        if (file_exists($template_file)) {
            include $template_file;
            exit;
        } else {
            // اگر فایل وجود نداشت، پیغام خطا نمایش دهید یا فایل پیش‌فرض را اینکلود کنید
            echo '<section id="challenges" class="challenges section dark-background"><br><br><br><br><br><br><h1 style="text-align:center">این معما در حال طراحی است</h1><br><br><h2 style="text-align:center;"><a href="/dasise/challenges" >بازگشت</a></h2><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br></section>';
            exit;
        }
    }
}
?>

<?php
get_header();

?>

<section id="challenges" class="challenges section dark-background">
    <br>
    <br>

    <?php
    if (have_posts()) :
        while (have_posts()) :
            the_post();

            // بررسی وضعیت کاربر
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
                <div class="container story-single-template" style="padding: 20px; text-align: center; color: white; background-color: black;">
                    <h1 style="color: #ffc451;">این محتوا ویژه کاربران پریمیوم است</h1>
                    <br>
                    <p>برای دسترسی به این پست، لطفاً پلن پریمیوم تهیه کنید.</p>
                    <a href="<?php echo home_url('/plan'); ?>" class="btn btn-warning" style="padding: 10px 20px; margin-top: 20px; background-color: #ffc451; color: #000; text-decoration: none; border-radius: 5px;">
                        مشاهده پلن‌ها
                    </a>
                </div>
            <?php
                // متوقف کردن نمایش محتوای دیگر
                break;
            endif;

            // متای پست
            $about = get_post_meta(get_the_ID(), 'about', true); // اگر فیلد متای 'about' دارید
            $compabout = get_post_meta(get_the_ID(), 'compabout', true); // اگر فیلد متای 'about' دارید

            // مسیر ویدیو
            $post_id = get_the_ID();
            // echo $post_id;
            $demo_video_path_mov = get_template_directory_uri() . "/demo/{$post_id}.mov";
            $demo_video_path_mp4 = get_template_directory_uri() . "/demo/{$post_id}.mp4";
            $video_url = null;

            // بررسی وجود فایل ویدیو
            if (@file_get_contents($demo_video_path_mov)) {
                $video_url = $demo_video_path_mov;
            } elseif (@file_get_contents($demo_video_path_mp4)) {
                $video_url = $demo_video_path_mp4;
            }
            ?>
            <div class="container story-single-template" style="padding: 20px;">
                <h1 style="text-align: center; color: #ffc451;"><?php the_title(); ?></h1>
                <div class="post-media" style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; margin: 20px 0;">
                    <div class="post-thumbnail" style="flex: 1; text-align: center; margin-bottom: 20px;">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>" class="img-fluid" style="border: 2px solid #ffc451; border-radius: 10px; max-width: 100%;">
                        <?php endif; ?>
                    </div>
                    <div class="post-demo" style="flex: 1; text-align: center; padding: 10px; ">
                        <?php if ($video_url) : ?>
                            <h3 style="color: #ffc451;">دمو</h3>
                            <video controls style="width: 100%; border: 2px solid #ffc451; border-radius: 10px;">
                                <source src="<?php echo $video_url; ?>" type="video/mp4">
                                مرورگر شما از پخش ویدیو پشتیبانی نمی‌کند.
                            </video>
                        <?php else : ?>
                            <p style="color: #ffc451;">ویدیوی دمویی برای این پست وجود ندارد.</p>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="post-about" style="color: white; padding: 15px; background-color: #000; border-radius: 10px;">
                    <h3 style="color: #ffc451;">درباره معما:</h3>
                    <p><?php echo esc_html($about); ?></p>
                </div>
                <div class="post-content" style="color: white; margin-top: 20px;">
                    <?php the_content(); ?>
                </div>
                <div class="post-meta" style="margin-top: 20px;color: #ffc451;text-align: center;">
                    <span>تاریخ انتشار: <?php echo convertToJalali(get_the_date()); ?></span>
                    <?php
                    $views = get_post_meta(get_the_ID(), 'postview', true);
                    $views = $views ? intval($views) : 0;
                    echo '<div style="color: #ffc451;"><i class="fas fa-eye"></i> ' . $views . ' بازدید</div>';
                    ?>
                    <hr>
                    <button class="start-challenge-btn" data-challenge-title="<?php the_title(); ?>" style="text-align: center; border: 2px solid #ffc451; border-radius: 5px; color: #ffc451; background-color: #000; padding: 1rem;">
                        شروع <?php the_title(); ?>
                    </button>
                </div>
            </div>
    <?php
        endwhile;
    endif;
    ?>
</section>

<style>
    /* استایل برای نمایش زیر عکس در حالت موبایل */
    @media (max-width: 768px) {
        .post-media {
            flex-direction: column;
        }

        .post-demo {
            margin-top: 20px;
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.start-challenge-btn');

        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const challengeTitle = button.getAttribute('data-challenge-title');

                // ارسال درخواست AJAX
                fetch('<?php echo admin_url('admin-ajax.php'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: new URLSearchParams({
                            action: 'start_challenge',
                            challenge_title: challengeTitle,
                        }),
                    })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // alert('معما به لیست شما اضافه شد!');
                            // انتقال به صفحه حل معما
                            window.location.href = "<?php echo get_permalink(); ?>?solve=1";
                        } else {
                            alert(data.data.message || 'خطایی رخ داده است.');
                        }
                    })
                    .catch(() => {
                        alert('خطایی در ارتباط با سرور رخ داد.');
                    });
            });
        });
    });
</script>
<?php
get_footer();
