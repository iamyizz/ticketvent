<!DOCTYPE html>
<html>

<head>
    @include('admin.template.head')
    <style>
        .table_deg {
            text-align: center;
            margin: auto;
            border: 2px solid #DB6574;
            width: 100%;
            max-width: 600px;
            margin-top: 50px;
        }
        
        th {
            background-color: #DB6574;
            padding: 15px;
            font-size: 20px;
            font-weight: bold;
            color: white;
        }
        
        td {
            color: white;
            padding: 10px;
            border: 1px solid;
        }
        .page-content {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .page-header {
            flex: 1;
        }
    </style>
</head>

<body>
    @include('admin.template.header')
    @include('admin.template.sidebar')
    <div class="page-content">
        <div class="page-header">
            <div class="container-fluid">
                <h1>Kategori</h1>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#addEventModal">
                    Tambah Event
                </button>
                <div class="container-light-grey">
                        <table class="table table_deg">
                            <thead>
                                <tr>
                                    <th>Nama Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dt as $dt)
                                <tr>
                                    <td>{{ $dt->name }}</td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ url('edit_category',$dt->id) }}">Edit</a>
                                        <a class="btn btn-danger" onclick="confirmation(event)" href="{{ url('delete_category',$dt->id) }}">Hapus</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
        @include('admin.template.footer')
    </div>


    <!-- Modal -->
    <div class="modal fade" id="addEventModal" tabindex="-1" aria-labelledby="addEventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addEventModalLabel">Tambah Event Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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
            })
            .then((willCancel) => {
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
