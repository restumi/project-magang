@extends('layouts.app')

@section('title', 'Edit Video')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-medium text-xl">Edit Video</h4>
            <a href="{{ route('videos.index') }}" class="btn inline-flex items-center">
                <iconify-icon icon="heroicons:arrow-left"></iconify-icon>
                Kembali
            </a>
        </div>

        <div class="card">
            <div class="card-body p-4">
                <form action="{{ route('videos.update', $video) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label class="form-label">Judul Video</label>
                        <input type="text" name="title" class="form-control" value="{{ $video->title }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Ganti Video (Opsional)</label>
                        <input type="file" name="url_video" class="form-control" accept="video/*">
                        <div class="mt-1 text-sm text-slate-500">
                            Biarkan kosong jika tidak ingin ganti video
                        </div>
                        <div class="mt-1 text-sm text-slate-500">
                            Format: MP4, MOV, AVI, WMV, FLV, WebM (Max: 50MB)
                        </div>
                        @error('url_video')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    @if($video->url_video)
                        <div class="mb-4">
                            <label class="form-label">Preview Video Saat Ini</label>
                            <video controls class="w-full max-w-md" style="max-height: 300px;">
                                <source src="{{ asset('storage/' . $video->url_video) }}" type="video/mp4">
                                Browser lu gak support video tag.
                            </video>
                        </div>
                    @endif
                    <button type="submit" class="btn btn-primary">Update Video</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
