<!--
=========================================================
* Argon Dashboard - v1.2.0
=========================================================
* Product Page: https://www.creative-tim.com/product/argon-dashboard


* Copyright  Creative Tim (http://www.creative-tim.com)
* Coded by www.creative-tim.com



=========================================================
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Sistem Kasir || Admin</title>

    <!-- Fonts -->
    @include('includes.font')

    <!-- Icons -->
    @include('includes.icon')

    <!-- Page plugins -->
    <!-- Argon CSS -->
    @include('includes.css')
</head>

<body>
    <!-- Sidenav -->
    @include('layouts.apps.admin.admin-sidebar')

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        @include('layouts.apps.top-navbar')

        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            @yield('breadcrumb')
                        </div>
                    </div>

                    <!-- Card stats -->
                    @yield('card-stats')

                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')

            <!-- Footer -->
            @include('layouts.apps.footer')
        </div>
    </div>

    <!-- Sweet Alert -->
    @include('sweetalert::alert')

    <!-- Argon Scripts -->
    <!-- Core -->
    @include('includes.core')

    <!-- Optional JS -->
    @include('includes.optional-js')

    <!-- Argon JS -->
    @include('includes.argon-js')
</body>
</html>
