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
            permission: [
                { data: "id", name: "" },
                { data: "id", name: "id" },
                { data: "name", name: "name" },
                { data: "table_name", name: "table_name" },
                { data: "action", name: "action" },
            ]
        };

        /**
         * Initiate DataTables
         */
        createDataTable(datatables);
    });
});
