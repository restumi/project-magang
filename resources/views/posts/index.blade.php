@extends('layouts.app')

@section('content')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="flex justify-between items-center mb-6">
            <h4 class="font-medium text-xl">Posts</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createPostModal">
                Tambah Post
            </button>
        </div>

        @foreach($posts as $post)
        <div class="card mb-6">
            <div class="card-body p-4">
                <div class="flex justify-between items-start mb-4">
                    <div>
                        <h5 class="text-lg font-semibold">{{ $post->title }}</h5>
                        <p class="text-sm text-slate-500">
                            Oleh <strong>{{ $post->user->name }}</strong> • {{ $post->created_at->format('d M Y') }}
                        </p>
                    </div>
                    <div class="space-x-2">
                        @if ($post->user_id == auth()->id())
                            <button
                                type="button"
                                class="text-primary-500 hover:text-primary-700"
                                data-bs-toggle="modal"
                                data-bs-target="#editPostModal"
                                data-id="{{ $post->id }}"
                                data-title="{{ $post->title }}"
                                data-content="{{ $post->content }}"
                            >
                                Edit
                            </button>
                            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-red-500" onclick="return confirm('Hapus post ini?')">Hapus</button>
                            </form>
                        @endif
                    </div>
                </div>
                <h6 class="mb-4 text-lg">{{ $post->content }}</h6>

                <!-- Komentar -->
                <div class="border-t pt-4 mt-4">
                    <h6 class="font-medium mb-2">Komentar ({{ $post->comments->count() }})</h6>
                    @foreach($post->comments as $comment)
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
                    <form action="{{ route('posts.comments.store', $post) }}" method="POST" class="mt-3">
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

<!-- Modal: Tambah Post -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createPostModal" tabindex="-1" aria-labelledby="createPostModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form action="{{ route('posts.store') }}" method="POST">
                @csrf
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="createPostModalLabel">
                        Tambah Post Baru
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="title">
                            Judul
                        </label>
                        <input type="text" name="title" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="content">
                            Konten
                        </label>
                        <textarea name="content" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-6 border-t border-slate-200 dark:border-slate-700 rounded-b-md">
                    <button type="button" class="px-6 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium text-xs leading-tight rounded shadow-md hover:bg-slate-300 dark:hover:bg-slate-600 hover:shadow-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-primary-600 hover:shadow-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out ml-2">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal: Edit Post -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="editPostModal" tabindex="-1" aria-labelledby="editPostModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form id="editPostForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="editPostModalLabel">
                        Edit Post
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <input type="hidden" id="edit_post_id" name="id">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_title">
                            Judul
                        </label>
                        <input type="text" name="title" id="edit_title" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_content">
                            Konten
                        </label>
                        <textarea name="content" id="edit_content" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" rows="3" required></textarea>
                    </div>
                </div>
                <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-6 border-t border-slate-200 dark:border-slate-700 rounded-b-md">
                    <button type="button" class="px-6 py-2.5 bg-slate-200 dark:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium text-xs leading-tight rounded shadow-md hover:bg-slate-300 dark:hover:bg-slate-600 hover:shadow-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out" data-bs-dismiss="modal">
                        Batal
                    </button>
                    <button type="submit" class="px-6 py-2.5 bg-primary-500 text-white font-medium text-xs leading-tight rounded shadow-md hover:bg-primary-600 hover:shadow-lg focus:outline-none focus:ring-0 transition duration-150 ease-in-out ml-2">
                        Perbarui
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Isi modal edit saat tombol diklik
document.querySelectorAll('[data-bs-target="#editPostModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const title = this.getAttribute('data-title');
        const content = this.getAttribute('data-content');

        document.getElementById('edit_post_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_content').value = content;

        document.getElementById('editPostForm').action = `/posts/${id}`;
    });
});
</script>
@endpush
@endsection
