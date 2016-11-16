var app =  angular.module('formApp', ['ui.router','ui.bootstrap','ui.bootstrap.datetimepicker'])
    .config(function($stateProvider,$urlRouterProvider) {

        $stateProvider
            .state('home', {
                url: '/:id',
                templateUrl: 'book.html',
                controller:'SelectCarCtrl',
                resolve: {
                   GetService: function($stateParams,apiService){
                       if($stateParams.id == -1){
                           console.log("$stateParams : ",$stateParams.id)
                           return -1
                       }else{
                           return apiService.getservice($stateParams.id)
                       }
                    }
                }
            })
        $urlRouterProvider.otherwise("/-1");
    });