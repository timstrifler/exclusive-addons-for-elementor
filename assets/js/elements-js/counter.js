// Counter Up Js
var CounterUp = function($scope, $) {
    var $counterUp = $scope.find('.exad-counter').eq(0),
        $exadCounterTime = $counterUp.data('counter-speed');

    $counterUp.counterUp({
        delay: 10,
        time: $exadCounterTime,
    });		
};