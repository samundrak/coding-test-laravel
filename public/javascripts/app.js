var app = angular.module('app', ['ui.router']);
app.config(['$urlRouterProvider', '$stateProvider', function($urlRouterProvider, $stateProvider) {
    $urlRouterProvider.otherwise('/');
    $stateProvider
        .state({
            url: '/',
            name: 'home',
            templateUrl: '/views/partials/home',
            controller: 'addDetailCtrl'
        })
        .state({
            name: 'see_lists',
            url: '/see_lists',
            templateUrl: '',
            controller: 'listCtrl'
        })
}])

.controller('addDetailCtrl', ['$scope','$http', function($scope,$http) {
    angular.extend($scope, {
        details: {}
    });
    angular.extend($scope, {
        submitDetails: function() {
            var pass = true;
            ['name', 'address', 'gender', 'phone', 'email', 'country', 'dob', 'education'].forEach(function(item) {
                if (!$scope.details.hasOwnProperty(item) && !$scope.details[item]) {
                    pass = false;
                    toast(item + " is missing", 'danger');
                    return;
                }
            });
            if (!pass) return alert('failed');
            $http.post('/api/details', $scope.details).success(function(response) {
                if (response.success) return toast('Unable to create ')
            }).error(function(err) {
                return toast('unable to create');
            })
        }
    });
}])


function toast(message, type) {
    $.simplyToast(message, type);
}
