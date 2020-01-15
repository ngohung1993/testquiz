/**
 * Created by vietlv on 3/4/2017.
 */

let countdownApp = angular.module('Application', []);

countdownApp.controller('countdownCtrl', ['$scope', '$http', '$filter', '$timeout', function ($scope, $http, $filter, $timeout) {

    $scope.seconds = document.querySelector('#seconds').value;

    $scope.temp = 0;

    $scope.day = 0;
    $scope.hour = 0;
    $scope.minute = 0;
    $scope.second = 0;

    Ctrl($scope.seconds - 1);

    function Ctrl() {

        let countDown = function () {

            $scope.day = Math.floor($scope.seconds / (60 * 60 * 24)) >= 10 ? Math.floor($scope.seconds / (60 * 60 * 24)) : '0' + Math.floor($scope.seconds / (60 * 60 * 24));

            $scope.temp = $scope.seconds - $scope.day * 3600 * 24;
            $scope.hour = Math.floor($scope.temp / 3600) >= 10 ? Math.floor($scope.temp / 3600) : '0' + Math.floor($scope.temp / 3600);

            $scope.temp = $scope.seconds - $scope.day * 3600 * 24 - $scope.hour * 3600;
            $scope.minute = Math.floor($scope.temp / 60) >= 10 ? Math.floor($scope.temp / 60) : '0' + Math.floor($scope.temp / 60);

            $scope.temp = $scope.seconds - $scope.day * 3600 * 24 - $scope.hour * 3600 - $scope.minute * 60;
            $scope.second = ($scope.temp % 60) >= 10 ? $scope.temp % 60 : '0' + ($scope.temp % 60);

            if ($scope.seconds === 0) {
                return true;
            } else {
                $scope.seconds--;
            }

            $scope.mytimeout = $timeout(countDown, 1000);
        };

        $scope.mytimeout = $timeout(countDown, 0);
    }
}]);
