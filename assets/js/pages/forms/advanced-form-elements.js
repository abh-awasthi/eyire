// Select2 selectbox
var branchlist;
$(function () {
    $(".search-select").select2({
        allowClear: true
    });
    
});

$(function () {

    //Exportable table
    branchlist = $('.js-exportable').DataTable({
        dom: 'Bfrtip',
        processing: true, //Feature control the processing indicator.
        serverSide: true,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
            url: base_url + "master/getCurrentBranchList",
            type: "POST",
            data: {'getBranch': 'getBranch'}
        },
        //Set column definition initialisation properties.
        columnDefs: [
            {
                "targets": [0,1,2,3,4,5], //first column / numbering column
                "orderable": false //set not orderable
            }
        ],
//        "fnInitComplete": function (oSettings, response) {
//
////            $(".dataTables_filter").addClass("pull-right");
////            $("#total_req_quote").html('(<i>'+response.recordsFiltered+'</i>)').css({"font-size": "14px;", "color": "red","background-color":"#fff"});
//        }
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
            url: base_url+'master/processAddDistrict',
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
function ValidateEmail(mail) 
{
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail))
  {
    return (true)
  }
    
    return (false)
}

function addBranchEntry(branchID = "") {
    var district = $("#district").val();
    var branch_name = $("#branch_name").val();
    var contact_person = $("#contact_person").val();
    var mobile_number = $("#mobile_number").val();
    var email_id = $("#email_id").val();
    var credit_limit_amount = $("#credit_limit_amount").val();
    var branch_address = $("#branch_address").val();

    if (district === "") {
        $("#name-district").addClass("error");
        $("#name-district").removeClass("removeDisplay");
        return false;
    } else {
        $("#name-district").addClass("removeDisplay");
    }
    
    if (branch_name === "") {
        $("#name-branch-name").addClass("error");
        $("#name-branch-name").removeClass("removeDisplay");

        return false;

    } else{
        $("#name-branch-name").addClass("removeDisplay");
        
    } 
    if (contact_person === "") {
        $("#name-contact-person").addClass("error");
        $("#name-contact-person").removeClass("removeDisplay");

        return false;
    } else {
        $("#name-contact-person").addClass("removeDisplay");
    }
    
//    if (mobile_number === "") {
//        $("#name-mobile-number").addClass("error");
//        $("#name-mobile-number").removeClass("removeDisplay");
//
//        return false;
//    } else {
//        $("#name-mobile-number").addClass("removeDisplay");
//    }
//    
//    var pattern= "";
//    var result = mobile_number.match(/^[6-9]{1}[0-9]{9}$/);
//    if (result === null) {
//        $("#name-mobile-number").addClass("error");
//        $("#name-mobile-number").removeClass("removeDisplay");
//
//        return false;
//    } else {
//        $("#name-mobile-number").addClass("removeDisplay");
//    }
//    
//    if (email_id === "") {
//        $("#name-email-id").addClass("error");
//        $("#name-email-id").removeClass("removeDisplay");
//
//        return false;
//    } else {
//        $("#name-email-id").addClass("removeDisplay");
//    }
//    
//    var v = email_id.match(/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!\.)){0,61}[a-zA-Z0-9]?\.)+[a-zA-Z0-9](?:[a-zA-Z0-9\-](?!$)){0,61}[a-zA-Z0-9]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/);
//     if (v === null) {
//        $("#name-email-id").addClass("error");
//        $("#name-email-id").removeClass("removeDisplay");
//
//        return false;
//    }else {
//        $("#name-email-id").addClass("removeDisplay");
//    }
    if (credit_limit_amount === "") {
        $("#name-credit-limit-amount").addClass("error");
        $("#name-credit-limit-amount").removeClass("removeDisplay");

        return false;
    } else {
        $("#name-credit-limit-amount").addClass("removeDisplay");
    }
    
    if (branch_address === "") {
        $("#name-branch-address").addClass("error");
        $("#name-branch-address").removeClass("removeDisplay");

        return false;
    } else {
         $("#name-branch-address").addClass("removeDisplay");
    }
    
    if (credit_limit_amount !== "" && district !== "" && branch_address !=="" && email_id !=="" && mobile_number !=="" && contact_person !=="" && branch_name !=="") {
        $("#name-branch-address").addClass("removeDisplay");
        $("#name-credit-limit-amount").addClass("removeDisplay");
        $("#name-contact-person").addClass("removeDisplay");
        $("#name-branch-name").addClass("removeDisplay");
        $("#name-district").addClass("removeDisplay");
        
        var formData = new FormData(document.getElementById("addbranch"));
        formData.append("label", "WEBUPLOAD");
        if(branchID === ""){
            var url = base_url+'master/processAddBranch';
        } else {
            var url = base_url+'master/updateBranchEntry/'+branchID;
        }
        $.ajax({
            method: 'POST',
            url: url,
            data:formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                
                $(".page-loader-wrapper").fadeIn();

            },
            success: function (response) {
                console.log(response);
                var data = jQuery.parseJSON(response);
                if (data.status) {
                    $('.alert-success').removeClass('removeDisplay');
                    $(".alert-danger").addClass("removeDisplay");
                    document.getElementById("addbranch").reset();
                    //location.reload();
                } else {
                    $('.alert-success').addClass('removeDisplay');
                    $(".alert-danger").html(data.message);
                    $(".alert-danger").removeClass("removeDisplay");
                }
                
            },
            complete: function () {
                $(".page-loader-wrapper").fadeOut();
                branchlist.ajax.reload(null, false);
            }
        });
    }
}

