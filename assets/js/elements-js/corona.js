// Corona script starts
var exclusiveCorona = function ($scope, $) {
	var exadCoronaWrapper = $scope.find('.exad-corona').eq(0);
	var searchData = exadCoronaWrapper.find('#exad_search_data');
	var dataTtableRow = exadCoronaWrapper.find('#data_table .data_table_row');
	var continentBtn = exadCoronaWrapper.find('#exad-covid-filters .exad-covid-continent-btn');
	var parentClass = exadCoronaWrapper.find('.exad-corona-table-heading.yes th');
	searchData.on("keyup", function () {
		var value = $(this).val().toLowerCase();
		dataTtableRow.filter(function () {
			$(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
		});
	});
	continentBtn.click(function () {
		if (this.id == 'all') {
			dataTtableRow.fadeIn(450);
		} else {
			var el = $('.' + this.id).fadeIn(450);
			dataTtableRow.not(el).hide();
		}
		continentBtn.removeClass('active');
		$(this).addClass('active');
	});
	if ( parentClass.length > 0 ) {
		var parent = document.querySelector('.exad-corona-table-heading.yes th').parentElement;
		while (parent) {
			var hasOverflow = getComputedStyle(parent).overflow;
			if (hasOverflow !== 'visible') {
				parent.style.overflow = "visible"
			}
			parent = parent.parentElement;
		}
	}
}
// Corona script ends