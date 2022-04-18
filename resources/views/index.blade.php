<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>REGISTRATION FORM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link href="https://dailymanna.dclm.org/assets/css/main.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('styles/style.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/be494ca550.js" crossorigin="anonymous"></script>
    <style>
        @media only screen and (min-width: 820px){
            .responsive-banner-img { height: 360px; object-fit: cover; object-position: top; }
        }
    </style>
</head>

<body>
    @include('navbar')
    <style>
        .responsive-banner-img{
            object-fit: contain !important;
        }
    </style>

    @if ($program->image_location)
        <div class="container-fluid">
            <img class="img-fluid img-responsive responsive-banner-img w-100" src="{{ asset('storage/' . $program->image_location) }}" />
        </div>
    @endif

    <div id="registration-form-container" class="col-sm-6 mx-auto">
        <h3 class="mt-4">REGISTRATION FORM</h3>

        <form id="registration-form" class="needs-validation my-3" method="POST">
            <div id="msg"></div>
            <input type="hidden" value="{{ $program->id }}" id="program" name="program">

            <div class="form-group my-2">
                <div class="row">
                    <div id="name-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="name">Fullname (Surname first)</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" />
                    </div>
                    <div id="email-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            placeholder="email@example.com" />
                    </div>
                </div>
            </div>

            <div class="form-group my-2">
                <div class="row">
                    <div id="phone_number-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                            placeholder="+227 70* *** ****" />
                    </div>
                    <div id="whatsapp_number-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="whatsapp_number">Whatsapp Number</label>
                        <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                            placeholder="+227 70* *** ****" />
                    </div>
                </div>
            </div>

            <div class="form-group my-2">
                <div class="row">
                    <div class="col" id="gender-field">
                        <label class="form-label" for="gender">Gender</label>
                        <select name="gender" id="gender" class="form-select" aria-label="Select Gender">
                            <option value="">Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div id="country-field" class="col my-1">
                        <label class="form-label" for="country">Country</label>
                        <select class="form-select" id="country" aria-label="Select Country" name="country">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group my-2">
                <div class="row">
                    <div id="state-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="state">State</label>
                        <input class="form-control" placeholder="State" id="state" name="state" />
                    </div>

                    <div id="lga-field" class="col-md-6 col-lg-6 my-1">
                        <label class="form-label" for="lga">County / LGA</label>
                        <input class="form-control" placeholder="County / LGA" id="lga" name="lga" />
                    </div>
                </div>
            </div>
            <div id="msg1"></div>
            <button id="submit-form-btn" type="submit" class="btn btn-blue-tinted">
                Submit
            </button>
        </form>
    </div>
    {{-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.5.2/bootbox.min.js" integrity="sha512-RdSPYh1WA6BF0RhpisYJVYkOyTzK4HwofJ3Q7ivt/jkpW6Vc8AurL1R+4AUcvn9IwEKAPm/fk7qFZW3OuiUDeg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('scripts/form.js') }}"></script>
    {{-- <script src="{{ asset('scripts/geography.js') }}"></script> --}}


    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
        integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
        crossorigin="anonymous" />

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous">
    </script>
</body>

</html>
