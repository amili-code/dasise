<?php
$inDir = get_template_directory_uri();
get_header();

?>

<section id="about" class="about section dark-background">
    <br>
    <br>
    <h1 style="text-align: center;color: #ffc451;">مهارت بدون سرعت فایده نداره که ؛ سرعت هم بدون دقت</h1>
    <br>
    <hr>
    <div style="padding: 1.5rem;">
        <form id="exam-form" method="post" action="<?php echo esc_url(site_url('/results/')); ?>">
            <?php
            $args = array(
                'post_type' => 'post',
                'category_name' => 'testexam',
                'posts_per_page' => 3,
                'orderby' => 'rand',
            );
            $query = new WP_Query($args);
            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $true_answer = get_post_meta(get_the_ID(), 'true', true);
            ?>
                    <div class="question" style="border: 3px solid #ffc451;border-radius: 5px;padding: 1rem;margin: 2rem;">
                        <h5><?php the_title(); ?></h5>
                        <input type="text" name="answer_<?php echo get_the_ID(); ?>" style="width: 100%;height: 3rem;color: black;background-color: #adb5bd;border-radius: 5px;padding: .5rem;" placeholder="پاسخ شما">
                        <input type="hidden" name="true_<?php echo get_the_ID(); ?>" value="<?php echo esc_attr($true_answer); ?>">
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
            <div style="padding: 1rem;text-align: center;">
                <button type="submit" style="width: 90%;height: 3rem;background-color: #ffc451;border: none;color: black; border-radius: 5px;">ارسال پاسخ‌ها</button>
            </div>
        </form>

    </div>
</section>






<?= get_footer(); ?>