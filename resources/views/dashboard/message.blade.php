<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-lg text-gray-800 leading-tight">
            {{ __('Message Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-white" style="margin-top: 60px;">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="mb-4">
                        <h3 class="text-xl font-semibold text-gray-700">Subject: {{ $message->subject }}</h3>
                        <p class="text-xs text-gray-500 mt-1">from {{ $message->name }} ({{ $message->email }})</p>
                        <p class="text-xs text-gray-500 mt-1">Phone: {{ $message->phone }}</p>
                    </div>
                    <div class="mb-4 p-3 rounded bg-light" style="max-width: 90%;">
                        <h3 class="text-lg font-semibold text-gray-700">Message:</h3>
                        <p class="text-gray-700 mt-2 text-sm">{{ $message->message }}</p>
                    </div>
                    <div class="mt-4 d-flex">
                        <a href="{{ url()->previous() }}" class="btn btn-primary me-2">
                            {{ __('Go Back') }}
                        </a>
                        <a href="mailto:{{ $message->email }}" class="btn btn-secondary me-2">
                            {{ __('Reply') }}
                        </a>
                        <form method="POST" action="{{ route('message.delete', $message->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
