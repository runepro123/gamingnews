@extends('frontend.layouts.app')
@section('content')
<main>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title text-center">Create Account</h2>
        </div>
        <div class="col-lg-8 m-auto">
          <form class="form-contact contact_form" method="post" onsubmit="registerUser(event)">
            @csrf
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" placeholder="Enter your email"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control" name="password" placeholder="Enter your password"/>
                </div>
              </div>
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Enter your confirm password"/>
                </div>
              </div>
              <div class="col-sm-12">
                <button type="submit" class="button button-contactForm boxed-btn">Register</button>
              </div>
              <div class="col-sm-12 mt-3">
                <p>Already have an account? <a href="{{ url('/user-login') }}" class="text text-danger">Login</a></p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>

<script>
async function registerUser(event) {
    event.preventDefault();

    let email = document.querySelector('input[name="email"]').value;
    let password = document.querySelector('input[name="password"]').value;
    let confirmPassword = document.querySelector('input[name="password_confirmation"]').value;

    if (email.length === 0 || password.length === 0 || confirmPassword.length === 0) {
      Swal.fire({
        title: 'Oops...',
        text: 'Email, Password, and Confirm Password are required!',
      });
    } else if (password !== confirmPassword) {
      Swal.fire({
        title: 'Oops...',
        text: 'Password and Confirm Password do not match!',
      });
    } else {
        try {
            let csrfToken = document.querySelector('meta[name="csrf-token"]').content;
            // var baseUrl = '{{ config('app.url') }}';
            var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}' ;
            let res = await fetch(baseUrl +"/api/auth/register", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    email: email,
                    password: password,
                    password_confirmation: confirmPassword
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

