@extends('template-parts.layout-fullwidth')

@section('content')
    <section id="dpmaker" class="bg-dark py-0 py-sm-5">
        <div class="container py-5">
            <div class="row align-items-center my-2 my-sm-5">
                <div class="col-md-7 pt-5 pt-sm-0 order-2 order-sm-1">
                    <form action="" method="POST" enctype="multipart/form-data" class="dpmaker-form">
                        @csrf
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
                            <input type="file" name="file" class="custom-file-input form-control form-control-2"
                                id="fileDoc" placeholder="Select a Photo" required>
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

                        <button name="getmydp" class="w-100 btn btn-lg btn-danger mt-3 mk-btn" type="submit">Make My
                            DP</button>
                    </form>
                </div>
                <div class="col-md-5 pt-5 pt-sm-0 order-1 order-md-2">
                    <div class="pt-5 pt-sm-0"></div>
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



    @if (Session::get('myDPfile') !== null)
        <div class="modal fade" id="dpModal" data-bs-backdrop="static" tabindex="-1" aria-hidden="true"
            style="display: none;">
            <div class="modal-dialog modal-xl">
                <div class="modal-content bg-dark">
                    <div class="modal-header">
                        {{-- <h5 class="modal-title text-white" id="dpModalTitle">Download DP</h5> --}}
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-sm-5">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="dp-wrap rounded border border-white border-2 rounded-2 mb-3 mb-sm-0">
                                    <img src="{{ asset('/cache/temp/' . Session::get('myDPfile')) }}" alt=""
                                        class="w-100">
                                    {{-- <img src="{{asset( '/cache/temp/1699022372_my-dp.jpg' )}}" alt="" class="w-100"> --}}
                                </div>
                            </div>
                            <div class="col-sm-5 col-dm-3 ">
                                <div class="d-flex align-items-center h-100">
                                    {{-- <div class="btn-wrap d-grid gap-2_ me-auto"> --}}
                                    <div class="btn-wrap ">
                                        <a href="{{ asset('/cache/temp/1699022372_my-dp.jpg') }}" target="_blank"
                                            class="btn btn-success btn-lg w-100 mb-3">Download DP</a>
                                        <a href="#" class="btn btn-secondary btn-lg w-100 mb-3">Share</a>
                                        <a href="#" class="btn btn-danger btn-lg w-100 mb-3"
                                            data-bs-dismiss="modal">Close</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div> --}}
                    </div>
                </div>
            </div>
    @endif
@endsection

@section('footer_scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('nav.navbar').addClass('shadow-none');
            $('.layout-wrapper').addClass('not-home dp-maker');

            // Change Input holder
            $("#fullname").on("keyup change", function(e) {
                $(".myName").text($(this).val())
            });
            $("#district").on("keyup change", function(e) {
                $(".myChurch").text($(this).val())
            });
            // Lets open the file with custom event
            $("#myImage").click(function() {
                $("#fileDoc").click();
            });
            // Open image preveiw
            fileDoc.onchange = evt => {
                const [file] = fileDoc.files
                if (file) {
                    myImageTag.src = URL.createObjectURL(file);
                }
            }

            // Custom colors
            $('#color').on('change', function() {
                var color = $(this).find('option:selected').val();
                color = color.replace('0x', '#');
                console.log(color);
                $('.myName, .myChurch').css('color', color);
                $('.myName_, .myChurch').css('color', color);
                $('#color').css({
                    'background-color': color,
                    'color': '#fff'
                });
            });


            $('#dpModal').modal('show');

            @if ($errors->any())
                // @dump(json_encode($errors->all()))
                let errorArr = `{{ json_encode($errors->all()) }}`;
                console.table(JSON.parse(errorArr));
                let errorList = [];
                // <div class="error">
                //         @foreach ($errors->all() as $error)
                //             <li>{{ $error }}</li>
                //         @endforeach
                // </div>
            @endif

            // Swal.fire({
            //     icon: 'success',
            //     title: `<small>PERSONALIZED FLYER</small>`,
            //     text: `{{ Session::get('myDPfile') ?? 'Create Your Personalized DP' }}`,
            // })

        });
    </script>
@endsection
