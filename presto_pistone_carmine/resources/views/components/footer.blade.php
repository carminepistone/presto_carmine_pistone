<footer class="text-center text-lg-start footer-custom text-muted vw-100">
  <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
  </section>
  <section class="">
    <div class="container text-center text-md-start mt-5 footer-elements">
      <div class="row mt-3">
        @auth
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4 text-md-start">
          <h5 class="text-uppercase fw-bold mb-4">{{ __('ui.became_revisor') }}</h5>
          <p>{{ __('ui.please_click') }}</p>
          <a href="{{ route('become.revisor') }}" class="btn btn-revisor">{{ __('ui.revisor_button') }}</a>
        </div>
        @endauth
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4">{{ __('ui.useful_links') }}</h6>
          <p><a href="#!" class="text-reset">{{ __('ui.prices') }}</a></p>
          <p><a href="#!" class="text-reset">{{ __('ui.orders') }}</a></p>
          <p><a href="#!" class="text-reset">FAQ</a></p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold mb-4">{{ __('ui.contacts') }}</h6>
          <p><i class="fas fa-home me-3"></i> Casoria NA 80026, IT</p>
          <p><i class="fas fa-envelope me-3"></i> info@presto.it</p>
          <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>

        </div>
      </div>
    </div>
  </section>
</footer>