<?php
$inDir = get_template_directory_uri();
get_header();

// Query to get posts from category 'story'
$category = isset($_GET['category']) ? sanitize_text_field($_GET['category']) : 'story';
$search = isset($_GET['search']) ? sanitize_text_field($_GET['search']) : '';
$args = array(
    'category_name' => $category,
    's' => $search,
    'posts_per_page' => -1
);
$query = new WP_Query($args);
?>

<section id="challenges" class="challenges section dark-background">
    <br>
    <br>
    <div class="container" data-aos="fade-up" data-aos-delay="100">
        <h1 style="text-align: center;">معماها</h1>
        <br>
        <div class="" style="text-align: center; margin-bottom: 20px; padding: 20px; border-radius: 10px; box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.4); max-width: 600px; margin: 0 auto;">
            <form method="get" class="filter-form" style="display: flex; flex-wrap: wrap; gap: 10px; justify-content: center;">

                <div class="filter-group" style="display: flex; flex: 1; gap: 10px; justify-content: center;position: relative;top: 20px;">
                    <select name="category" class="form-select"
                        onchange="this.form.submit()"
                        style="height: 45px; padding: 0 10px; background-color: #000; color: #ffc451; border: 1px solid #ffc451; border-radius: 5px; flex: 1; box-sizing: border-box; -webkit-appearance: none; -moz-appearance: none; appearance: none;">
                        <option value="story" <?php echo $category === 'story' ? 'selected' : ''; ?>>همه</option>
                        <option value="productStoty" <?php echo $category === 'productStoty' ? 'selected' : ''; ?>>پریمیوم</option>
                        <option value="freeStory" <?php echo $category === 'freeStory' ? 'selected' : ''; ?>>رایگان</option>
                    </select>
                </div>
                <br>
                <div class="filter-group" style="display: flex; flex: 1; gap: 10px; justify-content: center; margin-top: 20px;">
                    <input type="text" name="search" placeholder="جستجویا..." value="<?php echo esc_attr($search); ?>"
                        class="form-control"
                        style="height: 45px; padding: 0 10px; background-color: #000; color: #ffc451; border: 1px solid #ffc451; border-radius: 5px; flex: 1; box-sizing: border-box;">

                    <button type="submit" class="btn btn-warning"
                        style="height: 45px; padding: 0 20px; background-color: #ffc451; color: #000; border: none; border-radius: 5px; margin: 0 10px; box-sizing: border-box;">
                        جستجو
                    </button>
                </div>

            </form>
        </div>
    </div>




    <br>

    <div class="container">
        <div class="row gy-4">
            <?php if ($query->have_posts()) : ?>
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <?php
                    $about_text = get_post_meta(get_the_ID(), 'about', true);
                    $categories = get_the_category();
                    $is_premium = false;
                    foreach ($categories as $category_item) {
                        if ($category_item->slug === 'productstoty') {
                            $is_premium = true;
                            break;
                        }
                    }
                    ?>

                    <div class="col-lg-3 col-md-3" data-aos="fade-up" data-aos-delay="100">
                        <a href="<?php the_permalink(); ?>" style="text-decoration: none;">
                            <div class="card position-relative" style="overflow: hidden; text-align: center; border: 2px solid #ffc451;">
                                <div class="card-image" style="position: relative;">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="img-fluid" style="width: 100%; height: auto;">
                                    <?php endif; ?>
                                    <div class="card-title" style="position: absolute; bottom: 10px; left: 50%; transform: translateX(-50%); color: white; background: rgba(0, 0, 0, 0.5); padding: 5px 10px; width: 100%;">
                                        <?php the_title(); ?>
                                    </div>
                                </div>
                                <div class="card-hover-content" style="display: none; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); color: white; padding: 20px; text-align: center; color: #ffc451; font-size: small;">
                                    <p><?php echo esc_html($about_text); ?></p>
                                </div>
                                <?php if ($is_premium) : ?>
                                    <div class="premium-badge" style="position: absolute; top: 10px; right: 10px; color: #ffc451; font-size: xx-large;">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>


                    <script>
                        document.querySelectorAll('.card').forEach(card => {
                            card.addEventListener('mouseover', () => {
                                card.querySelector('.card-hover-content').style.display = 'block';
                            });
                            card.addEventListener('mouseout', () => {
                                card.querySelector('.card-hover-content').style.display = 'none';
                            });
                        });
                    </script>
                <?php endwhile; ?>
                <?php wp_reset_postdata(); ?>
            <?php else : ?>
                <p style="text-align: center;">هیچ پستی یافت نشد.</p>
            <?php endif; ?>
        </div>
    </div>
    </div>
</section>

<?= get_footer(); ?>