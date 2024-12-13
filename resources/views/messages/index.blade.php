<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden sm:rounded-lg">
                <div class="p-6 border-gray-200">
                    <a class="text-white btn btn-primary my-4" href="{{ route('dashboard') }}">Go back</a>

                    <div class="flex gap-4 mb-6">
                        <div class="w-1/4">
                            <div class="space-y-4 messages-sidebar">
                                <div class="filter-option">
                                    <button id="status-all" class="btn w-full active">All</button>
                                </div>
                                <div class="filter-option">
                                    <button id="status-read" class="btn w-full">Read</button>
                                </div>
                                <div class="filter-option">
                                    <button id="status-unread" class="btn w-full">Unread</button>
                                </div>
                                <div class="filter-option">
                                    <button id="date-filter" class="btn w-full">Filter by Date</button>
                                    <input type="date" id="date-input" class="form-control w-full mt-2 hidden" />
                                </div>
                            </div>
                        </div>

                        <div class="flex-1">
                            <div class="mb-6 input-container">
                                <i class="fa-solid fa-magnifying-glass"></i>
                                <input
                                    id="search-input"
                                    type="text"
                                    class="form-control border rounded-lg px-4 py-2"
                                    placeholder="Search messages..." />
                            </div>
                            <table class="table table-messages">
                                <thead class="thead-dark">
                                    <tr>
                                        <th style="width: 80px; height: 50px; position: relative; display: flex; align-items: center; justify-content: center;">
                                            <i style="font-size: 20px;" class="fa-solid fa-inbox"></i>
                                            <span style="position: absolute; top: 0; right: 15px; width: 22px; height: 22px; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px;" class="badge bg-danger messages-count">
                                                @if ($messages->where('read', false)->where('deleted_at', null)->count() > 99)
                                                99+
                                                @else
                                                {{ $messages->where('read', false)->where('deleted_at', null)->count() }}
                                                @endif
                                            </span>
                                        </th>
                                        <th style="width: 30%;">Full Name</th>
                                        <th style="width: 50%;">Message</th>
                                        <th style="width: 10%;">Email</th>
                                        <th style="width: 10%;">Date</th>
                                    </tr>
                                </thead>
                                <tbody id="messages-body">
                                    @if ($messages->count() > 0)
                                    @foreach($messages->sortByDesc('created_at')->where('deleted_at', null) as $message)
                                    <tr class="{{ $message->read ? 'read' : 'unread' }} message-row" data-href="{{ route('messages.read', ['message' => $message->id]) }}">
                                        <td style="width: 80px; height: 50px;">
                                            <i style="display: flex; align-items: center; justify-content: center;" class="fa-solid {{ $message->read ? 'fa-check-circle text-success' : 'fa-exclamation-circle text-danger' }}"></i>
                                        </td>
                                        <td>{{ $message->full_name }}</td>
                                        <td>{{ Str::limit($message->message, 100, '...') }}</td>
                                        <td>{{ $message->email }}</td>
                                        <td data-created="{{ $message->created_at->format('Y-m-d') }}">
                                            {{ $message->created_at->format('j F Y') }}
                                        </td>
                                    </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td colspan="5">
                                            <h3 class="text-center">No messages found.</h3>
                                        </td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/messages.js') }}"></script>
</x-app-layout>