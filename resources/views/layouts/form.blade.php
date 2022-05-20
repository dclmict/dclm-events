@if($program)
    <div class="lgx- lgx-schedule-white">
        <div class="lgx-inner">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="lgx-heading">
                            <h2 class="heading">REGISTRATION FORM</h2>
                            <!-- <h3 class="subheading">Welcome to the dedicated to building remarkable Schedule!</h3> -->
                        </div>
                    </div>
                    <form id="registration-form" class="needs-validation my-3" method="POST">
                        <div id="msg"></div>
                        <input type="hidden" value="{{ $program->id }}" id="program" name="program">

                        <div class="form-group my-2">
                            <div class="row">
                                <div id="name-field" class="col-md-6 col-lg-6 my-1">
                                    <label class="form-label" for="name">Fullname (Surname first)</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Full Name"/>
                                </div>
                                <div id="email-field" class="col-md-6 col-lg-6 my-1">
                                    <label class="form-label" for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                           placeholder="email@example.com"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group my-2">
                            <div class="row">
                                <div id="phone_number-field" class="col-md-6 col-lg-6 my-1">
                                    <label class="form-label" for="phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                           placeholder="+234 80* *** ****"/>
                                </div>
                                <div id="whatsapp_number-field" class="col-md-6 col-lg-6 my-1">
                                    <label class="form-label" for="whatsapp_number">Whatsapp Number</label>
                                    <input type="text" class="form-control" id="whatsapp_number" name="whatsapp_number"
                                           placeholder="+234 80* *** ****"/>
                                </div>
                            </div>
                        </div>

                        <div class="form-group my-2">
                            <div class="row">
                                <div class="col-md-6 my-1" id="gender-field">
                                    <label class="form-label" for="gender">Gender</label>
                                    <select name="gender" id="gender" class="form-control form-select"
                                            aria-label="Select Gender">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div id="country-field" class="col-md-6 my-1">
                                    <label class="form-label" for="country">Country</label>
                                    <select class="form-control form-select" id="country" aria-label="Select Country"
                                            name="country">
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
                                    <input class="form-control" placeholder="State" id="state" name="state"/>
                                </div>

                                <div id="lga-field" class="col-md-6 col-lg-6 my-1">
                                    <label class="form-label" for="lga">County / LGA</label>
                                    <input class="form-control" placeholder="County / LGA" id="lga" name="lga"/>
                                </div>
                            </div>
                        </div>
                        <div id="msg1"></div>

                        <div class="section-btn-area">
                            <input onclick="register()" style="background: #554bb9;" type="submit" class="lgx-btn hvr-glow hvr-radial-out lgxsend lgx-send" id="submit-form-btn" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endif
        