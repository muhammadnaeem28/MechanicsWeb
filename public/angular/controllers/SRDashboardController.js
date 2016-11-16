app.controller('SRDashboardController', function($scope, $rootScope, myService){

    var scope = $rootScope;
    $scope.categoryArray = [];

    myService.getData().then(function(data) {
        $scope.myData = data;
        $scope.s_brand_services = "";
        $scope.s_optionals = "";
        $scope.s_brands = "";
        $scope.cat_services = "";
        console.log("swww");
    });
    $scope.getServices = function(categoryName){
        myService.postData(categoryName).then(function(data){
            $scope.cat_services = data;
            $scope.s_brand_services = "";
            $scope.s_optionals = "";
            $scope.s_brands= "";
            $scope.ServiceName= "";

            $('.s_price_style').val("");
            console.log("in controller got data");

        })
    };

    $scope.getSBrands = function(ServiceName){
        myService.postService(ServiceName).then(function(data){

            //  $scope.s_brand_services = "";

            console.log("################ getSBrands");
            console.log(data);

            $scope.s_brands = data;
            /*if(data.length>0){
             $scope.s_brands = data;
             alert("n")
             }else{
             alert("0")
             $scope.s_brands = [{ 'id': -1, 'name' : '' }];
             }*/
            if(data.length>0)
                $(".s_brand_s").parent().append("<input type='hidden' id='s_brand_check' name='s_brands_exist' value='11'/>");
            else{

                $("#s_brand_check").remove();
                $(".s_brand_s").parent().append("<input type='hidden' id='s_brand_check' name='s_brands_exist' value='00'/>");

            }



            //$scope.getSOptionals($scope.s_brands[0]);


            /*$scope.s_brand = $scope.s_brands[1].name;*!/*/



        })
    };

    $scope.getSOptionals= function(ServiceName){
        myService.postService2(ServiceName).then(function(data){
            $scope.s_optionals = data;

            console.log("in controller got data");
        })
    };

    $scope.getBServices= function(SBrandName){
        myService.postSBrand(SBrandName).then(function(data){
            $scope.s_brand_services = data;


            console.log("in controller got data");

        })
    };



});
