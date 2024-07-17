<!-- resources/views/surat/edit.blade.php -->
@extends('layouts.app')

@section('title', 'Telkom | Edit Surat')

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

    <?php if (session()->has('unusual')):?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session('unusual') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <main class="bd-main p-3 bg-light">
        <form action="{{ route('document.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card mb-3">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Device Name</label>
                        <input type="text" class="form-control" id="name" name="name"
                            value="{{ $surat->name }}">
                    </div>

                    <div class="mb-3">
                        <label for="type_id" class="form-label">Type</label>
                        <select class="form-select" id="type_id" name="type_id">
                            <option value="">Choose...</option>
                            @foreach ($type as $item)
                                <option value="{{ $item->id }}" {{ $surat->type_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->subtype }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="brand" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="brand" name="brand"
                            value="{{ $surat->brand }}">
                    </div>

                    <div class="mb-3">
                        <label for="serial" class="form-label">Serial Number</label>
                        <input type="text" class="form-control" id="serial" name="serial"
                            value="{{ $surat->serial }}">
                    </div>

                    <div class="mb-3">
                        <label for="sto_id" class="form-label">STO</label>
                        <select class="form-select" id="sto_id" name="sto_id">
                            <option value="">Choose...</option>
                            @foreach ($sto as $item)
                                <option value="{{ $item->id }}" {{ $surat->sto_id == $item->id ? 'selected' : '' }}>
                                    {{ $item->subtype }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="file" class="form-label">File</label>
                        <input class="form-control" type="file" id="file" name="file">
                        @if ($surat->file)
                            <p>Current File: {{ basename($surat->file) }}</p>
                        @endif
                    </div>
                </div>

                <!-- ACTION BUTTONS -->
                <div class="card">
                    <div class="card-body">
                        <button type="submit" class="btn btn-primary btn-lg">Save</button>
                        <a href="{{ route('viewdocument') }}" class="btn btn-secondary btn-lg">Cancel</a>
                    </div>
                </div>
                <!-- END OF ACTION BUTTONS -->
        </form>
    </main>
@endsection
