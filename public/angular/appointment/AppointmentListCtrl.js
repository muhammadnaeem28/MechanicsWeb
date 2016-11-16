var app = angular.module('formApp')
app.controller('AppointmentListCtrl', function($scope,Auth,$window,$state,$filter,apiService) {
    console.log("AppointmentListCtrl")
    $scope.appointmentsList = []

    $scope.ActiveUser = Auth.getUser()
    if(!$scope.ActiveUser){
        window.location = "http://filddy.com/auth/login"
    }
    obj = {
        'user_id': $scope.ActiveUser.user_id
    }
    apiService.getUserAppointmentList(obj).then(function(res){
        $scope.appointmentsList = res.appointments
    },function(err){
        console.log(err)
    })

    //$scope.formatDate = function(date){
    //    var newDate = new Date(date);
    //    return $filter('date')(newDate, 'fullDate');
    //}
    $scope.showAppointmentInfo = function(data){
        $state.go('dashboard.appointmentinfo',{"appointmentObj":JSON.stringify(data)})
    }

    $scope.cancelAppointment = function(data){
        console.log(data)
        //obj = {
        //    'quote_id': data.quote_id
        //}
        //apiService.DeleteUserQuote(obj).then(function(res){
        //    console.log(res)
        //    if(res.code == "200"){
        //        $state.go($state.current, {}, {reload: true});
        //    }
        //},function(err){
        //    console.log(err)
        //})
    }
})
