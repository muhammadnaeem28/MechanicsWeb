var app = angular.module('formApp')
app.factory('apiService', function (requestManager, $q, Auth ) {
  var urls = {
    baseURL: 'http://filddy.com/appointment/',
    baseURL2: 'http://filddy.com/auth/',
    baseURL3: 'http://filddy.com/',
    brands:'vehicle-brands',
    years:'brand-years',
    models:'vehicle-models',
    service:'getservice/',
    allServices:'services',
    allServiceCategories:'service-categories',
    categoryServices:'category-services',
    servicesInspection:'services-inspection',
    allServicesBrands:'all-service-brands',
    servicePrice:'price',
    optionalServices:'service-optionals/',
    login:'user-login',
    logged_user:'logged-user',
    requestQuotation:'request-quotation',
    checkout:'checkout',
    carList:'car/list',
    carAdd:'car/add',
    carUpdateMileage:'car/update-mileage',
    carDelete:'car/delete',
    userCarQuotations:'car/quotations',
    userCarQuoteServices:'car/quotation-services',
    userCarQuoteDelete:'car/quotation-delete',
    userAppointments:'car/appointments',
    userAppointmentsServices:'car/appointment-services',
  }
  function login(data) {
    var deferred = $q.defer();
    var url = urls.baseURL2 + urls.login;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function logged_user() {
    var deferred = $q.defer();
    var url = urls.baseURL2 + urls.logged_user;
    requestManager.get(url, {})
      .then(function (res) {
        if(!res.hasOwnProperty("code")){
          Auth.setUser(res)
        }
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getVehicleBrands(){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.brands;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getVehicleYears(brand_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.years+"/"+brand_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getVehicleModels(brand_id,year_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.models+"/"+brand_id+"/"+year_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getservice(s_id){
    var deferred = $q.defer();
    var url = urls.baseURL+urls.service+s_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetAllServices(){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.allServices;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetAllServiceCategories(){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.allServiceCategories;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetServicesOfCategory(category_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.categoryServices+"/"+category_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetServicesInspection(){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.servicesInspection;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetAllServicesBrands(){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.allServicesBrands;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetServicePrice(cb_id,cy_id,cm_id,s_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.servicePrice+"?cb_id="+cb_id+"&cy_id="+cy_id+"&cm_id="+cm_id+"&s_id="+s_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetOptionalServices(service_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.optionalServices+service_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function GetOptionalServicePrice(cb_id,cy_id,cm_id,s_id){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.servicePrice+"?cb_id="+cb_id+"&cy_id="+cy_id+"&cm_id="+cm_id+"&s_id="+s_id;
    requestManager.get(url, {})
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function SendRequestQuotation(data){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.requestQuotation;
    requestManager.post3(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function SendRequestCheckout(data){
    var deferred = $q.defer();
    var url = urls.baseURL + urls.checkout;
    requestManager.post3(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getUserCarList(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.carList;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function SetUserCarAdd(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.carAdd;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function UpdateUserCarMileage(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.carUpdateMileage;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function DeleteUserCar(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.carDelete;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getUserCarQuotations(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.userCarQuotations;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getUserQuoteInfo(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.userCarQuoteServices;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function DeleteUserQuote(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.userCarQuoteDelete;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getUserAppointmentList(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.userAppointments;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }
  function getUserAppointmentInfo(data){
    var deferred = $q.defer();
    var url = urls.baseURL3 + urls.userAppointmentsServices;
    requestManager.post2(url, data)
      .then(function (res) {
        deferred.resolve(res);
      }, function (err) {
        deferred.reject(err);
      });
    return deferred.promise;
  }

  return {
    login:login,
    logged_user:logged_user,
    getVehicleBrands:getVehicleBrands,
    getVehicleYears:getVehicleYears,
    getVehicleModels:getVehicleModels,
    getservice:getservice,
    GetAllServices:GetAllServices,
    GetAllServiceCategories:GetAllServiceCategories,
    GetServicesOfCategory:GetServicesOfCategory,
    GetServicesInspection:GetServicesInspection,
    GetAllServicesBrands:GetAllServicesBrands,
    GetServicePrice:GetServicePrice,
    GetOptionalServices:GetOptionalServices,
    GetOptionalServicePrice:GetOptionalServicePrice,
    SendRequestQuotation:SendRequestQuotation,
    SendRequestCheckout:SendRequestCheckout,
    getUserCarList:getUserCarList,
    SetUserCarAdd:SetUserCarAdd,
    UpdateUserCarMileage:UpdateUserCarMileage,
    DeleteUserCar:DeleteUserCar,
    getUserCarQuotations:getUserCarQuotations,
    getUserQuoteInfo:getUserQuoteInfo,
    DeleteUserQuote:DeleteUserQuote,
    getUserAppointmentList:getUserAppointmentList,
    getUserAppointmentInfo:getUserAppointmentInfo
  }
})
app.factory('Auth', function ($window){

  function getUser() {
    user = JSON.parse($window.localStorage.getItem("userInfo"));
    if(user){
      if(!user.hasOwnProperty("code") && user){
        return user
      }
      return false
    }
    return false
  }
  function setUser(data) {
    if(!data.hasOwnProperty("code")){
      $window.localStorage.setItem("userInfo", JSON.stringify(data));
    }

  }
  return {
    getUser:getUser,
    setUser:setUser
  }
})
