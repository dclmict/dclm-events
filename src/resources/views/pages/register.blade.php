@extends('template-parts.layout-fullwidth')

@section('content')


<section id="registration-page" class="bg-dark">
    <div class="container py-5">
        <div class="row align-items-center my-2 my-sm-5">
            <div class="col-sm-7 m-auto">
                <div class="mb-5">
                    <h2 class="fw-bold font-montserrat text-uppercase text-white mb-3">Event Registration</h2>
                    <form action="" method="post" id="regForm">
                        @csrf
                        <div class="row">
                            <div class="col-12 text-sblue">
                                <h4 class="text-sblue border-bottom border-danger py-2">
                                    Select any of the Event you wish to attend
                                </h4>
                            </div>
                            {{-- <div class="col-12">@dump($programs)</div> --}}
                            @forelse ($programs as $p)
                            <div class="col-sm-4 text-center program-select">
                                <label>
                                    <input type="radio" name="program_id" value="{{$p['id']}}" class="d-none">
                                    <div class="custom-checkbox"><img src="{{$p['image_location']}}" class="w-100" alt="Checkbox Image"></div>
                                    <h5 class="text-white bolder mt-1 mb-0">{!! strip_tags($p['name'] )!!}</h5>
                                    <h6 class="small text-sm text-sblue">Days: {!! $p['event_days'] !!}</h6>
                                    <i class="fas fa-check-circle fa-2x text-success_ text-sblue"></i>
                                </label>
                            </div>
                            @empty
                            <div class="col-12">
                                <div class="alert alert-info" role="alert">No active Event to register for</div>
                            </div>
                            @endforelse
                        </div>
                        <div class="row">
                            <div class="col-12 text-sblue">
                                <h4 class="text-sblue border-bottom border-danger py-2">
                                    Personal Information
                                </h4>
                            </div>
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="first_name" name="first_name" placeholder="First Name">
                                    <label for="first_name">First Name</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="last_name" name="last_name" placeholder="Last Name">
                                    <label for="last_name">Last Name</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    {{-- <input type="text" class="form-control rounded-0" id="last_name" name="last_name" placeholder="Last Name"> --}}
                                    <select class="form-select  rounded-0" id="gender" name="gender" aria-label="Select Genger">
                                      <option selected="">Select Gender</option>
                                      <option value="Male">Male</option>
                                      <option value="Female">Female</option>
                                    </select>
                                    <label for="gender">Gender</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}

                            <div class="col-12 text-sblue">
                                <h4 class="text-sblue border-bottom border-danger py-2">
                                    Account Information
                                </h4>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="email" name="email" placeholder="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="email_confirmation" name="email_confirmation" placeholder="Re-type Email">
                                    <label for="email_confirmation">Re-type Email</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}

                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="phone" name="phone" placeholder="Phone">
                                    <label for="phone">Phone</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="whatsapp" name="whatsapp" placeholder="WhatsApp Number">
                                    <label for="whatsapp">Whatsapp Number</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}


                            <div class="col-12 text-sblue">
                                <h4 class="text-sblue border-bottom border-danger py-2">Contact Information</h4>
                            </div>

                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="address" name="address" placeholder="Enter Address">
                                    <label for="Address">Address</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="city" name="city" placeholder="Enter city">
                                    <label for="city">City</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    <input type="text" class="form-control rounded-0" id="state" name="state" placeholder="State/Province/Region">
                                    <label for="state">State/Province/Region</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}
                            <div class="col-sm-6 mb-3">
                                <div class="form-floating">
                                    {{-- <input type="text" class="form-control rounded-0" id="last_name" name="last_name" placeholder="Last Name"> --}}
                                    <select class="form-select  rounded-0" id="country_id" name="country_id" aria-label="Select Country">
                                      <option selected="">Select Country</option>
                                      @forelse ($countries as $c)
                                        <option value="{{ $c->iso2 }}">{{ $c->name }}</option>
                                      @empty
                                        <option value="Nigeria">Nigeria</option>
                                      @endforelse
                                    </select>
                                    <label for="country_id">Country</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}}

                            <div class="col-12 text-center my-4">
                                <button type="submit" id="submit_btn" class="btn btn-xl btn-primary rounded-0">SUBMIT <i class="fas fa-paper-plane ms-2"></i></button>
                            </div>



                        </div>{{-- //.row --}}
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('footer_scripts')

<script type="text/javascript">

$(document).ready(function(){
    $('nav.navbar').addClass('shadow-none');
    $('.layout-wrapper').addClass('not-home register');

        // Swal.fire({
        //     icon: 'success',
        //     title: '<small>Registration Completed</small>',
        //     text: 'Kindly fill the form accurately',
        //     footer: '<a href="">Visit Homepage</a>',
        // })

    // Handle Ajax Submission
    $("#regForm #submit_btn").click(function (e) {
        e.preventDefault();
        let formData = $("#regForm").serialize();
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });

        $.ajax({
            type: "POST",
            url: "{{ route('page.register.post') }}",
            data: formData,
            success: function (data) {
                if (data.status == 'Success') {
                    console.table(data);
                    Swal.fire({
                        icon: 'success',
                        title: `<small>${data.status}!</small>`,
                        text: data.data,
                        footer: '<a href="">Visit Homepage</a>',
                    })
                    $("#regForm")[0].reset();
                }
                if (data.status == 'Error') {
                    console.log(data.errors);
                    let errorList = [];
                    $.each(data.errors, function (key, value) {
                        errorList += `<div class="alert alert-danger alert-dismissible" role="alert">${value}<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>`;
                    });
                    console.table(errorList);
                    Swal.fire({
                        icon: 'error',
                        title: `<small>${data.status}!</small>`,
                        html: `${errorList}`,
                        footer: '<a href="">Visit Homepage</a>',
                    })
                }
            },
            error: function (xhr) {
                console.table(xhr);
                Swal.fire({
                    icon: 'error',
                    title: `<small>${xhr.status}!</small>`,
                    text: data.message,
                })
            }
        });

    });

});


</script>

@endsection
