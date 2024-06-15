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
                    <div class="div_deg">
                        <h1>Event Details</h1>
                        <table class="table table-bordered">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $event->name }}</td>
                            </tr>
                            <tr>
                                <th>Category:</th>
                                <td>{{ $event->category->name }}</td>
                            </tr>
                            <tr>
                                <th>Description:</th>
                                <td>{{ $event->description }}</td>
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <td><img width="200" src="/events/{{ $event->image }}" alt=""></td>
                            </tr>
                            <tr>
                                <th>Start Time:</th>
                                <td>{{ $event->start_time }}</td>
                            </tr>
                            <tr>
                                <th>End Time:</th>
                                <td>{{ $event->end_time }}</td>
                            </tr>
                        </table>
                        <a href="{{ url('view_event') }}" class="btn btn-primary">Back to List</a>
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
