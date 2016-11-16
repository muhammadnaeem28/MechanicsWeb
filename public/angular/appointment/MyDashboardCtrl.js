var app = angular.module('formApp')

app.directive('innerHtmlBind', function() {
  return {
    restrict: 'A',
    scope: {
      inner_html: '=innerHtml'
    },
    link: function(scope, element, attrs) {
      scope.inner_html = element.html();
    }
  }
})
app.controller('ModalInstanceCtrl', function($scope, $uibModalInstance) {
  $scope.carMileage = {
    'totalmileage':"",
    'dailymileage':""
  }

  $scope.ok = function() {
    $uibModalInstance.close($scope.carMileage);
  };

  $scope.cancel = function() {
    $uibModalInstance.dismiss('cancel');
  };
})
app.controller('DashboardCtrl', function($scope,$window,Auth,$rootScope,$state,$uibModal,userCarList,carsBrands,apiService) {
  console.log("DashboardCtrl")
  console.log(Auth.getUser())
  $scope.carData = []
  $scope.carsBrandsList = []
  $scope.carsYearList = []
  $scope.carsModelList = []
  $scope.carsTrimList = []
  $scope.selectedTrim = "- Select Trim -"
  $scope.carsBrandsList = carsBrands
  $scope.showMileageModal = true
  //$scope.ActiveUser = JSON.parse($window.localStorage.getItem("userInfo"));
  //$scope.ActiveUser = $rootScope.user
  console.log("ActiveUser : ",$scope.ActiveUser)
  console.log("userCarList : ", userCarList)
  $scope.userCarList = []
  $scope.selectedCar = []
  $scope.userCarList = userCarList.cars
  $scope.showCarInfo = function(data){
    $scope.selectedCar = data

    $scope.selectedCar.total_mileage = parseInt(data.total_mileage)
    $scope.selectedCar.daiL_mileage = parseInt(data.daiL_mileage)
    $state.go('dashboard.carinfo')
  }
  $scope.saveCarInfo = function(data){
    console.log("saveCarInfo : ",data )
    obj = {
      "car_id": data.car_id,
      "user_id": data.user_id,
      "total_mileage": data.total_mileage,
      "daiL_mileage": data.daiL_mileage,
    }
    console.log(obj)
    apiService.UpdateUserCarMileage(obj).then(function(res){
      console.log(res)
    },function(err){
      console.log(err)
    })
  }
  $scope.selectMake = function(data){
    $scope.carData = [];
    obj = {};
    obj['type'] = "make";
    obj['data'] = data;
    obj['value'] = data.name;
    $scope.carData.push(obj)
    $scope.carsYearList = []
    $scope.carsModelList = []
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"

    apiService.getVehicleYears(data.id).then(function (res){
      console.log(res);
      if (res) {
        $scope.carsYearList = res;
      }
    },function(err){
      console.log(err)
    })
  }
  $scope.selectYear = function(data){
    $scope.carData.splice(1, 3);
    var obj = {};
    obj.type = "year";
    obj.data = data;
    obj.value = data.name;
    $scope.carData.push(obj)
    $scope.carsModelList = []
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"

    apiService.getVehicleModels($scope.carData[0].data.id, data.id).then(function (res) {
      console.log(res);
      if (res) {
        $scope.carsModelList = res;
      }
    },function(err){
      console.log(err)
    })
  }
  $scope.selectModel = function(data){
    $scope.carData.splice(2, 2);
    var obj = {};
    obj['type'] = "model";
    obj['data'] = data
    obj['value'] = data.name
    $scope.carData.push(obj)
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"
    $scope.carsTrimList = data.trim;
  }
  $scope.selectTrim = function(data){
    $scope.carData.splice(3, 1);
    var obj = {};
    obj['type'] = "trim";
    obj['value'] = data
    $scope.carData.push(obj)
    console.log($scope.carData)

  }
  $scope.addCar = function(){
    obj = {}
    if($scope.carData.length >= 3){
      obj.cb_id = $scope.carData[0].data.id
      obj.cy_id = $scope.carData[1].data.id
      obj.cm_id = $scope.carData[2].data.id
      obj.user_id = 31
      apiService.SetUserCarAdd(obj).then(function (res) {
        console.log(res);
        open()
        userObj = {
          'user_id': "31"
        }
        apiService.getUserCarList(obj).then(function (res) {
          console.log(res)
          $scope.carsBrandsList = res
        },function(err){
          console.log(err)
        })
      },function(err){
        console.log(err)
      })
    }

    console.log("addCar :" ,$scope.carData.length)

  }

  function open(){
    var modalInstance = $uibModal.open({
      templateUrl: 'templates/mileageModal.html',
      controller: 'ModalInstanceCtrl'
    });
    modalInstance.result.then(function(data) {
      console.log('Modal', data)
    }, function() {
      console.log('Modal dismissed at: ' + new Date())
    });
  }


})

app.controller('DashboardMyCtrl', function($scope,Auth,$window,$rootScope,$state,$uibModal,carsBrands,apiService) {
  console.log("DashboardMyCtrl")
  console.log(Auth.getUser())
  $scope.ActiveUser = Auth.getUser()
  if(!$scope.ActiveUser){
    window.location = "http://filddy.com/auth/login"
  }
  $scope.carData = []
  $scope.carsBrandsList = []
  $scope.carsYearList = []
  $scope.carsModelList = []
  $scope.carsTrimList = []
  $scope.selectedTrim = "- Select Trim -"
  $scope.carsBrandsList = carsBrands
  $scope.ActiveUser_id = $scope.ActiveUser.user_id
  $scope.userCarList = []
  obj = {
    'user_id': $scope.ActiveUser.user_id
  }
  apiService.getUserCarList(obj).then(function(res){
    $scope.userCarList = res.cars
  },function(err){
    console.log(err)
  })
  $scope.showCarInfo = function(data){
    obj = data
    obj.total_mileage = parseInt(data.total_mileage)
    obj.daiL_mileage = parseInt(data.daiL_mileage)
    $state.go('dashboard.carinfo',{"carObj":JSON.stringify(obj)})
  }
  $scope.selectMake = function(data) {
    $scope.carData = [];
    $scope.carsYearList = []
    $scope.carsModelList = []
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"
    if (data) {
      obj = {};
      obj['type'] = "make";
      obj['data'] = data;
      obj['value'] = data.name;
      $scope.carData.push(obj)
      apiService.getVehicleYears(data.id).then(function (res) {
        console.log(res);
        if (res) {
          $scope.carsYearList = res;
        }
      }, function (err) {
        console.log(err)
      })
    }
  }
  $scope.selectYear = function(data){
    $scope.carData.splice(1, 3);
    $scope.carsModelList = []
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"
    if(data) {
      var obj = {};
      obj.type = "year";
      obj.data = data;
      obj.value = data.name;
      $scope.carData.push(obj)
      apiService.getVehicleModels($scope.carData[0].data.id, data.id).then(function (res) {
        console.log(res);
        if (res) {
          $scope.carsModelList = res;
        }
      }, function (err) {
        console.log(err)
      })
    }
  }
  $scope.selectModel = function(data){
    $scope.carData.splice(2, 2);
    $scope.carsTrimList = []
    $scope.selectedTrim = "- Select Trim -"
    if(data){
      var obj = {};
      obj['type'] = "model";
      obj['data'] = data
      obj['value'] = data.name
      $scope.carData.push(obj)
      $scope.carsTrimList = data.trim;
    }
  }
  $scope.selectTrim = function(data){
    $scope.carData.splice(3, 1);
    if(data){
      var obj = {};
      obj['type'] = "trim";
      obj['value'] = data
      $scope.carData.push(obj)
    }
    console.log($scope.carData)
  }
  $scope.addCar = function(){
    obj = {}
    if($scope.carData.length >= 3){
      obj.cb_id = $scope.carData[0].data.id
      obj.cy_id = $scope.carData[1].data.id
      obj.cm_id = $scope.carData[2].data.id
      obj.user_id = $scope.ActiveUser_id
      apiService.SetUserCarAdd(obj).then(function (res) {
        console.log(res);
        if(res.code == "200"){
          open(res.car_id)
        }
        //$scope.carsBrandsList = []

        //$state.go($state.current, {}, {reload: true});

      },function(err){
        console.log(err)
      })
    }

    console.log("addCar :" ,$scope.carData.length)

  }

  function open(car_id){
    var modalInstance = $uibModal.open({
      templateUrl: 'templates/mileageModal.html',
      controller: 'ModalInstanceCtrl'
    });
    modalInstance.result.then(function(data) {
      console.log('Modal', data)
      obj = {
        "car_id": car_id,
        "user_id": $scope.ActiveUser_id,
        "total_mileage": data.totalmileage,
        "daiL_mileage": data.dailymileage,
      }
      console.log(obj)
      apiService.UpdateUserCarMileage(obj).then(function(res){
        console.log(res)
        if(res.code == "200"){
          $state.go($state.current, {}, {reload: true});
        }else{
          console.log("mileage not updated ",res)
          $state.go($state.current, {}, {reload: true});
        }
      },function(err){
        console.log(err)
        $state.go($state.current, {}, {reload: true});
      })

    }, function() {
      console.log('Modal dismissed at: ' + new Date())
      $state.go($state.current, {}, {reload: true});
    });
  }


})

