angular.module('scavengerApp')
  .controller('clueCtrl', ['$scope', '$rootScope', '$state', '$http', 'ListService', function($scope, $rootScope, $state, $http, ListService) {

    var list = ListService;
    $scope.loaded = false;

    $rootScope.clueList = {};

    list.http({fn: "getEntities", entityName: "Clue"},
      function (response) {
          list.setList(response);
          $scope.loaded = true;
          //console.log(response);
          $rootScope.clueList = list.getList();
      },
      function(response){
        console.log(response);
      });

    $scope.clueCtrlFormData = {id : "-1", name: "", value : "", fromNumber : "", storyid : "-1"};

    $scope.clueCtrlFormData.submit = function(item, event) {
      var navstoryid = -1;
      if (typeof $scope.nav !== "undefined")
      {
        navstoryid = $scope.nav.storyid;
      }
      var data = {fn: "aeclue", id : $scope.clueCtrlFormData.id, name: $scope.clueCtrlFormData.name, value : $scope.clueCtrlFormData.value, fromNumber : $scope.clueCtrlFormData.fromNumber, storyid : $scope.clueCtrlFormData.storyid}
      list.http(data,
        function(response) {

        try {
          if (data.id == -1)
          {
            //add new element to the map
            var itemLabel = response.id + '-' + data.name;
            map.add({group: "nodes", data: {id: 'c' + response.id, label: itemLabel, item: response.id, weight: 5}, position: {x: 200, y: 100}});
            addQTip('c' + response.id, itemLabel, 'c');
          }
          else
          {
            map.$('#c' + response.id).style("content", response.id + '-' + data.name);
          }
        } catch (err) {
          //console.log(err);
        }

        data.id = response.id;
        $scope.clueList[data.id] = data;
        list.setList($scope.clueList);
      },
      function(response) {
        console.log(response);
      });
      $scope.clueCtrlFormData.reset();
    }

     $scope.clueCtrlFormData.reset = function() {
      $scope.clueCtrlFormData.id = -1;
      $scope.clueCtrlFormData.name = "";
      $scope.clueCtrlFormData.value = "";
      $scope.clueCtrlFormData.fromNumber = "";  
      $scope.clueCtrlFormData.storyid = -1;  
     }

     $scope.clueCtrlFormData.editItem = function(item) {
      $scope.clueCtrlFormData.id = item.id;
      $scope.clueCtrlFormData.name = item.name;
      $scope.clueCtrlFormData.value = item.value;
      $scope.clueCtrlFormData.fromNumber = item.fromNumber;
      $scope.clueCtrlFormData.storyid = item.storyid;
     }

    $scope.clueCtrlFormData.deleteItem = function(item) {
      var data = {fn: 'deleteEntity', id : item.id, entityName: "Clue"};

      list.http(data,
        function(response) {
        delete $scope.clueList[item.id];
        list.setList($scope.clueList);
      },
      function(response) {
        console.log(response);
      });
      $scope.clueCtrlFormData.reset();
    };

    $scope.clueCtrlFormData.changeState = function(stateName, item) {
      $state.go(stateName, {"clueid": item.id, "clue": item});
    };
}]).filter('orderObjectBy', function(){
 return function(input, attribute) {
    if (!angular.isObject(input)) return input;

    var array = [];
    for(var objectKey in input) {
        array.push(input[objectKey]);
    }

    array.sort(function(a, b){
        a = parseInt(a[attribute]);
        b = parseInt(b[attribute]);
        return a - b;
    });
    return array;
 }
});

