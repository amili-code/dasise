<?php
$inDir = get_template_directory_uri();
get_header();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $results = []; // ذخیره اطلاعات هر سوال
    $total_score = 0;
    $num_questions = 0;
    $correct_answers = 0; // شمارش پاسخ‌های درست

    foreach ($_POST as $key => $value) {
        if (strpos($key, 'answer_') === 0) {
            $post_id = str_replace('answer_', '', $key);
            $user_answer = sanitize_text_field($value);
            $true_answer = sanitize_text_field($_POST['true_' . $post_id]);

            // ارزیابی پاسخ با شباهت
            $similarity = evaluate_answer_with_persian_support($user_answer, $true_answer);

            // محاسبه نمره
            $total_score += $similarity;
            $num_questions++;

            // تعیین وضعیت پاسخ (درست یا غلط)
            $is_correct = $similarity >= 0.5; // شباهت بیش از 50% درست محسوب می‌شود
            if ($is_correct) {
                $correct_answers++;
            }

            // ذخیره جزئیات سوال
            $results[] = [
                'question' => get_the_title($post_id),
                'user_answer' => $user_answer,
                'true_answer' => $true_answer,
                'similarity' => round($similarity * 100) . '%',
                'is_correct' => $is_correct,
            ];
        }
    }

    // محاسبه نمره نهایی
    $final_score = $num_questions > 0 ? ($total_score / $num_questions) * 100 : 0;

    // محاسبه درصد درست
    $accuracy_percentage = $num_questions > 0 ? ($correct_answers / $num_questions) * 100 : 0;
}
?>

<section id="results" class="results section dark-background">
    <br>
    <br>
    <h1 style="text-align: center; color: #ffc451;">نتایج آزمون شما</h1>
    <?php if (isset($final_score)): ?>
        <p style="text-align: center;display: none;">نمره نهایی شما: <?php echo round($final_score); ?>%</p>
        <h4 style="text-align: center;">درصد پاسخ‌های درست: <span style="color: #ffc451;"><?php echo round($accuracy_percentage); ?>%</span></h4>
        <hr>
        <h2 style="text-align: center;">جزئیات سوالات</h2>
        <div style="padding: 2rem;">
            <?php foreach ($results as $result): ?>
                <div style="border: 2px solid #ffc451; border-radius: 5px; padding: 1rem; margin: 1rem;">
                    <h3><?php echo esc_html($result['question']); ?></h3>
                    <br>
                    <p>پاسخ شما: <strong style="color: #adb5bd;"><?php echo esc_html($result['user_answer']); ?></strong></p>
                    <p>پاسخ صحیح: <strong style="color: #ffc451;"><?php echo esc_html($result['true_answer']); ?></strong></p>
                    <p style="display: none;">میزان درستی: <strong><?php echo esc_html($result['similarity']); ?></strong></p>
                    <?php if ($result['is_correct']): ?>
                        <h5 style="color: green;text-align: center;"><strong>جواب شما درست است!</strong></h5>
                    <?php else: ?>
                        <h5 style="color: red;text-align: center;"><strong>باید دقت بیشتری می‌کردید.</strong></h5>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <a href="/dasise/exam">بازگشت به صفحه ی ازمون</a>
        </div>
    <?php endif; ?>
</section>

<?php
get_footer();
?>