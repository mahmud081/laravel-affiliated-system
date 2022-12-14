<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @can('can-affiliate')
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <x-input-label value="Referral Link (share and create affiliated user with this link)" />
                    <x-text-input class="block mt-1 w-full" type="text" value="{{ Auth::user()->refer_link() }}" readonly />
                </div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">
                    <div class="flex items-center justify-between space-x-4">
                        <div>Generated Codes (use these codes during registration to make affiliated user)</div>
                        <form action="/generate_code" method="POST">
                            @csrf
                            <x-secondary-button type='submit'>Generate New</x-secondary-button>
                        </form>

                    </div>
                    <ul>
                        @forelse ($codes as $code)
                        <li>{{$code->gen_code}}</li>
                        @empty
                        <p class="text-gray-500 font-medium">No codes generated yet, generate one by pressing 'Generate new'</p>
                        @endforelse
                    </ul>
                </div>
            </div>
            @else
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 ">Welcome to your dashboard!</div>
            </div>
            @endcan

        </div>
    </div>
</x-app-layout>