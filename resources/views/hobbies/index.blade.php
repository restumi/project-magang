@extends('layouts.app')

@section('title', 'Hobbies')

@section('content')
<div class="flex justify-between flex-wrap items-center mb-6">
    <h4 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-4 sm:mb-0">
        Hobbies
    </h4>
    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
        <button type="button" class="btn inline-flex justify-center bg-white text-slate-700 dark:bg-slate-700 dark:text-white"
                data-bs-toggle="modal" data-bs-target="#createHobbyModal">
            <span class="flex items-center">
                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="heroicons-outline:plus"></iconify-icon>
                <span>Tambah Hobby</span>
            </span>
        </button>
    </div>
</div>

<!-- Daftar Hobbies -->
<div class="grid grid-cols-12 gap-5">
    <div class="col-span-12">
        <div class="card">
            <div class="card-body px-6 py-6">
                <div class="overflow-x-auto -mx-6">
                    <div class="inline-block min-w-full align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-slate-100 table-fixed dark:divide-slate-700">
                                <thead class="bg-slate-200 dark:bg-slate-700">
                                    <tr>
                                        <th class="table-th">Nama Hobby</th>
                                        <th class="table-th">Deskripsi</th>
                                        <th class="table-th text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @forelse($hobbies as $hobby)
                                        <tr>
                                            <td class="table-td">
                                                <div class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $hobby->name }}</div>
                                            </td>
                                            <td class="table-td">
                                                <div class="text-sm text-slate-600 dark:text-slate-300">{{ $hobby->description ?? '-' }}</div>
                                            </td>
                                            <td class="table-td text-center">
                                                <div class="flex justify-center space-x-3 rtl:space-x-reverse">
                                                    <button type="button" class="text-primary-500 hover:text-primary-700"
                                                            data-bs-toggle="modal" data-bs-target="#editHobbyModal"
                                                            data-id="{{ $hobby->id }}"
                                                            data-name="{{ $hobby->name }}"
                                                            data-description="{{ $hobby->description ?? '' }}">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </button>
                                                    <form action="{{ route('hobbies.destroy', $hobby) }}" method="POST" class="inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-danger-500 hover:text-danger-700"
                                                                onclick="return confirm('Hapus hobby ini?')">
                                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="table-td text-center text-slate-500">Belum ada hobby.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Create Hobby -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createHobbyModal" tabindex="-1" aria-labelledby="createHobbyModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form action="{{ route('hobbies.store') }}" method="POST">
                @csrf
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="createHobbyModalLabel">
                        Tambah Hobby Baru
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="name">
                            Nama Hobby
                        </label>
                        <input type="text" name="name" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="description">
                            Deskripsi
                        </label>
                        <textarea name="description" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" rows="3"></textarea>
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

<!-- Modal: Edit Hobby -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="editHobbyModal" tabindex="-1" aria-labelledby="editHobbyModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form id="editHobbyForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="editHobbyModalLabel">
                        Edit Hobby
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_name">
                            Nama Hobby
                        </label>
                        <input type="text" name="name" id="edit_name" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_description">
                            Deskripsi
                        </label>
                        <textarea name="description" id="edit_description" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" rows="3"></textarea>
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
document.querySelectorAll('[data-bs-target="#editHobbyModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const description = this.getAttribute('data-description');

        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_description').value = description;

        document.getElementById('editHobbyForm').action = `/hobbies/${id}`;
    });
});
</script>
@endpush
@endsection
