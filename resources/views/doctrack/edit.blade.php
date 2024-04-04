<x-app-layout>
    <div class="container">
        <h1>Edit Document</h1>
        <!-- Edit Form -->
        <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- Add your form fields here -->
            <div class="form-group">
                <label for="department">Department:</label>
                <input type="text" name="department" id="department" value="{{ $document->department }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="personnel">Assigned Personnel:</label>
                <input type="text" name="personnel" id="personnel" value="{{ $document->personnel }}" class="form-control">
            </div>
            <div class="form-group">
                <label for="document">Document:</label>
                <input type="file" name="document" id="document" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Update Document</button>
        </form>

        <!-- Edit Button -->
        <form action="{{ route('doctrack.edit', $document->id) }}" method="GET">
            @csrf
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded edit-button">
                Save
            </button>
        </form>

            <!-- Delete Button -->
        <form action="{{ route('doctrack.destroy', $document->id) }}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded delete-button">
                Delete
            </button>
        </form>

    </div>
</x-app-layout>
