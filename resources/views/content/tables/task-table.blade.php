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
        <tr data-task-id="{{$task->id}}">
          <td class="text-center"><i class="fab fa-angular fa-lg text-danger me-3"></i> <strong>{{$task->title}}</strong></td>
          <td class="text-center">{{$task->created_at->format('Y-m-d')}}</td>
          <td class="text-center">{{$task->deadline}}</td>
          <td class="text-center taskStatus" data-deadline="{{$task->deadline}}">
            <span class="badge bg-primary">Active</span>
          </td>
          <td class="text-center">
            <form action="{{route('task-delete', $task->id)}}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('delete')
              <div>
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></button>
                <div class="dropdown-menu">
                  <a class="dropdown-item text-info" href="{{route('task-detail', $task->id)}}"><i class="bx bx-detail me-1 "></i> Detail</a>
                  <button class="dropdown-item text-success doneButton"><i class="bx bx-check me-1"></i>Done</button>
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

<script>
  $(document).ready(function () {
    // Function to update the background color based on the deadline
    function updateStatusBackground() {
      const today = new Date();
      $('.taskStatus').each(function () {
        const taskId = $(this).closest('tr').data('task-id');
        const storedStatus = localStorage.getItem(`taskStatus_${taskId}`);
        let statusText = '';

        if (storedStatus === 'Done') {
          statusText = 'Done';
          $(this).find('.badge').removeClass('bg-primary bg-warning bg-danger').addClass('bg-success').text(statusText);
        } else {
          const deadline = new Date($(this).data('deadline'));
          const daysUntilDeadline = Math.floor((deadline - today) / (1000 * 60 * 60 * 24));

          if (daysUntilDeadline <= 0) {
            statusText = 'Task telah tenggat';
            $(this).find('.badge').removeClass('bg-primary bg-warning').addClass('bg-danger').text(statusText);
          } else if (daysUntilDeadline <= 5) {
            statusText = 'Task dekat dengan tenggat';
            $(this).find('.badge').removeClass('bg-primary bg-danger').addClass('bg-warning').text(statusText);
          } else {
            statusText = 'Task sedang dikerjakan';
            $(this).find('.badge').removeClass('bg-warning bg-danger').addClass('bg-primary').text(statusText);
          }
        }
      });
    }

    // Initial update of status background
    updateStatusBackground();

    // Handle "Done" button click
    $('.doneButton').click(function (e) {
      e.preventDefault();

      const form = $(this).closest('form');
      const statusCell = form.closest('tr').find('.taskStatus');
      statusCell.find('.badge').removeClass('bg-primary bg-warning bg-danger').addClass('bg-success').text('Done');

      // Store the updated status in local storage
      const taskId = form.closest('tr').data('task-id');
      localStorage.setItem(`taskStatus_${taskId}`, 'Done');

      // You can also submit the form or perform other actions here if needed.
    });
  });
</script>





@endsection
