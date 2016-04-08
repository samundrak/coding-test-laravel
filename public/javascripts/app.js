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
            name: 'list',
            url: '/see_lists',
            templateUrl: '/views/partials/list',
            controller: 'listCtrl'
        })
}])

.controller('addDetailCtrl', ['$scope', '$http', function($scope, $http) {
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
                    if (!response.success) return toast('Unable to create ')
                    $scope.details = {};
                    toast("Details has been added");
                }).error(function(err) {
                    return toast('unable to create');
                })
            }
        });
    }])
    .controller('listCtrl', ['$scope', '$http', function($scope, $http) {
        angular.extend($scope, {
            details: {
                lists  : []
            },
        });

        angular.extend($scope, {
            getDetails: function() {
                $http.get('/api/details')
                    .success(function(response) {
                        if (!response.success) return toast('No data found');

                        response.message = JSON.parse(response.message);
                        console.log($scope.detials);
                        $scope.details.lists = response.message.lists;
                        $scope.details.last =  response.message.last;
                    })
                    .error(function(error) {
                        toast('Unable to connect');
                    })
            }
        });
        $scope.getDetails();
    }])
    // <pagination total="" span="" last=""></pagination>
    .directive('pagination', ['$compile', '$rootScope',

        function($compile, $rootScope) {
            return {
                restrict: 'EA',
                scope: {
                    total: "=total",
                    span: "=span",
                    last: "=last"
                },
                link: function(scope, element, attr) {
                    var html = '<nav><ul class="pagination">';
                    html += '<li ><a  ng-click="pageClick(' + scope.last + ')" href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                    var last = 0;
                    var counter = 1;
                    for (var i = 0; i < scope.total; i += scope.span) {
                        var item = scope.last - i;
                        html += '<li><a ng-click="pageClick(' + item + ')" href="javascript:void(0);">' + counter + '</a></li>'
                        last = item;
                        counter++;
                    };
                    html += '  <li><a  ng-click="pageClick(' + last + ')" href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                    html += '</ul></nav>';
                    element.html(html);
                    $compile(element.contents())(scope);
                },
                controller: function($scope, $rootScope) {
                    $scope.pageClick = function(item) {
                        if (!item) return;
                        $rootScope.$broadcast('paginationClicked', {
                            total: $scope.total,
                            span: $scope.span,
                            last: $scope.last,
                            clicked: item
                        });
                    }
                }
            };
        }
    ])
