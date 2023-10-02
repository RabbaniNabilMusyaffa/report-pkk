@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4" style="color: #696cff;">Detail - <span class="text-muted fw-bold"> Task / Project</span></h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('task-detail', $tasks -> id)}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-fullname">Judul Task / Project</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-task'></i></span>
              <input type="text" name="title" class="form-control" id="basic-icon-default-fullname" value="{{$tasks -> title}}" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-company">Tanggal Tenggat</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bxs-calendar'></i></span>
              <input type="text" name="deadline" id="basic-icon-default-company" class="form-control" value="{{$tasks -> deadline}}" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-email">Deskripsi</label>
            <div class="input-group input-group-merge">
              <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                <div>
                  <textarea name="deskripsi" cols="125" value="">{{$tasks -> deskripsi}}</textarea>
                </div>              
            </div>
          </div>
          <div class="d-flex justify-content-end mt-5">
            {{-- <button type="submit" class="btn btn-warning"><i class='bx bx-edit me-1'></i>Edit</button> --}}
            <a href="{{route('task-edit', $tasks -> id)}}" class="btn btn-warning ms-2"><i class='bx bx-edit me-1'></i>Edit</a>
            <a href="{{route('task-list')}}" class="btn btn-danger ms-2"><i class='bx bx-arrow-back me-1'></i>Kembali</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
