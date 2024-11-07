@extends('frontend.layouts.app')
@section('content')
<main>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title text-center">Verify OTP</h2>
        </div>
        <div class="col-lg-8 m-auto">
          <form class="form-contact contact_form" method="post" onsubmit="verifyOTP(event)">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <!-- Display email from localStorage -->
                  <input type="hidden" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ $resetEmail ?? '' }}" />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="text" class="form-control" id="otp" name="otp" placeholder="Enter your OTP"/>
                </div>
              </div>
              <div class="col-sm-12">
                <button type="submit" class="button button-contactForm boxed-btn">Verify OTP</button>
              </div>
              <div class="col-sm-12 d-flex justify-content-between align-items-center mt-3">
                <a href="{{ url('user-login') }}" class="text text-danger">Login</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
async function verifyOTP(event) {
    event.preventDefault();

    let email = document.getElementById('email').value;
    let otp = document.getElementById('otp').value;

    if (otp.length === 0) {
      Swal.fire({
        title: 'Oops...',
        text: 'OTP is required!',
      });
    } else {
        try {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // var baseUrl = '{{ config('app.url') }}';
            var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
            let res = await fetch(baseUrl + "/api/auth/verify-otp", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    email: email,
                    otp: otp,
                })
            });

            let data = await res.json();
            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    text: data.message,
                });

            setTimeout(function() {
                window.location.href = '{{ url('user/reset-password') }}';
            }, 2000);

            } else {
                 Swal.fire({
                    title: 'Oops...',
                    text: data.message,
                });
            }
            

        } catch (error) {
          console.error("An error occurred:", error);
        }
    }
}

// Retrieve email from sessionStorage and set it in the email field
document.getElementById('email').value = sessionStorage.getItem('resetEmail') || '';
</script>
@endsection
