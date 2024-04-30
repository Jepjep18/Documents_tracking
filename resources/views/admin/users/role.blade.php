<x-admin-layout>
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">

            <div class="py-12 w-full">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-2">
                        <div class="flex p-2">
                            <a href="{{ route('admin.users.index') }}"
                                class="px-4 py-2 bg-green-700 hover:bg-green-500 text-slate-100 rounded-md">Users
                                Index</a>
                        </div>
                        <div class="flex flex-col p-2 bg-slate-100">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Profile Information') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __("Update your account's profile information and email address.") }}
                                    </p>
                                </header>

                                <form id="send-verification" method="post" action="{{ route('verification.send') }}">
                                    @csrf
                                </form>

                                <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('patch')

                                    <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" name="name" type="text"
                                            class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus
                                            autocomplete="name" />
                                        <x-input-error class="mt-2" :messages="$errors->get('name')" />
                                    </div>

                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" name="email" type="email"
                                            class="mt-1 block w-full" :value="old('email', $user->email)" required
                                            autocomplete="username" />
                                        <x-input-error class="mt-2" :messages="$errors->get('email')" />

                                        @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                                            <div>
                                                <p class="text-sm mt-2 text-gray-800">
                                                    {{ __('Your email address is unverified.') }}

                                                    <button form="send-verification"
                                                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                        {{ __('Click here to re-send the verification email.') }}
                                                    </button>
                                                </p>

                                                @if (session('status') === 'verification-link-sent')
                                                    <p class="mt-2 font-medium text-sm text-green-600">
                                                        {{ __('A new verification link has been sent to your email address.') }}
                                                    </p>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                                        @if (session('status') === 'profile-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                {{ __('Saved.') }}</p>
                                        @endif
                                    </div>
                                </form>
                            </section>
                        </div>
                        <div class="flex flex-col p-2 bg-slate-100">
                            <section>
                                <header>
                                    <h2 class="text-lg font-medium text-gray-900">
                                        {{ __('Update Password') }}
                                    </h2>

                                    <p class="mt-1 text-sm text-gray-600">
                                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                                    </p>
                                </header>

                                <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                                    @csrf
                                    @method('put')

                                    <div>
                                        <x-input-label for="update_password_current_password" :value="__('Current Password')" />
                                        <x-text-input id="update_password_current_password" name="current_password"
                                            type="password" class="mt-1 block w-full" autocomplete="current-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password" :value="__('New Password')" />
                                        <x-text-input id="update_password_password" name="password" type="password"
                                            class="mt-1 block w-full" autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                                    </div>

                                    <div>
                                        <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
                                        <x-text-input id="update_password_password_confirmation"
                                            name="password_confirmation" type="password" class="mt-1 block w-full"
                                            autocomplete="new-password" />
                                        <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <x-primary-button>{{ __('Save') }}</x-primary-button>

                                        @if (session('status') === 'password-updated')
                                            <p x-data="{ show: true }" x-show="show" x-transition
                                                x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                                                {{ __('Saved.') }}</p>
                                        @endif
                                    </div>
                                </form>
                            </section>

                        </div>
                        <div class="mt-6 p-2 bg-slate-100">
                            <h2 class="text-2xl font-semibold">Roles</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($user->roles)
                                    @foreach ($user->roles as $user_role)
                                        <form class="px-4 py-2 bg-red-500 hover:bg-red-700 text-white rounded-md"
                                            method="POST"
                                            action="{{ route('admin.users.roles.remove', [$user->id, $user_role->id]) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">{{ $user_role->name }}</button>
                                        </form>
                                    @endforeach
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">
                                <form method="POST" action="{{ route('admin.users.roles', $user->id) }}">
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="role"
                                            class="block text-sm font-medium text-gray-700">Roles</label>
                                        <select id="role" name="role" autocomplete="role-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}">{{ $role->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('role')
                                        <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                            </div>
                            <div class="sm:col-span-6 pt-5">
                                <button type="submit"
                                    class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                            </div>
                            </form>
                        </div>

                        <div class="mt-6 p-2 bg-slate-100">
                            <h2 class="text-2xl font-semibold">Department</h2>
                            <div class="flex space-x-2 mt-4 p-2">
                                @if ($user->department)
                                    <div class="px-4 py-2 bg-blue-500 hover:bg-blue-700 text-white rounded-md">
                                        {{ $user->department->name }}
                                    </div>
                                @endif
                            </div>
                            <div class="max-w-xl mt-6">


                                <form method="POST" action="{{ route('admin.users.departments', $user->id) }}">
                                    <!-- Form fields -->
                                    @csrf
                                    <div class="sm:col-span-6">
                                        <label for="department"
                                            class="block text-sm font-medium text-gray-700">Department</label>
                                        <select id="department" name="department" autocomplete="department-name"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            <option value="">Select a department</option>
                                            @foreach ($departments as $department)
                                                <option value="{{ $department->id }}">{{ $department->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('department')
                                        <span class="text-red-400 text-sm">{{ $message }}</span>
                                    @enderror
                                    <div class="sm:col-span-6 pt-5">
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-500 hover:bg-green-700 rounded-md">Assign</button>
                                    </div>
                                </form>

                                <form method="POST"
                                    action="{{ route('admin.users.remove.department', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                        Remove Department
                                    </button>
                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>

        </div>
    </div>
</x-admin-layout>
