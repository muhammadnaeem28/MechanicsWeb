var app = angular.module('formApp')
app.factory('requestManager', function ($q, $http, $httpParamSerializer) {

  function get (url, data) {
    var deferred = $q.defer();
    var req = {
      method: 'GET',
      url: url,
      data: data
    }
    $http(req)
      .success(function (response) {
        deferred.resolve(response);
      })
      .error(function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }

  function post (url, data) {
    var deferred = $q.defer();
    var req = {
      method: 'POST',
      url: url,
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded'
      },
      data: data
    }
    $http(req)
      .success(function (response) {
        deferred.resolve(response);
      })
      .error(function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function post2(url,data) {
    var deferred = $q.defer();
    $http({
      method: "post",
      url: url,
      data: $.param(data),
      headers:{"Content-Type":"application/x-www-form-urlencoded"}
    }).success(function (data) {
      deferred.resolve(data);
    }).error(function (err) {
      console.log(err);
      deferred.reject(err);
    });
    return deferred.promise;
  }
  function post3(url,data) {
    var deferred = $q.defer();
    $http({
      method: "post",
      url: url,
      data: data,
      headers:{"Content-Type":"application/json"}
    }).success(function (data) {
      deferred.resolve(data);
    }).error(function (err) {
      console.log(err);
      deferred.reject(err);
    });
    return deferred.promise;
  }

  return {
    get: get,
    post: post,
    post2: post2,
    post3: post3
  }
});
