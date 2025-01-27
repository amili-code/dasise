<?php
$inDir = get_template_directory_uri();
get_header();

// تابع تبدیل تاریخ میلادی به شمسی


// گرفتن اطلاعات از سشن
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $_SESSION['selected_plan'] = array(
        'plan_id' => $_POST['plan_id'],
        'price' => $_POST['price'],
        'takh' => $_POST['takh'],
        'daye' => $_POST['daye'],
    );
}

// چک کردن اطلاعات سشن
$selected_plan = isset($_SESSION['selected_plan']) ? $_SESSION['selected_plan'] : null;

// اگر کاربر لاگین است و پلن انتخاب شده
if ($selected_plan && is_user_logged_in()) {
    $current_user_id = get_current_user_id();

    // تاریخ انقضا را بر اساس تعداد روز محاسبه کنید
    $expiry_date = date('Y-m-d H:i:s', strtotime("+{$selected_plan['daye']} days"));

    // ذخیره تاریخ انقضا در یوزرمتا
    update_user_meta($current_user_id, 'premium_expiry_date', $expiry_date);

    // تبدیل تاریخ انقضا به شمسی
    $expiry_date_jalali = convertToJalali($expiry_date);

    // پیامی برای اطلاع‌رسانی
    $confirmation_message = "پلن انتخابی شما با موفقیت فعال شد. دسترسی شما تا تاریخ <strong>{$expiry_date_jalali}</strong> معتبر است.";
}
?>

<section id="purchase" class="purchase section dark-background">
    <br>
    <br>
    <div class="container">
        <h1 style="text-align: center;">پرداخت</h1>
        <br>
        <br>
        <br>
        <?php if ($selected_plan): ?>
            <div class="plan-details">
                <h2>پلن انتخابی شما :<?= $selected_plan['daye']; ?> روزه </h2>
                <p>قیمت: <?php echo number_format($selected_plan['price']); ?> تومان</p>
                <p>تخفیف: <?php echo $selected_plan['takh']; ?>%</p>
                <p>قیمت نهایی: <?php echo number_format($selected_plan['price'] * (1 - $selected_plan['takh'] / 100)); ?> تومان</p>
                <br>
                <form method="POST">
                    <button type="submit" style="background: #ffc451; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px;">پرداخت</button>
                </form>
            </div>
        <?php else: ?>
            <p>هیچ پلنی انتخاب نشده است. لطفاً به <a href="<?php echo home_url('/plans'); ?>">صفحه پلن‌ها</a> بازگردید.</p>
        <?php endif; ?>

        <?php if (isset($confirmation_message)): ?>
            <p style="color: green; text-align: center;"><?php echo $confirmation_message; ?></p>
            <br>
            <a href="<?php echo home_url(); ?>" style="display: block; text-align: center; background: #0073aa; color: #fff; padding: 10px 20px; text-decoration: none; border-radius: 5px; width: 200px; margin: 0 auto;">بازگشت به صفحه اصلی</a>
        <?php endif; ?>
    </div>
</section>

<?= get_footer(); ?>