<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-warning bg-gradient">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="col-span-2">
                    <div class="bg-white shadow-md rounded-lg p-6 mb-5">
                        <h3 class="text-xl font-semibold text-gray-700 mb-4">{{ __("Reminders") }}</h3>
                        <p class="bg-danger"> These are the messages that are not read</p>
                        @foreach ($messages as $index => $message)
                            @php
                                $createdDate = \Carbon\Carbon::parse($message->created_at);
                                $daysUntilExpiry = 30 - $createdDate->diffInDays(now());
                            @endphp
                            <div
                                class="shadow-md rounded-lg p-6 mb-3 relative"
                                style="@if(!$message->is_read) background-color: #f8f9fa; @else background-color: #b6b3b3; @endif">

                                <div class="flex justify-between">
                                    <a href="{{ route('message.view', $message->id) }}"
                                       class="block text-lg font-medium text-blue-600 hover:text-blue-800">
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
                                    <button type="submit"
                                            class="bg-red-600 hover:bg-red-800 text-white font-bold py-2 px-4 rounded">{{ __('Delete') }}</button>
                                </form>

                                <div class="flex justify-end mt-2">
                                    <div class="text-sm text-gray-500">
                                        Expires in: {{ $daysUntilExpiry }} days
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <button id="read-more" class="mt-4 px-4 go-back">
                        <a href="{{ route('notifications') }}">Go back</a>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        .go-back {
            display: inline-block;
            background-color: #3490dc;
            color: white;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .go-back:hover {
            background-color: #2779bd;
        }
    </style>
</x-app-layout>
