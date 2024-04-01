<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full lg:w-10/12">
                <div class="bg-white shadow-md rounded my-6">
                    <button id="openModalButton" class="px-4 py-2 bg-blue-500 text-white font-semibold uppercase mb-4">Create Documents</button>
                    <div class="px-6 py-4 border-b border-gray-200 font-semibold uppercase">
                        Document Tracking
                    </div>

                    <!-- Modal -->
                    <div id="modal" class="hidden fixed top-0 left-0 w-full h-full bg-gray-800 bg-opacity-50 flex justify-center items-center">
                        <div class="bg-white p-8 rounded shadow-md w-full md:w-1/2">
                            <!-- Modal Content -->
                            <h2 class="text-lg font-semibold mb-4">Create Documents</h2>
                            <form action="{{ route('doctrack.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf <!-- Add CSRF token -->
                                <div class="mb-4">
                                    <label for="personnel" class="block text-sm font-medium text-gray-700" placeholder="Select Personnel/Office">Personnel/Office</label>
                                    <select id="personnel" name="personnel" class="block w-full mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md">
                                        <option value="Accounting Building">Accounting Building</option>
                                        <option value="RD Evamay">RD Evamay</option>
                                        <option value="Engr Fuentes">Engr Fuentes</option>
                                        <option value="Sir Jasper">Sir Jasper</option>
                                        <option value="Sir Vien">Sir Vien</option>
                                        <option value="Maam Lucky">Maam Lucky</option>
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

                    
                    <div class="p-6">
                        <!-- Table content -->
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
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        
        // JavaScript to handle modal functionality
        const openModalButton = document.getElementById('openModalButton');
        const closeModalButton = document.getElementById('closeModalButton');
        const modal = document.getElementById('modal');

        openModalButton.addEventListener('click', function() {
            modal.classList.remove('hidden');
        });

        closeModalButton.addEventListener('click', function() {
            modal.classList.add('hidden');
        });
    </script>
</x-app-layout>
