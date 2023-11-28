$(document).ready(function(){

    $(document).on('submit','#authform', function(e){
        e.preventDefault(0);
        var btn = $(this).find('.auth-btn');
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
                const spinerloading = 'Login';
                btn.html(spinerloading);
                
                var data = jQuery.parseJSON(response);
                if (data.status == true) {
                    window.location.href = data.redirect_url;
                } else {
                    // $('.notif_login').html('<i class="fa fa-times me-3"></i>'+data.msg).css('width','max-content');
                }
            },
            error: function(xhr, status, error) {
                btn.attr('disabled', false);
                const spinerloading = 'Login';
                btn.html(spinerloading);
            }
        });
        // form.ajaxSubmit({
        //     url: form.attr("action"),
        //     success: function(response, status, xhr, $form) {
                
        //         // var data = jQuery.parseJSON(response);
        //         // if (data.status == true) {
        //         //     window.location.href = data.redirect_url;
        //         //     // setTimeout(function() {
        //         //     // }, 1000);
        //         // } else {
        //         //     var toastID = document.getElementById('notiflogin');
        //         //     toastID = new bootstrap.Toast(toastID);
        //         //     toastID.show();
        //         //     // if(typeof data.msg === "object" && !Array.isArray(data.msg) && data.msg !== null){
        //         //     //     console.log(data.msg);
        //         //     // }
        //         //     $('.notif_login').html('<i class="fa fa-times me-3"></i>'+data.msg).css('width','max-content');
        //         // }
        //     },
        //     error : function(response){
        //         // console.log(response);
        //         btn.attr('disabled', false);
        //         const spinerloading = 'Login';
        //         btn.html(spinerloading);
        //     }
        // });
    })

})