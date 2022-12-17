<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/ico" href="https://www.datatables.net/favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, user-scalable=no">
    <title>Editor example - Basic initialisation</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css">
    <link rel="stylesheet" type="text/css" href="../../editor/css/editor.dataTables.min.css">
{{--    <link rel="stylesheet" type="text/css" href="../resources/syntax/shCore.css">--}}
{{--    <link rel="stylesheet" type="text/css" href="../resources/demo.css">--}}
    <style type="text/css" class="init">

    </style>
    <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.4.0/js/dataTables.select.min.js"></script>
    <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>
    <script type="text/javascript" language="javascript" src="../../editor/js/dataTables.editor.min.js"></script>
{{--    <script type="text/javascript" language="javascript" src="../resources/syntax/shCore.js"></script>--}}
{{--    <script type="text/javascript" language="javascript" src="../resources/demo.js"></script>--}}
{{--    <script type="text/javascript" language="javascript" src="../resources/editor-demo.js"></script>--}}

<body>
        <div class="demo-html">
            <table id="example" class="display" style="width:100%">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Extn.</th>
                    <th>Start date</th>
                    <th>Salary</th>
                </tr>
                </tfoot>
            </table>
        </div>
</body>
    <script type="text/javascript" language="javascript" class="init">
        var editor; // use a global for the submit and return data rendering in the examples

        $(document).ready(function() {
            editor = new $.fn.dataTable.Editor( {
                ajax: {
                    url: "{{ route('editor') }}",
                    data: { _token: '{{csrf_token()}}' },
                    type: "POST",
                },
                table: "#example",
                fields: [ {
                    label: "First name:",
                    name: "first_name"
                }, {
                    label: "Last name:",
                    name: "last_name"
                }, {
                    label: "Position:",
                    name: "position"
                }, {
                    label: "Office:",
                    name: "office"
                }, {
                    label: "Extension:",
                    name: "extn"
                }, {
                    label: "Start date:",
                    name: "start_date",
                    type: "datetime"
                }, {
                    label: "Salary:",
                    name: "salary"
                }
                ]
            } );

            $('#example').DataTable( {
                dom: "Bfrtip",
                ajax: {
                    url: "{{ route('editor') }}",
                    data: { _token: '{{csrf_token()}}' },
                    type: "POST",
                },
                columns: [
                    { data: null, render: function ( data, type, row ) {
                            // Combine the first and last names into a single table field
                            return data.first_name+' '+data.last_name;
                        } },
                    { data: "position" },
                    { data: "office" },
                    { data: "extn" },
                    { data: "start_date" },
                    { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
                ],
                select: true,
                buttons: [
                    { extend: "create", editor: editor },
                    { extend: "edit",   editor: editor },
                    { extend: "remove", editor: editor }
                ]
            } );
        } );
    </script>
