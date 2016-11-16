/**
 * Created by FAIZ on 10/8/2016.
 */
var app = angular.module('formApp')
app.controller('MyQuoteInfoCtrl', function($scope,Auth,$window,$state,$uibModal,$filter,apiService,$stateParams) {
    console.log("MyQuoteInfoCtrl")
    $scope.quoteServicesInfo = []
    $scope.quoteInfo = JSON.parse($stateParams.quoteObj)
    $scope.ActiveUser = Auth.getUser()
    if(!$scope.ActiveUser){
        window.location = "http://filddy.com/auth/login"
    }
    obj = {
        'quote_id': $scope.quoteInfo.quote_id
    }
    apiService.getUserQuoteInfo(obj).then(function(res){
        $scope.quoteServicesInfo = res.services
    },function(err){
        console.log(err)
    })

    $scope.formatDate = function(date){
        var newDate = new Date(date)
        return $filter('date')(newDate, 'fullDate')
    }
    $scope.deleteQuote = function(data){
        console.log(data)
        obj = {
            'quote_id': data.quote_id
        }
        apiService.DeleteUserQuote(obj).then(function(res){
            console.log(res)
            if(res.code == "200"){
                $state.go('dashboard.quoteslist')
            }
        },function(err){
            console.log(err)
        })
    }


})
