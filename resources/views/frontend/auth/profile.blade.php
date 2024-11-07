@extends('frontend.layouts.app')
@section('content')
<style>
  .image-preview-container {
    width: 200px;
    height: 200px;
    overflow: hidden;
    border-radius: 50%;
    margin-top: 20px;
    border: 3px solid red;
  }

  #profileImagePreview {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: inherit;
  }
</style>

<main>
  <section class="contact-section">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <h2 class="contact-title text-center">Edit Profile</h2>
        </div>
        <div class="col-lg-8 m-auto">
          <form class="form-contact contact_form" method="post" enctype="multipart/form-data">
            @csrf
            <script>
              var baseUrl = '{{ asset('') }}';
            </script>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <input type="file" class="form-control" id="profile_image" name="profile_image" placeholder="Upload your profile photo"/>
                  <div class="image-preview-container">
                    <img id="profileImagePreview" src="" alt="Profile Image" style="display: none;">
                    <img id="dummyProfileImage" src="{{ asset('frontend/assets/img/comment/profile_image.jpg') }}" alt="Dummy Profile Image" style="display: block;">
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="username" id="username" placeholder="Enter an username"/>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Enter a name"/>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="email" class="form-control" name="email" id="email" readonly/>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <input type="text" class="form-control" name="country" id="country" placeholder="Enter your country"/>
                </div>
              </div>
              <div class="col-12">
                <div class="form-group">
                  <textarea
                    class="form-control w-100"
                    name="bio"
                    id="bio"
                    cols="30"
                    rows="5"
                    placeholder=" Enter bio"
                  ></textarea>
                </div>
              </div>
              <div class="col-sm-12">
                <button type="button" class="button button-contactForm boxed-btn" onclick="updateProfile()">Update Profile</button>
                <button type="button" class="button button-contactForm boxed-btn" onclick="confirmDeleteProfile()">Delete Profile</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<script>
let userData; // Global variable to store user data

async function getUserData() {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let accessToken = localStorage.getItem('access_token');
    var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';

    const res = await fetch(baseUrl + "/api/user", {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${accessToken}`,
      },
    });

    const data = await res.json();

    if (data.status === 'success') {
      userData = data.data.user;
      console.log(userData);

      document.getElementById('username').value = userData.username;
      document.getElementById('name').value = userData.name;
      document.getElementById('email').value = userData.email;
      document.getElementById('country').value = userData.country || '';
      document.getElementById('bio').value = userData.bio || '';
      const profileImage = document.getElementById('profileImagePreview');
      const dummyProfileImage = document.getElementById('dummyProfileImage');

      if (userData.profile_image) {
        profileImage.src = '{{ asset('') }}'+'/' + userData.profile_image;
        profileImage.style.display = 'block';
        dummyProfileImage.style.display = 'none';
      } else {
        profileImage.style.display = 'none';
        dummyProfileImage.style.display = 'block';
      }

    } else {
      console.error("Failed to fetch user data:", data.message);
    }
  } catch (error) {
    console.error("An error occurred:", error);
  }
}

document.addEventListener('DOMContentLoaded', async function () {
  await getUserData();
});

async function updateProfile() {
  let username = document.getElementById('username').value;
  let name = document.getElementById('name').value;
  let email = document.getElementById('email').value;
  let country = document.getElementById('country').value;
  let bio = document.getElementById('bio').value;
  let profileImageInput = document.getElementById('profile_image');
  let selectedImageFile = profileImageInput.files[0];

  if (username.length === 0 || country.length === 0 || bio.length === 0) {
    Swal.fire({
      title: 'Oops...',
      text: 'Username, Email, Country, and Bio are required!',
    });
    return;
  }

  const formData = new FormData();
  formData.append('username', username);
  formData.append('name', name);
  formData.append('email', email);
  formData.append('country', country);
  formData.append('bio', bio);
  if (selectedImageFile) {
    formData.append('profile_image', selectedImageFile);
  }

  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let accessToken = localStorage.getItem('access_token');
    var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';

    const res = await fetch(baseUrl + "/api/update-user-info", {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${accessToken}`,
      },
      body: formData,
    });

    const data = await res.json();

    if (data.status === 'success') {
      Swal.fire({
        icon: 'success',
        text: data.message,
      });

    } else {
      Swal.fire({
        title: 'Oops...',
        text: 'Failed to update data.',
      });
    }
  } catch (error) {
    console.error("An error occurred:", error);
  }
}

async function deleteProfile() {
  try {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    let accessToken = localStorage.getItem('access_token');
    var baseUrl = '{{ $webConfiguration->frontend_api_base_url }}';

    const userId = userData.id;

    const res = await fetch(`${baseUrl}/api/auth/delete/${userId}`, {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': csrfToken,
        'Authorization': `Bearer ${accessToken}`,
      },
    });

    const data = await res.json();

    if (data.status === 'success') {
      localStorage.removeItem('access_token');
      localStorage.removeItem('user_id');
      
      Swal.fire({
        icon: 'success',
        text: data.message,
      });
      window.location.href = '/';
    } else {
      Swal.fire({
        icon: 'error',
        text: data.message,
      });
    }
  } catch (error) {
    console.error("An error occurred:", error);
  }
}

function confirmDeleteProfile() {
  Swal.fire({
    title: 'Are you sure?',
    text: 'You won\'t be able to revert this!',
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Yes, delete it!'
  }).then((result) => {
    if (result.isConfirmed) {
      deleteProfile();
    }
  });
}
</script>
@endsection
