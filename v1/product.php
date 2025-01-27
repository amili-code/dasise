<br /><br /><br /><br />
<div class="container text-center">
    <h2>
        <span style="color:#FF7700;">آخرین</span>
        محصولات
    </h2>
</div>
<br />
<div class="container" style="text-align: center;">
    <div style="display: flex; justify-content: center; flex-wrap: wrap;"> <!-- تغییرات در این خط -->
    
    <?php
        // آرگومان‌ها برای دریافت پست‌ها با کتگوری "product"
        $args = array(
            'category_name' => 'product', // نام کتگوری
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

                // دریافت کاستوم فیلدها
                $custom_field_1 = get_post_meta(get_the_ID(), 'price', true);
                $custom_field_2 = get_post_meta(get_the_ID(), 'discount', true);

                // اگر تصویر وجود داشت
                if ($img_url) {
                    echo '<div class="card col-3 m-3" style="width: 18rem;">'; // تغییر col-1 به col-3 برای نمایش بهتر
                    echo '<img class="card-img-top"  src="' . esc_url($img_url) . '" alt="' . esc_attr($post_title) . '">';
                    echo '<br><h5 class="card-title" style="color:gray;margin-bottom: 0;">' . esc_html($post_title) . '</h5>'; // نمایش عنوان پست
                    echo '<div class="card-body" style="text-align:center;">'; // اصلاح این خط
                    echo '<p class="card-text">' . get_the_excerpt() . '</p>'; // یا می‌توانید از get_the_content() استفاده کنید

                    // نمایش کاستوم فیلدها
                    if ($custom_field_1) {
                        echo '<del class="custom-field" style="color:gray;">' . esc_html($custom_field_1) . '</del>';
                    }
                    if ($custom_field_2) {
                        echo '<p class="custom-field" style="color:#FF7700">' . (esc_html($custom_field_1)*(100 - esc_html($custom_field_2)))/ 100 . '</p>';
                    }

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
</div>
