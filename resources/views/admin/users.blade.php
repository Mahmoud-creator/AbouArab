@extends('layouts.dashboard')
@section('content')
    <div class="w-full">
        @if(count($users))
            <div class="flex flex-row gap-2 ml-3 md:ml0 md:w-48 w-full">
                <input type="text" class="rounded-md border-0 placeholder-gray-300" value="" id="search-users" placeholder="Search users">
                <button class="px-2 py-1.5 bg-green-500 text-white hover:bg-green-400 rounded-md border-0">Search</button>
            </div>
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">User</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Phone</th>
                        <th class="py-3 px-6 text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($users as $user)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="mr-2 font-medium text-gray-600 bg-gray-300 text-center w-6 h-6 rounded-full">
                                <span>
                                    {{ substr(ucwords($user->name), 0, 1) }}
                                </span>
                                    </div>
                                    <span class="font-medium">{{ ucwords($user->name) }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $user->email }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $user->phone }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                        </svg>
                                    </div>
                                    <div data-user-id="{{ $user->id }}"
                                         class="delete-user w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                             stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links('vendor.pagination.tailwind') }}
        @else
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No
                        users</h3>
                </div>
            </div>
        @endif
    </div>
@endsection
@section('footer-scripts')
    <script>
        $(document).ready(function () {
            $('.delete-user').on('click', function () {
                let userId = $(this).data('user-id');
                let row = $(this).parent().parent().parent();
                confirm("Are you sure you want to delete this user?") ? $.ajax({
                    'url': '{{ route('admin.users.delete') }}',
                    'type': 'POST',
                    'data': {
                        'user_id': userId,
                        '_token': '{{ csrf_token() }}'
                    },
                    'success': function (data) {
                        $('#flash-message-container').toggle('hidden');
                        $('#flash-message').text(data.message);
                        setTimeout(function () {
                            $('#flash-message-container').toggle('hidden');
                        }, 2000)
                        row.remove();
                    }
                }) : false
            })
        })
    </script>
@endsection
