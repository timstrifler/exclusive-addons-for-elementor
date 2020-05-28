// Corona script starts

var exclusiveCorona = function ( $scope, $ ) {

    var exadCoronaWrapper = $scope.find( '.exad-corona' ).eq(0);
    var searchData = exadCoronaWrapper.find('#search_data');
    var dataTtableRow = exadCoronaWrapper.find('#data_table .data_table_row');
    var continentBtn = exadCoronaWrapper.find('#exad-covid-filters .exad-covid-continent-btn');
    searchData.on("keyup", function() {
        var value = $(this).val().toLowerCase();
        dataTtableRow.filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    continentBtn.click(function() {
      if (this.id == 'all') {
        dataTtableRow.fadeIn(450);
      } else {
        var el = $('.' + this.id).fadeIn(450);
        dataTtableRow.not(el).hide();
      }
      continentBtn.removeClass('active');
      $(this).addClass('active');
    })
}

// Corona script ends
