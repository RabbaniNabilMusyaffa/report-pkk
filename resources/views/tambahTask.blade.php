@extends('layouts/contentNavbarLayout')

@section('title', ' Vertical Layouts - Forms')

@section('content')
<h4 class="fw-bold py-3 mb-4" style="color: #696cff;">Tambah - <span class="text-muted fw-bold"> Task / Project</span></h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('store-task')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-fullname">Judul Task / Project</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bx-task'></i></span>
              <input type="text" name="title" class="form-control" id="basic-icon-default-fullname" placeholder="Judul dari task / project anda" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-company">Tanggal Tenggat</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bxs-calendar'></i></span>
              <input type="date" name="deadline" id="basic-icon-default-company" class="form-control" placeholder="Tanggal tenggat project" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-email">Deskripsi</label>
            <div class="input-group input-group-merge">
              <span class="input-group"></span>
                <div>
                  <textarea name="deskripsi" cols="125" placeholder="Deskripsi task / project anda"></textarea>
                </div>              
            </div>
          </div>
          <button type="submit" class="btn btn-primary">Send</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
