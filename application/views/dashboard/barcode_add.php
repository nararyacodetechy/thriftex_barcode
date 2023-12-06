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
                        <?php if(!empty($data_profile)){ ?>
                        <form action="<?= base_url('barcode/create') ?>" method="post" class="my_form mt-5" id="barcode_create" enctype="multipart/form-data">
                            <div class="mb-3 row">
                                <label for="nama_brand" class="col-sm-2 col-form-label">Nama Brand</label>
                                <div class="col-md-5">
                                    <input type="text" name="nama_brand" class="form-control p-3" id="nama_brand" required value="<?= $data_profile->nama_brand ?>" disabled>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Nama Produk</label>
                                <div class="col-md-7">
                                    <input type="text" name="nama_produk" class="form-control p-3" id="nama_produk" required value="<?= (!empty($data_copy)) ? $data_copy->nama_produk :'' ?>">
                                </div>
                            </div>
                            <!-- <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                                <div class="col-md-7">
                                    <div class="picker_image_produk d-flex row g-3"></div>
                                </div>
                            </div> -->

                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Foto Produk</label>
                                <div class="col-md-7 d-flex row">
                                    <div class="list_image_foto_produk row">
                                        <div class="col-6 col-lg-4 mb-2 button-add-images-fp">
                                            <div class="upload-image-multi upload-btn-wrapper" data-max="3" >
                                                <button class="btn">
                                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M15 5.5H18.5M18.5 5.5H22M18.5 5.5V9M18.5 5.5V2" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 10.8717 2 9.87835 2.02008 9M12 2C7.28595 2 4.92893 2 3.46447 3.46447C3.03965 3.88929 2.73806 4.38921 2.52396 5" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    <p>Foto</p>
                                                </button>
                                                <input type="file" name="file" class="fotoimg chosefile" data-type="foto_produk" accept="capture=camera,image/*">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="nama_produk" class="col-sm-2 col-form-label">Look Book</label>
                                <div class="col-md-7 d-flex row">
                                    <div class="list_image_lookbook row">
                                        <div class="col-6 col-lg-4 mb-2 button-add-images">
                                            <div class="upload-image-multi upload-btn-wrapper" data-max="3">
                                                <button class="btn">
                                                    <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M2 12.5001L3.75159 10.9675C4.66286 10.1702 6.03628 10.2159 6.89249 11.0721L11.1822 15.3618C11.8694 16.0491 12.9512 16.1428 13.7464 15.5839L14.0446 15.3744C15.1888 14.5702 16.7369 14.6634 17.7765 15.599L21 18.5001" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M15 5.5H18.5M18.5 5.5H22M18.5 5.5V9M18.5 5.5V2" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                        <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 10.8717 2 9.87835 2.02008 9M12 2C7.28595 2 4.92893 2 3.46447 3.46447C3.03965 3.88929 2.73806 4.38921 2.52396 5" stroke="#000000" stroke-width="1.5" stroke-linecap="round"/>
                                                    </svg>
                                                    <p>Foto</p>
                                                </button>
                                                <input type="file" name="file" class="fotoimg chosefile" data-type="lookbook" accept="capture=camera,image/*">
                                            </div>
                                        </div>
                                    </div>
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
                                    <button type="submit" class="btn btn-dark btn-lg rounded-3 ps-4 pe-4 barcode_create" data-defaulttext="Kirim" >Kirim</button>
                                </div>
                            </div>
                        </form>
                        <?php }else{ ?>
                            <div class="alert alert-warning">Mohon Lengkapi data profile dahulu!</div>
                            <a href="<?= base_url('profile') ?>" class="btn btn-sm btn-dark">Lengkapi Profile</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('inc/footer.php') ?>