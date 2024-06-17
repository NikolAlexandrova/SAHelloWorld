<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12" style="background-color: white;">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="col-span-2">
                    <div class="bg-white shadow-md rounded-lg p-4 mb-3 max-w-md mx-auto">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ __("All of the notifications") }}</h3>
                        @foreach ($messages as $index => $message)
                            @php
                                $createdDate = \Carbon\Carbon::parse($message->created_at);
                                $daysUntilExpiry = 30 - $createdDate->diffInDays(now());
                            @endphp
                            <div class="@if(!$message->is_read) bg-light @else bg-danger @endif shadow-md rounded-lg p-4 mb-3 relative max-w-md mx-auto">

                                <div class="flex justify-between">
                                    <a href="{{ route('message.view', $message->id) }}" class="block text-lg font-medium text-blue-600 hover:text-blue-800">
                                        {{ $message->subject }}
                                    </a>
                                    <div class="text-sm text-gray-500">
                                        Sent on: {{ $createdDate->format('Y-m-d') }}
                                    </div>
                                </div>

                                <div class="text-sm text-gray-500">from {{ $message->name }}</div>

                                <form method="POST" action="{{ route('message.delete', $message->id) }}" class="mt-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        {{ __('Delete') }}
                                    </button>
                                </form>

                                <div class="flex justify-end mt-2">
                                    <div class="text-sm text-gray-500">
                                        Expires in: {{ $daysUntilExpiry }} days
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('dashboard.secretary') }}" class="btn btn-primary" style="margin-top: -20px; margin-left: 16px;">
                        Go back
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
