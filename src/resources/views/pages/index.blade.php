@extends('template-parts.layout-fullwidth')

@section('content')

<section id="banner" class="container-fluid fixed-top_" style="{!! $banner->style !!}">
    <div class="container mt-4 pt-5">
        <div class="row">
            <div class="col-md-7 left-side">
                <h1 class="title_1 fw-bolder">{!! $banner->title_1 !!}</h1>
                <h5 class="title_2">{!! $banner->title_2 !!}</h5>
                <a class="btn btn-light btn-lg mt-2 text-uppercase text-primary fw-bold">Register <i class="fa fa-caret-right ms-2"></i></a>
            </div>
            <div class="col-md-5 text-end">
                <h1 class="date_1 fw-bolder">{!! $banner->date_1 !!}</h1>
                <h3 class="date_2 fw-bolder">{!! $banner->date_2 !!}</h3>
            </div>
        </div>

        <div class="row mt-5 pt-5">
            <div class="col-sm-6">
                <img src="assets/img/icons/social.png" class="w-100 mb-3 mt-3">
            </div>
            <div class="col-sm-6 text-end">
                <div id="event_countdown" class="text-white fw-bolder"></div>                
            </div>
        </div>
    </div>
</section>

<section id="testimonies">
    <div class="container py-5">
        <h2 class="fw-bold">Testimonies</h2>

        <div id="carouselExample" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel">
            <ol class="carousel-indicators">
              <li data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true"></li>
              <li data-bs-target="#carouselExample" data-bs-slide-to="1" class=""></li>
            </ol>
            <div class="carousel-inner">
              <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-4">
                        <img class="d-block w-100" src="/assets/img/news/news1.jpg" alt="First slide">
                    </div>
                    <div class="col-md-8">
                        <div class="carousel-caption d-md-block text-white">
                          <h3>First slide</h3>
                          <p>“On the 1st of April, she experienced a sharp pain after trying to put a baby down. She got home and felt the pain again. Someone researched online and told her that this kind of pain is associated with kidney disease. She ignored it and believed in God for her healing. During the Easter Retreat, after the message on Jesus, Our Passover, The man of God prayed specifically for people experiencing internal problems. She received her healing and was made whole. The pain has not returned since then. Praise the Lord!”</p>
                          <h4 class="ts-name">Adedigba Omolaso</h4>
                          <h5 class="ts-location">Abuja, Nigeria</h5>                          
                        </div>                        
                    </div>
                </div>{{--//.row--}}
              </div>
              
              <div class="carousel-item">
                <div class="row">
                    <div class="col-md-4">
                        <img class="d-block w-100" src="/assets/img/news/news2.jpg" alt="Second slide">
                    </div>
                    <div class="col-md-8">
                        <div class="carousel-caption d-md-block text-white">
                          <h3>Second slide</h3>
                          <p>“On the 1st of April, she experienced a sharp pain after trying to put a baby down. She got home and felt the pain again. Someone researched online and told her that this kind of pain is associated with kidney disease. She ignored it and believed in God for her healing. During the Easter Retreat, after the message on Jesus, Our Passover, The man of God prayed specifically for people experiencing internal problems. She received her healing and was made whole. The pain has not returned since then. Praise the Lord!”</p>
                          <h4 class="ts-name">Adedigba Omolaso</h4>
                          <h5 class="ts-location">Abuja, Nigeria</h5>
                        </div>                        
                    </div>
                </div>{{--//.row--}}
              </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a>
        </div>


    </div>
</section>

@endsection

@section('footer_scripts')

<script type="text/javascript">
    
$('#event_countdown').countdown('2023/04/20', function(event) {
  var $this = $(this).html(event.strftime(''
    // + '<h3 class="d-inline">%w <span>weeks</span></h3> '
    + '<h3 class="d-inline">%D <span>DAYS</span></h3> '
    + '<h3 class="d-inline">%H <span>HOURS</span></h3> '
    + '<h3 class="d-inline">%M <span>MINUTES</span></h3> '
    + '<h3 class="d-inline">%S <span>SECONDS</span></h3>'));
});

</script>

@endsection