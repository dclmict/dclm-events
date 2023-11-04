@extends('template-parts.layout-fullwidth')

@section('content')
    <section id="dpmaker" class="bg-dark py-0 py-sm-5">
        <div class="container py-5">
            <div class="row align-items-center my-2 my-sm-5">
                <div class="col-md-7">

                  
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
            Swal.fire({
                icon: 'success',
                title: `<small>PERSONALIZED FLYER</small>`,
                text: `Create Your Personalized DP`,
            })

        });
    </script>
@endsection
