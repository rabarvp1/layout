<script>
$(document).ready(function() {
    $.extend($.fn.dataTable.defaults, {
        serverSide: true,
        processing: true,

        stateSave: true,
        stateDuration: -1,
        responsive: true,
        bLengthChange: false,
        ordering: false,
        searching: false,
        pageLength:  10,
        "dom": "<'row'<'col-md-6'f><'col-md-6'l>>" +  // Search & Length
               "<'row'<'col-md-12'tr>>" +  // Table
               "<'row datatable-footer'<'col-md-6 dataTables_info'i><'col-md-6 paginate-div'p>>",  // Info & Pagination with custom class
        language: {
            oPaginate: {
                sPrevious: "<span id='DataTables_Table_0_paginate' class='DataTables_Table_0_previous ' >{{ __('index.prev') }}</span>",
                sNext: "<span id='DataTables_Table_0_paginate' class='DataTables_Table_0_next '>{{ __('index.next') }}</span>",
            },
            emptyTable: "{{ __('index.hich datayak la xshtada bardast nia') }}",
            zeroRecords: "{{ __('index.hich_tomarek_nadozrayawa') }}",
            info: "{{ __('index.nishandani') }} _START_ {{ __('index.bo') }} _END_ {{ __('index.la') }} _TOTAL_",
            infoEmpty: "{{ __('index.nishandani') }} 0 {{ __('index.bo') }} 0 {{ __('index.la') }} 0",
            infoFiltered: "({{ __('index.fltar krawa') }} {{ __('index.la') }} _MAX_)",
        },
        stateSaveCallback: function(settings, data) {
            delete data.search;
            delete data.columns;
            delete data.order;
            delete data.length;
            delete data.start;
        },
        initComplete: function() {
            if ($(this).hasClass('last-paginate')) {

                var table = this;

                setTimeout(function() {
                    table.api().page('last').draw('page');
                }, 1);
            }
        }
    });
});
</script>
<style>


    @if(app()->getLocale() == 'ku' || app()->getLocale() == 'ar')
            .pagination {
                direction: ltr;
            }
        @else
            .pagination {
                direction: rtl;
            }
        @endif

        </style>
