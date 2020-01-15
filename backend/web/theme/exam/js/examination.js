/**
 * Created by vietlv on 3/4/2017.
 */

let watchesApp = angular.module('Application', []);

watchesApp.controller('examinationCtrl', ['$scope', '$http', '$filter', '$timeout', function ($scope, $http, $filter, $timeout) {

    $scope.submit = false;
    $scope.result = false;

    $scope.load = angular.element(document.querySelector('#load'));
    $scope.answers = angular.element(document.querySelector('#answers'));

    $scope.seconds = document.querySelector('#seconds').value;

    $scope.hour = 0;
    $scope.minute = 0;
    $scope.second = 0;

    $scope.listAnswer = {};

    $scope.myStyle = {};
    $scope.myOneStyle = {};

    $scope.myClass = {};
    $scope.myStylePreview = {};

    $scope.answered = 0;
    $scope.notAnswered = document.querySelector('#number-question').value;

    function Load() {
        let countUp = function () {
            $scope.load.css('display', 'none');
            $timeout(countUp, 2000);
        };

        $timeout(countUp, 2000);
    }

    Load();

    $scope.setAnswer = function (id, answer) {
        if ($scope.listAnswer[id] !== undefined) {
            let res = $scope.listAnswer[id].split('');

            let exist = false;
            for (let i = 0; i < res.length; i++) {
                if (res[i] === answer) {
                    res.splice(i, 1);
                    exist = true;
                    break;
                }
            }

            if (!exist) {
                $scope.listAnswer[id] += answer;
            } else {
                $scope.listAnswer[id] = res.toString();
            }
        } else {
            $scope.listAnswer[id] = answer;
        }

        document.querySelector('#answers').value = JSON.stringify($scope.listAnswer);

        $scope.setStyleAnswer(id, answer);
        $scope.setClassAnswer(id, answer);

        $scope.myStylePreview[id] = {'background-color': '#2f70dc', 'color': '#fff'};
    };

    $scope.setOneAnswer = function (id, answer) {
        $scope.listAnswer[id] = answer;

        document.querySelector('#answers').value = JSON.stringify($scope.listAnswer);

        $scope.setOneStyleAnswer(id, answer);
    };

    $scope.setStyleAnswer = function (id, answer) {
        if (!(id in $scope.myStyle)) {
            $scope.myStyle[id] = {};
            $scope.myStyle[id]['A'] = {'background-color': 'transparent'};
            $scope.myStyle[id]['B'] = {'background-color': 'transparent'};
            $scope.myStyle[id]['C'] = {'background-color': 'transparent'};
            $scope.myStyle[id]['D'] = {'background-color': 'transparent'};
        }

        angular.forEach($scope.myStyle[id], function (value, key) {
            if (answer === key) {
                if ($scope.myStyle[id][key]['background-color'] === 'transparent') {
                    $scope.myStyle[id][key] = {'background-color': 'rgba(0, 177, 132, 0.2)'};
                } else {
                    $scope.myStyle[id][key] = {'background-color': 'transparent'};
                }
            }
        });
    };

    $scope.setOneStyleAnswer = function (id, answer) {
        if (!(id in $scope.myOneStyle)) {
            $scope.myOneStyle[id] = {};
            $scope.myOneStyle[id]['A'] = {'background-color': '#cef3fc'};
            $scope.myOneStyle[id]['B'] = {'background-color': '#cef3fc'};
            $scope.myOneStyle[id]['C'] = {'background-color': '#cef3fc'};
            $scope.myOneStyle[id]['D'] = {'background-color': '#cef3fc'};

            $scope.answered++;
            $scope.notAnswered--;
        }

        angular.forEach($scope.myOneStyle[id], function (value, key) {
            if (answer === key) {
                $scope.myOneStyle[id][key] = {'background-color': '#2f70dc', 'color': '#fff'};
            } else {
                $scope.myOneStyle[id][key] = {'background-color': '#cef3fc'};
            }
        });
    };

    $scope.setClassAnswer = function (id, answer) {
        if (!(id in $scope.myClass)) {
            $scope.myClass[id] = {};
            $scope.myClass[id]['A'] = 'fa-circle-o';
            $scope.myClass[id]['B'] = 'fa-circle-o';
            $scope.myClass[id]['C'] = 'fa-circle-o';
            $scope.myClass[id]['D'] = 'fa-circle-o';

            $scope.answered++;
            $scope.notAnswered--;
        }

        angular.forEach($scope.myClass[id], function (value, key) {
            if (answer === key) {
                if ($scope.myClass[id][key] === 'fa-circle-o') {
                    $scope.myClass[id][key] = 'fa-check-circle-o';
                } else {
                    $scope.myClass[id][key] = 'fa-circle-o';
                }
            }
        });
    };

    $scope.confirm = function () {
        $scope.submit = true;
    };

    $scope.close = function () {
        $scope.submit = false;
        $scope.result = false;
    };

    $scope.dismiss = function () {
        $scope.submit = false;
    };

    $scope.matchingAnswer = function (event, id, answer) {
        let sortableAnswer = angular.element(document.querySelector('#sortable-answer-' + id));

        if ($(event.target).data('parent') === 'sortable-list-' + id) {
            $(event.target).data('parent', 'sortable-answer-' + id);
            sortableAnswer.append($(event.target));

            $('#word-' + id + '-' + answer).css('display', 'block');
        } else {
            $(event.target).data('parent', 'sortable-list-' + id);
            $(event.target).insertBefore('#word-' + id + '-' + answer);

            $('#word-' + id + '-' + answer).css('display', 'none');
        }

        $scope.listAnswer[id] = [];
        sortableAnswer.find('li').each(function (key) {
            if (key) {
                $scope.listAnswer[id] += $(this).data('answer');
            }
        });

        document.querySelector('#answers').value = JSON.stringify($scope.listAnswer);

        if (!(id in $scope.myStylePreview)) {
            $scope.answered++;
            $scope.notAnswered--;
        }

        $scope.myStylePreview[id] = {'background-color': '#2f70dc', 'color': '#fff'};
    };

    $scope.fillAnswer = function (id) {
        if (!(id in $scope.myStylePreview)) {
            $scope.answered++;
            $scope.notAnswered--;
        }

        $scope.myStylePreview[id] = {'background-color': '#2f70dc', 'color': '#fff'};
    };

    $scope.unsure = function (id) {
        $scope.x = angular.element(document.querySelector('#unsure' + id));

        if ($scope.x.text().trim() === 'Đánh dấu chưa chắc chắn') {
            $scope.x.css('color', '#fff');
            $scope.x.css('background-color', '#b08e40');
            $scope.x.css('border-color', '#b08e40');
            $scope.x.html('<span class="fa fa-check-circle"></span> Đã đánh dấu chưa chắc chắn');
            $scope.listUnsure[id] = 1;

            $scope.myStyle[id] = {'background-color': '#fff8e8', 'color': '#b08e40', 'border-color': '#b08e40'};
        } else {
            $scope.x.css('color', '#b08e40');
            $scope.x.css('background-color', '#fff8e8');
            $scope.x.css('border-color', '#f4e3bd');
            $scope.x.html('<span class="fa fa-question"></span> Đánh dấu chưa chắc chắn');

            $scope.listUnsure[id] = 0;

            $scope.myStyle[id] = {'background-color': '#fff', 'color': '#333333', 'border-color': '#cccccc'};
        }
    };

    Ctrl($scope.seconds - 1);

    function Ctrl() {

        let countDown = function () {

            $scope.hour = Math.floor($scope.seconds / 3600) >= 10 ? Math.floor($scope.seconds / 3600) : '0' + Math.floor($scope.seconds / 3600);

            $scope.minute = Math.floor($scope.seconds / 60) >= 10 ? Math.floor($scope.seconds / 60) : '0' + Math.floor($scope.seconds / 60);

            $scope.second = ($scope.seconds % 60) >= 10 ? $scope.seconds % 60 : '0' + ($scope.seconds % 60);

            if ($scope.seconds === 0) {
                return true;
            } else {
                $scope.seconds--;
                document.querySelector('#completion-time').value = $scope.seconds;
            }

            $scope.mytimeout = $timeout(countDown, 1000);
        };

        $scope.mytimeout = $timeout(countDown, 0);
    }

    $scope.$watch('time', function () {
        if ($scope.seconds === 0) {
            document.querySelector('#w0').submit();
        }
    });
}]);