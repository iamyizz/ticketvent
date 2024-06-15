<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin1.template.head')
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            padding-left: 0;
            list-style: none;
            border-radius: 0.25rem;
        }

        .pagination li {
            margin: 0 5px;
        }

        .pagination li a,
        .pagination li span {
            color: #ffffff;
            background-color: #343a40;
            /* Background color matching your theme */
            border: 1px solid #343a40;
            /* Border color matching your theme */
            padding: 0.5rem 0.75rem;
            text-decoration: none;
            border-radius: 0.25rem;
        }

        .pagination li a:hover {
            background-color: #EB1616;
            /* Hover background color */
            border-color: #EB1616;
            /* Hover border color */
            color: #ffffff;
        }

        .pagination .active span {
            color: #ffffff;
            background-color: #EB1616;
            /* Active background color */
            border-color: #EB1616;
            /* Active border color */
        }

        .pagination .disabled span {
            color: #ffffff;
            /* Disabled text color */
            background-color: #343a40;
            /* Disabled background color */
            border-color: #343a40;
            /* Disabled border color */
        }
        .modal-body img {
            width: 100%;
            height: auto;
            margin-bottom: 15px;
        }
        .event-details {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .event-details h5, .event-details p {
            margin: 0;
        }
        .modal-content {
            background-color: #1f1f1f;
            color: #fff;
            border-radius: 8px;
        }
        .modal-header, .modal-footer {
            border-bottom: none;
            border-top: none;
        }
        .modal-header h5 {
            color: #fff;
        }
        .form-control, .form-select {
            background-color: #2c2c2c;
            color: #fff;
            border: 1px solid #555;
        }
        .form-control::placeholder {
            color: #888;
        }
        .form-control:focus, .form-select:focus {
            background-color: #333;
            color: #fff;
            border-color: #888;
            box-shadow: none;
        }
        .form-select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
            background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 4 5"><path fill="%23FFF" d="M2 0L0 2h4L2 0zM2 5L0 3h4l-2 2z"/></svg>');
            background-repeat: no-repeat;
            background-position: right 0.75rem center;
            background-size: 8px 10px;
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
                                    Tambah Event
                                </button>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Foto</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Kategori</th>
                                            <th scope="col">Start Time</th>
                                            <th scope="col">End Time</th>
                                            <th scope="col">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($event as $p)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><img width="100" src="/events/{{ $p->image }}" alt=""></td>
                                                <td>{{ $p->name }}</td>
                                                <td>{{ $p->category->name }}</td>
                                                <td>{{ $p->start_time }}</td>
                                                <td>{{ $p->end_time }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-outline-info m-2" data-bs-toggle="modal" data-bs-target="#viewEventModal" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-category="{{ $p->category->name }}" data-description="{{ $p->description }}" data-start="{{ $p->start_time }}" data-end="{{ $p->end_time }}" data-image="{{ $p->image }}">Lihat</button>
                                                    <button type="button" class="btn btn-outline-warning m-2" data-bs-toggle="modal" data-bs-target="#editEventModal" data-id="{{ $p->id }}" data-name="{{ $p->name }}" data-category="{{ $p->category_id }}" data-description="{{ $p->description }}" data-start="{{ $p->start_time }}" data-end="{{ $p->end_time }}" data-image="{{ $p->image }}">Edit</button>
                                                    <a onclick="confirmation(event)" href="{{ url('delete_event', $p->id) }}">
                                                        <button type="button" class="btn btn-outline-danger m-2">Hapus</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{ $event->onEachSide(1)->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <!-- Table End -->

            <!-- Add Modal Start -->
            <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ url('/upload_event') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="eventName" class="form-label">Nama Event</label>
                                    <input type="text" class="form-control" name="judul" id="eventName" placeholder="Nama Event">
                                </div>
                                <div class="mb-3">
                                    <label for="eventCategory" class="form-label">Kategori Event</label>
                                    <select class="form-select" name="category" id="eventCategory">
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="eventDescription" class="form-label">Deskripsi</label>
                                    <textarea class="form-control" name="deskripsi" id="eventDescription" rows="3" placeholder="Deskripsi"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="add_start_time" class="form-label">Mulai Event</label>
                                    <input type="text" class="form-control flatpickr-input" id="add_start_time" name="start_time" required>
                                </div>
                                <div class="mb-3">
                                    <label for="add_end_time" class="form-label">Event Berakhir</label>
                                    <input type="text" class="form-control flatpickr-input" id="add_end_time" name="end_time" required>
                                </div>
                                <div class="mb-3">
                                    <label for="eventImage" class="form-label">Foto</label>
                                    <input type="file" name="foto" class="form-control" id="eventImage">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Event Modal End -->

            <!-- Edit Modal Start -->
            <div class="modal fade" id="editEventModal" tabindex="-1" aria-labelledby="editEventModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editEventModalLabel">Edit Event</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="editEventForm">
                            @csrf
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="edit_name" class="form-label">Nama Event</label>
                                    <input type="text" class="form-control" id="edit_name" name="judul">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_category" class="form-label">Kategori Event</label>
                                    <select class="form-select" id="edit_category" name="category">
                                        @foreach ($category as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_description" class="form-label">Deskripsi Event</label>
                                    <textarea class="form-control" id="edit_description" name="deskripsi" rows="3" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_start_time" class="form-label">Mulai Event</label>
                                    <input type="date" class="form-control flatpickr-input" id="edit_start_time" name="start_time">
                                </div>
                                <div class="mb-3">
                                    <label for="edit_end_time" class="form-label">Event Berakhir</label>
                                    <input type="date" class="form-control flatpickr-input" id="edit_end_time" name="end_time">
                                </div>
                                <div class="mb-3">
                                    <label>Foto Sekarang</label>
                                    <img id="edit_image" src="" width="150" alt="Event Image">
                                </div>
                                <div class="mb-3">
                                    <label for="image" class="form-label">Ganti Foto</label>
                                    <input type="file" class="form-control" id="image" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Edit Event Modal End -->

            <!-- View Modal Start -->
            <div class="modal fade" id="viewEventModal" tabindex="-1" aria-labelledby="viewEventModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content bg-dark text-light">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewEventModalLabel">Detail Event</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <img id="view_image" src="/events/{{ $p->image }}" alt="Event Image">
                            <div class="event-details">
                                <h5 id="view_name"></h5>
                                <p><strong>Kategori:</strong> <span id="view_category"></span></p>
                                <p><strong>Deskripsi:</strong> <span id="view_description"></span></p>
                                <p><strong>Mulai:</strong> <span id="view_start_time"></span></p>
                                <p><strong>Berakhir:</strong> <span id="view_end_time"></span></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- View Event Modal End -->

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

        $('#editEventModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var name = button.data('name');
            var category = button.data('category');
            var description = button.data('description');
            var start = button.data('start');
            var end = button.data('end');
            var image = button.data('image');

            var modal = $(this);
            modal.find('.modal-body #edit_name').val(name);
            modal.find('.modal-body #edit_category').val(category);
            modal.find('.modal-body #edit_description').val(description);
            modal.find('.modal-body #edit_start_time').val(start);
            modal.find('.modal-body #edit_end_time').val(end);
            modal.find('.modal-body #edit_image').attr('src', '/events/' + image);
            modal.find('#editEventForm').attr('action', '/edit_event/' + id);
        });

        $('#viewEventModal').on('show.bs.modal', function(event) {
            var button = $(event.relatedTarget);
            var name = button.data('name');
            var category = button.data('category');
            var description = button.data('description');
            var start = button.data('start');
            var end = button.data('end');
            var image = button.data('image');

            var modal = $(this);
            modal.find('#view_name').text(name);
            modal.find('#view_category').text(category);
            modal.find('#view_description').text(description);
            modal.find('#view_start_time').text(start);
            modal.find('#view_end_time').text(end);
            modal.find('#view_image').attr('src', '/events/' + image);
        });
        
        flatpickr("#add_start_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            defaultDate: new Date()
        });

        flatpickr("#add_end_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true,
            defaultDate: new Date()
        });

        flatpickr("#edit_start_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });

        flatpickr("#edit_end_time", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            time_24hr: true
        });
    </script>
</body>

</html>
