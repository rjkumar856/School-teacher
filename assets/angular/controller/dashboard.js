(function() {
    'use strict';
    schoolApp
    .factory('dash_board', dash_board)
    .controller('Dashboard', Dashboard)
    .directive("tabClick",tabClick);

        Dashboard.$inject = ['$rootScope','$scope', '$http', '$filter','$element','dash_board' ];
        
        function Dashboard($rootScope,$scope, $http, $filter,$element, dash_board) {
            var vm = $scope;
            vm.dash_board = dash_board;
            vm.tabSelect = tabSelect;
            vm.getStatusVal = getStatusVal;
            vm.events = [];
            vm.tabs = "today";
            
            function tabSelect(tab) {
                vm.tabs = tab;
            };
    }
        
    function dash_board($http,$rootScope) {
        var dataObj = {
            rowCollectionPage: [],
            getUserList: getUserList
        };
        
      function getUserList(currentPage,itemsByPage) {
        return $http({
            method: "POST",
            url: $rootScope.base_api_url+'api/get_user',
            data: { "page": currentPage, "limit":itemsByPage }
            }).then(function (response) {
            dataObj.rowCollectionPage = response.data.items;
            return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
    return dataObj;
    }
    
    function tabClick(){
        return {
        restrict: 'A',
        controller: 'Dashboard',
        link: function postLink(scope, elem, attrs, ctrl) {
            elem.on('click', function (evt) {
                scope.$apply(function () {
                    scope.tabs = attrs.tabClick;
                });
            });
        }
      }
    }
    
    
    
    
})();
