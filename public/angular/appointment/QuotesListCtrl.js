/**
 * Created by FAIZ on 10/8/2016.
 */
var app = angular.module('formApp')
app.controller('QuoteCheckoutModalCtrl', function($scope, $rootScope,$uibModalInstance) {
    console.log("QuoteCheckoutModalCtrl")
    $scope.userAddress = {};
    $scope.userAddress.paymentMethod = "cash";

    //$scope.checkOut = function(data){
    //    data.checkoutDate = $scope.date
    //    console.log("checkout : ",data)
    //    $scope.ok()
    //}

    $scope.ok = function(data) {
        data.checkoutDate = $scope.date
        console.log("checkout : ",data)
        $uibModalInstance.close(data);
    };

    $scope.cancel = function() {
        $uibModalInstance.dismiss('cancel');
    };

    //    start new calebar
    $scope.dateTimeNow = function() {
        $scope.date = new Date();
    };
    $scope.dateTimeNow();
    $scope.toggleMinDate = function() {
        var minDate = new Date();
        // set to yesterday
        minDate.setDate(minDate.getDate());
        $scope.dateOptions.minDate = $scope.dateOptions.minDate ? null : minDate;
    };
    $scope.dateOptions = {
        showWeeks: false,
        startingDay: 0,
    };
    $scope.toggleMinDate();
    // Disable weekend selection
    $scope.disabled = function(calendarDate, mode) {
        return mode === 'day' && ( calendarDate.getDay() === 0 || calendarDate.getDay() === 6 );
    };
    $scope.open = function($event,opened) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.dateOpened = true;
    };
    $scope.dateOpened = false;
    $scope.hourStep = 1;
    $scope.format = "dd-MMM-yyyy";
    $scope.minuteStep = 15;

    $scope.timeOptions = {
        hourStep: [1, 2, 3],
        minuteStep: [1, 5, 10, 15, 25, 30]
    };

    $scope.showMeridian = false;
    $scope.timeToggleMode = function() {
        $scope.showMeridian = !$scope.showMeridian;
    };

    $scope.$watch("date", function(date) {
        // read date value
    }, true);

    $scope.resetHours = function() {
        $scope.dateTimeNow()
    };

//    end new calebar
})

app.controller('QuotesListCtrl', function($scope,Auth,$window,$state,$uibModal,$filter,apiService) {
    console.log("QuotesListCtrl")
    console.log(Auth.getUser())
    $scope.quotations = []
    $scope.requestedQuotes = []
    $scope.bookAbleQuotes = []
    $scope.ActiveUser = Auth.getUser()
    if(!$scope.ActiveUser){
        window.location = "http://filddy.com/auth/login"
    }
    obj = {
        'user_id': $scope.ActiveUser.user_id
    }
    apiService.getUserCarQuotations(obj).then(function(res){
        $scope.quotations = res.quotations
        $scope.requestedQuotes = $filter('filter')($scope.quotations, {status :'Requested'})
        $scope.bookAbleQuotes = $filter('filter')($scope.quotations, {status :'Bookable'})
    },function(err){
        console.log(err)
    })



    $scope.userAddress = {}
    $scope.userAddress.paymentMethod = "cash"



    //console.log($filter('date')($scope.quotations[0].created_at, 'fullDate'))

    $scope.formatDate = function(date){
        var newDate = new Date(date);
        return $filter('date')(newDate, 'fullDate');
    }
    $scope.showQuoteInfo = function(data){
        $state.go('dashboard.quoteinfo',{"quoteObj":JSON.stringify(data)})
    }

    $scope.deleteQuote = function(data){
        console.log(data)
        obj = {
            'quote_id': data.quote_id
        }
        apiService.DeleteUserQuote(obj).then(function(res){
            console.log(res)
            if(res.code == "200"){
                $state.go($state.current, {}, {reload: true});
            }
        },function(err){
            console.log(err)
        })
    }
    $scope.showAppointment = function(data){
        console.log("showAppointment : ",data)

        quote_data = data
        quote_services = []

        obj = {
            quote_id: data.quote_id
        }
        apiService.getUserQuoteInfo(obj).then(function(res){
            console.log(res)
            if(res.code == "200"){
                open()
                quote_services = res.services
            }
        },function(err){
            console.log(err)
        })

    }
    $scope.checkOut = function(data){
        data.checkoutDate = $scope.date
        console.log("checkout Obj: ","quote_request data :",quote_data," quote_services : ",quote_services, "checkOut data : ",data)
    }



    function open(){
        var modalInstance = $uibModal.open({
            templateUrl: '../templates/quote_checkout_modal.html',
            controller: 'QuoteCheckoutModalCtrl'
        });
        modalInstance.result.then(function(data) {
            console.log('Modal', data)
            console.log(" quote_services : ",quote_services)

        }, function() {
            console.log('Modal dismissed at: ' + new Date())
            //$state.go($state.current, {}, {reload: true});
        });
    }

    //    start new calebar
    $scope.dateTimeNow = function() {
        $scope.date = new Date();
    };
    $scope.dateTimeNow();
    $scope.toggleMinDate = function() {
        var minDate = new Date();
        // set to yesterday
        minDate.setDate(minDate.getDate());
        $scope.dateOptions.minDate = $scope.dateOptions.minDate ? null : minDate;
    };
    $scope.dateOptions = {
        showWeeks: false,
        startingDay: 0,
    };
    $scope.toggleMinDate();
    // Disable weekend selection
    $scope.disabled = function(calendarDate, mode) {
        return mode === 'day' && ( calendarDate.getDay() === 0 || calendarDate.getDay() === 6 );
    };
    $scope.open = function($event,opened) {
        $event.preventDefault();
        $event.stopPropagation();
        $scope.dateOpened = true;
    };
    $scope.dateOpened = false;
    $scope.hourStep = 1;
    $scope.format = "dd-MMM-yyyy";
    $scope.minuteStep = 15;

    $scope.timeOptions = {
        hourStep: [1, 2, 3],
        minuteStep: [1, 5, 10, 15, 25, 30]
    };

    $scope.showMeridian = false;
    $scope.timeToggleMode = function() {
        $scope.showMeridian = !$scope.showMeridian;
    };

    $scope.$watch("date", function(date) {
        // read date value
    }, true);

    $scope.resetHours = function() {
        $scope.dateTimeNow()
    };

//    end new calebar


})
