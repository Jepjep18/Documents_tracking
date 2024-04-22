<x-app-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <div class="border border-gray-300 rounded-md p-4">
        <button id="openModalButton" class="px-4 py-2 bg-blue-500 text-white font-semibold uppercase">Create
            Documents</button>
    </div>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 border-b border-gray-200 font-semibold uppercase">
                        <i class="fas fa-file-alt mr-2"></i> Document Tracking
                    </div>
                    <!-- Modal -->
                    <div id="modal"
                        class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2">
                            <!-- Modal Content -->
                            <h2 class="text-lg font-semibold mb-4">Create Documents</h2>
                            <form action="{{ route('doctrack.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf <!-- Add CSRF token -->
                                <!-- Department dropdown -->
                                <div class="mb-4">
                                    <label for="department" class="block text-sm font-medium text-gray-700 mb-1">Select
                                        Department</label>
                                    <select id="department" name="department"
                                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="">Select Department</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Personnel dropdown -->
                                <div class="mb-4">
                                    <label for="personnel" class="block text-sm font-medium text-gray-700 mb-1">Select
                                        Personnel</label>
                                    <select id="personnel" name="personnel"
                                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="">Select Personnel</option>
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="document" class="block text-sm font-medium text-gray-700 mb-1">Upload
                                        Document</label>
                                    <input type="file" id="document" name="document"
                                        class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                </div>

                                <div class="mb-4 flex justify-end">
                                    <button type="submit"
                                        class="px-4 py-2 bg-blue-500 text-white font-semibold rounded mr-2">Submit</button>
                                    <button id="closeModalButton"
                                        class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded hover:bg-gray-400">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="p-6">
                        <!-- Table content -->
                        <table class="w-full table-fixed">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="w-1/6 py-2 text-left">Department</th>
                                    <th class="w-1/6 py-2 text-left">Personnel</th>
                                    <th class="w-2/6 py-2 text-left">Uploaded Documents</th>
                                    <th class="w-1/6 py-2 text-left">Created Date</th>
                                    <th class="w-1/6 py-2 text-left">Accept Date</th>
                                    <th class="w-2/6 py-2 text-left">Reuploaded Documents</th>
                                    <th class="w-1/6 py-2 text-left">Released Date</th>
                                    <th class="w-1/6 py-2 text-left">Remarks</th>
                                    <th class="w-1/6 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td class="py-2">
                                            @if ($document->user)
                                                {{ optional($document->user->department)->name }}
                                            @else
                                                No User
                                            @endif
                                        </td>
                                        <td class="py-2">
                                            @if ($document->user)
                                                {{ $document->user->name }}
                                            @else
                                                No User
                                            @endif
                                        </td>
                                        <td class="py-2">
                                            <a href="{{ asset('upload/' . $document->file_name) }}" download
                                                class="text-blue-600 hover:text-blue-800 font-semibold">{{ $document->file_name }}</a>
                                        </td>
                                        <td class="py-2">{{ $document->created_at }}</td>
                                        <td class="py-2"><!-- Reuploaded Documents Column --></td>
                                        <td class="py-2"><!-- Released Date Column --></td>
                                        <td class="py-2"><!-- Remarks Column --></td>
                                        <td class="py-2 text-left">
                                            <div style="display: flex; justify-content: center;">
                                                <button
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit-button"
                                                    id="editButton{{ $document->id }}"
                                                    onclick="location.href='{{ route('doctrack.edit', $document->id) }}'">Edit</button>

                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Hide personnel dropdown initially
            $('#personnel').hide();

            // Handle department change event
            $('#department').change(function() {
                var departmentId = $(this).val();
                if (departmentId) {
                    $('#personnel').empty();
                    $('#personnel').append('<option value="">Select Personnel</option>');
                    $.ajax({
                        url: '/get-personnel/' + departmentId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $.each(data, function(key, value) {
                                $('#personnel').append('<option value="' + key + '">' +
                                    value + '</option>');
                            });
                            $('#personnel').show();
                        }
                    });
                } else {
                    $('#personnel').empty();
                    $('#personnel').hide();
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const openModalButton = document.getElementById('openModalButton');
            const closeModalButton = document.getElementById('closeModalButton');
            const modal = document.getElementById('modal');

            openModalButton.addEventListener('click', function() {
                modal.classList.remove('hidden');
            });

            closeModalButton.addEventListener('click', function() {
                modal.classList.add('hidden');
            });
        });
    </script>

</x-app-layout>
