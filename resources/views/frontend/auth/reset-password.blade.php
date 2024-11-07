@extends('frontend.layouts.app')
@section('content')
<main>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title text-center">Change Password</h2>
        </div>
        <div class="col-lg-8 m-auto">
          <form class="form-contact contact_form" method="post" onsubmit="changePassword(event)">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <!-- Display email from session -->
                  <input type="hidden" class="form-control" id="email" name="email" placeholder="Enter your email" value="{{ $resetEmail ?? '' }}" readonly />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required />
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control" id="confirm_password" name="password_confirmation" placeholder="Retype password" required />
                </div>
              </div>
              <div class="col-sm-12">
                <button type="submit" class="button button-contactForm boxed-btn">Change Password</button>
              </div>
              <div class="col-sm-12 mt-3">
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
async function changePassword(event) {
    event.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    let confirm_password = document.getElementById('confirm_password').value;

    if (password.length < 8) {
      Swal.fire({
        title: 'Oops...',
        text: 'Password must be at least 8 characters!',
      });
    } else if (password !== confirm_password) {
      Swal.fire({
        title: 'Oops...',
        text: 'Password and Confirm Password do not match!',
      });
    } else {
        try {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // var baseUrl = '{{ config('app.url') }}';
            var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
            let res = await fetch(baseUrl + "/api/auth/change-password", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                })
            });

            let data = await res.json();

            if (data.status === 'success') {
                Swal.fire({
                    icon: 'success',
                    text: data.message,
                });

            // Remove email from session
            sessionStorage.removeItem('resetEmail');

            setTimeout(function() {
              window.location.href = '{{ url('user-login') }}';
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
