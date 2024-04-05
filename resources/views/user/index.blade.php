<x-app-layout>
    <div class="container mx-auto">
        <div class="flex justify-center">
            <div class="w-full sm:w-2/3 md:w-1/2 lg:w-1/3">
                <div class="bg-white shadow-md rounded-lg">
                    <div class="bg-gray-100 px-4 py-2 border-b border-gray-200">
                        <h2 class="text-xl font-semibold">User Management</h2>
                    </div>

                    <div class="p-4">
                        <!-- Display Users -->
                        <table class="w-full border-collapse border border-gray-300">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 text-left">Name</th>
                                    <th class="px-4 py-2 text-left">Email</th>
                                    <th class="px-4 py-2 text-left">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="border-b border-gray-200">
                                        <td class="px-4 py-2">{{ $user->name }}</td>
                                        <td class="px-4 py-2">{{ $user->email }}</td>
                                        <td class="px-4 py-2">
                                            <!-- Add actions here -->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <!-- Pagination Links -->
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
