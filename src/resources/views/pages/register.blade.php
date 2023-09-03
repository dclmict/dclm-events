@extends('template-parts.layout-fullwidth')

@section('content')


<section id="resources" class="bg-dark">
    <div class="container py-5">
        <div class="row align-items-center my-2 my-sm-5">
            <div class="col-sm-7 m-auto">
                <div class="mb-5">
                    <h2 class="fw-bold font-montserrat text-uppercase text-white mb-3">Event Registration</h2>
                    <form action="" method="post">
                        @csrf
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
                                    <input type="text" class="form-control rounded-0" id="confirm_email" name="confirm_email" placeholder="Re-type Email">
                                    <label for="confirm_email">Re-type Email</label>
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
                                <h4 class="text-sblue border-bottom border-danger py-2">
                                    Contact Information
                                </h4>
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
                                    <select class="form-select  rounded-0" id="country" name="country" aria-label="Select Country">
                                      <option selected="">Select Country</option>
                                      <option value="Nigeria">Nigeria</option>
                                      <option value="O">O</option>
                                    </select>
                                    <label for="gender">Country</label>
                                </div>
                            </div>{{-- //.col-sm-6 --}} 

                            <div class="col-12 text-center my-4">
                                <button type="submit" class="btn btn-xl btn-primary rounded-0">SUBMIT <i class="fas fa-paper-plane ms-2"></i></button>
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
});


</script>

@endsection