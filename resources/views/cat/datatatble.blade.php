

<script>
$(document).ready(function() {
    var table = $('#DataTables_Table_0').DataTable({
        ajax: {
            url: '{{ url("/cat") }}',
            type: 'GET',
            data: function(data) {
                data.search = $('#custom-search').val();
            }
        },
        columns: [
            {
                data: 'id',
                title: '#',
            },
            {
                data: 'name',
                title: '{{ __('index.name') }}',
            },
            {
                data: 'actions',
                title: '{{ __('index.action') }}',
                className: 'text-center'
            }
        ],

    });

    $('#custom-search').on('keyup', function() {
        table.search(this.value).draw();
    });
});

</script>
