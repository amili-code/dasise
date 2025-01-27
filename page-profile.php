<?php
session_start();
$inDir = get_template_directory_uri();
get_header();

$current_user = wp_get_current_user();
$user_id = $current_user->ID;

if (!is_user_logged_in()) {
    wp_redirect("/dasise/login");
    exit;
}

// مدیریت خطاها
function handle_php_error($errno, $errstr, $errfile, $errline)
{
    $_SESSION['php_error'] = "مشکلی رخ داده است، لطفاً صفحه را ریلود کنید.";
}
set_error_handler('handle_php_error');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (isset($_FILES['profile_picture']['name']) && !empty($_FILES['profile_picture']['name'])) {
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            $uploaded_file = wp_handle_upload($_FILES['profile_picture'], ['test_form' => false]);
            if (isset($uploaded_file['url'])) {
                update_user_meta($user_id, 'profile_picture', esc_url($uploaded_file['url']));
            }
        }

        if (isset($_POST['remove_profile_picture'])) {
            delete_user_meta($user_id, 'profile_picture');
        }

        if (isset($_POST['update_username'])) {
            $new_username = sanitize_text_field($_POST['username']);
            if (!empty($new_username) && $new_username !== $current_user->user_login) {
                wp_update_user(['ID' => $user_id, 'user_login' => $new_username]);
            }
        }

        wp_redirect(get_permalink());
        exit;
    } catch (Exception $e) {
        $_SESSION['php_error'] = "مشکلی رخ داده است، لطفاً صفحه را ریلود کنید.";
    }
}

$profile_picture = get_user_meta($user_id, 'profile_picture', true) ?: "$inDir/assets/img/default-avatar.png";
$challenges = get_user_meta($user_id, 'challenges', true);
?>

<!-- بخش نمایش مودال خطا -->
<?php if (!empty($_SESSION['php_error'])): ?>
    <div id="errorModal" class="modal">
        <div class="modal-content">
            <p><?= esc_html($_SESSION['php_error']); ?></p>
            <button id="reloadPage" class="btn btn-yellow">ریلود صفحه</button>
        </div>
    </div>
    <?php unset($_SESSION['php_error']); ?>
<?php endif; ?>

<section id="profile" class="profile section dark-background">
    <br>
    <br>
    <div class="container">
        <h1 style="text-align: center; color: #ffc451;">پروفایل کاربری</h1>
        <br>
        <br>
        <div class="row">
            <!-- قسمت عکس و تغییر نام کاربری -->
            <div class="col-lg-6" style="display: flex; flex-direction: column; align-items: center;">
                <form method="POST" enctype="multipart/form-data" id="profileForm" style="text-align: center;">
                    <div class="drag-drop" id="drag-drop-area">
                        <img src="<?= esc_url($profile_picture); ?>" alt="Profile Picture" id="profile-preview" style="width: 150px; height: 150px; border-radius: 50%; margin-bottom: 10px;">
                        <input type="file" name="profile_picture" id="profile_picture" style="display: none;">
                        <button type="button" id="upload-trigger" class="btn btn-yellow">آپلود عکس</button>
                        <?php if ($profile_picture !== "$inDir/assets/img/default-avatar.png"): ?>
                            <button type="submit" name="remove_profile_picture" class="btn btn-red">حذف عکس</button>
                        <?php endif; ?>
                    </div>
                </form>
                <hr>
                <form method="POST">
                    <label for="username" style="color: white;">نام کاربری:</label>
                    <input type="text" name="username" value="<?= esc_html($current_user->user_login); ?>" style="margin-bottom: 10px; background-color: #333; color: white; border: 1px solid #444; padding: 5px; border-radius: 5px;">
                    <button type="submit" name="update_username" class="btn btn-yellow">ذخیره نام کاربری</button>
                </form>
            </div>

            <!-- قسمت معماهای حل‌شده -->
            <div class="col-lg-6">
                <h3 style="color: #ffc451;">معماهای حل‌شده:</h3>
                <?php if (!empty($challenges) && is_array($challenges)): ?>
                    <ul style="list-style: none; padding: 0;">
                        <?php foreach ($challenges as $challenge): ?>
                            <li style="background: #ffc451; color: black; padding: 10px; margin-bottom: 5px; border-radius: 5px;"><?= esc_html($challenge); ?></li>
                        <?php endforeach; ?>
                    </ul>
                <?php else: ?>
                    <p style="color: white;">هیچ معمایی شروع نشده است.</p>
                <?php endif; ?>
            </div>
        </div>
        <hr>
        <div style="text-align: center;">
            <button id="changePasswordBtn" class="btn btn-yellow" style="display: inline-block; width: 45%; margin: 10px;">تغییر رمز</button>
            <button id="logoutBtn" class="btn btn-red" style="display: inline-block; width: 45%; margin: 10px;">خروج از حساب</button>
        </div>
    </div>
</section>

<!-- مودال‌ها -->
<div id="passwordModal" class="modal">
    <div class="modal-content">
        <h3>تغییر رمز عبور</h3>
        <form method="POST" id="passwordForm">
            <label>رمز عبور فعلی:</label>
            <input type="password" name="current_password" required><br><br>
            <label>رمز عبور جدید:</label>
            <input type="password" name="new_password" required><br><br>
            <label>تکرار رمز جدید:</label>
            <input type="password" name="confirm_password" required><br><br>
            <button type="submit" class="btn btn-yellow">ذخیره</button>
        </form>
        <button class="btn btn-gray" id="closePasswordModal">لغو</button>
    </div>
</div>

<div id="logoutModal" class="modal">
    <div class="modal-content">
        <p>آیا مطمئن هستید که می‌خواهید از حساب خود خارج شوید؟</p>
        <a class="btn btn-red" href="<?= wp_logout_url(home_url('/')); ?>">خروج</a>
        <button class="btn btn-gray" id="cancelLogout">لغو</button>
    </div>
</div>

<script>
    const reloadButton = document.getElementById('reloadPage');
    if (reloadButton) {
        reloadButton.addEventListener('click', () => location.reload());
    }

    const errorModal = document.getElementById('errorModal');
    if (errorModal) {
        errorModal.style.display = 'block';
    }

    const dragDropArea = document.getElementById('drag-drop-area');
    dragDropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dragDropArea.style.borderColor = 'yellow';
    });
    dragDropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        const file = e.dataTransfer.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById('profile-preview').src = event.target.result;
            };
            reader.readAsDataURL(file);
            const formData = new FormData();
            formData.append('profile_picture', file);
            fetch('<?= get_permalink(); ?>', {
                method: 'POST',
                body: formData,
            }).then(() => location.reload());
        }
    });

    const passwordModal = document.getElementById('passwordModal');
    document.getElementById('changePasswordBtn').addEventListener('click', () => passwordModal.style.display = 'block');
    document.getElementById('closePasswordModal').addEventListener('click', () => passwordModal.style.display = 'none');

    const logoutModal = document.getElementById('logoutModal');
    document.getElementById('logoutBtn').addEventListener('click', () => logoutModal.style.display = 'block');
    document.getElementById('cancelLogout').addEventListener('click', () => logoutModal.style.display = 'none');
</script>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
    }

    .modal-content {
        background: black;
        margin: 15% auto;
        padding: 20px;
        border-radius: 10px;
        color: white;
        width: 300px;
        text-align: center;
    }

    .btn {
        border-radius: 5px;
        padding: 10px 20px;
        font-size: 14px;
        cursor: pointer;
        margin: 5px;
        display: inline-block;
        text-align: center;
        border: none;
    }

    .btn-yellow {
        background-color: #ffc451;
        color: black;
    }

    .btn-red {
        background-color: red;
        color: white;
    }

    .btn-gray {
        background-color: #6c757d;
        color: white;
    }

    .drag-drop {
        text-align: center;
    }

    #drag-drop-area {
        border: 2px dashed #ffc451;
        padding: 20px;
        border-radius: 10px;
        transition: border-color 0.3s;
    }
</style>

<?php
get_footer();
