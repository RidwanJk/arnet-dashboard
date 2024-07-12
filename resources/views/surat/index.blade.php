<!-- resources/views/dashboard.blade.php -->
@extends('layouts.app')

@section('title', 'Telkom | Surat STO')

@section('content')

<?php if (session()->has('errors')): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul class="m-0">
        <?php    foreach (session('errors') as $error): ?>
        <li><?= $error ?></li>
        <?php    endforeach; ?>
    </ul>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif;

if (session()->has('success')):?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?= session('success') ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>


<!-- TABLE -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h6 class="card-title text-uppercase">Data Denah STO</h6>
                <div>
                    <a href="/adddenah" class="btn btn-primary mb-4 mt-3">
                        <i class="bi bi-plus me-3"></i>Tambah Denah STO
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered w-100" id="example">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>Nama Perangkat</th>
                                <th>Tipe</th>
                                <th>Merek</th>
                                <th>Serial Number</th>
                                <th>STO</th>                                
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($denah as $d)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $d->name }}</td>
                                    <!-- <td>{{ $d->room }}</td> -->
                                    <td>
                                        @php
                                            $convertedImageUrl = $d->converted_image
                                                ? asset($d->converted_image)
                                                : null;
                                        @endphp
                                        @if ($convertedImageUrl)
                                            <a href="javascript:void(0);" onclick="showImage('{{ $convertedImageUrl }}')">
                                                <img src="{{ $convertedImageUrl }}" alt="{{ $d->name }}" class="img-fluid"
                                                    style="max-width: 100px; max-height: 100px;">
                                            </a>
                                        @else
                                            <img src="public\img\403-error-forbidden-animate.svg" alt="No image available"
                                                class="img-fluid" style="max-width: 100px; max-height: 100px;">
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ asset($d->file) }}" title="Download" class="btn btn-primary" download><i
                                                class="bi bi-download"></i></a>
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('denah.edit', $d->id) }}" class="btn btn-warning">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger h-20" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" onclick="handleDelete({{ $d->id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- END OF TABLE -->

{{-- IMAGE OVERLAY --}}
<div id="imageOverlay" class="image-overlay" style="display: none;">
    <span class="close-btn" onclick="closeImageOverlay()">&times;</span>
    <img id="overlayImage" src="" class="overlay-image">
</div>
{{-- END OF IMAGE OVERLAY --}}

<!-- DELETE MODAL -->
<div class="modal fade" id="deleteModal">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this item?</p>
            </div>

            <div class="modal-footer">
                <a href="javascript:void(0)" class="btn btn-danger">Delete</a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- END OF DELETE MODAL -->



@endsection
<script>
    const handleDelete = (id) => {
        const form = document.getElementById('deleteForm');
        form.action = `/denah/${id}`;
    };

    function showImage(imageUrl) {
        document.getElementById('overlayImage').src = imageUrl;
        document.getElementById('imageOverlay').style.display = "block";
    }

    function closeImageOverlay() {
        document.getElementById('imageOverlay').style.display = "none";
    }
</script>