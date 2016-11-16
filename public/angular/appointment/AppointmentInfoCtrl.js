var app = angular.module('formApp')
app.controller('AppointmentInfoCtrl',
    function($scope,Auth,$rootScope,$window,$state,$uibModal,$filter,apiService,$stateParams) {
        console.log("AppointmentInfoCtrl")
        $scope.appointmentServicesInfo = []
        $scope.appointmentInfo = JSON.parse($stateParams.appointmentObj)
        $scope.ActiveUser = Auth.getUser()
        if(!$scope.ActiveUser){
            window.location = "http://filddy.com/auth/login"
        }
        appointment = JSON.parse($stateParams.appointmentObj)
        obj = {
            'appointment_id': $scope.appointmentInfo.appointment_id
        }
        apiService.getUserAppointmentInfo(obj).then(function(res){
            $scope.appointmentServicesInfo = res.services
        },function(err){
            console.log(err)
        })



        //$scope.formatDate = function(date){
        //    var newDate = new Date(date)
        //    return $filter('date')(newDate, 'fullDate')
        //}
        $scope.cancelAppointment = function(data){
            console.log(data)
        }
    })
