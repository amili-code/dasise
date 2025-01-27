<?php

add_action("init", function () {
    register_nav_menus([
        "header" => "Header Menu",
        "footer" => "Footer Menu"
    ]);
});

// فعال‌سازی تصویر بندانگشتی برای پست‌ها
function mytheme_setup()
{
    add_theme_support('post-thumbnails'); // فعال‌سازی تصویر بندانگشتی
}
add_action('after_setup_theme', 'mytheme_setup');


// این فیلتر برای اضافه کردن کلاس به <li>
add_filter('nav_menu_css_class', function ($classes, $item) {
    $classes[] = 'nav-item m-2'; // اضافه کردن کلاس nav-item
    return $classes;
}, 10, 2);

// این فیلتر برای اضافه کردن کلاس به <a>
add_filter('nav_menu_link_attributes', function ($atts, $item) {
    $atts['class'] = 'nav-link'; // اضافه کردن کلاس nav-link
    return $atts;
}, 10, 2);


class Custom_Nav_Walker extends Walker_Nav_Menu
{
    // شروع سطح اول UL
    function start_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $class = $depth > 0 ? 'dropdown-menu' : 'dropdown-menu';
        $output .= "\n$indent<ul class=\"$class\">\n";
    }

    // پایان سطح UL
    function end_lvl(&$output, $depth = 0, $args = null)
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    // شروع هر آیتم منو
    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
    {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;

        // کلاس‌های سفارشی برای Dropdown
        if (in_array('menu-item-has-children', $classes)) {
            $classes[] = 'dropdown';
        }

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        // تگ <li>
        $output .= $indent . '<li' . $class_names . '>';

        // لینک منو
        $atts = array();
        $atts['href'] = !empty($item->url) ? $item->url : '';
        $atts['class'] = 'nav-link';
        if ($depth == 0 && in_array('menu-item-has-children', $classes)) {
            $atts['class'] .= ' dropdown-toggle';
        }

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value)) {
                $attributes .= ' ' . $attr . '="' . esc_attr($value) . '"';
            }
        }

        // عنوان لینک
        $title = apply_filters('the_title', $item->title, $item->ID);

        // HTML خروجی
        $item_output = $args->before;
        $item_output .= '<a' . $attributes . '>';
        $item_output .= $args->link_before . $title . $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    // پایان هر آیتم منو
    function end_el(&$output, $item, $depth = 0, $args = null)
    {
        $output .= "</li>\n";
    }
}


function custom_user_roles()
{
    add_role(
        'subscriber_user',
        'Subscriber User',
        array(
            'read' => true,
        )
    );

    add_role(
        'premium_user',
        'Premium User',
        array(
            'read' => true,
            'access_premium_content' => true, // توانایی دسترسی به محتواهای خاص
        )
    );
}
add_action('init', 'custom_user_roles');


function set_user_meta_on_registration($user_id)
{
    // تنظیم مقادیر پیش‌فرض
    update_user_meta($user_id, 'riddles_solved', 0); // تعداد معماهای حل‌شده
    update_user_meta($user_id, 'accuracy', '0%');    // درصد دقت
    update_user_meta($user_id, 'scenarios_proposed', 0); // تعداد سناریوهای پیشنهادی
    update_user_meta($user_id, 'premium_until', 'بدون پریمیوم'); // وضعیت پریمیوم
}
add_action('user_register', 'set_user_meta_on_registration');

function getDollarToTomanRate()
{
    // کلید برای کش
    $transient_key = 'dollar_to_toman_rate';
    $transient_expiration = 30 * MINUTE_IN_SECONDS; // مدت زمان کش (نیم ساعت)

    // بررسی کش
    $cached_rate = get_transient($transient_key);
    if ($cached_rate !== false) {
        return $cached_rate; // بازگشت نرخ از کش
    }

    // URL صفحه‌ای که نرخ دلار را نمایش می‌دهد
    $url = "https://www.tgju.org/profile/price_dollar_rl";

    // دریافت محتوای صفحه
    $html = @file_get_contents($url);

    if ($html === false) {
        return null; // در صورت خطا
    }

    // استخراج نرخ دلار با Regex
    $regex = '/<span data-col="info.last_trade.PDrCotVal">([\d,]+)<\/span>/';
    if (preg_match($regex, $html, $matches)) {
        // تبدیل نرخ به عدد صحیح
        $rate = intval(str_replace(",", "", $matches[1]));

        // ذخیره در کش
        set_transient($transient_key, $rate, $transient_expiration);

        return $rate;
    }

    return null; // در صورت عدم یافتن نرخ
}



function convertToJalali($gregorianDate)
{
    $gDate = explode('-', date('Y-m-d', strtotime($gregorianDate))); // تاریخ میلادی به صورت آرایه
    $gYear = $gDate[0];
    $gMonth = $gDate[1];
    $gDay = $gDate[2];

    $d_4 = $gYear % 4;
    $g_a = array(0, 31, 59, 90, 120, 151, 181, 212, 243, 273, 304, 334);
    $doy_g = $g_a[$gMonth - 1] + $gDay;
    if ($d_4 == 0 && $gMonth > 2) $doy_g++;

    $doy_j = ($gYear - 621) % 4 == 0 ? ($doy_g - 79) : ($doy_g - 80);
    if ($doy_j <= 0) {
        $doy_j += 365;
        $jYear = $gYear - 622;
    } else {
        $jYear = $gYear - 621;
    }

    if ($doy_j <= 186) {
        $jMonth = ceil($doy_j / 31);
        $jDay = $doy_j % 31 == 0 ? 31 : $doy_j % 31;
    } else {
        $jMonth = ceil(($doy_j - 186) / 30) + 6;
        $jDay = ($doy_j - 186) % 30 == 0 ? 30 : ($doy_j - 186) % 30;
    }

    return sprintf('%04d/%02d/%02d', $jYear, $jMonth, $jDay);
}

function enqueue_custom_scripts()
{
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/custom.js', array('jquery'), null, true);

    wp_localize_script('custom-js', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

function start_challenge_callback()
{
    if (!is_user_logged_in()) {
        wp_send_json_error('شما وارد سایت نشده‌اید.');
    }

    $user_id = get_current_user_id();
    $challenge_title = sanitize_text_field($_POST['challenge_title']);

    // افزودن عنوان معما به user_meta
    $current_challenges = get_user_meta($user_id, 'challenges', true);
    if (empty($current_challenges)) {
        $current_challenges = array();
    }

    if (!in_array($challenge_title, $current_challenges)) {
        $current_challenges[] = $challenge_title;
        update_user_meta($user_id, 'challenges', $current_challenges);
    }

    wp_send_json_success();
}
add_action('wp_ajax_start_challenge', 'start_challenge_callback');

function increment_post_view($post_id)
{
    // مقدار فعلی بازدید را دریافت کنید
    $views = get_post_meta($post_id, 'postview', true);

    if ($views === '' || $views === false) {
        // اگر فیلد وجود نداشت، مقدار اولیه 0 را تنظیم کنید
        $views = 0;
        update_post_meta($post_id, 'postview', $views); // ایجاد فیلد
    }

    // افزایش مقدار بازدید
    $views++;

    // ذخیره مقدار جدید
    update_post_meta($post_id, 'postview', $views);
}

function track_post_views()
{
    if (is_single()) {
        $post_id = get_the_ID();
        increment_post_view($post_id);
    }
}

add_action('template_redirect', 'track_post_views');



// ذخیره معما در متای کاربر
add_action('wp_ajax_start_challenge', 'save_challenge_for_user');
function save_challenge_for_user()
{
    // چک کردن اینکه کاربر لاگین است
    if (!is_user_logged_in()) {
        wp_send_json_error(['message' => 'ابتدا باید وارد حساب کاربری شوید.']);
    }

    // گرفتن نام معما از درخواست
    $challenge_title = isset($_POST['challenge_title']) ? sanitize_text_field($_POST['challenge_title']) : null;

    if (!$challenge_title) {
        wp_send_json_error(['message' => 'نام معما ارسال نشده است.']);
    }

    $user_id = get_current_user_id();

    // گرفتن معماهای فعلی از متای کاربر
    $challenges = get_user_meta($user_id, 'challenges', true);
    if (!$challenges || !is_array($challenges)) {
        $challenges = [];
    }

    // اضافه کردن معما به لیست (در صورت عدم وجود)
    if (!in_array($challenge_title, $challenges)) {
        $challenges[] = $challenge_title;
        update_user_meta($user_id, 'challenges', $challenges);
    }

    wp_send_json_success(['message' => 'معما با موفقیت ثبت شد.']);
}


function enqueue_swiper_assets_combined()
{
    $inDir = get_template_directory_uri();
    $style = $inDir . '/assets/vendor/swiper/swiper-bundle.min.css';
    $scripte = $inDir . '/assets/vendor/swiper/swiper-bundle.min.js';
    wp_enqueue_style('swiper-css', $style);
    wp_enqueue_script('swiper-js', $scripte, [], null, true);

    // اسکریپت پیکربندی Swiper
    wp_add_inline_script('swiper-js', "
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
                init: function () {
                    console.log('Swiper initialized');
                },
                slideChange: function () {
                    console.log('Slide changed to: ', this.activeIndex);
                }
            }
        });
    });
");
}
add_action('wp_enqueue_scripts', 'enqueue_swiper_assets_combined');



// افزودن منوی مدیریت پیام‌ها به پنل ادمین
add_action('admin_menu', 'custom_messages_menu');

function custom_messages_menu()
{
    add_menu_page(
        'مدیریت پیام‌ها', // عنوان صفحه
        'پیام‌های کاربران', // عنوان منو
        'manage_options', // سطح دسترسی
        'user-messages', // اسلاگ منو
        'display_user_messages', // تابع نمایش محتوا
        'dashicons-email', // آیکون منو
        6 // موقعیت منو
    );
}

// نمایش پیام‌های کاربران در پنل مدیریت
function display_user_messages()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_messages';

    // بررسی و پردازش فرم تأیید پیام
    if (isset($_POST['approve_message']) && isset($_POST['message_id'])) {
        check_admin_referer('approve_message_nonce'); // امنیت

        $message_id = intval($_POST['message_id']);
        $updated = $wpdb->update($table_name, ['is_approved' => 1], ['id' => $message_id]);

        if ($updated === false) {
            echo '<div class="error"><p>خطا در تأیید پیام.</p></div>';
        } else {
            echo '<div class="updated"><p>پیام با موفقیت تأیید شد.</p></div>';
        }
    }

    // دریافت پیام‌ها از پایگاه داده
    $messages = $wpdb->get_results("SELECT * FROM $table_name");

    // نمایش پیام‌ها در جدول
    echo '<h1>مدیریت پیام‌های کاربران</h1>';
    echo '<table class="widefat fixed">';
    echo '<thead><tr><th>شناسه</th><th>پیام</th><th>تأیید</th></tr></thead>';
    echo '<tbody>';

    if (!empty($messages)) {
        foreach ($messages as $message) {
            echo '<tr>';
            echo '<td>' . esc_html($message->id) . '</td>';
            echo '<td>' . esc_html($message->message) . '</td>';
            echo '<td>';
            if (!$message->is_approved) {
                echo '<form method="post">';
                wp_nonce_field('approve_message_nonce'); // امنیت
                echo '<input type="hidden" name="message_id" value="' . esc_attr($message->id) . '">';
                echo '<button type="submit" name="approve_message">تأیید</button>';
                echo '</form>';
            } else {
                echo 'تأیید شده';
            }
            echo '</td>';
            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="3">هیچ پیامی یافت نشد.</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';
}

// نمایش پیام‌های تأییدشده در قسمت فرانت‌اند
add_shortcode('approved_messages', 'display_approved_messages');

function display_approved_messages()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'user_messages';
    // دریافت پیام‌های تایید شده
    $messages = $wpdb->get_results("SELECT message FROM $table_name WHERE is_approved = 1;");

  if (!empty($messages)) {
    $output = '';
    $counter = 0; // شمارنده برای تعیین موقعیت پیام

    foreach ($messages as $message) {
        // تغییر رنگ متن بر اساس مقدار شمارنده
        $textColor = ($counter % 2 === 0) ? 'rgb(255, 208, 113)' : '#ffc451';

        $output .= '<div class="message-item" style="background-color: #1a1a1a; border-radius: 10px; padding: 20px; width: 300px; color: ' . $textColor . ';">';
        $output .= '<p style="text-align: center; font-size: 18px; line-height: 1.5; font-weight: bold;">' . esc_html($message->message) . '</p>';
        $output .= '</div>';

        $counter++; // افزایش شمارنده
    }
} else {
    $output = '<p style="text-align: center; color: #666; font-size: 16px;">هیچ پیامی برای نمایش وجود ندارد.</p>';
}


    return $output;
}


// افزودن منوی مدیریت سناریوها
add_action('admin_menu', 'custom_scenarios_menu');
function custom_scenarios_menu()
{
    add_menu_page(
        'مدیریت سناریوها',
        'سناریوهای کاربران',
        'manage_options',
        'user-scenarios',
        'display_user_scenarios',
        'dashicons-welcome-write-blog',
        6
    );
}

// نمایش سناریوها در پنل مدیریت
function display_user_scenarios()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'scenarios';

    $scenarios = $wpdb->get_results("
        SELECT s.id, s.scenario_text, s.created_at, u.user_login 
        FROM $table_name AS s
        LEFT JOIN {$wpdb->prefix}users AS u ON s.user_id = u.ID
    ");

    echo '<h1>مدیریت سناریوهای کاربران</h1>';
    echo '<table class="widefat fixed">';
    echo '<thead><tr><th>شناسه</th><th>کاربر</th><th>متن سناریو</th><th>تاریخ ارسال</th></tr></thead>';
    echo '<tbody>';
    foreach ($scenarios as $scenario) {
        echo '<tr>';
        echo '<td>' . esc_html($scenario->id) . '</td>';
        echo '<td>' . ($scenario->user_login ? esc_html($scenario->user_login) : 'کاربر مهمان') . '</td>';
        echo '<td>' . esc_html($scenario->scenario_text) . '</td>';
        echo '<td>' . esc_html($scenario->created_at) . '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>';
}




function calculate_similarity($user_answer, $true_answer)
{
    similar_text($user_answer, $true_answer, $percent);
    return $percent / 100; // بازگشت شباهت به صورت درصد
}

function evaluate_answer_via_api($user_answer, $true_answer) {
    $api_url = 'https://api-inference.huggingface.co/models/facebook/bart-large-mnli';
    $headers = [
        'Authorization: Bearer YOUR_API_KEY', // کلید API خود را اینجا قرار دهید
        'Content-Type: application/json',
    ];
    $data = json_encode([
        'inputs' => [
            'premise' => $true_answer,
            'hypothesis' => $user_answer,
        ],
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $response_data = json_decode($response, true);
        // فرض می‌کنیم similarity_score در پاسخ API وجود دارد
        return isset($response_data['similarity_score']) ? $response_data['similarity_score'] : 0;
    }

    return 0; // در صورت خطا، شباهت صفر باز
}
function evaluate_answer_via_datamuse($user_answer, $true_answer)
{
    $api_url = 'https://api.datamuse.com/words?ml=' . urlencode($true_answer);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    if ($response) {
        $response_data = json_decode($response, true);

        // بررسی وجود داده‌ها در پاسخ
        if (!empty($response_data)) {
            $similar_words = array_column($response_data, 'word');

            // محاسبه میزان شباهت
            similar_text($user_answer, implode(' ', $similar_words), $percent);
            return $percent / 100; // تبدیل به درصد
        }
    }

    return 0; // در صورت خطا، شباهت صفر بازگردانده می‌شود
}



function evaluate_answer_with_persian_support($user_answer, $true_answer)
{
    // حذف فاصله‌ها و نرمال‌سازی
    $user_answer = preg_replace('/\s+/u', ' ', trim($user_answer));
    $true_answer = preg_replace('/\s+/u', ' ', trim($true_answer));

    similar_text($user_answer, $true_answer, $percent);
    return $percent / 100;
}
function remove_title_length_limit($data, $postarr)
{
    // بررسی اگر عنوان خالی است
    if (isset($data['post_title'])) {
        $data['post_title'] = wp_strip_all_tags($data['post_title']); // پاک‌سازی ورودی
    }

    return $data;
}
add_filter('wp_insert_post_data', 'remove_title_length_limit', 10, 2);
