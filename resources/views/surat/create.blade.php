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
                    <label for="device" class="form-label">Device</label>
                    <input type="text" class="form-control" id="device" name="device" value="{{ old('device') }}">
                </div>

                <div class="mb-3">
                    <label for="type_id" class="form-label">Tipe</label>
                    <select class="form-select" id="type_id" name="type_id">
                    <option value="">Pilih...</option>
                          <?php foreach ($type as $type) : ?>
                            <option value="<?= $type->id ?>" <?= old('type_id') == $type->id ? 'selected' : '' ?>><?= $type->subtype?></option>
                          <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="brand" class="form-label">Merek</label>
                    <input type="text" class="form-control" id="brand" name="brand" value="{{ old('brand') }}">
                </div>

                <div class="mb-3">
                    <label for="serial" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" id="serial" name="serial"
                        value="{{ old('serial_number') }}">
                </div>

                <div class="mb-3">
                    <label for="sto_id" class="form-label">STO</label>
                    <select class="form-select" id="sto_id" name="sto_id">
                     <option value="">Pilih...</option>
                          <?php foreach ($sto as $sto) : ?>
                            <option value="<?= $sto->id ?>" <?= old('sto_id') == $sto->id ? 'selected' : '' ?>><?= $sto->subtype?></option>
                          <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="file" class="form-label">File</label>
                    <input class="form-control" type="file" id="file" name="file">
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