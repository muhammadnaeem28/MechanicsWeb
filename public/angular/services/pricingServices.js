/**
 * Created by Speridian on 7/27/2016.
 */
app.service('myService', function($q, $compile, $http) {
    this.getData = function() {
        var promise = $http.get('/pricing/service-categories');
        promise = promise.then(function(response) {
            return response.data;
        });
        return promise;
    };
    this.postData = function(data) {

        var data = data.id;
        var promise = $http.get('/pricing/category-services/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };

    this.postService = function(ServiceName) {

        var data = ServiceName.id;
        var promise = $http.get('/pricing/service-brands/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };

    this.postService2 = function(ServiceName) {

        var data = ServiceName.id;
        var promise = $http.get('/pricing/service-optionals/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };

    this.postSBrand = function(SBrandName) {

        var data = SBrandName.id;
        var promise = $http.get('/pricing/service-brand-types/'+ data +'');
        promise = promise.then(function(response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };


});
/*
/!**
 * Created by Speridian on 7/27/2016.
 *!/
app.service('myService', function($q,$compile,$http) {
    this.getData = function() {
        var promise = $http.get('/pricing/service-categories');
        promise = promise.then(function (response) {
            console.log(response.data);
            return response.data;
        });
        return promise;
    };
});*/
