<x-admin-layout>
    <div class="py-12">
        <div class="max-w-7x1">
            <div class="bg-white">
                <div class="p-6">
                    <div class="container mx-auto px-4 sm:px-8">
                        <div class="py-8">
                            <div>
                                <h2 class="text-2xl font-semibold leading-tight">Admin Permissions</h2>
                            </div>

                            <div class="overflow-x-auto mt-6">
                                <div
                                    class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-zinc-200">
                                    <table class="min-w-full">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="px-6 py-3 border-b border-zinc-200 bg-zinc-50 text-left text-xs leading-4 font-medium text-zinc-500 uppercase tracking-wider">
                                                    Name
                                                </th>

                                                <th
                                                    class="px-6 py-3 border-b border-zinc-200 bg-zinc-50 text-left text-xs leading-4 font-medium text-zinc-500 uppercase tracking-wider">
                                                    Role
                                                </th>
                                                <th class="px-6 py-3 border-b border-zinc-200 bg-zinc-50"></th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            @foreach ($permissions as $permission)
                                                <tr>
                                                    <td class="px-6">
                                                        <div class="flex items-center">
                                                            {{ $permission->name }}
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="">Edit</a>
                                                        <a href="">Delete</a>
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
    </div>
</x-admin-layout>
