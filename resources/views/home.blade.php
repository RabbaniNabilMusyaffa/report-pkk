@extends('layouts/contentNavbarLayout')

@section('title', 'Daftar Laporan Penjualan')

@section('content')
<h4 class="fw-bold py-3 mb-4" style="color: #696cff;">Laporan - <span class="text-muted fw-bold"> Penjualan Produk</span></h4>


<!-- Basic Bootstrap Table -->
@if (Session::has('message'))
<div class="alert alert-success">
  {{Session::get('message')}}
</div>
@endif
<div class="card">
  <div class="table-responsive text-nowrap">
    <table class="table">
      <thead>
        <tr>
          <th class="text-center">Nama Produk</th>
          <th class="text-center">Tanggal Penjualan</th>
          <th class="text-center">Pendapatan</th>
          <th class="text-center">Aksi</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($data as $item)
          
        <tr>
          <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$item->nama_produk}}</strong></td>
          <td class="text-center">{{$item->tanggal_penjualan}}</td>
          <td class="text-center">{{$item->pendapatan}}</td>
          <td class="text-center">
          <form action="{{route('delete', $item->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('delete')
            <a href="{{route('Laporan-edit', $item -> id)}}" class="btn btn-warning ms-2"><i class='bx bx-edit me-1'></i>Edit</a>
            <button class="btn btn-danger ms-2 deleteButton"><i class="bx bx-trash me-1"></i>Hapus</button>          
          </form>    
          </td>
        </tr>
        @endforeach
      </tbody>
      
    </table>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    $(document).ready(function () {
  // Menangani klik tombol "Delete"
    $('.deleteButton').click(function (e) {
    e.preventDefault(); // Mencegah form dikirim secara langsung
    
    const form = $(this).closest('form'); // Find the nearest form element
    
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success ms-2',
        cancelButton: 'btn btn-danger'
      },
      buttonsStyling: false
    });

    swalWithBootstrapButtons.fire({
      title: 'Sudah Yakin?',
      text: "Perubahan tidak akan bisa dikembalikan",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yakin',
      cancelButtonText: 'Tidak',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
        // Jika pengguna mengonfirmasi, kirim form penghapusan
        form.submit(); // Submit only the form associated with the clicked button
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        swalWithBootstrapButtons.fire(
          'Dibatalkan',
          'Tidak ada perubahan terhadap data ini',
          'error'
        );
      }
    });
  });
});
</script>
@endsection
