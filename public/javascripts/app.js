var app = angular.module('app', ['ui.router']);
app.config(['$urlRouterProvider', '$stateProvider',
    function($urlRouterProvider, $stateProvider) {
        $urlRouterProvider.otherwise('/');
        $stateProvider.state({
            url: '/',
            name: 'home',
            templateUrl: '/views/partials/home',
            controller: 'addDetailCtrl'
        }).state({
            name: 'list',
            url: '/see_lists',
            templateUrl: '/views/partials/list',
            controller: 'listCtrl'
        }).state({
            url: '/edit/:id',
            name: 'edit',
            templateUrl: '/views/partials/edit',
            controller: 'editCtrl'
        })
    }
]).controller('addDetailCtrl', ['$scope', '$http',
    function($scope, $http) {
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
                if (!pass) return;
                $http.post('/api/details', $scope.details).success(function(response) {
                    if (!response.success) return toast('Unable to create ')
                    $scope.details = {};
                    toast("Details has been added");
                }).error(function(err) {
                    return toast('unable to create');
                })
            }
        });
    }
]).controller('listCtrl', ['$scope', '$http', '$rootScope',
    function($scope, $http, $rootScope) {
        angular.extend($scope, {
            details: {
                lists: []
            },
        });
        angular.extend($scope, {
            getDetails: function(data) {
                var url = '/api/details';
                url += "?";
                if (data) {
                    url += 'limit=' + data.limit + '&' + 'from=' + data.from;
                } else {
                    url += "limit=3";
                }
                $http.get(url).success(function(response) {
                    if (!response.success) return toast('No data found');
                    response.message = JSON.parse(response.message);
                    console.log($scope.details);
                    $scope.details.lists = response.message.lists;
                    $scope.details.last = response.message.last;
                }).error(function(error) {
                    toast('Unable to connect');
                })
            }
        });
        $rootScope.$on('paginationClicked', function(type, data) {
            console.log(data)
            $scope.getDetails({
                limit: 3,
                from: data.clicked
            });
        });
        $scope.getDetails();
    }
]).controller('editCtrl', ['$scope', '$http', '$stateParams', '$state',
    function($scope, $http, $stateParams, $state) {
        angular.extend($scope, {
            details: {},
            getDetails: function() {
                if (!$stateParams.id) return;
                $http.get('/api/details/' + $stateParams.id).success(function(response) {
                    if (!response.success) return $state.go('list');
                    $scope.details = JSON.parse(response.message);
                }).error(function(error) {
                    $state.go('list');
                    toast('Some problem error');
                })
            },
            submitDetails: function() {
                if (!$scope.details) return;
                $http.post('/api/details/' + $stateParams.id, $scope.details).success(function(response) {
                    if(!response.success) return false;
                    toast(response.message);
                })  .error(function(error) {
                    toast("Some error occured Please try again!");
                })
            }
        });
        $scope.getDetails();
    }
])
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
                // html += '<li ><a  ng-click="pageClick(' + scope.last + ')" href="javascript:void(0);" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>';
                var last = 0;
                var counter = 1;
                for (var i = 1; i < scope.total; i += scope.span) {
                    var item = i;
                    html += '<li><a ng-click="pageClick(' + item + ')" href="javascript:void(0);">' + counter + '</a></li>'
                    last = item;
                    counter++;
                };
                // html += '  <li><a  ng-click="pageClick(' + last + ')" href="javascript:void(0);" aria-label="Next"><span aria-hidden="true">»</span></a></li>';
                html += '</ul></nav>';
                element.html(html);
                $compile(element.contents())(scope);
            },
            controller: function($scope, $rootScope) {
                $scope.pageClick = function(item) {
                    if (item == undefined) return;
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