$(document).ready(function () {
    // $("form").attr('autocomplete', 'off');
    let logged_in = sessionStorage.getItem("is_logged_in");
    if (logged_in == "yes") {
        $("#login-form-container").hide();
        $("#admin-container").show();
    }
    
    $("#login-form").submit(function (event) {
        $(".form-group").removeClass("is-invalid");
        $(".form-control").removeClass("is-invalid");
        $(".invalid-feedback").remove();

        var searchParameters = {
            loginID: $("#loginID").val(),
            password: $("#password").val(),
        };

        $("#login-btn").prop("disabled", true);

        $.ajax({
            type: "POST",
            url: "scripts/php/auth.php",
            data: searchParameters,
            dataType: "json",
            encode: true,
        })
            .done(function (response) {
                if (!response.success) {
                    $("#login-btn").removeAttr('disabled');
                    if (response.errors.loginID) {
                        $("#loginID").addClass("is-invalid");
                        $("#loginID-field").append(
                            '<div class="invalid-feedback d-block">' + response.errors.loginID + "</div>"
                        );
                    }

                    if (response.errors.password) {
                        $("#password").addClass("is-invalid");
                        $("#password-field").append(
                            '<div class="invalid-feedback d-block">' + response.errors.password + "</div>"
                        );
                    }
                    $("#admin-container").hide();
                } else {
                    $("#login-btn").removeAttr('disabled');
                    swal({
                        icon: "success",
                        title: response.message,
                    }).then(() => {
                        // sessionStorage.setItem("is_logged_in", true)
                        // window.location.assign("sap-registration-admin.php")
                        $("#login-form-container").hide();
                        $("#admin-container").show();
                        sessionStorage.setItem("is_logged_in", "yes");
                    });
                }
            })
            .fail(function (response) {
                $("#login-btn").removeAttr('disabled');
                $("#msg").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later.\
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>\
                </div>'
                );
            });

        event.preventDefault();
    });
})