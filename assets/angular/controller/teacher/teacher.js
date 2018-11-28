(function() {
    'use strict';
    angular.module('schoolApp').requires.push('xeditable');
    angular
        .module('schoolApp')
        .controller('TeacherDetails', TeacherDetails).factory('TeacherService', TeacherService);
        
        TeacherDetails.$inject = ['$rootScope','$scope', '$http', '$filter','TeacherService','editableOptions','editableThemes'];
        function TeacherDetails($rootScope,$scope, $http, $filter,TeacherService,editableOptions,editableThemes){
            editableOptions.theme = 'bs3';
            editableOptions.icon_set = 'font-awesome';
            editableThemes.bs3.inputClass = 'form-control-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableThemes.bs3.submitTpl='<button type="submit" class="btn btn-primary" ng-click="getStatusVal($data,user.id)"><span></span></button>';
            
            var base_url = $rootScope.base_api_url;
            var vm = $scope;
            vm.TeacherService = TeacherService;
            vm.rowCollectionStudet = [];
            vm.getTeacherList = getTeacherList;
            vm.getTeacherPagination = getTeacherPagination;
            vm.getTeachersBySearch = getTeachersBySearch;
            vm.selectPage = selectPage;
            vm.Teacher_details = {};
            vm.teacher_search = {};
            vm.currentPage = 0;
            vm.totalPost = 0;
            vm.numberOfPages = 1;
            vm.paginationPages = [];
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
            
            vm.deleteTeacher = deleteTeacher;
            vm.SetDeleteTeacherID = SetDeleteTeacherID;
            vm.deleteTeacherCancel = deleteTeacherCancel;
            vm.DeleteID = '';
            vm.rowsPerPage = [1,10,20,25,50,75,100,150,200,500];
            
            vm.statuses = [
              {value: 'Active', text: 'Active'},
              {value: 'Deactive', text: 'Deactive'},
              {value: 'Terminated', text: 'Terminated'},
              {value: 'Suspended', text: 'Suspended'}
            ];
            vm.showStatus = showStatus;
            vm.getStatusVal = getStatusVal;
            //pagination
            if(!vm.itemsByPage || vm.itemsByPage < 1 || vm.itemsByPage > 100){
                vm.itemsByPage = parseInt(vm.rowsPerPage[2]);
            }
            
            getTeacherPagination();
            getTeacherList();
            
            function getStatusVal(data,teacher_id) {
                try{
                    TeacherService.UpdateTeacherStatus(teacher_id,data).then(function (resp) {
                        vm.isLoading = false;
                        console.log(resp);
                      },function (resp) {
                          vm.isLoading = false;
                          console.log(resp);
                        }.bind());
                  }catch(err){
                      console.log(err);
                      vm.isLoading = false;
                }
            };
        
            function showStatus(Teacher) {
              var selected = [];
              if(Teacher && Teacher.status) {
                selected = $filter('filter')(vm.statuses, {value: Teacher.status});
              }
              return selected.length ? selected[0].text : 'Not set';
            };
          
          //scope --> table state  (--> view)
        vm.$watch('itemsByPage', function (newValue, oldValue) {
          if (newValue !== oldValue) {
            vm.itemsByPage = newValue;
            vm.currentPage = 0;
            getTeacherPagination();
            getTeacherList();
          }
        });

        function getTeachersBySearch(){
                vm.currentPage = 0;
                vm.isFilterApplied = true;
                getTeacherList();
                getTeacherPagination();
      };
      
      //getTeacherList();
      function getTeacherList(){
        vm.isLoading = true;
        vm.teacher_search["page"] = vm.currentPage + 1;
        vm.teacher_search["limit"] = vm.itemsByPage;
        TeacherService.getTeacherList(vm.teacher_search).then(function (resp) {
            try{
                vm.rowCollectionStudet = resp.items;
            }catch(err){
                vm.rowCollectionStudet = [];
            }
            vm.isLoading = false;
          }.bind());
      };
      
      function selectPage(page){
          vm.currentPage = page;
          getTeacherList();
      };
      
      function getTeacherPagination(){
        vm.teacher_search["page"] = vm.currentPage + 1;
        vm.teacher_search["limit"] = vm.itemsByPage;
        TeacherService.getTeacherPagination(vm.teacher_search).then(function (resp) {
            try{
                if(resp.items.Pages){
                vm.totalPost = resp.items.Pages;
                vm.numberOfPages = Math.ceil(vm.totalPost / vm.itemsByPage);
                vm.paginationPages = [];
                  for (var i = 1; i <= vm.numberOfPages; i++) {
                    vm.paginationPages.push(i);
                  }
                }
            }catch(err){
                vm.totalPost = 0;
                vm.paginationPages = [];
            }
          }.bind());
      };
      
      function SetDeleteTeacherID(id){
          vm.DeleteID = id;
      }
      function deleteTeacherCancel(){
          vm.DeleteID = '';
      }
      
      function deleteTeacher(){
          try{
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
          if(vm.DeleteID !== ''){
              vm.isLoading = true;
              TeacherService.DeleteTeacherDetails(vm.DeleteID).then(function (resp) {
                    vm.isLoading = false;
                    vm.AjaxRequestStatusDelete = resp.message;
                    vm.AjaxRequestCodeDelete = resp.code;
                    if(resp.code == '200'){
                    angular.forEach(vm.rowCollectionStudet,function(itm,index){
                        if(itm.id === vm.DeleteID){
                            vm.rowCollectionStudet.splice(index,1);
                            return true;
                        }
                    })
                    }
                vm.DeleteID = '';
                },function (resp) {
                    vm.isLoading = false;
                    vm.AjaxRequestStatusDelete = "Error Occured";
                    vm.AjaxRequestCodeDelete = "211";
                    console.log(resp);
                });
          }else{
              alert("Select a Valid Teacher");
          }
      }catch(err){
        vm.isLoading = false;
        vm.AjaxRequestStatusDelete = 'Error Occured';
        vm.AjaxRequestCodeDelete = '241';
        console.log(err);
    }
    }
      
    }
        
    function TeacherService($http,$rootScope) {
        var dataObj = {
            getTeacherList: getTeacherList,
            getTeacherPagination: getTeacherPagination,
            UpdateTeacherStatus:UpdateTeacherStatus,
            DeleteTeacherDetails : DeleteTeacherDetails
        };
        
      function getTeacherList(data) {
        return $http({
            method: "POST",
            url: 'api/get_teacher_list',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function getTeacherPagination(data) {
          return $http({
            method: "POST",
            url: 'api/get_teacher_pagination',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function UpdateTeacherStatus(teacher_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_status',
            data: { "id": teacher_id, "status":status }
            }).then(function (response) {
                console.log(response);
                return response.data;
        });
      }
      
      function DeleteTeacherDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_teacher',
            data: {"id":id},
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
    return dataObj;
    }
})();