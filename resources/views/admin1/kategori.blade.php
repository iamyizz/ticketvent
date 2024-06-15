<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin1.template.head')
    <style>
        .custom-input {
            border: 2px solid #00f; /* Warna border */
            background-color: #333; /* Warna background */
            color: #fff; /* Warna teks */
        }

        .custom-input:focus {
            border-color: #f00; /* Warna border saat focus */
            background-color: #444; /* Warna background saat focus */
        }
        .mb-3 input {
            background-color: #2a2a2a;
        }
        .mb-3 input:focus {
            background-color: #2a2a2a;
        }
        .mb-3 select {
            background-color: #2a2a2a;
            color: #fff;
        }
        .mb-3 select:focus {
            background-color: #2a2a2a;
        }
    </style>
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        @include('admin1.template.spinner')
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        @include('admin1.template.sidebar')
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            @include('admin1.template.navbar')
            <!-- Navbar End -->

            <!-- Table Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">
                    <div class="col-12">
                        <div class="bg-secondary rounded h-100 p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <button type="button" class="btn btn-outline-primary m-2" data-bs-toggle="modal" data-bs-target="#addEventModal">
                                    Tambah Kategori
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Kategori</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($dt as $p)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $p->name }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#editEventModal" data-id="{{ $p->id }}" data-name="{{ $p->name }}">Edit</button>
                                                    <a onclick="confirmation(event)" href="{{ url('delete_category', $p->id) }}">
                                                        <button type="button" class="btn btn-outline-danger m-2">Hapus</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Add Modal Start -->
            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ url('add_category') }}" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="category" class="form-label">Nama Kategori</label>
                                    <input type="text" id="category" name="category" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Add Modal End -->

            <!-- Edit Modal Start -->
            <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEventModalLabel">Edit Kategori</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="editForm" action="" method="POST">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="editCategory" class="form-label">Nama Kategori</label>
                                    <input type="text" id="editCategory" name="category" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Update Kategori</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Edit Modal End -->

            <!-- Footer Start -->
            @include('admin1.template.footer')
            <!-- Footer End -->
        </div>
        <!-- Content End -->

        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    @include('admin1.template.script')
    <!-- Include Bootstrap JS and dependencies -->
    <script type="text/javascript">
        function confirmation(ev) {
            ev.preventDefault();
            var urlToRedirect = ev.currentTarget.getAttribute('href');
            console.log(urlToRedirect);
            swal({
                    title: "Apakah kamu yakin?",
                    text: "Menghapus ini akan permanen",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willCancel) => {
                    if (willCancel) {
                        window.location.href = urlToRedirect;
                    }
                });
        }

        $('#editEventModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');

            var modal = $(this);
            modal.find('.modal-title').text('Edit Kategori: ' + name);
            modal.find('#editCategory').val(name);
            modal.find('#editForm').attr('action', '{{ url("update_category") }}/' + id);
        });
    </script>
</body>

</html>