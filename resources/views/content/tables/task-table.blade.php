@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="fw-bold py-3 mb-4" style="color: #696cff;">List - <span class="text-muted fw-bold"> Task / Project</span></h4>


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
          <th class="text-center">Task / Project</th>
          <th class="text-center">Tanggal Dibuat</th>
          <th class="text-center">Tanggal Tenggat</th>
          <th class="text-center">Status</th>
          <th class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody class="table-border-bottom-0">
        @foreach ($tasks as $task)

        {{-- @php
        $deadline = new DateTime($task->deadline);
        $currentDate = new DateTime();
        $daysRemaining = $currentDate->diff($deadline)->days;
        
        if ($daysRemaining <= 5 && $daysRemaining >= 0) {
          $statusClass = 'bg-label-warning';
          $status = 'Task dekat dengan deadline';
        } elseif ($daysRemaining < 0) {
          $statusClass = 'bg-label-danger';
          $status = 'Task telah tenggat';
        } else {
          $statusClass = 'bg-label-primary';
          $status = 'Task sedang dikerjakan';
        }
        @endphp --}}

        @php
        // Calculate the difference in days between the current date and the task's deadline
        $currentDate = now();
        $deadline = \Carbon\Carbon::parse($task->deadline);
        $daysUntilDeadline = $currentDate->diffInDays($deadline);
        
        // Define a variable to hold the CSS class based on the days until the deadline
        $statusClass = '';
        
        // Determine the CSS class based on the days until the deadline
        if ($daysUntilDeadline <= 0) {
          // Deadline has passed, use 'bg-label-danger'
          $statusClass = 'bg-label-danger';
        } elseif ($daysUntilDeadline <= 5) {
          // Deadline is within 5 days, use 'bg-label-warning'
          $statusClass = 'bg-label-warning';
        } else {
          // Default to 'bg-label-primary' for other cases
          $statusClass = 'bg-label-primary';
        }
        @endphp

        <tr>
          <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$task -> title}}</strong></td>
          <td class="text-center">{{$task -> created_at->format('Y-m-d')}}</td>
          <td class="text-center">{{$task -> deadline}}</td>
          <td class="text-center taskStatus"><span class="badge {{$statusClass}} me-1">
            @if ($daysUntilDeadline <= 0)
            Passed
           @elseif ($daysUntilDeadline == 1)
            Tomorrow
          @elseif ($daysUntilDeadline <= 5)
          {{$daysUntilDeadline}} days left
          @else
          Sedang dikerjakan
          @endif
          </span></td>
          <td class="text-center">
            <form action="{{route('task-delete', $task -> id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('delete')
              <div>
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-info" href="{{route('task-detail', $task -> id)}}"><i class="bx bx-detail me-1 "></i> Detail</a>
                  {{-- <a class="dropdown-item" href=""><i class="bx bx-trash me-1"></i> Delete</a> --}}
                  <button class="dropdown-item text-danger deleteButton"><i class="bx bx-trash me-1"></i>Hapus</button>
                </div>
              </div>
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
