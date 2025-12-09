@extends('layouts.app')

@section('title', 'Upload Video')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-medium text-xl">Upload Video Baru</h4>
            <a href="{{ route('videos.index') }}" class="btn inline-flex items-center">
                <iconify-icon icon="heroicons:arrow-left"></iconify-icon>
                Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-4">
                        <label class="form-label">Judul Video</label>
                        <input type="text" name="title" class="form-control" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Upload Video</label>
                        <input type="file" name="url_video" class="form-control" accept="video/*" required>
                        <div class="mt-1 text-sm text-slate-500">
                            Format: MP4, MOV, AVI, WMV, FLV, WebM (Max: 50MB)
                        </div>
                        @error('url_video')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary">Upload Video</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
