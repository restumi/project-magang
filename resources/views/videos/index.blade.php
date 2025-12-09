@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-medium text-xl">Videos</h4>
            <a href="{{ route('videos.create') }}" class="btn btn-primary">Upload Video</a>
        </div>

        @foreach($videos as $video)
        <div class="card mb-6">
            <div class="card-body p-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h5 class="text-lg font-semibold">{{ $video->title }}</h5>
                        <p class="text-sm text-slate-500">
                            Oleh <strong>{{ $video->user->name }}</strong> • {{ $video->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div class="space-x-2">
                        @if ($video->user_id == auth()->id())
                            <a href="{{ route('videos.edit', $video) }}" class="text-primary-500">Edit</a>
                            <form action="{{ route('videos.destroy', $video) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Hapus video ini?')">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <video controls class="w-full rounded" src="{{ asset('storage/' . $video->url_video) }}" controls>
                        {{-- <source src="{{ asset('storage/' . $video->url_video) }}" type="video/mp4"> --}}
                        Browser lu gak support video tag.
                    </video>
                </div>

                <!-- Komentar -->
                <div class="border-t pt-4 mt-4">
                    <h6 class="font-medium mb-2">Komentar ({{ $video->comments->count() }})</h6>
                    @foreach($video->comments as $comment)
                    <div class="mb-3 p-3 bg-slate-100 dark:bg-slate-700 rounded">
                        <div class="flex justify-between">
                            <span class="text-sm dark:text-slate-100">
                                <strong>{{ $comment->user->name }}</strong>: {{ $comment->body }}
                            </span>
                            <div class="space-x-2">
                                @if ($comment->user_id == auth()->id())
                                    <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-500 text-sm">Hapus</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <!-- Form Tambah Komentar -->
                    <form action="{{ route('videos.comments.store', $video) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="flex space-x-2">
                            <input type="text" name="body" class="form-control flex-1" placeholder="Tulis komentar..." required>
                            <button type="submit" class="btn btn-sm btn-primary">Kirim</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
