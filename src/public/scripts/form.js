$(document).ready(function () {
    $("form").attr('autocomplete', 'off');
    $("#registration-form").submit(function (event) {
        register();
    });

    $("#program-creation-form").submit(function (event) {
        $(".form-group").removeClass("is-invalid");
        $(".form-control").removeClass("is-invalid");
        $(".form-select").removeClass("is-invalid");
        $(".invalid-feedback").remove();

        var formData = {
            name: ($("#name").val().length == 0 ? "" : $("#name").val()),
        };

        $("#add-program-btn").prop('disabled', true);
        $.ajax({
            type: "POST",
            url: "scripts/php/create_programs.php",
            data: formData,
            dataType: "json",
            encode: true,
        })
            .done(function (data) {
                $("#add-program-btn").removeAttr('disabled');
                if (!data.success) {
                    if (data.errors.name) {
                        $("#name").addClass("is-invalid");
                        $("#name-field").append(
                            '<div class="invalid-feedback d-block">' + data.errors.name + "</div>"
                        );
                    }
                    if (data.errors.sqlerrors) {
                        $("#name").addClass("is-invalid");
                        toastr.error(data.errors.sqlerrors, "Error!");
                    }
                } else {
                    toastr.success(data.message, "Success!");
                    $('#program-creation-form')[0].reset();
                }
            })
            .fail(function (data) {
                $("#add-program-btn").removeAttr('disabled');
                $("#msg").html(
                    '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
                );
            });

        event.preventDefault();
    });
});

function displayMemberChurchLocationFields() {
    let church_member_val = $("#church_member").val();
    if (church_member_val.toUpperCase() == 'yes'.toUpperCase()) {
        $("#churchNameField").hide()
        $("#memberChurchLocationFields").show()
    } else if (church_member_val.toUpperCase() == 'no'.toUpperCase()) {
        $("#memberChurchLocationFields").hide()
        $("#churchNameField").show()
    }
}

function displayArrErrorMsgs(value) {
    toastr.error(value, "Failed!");
}

function toggleProgramStatus(id, status) {
    $(".form-group").removeClass("is-invalid");
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    var formData = {
        id: id,
        status: status,
    };

    $.ajax({
        type: "POST",
        url: "scripts/php/toggle_program_status.php",
        data: formData,
        dataType: "json",
        encode: true,
    })
        .done(function (data) {
            if (!data.success) {
                data.errors.map(displayArrErrorMsgs)
            } else {
                toastr.success(data.message, "Success!");
                if (status == true) {
                    $(`#status-${id}`).html('<span class="btn btn-sm btn-primary">Opened</span>');
                    $(`#action-${id}`).html('<button onclick="toggleProgramStatus(' + id + ', false)" class="btn btn-sm btn-danger">Close</button>');
                } else {
                    $(`#status-${id}`).html('<span class="btn btn-sm btn-warning">Closed</span>');
                    $(`#action-${id}`).html('<button onclick="toggleProgramStatus(' + id + ', true)" class="btn btn-sm btn-success">Reopen</button>');
                }
            }
        })
        .fail(function (data) {
            $("#msg").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
            $("#msg1").html(
                '<div class="alert alert-danger">Could not reach server, please try again later.</div>'
            );
        });


}

function register() {
    $(".form-group").removeClass("is-invalid");
    $(".form-control").removeClass("is-invalid");
    $(".form-select").removeClass("is-invalid");
    $(".invalid-feedback").remove();

    $("#submit-form-btn").prop('disabled', true);

    var formData = {
        program_id: ($("#program").val().length == 0 ? "" : $("#program").val()),
        fullname: ($("#name").val().length == 0 ? "" : $("#name").val()),
        email: ($("#email").val().length == 0 ? "" : $("#email").val()),
        gender: ($('#gender').val().length == 0 ? "" : $('#gender').val()),
        phone_number: ($('#phone_number').val().length == 0 ? "" : $('#phone_number').val()),
        whatsapp_number: ($('#whatsapp_number').val().length == 0 ? "" : $('#whatsapp_number').val()),
        country_id: ($('#country').val().length == 0 ? "" : $('#country').val()),
        state: ($('#state').val().length == 0 ? "" : $('#state').val()),
        lga: ($('#lga').val().length == 0 ? "" : $('#lga').val()),
    };

    $.ajax({
        type: "POST",
        url: "/api/process-registration-form",
        data: formData,
        dataType: "json",
        encode: true,
    })
        .done(function (data) {
            console.log(data)
            if (!data.isSuccessful) {
                $("#submit-form-btn").removeAttr('disabled');
                if (data.errors.program_id) {
                    $("#program").addClass("is-invalid");
                    $("#program-field").append(
                        '<div class="invalid-feedback text-danger d-block">' + data.errors.program_id + "</div>"
                    );
                }

                if (data.errors.fullname) {
                    $("#name").addClass("is-invalid");
                    $("#name-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.fullname + "</div>"
                    );
                }

                if (data.errors.email) {
                    $("#email").addClass("is-invalid");
                    $("#email-field").append(
                        '<div class="invalid-feedback text-danger d-block">' + data.errors.email + "</div>"
                    );
                }

                if (data.errors.gender) {
                    $("#gender").addClass("is-invalid");
                    $("#gender-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.gender + "</div>"
                    );
                }

                if (data.errors.phone_number) {
                    $("#phone_number").addClass("is-invalid");
                    $("#phone_number-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.phone_number + "</div>"
                    );
                }

                if (data.errors.whatsapp_number) {
                    $("#whatsapp_number").addClass("is-invalid");
                    $("#whatsapp_number-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.whatsapp_number + "</div>"
                    );
                }

                if (data.errors.country_id) {
                    $("#country").addClass("is-invalid");
                    $("#country-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.country_id + "</div>"
                    );
                }

                if (data.errors.state) {
                    $("#state").addClass("is-invalid");
                    $("#state-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.state + "</div>"
                    );
                }

                if (data.errors.lga) {
                    $("#lga").addClass("is-invalid");
                    $("#lga-field").append(
                        '<div class="invalid-feedback d-block">' + data.errors.lga + "</div>"
                    );
                }

                if (data.errors.sqlerrors) {
                    $("#msg").html(
                        '<div class="alert alert-danger">' + data.errors.sqlerrors + "</div>"
                    );
                    $("#msg1").html(
                        '<div class="alert alert-danger">' + data.errors.sqlerrors + "</div>"
                    );
                }

            } else {
                // $("#msg").html(
                //     '<div class="alert alert-success">' + data.message + ": " + data.data "</div>"
                // );
                // $("#msg1").html(
                //     '<div class="alert alert-success">' + data.message + ": " + data.data "</div>"
                // );
                toastr.success(data.data, data.message);
                bootbox.dialog(
                    {
                        message: `Thank you for signifying your interest to attend this event. Click the button below to <b>follow Pastor W.F. Kumuyi</b>, in order to be able to keep track of the event.`,
                        centerVertical: true,
                        buttons: {
                            close: {
                                label: 'Close',
                                className: 'btn-secondary text-dark btn-sm',
                                callback: function () {

                                }
                            },
                            follow: {
                                label: 'Follow',
                                className: 'btn-sm btn-primary',
                                callback: function () {
                                    window.location.assign('https://www.facebook.com/pastorkumuyiofficial/')
                                }
                            },
                        }
                    }
                )
                $('#registration-form')[0].reset();
                $("#submit-form-btn").removeAttr('disabled');
            }
        })
}
