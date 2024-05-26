$(() => {
    $('.delete-addon').on('click', function () {
        let addonId = $(this).data('addon-id');
        let row = $(this).parent().parent().parent();
        confirm("Are you sure you want to delete this addon?") ? $.ajax({
            'url': route('admin.addons.delete'),
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
