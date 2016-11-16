/**
 * Created by FAIZ on 10/8/2016.
 */
var app = angular.module('formApp')
app.controller('MyCarInfoCtrl', function($scope,$window,$state,$rootScope,$uibModal,apiService,$stateParams) {
    console.log("MyCarInfoCtrl")

    //$scope.ActiveUser = $rootScope.user
    //console.log("ActiveUser : ",$rootScope.user)
    $scope.selectedCar = JSON.parse($stateParams.carObj)
    console.log($scope.selectedCar)
    $scope.saveCarInfo = function(data){
        console.log("saveCarInfo : ",data )
        obj = {
            "car_id": data.car_id,
            "user_id": data.user_id,
            "total_mileage": data.total_mileage,
            "daiL_mileage": data.daiL_mileage,
        }
        console.log(obj)
        apiService.UpdateUserCarMileage(obj).then(function(res){
            console.log(res)
        },function(err){
            console.log(err)
        })
    }
    $scope.deleteCar = function(){
        obj = {
            "car_id": $scope.selectedCar.car_id,
            "user_id": $scope.selectedCar.user_id
        }
        console.log(obj)
        apiService.DeleteUserCar(obj).then(function(res){
            console.log(res)
            if(res.code == "200"){
                $state.go("dashboard.carslist")
            }
        },function(err){
            console.log(err)
        })
    }
})
