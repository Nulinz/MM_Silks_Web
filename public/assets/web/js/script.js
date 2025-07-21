// Contact Number / Age Validation / Pincode Validation / Year Validation / Aadhar Validation
function validate_contact(input) {
    const value = input.value;

    if (value.length > 10) {
        input.value = value.slice(0, 10);
    }
}
function validate_age(input) {
    const value = input.value;

    if (value.length > 3) {
        input.value = value.slice(0, 3);
    }
}
function validate_pincode(input) {
    const value = input.value;

    if (value.length > 6) {
        input.value = value.slice(0, 6);
    }
}
function validate_year(input) {
    const value = input.value;

    if (value.length > 4) {
        input.value = value.slice(0, 4);
    }
}
function validate_aadhar(input) {
    const value = input.value;

    if (value.length > 12) {
        input.value = value.slice(0, 12);
    }
}

// Password Functionality
function togglePasswordVisibility(inputId, showId, hideId) {
    let $input = $("#" + inputId);
    let $passShow = $("#" + showId);
    let $passHide = $("#" + hideId);

    if ($input.attr("type") === "password") {
        $input.attr("type", "text");
        $passShow.hide();
        $passHide.show();
    } else {
        $input.attr("type", "password");
        $passShow.show();
        $passHide.hide();
    }
}

/* <script>
    $(document).ready(function () {
        $('#sub').on('click', function (e) {
            // e.preventDefault();
            toastr.success('Form Submitted', '', {
                positionClass: 'toast-top-right',
                progressBar: true,
                hideDuration: 300,
                timeOut: 3000,
                showEasing: "swing",
                hideEasing: "swing",
                showMethod: "fadeIn",
                hideMethod: "fadeOut",
            });
        });
    });
</script> */
