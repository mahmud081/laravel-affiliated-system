<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Make Affiliated User') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="w-full max-w-md">
                        <form action="/change-role" method="POST">
                            @csrf
                            <label for="user" class="block text-sm font-medium text-gray-700">Select to Change Role</label>
                            <div class="flex items-center space-x-4">
                                <select id="user" name="selected_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option disabled selected value="">Select an user</option>
                                    @foreach ($users as $u)
                                    <option value="{{ $u->id }}">{{ $u->name }}</option>
                                    @endforeach
                                </select>
                                <x-primary-button type="submit" class="ml-4">
                                    {{ __('Change') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>