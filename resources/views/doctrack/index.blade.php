<x-admin-layout>

    <div class="border border-gray-300 rounded-md p-4">
        <button id="openModalButton" class="px-4 py-2 bg-blue-500 text-white font-semibold uppercase">Create Documents</button>
    </div>
    <div class="container mx-auto max-w-20x"> <!-- Increased width -->
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 border-b border-gray-200 font-semibold uppercase">
                        <i class="fas fa-file-alt mr-2"></i> Document Tracking
                    </div>

                    <div class="p-10">
                        <table class="w-full table-fixed">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="w-1/12 py-2 text-left">Department</th>
                                    <th class="w-1/12 py-2 text-left">Personnel</th>
                                    <th class="w-2/12 py-2 text-left">Uploaded Documents</th>
                                    <th class="w-1/12 py-2 text-left">Created Date</th>
                                    <th class="w-1/12 py-2 text-left">Accept Date</th>
                                    <th class="w-2/12 py-2 text-left">Reuploaded Documents</th>
                                    <th class="w-1/12 py-2 text-left">Released Date</th>
                                    <th class="w-1/12 py-2 text-left">Remarks</th>
                                    <th class="w-1/12 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                <tr>
                                    <td class="py-2">{{ $document->department }}</td>
                                    <td class="py-2">{{ $document->personnel }}</td>
                                    <td class="py-2">
                                        <a href="{{ asset('upload/' . $document->file_name) }}" download class="text-blue-600 hover:text-blue-800 font-semibold">{{ $document->file_name }}</a>
                                    </td>
                                    <td class="py-2">{{ $document->created_at }}</td>
                                    <td class="py-2 @if (!$document->acceptance || !$document->acceptance->accepted_at) text-red-500 @endif">
                                        {{ $document->acceptance ? $document->acceptance->accepted_at : 'Not Accepted Yet' }}
                                    </td>
                                    <td class="py-2">
                                        @if ($document->acceptance && $document->acceptance->reuploaded_file_name)
                                            <a href="{{ route('download.reupload', ['file' => $document->acceptance->reuploaded_file_name]) }}" class="text-blue-600 hover:text-blue-800 font-semibold download-link" download>{{ $document->acceptance->reuploaded_file_name }}</a>
                                        @else
                                            <span class="@if (!$document->acceptance || !$document->acceptance->reuploaded_file_name) text-red-500 @endif">No Reuploaded File</span>
                                        @endif
                                    </td>
                                    <td class="py-2 @if (!$document->acceptance || !$document->acceptance->updated_at) text-red-500 @endif">
                                        {{ $document->acceptance ? $document->acceptance->updated_at : 'Not Released Yet' }}
                                    </td>
                                    <td class="py-2">
                                        @if ($document->department && $document->personnel && $document->file_name && $document->created_at && $document->acceptance && $document->acceptance->accepted_at && $document->acceptance->reuploaded_file_name && $document->acceptance->updated_at)
                                            <button class="bg-green-500 text-white font-semibold px-4 py-2 rounded">Done</button>
                                        @else
                                            <button class="bg-red-500 text-white font-semibold px-4 py-2 rounded">Pending</button>
                                        @endif
                                    </td>
                                    <td class="py-2 text-left">
                                        <div style="display: flex; justify-content: center;">
                                            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit-button" id="editButton{{$document->id}}" onclick="location.href='{{ route('doctrack.edit', $document->id) }}'">Edit</button>
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

    <!-- Modal -->
    <div id="modal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2">
            <!-- Modal Content -->
            <h2 class="text-lg font-semibold mb-4">Create Documents</h2>
            <form action="{{ route('doctrack.store') }}" method="POST" enctype="multipart/form-data">
                @csrf <!-- Add CSRF token -->
                <div class="mb-4">
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <select id="department" name="department" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                        <!-- Populate options with department data -->
                        @foreach($departments as $department)
                        <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="personnel" class="block text-sm font-medium text-gray-700">Assigned Personnel</label>
                    <select id="personnel" name="personnel" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                        <!-- Populate options with personnel users -->
                        @foreach($personnelUsers as $personnelUser)
                        <option value="{{ $personnelUser->name }}">{{ $personnelUser->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="document" class="block text-sm font-medium text-gray-700">Upload Document</label>
                    <input type="file" id="document" name="document" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                </div>
                <div class="mb-4">
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white font-semibold rounded">Submit</button>
                </div>
            </form>
            <button id="closeModalButton" class="mt-4 px-4 py-2 bg-blue-500 text-white font-semibold rounded">Close</button>
        </div>
    </div>



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

</x-admin-layout>
