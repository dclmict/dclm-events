let Geography = []
let State = []
let Region = []
let Group = []

$("form").attr('autocomplete', 'off');

function addCountryOptions() {
    $("#country").html(`<option value="">Select Country</option>`)
    Geography.forEach(country => {
        // console.log(region.name)
        $("#country").append(`<option value="${country.id}">${country.country}</option>`)
        // console.log(country)
    });
}

function GetGeography() {
    $.ajax({
        type: "GET",
        url: "/api/get-geography",
        dataType: "json",
        encode: true,
    })
        .done(function (data) {
            if (!data.success) {
                if (data.errors) {
                    data.errors.forEach(error => {
                        toastr.error(error, "Error!");
                    });
                }
                if (data.error) {
                    toastr.error(data.error.sqlerrors, "Error!");
                }
            } else {
                Geography = data.response
                addCountryOptions();
                // console.log(Geography);
            }
        })
        .fail(function (data) {
            toastr.error("Could not reach server, please try again later.", "Error!");
        });
}

let region = [
    { id: 1, name: "Ketu", group: ["Ikosi", "Magodo", "Shangisha", "Oluwalogbon", "Mile12", "Ajegunle", "Arepo", "DLCC"] },
    { id: 2, name: "Mushin", group: ["Idioro", "Idi-araba", "Odiolowo"] },
    { id: 3, name: "Ikorodu", group: ["Oriokuta", "Isawo", "Agbede"] },
    { id: 4, name: "Isolo", group: ["Ireakari", "Okota", "Faith"] },
];

function changeStateOptions() {
    countryName = $("#country").val() //get group input valye
    // console.log(countryName)
    if (countryName.length > 0) {
        $("#state").html(""); // reset region options

        searchedState = Geography.find(({ id }) => id === countryName) // find the group object with the value in regionName
        State = searchedState.states
        // console.dir("State: ", searchedState)
        $("#state").html(`<option value="">Select State</option>`) // add default option
        searchedState.states.forEach(state => {
            // console.log("2", state)
            $("#state").append(`<option value="${state.id}">${state.state}</option>`)
        });
    } else {
        $("#state").html("");
        $("#state").append(`<option value="">Select Country Before Filling This Field</option>`)
    }
}

function changeRegionOptions() {
    stateName = $("#state").val() //get group input valye
    // console.log(countryName)
    if (stateName.length > 0) {
        $("#region").html(""); // reset region options

        searchedRegion = State.find(({ id }) => id === stateName) // find the group object with the value in regionName
        Region = searchedRegion.regions
        // console.dir("State: ", searchedRegion)
        $("#region").html(`<option value="">Select Region</option>`) // add default option
        searchedRegion.regions.forEach(region => {
            // console.log("2", region)
            $("#region").append(`<option value="${region.id}">${region.region}</option>`)
        });
    } else {
        $("#region").html("");
        $("#region").append(`<option value="">Select Country Before Filling This Field</option>`)
    }
}

function changeGroupOptions() {
    regionName = $("#region").val() //get group input valye
    // console.log(countryName)
    if (regionName.length > 0) {
        $("#group").html(""); // reset region options

        searchedGroup = Region.find(({ id }) => id === regionName) // find the group object with the value in regionName
        Group = searchedGroup.groups
        // console.dir("State: ", searchedGroup)
        $("#group").html(`<option value="">Select Region</option>`) // add default option
        searchedGroup.groups.forEach(group => {
            // console.log("2", group)
            $("#group").append(`<option value="${group.id}">${group.group_name}</option>`)
        });
    } else {
        $("#group").html("");
        $("#group").append(`<option value="">Select Region Before Filling This Field</option>`)
    }
}
