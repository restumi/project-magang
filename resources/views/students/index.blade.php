@extends('layouts.app')

@section('title', 'Students')

@section('content')
<div class="flex justify-between flex-wrap items-center mb-6">
    <h4 class="font-medium lg:text-2xl text-xl capitalize text-slate-900 inline-block ltr:pr-4 rtl:pl-4 mb-4 sm:mb-0">
        Students
    </h4>
    <div class="flex sm:space-x-4 space-x-2 sm:justify-end items-center rtl:space-x-reverse">
        <button type="button" class="btn inline-flex justify-center bg-white text-slate-700 dark:bg-slate-700 dark:text-white"
                data-bs-toggle="modal" data-bs-target="#createStudentModal">
            <span class="flex items-center">
                <iconify-icon class="text-xl ltr:mr-2 rtl:ml-2 font-light" icon="heroicons-outline:plus"></iconify-icon>
                <span>Tambah Student</span>
            </span>
        </button>
    </div>
</div>

<!-- Daftar Student -->
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
                                        <th class="table-th">Nama</th>
                                        <th class="table-th">Nisn</th>
                                        <th class="table-th">Nomor HP</th>
                                        <th class="table-th text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-slate-100 dark:bg-slate-800 dark:divide-slate-700">
                                    @forelse($students as $student)
                                        <tr>
                                            <td class="table-td">
                                                <div class="text-sm font-medium text-slate-600 dark:text-slate-300">{{ $student->name }}</div>
                                            </td>
                                            <td class="table-td">
                                                <div class="text-sm font-medium text-slate-600 dark:text-slate-300">
                                                    {{ $student->nisn->nisn }}
                                                </div>
                                            </td>
                                            <td class="table-td">
                                                @if($student->phones->count())
                                                    <ul class="space-y-1">
                                                        @foreach($student->phones as $phone)
                                                            <li class="text-sm text-slate-600 dark:text-slate-300">{{ $phone->number }}</li>
                                                        @endforeach
                                                    </ul>
                                                @else
                                                    <span class="text-sm text-slate-400">-</span>
                                                @endif
                                            </td>
                                            <td class="table-td text-center">
                                                <div class="flex justify-center space-x-3 rtl:space-x-reverse">
                                                    <!-- Edit -->
                                                    <button type="button" class="text-primary-500 hover:text-primary-700"
                                                            data-bs-toggle="modal" data-bs-target="#editStudentModal"
                                                            data-id="{{ $student->id }}"
                                                            data-name="{{ $student->name }}"
                                                            data-nisn="{{ $student->nisn }}"
                                                            data-phones="{{ json_encode($student->phones->pluck('number')) }}">
                                                        <iconify-icon icon="heroicons:pencil-square"></iconify-icon>
                                                    </button>
                                                    <!-- Delete -->
                                                    <form action="{{ route('students.destroy', $student) }}" method="POST" class="inline">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" class="text-danger-500 hover:text-danger-700"
                                                                onclick="return confirm('Hapus student ini? Nomor HP juga akan terhapus.')">
                                                            <iconify-icon icon="heroicons:trash"></iconify-icon>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="table-td text-center text-slate-500">Belum ada data student.</td>
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

<!-- Modal: Tambah Student -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="createStudentModal" tabindex="-1" aria-labelledby="createStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form action="{{ route('students.store') }}" method="POST">
                @csrf
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="createStudentModalLabel">
                        Tambah Student
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="name">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="nisn">
                            NISN
                        </label>
                        <input type="text" name="nisn" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2">
                            Nomor HP
                        </label>
                        <div id="phoneContainer">
                            <div class="flex items-center mb-2">
                                <input type="text" name="phones[]" class="form-control block flex-1 px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" placeholder="Contoh: 08123456789" required>
                                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-phone" style="display: none;">
                                    <iconify-icon icon="heroicons:minus-circle"></iconify-icon>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="addPhone" class="text-sm text-primary-500 hover:text-primary-700 flex items-center">
                            <iconify-icon icon="heroicons-outline:plus-circle" class="mr-1"></iconify-icon>
                            Tambah Nomor HP
                        </button>
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

<!-- Modal: Edit Student -->
<div class="modal fade fixed top-0 left-0 hidden w-full h-full outline-none overflow-x-hidden overflow-y-auto" id="editStudentModal" tabindex="-1" aria-labelledby="editStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog relative w-auto pointer-events-none top-1/4">
        <div class="modal-content border-none shadow-lg relative flex flex-col w-full pointer-events-auto bg-white dark:bg-slate-900 bg-clip-padding rounded-md outline-none text-current">
            <form id="editStudentForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header flex flex-shrink-0 items-center justify-between p-6 border-b border-slate-200 dark:border-slate-700 rounded-t-md">
                    <h5 class="text-xl font-medium leading-normal text-slate-800 dark:text-slate-200" id="editStudentModalLabel">
                        Edit Student
                    </h5>
                    <button type="button" class="btn-close box-content w-4 h-4 p-1 text-slate-500 dark:text-slate-300 border-none rounded-none opacity-50 focus:shadow-none focus:outline-none focus:opacity-100 hover:text-slate-800 hover:opacity-75 hover:no-underline" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body relative p-6">
                    <input type="hidden" id="edit_id" name="id">
                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_name">
                            Nama Lengkap
                        </label>
                        <input type="text" name="name" id="edit_name" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2" for="edit_nisn">
                            NISN
                        </label>
                        <input type="text" name="nisn" id="edit_nisn" class="form-control block w-full px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" required>
                    </div>

                    <div class="mb-4">
                        <label class="block text-slate-700 dark:text-slate-300 text-sm font-medium mb-2">
                            Nomor HP
                        </label>
                        <div id="editPhoneContainer">
                            <!-- Diisi otomatis via JS -->
                        </div>
                        <button type="button" id="addEditPhone" class="text-sm text-primary-500 hover:text-primary-700 flex items-center">
                            <iconify-icon icon="heroicons-outline:plus-circle" class="mr-1"></iconify-icon>
                            Tambah Nomor HP
                        </button>
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
// Create: Tambah nomor HP
document.getElementById('addPhone').addEventListener('click', function() {
    addPhoneField('phoneContainer');
});

// Edit: Tambah nomor HP
document.getElementById('addEditPhone').addEventListener('click', function() {
    addPhoneField('editPhoneContainer');
});

// Fungsi reusable buat tambah field phone
function addPhoneField(containerId) {
    const container = document.getElementById(containerId);
    const index = container.children.length;
    const newPhone = document.createElement('div');
    newPhone.className = 'flex items-center mb-2';
    newPhone.innerHTML = `
        <input type="text" name="phones[]" class="form-control block flex-1 px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" placeholder="Contoh: 08123456789" required>
        <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-phone">
            <iconify-icon icon="heroicons:minus-circle"></iconify-icon>
        </button>
    `;
    container.appendChild(newPhone);
}

// Hapus nomor HP
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-phone')) {
        e.target.closest('.flex').remove();
    }
});

// Isi modal edit saat tombol diklik
document.querySelectorAll('[data-bs-target="#editStudentModal"]').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.getAttribute('data-id');
        const nisn = this.getAttribute('data-nisn');
        const name = this.getAttribute('data-name');
        const phones = JSON.parse(this.getAttribute('data-phones'));

        // Isi data dasar
        document.getElementById('edit_id').value = id;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_nisn').value = nisn;

        // Isi nomor HP
        const container = document.getElementById('editPhoneContainer');
        container.innerHTML = '';
        phones.forEach(number => {
            const phoneDiv = document.createElement('div');
            phoneDiv.className = 'flex items-center mb-2';
            phoneDiv.innerHTML = `
                <input type="text" name="phones[]" class="form-control block flex-1 px-3 py-2 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-800 bg-clip-padding border border-slate-300 dark:border-slate-600 rounded transition ease-in-out focus:text-slate-700 focus:bg-white focus:outline-none" value="${number}" required>
                <button type="button" class="ml-2 text-red-500 hover:text-red-700 remove-phone">
                    <iconify-icon icon="heroicons:minus-circle"></iconify-icon>
                </button>
            `;
            container.appendChild(phoneDiv);
        });

        // Set action form
        document.getElementById('editStudentForm').action = `/students/${id}`;
    });
});
</script>
@endpush
@endsection
