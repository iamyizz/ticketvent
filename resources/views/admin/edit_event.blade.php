<!DOCTYPE html>
<html>

<head>
    @include('admin.template.head')
    <style>
        .div_deg {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 60px;
        }
        label {
            display: inline-block;
            width: 250px;
            font-size: 18px !important;
        }
        input[type='text'] {
            width: 350px;
            height: 50px;
        }
        textarea {
            width: 450px;
            height: 80px;
        }
        .input_deg {
            padding: 15px;
        }
    </style>
</head>

<body>
    @include('admin.template.header')
    @include('admin.template.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    <h1>Edit Event</h1>
                    <div class="div_deg">
                        <form action="{{ url('edit_event', $data->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="input_deg">
                                <label>Nama Event</label>
                                <input type="text" name="judul" value="{{ $data->name }}" required>
                            </div>
                            <div class="input_deg">
                                <label>Kategori Event</label>
                                <select name="category" required>
                                    @foreach ($category as $category )
                                    <option value="{{ $category->id }}">{{ $category->name }}</option> 
                                    @endforeach
                                </select>
                            </div>
                            <div class="input_deg">
                                <label>Deskripsi Event</label>
                                <textarea name="deskripsi" required>{{ $data->description }}</textarea>
                            </div>
                            <div class="input_deg">
                                <label>Foto Sekarang</label>
                                <img src="/events/{{ $data->image }}" width="150" alt="Event Image">
                            </div>
                            <div class="input_deg">
                                <label>Mulai Event</label>
                                <input value="{{ $data->start_time }}" type="date" name="start_time" id="start_time" class="form-control" required>
                            </div>
                            <div class="input_deg">
                                <label>Event Berakhir</label>
                                <input value="{{ $data->start_time }}" type="date" name="end_time" id="start_time" class="form-control" required>
                            </div>
                            <div class="input_deg">
                                <input class="btn btn-primary" type="submit" value="Tambah Event">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.template.footer')
    <!-- JavaScript files-->
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
