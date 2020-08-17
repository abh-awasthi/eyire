// Select2 selectbox
$(function () {
    $(".search-select").select2({
        allowClear: true
    });
    
});

function addDistrict() {
    
    var state = $("#state").val();
    var district = $("#district").val();

    if (state === "") {
        $("#name-state").addClass("error");
        $("#name-state").removeClass('removeDisplay');

        return false;

    } else if (district === "") {
        $("#name-state").addClass("removeDisplay");
        $("#name-district").removeClass('removeDisplay');
        $("#name-district").addClass("error");

        return false;


    } else if (state !== "" && district !== "") {
        $("#name-state").addClass("removeDisplay");
        $("#name-district").addClass("removeDisplay");

        $.ajax({
            method: 'POST',
            url: 'http://eyrienidhi/master/processAddDistrict',
            data: {state: state, district:district},
            beforeSend: function () {
                
                $(".page-loader-wrapper").fadeIn();

            },
            success: function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status) {
                    $('.alert-success').removeClass('removeDisplay');
                    $(".alert-danger").addClass("removeDisplay");
                    //location.reload();
                } else {
                    $('.alert-success').addClass('removeDisplay');
                    $(".alert-danger").html(data.message);
                    $(".alert-danger").removeClass("removeDisplay");
                }
                
            },
            complete: function () {
                $(".page-loader-wrapper").fadeOut();
            }
        });
    }
}
