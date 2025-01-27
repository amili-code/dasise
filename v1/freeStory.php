<style>
    .card-container {
        display: flex;
        overflow: hidden;
        gap: 10px;
        padding: 10px;
        position: relative;
        direction: rtl;
    }

    .scrolling {
        display: flex;
        gap: 10px;
        animation: slide-right 10s linear infinite;
        /* انیمیشن حرکت */
    }

    @keyframes slide-right {
        from {
            transform: translateX(0);
        }

        to {
            transform: translateX(-100%);
        }
    }

    .card {
        position: relative;
        width: 250px;
        height: 350px;
        overflow: hidden;
        border: 1px solid #ccc;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease-in-out;
    }

    .card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .card-body {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
    }

    .card-title {
        font-size: 20px;
        font-weight: bold;
        margin: 0;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
    }

    .card-about {
        font-size: 14px;
        color: #ddd;
        margin-top: 10px;
        text-align: center;
    }

    .card:hover .card-body {
        opacity: 1;
    }

    .top-left-button,
    .top-right-button {
        position: absolute;
        top: 10px;
        padding: 5px 10px;
        font-size: 12px;
        color: #fff;
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    .top-left-button {
        left: 10px;
    }

    .top-right-button {
        right: 10px;
    }

    .card-link {
        text-decoration: none;
        color: inherit;
    }
</style>


<div class="py-5" style="background-color: black;">
    <h1 class="text-center mb-4" style="color: #fff;text-shadow: 0px 0px 10px #ccc;">داستان‌های رایگان</h1>
    <div class="card-container">
        <div class="scrolling">
            <?php
            $args = array(
                'post_type'      => 'post',
                'category_name'  => 'freeStory',
                'posts_per_page' => -1
            );
            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
                    $lvl = get_post_meta(get_the_ID(), 'lvl', true);
                    $old = get_post_meta(get_the_ID(), 'old', true);
                    $about = get_post_meta(get_the_ID(), 'about', true);
            ?>
                    <div class="card">
                        <a href="<?php the_permalink(); ?>" class="card-link">
                            <?php if (has_post_thumbnail()) : ?>
                                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                            <?php else : ?>
                                <img src="https://via.placeholder.com/250x150" alt="No Image">
                            <?php endif; ?>

                            <button class="top-left-button" style="
                                <?php
                                if ($lvl === 'ساده') echo 'background-color: #007bff;';
                                elseif ($lvl === 'متوسط') echo 'background-color: #FB815D;';
                                elseif ($lvl === 'سخت') echo 'background-color: red;';
                                ?>">
                                <?php echo esc_html($lvl); ?>
                            </button>

                            <?php if ($old >= 18) : ?>
                                <button class="top-right-button" style="background-color: #FB815D;">
                                    <?php echo esc_html($old); ?>
                                </button>
                            <?php endif; ?>

                            <div class="card-body">
                                <h5 class="card-title"><?php the_title(); ?></h5>
                                <?php if (!empty($about)) : ?>
                                    <p class="card-about"><?php echo esc_html($about); ?></p>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>هیچ داستان رایگانی پیدا نشد.</p>';
            endif;
            ?>
        </div>
    </div>
</div>