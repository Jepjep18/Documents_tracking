<x-app-layout>
    <div id="reuploadModal" class="hidden fixed inset-0 z-50 overflow-auto bg-black bg-opacity-50 flex justify-center items-center">
        <div class="bg-white p-8 rounded shadow-lg w-1/2">
            <h2 class="text-xl font-semibold mb-4">Re-upload Documents</h2>
            <form action="{{ route('document.upload') }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <input type="file" name="file" class="border border-gray-300 p-2 w-full">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded mt-2 hover:bg-blue-600">Upload</button>
            </form>
            <button id="closeModalButton" class="bg-gray-300 text-gray-700 py-2 px-4 rounded hover:bg-gray-400">Close</button>
        </div>
    </div>

    <div class="border border-gray-300 rounded-md p-4">
        <button id="openModalButton" class="px-4 py-2 bg-blue-500 text-white font-semibold uppercase">Re-upload Documents</button>
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
                                    <th class="w-1/6 py-2 text-left">Release Date</th>
                                    <th class="w-1/6 py-2 text-left">Remarks</th>
                                    <th class="w-1/6 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($documents as $document)
                                    <tr>
                                        <td class="py-2 text-left">{{ $document->user->name }}</td>
                                        <td class="py-2 text-left">
                                            <a href="{{ route('document.download', ['file' => $document->file_name]) }}" class="text-blue-600 hover:text-blue-800 font-semibold download-link" data-file="{{ $document->file_name }}">{{ $document->file_name }}</a>
                                        </td>
                                        <td class="py-2 text-left">{{ $document->created_at }}</td>
                                        <td class="py-2 text-left">
                                            @if ($document->acceptance)
                                                {{ $document->acceptance->accepted_at }}
                                            @else
                                                Not Accepted Yet
                                            @endif
                                        </td>
                                        <td class="py-2 text-left">
                                            @if ($document->acceptance && $document->acceptance->reuploaded_file_name)
                                                <a href="{{ route('document.download', ['file' => $document->acceptance->reuploaded_file_name]) }}" class="text-blue-600 hover:text-blue-800 font-semibold download-link" data-file="{{ $document->acceptance->reuploaded_file_name }}">{{ $document->acceptance->reuploaded_file_name }}</a>
                                            @else
                                                No Re-uploaded File
                                            @endif
                                        </td>
                                        <td class="py-2 text-left">{{ $document->acceptance ? $document->acceptance->updated_at : 'Not Released Yet' }}</td>
                                        <td class="py-2 text-left"></td>

                                        <td class="py-2 text-left"></td>
                                        <td class="py-2 text-left"></td>
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
        document.getElementById('openModalButton').addEventListener('click', function() {
            document.getElementById('reuploadModal').classList.remove('hidden');
        });

        document.getElementById('closeModalButton').addEventListener('click', function() {
            document.getElementById('reuploadModal').classList.add('hidden');
        });

        const downloadLinks = document.querySelectorAll('.download-link');
        downloadLinks.forEach(link => {
            link.addEventListener('click', function(event) {
                const file = event.target.dataset.file;
                const confirmation = confirm("Do you want to Accept and Download the File?");
                if (!confirmation) {
                    event.preventDefault(); 
                }
            });
        });
    </script>
</x-app-layout>
