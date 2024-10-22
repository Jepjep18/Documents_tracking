<x-personnel-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div id="reuploadModal"
                class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
                <!-- Modal Content -->
                <div class="bg-white p-8 rounded shadow-lg w-1/2">
                    <h2 class="text-xl font-semibold mb-4">Re-upload Documents</h2>
                    <!-- Upload file button -->
                    <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data"
                        class="mb-4">
                        @csrf
                        <input type="file" name="file" class="border border-gray-300 p-2 w-full">
                        <button type="submit"
                            class="bg-blue-500 text-white py-2 px-4 rounded mt-2 hover:bg-blue-600">Upload</button>
                    </form>
                    <!-- Close Button -->
                    <button id="closeModalButton"
                        class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">Close</button>
                </div>
            </div>

            <div class="border border-gray-300 rounded-md p-4">
                <button id="openModalButton" class="px-4 py-2 bg-blue-500 text-white font-semibold uppercase">Re-upload
                    Documents</button>
            </div>

            <div class="container mx-auto">
                <div class="flex justify-center">
                    <div class="w-full lg:w-10/12">
                        <div class="bg-white shadow-md rounded my-6">
                            <div class="px-6 py-4 border-b border-gray-200 font-semibold uppercase">
                                <i class="fas fa-file-alt mr-2"></i> Document Tracking
                            </div>
                            <div class="p-6">
                                <table class="w-full table-fixed">
                                    <thead>
                                        <tr class="bg-gray-100">
                                            <th class="w-1/6 py-2 text-left">Name</th>
                                            <th class="w-2/6 py-2 text-left">Uploaded Documents</th>
                                            <th class="w-1/6 py-2 text-left">Created Date</th>
                                            <th class="w-1/6 py-2 text-left">Accept Date</th>
                                            <th class="w-1/6 py-2 text-left">Re-uploaded Files</th>
                                            <th class="w-1/6 py-2 text-left">Remarks</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($documents as $document)
                                    <tr>
                                        <td class="py-2 text-left">{{ $document->user->name }}</td>

                                        <td class="py-2 text-left">
                                            <a href="#" onclick="return confirmDownload('{{ route('document.download', $document->file_name) }}');" class="text-blue-600 hover:text-blue-800 font-semibold">{{ $document->file_name }}</a>
                                        </td>
                                        <td class="py-2 text-left">{{ $document->created_at }}</td>
                                        <td class="py-2 text-left">
                                            @if ($document->acceptance)
                                                <span style="color: green;">{{ $document->acceptance->accepted_at }}</span>
                                            @else
                                                <span style="color: red;">Not Accepted Yet</span>
                                            @endif
                                        </td>

                                        <td class="py-2 text-left">
                                            @if ($document->acceptance && $document->acceptance->reuploaded_file_name)
                                                <a href="{{ route('document.download', $document->acceptance->reuploaded_file_name) }}" style="color: green;" class="text-blue-600 hover:text-blue-800 font-semibold">{{ $document->acceptance->reuploaded_file_name }}</a>
                                            @else
                                                <span style="color: red;">No Re-uploaded File</span>
                                            @endif
                                        </td>

                                        <td class="py-2 text-center">
                                            @if ($document->acceptance && $document->acceptance->accepted_at && $document->acceptance->reuploaded_file_name)
                                                <span class="text-green-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="text-red-500">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </span>
                                            @endif
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

        </div>
    </div>
    <script>
        function confirmDownload(downloadUrl) {
            if (confirm("Are you sure you want to accept and download the file?")) {
                window.location.href = downloadUrl;
                return true;
            } else {
                return false;
            }
        }

        // Open Modal Button Click Event
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('reuploadModal').classList.remove('hidden');
        });

        // Close Modal Button Click Event
        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('reuploadModal').classList.add('hidden');
        });
    </script>
</x-personnel-layout>
