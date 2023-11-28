<?php require_once('inc/header.php') ?>
    <div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout main-containers">
        <div class="row justify-content-center align-items-center">
            <div class="col-12 col-md-5">
                <div class="card bg-white border-0">
                    <div class="card-body p-4">
                        <form method="post" action="<?= base_url('auth/login') ?>" id="authform">
                            <h1>Login</h1>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" name="email" class="form-control" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <button type="submit" class="btn btn-dark rounded-0 auth-btn">login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('inc/footer.php') ?>