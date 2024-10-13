<?php require_once('../layouts/header.php'); ?>
<section class="p-3 p-md-4 p-xl-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                <div class="card border border-light-subtle rounded-4">
                    <div class="card-body p-3 p-md-4 p-xl-5">
                        <div class="row">
                            <div class="alert alert-danger d-none"  role="alert">
                            </div>
                            <div class="col-12">
                                <div class="mb-5">
                                    <h4 class="text-center">Customer Registration Here</h4>
                                </div>
                            </div>
                        </div>
                        <form id="customerRegisterForm">
                            <div class="row gy-3 overflow-hidden">
                                <div class="col-12">
                                    <div class="form-floating mb-3" id="ph">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="012345678901">
                                        <label for="phone" class="form-label">Phone Number</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3" id="pass">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                                        <label for="password" class="form-label">Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating mb-3" id="cpass">
                                        <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm Password">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-grid">
                                        <button class="btn bsb-btn-xl btn-primary py-3" type="submit">Register Now</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr class="mt-5 mb-4 border-secondary-subtle">
                                <div class="d-flex gap-2 gap-md-4 flex-column flex-md-row justify-content-center">
                                    <a href="./customer_login.php" class="link-secondary text-decoration-none">Click here to login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="../js/customer_register.js"></script>
<?php require_once('../layouts/footer.php'); ?>