<x-app-layout>
    <div class="container">
        <h1>Delete Document</h1>
        <p>Are you sure you want to delete this document?</p>
        <form action="{{ route('documents.destroy', $document->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</x-app-layout>


