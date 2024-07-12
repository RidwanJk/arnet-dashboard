<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Telkom | Tambah Denah')

@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<?php if (session()->has('fileError')):?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?= session('fileError') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<main class="bd-main p-3 bg-light">

    <form action="/storedocument" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card mb-3">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Nama Perangkat</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Tipe</label>
                    <select class="form-select" id="status" name="status">
                        <!-- <option value="active">Active</option>
                        <option value="inactive">Inactive</option> -->
                    </select>
                </div>

                <div class="mb-3">
                    <label for="brand" class="form-label">Merek</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}">
                </div>

                <div class="mb-3">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial_number" name="serial_number"
                        value="{{ old('serial_number') }}">

                </div>

                <div class="mb-3">
                    <label for="sto" class="form-label">STO</label>
                    <select class="form-select" id="sto" name="sto">
                        <!-- <option value="active">Active</option>
                        <option value="inactive">Inactive</option> -->
                    </select>
                </div>
            </div>

            <!-- ACTION BUTTONS -->
            <div class="card">
                <div class="card-body">
                    <button type="submit" class="btn btn-primary btn-lg">Save</button>
                    <button type="button" class="btn btn-secondary btn-lg"
                        onclick="window.location='{{ route('viewdocument') }}'">Cancel</button>
                </div>
            </div>
            <!-- END OF ACTION BUTTONS -->

    </form>

    <!-- <div class="bg-danger" style="height: 100vh;"></div> -->
</main>

@endsection