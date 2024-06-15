<!DOCTYPE html>
<html>

<head>
    @include('admin.template.head')
    <style>
        .div_deg{
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 60px;
        }
        input[type='text']{
            width: 400px;
            height: 50px;
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
                    <h1>Edit Kategori</h1>
                    <div class="div_deg">
                        <form action="{{ url('update_category', $dt->id) }}">
                            <input type="text" name="category" value="{{ $dt->name }}">
                            <input class="btn btn-primary" type="submit" value="Update Kategori" >
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
