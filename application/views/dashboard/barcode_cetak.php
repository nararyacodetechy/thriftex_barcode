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
                        <div class="d-flex justify-content-between">
                            <a href="<?= base_url('barcode') ?>" class="btn btn-sm btn-danger"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<rect width="24" height="24" fill="transparant"/>
<path d="M18 12L6 12M6 12L11 17M6 12L11 7" stroke="#ffffff" stroke-linecap="round" stroke-linejoin="round"/>
</svg> Kembali</a>
                            <h4>Cetak Barcode</h4>
                            <a href="<?= base_url('barcode/download/'.$id_barcode) ?>" class="btn btn-dark"><svg width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3 15C3 17.8284 3 19.2426 3.87868 20.1213C4.75736 21 6.17157 21 9 21H15C17.8284 21 19.2426 21 20.1213 20.1213C21 19.2426 21 17.8284 21 15" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M12 3V16M12 16L16 11.625M12 16L8 11.625" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg> Download QR Code</a>
                        </div>
                        <div class="row list_images_qrcode mt-4">
                            <?php
                            echo $status_barcode;
                            // var_dump($data_barcode);
                            foreach ($data_barcode as $key => $value) {
                                $path_parts = pathinfo($value->file_name);
                                $file_without_extension = $path_parts['filename'];
                                
                                echo '<div class="col-md-2 d-flex justify-content-center align-items-center flex-column">';
                                echo '<img src="'.base_url('qr/'.$value->file_name).'" alt="">';
                                echo '<p>'.$file_without_extension.'</p>';
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php require_once('inc/footer.php') ?>