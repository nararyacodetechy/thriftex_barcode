<?php require_once('inc/header.php') ?>
    <div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout main-containers">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('inc/sidebar.php') ?>
            </div>
            <div class="col-md-9">
                <div class="card border-0">
                    <div class="card-body p-4">
                        <h4>Profile Toko</h4>
                        <form action="<?= base_url('profile/save') ?>" method="post" class="my_form mt-5" id="profile_save" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label for="nama_brand" class="col-sm-2 col-form-label">Nama Brand</label>
                                <div class="col-md-5">
                                    <input type="text" name="nama_brand" class="form-control p-3 nama_brand" id="nama_brand" required value="<?= (!empty($data_profile)) ? $data_profile->nama_brand :'' ?>" >
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="url_toko" class="col-sm-2 col-form-label">URL Toko</label>
                                <div class="col-md-5 position-relative">
                                    <input type="text" name="url_toko" class="form-control p-3 input_url_toko <?= (!empty($data_profile)) ? '' :'input_allow_url_toko' ?>" id="url_toko" required value="<?= (!empty($data_profile)) ? $data_profile->url_toko :'' ?>" <?= (!empty($data_profile)) ? 'disabled' :'' ?>>
                                    <div class="url_toko">thriftex.id/</div>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Deskripsi Profile</label>
                                <div class="col-md-7">
                                <textarea class="form-control p-3" id="deskripsi_profile" name="deskripsi_profile" rows="3"><?= (!empty($data_profile)) ? $data_profile->deskripsi_toko :'' ?></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-dark btn-lg rounded-3 ps-4 pe-4 profile_save" data-defaulttext="Simpan">Simpan</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('inc/footer.php') ?>