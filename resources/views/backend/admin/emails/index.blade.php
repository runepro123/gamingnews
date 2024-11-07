@extends('backend.layouts.app')
@section('content')
<style>
  .custom-width-modal {
    max-width: 800px;
  }
</style>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6 pb-2 pb-sm-0">
            <h1>Email List</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.message')
            <div class="card">
              <div class="card-body table-responsive p-3">
                <table id="dataTable" class="table table-striped">
                  <thead>
                    <tr>
                      <th style="width: 80px">S. No.</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Subject</th>
                      <th style="width: 200px">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                  @if(count($emails) > 0)
                  
                  @php($i = 1)
                  @foreach($emails as $email)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $email->name }}</td>
                      <td>{{ $email->email }}</td>
                      <td>{{ $email->subject }}</td>
                      <td class="d-flex">
                        <button class="btn btn-sm btn-info mr-1" onclick="readEmail({{ json_encode($email) }})" data-toggle="modal" data-target="#emailModal">Read Email</button>
                        <a href="{{ url('email/delete/'. $email->id) }}" onclick="return confirm('Are you sure you want to delete this email?')" class="btn btn-sm btn-danger">Delete</a>
                      </td>
                    </tr>
                  @endforeach
                  @else
                    <tr>
                      <td colspan="5" class="text-center">No data found.</td>
                    </tr>
                  @endif
                  </tbody>
                </table>
                <div class="d-flex justify-content-center pt-2">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

<!-- Modal for displaying detailed email information -->
<div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="emailModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-width-modal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="emailModalLabel">Email Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="emailModalBody">
        <!-- Email details will be displayed here -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
// JavaScript function to view email details in the modal
function readEmail(email) {
  var modalBody = $('#emailModalBody');
  modalBody.html(`
    <p><strong>Name:</strong> ${email.name}</p>
    <p><strong>Email:</strong> ${email.email}</p>
    <p><strong>Subject:</strong> ${email.subject}</p>
    <p><strong>Message:</strong><br>${email.message.replace(/\n/g, '<br>')}</p>
  `);

  // Show the modal
  $('#emailModal').modal('show');
}
</script>
@endsection