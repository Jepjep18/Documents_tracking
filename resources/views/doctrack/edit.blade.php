<x-app-layout>
    <div class="container">
        <h1>Edit Document</h1>
        <form action="{{ route('documents.update', $document->id) }}" method="POST">
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
    </div>
</x-app-layout>
