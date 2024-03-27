<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="bg-white shadow-md rounded my-6">
                    <div class="px-6 py-4 border-b border-gray-200 font-semibold uppercase">
                        Document Tracking
                    </div>

                    <div class="p-6">
                        <table class="w-full table-fixed">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="w-1/6 py-2">Personnel/Office</th>
                                    <th class="w-2/6 py-2">Uploaded Documents</th>
                                    <th class="w-1/6 py-2">Accept Date</th>
                                    <th class="w-2/6 py-2">Reuploaded Documents</th>
                                    <th class="w-1/6 py-2">Released Date</th>
                                    <th class="w-1/6 py-2">Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($documents as $document)
                                <tr class="border-b border-gray-200">
                                    <td class="py-2">
                                        <!-- Dropdown for Personnel/Office -->
                                        <select class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                            <option>{{ $document->personnel_office }}</option>
                                            <!-- Add options here -->
                                        </select>
                                    </td>
                                    <td class="py-2">
                                        <!-- File upload for Uploaded Documents -->
                                        <input type="file" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                    </td>
                                    <td class="py-2">
                                        <!-- Automatic date generation for Accept Date -->
                                        {{ now()->toDateString() }}
                                    </td>
                                    <td class="py-2">
                                        <!-- Download button for Reuploaded Documents -->
                                        <a href="#" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                            Download
                                        </a>
                                    </td>
                                    <td class="py-2">
                                        <!-- Automatic date generation for Released Date -->
                                        {{ now()->toDateString() }}
                                    </td>
                                    <td class="py-2">
                                        <!-- Checkboxes for Remarks -->
                                        <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600">
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
</x-app-layout>