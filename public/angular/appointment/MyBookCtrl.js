var app = angular.module('formApp')

app.controller('BookCtrl', function($scope,$state,Auth,$anchorScroll,$location,apiService,$filter,$compile,$window,$stateParams,GetService) {
  console.log("GetService :",GetService)

  requestFromHome = false;

  if(GetService != -1){
    requestFromHome = true;
    requestFromHomeObj = GetService;
  }

  $scope.carData = [];
  $scope.vehicleBrands = [];
  $scope.vehicleYears = [];
  $scope.vehicleModels = [];
  $scope.vehicleTrims = [];

  $scope.allServiceCategories = [];
  $scope.serviceCategoryName = "";
  $scope.serviceCategory = [];
  $scope.servicesInspection = [];
  $scope.searchResult = [];

  $scope.selectedServiceBrand = [];
  $scope.selectedServiceBrandName = "";

  $scope.optionalServiceList = [];


  $scope.showMake = false;
  $scope.showYear = false;
  $scope.showModel = false;
  $scope.showTrim = false;
  $scope.showServices = false;
  $scope.searchTab = false;
  $scope.showServiceBrands = false;
  $scope.showOptionalService = false;
  $scope.optionalService_index = 0;
  $scope.showCalendar = false;
  $scope.showLoginForm = false;
  $scope.showAddress = false;
  $scope.userAddress = {};
  $scope.userAddress.paymentMethod = "cash";
  $scope.ActiveUser = Auth.getUser()
  //$scope.ActiveUser = JSON.parse($window.localStorage.getItem("userInfo"));
  console.log("ActiveUser : ",$scope.ActiveUser)

  $scope.requestQuotationBtn = false;

  allservices = [];
  allServicesBrands = [];

  //shopping cart
  $scope.shoppingCartselectedCarName = "Select Car";
  $scope.shoppingCartselectedServiceList = [];
  tempObjForSelectedService = {};
  $scope.cartPrice = 0.00;
  $scope.totalServicesTime = 0;
  $scope.showPriceTotal = true;
  selectedServicesWithNOPrice = [];
  $scope.showDateAndTime = false;
  $scope.selectedDateAndTime = "";


  //for optional service
  $scope.shoppingCartselectedOptionalServiceList = [];
  tempObjForSelectedOptionalService = {};
  selectedOptioanlServicesWithNOPrice = [];



  getvehicles()
  function getvehicles() {
    apiService.getVehicleBrands().then(function (res) {
      console.log(res);
      if (res) {
        $scope.vehicleBrands = res;
        $scope.showMake = true;
      }
    }, function (err) {
      console.log(err);
    });
    apiService.GetAllServices().then(function (res) {
      console.log(res);
      if (res) {
        allservices = res;

      }
    }, function (err) {
      console.log(err);
    });
    apiService.GetAllServiceCategories().then(function (res) {
      console.log(res);
      if (res) {
        $scope.allServiceCategories = res;
        $scope.serviceCategoryName = res[0].name;
        $scope.serviceCategory = filterServicsById(res[0].id);

        //  inspection service
        apiService.GetServicesInspection().then(function (res) {
          console.log(res);
          if (res) {
            $scope.servicesInspection = res;
          }
        }, function (err) {
          console.log(err);
        });

        apiService.GetAllServicesBrands().then(function (res) {
          console.log(res);
          if (res) {
            allServicesBrands = res;
          }
        }, function (err) {
          console.log(err);
        });


      }
    }, function (err) {
      console.log(err);
    });


  }

  $scope.selectMake = function (make) {
    console.log("select Make...", make)
    $scope.carData = [];
    obj = {};
    obj['type'] = "make";
    obj['data'] = make;
    obj['value'] = make.name;
    $scope.carData.push(obj)
    console.log($scope.carData)
    apiService.getVehicleYears(make.id).then(function (res) {
      console.log(res);
      if (res) {
        $scope.vehicleYears = res;

        $scope.showMake = false;
        $scope.showYear = true;
        $scope.showModel = false;
        $scope.showTrim = false;
        $scope.showServices = false;
      }
    }, function (err) {
      console.log(err);
    })
  }
  $scope.selectYear = function (year) {
    console.log("select year...", year)
    $scope.carData.splice(1, 2);
    var obj = {};

    obj.type = "year";
    obj.data = year;
    obj.value = year.name;
    $scope.carData.push(obj)
    apiService.getVehicleModels($scope.carData[0].data.id, year.id).then(function (res) {
      console.log(res);
      if (res) {
        $scope.vehicleModels = res;

        $scope.showMake = false;
        $scope.showYear = false;
        $scope.showModel = true;
        $scope.showTrim = false;
        $scope.showServices = false;
      }
    }, function (err) {
      console.log(err);
    })
    //}
  }
  $scope.selectModel = function (model) {
    console.log("select model...", model)
    $scope.carData.splice(2, 1);

    var obj = {};

    obj['type'] = "model";
    obj['data'] = model
    obj['value'] = model.name
    $scope.carData.push(obj)
    console.log($scope.carData)

    $scope.vehicleTrims = model.trim;

    $scope.showMake = false;
    $scope.showYear = false;
    $scope.showModel = false;
    $scope.showTrim = false;
    //$scope.showServices = false;

    $scope.shoppingCartselectedCarName = $scope.carData[1].value + " " + $scope.carData[0].value + " " + $scope.carData[2].value

    if(requestFromHome){
      $scope.showServices = true;
      $scope.selectService(requestFromHomeObj)
    }else{
      $scope.showServices = true;
    }


    $location.hash('service-box');
    $anchorScroll();
  }
  $scope.selectTrim = function (trim) {
    console.log("select trim...", trim)
    $scope.carData.splice(3, 1);
    var obj = {};

    obj['type'] = "trim";
    obj['value'] = trim
    $scope.carData.push(obj)
    console.log($scope.carData)
    $scope.showMake = false;
    $scope.showYear = false;
    $scope.showModel = false;
    $scope.showTrim = false;

    $scope.shoppingCartselectedCarName = $scope.carData[1].value + " " + $scope.carData[0].value + " " + $scope.carData[2].value + " " + $scope.carData[3].value

    if(requestFromHome){
      $scope.showServices = true;
      $scope.selectService(requestFromHomeObj)
    }else{
      $scope.showServices = true;
    }


    $location.hash('service-box');
    $anchorScroll();
  }
  $scope.ChangeCarOption = function (state) {
    console.log(state)
    //$state.go('tabs.car-'+state)
    if (state == 'make') {
      console.log("select make")
      $scope.showMake = true;
      $scope.showYear = false;
      $scope.showModel = false;
      $scope.showTrim = false;
      $scope.showServices = false;
    } else if (state == 'year') {
      console.log("select year")
      $scope.showMake = false;
      $scope.showYear = true;
      $scope.showModel = false;
      $scope.showTrim = false;
      $scope.showServices = false;
    } else if (state == 'model') {
      console.log("select model")
      $scope.showMake = false;
      $scope.showYear = false;
      $scope.showModel = true;
      $scope.showTrim = false;
      $scope.showServices = false;
    } else if (state == 'trim') {
      console.log("select trim")
      $scope.showMake = false;
      $scope.showYear = false;
      $scope.showModel = false;
      $scope.showTrim = true;
      $scope.showServices = false;
    }
  }

  $scope.getServiceCategoryItems = function (obj) {
    $scope.serviceCategoryName = obj.name;
    $scope.serviceCategory = filterServicsById(obj.id);
    //apiService.GetServicesOfCategory(obj.id).then(function(res){
    //    console.log(res);
    //    if(res){
    //        $scope.serviceCategoryName = obj.name;
    //$scope.serviceCategory = res;
    //}
    //},function(err){
    //    console.log(err);
    //});
  }

  $scope.searchService = function (query) {
    console.log(query)
    $scope.searchTab = true;
    if (query == "") {
      $scope.searchResult = [];
      $scope.searchTab = false;
    } else {
      $scope.searchResult = $filter('filter')(allservices, {name: query});
    }

  }
  function filterServicsById(category_id) {
    return $filter('filter')(allservices, {s_category_id: category_id});
  }


  $scope.selectService = function (obj) {
    console.log(obj)
    $scope.showOptionalService = false;
    searchServiceBrand = [];
    $scope.optionalServiceList = [];
    $scope.optionalService_index = 0;
    tempObjForSelectedService = {};
    tempObjForSelectedService.isSelected = true;
    tempObjForSelectedService.name = obj.name;
    tempObjForSelectedService.s_id = obj.id;
    tempObjForSelectedService.s_category_id = obj.s_category_id;
    searchServiceBrand = $filter('filter')(allServicesBrands, {s_id: obj.id});
    if (searchServiceBrand.length > 0) {
      $scope.showServiceBrands = true;
      $scope.selectedServiceBrandName = obj.name;
      $scope.selectedServiceBrand = searchServiceBrand;
      $location.hash('service-brands-box');
      $anchorScroll();
    } else {
      $scope.showServiceBrands = false;
      apiService.GetServicePrice($scope.carData[0].data.id,$scope.carData[1].data.id,$scope.carData[2].data.id,obj.id).then(function(res){
        console.log(res)
        tempObjForSelectedService.price = res.data.price;
        tempObjForSelectedService.time = calculateServiceTime(res.data.hours,res.data.mints);
        addService(tempObjForSelectedService)
      },function(err){
        console.log("err",err)
        tempObjForSelectedService.price = "";
        tempObjForSelectedService.time = 0;
        addService(tempObjForSelectedService)
      })

      //$scope.shoppingCartselectedServiceList.push(tempObjForSelectedService)
    }
    apiService.GetOptionalServices(obj.id).then(function(res){
      $scope.optionalServiceList = res;
      console.log(res)
      if(res.length > 0){
        if(!$scope.showServiceBrands){
          $scope.showOptionalService = true;
          $location.hash('optionalService-box');
          $anchorScroll();
        }
      }
    },function(err){
      console.log(err)
      $scope.showOptionalService = false;
      checkUserStatus();
    })


    //console.log("show tempObjForSelectedService",tempObjForSelectedService)
  }
  $scope.chooseServiceBrand = function (obj) {
    console.log("selected service brand", obj)
    $scope.showServiceBrands = false;
    if (obj.s_id == "14") {
      console.log("oil price", parseFloat($scope.carData[2].data.engine_oil) * parseFloat(obj.price))
      tempObjForSelectedService.price = parseFloat($scope.carData[2].data.engine_oil) * parseFloat(obj.price);
    } else {
      tempObjForSelectedService.price = obj.price;
    }
    tempObjForSelectedService.b_id =  obj.id;
    tempObjForSelectedService.b_name = obj.name;
    tempObjForSelectedService.time = calculateServiceTime(obj.s_hours,obj.s_mints);
    if($scope.optionalServiceList.length > 0){
      $scope.showOptionalService = true;
      $location.hash('optionalService-box');
      $anchorScroll();
    }
    addService(tempObjForSelectedService)
  }
  function showNextOption(){
    if ($scope.optionalService_index >= $scope.optionalServiceList.length - 1) {
      $scope.showOptionalService = false;
      checkUserStatus();
    } else {
      $scope.optionalService_index++;
    }
  }
  $scope.optionalServiceYes = function(obj){
    console.log("optionalServiceAdd",obj)

    tempObjForSelectedOptionalService = {};
    tempObjForSelectedOptionalService.os_id = obj.id;
    tempObjForSelectedOptionalService.s_id = obj.pivot.s_id;
    tempObjForSelectedOptionalService.isSelected = true;
    tempObjForSelectedOptionalService.name = obj.name;

    //apiService.GetOptionalServicePrice($scope.carData[0].data.id,$scope.carData[1].data.id,$scope.carData[2].data.id,obj.pivot.s_id).then(function(res){
    //    console.log(res)
    //    tempObjForSelectedOptionalService.price = res.data.price;
    //    tempObjForSelectedOptionalService.time = calculateServiceTime(res.data.hours,res.data.mints);
    //    showNextOption()
    //    addOptionalService(tempObjForSelectedOptionalService)
    //},function(err){
    //    console.log("err",err)
    tempObjForSelectedOptionalService.price = "123";
    tempObjForSelectedOptionalService.time = 0;
    showNextOption()
    addOptionalService(tempObjForSelectedOptionalService)
    //})
  }
  $scope.optionalServiceNo = function(obj){
    console.log("optionalServiceRemove",obj)
    showNextOption()
    //if ids exsist then call remove function
  }
  function calculateServiceTime(H,M){
    if(H && M){
      return  parseInt(H)*3600 + parseInt(M)*60;
    }
    return 0;
  }
  //shopping cart
  function addServiceTime(time) {
    $scope.totalServicesTime += time;
    calculateTime($scope.totalServicesTime)
  }
  function removeServiceTime(time) {
    $scope.totalServicesTime -= time;
    calculateTime($scope.totalServicesTime)
  }
  function calculateTime(seconds){
    Hours =  parseInt($scope.totalServicesTime/3600)
    Minutes = $filter('number')((($scope.totalServicesTime/3600)%1)*60,0)
    if(Hours<10) {
      Hours='0'+Hours
    }
    if(Minutes<10) {
      Minutes='0'+Minutes
    }
    $scope.totalTime = Hours+":"+Minutes
  }

  function addServicePrice(price) {
    $scope.cartPrice += parseFloat(price);
  }

  function removeServicePrice(price) {

    $scope.cartPrice -= parseFloat(price);
  }

  function addService(obj) {
    temp = $filter('filter')($scope.shoppingCartselectedServiceList, {name: obj.name});
    if (temp.length > 0) {
      obj_index = $scope.shoppingCartselectedServiceList.indexOf(temp[0]);
      if(obj.price) {
        //$scope.showPriceTotal = true;
        removeServicePrice(temp[0].price)
        $scope.shoppingCartselectedServiceList[obj_index].price = obj.price;
        addServicePrice(obj.price)
      }
      removeServiceTime(temp[0].time);
      $scope.shoppingCartselectedServiceList[obj_index].time = obj.time;
      addServiceTime(obj.time)
    } else {
      if(obj.price){
        //$scope.showPriceTotal = true;
        $scope.shoppingCartselectedServiceList.push(obj)
        addServicePrice(obj.price)

      }else{
        $scope.showPriceTotal = false;
        selectedServicesWithNOPrice.push(obj)
        $scope.shoppingCartselectedServiceList.push(obj);
      }
      addServiceTime(obj.time)
      checkUserStatus();
      //if($scope.showPriceTotal){
      //    $scope.showCalendar = true;
      //}else{
      //    $scope.showCalendar = false;
      //    checkUserStatus()
      //}
    }

  }
  $scope.RemoveService = function (obj) {
    console.log(obj)
    console.log($scope.shoppingCartselectedServiceList.indexOf(obj))
    obj_index = $scope.shoppingCartselectedServiceList.indexOf(obj)
    $scope.shoppingCartselectedServiceList.splice(obj_index, 1)
    if(obj.price){
      if (obj.isSelected) {
        removeServicePrice(obj.price);
        removeServiceTime(obj.time);
      }
    }else{
      obj_index = selectedServicesWithNOPrice.indexOf(obj)
      selectedServicesWithNOPrice.splice(obj_index, 1)
      if(selectedServicesWithNOPrice.length < 1 && selectedOptioanlServicesWithNOPrice.length< 1){
        $scope.showPriceTotal = true;
      }
    }
    //remove optional services against this s_id
    temp = $filter('filter')($scope.shoppingCartselectedOptionalServiceList, {s_id:obj.s_id});
    angular.forEach(temp, function(value, key){
      $scope.RemoveOptionalService(value)
    });
    checkUserStatus();
    //if($scope.showPriceTotal){
    //    $scope.showCalendar = true;
    //}else{
    //    $scope.showCalendar = false;
    //    checkUserStatus()
    //}
  }

  $scope.checkBoxService = function (obj) {
    console.log(obj)
    if(obj.price){
      if (obj.isSelected) {
        addServicePrice(obj.price)
        addServiceTime(obj.time)
      } else {
        removeServicePrice(obj.price)
        removeServiceTime(obj.time)
      }
    }else{
      if (obj.isSelected) {
        $scope.showPriceTotal = false;
        selectedServicesWithNOPrice.push(obj)
        addServiceTime(obj.time)
      }else{
        obj_index = selectedServicesWithNOPrice.indexOf(obj)
        selectedServicesWithNOPrice.splice(obj_index, 1)
        removeServiceTime(obj.time)
        if(selectedServicesWithNOPrice.length < 1){
          $scope.showPriceTotal = true;
        }
      }
    }
    checkUserStatus();
    //if($scope.showPriceTotal){
    //    $scope.showCalendar = true;
    //}else{
    //    $scope.showCalendar = false;
    //    checkUserStatus()
    //}
    //if($scope.shoppingCartselectedServiceList.indexOf(obj) != -1){
    console.log($scope.shoppingCartselectedServiceList.indexOf(obj))
    //}

  }
  // for optional service

  function addOptionalService(obj) {
    temp = $filter('filter')($scope.shoppingCartselectedOptionalServiceList, {os_id:obj.os_id});
    if (temp.length > 0) {
      obj_index = $scope.shoppingCartselectedOptionalServiceList.indexOf(temp[0]);
      if(obj.price) {
        removeServicePrice(temp[0].price)
        $scope.shoppingCartselectedOptionalServiceList[obj_index].price = obj.price;
        addServicePrice(obj.price)
      }
      removeServiceTime(temp[0].time);
      $scope.shoppingCartselectedOptionalServiceList[obj_index].time = obj.time;
      addServiceTime(obj.time)
    } else {
      if(obj.price){
        $scope.shoppingCartselectedOptionalServiceList.push(obj)
        addServicePrice(obj.price)
      }else{
        $scope.showPriceTotal = false;
        selectedOptioanlServicesWithNOPrice.push(obj)
        $scope.shoppingCartselectedOptionalServiceList.push(obj);
      }
      addServiceTime(obj.time)
    }
    checkUserStatus();
    //if($scope.showPriceTotal){
    //    $scope.showCalendar = true;
    //}else{
    //    $scope.showCalendar = false;
    //    checkUserStatus()
    //}

  }
  $scope.RemoveOptionalService = function (obj) {
    console.log(obj)
    console.log($scope.shoppingCartselectedOptionalServiceList.indexOf(obj))
    obj_index = $scope.shoppingCartselectedOptionalServiceList.indexOf(obj)
    $scope.shoppingCartselectedOptionalServiceList.splice(obj_index, 1)
    if(obj.price){
      if (obj.isSelected) {
        removeServicePrice(obj.price);
        removeServiceTime(obj.time);
      }
    }else{
      obj_index = selectedOptioanlServicesWithNOPrice.indexOf(obj)
      selectedOptioanlServicesWithNOPrice.splice(obj_index, 1)
      if(selectedServicesWithNOPrice.length < 1 && selectedOptioanlServicesWithNOPrice.length< 1){
        $scope.showPriceTotal = true;
      }
    }
    checkUserStatus();
    //if($scope.showPriceTotal){
    //    $scope.showCalendar = true;
    //}else{
    //    $scope.showCalendar = false;
    //    checkUserStatus()
    //}

  }

  $scope.checkBoxOptionalService = function (obj) {
    console.log(obj)
    if(obj.price){
      if (obj.isSelected) {
        addServicePrice(obj.price)
        addServiceTime(obj.time)
      } else {
        removeServicePrice(obj.price)
        removeServiceTime(obj.time)
      }
    }else{
      if (obj.isSelected) {
        $scope.showPriceTotal = false;
        selectedOptioanlServicesWithNOPrice.push(obj)
        addServiceTime(obj.time)
      }else{
        obj_index = selectedOptioanlServicesWithNOPrice.indexOf(obj)
        selectedOptioanlServicesWithNOPrice.splice(obj_index, 1)
        removeServiceTime(obj.time)
        if(selectedServicesWithNOPrice.length < 1 && selectedOptioanlServicesWithNOPrice.length < 1){
          $scope.showPriceTotal = true;
        }
      }
    }
    checkUserStatus();
    //if($scope.showPriceTotal){
    //    $scope.showCalendar = true;
    //}else{
    //    $scope.showCalendar = false;
    //    checkUserStatus()
    //}

  }

  $scope.selectDateNextBtn = function(){
    //checkUserStatus()
    $scope.showAddress = true;
    $scope.showDateAndTime = true;
    $scope.selectedDateAndTime =  $filter('date')($scope.date, "medium");
    $location.hash('address-box');
    $anchorScroll();


  }
  function checkUserStatus(){
    //if($scope.ActiveUser){
    //    $scope.requestQuotationBtn = true;
    //}else{
    //    if(!$scope.requestQuotationBtn){
    //        $scope.showLoginForm = true;
    //        $scope.requestQuotationBtn = false;
    //        $location.hash('loginForm-box');
    //        $anchorScroll();
    //    }
    //
    //}
    $scope.showCalendar = false;
    $scope.requestQuotationBtn = false;
    $scope.showAddress = false;
    if($scope.ActiveUser){
      if($scope.cartPrice >0 && $scope.showPriceTotal){
        if(!$scope.showOptionalService){
          $scope.showCalendar = true;
        }

        //$scope.requestQuotationBtn = false;
      }else if(!$scope.showPriceTotal){
        if($scope.shoppingCartselectedServiceList.length > 0){
          //$scope.showCalendar = false;
          $scope.requestQuotationBtn = true;
        }

      }
    }else{
      $scope.showLoginForm = true;
      $location.hash('loginForm-box');
      $anchorScroll();
    }

  }

  $scope.shopCartselectedCarName = function () {
    $location.hash('select-car-box');
    $anchorScroll();
  }

  $scope.requestQuotation = function(){
    console.log("Car Info",$scope.carData)
    console.log("Services Info",$scope.shoppingCartselectedServiceList)
    console.log("Brands Info")
    console.log("optional Services Info",$scope.shoppingCartselectedOptionalServiceList)
    Hours =  parseInt($scope.totalServicesTime/3600)
    Minutes = $filter('number')((($scope.totalServicesTime/3600)%1)*60,0)
    if(Hours<10) {
      Hours='0'+Hours
    }
    if(Minutes<10) {
      Minutes='0'+Minutes
    }
    console.log("time Info",Hours+":"+Minutes)
    requestObject = {}
    requestObject.car_info = $scope.carData
    requestObject.services_info = $scope.shoppingCartselectedServiceList
    requestObject.optional_services_info = $scope.shoppingCartselectedOptionalServiceList
    requestObject.user_info = $scope.ActiveUser
    requestObject.selectedDateTime = $scope.date
    //console.log(JSON.stringify(requestObject))
    console.log(angular.toJson(requestObject))
    apiService.SendRequestQuotation(angular.toJson(requestObject))
        .then(function(res){
          console.log(res)
          if(res.hasOwnProperty('code')){
            if(res.code == "200"){
              $state.go('dashboard.quoteslist')
            }
          }
        },function(err){
          console.log(err)
        })
  }
  $scope.loginErrors = false;
  $scope.loginForm = function(user){
    console.log("loginForm", user)
    $scope.loginErrors = false;
    if(user){
      apiService.login(user).then(function(res){
        console.log(res)
        if(res.hasOwnProperty("user_id")){
          Auth.setUser(res)
          $scope.ActiveUser = Auth.getUser()
          $scope.showLoginForm = false;
          checkUserStatus()
        }else{
          $scope.loginErrors = true;
        }

      },function(err){
        console.log(err)
        $scope.loginErrors = true;
      })

    }
  }
  $scope.forgetForm = function(user){
    console.log("forgetForm", user)
  }
  $scope.registeForm = function(user){
    console.log("registeForm", user)
  }

  $scope.checkOut = function(data){
    console.log("checkOut : ",data)
    console.log("Car Info",$scope.carData)
    console.log("Services Info",$scope.shoppingCartselectedServiceList)
    console.log("Brands Info")
    console.log("optional Services Info",$scope.shoppingCartselectedOptionalServiceList)
    Hours =  parseInt($scope.totalServicesTime/3600)
    Minutes = $filter('number')((($scope.totalServicesTime/3600)%1)*60,0)
    if(Hours<10) {
      Hours='0'+Hours
    }
    if(Minutes<10) {
      Minutes='0'+Minutes
    }
    console.log("time Info",Hours+":"+Minutes)
    console.log("Total Price",$scope.cartPrice)
    data.total_time = Hours+":"+Minutes+":00"
    requestObject = {}
    requestObject.car_info = $scope.carData
    requestObject.services_info = $scope.shoppingCartselectedServiceList
    requestObject.optional_services_info = $scope.shoppingCartselectedOptionalServiceList
    requestObject.user_info = $scope.ActiveUser
    requestObject.selectedDateTime = $scope.date
    requestObject.user_address = data
    requestObject.totalPrice= $scope.cartPrice
    console.log(angular.toJson(requestObject))
    apiService.SendRequestCheckout(angular.toJson(requestObject))
        .then(function(res){
          console.log(res)
        if(res.hasOwnProperty('code')){
          if(res.code == "200"){
            $state.go('dashboard.appointmentlist')
          }
        }
        },function(err){
          console.log(err)
        })
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


});
app.filter("cfilter", function () {
  return function (input, x, y) {

    var groups = [];
    var letters = genCharArray(x, y);
    for (var i = 0; i < input.length; i++) {
      for (var x = 0; x < letters.length; x++) {
        if (input[i].name.substring(0, 1) == letters[x])
          groups.push(input[i]);
      }

    }
    return groups;
  }
});
app.filter("nfilter", function () {
  return function (input, x, y) {
    var groups = [];
    for (var i = 0; i < input.length; i++) {
      if (parseInt(input[i].name) >= parseInt(x) && parseInt(input[i].name) <= parseInt(y)){
        groups.push(input[i]);
      }
    }
    return groups;
  }
});
function genCharArray(charA, charZ) {
  var a = [], i = charA.charCodeAt(0), j = charZ.charCodeAt(0);
  for (; i <= j; ++i) {
    a.push(String.fromCharCode(i));
  }
  return a;
};




angular.module('ui.bootstrap.datetimepicker', ["ui.bootstrap.dateparser", "ui.bootstrap.datepicker", "ui.bootstrap.timepicker"])
    .directive('datepickerPopup', function () {
      return {
        restrict: 'EAC',
        require: 'ngModel',
        link: function (scope, element, attr, controller) {
          //remove the default formatter from the input directive to prevent conflict
          controller.$formatters.shift();
        }
      }
    })
    .directive('datetimepicker', [
      function () {

        function versionCheck(){
          return (angular.version.major === 1 && (angular.version.minor > 4 || (angular.version.minor === 4 && angular.version.dot >= 4)));
        }

        if (!versionCheck()) {
          return {
            restrict: 'EA',
            template: "<div class=\"alert alert-danger\">Angular 1.4.4 or above is required for datetimepicker to work correctly</div>"
          };
        }
        return {
          restrict: 'EA',
          require: 'ngModel',
          scope: {
            ngModel: '=',
            ngChange: '&',
            dayFormat: "=",
            monthFormat: "=",
            yearFormat: "=",
            dayHeaderFormat: "=",
            dayTitleFormat: "=",
            monthTitleFormat: "=",
            yearRange: "=",
            dateOptions: "=?",
            dateDisabled: "&",
            dateNgClick: "&",
            hourStep: "=",
            dateOpened: "=",
            minuteStep: "=",
            showMeridian: "=",
            meredians: "=",
            mousewheel: "=",
            readonlyTime: "=",
            readonlyDate: "=",
            disabledDate: "=",
            hiddenTime: "=",
            hiddenDate: "="
          },
          template: function (elem, attrs) {
            function dashCase(name) {
              return name.replace(/[A-Z]/g, function (letter, pos) {
                return (pos ? '-' : '') + letter.toLowerCase();
              });
            }

            function createAttr(innerAttr, dateTimeAttrOpt) {
              var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
              if (attrs[dateTimeAttr]) {
                return dashCase(innerAttr) + "=\"" + dateTimeAttr + "\" ";
              } else {
                return '';
              }
            }

            function createOptionsAttr(innerAttr, dateTimeAttrOpt) {
              var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
              return dashCase(innerAttr) + "=\"dateOptions." + dateTimeAttr + "\" ";
            }

            function createFuncAttr(innerAttr, funcArgs, dateTimeAttrOpt, defaultImpl) {
              var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
              if (attrs[dateTimeAttr]) {
                return dashCase(innerAttr) + "=\"" + dateTimeAttr + "({" + funcArgs + "})\" ";
              } else {
                return angular.isDefined(defaultImpl) ? dashCase(innerAttr) + "=\"" + defaultImpl + "\"" : "";
              }
            }

            function createEvalAttr(innerAttr, dateTimeAttrOpt) {
              var dateTimeAttr = angular.isDefined(dateTimeAttrOpt) ? dateTimeAttrOpt : innerAttr;
              if (attrs[dateTimeAttr]) {
                return dashCase(innerAttr) + "=\"" + attrs[dateTimeAttr] + "\" ";
              } else {
                return dashCase(innerAttr) + " ";
              }
            }

            function createAttrConcat(previousAttrs, attr) {
              return previousAttrs + createAttr.apply(null, attr)
            }

            function createOptionsAttrConcat(previousAttrs, attr) {
              return previousAttrs + createOptionsAttr.apply(null, attr)
            }

            var dateTmpl = "<div class=\"datetimepicker-wrapper\">" +
                "<input class=\"form-control\" type=\"text\" " +
                "name=\"datepicker\"" +
                "ng-change=\"date_change($event)\" " +
                "is-open=\"innerDateOpened\" " +
                "datepicker-options=\"dateOptions\" " +
                "uib-datepicker-popup=\"{{dateFormat}}\"" +
                "ng-model=\"ngModel\" " + [
                  ["dayFormat"],
                  ["monthFormat"],
                  ["yearFormat"],
                  ["dayHeaderFormat"],
                  ["dayTitleFormat"],
                  ["monthTitleFormat"],
                  ["yearRange"],
                  ["showButtonBar"],
                  ["ngHide", "hiddenDate"],
                  ["ngReadonly", "readonlyDate"],
                  ["ngDisabled", "disabledDate"]
                ].reduce(createAttrConcat, '') +
                createFuncAttr("ngClick",
                    "$event: $event, opened: opened",
                    "dateNgClick",
                    "open($event)") +
                createEvalAttr("currentText", "currentText") +
                createEvalAttr("clearText", "clearText") +
                createEvalAttr("datepickerAppendToBody", "datepickerAppendToBody") +
                createEvalAttr("closeText", "closeText") +
                createEvalAttr("placeholder", "placeholder") +
                "/>\n" +
                "</div>\n";
            var timeTmpl = "<div class=\"datetimepicker-wrapper\" name=\"timepicker\" ng-model=\"time\" ng-change=\"time_change()\" style=\"display:inline-block\">\n" +
                "<div uib-timepicker " + [
                  ["hourStep"],
                  ["minuteStep"],
                  ["showMeridian"],
                  ["meredians"],
                  ["mousewheel"],
                  ["ngHide", "hiddenTime"],
                  ["ngDisabled", "readonlyTime"]
                ].reduce(createAttrConcat, '') + [
                  ["min", "minDate"],
                  ["max", "maxDate"]
                ].reduce(createOptionsAttrConcat, '') +
                createEvalAttr("showSpinners", "showSpinners") +
                "></div>\n" +
                "</div>";
            // form is isolated so the directive is registered as one component in the parent form (not date and time)
            var tmpl = "<ng-form name=\"datetimepickerForm\" isolate-form>" + dateTmpl + timeTmpl + "</ng-form>";
            return tmpl;
          },
          controller: ['$scope', '$attrs',
            function ($scope, $attrs) {
              $scope.date_change = function () {
                // If we changed the date only, set the time (h,m) on it.
                // This is important in case the previous date was null.
                // This solves the issue when the user set a date and time, cleared the date, and chose another date,
                // and then, the time was cleared too - which is unexpected
                var time = $scope.time;
                if ($scope.ngModel && $scope.time) { // if ngModel is null, that's because the user cleared the date field
                  $scope.ngModel.setHours(time.getHours(), time.getMinutes(), 0, 0);
                }
              };
              $scope.time_change = function () {
                if ($scope.ngModel && $scope.time) {
                  // convert from ISO format to Date
                  if (!($scope.ngModel instanceof Date)) $scope.ngModel = new Date($scope.ngModel);
                  $scope.ngModel.setHours($scope.time.getHours(), $scope.time.getMinutes(), 0, 0);
                }  // else the time is invalid, keep the current Date value in datepicker
              };
              $scope.open = function ($event) {
                $event.preventDefault();
                $event.stopPropagation();
                $scope.innerDateOpened = true;
              };
              $attrs.$observe('dateFormat', function(newDateFormat, oldValue) {
                $scope.dateFormat = newDateFormat;
              });
              $scope.dateOptions = angular.isDefined($scope.dateOptions) ? $scope.dateOptions : {};
              $scope.dateOptions.dateDisabled = $scope.dateDisabled;
            }
          ],
          link: function (scope, element, attrs, ctrl) {
            var firstTimeAssign = true;

            scope.$watch(function () {
              return scope.ngModel;
            }, function (newTime) {
              var timeElement = element[0].querySelector('[name=timepicker]');

              // if a time element is focused, updating its model will cause hours/minutes to be formatted by padding with leading zeros
              if (timeElement && !timeElement.contains(document.activeElement)) {

                if (newTime === null || newTime === '') { // if the newTime is not defined
                  if (firstTimeAssign) { // if it's the first time we assign the time value
                    // create a new default time where the hours, minutes, seconds and milliseconds are set to 0.
                    newTime = new Date();
                    newTime.setHours(0, 0, 0, 0);
                  } else { // clear the time
                    scope.time = null;
                    if (scope.ngChange) scope.$eval(scope.ngChange);
                    return;
                  }
                }
                // Update timepicker (watch on ng-model in timepicker does not use object equality),
                // also if the ngModel was not a Date, convert it to date
                newTime = new Date(newTime);

                if (isNaN(newTime.getTime()) === false) {
                  scope.time = newTime; // change the time in timepicker
                  if (firstTimeAssign) {
                    firstTimeAssign = false;
                  }
                  else if (scope.ngChange) {
                    scope.$eval(scope.ngChange);
                  }
                }
              }
            }, true);

            scope.$watch(function () {
              return scope.datetimepickerForm && scope.datetimepickerForm.$error;
            }, function (errors) {
              if (angular.isUndefined(errors)) {
                return;
              }
              Object.keys(ctrl.$error).forEach(function (error) {
                ctrl.$setValidity(error, true);
              });
              Object.keys(errors).forEach(function (error) {
                ctrl.$setValidity(error, false);
              });
            }, true);

            scope.$watch(function () {
              return scope.datetimepickerForm && (scope.datetimepickerForm.timepicker.$touched || scope.datetimepickerForm.datepicker.$touched);
            }, function (touched) {
              if (touched) {
                ctrl.$setTouched();
              }
            });

            scope.$watch(function () {
              return scope.datetimepickerForm && scope.datetimepickerForm.$dirty;
            }, function (dirty) {
              if (dirty) {
                ctrl.$setDirty();
              }
            });

            scope.$watch('dateOpened', function (value) {
              scope.innerDateOpened = value;
            });
            scope.$watch('innerDateOpened', function (value) {
              if (angular.isDefined(scope.dateOpened)) {
                scope.dateOpened = value;
              }
            });
          }
        }
      }
    ]).directive('isolateForm', [function () {
      return {
        restrict: 'A',
        require: '?form',
        link: function (scope, elm, attrs, ctrl) {
          if (!ctrl) {
            return;
          }
          // Do a copy of the controller
          var ctrlCopy = {};
          angular.copy(ctrl, ctrlCopy);

          // Get the parent of the form
          var parent = elm.parent().controller('form');
          if (!parent) {
            return;
          }
          // Remove parent link to the controller
          parent.$removeControl(ctrl);

          // Replace form controller with an "isolated form"
          var isolatedFormCtrl = {
            $setValidity: function (validationToken, isValid, control) {
              ctrlCopy.$setValidity(validationToken, isValid, control);
              parent.$setValidity(validationToken, true, ctrl);
            }
          };
          angular.extend(ctrl, isolatedFormCtrl);
        }
      };
    }]);
