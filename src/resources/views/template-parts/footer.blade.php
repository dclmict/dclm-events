<footer id="footer" class="content-footer footer">
  <div class="footer-top container py-md-5 py-sm-3 py-2">
    <div class="row">
      <div class="col-sm-6 text-center text-sm-start">
        <h1 class="footer-h1">Become a part of the experience</h1>
        <a class="btn btn-light btn-lg mt-2 text-uppercase text-primary fw-bold rounded" href="{{ route('page.register')}}">Register <i class="fa fa-caret-right ms-2"></i></a>
      </div>
      <div class="col-sm-6 text-center text-sm-end pt-4 pt-sm-0">
          <h1 class="date_1">{!! $banner->date_1 ?? '' !!}</h1>
          <h3 class="date_2">{!! $banner->date_2 ?? '' !!}</h3>
      </div>
    </div>
  </div>

  <div class="sub-footer bg-dark mt-5">
    <div class="container d-flex flex-md-row flex-column justify-content-between align-items-md-center gap-1 container-p-x py-3">
      <div>
        <a href="#!" class="footer-text fw-bolder">DCLM.ORG</a>©
      </div>
      <div>
        <a href="#!" class="footer-link me-4">Terms of use</a>
        <a href="#!" class="footer-link me-4">Privacy policy </a>
        <a href="#!" class="footer-link me-4">Contact us</a>
      </div>
    </div>

  </div>


</footer>
