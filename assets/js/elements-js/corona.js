// Corona script starts

var exclusiveCorona = function ( $scope, $ ) {

    var exadCoronaWrapper = $scope.find( '.exad-corona' ).eq(0);
    var searchData = exadCoronaWrapper.find('#search_data');
    var dataTtableRow = exadCoronaWrapper.find('#data_table .data_table_row');
    searchData.on("keyup", function() {
        var value = $(this).val().toLowerCase();
        dataTtableRow.filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
}

// Corona script ends
