<?php
get_header();

if (in_category('story')) {
    // بررسی اگر پست در دسته‌بندی story است
    include get_template_directory() . '/single-category-story.php';
    exit; // جلوگیری از ادامه اجرای کد در single.php
}

// کد پیش‌فرض برای سایر پست‌ها
if (have_posts()) :
    while (have_posts()) : the_post();
        the_title('<h1>', '</h1>');
        the_content();
    endwhile;
endif;

get_footer();
?>
