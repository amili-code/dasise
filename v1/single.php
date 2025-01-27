<?php
get_header(); // بارگذاری هدر قالب
if (have_posts()) :
    while (have_posts()) : the_post();
        $lvl = get_post_meta(get_the_ID(), 'lvl', true);
        $old = get_post_meta(get_the_ID(), 'old', true);
        $about = get_post_meta(get_the_ID(), 'about', true);
?>
        <div style="background-color: black;">
            <div class="container py-5">
                <h1 class="text-center mb-4" style="color: aliceblue;"><?php the_title(); ?></h1>
                <div class="story-details">
                    <div class="story-image">
                        <?php if (has_post_thumbnail()) : ?>
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="img-fluid" />
                        <?php else : ?>
                            <img src="https://via.placeholder.com/250x150" alt="No Image" class="img-fluid" />
                        <?php endif; ?>
                    </div>
                    <div class="story-meta mt-4" style="color: aliceblue;">
                        <p><strong>سطح:</strong> <?php echo esc_html($lvl); ?></p>
                        <p><strong>مناسب برای سن:</strong> <?php echo esc_html($old); ?> سال به بالا</p>
                        <p><strong>درباره:</strong> <?php echo esc_html($about); ?></p>
                    </div>
                    <div class="story-content mt-4">
                        <?php the_content(); // محتوای پست 
                        ?>
                    </div>
                </div>
                <button>شروع کردن</button>
            </div>
        </div>

<?php
    endwhile;
else :
    echo '<p>هیچ معمایی یافت نشد.</p>';
endif;
get_footer(); // بارگذاری فوتر قالب
