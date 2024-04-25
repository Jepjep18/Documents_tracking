<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Edit Document</h1>
        <form action="{{ route('doctrack.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <table class="w-full">
                <tr>
                    <td>
                        <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    </td>
                    <td>
                    <select id="department" name="department" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
                <tr>
                <td>
    <label for="personnel" class="block text-sm font-medium text-gray-700">Assigned Personnel</label>
</td>
<td>
    <select id="personnel" name="personnel" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
        @foreach($personnel as $person)
            <option value="{{ $person->id }}">{{ $person->name }}</option>
        @endforeach
    </select>
</td>

                </tr>
                <tr>
                    <td>
                        <label for="document" class="block text-sm font-medium text-gray-700">Document</label>
                    </td>
                    <td>
                         <input type="file" name="documents[]" id="documents" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md" multiple>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2 float-right">
                            Update Document
                        </button>
                    </td>
                </tr>
            </table>
        </form>
        
        <!-- Delete Button -->
        <form id="deleteForm" action="{{ route('doctrack.destroy', $document->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" onclick="confirmDelete()" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-4">
                Delete
            </button>
        </form>
    </div>

    <script>
        function confirmDelete() {
            if (confirm("Are you sure you want to delete this document?")) {
                document.getElementById('deleteForm').submit();
            }
        }
    </script>
</x-app-layout>


