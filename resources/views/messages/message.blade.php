<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="shadow-lg rounded-lg overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h1 class="text-xl font-semibold text-gray-800">Message Details</h1>
                    <a
                        href="{{ route('messages.index') }}"
                        class="text-sm px-4 py-2 btn-primary text-white font-medium rounded-md shadow-sm transition">
                        Go Back
                    </a>
                </div>
                <div class="p-6 space-y-6">
                    <div class="space-y-3">
                        <div>
                            <span class="message-span">Name:</span> {{ $message->full_name }}
                        </div>
                        <div>
                            <span class="message-span">Number:</span> {{ $message->number }}
                        </div>
                        <div>
                            <span class="message-span">Country:</span> {{ $message->country }}
                        </div>
                        <div>
                            <span class="message-span">Email:</span> {{ $message->email }}
                        </div>
                        <div>
                            <span class="message-span">Email Sent:</span>
                            {{ $message->created_at->format('j F Y') }} at
                            {{ $message->created_at->format('h:i:s A') }}
                        </div>
                    </div>
                    <div class="text-gray-700">
                        <p class="italic">{{ $message->message }}</p>
                    </div>
                </div>
                <div class="p-6 border-t flex justify-end">
                    <form action="{{ route('messages.destroy', $message->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="text-sm px-4 py-2 bg-red-600 text-white font-medium rounded-md shadow-sm hover:bg-red-700 transition">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>