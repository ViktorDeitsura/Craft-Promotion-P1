const customLogIn = function() {
    let phone = $("#phone").val();
    let email = $("#mail").val();
    let send  = $('#sendcode');
    let code  = $('#code').val();

    let postData = {phone, email, code};
    $.ajax({ 
        type: "POST", 
        url: "/php/ajax/auth.php", 
        data: postData,
        success: function(data) {
            location.reload(true);
        }
    });
};

let alertAnimation = false;
const onButRegistrationClick = function(params) {
    if ( alertAnimation ) {
        return;
    }
    $.ajax({ 
         type: "POST", 
         enctype: "multipart/form-data",
         processData: false,
         contentType: false,
         url: "/php/ajax/add-item.php", 

         data: new FormData($('#warrantyRegisterForm')[0]),
         success: function(data) {
            console.log(data);
            alertAnimation = true;
            $(".container-custom-alert").removeClass("dnone");
            $(".container-custom-alert").css("transition", ".3s");
            $(".container-custom-alert").css("opacity", ".8");
            if ( data.status ) {
                $(".container-custom-alert").css("background-color", "#51a351");
            } else {
                $(".container-custom-alert").css("background-color", "#bd362f");
            }
            $(".container-custom-alert__text").text(data.message);
            setTimeout(function() {
                $(".container-custom-alert").css("transition", "2s");
                $(".container-custom-alert").css("opacity", "0");
                setTimeout(function() {
                    if ( data.status ) {
                        location.reload(true);
                    } else {
                        alertAnimation = false;
                        $(".container-custom-alert").addClass("dnone");
                        $(".container-custom-alert").css("transition", ".3s");
                        $(".container-custom-alert").css("opacity", ".8");
                    }
                }, 2000);
            }, 3000);
         }
    });
};