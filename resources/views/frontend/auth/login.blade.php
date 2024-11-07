@extends('frontend.layouts.app')
@section('content')
<main>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title text-center">Login</h2>
        </div>
        <div class="col-lg-8 m-auto">
          <form class="form-contact contact_form" method="post" onsubmit="Login(event)">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password"/>
                </div>
              </div>
              <div class="col-sm-12">
                <button type="submit" class="button button-contactForm boxed-btn">Login</button>
              </div>
              <div class="col-sm-12 d-flex justify-content-between align-items-center mt-3">
                <p>Don't have an account? <a href="{{ url('/user-registration') }}" class="text text-danger">Register</a></p>
                <a href="{{ url('user/forgot-password') }}" class="text text-danger">Forgot password?</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
async function Login(event) {
    event.preventDefault();

    let email = document.getElementById('email').value;
    let password = document.getElementById('password').value;

    if (email.length === 0 || password.length === 0) {
      Swal.fire({
        title: 'Oops...',
        text: 'Email and Password are required!',
      });
    } else {
        try {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // var baseUrl = '{{ config('app.url') }}';
            var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
            let res = await fetch(baseUrl +"/api/auth/login", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    email: email,
                    password: password
                })
            });

            let data = await res.json();

            if (data.status === 'success') {
                localStorage.setItem('access_token', data.data.access_token);
                localStorage.setItem('user_id', data.data.user.id);

                Swal.fire({
                    icon: 'success',
                    text: data.message,
                });

                window.location.href = '{{ url('/') }}';
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
</script>
@endsection
