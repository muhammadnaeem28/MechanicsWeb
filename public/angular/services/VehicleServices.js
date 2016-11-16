app.service('VehicleService', function($q, $compile, $http) {



    this.getData = function() {
        var promise = $http.get('/pricing/vehicle-brands');
        promise = promise.then(function(response) {
            return response.data;
        });
        return promise;
    };
    this.postData = function(data) {

        var data = data.id;
        var promise = $http.get('/pricing/brand-years/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };

    this.postYear = function(data) {

        var data = data.id;
        var promise = $http.get('/pricing/vehicle-models/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };

    this.postYear = function(data) {

        var data = data.id;
        var promise = $http.get('/pricing/vehicle-models/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };


    this.postYearBrand = function(YearName,BrandName) {

        var year_id = YearName.id;
        var brand_id = BrandName.id;

        var promise = $http.get('/pricing/vehicle-models/'+ brand_id +'/'+year_id);
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });

        return promise;

    };


});