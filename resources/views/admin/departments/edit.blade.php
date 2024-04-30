<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                        <div class="flex p-2">
                            <a href="{{ route('departments.index') }}"
                                class="px-4 py-2 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Department
                                Index</a>
                        </div>
                        <div class="flex flex-col p-2 bg-slate-100">
                            <div class="space-y-8 divide-y divide-gray-200 w-1/2 mt-10">
                                <form method="POST" action="{{ route('departments.update', $department->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="sm:col-span-6">
                                        <label for="name" class="block text-sm font-medium text-gray-700">
                                            Department name
                                        </label>
                                        <div class="mt-1">
                                            <input type="text" id="name" name="name"
                                                value="{{ $department->name }}"
                                                class="block w-full appearance-none bg-white border border-gray-400 rounded-md py-2 px-3 text-base leading-normal transition duration-150 ease-in-out sm:text-sm sm:leading-5" />
                                        </div>
                                        @error('name')
                                            <span class="text-red-400 text-sm">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="sm:col-span-6 pt-5">
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
