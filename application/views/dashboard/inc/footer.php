<script type="text/javascript">
<?php $site_data = [ 'base_url' => base_url() ]; ?>
var site_data = <?php echo json_encode($site_data); ?>;
</script>
<script src="<?= get_template_directory_asst('','assets/jquery-3.6.4.min.js') ?>"></script>
<script src="<?= get_template_directory_asst('','assets/bootstrap/js/popper.min.js') ?>"></script>
<script src="<?= get_template_directory_asst('','assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?= get_template_directory_asst('','assets/js/barcode.js') ?>"></script>
<script src="<?= get_template_directory_asst('','assets/js/auth.js') ?>"></script>
</body>
</html>