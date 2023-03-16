<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="img/icons/icon-48x48.png"/>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

   <!-- Scripts -->
    @vite(['resources/css/app.css','resources/js/app.js'])
    <link as="style" src="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" />
    <link as="style" src="https://cdn.datatables.net/buttons/2.3.6/css/buttons.bootstrap5.min.css" />

</head>

<body>
<div class="wrapper">

    @include('layouts.sidebar')

    <div class="main">

        @include('layouts.navigation')

        <main class="content">
            <div class="container-fluid p-0">
                @include('layouts.breadcrumb', [
                   'header'  => $title ?? "",
                   'create_new'  => $create_new ?? ""
                ])
                @yield('content')

            </div>
        </main>

        @include('layouts.footer')

    </div>
</div>
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js">
</script> <!-- MAKE SURE THIS IS LOADED -->

<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">

<link
    rel="stylesheet"
    type="text/css"
    href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<script
    type="text/javascript"
    charset="utf8"
    src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js">
</script>


<script>
    $(function () {
        "use strict";

        /**
         * Generate Existing DataTable
         *
         * @param {object} datatables
         * @return {boolean}
         */
        function createDataTable(datatables) {
            let keys = Object.keys(datatables);

            if (keys.length < 0) {
                return false;
            }


            keys.forEach(function (tableKey, index) {

                console.log(tableKey)
                let table = $("#" + tableKey + "s-table");
                console.log(table)

                if (! table.length) {
                    return;
                }

                let tableObj = new Object();
                let apiUrl = "/datatable/" + tableKey + "-list" +
                    (datatables[tableKey]["key"]
                        ? "/" + datatables[tableKey]["key"]
                        : "");

                let $ajaxData = {
                    url: apiUrl,
                    data: {}
                };

                if (datatables[tableKey]["data"]) {
                    $ajaxData.data = datatables[tableKey]["data"];
                }

                resolveData(table[0], $ajaxData.data)

                let tableOptions = {
                    processing: true,
                    serverSide: true,
                    bAutoWidth: false,
                    order: [[1, "desc"]],
                    fnRowCallback: function (nRow, aData, iDisplayIndex) {
                        let index = $(
                            "#" + tableKey + "s-table_length select"
                        ).children("option:selected")
                            .val();

                        $("td:first", nRow).html(
                            tableObj.page.info().page * index +
                            iDisplayIndex +
                            1
                        );

                        if (aData.new_user && aData.is_new > 0) {
                            $(nRow).addClass("highlight-new-user");
                        }

                        return nRow;
                    },
                    ajax: $ajaxData,
                    columns: datatables[tableKey]["columns"]
                        ? datatables[tableKey]["columns"]
                        : datatables[tableKey],
                };

                if (datatables[tableKey]["dom"]) {
                    tableOptions.dom = datatables[tableKey]["dom"];
                }

                window.dataTable = tableObj = table.DataTable(tableOptions);

                if (datatables[tableKey]["events"]) {
                    datatables[tableKey]["events"](tableObj);
                }
            });
        }

        /**
         * Rescue attribute and value from selector
         *
         * @param {object} table
         * @param {object} data
         */
        function resolveData(table, data)
        {
            let attr, node = "";

            Object.keys(table.attributes).forEach(e => {
                node = table.attributes[e];
                attr = node.nodeName.match(/^(data\-)/);

                if (! attr) {
                    return;
                }

                data[node.nodeName.replace('data-', '')] = node.nodeValue;
            });

            return data;
        }

        $(document).ready(function () {
            console.log('start');
            let datatables = {
                role: [
                    { data: "id", name: "" },
                    { data: "id", name: "id" },
                    { data: "name", name: "name" },
                    { data: "table_name", name: "Table Name" },
                    { data: "action", name: "action" },
                ],
                permission: [
                    { data: "id", name: "" },
                    { data: "id", name: "id" },
                    { data: "name", name: "name" },
                    { data: "action", name: "action" },
                ]
            };

            /**
             * Initiate DataTables
             */
            createDataTable(datatables);
        });
    });

</script>


</html>
