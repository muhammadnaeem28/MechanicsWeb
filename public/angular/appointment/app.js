var app =  angular.module('formApp', ['ui.router','ui.bootstrap','ui.bootstrap.datetimepicker'])

  .config(function($stateProvider,$urlRouterProvider) {

    var authResolve = function (apiService, Auth) {
      apiService.logged_user().then(function(res){
        console.log(res)
        if(res.hasOwnProperty("code")){
          if(res.code == "404"){
            window.location = "http://filddy.com/auth/login"
          }
        }else{
          Auth.setUser(res)
          return res

        }
      },function(err){
        console.log(err)
        window.location = "http://filddy.com/auth/login"
      })
    }

    $stateProvider
      .state('home', {
        url: '/home/:id',
        templateUrl: 'templates/book.html',
        controller:'BookCtrl',
        resolve: {
          //authResolve:authResolve,
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
      .state('login', {
        url: '/login',
        templateUrl: 'templates/login.html'
      })
      .state('dashboard', {
        abstract: true,
        cache: false,
        url: '/dashboard',
        templateUrl: 'templates/dashboard.html',

      })
      .state('dashboard.carslist', {
        url: "/carslist",
        templateUrl: 'templates/cars_list.html',
        controller:'DashboardMyCtrl',
        resolve: {
          authResolve:authResolve,
          carsBrands:function(apiService){
            return apiService.getVehicleBrands()
          }
        }
      })
      .state('dashboard.carinfo', {
        url: "/carinfo/:carObj",
        templateUrl: 'templates/car_info.html',
        controller:'MyCarInfoCtrl',
        resolve:{
          authResolve:authResolve
        }
      })
      .state('dashboard.quoteslist', {
        url: "/quoteslist",
        templateUrl: 'templates/quotes_list.html',
        controller:'QuotesListCtrl',
        resolve: {
          authResolve:authResolve
        }
      })
      .state('dashboard.quoteinfo', {
        url: "/quoteinfo/:quoteObj",
        templateUrl: 'templates/quote_info.html',
        controller:'MyQuoteInfoCtrl',
        resolve: {
          authResolve:authResolve
        }
      })
      .state('dashboard.appointmentlist', {
        url: "/appointmentlist",
        templateUrl: 'templates/appointment_list.html',
        controller:'AppointmentListCtrl',
        resolve: {
          authResolve:authResolve
        }
      })
      .state('dashboard.appointmentinfo', {
        url: "/appointmentinfo/:appointmentObj",
        templateUrl: 'templates/appointment_info.html',
        controller:'AppointmentInfoCtrl',
        resolve: {
          authResolve:authResolve
        }
      })
      .state('dashboard.profile', {
        url: "/profile",
        templateUrl: 'templates/user_profile.html',
        resolve: {
          authResolve:authResolve
        }
      })

    //$urlRouterProvider.otherwise("/home/-1");
  })

