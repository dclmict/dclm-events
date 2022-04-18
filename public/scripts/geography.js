$("form").attr('autocomplete', 'off');
let countries = []
let states = []
let regions = []
let groups = []
// SECTION GETTERS
function GetAllCountrys() {
    $.ajax({
        type: "GET",
        url: "/api/get-countries",
        dataType: "json",
        encode: true,
    })
        .done(function (response) {
            // console.log(response)
            if (!response.isSuccessful) {
                toastr.error("Something went wrong!", "Error!");
                // if (response.errors) {
                //     response.errors.forEach(error => {
                //         toastr.error(error, "Error!");
                //     });
                // }

                // if (response.error) {
                //     toastr.error(response.errors.sqlerrors, "Error!");
                // }
            } else {
                countries = []
                response.data.countries.forEach(country => {
                    countries.push(country.country)
                });
            }
        })
        .fail(function (response) {
            toastr.error("Could not reach server, please try again later.", "Error!");
        });
}
GetAllCountrys()
// let responses = null;
function changeStateOptions() {
    let id = $('#country').val();
    $.ajax({
        type: "GET",
        url: `/api/get-country/${id}`,
        dataType: "json",
        encode: true,
    })
        .done(function (response) {
            if (!response.isSuccessful) {
                toastr.error("Something went wrong!", "Error!");
            } else {
                // console.log(response.data)
                // responses = response.data
                if (id.length > 0) {
                    $("#state").html(""); // reset region options
                    // console.dir("State: ", searchedState)
                    $("#state").html(`<option value="">Select State</option>`) // add default option
                    response.data[0].states.forEach(state => {
                        $("#state").append(`<option value="${state.id}">${state.state}</option>`)
                    });
                } else {
                    $("#state").html("");
                    $("#state").append(`<option value="">Select Country Before Filling This Field</option>`)
                }
            }
        })
        .fail(function (response) {
            toastr.error("Could not reach server, please try again later.", "Error!");
        });
}

function changeRegionOptions() {
    let id = $('#state').val();
    $.ajax({
        type: "GET",
        url: `/api/get-state/${id}`,
        dataType: "json",
        encode: true,
    })
        .done(function (response) {
            if (!response.isSuccessful) {
                toastr.error("Something went wrong!", "Error!");
            } else {
                // console.log(response.data)
                // responses = response.data
                if (id.length > 0) {
                    $("#region").html(""); // reset region options
                    // console.dir("State: ", searchedState)
                    $("#region").html(`<option value="">Select Region</option>`) // add default option
                    response.data[0].regions.forEach(region => {
                        $("#region").append(`<option value="${region.id}">${region.region}</option>`)
                    });
                } else {
                    $("#region").html("");
                    $("#region").append(`<option value="">Select State Before Filling This Field</option>`)
                }
            }
        })
        .fail(function (response) {
            toastr.error("Could not reach server, please try again later.", "Error!");
        });
}

function changeGroupOptions() {
    let id = $('#region').val();
    $.ajax({
        type: "GET",
        url: `/api/get-region/${id}`,
        dataType: "json",
        encode: true,
    })
        .done(function (response) {
            if (!response.isSuccessful) {
                toastr.error("Something went wrong!", "Error!");
            } else {
                // console.log(response.data)
                // responses = response.data
                if (id.length > 0) {
                    $("#group").html(""); // reset group options
                    // console.dir("State: ", searchedState)
                    $("#group").html(`<option value="">Select Group</option>`) // add default option
                    response.data[0].groups.forEach(group => {
                        $("#group").append(`<option value="${group.id}">${group.group}</option>`)
                    });
                } else {
                    $("#group").html("");
                    $("#group").append(`<option value="">Select Region Before Filling This Field</option>`)
                }
            }
        })
        .fail(function (response) {
            toastr.error("Could not reach server, please try again later.", "Error!");
        });
}


// ENDSECTION
