<!DOCTYPE html>
<html>

<head>
    @include('admin.template.head')
</head>

<body>
    @include('admin.template.header')
    @include('admin.template.sidebar')
        <!-- Sidebar Navigation end-->
        <div class="page-content">
            <div class="page-header">
                <div class="container-fluid">
                    @include('admin.template.body')
                    @include('admin.template.footer')
                </div>
            </div>
        </div>
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
