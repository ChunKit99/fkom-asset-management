@extends('layouts.app')
@section('title', 'Home')
@section('content')

<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-image d-flex justify-content-center align-items-center"
    style="background-image: url({{asset('assets/img/1.jpg')}});
                height: 100vh;background-repeat:no-repeat; background-size:100%;">
</div>


<!-- Footer -->
<footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
        <!-- Section: Text -->
        <section class="mb-4">
            <p>
                FK Assest Management System is developed by:
            </p>
        </section>
        <!-- Section: Text -->

        <!-- Section: Links -->
        <section class="">
            <!--Grid row-->
            <div class="row">
                <!--Grid column-->
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <h5 class="text-uppercase">Ong Wei Cheng</h5>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>CA19098</p>
                                </li>
                                <li>
                                    <p>Vendor Management</p>
                                    <p>Location Management</p>
                                </li>
                                <li>
                                    <a href="https://github.com/GHTAM" class="text-white">Github</a>
                                </li>
                            </ul>
                        </div>

                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col">
                            <h5 class="text-uppercase">Tua Yong Liang</h5>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>CA19103</p>
                                </li>
                                <li>
                                    <p>Maintenance Management</p>
                                <li>
                                    <a href="https://github.com/yongliangt" class="text-white">Github</a>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col">
                            <h5 class="text-uppercase">Liong Woei Chi</h5>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>CA19104</p>
                                </li>
                                <li>
                                    <p>Authentication</p>
                                    <p>User Management</p>
                                </li>
                                <li>
                                    <a href="https://github.com/WoeiChi" class="text-white">Github</a>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col">
                            <h5 class="text-uppercase">Kong Choon</h5>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>CA19108</p>
                                </li>
                                <li>
                                    <p>Budget Management</p>
                                    <p>Report</p>
                                </li>
                                <li>
                                    <a href="https://github.com/KongChoon" class="text-white">Github</a>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->

                        <!--Grid column-->
                        <div class="col">
                            <h5 class="text-uppercase">Liew Chun Kit</h5>

                            <ul class="list-unstyled mb-0">
                                <li>
                                    <p>CA19115</p>
                                </li>
                                <li>
                                    <p>Asset Management</p>
                                </li>
                                <li>
                                    <a href="https://github.com/ChunKit99" class="text-white">Github</a>
                                </li>
                            </ul>
                        </div>
                        <!--Grid column-->
                    </div>
                    <!--Grid row-->
        </section>
        <!-- Section: Links -->
    </div>
</footer>
<!-- Footer -->
@endsection