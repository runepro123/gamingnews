@extends('frontend.layouts.app')
@section('content')
<main>
  <!-- ================ contact section start ================= -->
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title">Get in Touch</h2>
        </div>
        <div class="col-lg-8">
          @include('backend.message')
          <form
            class="form-contact contact_form"
            action="{{ url('email/send') }}"
            method="post"
            enctype="multipart/form-data"
            id="contact-form"
          >
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <textarea
                    class="form-control w-100"
                    name="message"
                    cols="30"
                    rows="9"
                    placeholder=" Enter Message"
                  ></textarea>
                  <span class="text-danger">{{ $errors->has('message') ? $errors->first('message') : "" }}</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    class="form-control valid"
                    name="name"
                    type="text"
                    placeholder="Enter your name"
                  />
                  <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : "" }}</span>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input
                    class="form-control valid"
                    name="email"
                    type="email"
                    placeholder="Email"
                  />
                  <span class="text-danger">{{ $errors->has('email') ? $errors->first('email') : "" }}</span>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <input
                    class="form-control"
                    name="subject"
                    type="text"
                    placeholder="Enter Subject"
                  />
                  <span class="text-danger">{{ $errors->has('subject') ? $errors->first('subject') : "" }}</span>
                </div>
              </div>
            </div>
            <div class="form-group mt-3">
              <button type="submit" class="button button-contactForm boxed-btn">
                Send
              </button>
            </div>
          </form>
        </div>
        <div class="col-lg-3 offset-lg-1">
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-home"></i></span>
            <div class="media-body">
              <h3>{{ $contact->address }}</h3>
              <p>{{ $contact->house_no }}</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-tablet"></i></span>
            <div class="media-body">
              <h3>{{ $contact->contact_number }}</h3>
              <p>{{ $contact->contact_schedule }}</p>
            </div>
          </div>
          <div class="media contact-info">
            <span class="contact-info__icon"><i class="ti-email"></i></span>
            <div class="media-body">
              <h3>{{ $contact->support_email }}</h3>
              <p>{{ $contact->support_message }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- ================ contact section end ================= -->
</main>
@endsection
