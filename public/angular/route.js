var app = angular.module('main-App',['ngRoute','angularUtils.directives.dirPagination'],function($interpolateProvider) {

    $interpolateProvider.startSymbol('<%');

    $interpolateProvider.endSymbol('%>');

});

app.config(['$routeProvider',

    function($routeProvider) {

        $routeProvider.

            when('/categories', {

                templateUrl: '/templates/pricing_new.html',

                controller: 'PricingController'

            }).

            when('/Pricing/new', {

                templateUrl: '/templates/pricing_new.html',

                controller: 'PricingController'

            }).

            when('/Pricing/search', {

                templateUrl: '/templates/pricing_search.html',

                controller: 'PricingController'

            }).

            when('/vehicle/search', {

                templateUrl: '/templates/vehicle_search.html',

                controller: 'PricingController'

            }).


            when('/sr/home', {

                templateUrl: '/templates/sr_dashboard.html',

                controller: 'PricingController'

            }).

            when('/items', {

                templateUrl: '/templates/items.html',

                controller: 'ItemController'

            });

        /*$locationProvider.html5Mode(true);*/

    }]);




app.directive('sOptionalsRepeatDirective', function() {
    return function(scope, element, attrs) {
        if (scope.$last){
            $(".s_optional_timing").trigger("click");
        }
    };
});




