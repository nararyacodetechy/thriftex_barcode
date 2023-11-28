<?php require_once('inc/header.php') ?>
    <div class="container-xxl bd-gutter mt-3 my-md-4 bd-layout main-containers">
        <div class="row">
            <div class="col-md-3">
                <?php require_once('inc/sidebar.php') ?>
            </div>
            <div class="col-md-9">
                <div class="card border-0">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-end mb-4 d-none">
                            <a href="<?= base_url('barcode/new') ?>" class="btn btn-dark">Simpan</a>
                        </div>
                        <h4>Input data produk</h4>
                        <form action="<?= base_url('barcode/create') ?>" method="post" class="my_form mt-5" id="barcode_create">
                            <div class="mb-3 row">
                                <label for="nama_brand" class="col-sm-2 col-form-label">Nama Brand</label>
                                <div class="col-md-5">
                                    <input type="text" name="nama_brand" class="form-control p-3" id="nama_brand" required value="<?= (!empty($data_copy)) ? $data_copy->nama_brand :'' ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-md-7">
                                    <input type="text" name="nama_produk" class="form-control p-3" id="nama_produk" required value="<?= (!empty($data_copy)) ? $data_copy->nama_produk :'' ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jenis" class="col-sm-2 col-form-label">Jenis</label>
                                <div class="col-md-5">
                                    <input type="text" name="jenis" class="form-control p-3" id="jenis" required value="<?= (!empty($data_copy)) ? $data_copy->jenis :'' ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="cerita" class="col-md-2 col-form-label">Cerita</label>
                                <div class="col-md-10">
                                    <textarea class="form-control p-3" id="cerita" name="cerita" rows="3"><?= (!empty($data_copy)) ? $data_copy->cerita :'' ?></textarea>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="warna" class="col-sm-2 col-form-label">Warna</label>
                                <div class="col-md-4">
                                    <input type="text" name="warna" class="form-control p-3" id="warna" required value="<?= (!empty($data_copy)) ? $data_copy->warna :'' ?>">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="ukuran" class="col-sm-2 col-form-label">Ukuran</label>
                                <div class="col-md-8">
                                    <input type="text" name="ukuran" class="form-control p-3" id="ukuran" required value="<?= (!empty($data_copy)) ? $data_copy->ukuran :'' ?>">
                                </div>
                                <div class="col-md-2">
                                    <input type="number" name="ukuran_kode" class="form-control p-3" id="floatingInput" placeholder="" value="<?= generateRandomNumber(3) ?>" min="1" maxlength="3">
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="jumlah" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-md-5">
                                    <input type="text" name="jumlah" class="form-control p-3" id="jumlah" required value="<?= (!empty($data_copy)) ? $data_copy->jumlah :'' ?>">
                                </div>
                                <!-- <div class="col-md-3 d-none">
                                    <div class="form-floating mb-3">
                                        <input type="text" name="jumlah_kode" class="form-control p-3" id="floatingInput" placeholder="name@example.com">
                                        <label for="floatingInput">Kode</label>
                                    </div>
                                </div> -->
                            </div>
                            <!-- <div class="mb-3 row">
                                <label for="idd" class="col-sm-2 col-form-label">ID</label>
                                <div class="col-md-5">
                                    <input type="text" name="id" class="form-control p-3" id="idd" value="" disabled>
                                </div>
                            </div> -->
                            <div class="mb-3 row">
                                <div class="col-md-5">
                                    <button type="submit" class="btn btn-dark btn-lg rounded-3 ps-4 pe-4 barcode_create">Kirim</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('inc/footer.php') ?>