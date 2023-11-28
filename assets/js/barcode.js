$(document).ready(function(){
    var notifikasi_toast = function(target,color,msg){
        target.find('.toast_alert_container').remove();
        var el_notif = `<div aria-live="polite" aria-atomic="true" class="bg-dark position-relative toast_alert_container">
                            <div class="toast-container position-fixed start-50 translate-middle-x" id="toastPlacement" style="top:10%">
                                <div class="toast notifikasi-alert align-items-center text-bg-${color} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                                    <div class="d-flex">
                                        <div class="toast-body">
                                            ${msg}
                                        </div>
                                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
                        </div>`;
        target.prepend(el_notif);
        $('.notifikasi-alert').toast('show');
    }

    $(document).on('submit','#barcode_create', function(e){
        e.preventDefault(0);
        var btn = $(this).find('.barcode_create');
        var form = $(this);
        btn.attr('disabled', true);
        const spinerloading = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
        btn.html(spinerloading);

        $.ajax({
            url: form.attr("action"),
            type: 'POST',
            data: form.serialize(),
            success: function(response) {
                btn.attr('disabled', false);
                const spinerloading = 'Kirim';
                btn.html(spinerloading);
                
                var data = jQuery.parseJSON(response);
                notifikasi_toast($(document).find('.main-containers'),data.color,data.msg);
                $('#barcode_create')[0].reset();
                if (data.status == true) {
                    setTimeout(() => {
                        window.location.href = data.redirect_url;
                    }, 500);
                } else {
                    // $('.notif_Kirim').html('<i class="fa fa-times me-3"></i>'+data.msg).css('width','max-content');
                }
            },
            error: function(xhr, status, error) {
                btn.attr('disabled', false);
                const spinerloading = 'Kirim';
                btn.html(spinerloading);
            }
        });
       
    })

})