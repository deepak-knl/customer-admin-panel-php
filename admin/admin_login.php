<?php require_once('../layouts/header.php');
require_once('../auth.php');
restrictLoginRegisterAccess();
$message = '';
$success = $error = '';
if (isset($_SESSION['success_message'])) {
    $success = $_SESSION['success_message'];
    unset($_SESSION['success_message']);
}
if (isset($_SESSION['error_message'])) {
    $error = $_SESSION['error_message'];
    unset($_SESSION['error_message']);
}
?>
<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">

                        <?php if ($success): ?>
                            <div class="alert alert-success" role="alert">
                                <?= $success ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($error): ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $error ?>
                            </div>
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-5">
                                    <h4 class="text-center">User Login Here</h4>
                                </div>
                            </div>
                        </div>
                        <form id="userLoginForm">
                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3" id="mail">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="example@gmail.com">
                                        <label for="email" class="form-label">Email</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3" id="pass">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Login Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                    <a href="./admin_register.php" class="link-secondary text-decoration-none">Click here to Register</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../js/admin_login.js"></script>
<script>
    setTimeout(function() {
        const flashMessage = document.querySelector('.alert.alert-success');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 2000);
    setTimeout(function() {
        const flashMessage = document.querySelector('.alert.alert-danger');
        if (flashMessage) {
            flashMessage.style.display = 'none';
        }
    }, 2000);
</script>
<?php require_once('../layouts/footer.php') ?>