@extends('template-parts.layout-fullwidth')

@section('content')
    <section id="dpmaker" class="bg-dark py-0 py-sm-5">
        <div class="container py-5">
            <div class="row align-items-center my-2 my-sm-5">
                <div class="col-md-7">
                    <form action="" method="POST" enctype="multipart/form-data" class="dpmaker-form">
                        <h1 class="h1 mt-3 mb-3 fw-bold text-white">PERSONALIZED FLYER</h1>
                        <h3 class="h6 mt-3 mb-5 fw-bold text-sblue">Create Your Personalized DP</h3>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-2" id="fullname" name="fullname"
                                placeholder="Enter your name" required>
                            <label for="fullname">Enter your name</label>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="text" class="form-control form-control-2" id="district" name="district"
                                placeholder="Global Crusade Location" required>
                            <label for="district">Global Crusade Location</label>
                        </div>

                        <div class="custom-file d-block w-100 mb-3">
                            <input type="file" name="file" class="custom-file-input form-control form-control-2" id="fileDoc"
                                placeholder="Select a Photo" required>
                            <!--<label class="custom-file-label" for="file" style="justify-content: left;">Choose file</label>-->
                        </div>

                        <div class="advance-panel row">
                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select form-control-2" id="color" name="color">
                                        <?php foreach($colors as $hex => $name){ ?>
                                        <option value="<?php print $hex; ?>"><?php print $name; ?></option>
                                        <?php } ?>
                                    </select>
                                    <label for="color">Set Custom Color</label>
                                </div>
                            </div><!--//Color-->

                            <div class="col-6">
                                <div class="form-floating mb-3">
                                    <select class="form-select form-control-2" id="quality" name="quality">
                                        <option value="100">100% [large Image size]</option>
                                        <option value="90">90%</option>
                                        <option value="80">80%</option>
                                        <option value="70" selected>70%</option>
                                        <option value="60">60%</option>
                                    </select>
                                    <label for="quality">Output Size Ratio</label>
                                </div>
                            </div><!--//Quality-->

                        </div>

                        <button name="getmydp" class="w-100 btn btn-lg btn-danger mt-3 mk-btn" type="submit">Make My DP</button>
                    </form>
                </div>
                <div class="col-md-5">
                    <div class="baseImg-wrap">
                        <img src="/assets/img/event-img/asg.jpg" class="w-100">
                        <div class="myImage rounded-0_" id="myImage">
                            <img id="myImageTag" src="/assets/img/generic/plus.png" alt="myImageTag" height="105"
                                class="w-auto h-100" />
                        </div>
                        <div class="myName"></div>
                        <div class="myChurch"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('nav.navbar').addClass('shadow-none');
            $('.layout-wrapper').addClass('not-home register');
        });
    </script>
@endsection
