<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- RECAPS -->
<div class="row">
    <div class="col-12 col-lg">
        <div class="card text-bg-primary mb-3">
            <div class="card-body">
                <h5 class="card-title">Active Users</h5>
                <p class="fs-1">15</p>
                <a href="#" class="text-white">See more</a>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg">
        <div class="card text-bg-secondary mb-3">
            <div class="card-body">
                <h5 class="card-title">Access Tokens</h5>
                <p class="fs-1">09</p>
                <a href="#" class="text-white">See more</a>
            </div>
        </div>
    </div>
</div>
<!-- END OF RECAPS -->

<!-- TABLE -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-uppercase">Data table</h6>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="example">
                        <thead class="text-center">
                            <tr>
                                <th>Setting</th>
                                <th>Description</th>
                                <th>Value</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Settings 1</td>
                                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</td>
                                <td>Active</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary mx-1">Edit</a>
                                        <button class="btn btn-danger mx-1">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Settings 2</td>
                                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</td>
                                <td>Active</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary mx-1">Edit</a>
                                        <button class="btn btn-danger mx-1">Delete</button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Settings 3</td>
                                <td>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</td>
                                <td>Active</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="#" class="btn btn-primary mx-1">Edit</a>
                                        <button class="btn btn-danger mx-1">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF TABLE -->

<!-- CHARTS -->
<div class="row align-items-center">
    <!-- DOUGHNUT CHART -->
    <div class="col-12 col-md-4 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-uppercase">Pie chart</h6>
                <canvas id="pieChart"></canvas>
            </div>
        </div>
    </div>
    <!-- END OF DOUGHNUT CHART -->

    <!-- LINE CHART -->
    <div class="col-12 col-md-8 mb-3">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-uppercase">Line chart</h6>
                <canvas id="lineChart"></canvas>
            </div>
        </div>
    </div>
    <!-- END OF LINE CHART -->
</div>
<!-- END OF CHARTS -->


@endsection