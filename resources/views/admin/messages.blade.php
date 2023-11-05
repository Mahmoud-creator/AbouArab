@extends('layouts.dashboard')
@section('content')
    <div class="w-full">
        <div class="bg-white shadow-md rounded my-6 overflow-auto">
            @if(count($messages))
                <table class="min-w-max w-full table-auto">
                    <thead>
                    <tr class="text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Email</th>
                        <th class="py-3 px-6 text-left">Subject</th>
                        <th class="py-3 px-6 text-center">Message</th>
                    </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                    @foreach($messages as $message)
                        <tr class="border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">

                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $message->name }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $message->email }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $message->subject }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left">
                                <div class="flex items-center">
                                    <span>{{ $message->message }}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
{{--                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">--}}
{{--                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />--}}
{{--                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />--}}
{{--                                        </svg>--}}
{{--                                    </div>--}}
                                    <form action="{{ route('admin.messages.delete') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $message->id }}">
                                        <button class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No messages</h3>
                </div>
            @endif
        </div>
    </div>
@endsection
@section('footer-scripts')
    <script>
        {{--$(document).ready(function () {--}}
        {{--    $('.delete-message').click(function () {--}}
        {{--        let messageId = $(this).data('message-id');--}}
        {{--        $.ajax({--}}
        {{--            'url': '{{ route('admin.messages.delete') }}',--}}
        {{--            'type': 'POST',--}}
        {{--            'data': {--}}
        {{--                'id': messageId,--}}
        {{--                '_token': '{{ csrf_token() }}'--}}
        {{--            },--}}
        {{--            'success': function (data) {--}}
        {{--                $('#flash-message-container').toggle('hidden');--}}
        {{--                $('#flash-message').text(data.message);--}}
        {{--                setTimeout(function () {--}}
        {{--                    $('#flash-message-container').toggle('hidden');--}}
        {{--                }, 2000)--}}
        {{--            }--}}
        {{--        })--}}
        {{--    })--}}
        {{--})--}}
    </script>
@endsection
