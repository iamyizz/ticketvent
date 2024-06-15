<!DOCTYPE html>
<html>

<head>
    @include('admin.template.head')
    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .table_deg {
            text-align: center;
            margin: auto;
            border: 2px solid #DB6574;
            margin-top: 50px;
            width: 100%;
            max-width: 1200px;
            border-collapse: collapse;
        }
        .table td {
            vertical-align: middle;
        }
        th, td {
            text-align: center;
            vertical-align: middle; 
            padding: 15px; 
            border: 1px solid #343A40;
            height: 100px;
        }
        th {
            background-color: #DB6574;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        td {
            color: white;
        }
        .aksi {
            display: flex;
            flex-direction: column;
            gap: 5px;
            justify-content: center;
        }
        @media screen and (max-device-width: 480px) {
            .table_deg {
                text-align: center;
                margin: auto;
                border: 2px solid #DB6574;
                margin-top: 50px;
                width: 100%;
                max-width: 600px;
            }
        }
    </style>
</head>

<body>
    @include('admin.template.header')
    @include('admin.template.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>Events</h1>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    Tambah Event
                </button>
                <div class="div_deg">
                    <div class="table-responsive">
                        <table class="table table_deg">
                            <thead>
                                <tr>
                                    <th>Nama Event</th>
                                    <th>Kategori Event</th>
                                    <th>Deskripsi</th>
                                    <th>Waktu Mulai</th>
                                    <th>Waktu Selesai</th>
                                    <th>Foto</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($event as $events)
                                <tr>
                                    <td>{{ $events->name }}</td>
                                    <td>{{ $events->category->name }}</td>
                                    <td>{!! Str::limit($events->description, 30) !!}</td>
                                    <td>{{ $events->start_time }}</td>
                                    <td>{{ $events->end_time }}</td>
                                    <td><img width="100" src="/events/{{ $events->image }}" alt=""></td>
                                    <td>
                                        <div class="aksi">
                                            <a class="btn btn-primary" href="{{ url('show_event', $events->id) }}">Lihat</a>
                                            <a class="btn btn-warning" href="{{ url('update_event', $events->id) }}">Edit</a>
                                            <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_event', $events->id) }}">Hapus</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="div_deg">
                    {{ $event->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
    @include('admin.template.footer')

    <!-- Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ url('upload_event') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Nama Event</label>
                            <input type="text" class="form-control" id="name" name="judul" required>
                        </div>
                        <div class="mb-3">
                            <label for="category" class="form-label">Kategori Event</label>
                            <select class="form-control" id="category" name="category" required>
                                @foreach ($category as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Deskripsi</label>
                            <textarea class="form-control" id="description" name="deskripsi" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="start_time" class="form-label">Waktu Mulai</label>
                            <input type="date" class="form-control" id="start_time" name="start_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="end_time" class="form-label">Waktu Selesai</label>
                            <input type="date" class="form-control" id="end_time" name="end_time" required>
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Foto</label>
                            <input type="file" class="form-control" id="image" name="foto" required>
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

    <!-- JavaScript files-->
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
            }).then((willCancel) => {
                if (willCancel) {
                    window.location.href = urlToRedirect;
                }
            });
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.10.2/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="{{ asset('templateadmin/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('templateadmin/vendor/popper.js/umd/popper.min.js') }}"></script>
    <script src="{{ asset('templateadmin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('templateadmin/vendor/jquery.cookie/jquery.cookie.js') }}"></script>
    <script src="{{ asset('templateadmin/vendor/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('templateadmin/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('templateadmin/js/charts-home.js') }}"></script>
    <script src="{{ asset('templateadmin/js/front.js') }}"></script>
</body>
</html>