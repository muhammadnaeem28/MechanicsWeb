app.controller('VehicleController', function($scope, $rootScope, VehicleService){

    var scope = $rootScope;

    VehicleService.getData().then(function(data) {
        $scope.brands = data;

        $scope.models="";
//console.log($scope.response);
    });
    $scope.BrandName = '';
    $scope.getYears = function(BrandName){

        VehicleService.postData(BrandName).then(function(data){
            $scope.years = data;

            console.log("got years " , data);
            $scope.models="";

        })
    };


    $scope.YearName = '';
    $scope.getModels = function(YearName,BrandName){
        VehicleService.postYearBrand(YearName,BrandName).then(function(models){
            console.log("got models",models);

            $scope.models = models;

        })
    };




});




/*
app.controller('PricingController', function($scope, $rootScope, myService){

    var scope = $rootScope;
    $scope.categoryArray = [];
    myService.getData().then(function(data) {
        $scope.myData = data;
//console.log($scope.response);
    });
    $scope.categoryName = '';
    $scope.getServices = function(categoryName){
        console.log($scope.categoryName )
    }
});*/
