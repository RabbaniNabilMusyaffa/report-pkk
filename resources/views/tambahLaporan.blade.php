@extends('layouts/contentNavbarLayout')

@section('title', 'Penambahan Laporan')

@section('content')
<h4 class="fw-bold py-3 mb-4" style="color: #696cff;">Tambah - <span class="text-muted fw-bold"> Laporan</span></h4>

<!-- Basic Layout -->
<div class="row">
  <div class="col-xl">
    <div class="card mb-4">
      <div class="card-body">
        <form action="{{route('tambah-data-laporan')}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-fullname">Nama Produk</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-fullname2" class="input-group-text"><i class='bx bxs-food-menu'></i></span>
              <input type="text" name="nama_produk" class="form-control" id="basic-icon-default-fullname" aria-label="John Doe" aria-describedby="basic-icon-default-fullname2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-company">Tanggal Penjualan</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bxs-calendar'></i></span>
              <input type="date" name="tanggal_penjualan" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
            </div>
          </div>
          <div class="mb-3 form-group ">
            <label class="form-label" for="basic-icon-default-company">Pendapatan</label>
            <div class="input-group input-group-merge">
              <span id="basic-icon-default-company2" class="input-group-text"><i class='bx bx-money-withdraw'></i></span>
              <input type="text" name="pendapatan" id="basic-icon-default-company" class="form-control" aria-label="ACME Inc." aria-describedby="basic-icon-default-company2" />
            </div>
          </div>
          
          <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection
