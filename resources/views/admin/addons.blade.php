@extends('layouts.dashboard')
@section('content')
    @if(count($addons ?? []))
        <table class="min-w-max w-full table-auto">
            <thead>
            <tr class="text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">Name</th>
                <th class="py-3 px-6 text-left">Slug</th>
                <th class="py-3 px-6 text-left">Price</th>
                <th class="py-3 px-6 text-center">Actions</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
            <form class="" method="POST" action="{{ route('admin.addons.store') }}">
                @csrf
                <tr class="border-b border-gray-200 hover:bg-gray-100 bg-white">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        <input type="text" id="name" name="name" class="border-gray-300 rounded-md">
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>Automatically-Generated</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <input type="number" id="price" name="price" class="border-gray-300 rounded-md">
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded self-end">
                            Save
                        </button>
                    </td>
                </tr>
            </form>
            @foreach($addons as $addon)
                <tr class="border-b border-gray-200 hover:bg-gray-100 @if($loop->even) bg-gray-50 @endif">
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        {{ $addon->name }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $addon->slug }}</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-left">
                        <div class="flex items-center">
                            <span>{{ $addon->price }}$</span>
                        </div>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                     stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                            </div>
                            <div data-addon-id="{{ $addon->id }}"
                                 class="delete-addon w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
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
    @else
        <div class="w-full">
            <div class="bg-white shadow-md rounded my-6 overflow-auto">
                <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
                    <h3 class="py-3 px-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">No
                        addons has been added</h3>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('header-scripts')
    <script>
        $(document).ready(function () {
            $('.delete-addon').on('click', function () {
                let addonId = $(this).data('addon-id');
                let row = $(this).parent().parent().parent();
                confirm("Are you sure you want to delete this addon?") ? $.ajax({
                    'url': '{{ route('admin.addons.delete') }}',
                    'type': 'POST',
                    'data': {
                        'addon_id': addonId,
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
