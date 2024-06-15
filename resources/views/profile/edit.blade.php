<!DOCTYPE html>
<html lang="en">

<head>
    @include('admin1.template.head')
    <style>
        /* Custom CSS for Profile Page */
        /* Custom CSS for Profile Page */
        body {
            background-color: #191C24;
        }
        .content {
            padding: 20px;
        }
        .form-section {
            background-color: #191C24;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .form-section h2 {
            color: #ffffff;
            font-size: 20px;
            margin-bottom: 10px;
        }
        .form-section p {
            color: #a1a1a1;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .form-section label {
            color: #ffffff;
        }
        .form-section input[type="text"],
        .form-section input[type="email"],
        .form-section input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #333;
            background-color: #191C24;
            color: #ffffff;
        }
        .form-section button {
            border: #EB1616 solid 1px !important;
            color: #EB1616 !important;
            background-color: transparent !important;
            transition: 0.5s;
        }
        .form-section button:hover {
            color: #fff !important;
            background-color: #EB1616 !important;
        }
        .form-section .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
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

            <!-- Profile Information Form Start -->
            <div class="form-section">
                @include('profile.partials.update-profile-information-form')
            </div>
            <!-- Profile Information Form End -->

            <!-- Update Password Form Start -->
            <div class="form-section">
                @include('profile.partials.update-password-form')
            </div>
            <!-- Update Password Form End -->

            <!-- Delete User Form Start -->
            <div class="form-section">
                @include('profile.partials.delete-user-form')
            </div>
            <!-- Delete User Form End -->

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
</body>

</html>