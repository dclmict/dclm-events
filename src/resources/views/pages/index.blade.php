@extends('template-parts.layout-fullwidth')

@section('content')
    <section id="banner" class="container-fluid fixed-top_" style="{!! $banner->style !!}">
        <div class="banner-overlay h-100 w-100 position-absolute"></div>
        <div class="container banner-content mt-4 pt-5">
            <div class="row">
                <div class="col-md-7 left-side">
                    <h1 class="title_1 fw-bolder" style="{{$banner->title_1_css}}">{!! $banner->title_1 !!}</h1>
                    <h5 class="title_2">{!! $banner->title_2 !!}</h5>
                    <a class="btn btn-light btn-lg mt-2 text-uppercase text-primary fw-bold"
                        href="{{ route($banner->route) }}">Register <i class="fa fa-caret-right ms-2"></i></a>
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
        <div class="container py-5 my-0 my-md-5">
            <div class="p2 d-flex align-items-center mb-3">
                <h3 class="fw-bold text-uppercase mb-0">Testimonies</h3>
                <div class="ms-auto">
                    <a class="carousel-control-prev_ btn btn-dark btn-sm" href="#carouselExample" role="button"
                        data-bs-slide="prev">
                        <i class="fas fa-long-arrow-alt-left"></i>
                        <span class="visually-hidden">Previous</span>
                    </a>
                    <a class="carousel-control-next_ btn btn-dark btn-sm" href="#carouselExample" role="button"
                        data-bs-slide="next">
                        <i class="fas fa-long-arrow-alt-right"></i>
                        <span class="visually-hidden">Next</span>
                    </a>
                </div>
            </div>

            <div id="carouselExample" class="carousel slide carousel-dark carousel-fade" data-bs-ride="carousel">
                <ol class="carousel-indicators">
                    @foreach ($testimonies as $key => $t)
                        <li data-bs-target="#carouselExample" data-bs-slide-to="{{ $key }}"
                            @if ($key == 0) class="active" aria-current="true" @endif></li>
                    @endforeach
                </ol>
                <div class="carousel-inner">
                    @foreach ($testimonies as $key => $t)
                        <div class="carousel-item @if ($key == 0) active @endif">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="img-wrap h-100 overflow-hidden"
                                        style="background-image:url(/assets/img/news/{{ $t['image'] }});">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="carousel-caption p-0 d-md-block">
                                        <h4 class="fw-bold">{{ $t['title'] }}</h4>
                                        <p>“{{ $t['text'] }}”</p>
                                        <h5 class="ts-name mb-1 fw-bold">{{ $t['name'] }}</h5>
                                        <h6 class="ts-location small">{{ $t['location'] }}</h6>
                                    </div>
                                </div>
                            </div>{{-- //.row --}}
                        </div>
                    @endforeach
                </div>
                {{--        <a class="carousel-control-prev" href="#carouselExample" role="button" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExample" role="button" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </a> --}}
            </div>
        </div>
    </section>

    <section id="schedule">
        <div class="container  py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="fw-bold text-uppercase text-white mb-3">PROGRAM SCHEDULE</h2>
                    <div class="nav-align-top mb-4">
                        <ul class="nav nav-tabs" role="tablist">
                            @php($count = 0)
                            @foreach ($sch as $key => $s)
                            <li class="nav-item" role="presentation">
                                <button type="button" class="nav-link @if($count == 0) active @endif" role="tab" data-bs-toggle="tab" data-bs-target="#navs-{{$key}}" aria-controls="navs-{{$key}}" @if($count == 0) aria-selected="true" @else aria-selected="false" tabindex="-1" @endif>{{$s->name}}</button>
                            </li>
                            @php($count++)
                            @endforeach
                        </ul>
                        <div class="tab-content px-0">
                            @php($count = 0)
                            @foreach ($sch as $key => $s)
                                <div class="tab-pane fade @if($count == 0) active show @endif" id="navs-{{$key}}" role="tabpanel">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="event-details">
                                                {{-- <h3>{{ strtoupper($s->name) }}</h3> --}}
                                                <div class="dates">
                                                    <h4>{{ $s->days }}</h4>
                                                    <h5>{{ $s->month }}</h5>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <th>TIME</th>
                                                            <th>EVENTS</th>
                                                            <th>SPEAKERS</th>
                                                        </thead>
                                                        <tbody>
                                                            @php($list = json_decode($s->schedules))
                                                            @foreach ($list as $key => $item)
                                                            <tr>
                                                                <td class="col-time">{{ formatDate($item->time, 'h:i A') }}</td>
                                                                <td class="col-event">{{ $item->event }}</td>
                                                                <td class="col-speaker small">{{ $item->speakers ?? '--' }}</td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 ms-auto">
                                            <div class="img-wrap">
                                                <img src="{{ route('getImageFile', ['events', $s->image_location]) }} " alt="" class="w-100">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @php($count++)
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="resources" class="bg-dark">
        <div class="container py-5">
            <div class="row align-items-center my-2 my-sm-5">
                <div class="col-md-6 font-roboto">
                    <div class="mb-5">
                        <h2 class="fw-bold text-uppercase text-white mb-3">Resources</h2>
                        <h3 class="text-uppercase mb-4 text-sblue font-montserrat">Glorious Visitation from Christ</h3>
                        <p class="h5 text-white mb-2">Download event resources and materials for Glorious Visitation from
                            Christ here.</p>
                        <p class="h5 text-white mb-2">Crusade, Ministers conference and Impact Academy</p>
                    </div>
                </div>
                <div class="col-md-5 ms-sm-auto">
                    <div class="row gx-sm-5">
                        @foreach ($res as $r)
                            <div class="col-6 text-center mb-5 res-block">
                                <a href="{{ $r['route'] }}" class="d-block rounded border border-white py-5">
                                    <i class="fas fa-3x {{ $r['icon'] }} text-blue-gradient mb-2"></i>
                                    <p class="text-white mb-0">{{ $r['title_1'] }} <span
                                            class="fw-bold d-block">{{ $r['title_2'] }}</span></p>
                                </a>
                            </div>{{-- //col-6 --}}
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('footer_scripts')
    <script src="{{ asset('/assets/js/jquery.countdown.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('nav.navbar').addClass('shadow-none');
            $('.layout-wrapper').addClass('home');
        });

        $('#event_countdown').countdown('{!! $banner->count_down !!}', function(event) {
            var $this = $(this).html(event.strftime(''
                // + '<h3 class="d-inline">%w <span>weeks</span></h3> '
                +
                '<h3 class="d-inline">%D <span>DAYS</span></h3> ' +
                '<h3 class="d-inline">%H <span>HOURS</span></h3> ' +
                '<h3 class="d-inline">%M <span>MINUTES</span></h3> ' +
                '<h3 class="d-inline">%S <span>SECONDS</span></h3>'));
        });
    </script>
@endsection
