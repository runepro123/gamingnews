@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Add New Survey</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <form action="{{ url('add-survey') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="form-group">
                    <label>Language</label>
                    <select name="language_id" class="form-control">
                      <option selected disabled>Select Language</option>
                      @foreach($languages as $language)
                      <option value="{{ $language->id }}">{{ $language->name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('language_id') ? $errors->first('language_id') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Question</label>
                    <input type="text" class="form-control" name="question" value="{{ old('question') }}" placeholder="Question">
                    <span class="text-danger">{{ $errors->has('question') ? $errors->first('question') : "" }}</span>
                  </div>
                  <div class="form-group">
                    <label>Option</label>
                    <div class="input-group">
                      <input type="text" class="form-control" name="options[]" value="{{ old('options[]') }}" placeholder="Enter Option">
                      <div class="input-group-append" style="margin-left: 5px;">
                        <button type="button" id="add" class="btn btn-primary">Add</button>
                      </div>
                    </div>
                    <div id="options"></div>
                    <span class="text-danger">
                      {{ $errors->has('options') ? $errors->first('options') : "" }}
                    </span>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  <script>
  window.addEventListener("DOMContentLoaded", () => {
    let i = 1;
    let addButton = document.getElementById("add");
    let options = document.getElementById("options");
  
    addButton.addEventListener("click", () => {
      if (i >= 10) {
        alert("You have reached the maximum limit of 10 options.");
      } else {
        ++i;
        createInputField();
      }
    }); 
  
    document.body.addEventListener("click", (e) => {
      const target = e.target;
  
      if (target.classList.contains("remove-option")) {
        // target.parentNode.remove();
        target.closest('.input-group').remove();
        --i; // Decrement i when an option is removed
      }
    });
  
    function createInputField() {
      let container = document.createElement("div");
      container.classList.add("input-group", "mt-3");
  
      let input = document.createElement("input");
      input.type = "text";
      input.classList.add("form-control");
      input.name = "options[]";
      input.placeholder = "Enter Option";
  
      let divAppend = document.createElement("div");
      divAppend.classList.add("input-group-append");
      divAppend.style.marginLeft = "5px";
  
      let button = document.createElement("button");
      button.type = "button";
      button.classList.add("btn", "btn-danger", "remove-option");
      button.textContent = "Remove";
  
      divAppend.appendChild(button);
      container.appendChild(input);
      container.appendChild(divAppend);
  
      options.appendChild(container);
    }
  });
  </script>
@endsection