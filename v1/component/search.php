<div class="mb-4 input-group justify-content-center" style="max-width: 500px; margin: 0 auto;"> <!-- Centering the search box -->
    <form class="row" role="search" method="get" id="searchform" action="<?php echo get_search_query(true); ?>">
        <div class="col-10 p-0">
            <input type="search" class="form-control" placeholder="جستجو..." name="s" aria-label="Search" style="border-radius:0 0.5rem  0.5rem 0;">
        </div>
        <div class="col-2 p-0">
            <button class="btn btn-warning" type="submit" style="border-radius:  0.5rem 0 0 0.5rem ;">
                <i class="fas fa-search"></i> <!-- آیکون جستجو -->
            </button>
        </div>
    </form>
</div>








<style>
    /* Change text color on hover without affecting the border */
    .form-control:hover {
        color: #ffcc00;
        /* Change to your desired hover text color */
        border-color: inherit;
        /* Keep the border color unchanged */
    }

    /* Keep the input style consistent when typing */
    .form-control:focus {
        color: inherit;
        /* Keep text color the same */
        border-color: inherit;
        /* Keep border color the same */
        box-shadow: none;
        /* Remove box shadow on focus */
    }
</style>

<!-- ایکون سرچ باکس که بعدا باید دانلود بشه و در چوشه استس ذخیره بشه -->
<!-- اضافه کردن Font Awesome برای آیکون -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">