<br /><br /><br /><br />
<div class="container text-center">
    <div class="row">
        <h3>هر کسی یک مدلی دوست داره...</h3>        
        <br>
        <h4 style="color: gray;">تو هم مدلت رو انتخاب کن:</h4>
    </div>
</div>
<br />

<div class="container text-center">
    <div class="row row-cols-7 justify-content-center"> <!-- اضافه کردن کلاس justify-content-center -->
    <?php
    // آرگومان‌ها برای دریافت پست‌ها با کتگوری "watch"
    $args = array(
        'category_name' => 'watch', // نام کتگوری
        'posts_per_page' => -1, // تعداد بی‌نهایت
    );

    // اجرای کوئری
    $watch_posts = new WP_Query($args);

    // بررسی وجود پست‌ها
    if ($watch_posts->have_posts()) {
        // حلقه برای نمایش تصاویر و عناوین
        while ($watch_posts->have_posts()) {
            $watch_posts->the_post();
            $img_url = get_the_post_thumbnail_url(get_the_ID(), 'full'); // دریافت URL تصویر بندانگشتی
            $post_title = get_the_title(); // دریافت عنوان پست

            // اگر تصویر وجود داشت
            if ($img_url) {
                echo '<div class="card col-1 m-2" style="width: 8rem; border:none;">'; // تغییر col-1 به col-3 برای نمایش بهتر
                echo '<img class="card-img-top" src="' . esc_url($img_url) . '" alt="' . esc_attr($post_title) . '">';
                echo '<div class="card-body">';
                // echo '<h5 class="card-title">' . esc_html($post_title) . '</h5>'; // نمایش عنوان پست
                echo '<p class="card-text">' . get_the_excerpt() . '</p>'; // یا می‌توانید از get_the_content() استفاده کنید
                echo '</div>';
                echo '</div>';
            } else {
                echo '<p>هیچ تصویری برای این پست وجود ندارد.</p>'; // نمایش پیام در صورت عدم وجود تصویر
            }
        }

        // بازنشانی کوئری
        wp_reset_postdata();
    } else {
        echo '<p>پستی در این کتگوری یافت نشد.</p>';
    }
    ?>
    </div>
</div>
<br />
<br />
<br />
