(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('StudentDetails', StudentDetails).factory('StudentService', StudentService);
        
        StudentDetails.$inject = ['$rootScope','$scope', '$http', '$filter','StudentService'];
        function StudentDetails($rootScope,$scope, $http, $filter,StudentService) {
            var base_url = $rootScope.base_api_url;
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.rowCollectionStudet = [];
            vm.getParentList = getParentList;
            vm.getParentPagination = getParentPagination;
            vm.getParentsBySearch = getParentsBySearch;
            vm.selectPage = selectPage;
            vm.Student_details = {};
            vm.parent_search = {};
            vm.currentPage = 0;
            vm.totalPost = 0;
            vm.numberOfPages = 1;
            vm.paginationPages = [];
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
            
            vm.deleteParent = deleteParent;
            vm.SetDeleteParentID = SetDeleteParentID;
            vm.deleteParentCancel = deleteParentCancel;
            vm.DeleteID = '';
            vm.rowsPerPage = [1,10,20,25,50,75,100,150,200,500];
            
            vm.statuses = [
              {value: 'Y', text: 'Active'},
              {value: 'N', text: 'Deactive'}
            ];
            vm.showStatus = showStatus;
            vm.getStatusVal = getStatusVal;
            //pagination
            if(!vm.itemsByPage || vm.itemsByPage < 1 || vm.itemsByPage > 100){
                vm.itemsByPage = parseInt(vm.rowsPerPage[2]);
            }
            
            getParentPagination();
            getParentList();
            
            function getStatusVal(data,Student_id) {
                StudentService.UpdateStudentStatus(Student_id,data).then(function (resp) {
                    vm.isLoading = false;
                }.bind());
            };
        
            function showStatus(Student) {
              var selected = [];
              if(Student && Student.status) {
                selected = $filter('filter')(vm.statuses, {value: Student.status});
              }
              return selected.length ? selected[0].text : 'Not set';
            };
          
          //scope --> table state  (--> view)
        vm.$watch('itemsByPage', function (newValue, oldValue) {
          if (newValue !== oldValue) {
            vm.itemsByPage = newValue;
            vm.currentPage = 0;
            getParentPagination();
            getParentList();
          }
        });

        function getParentsBySearch(){
                vm.currentPage = 0;
                vm.isFilterApplied = true;
                getParentList();
                getParentPagination();
      };
      
      //getParentList();
      function getParentList(){
        try{
            vm.isLoading = true;
            vm.parent_search["page"] = vm.currentPage + 1;
            vm.parent_search["limit"] = vm.itemsByPage;
            StudentService.getParentList(vm.parent_search).then(function (resp) {
                vm.rowCollectionStudet = resp.items;
                vm.isLoading = false;
              },function (resp) {
                    vm.rowCollectionStudet = [];
                    console.log(resp);
                }.bind());
          }catch(err){
            vm.rowCollectionStudet = [];
        }
      };
      
      function selectPage(page){
          vm.currentPage = page;
          getParentList();
      };
      
      function getParentPagination(){
          try{
            vm.parent_search["page"] = vm.currentPage + 1;
            vm.parent_search["limit"] = vm.itemsByPage;
            StudentService.getParentPagination(vm.parent_search).then(function (resp) {
                    if(resp.items.Pages){
                    vm.totalPost = resp.items.Pages;
                    vm.numberOfPages = Math.ceil(vm.totalPost / vm.itemsByPage);
                    vm.paginationPages = [];
                      for (var i = 1; i <= vm.numberOfPages; i++) {
                        vm.paginationPages.push(i);
                      }
                    }
              },function (resp) {
                    vm.totalPost = 0;
                    vm.paginationPages = [];
                    console.log(resp);
                }.bind());
          }catch(err){
            vm.totalPost = 0;
            vm.paginationPages = [];
        }
      };
      
      function SetDeleteParentID(id){
          vm.DeleteID = id;
      }
      function deleteParentCancel(){
          vm.DeleteID = '';
      }
      
      function deleteParent(){
         try{
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
          if(vm.DeleteID !== ''){
              vm.isLoading = true;
              StudentService.DeleteParentDetails(vm.DeleteID).then(function (resp) {
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
              alert("Select a Valid Parent");
          }
      }catch(err){
        vm.isLoading = false;
        vm.AjaxRequestStatusDelete = 'Error Occured';
        vm.AjaxRequestCodeDelete = '241';
        console.log(err);
    }
    }
    
    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            getParentList: getParentList,
            getParentPagination: getParentPagination,
            UpdateStudentStatus:UpdateStudentStatus,
            DeleteParentDetails : DeleteParentDetails
        };
        
      function getParentList(data) {
        return $http({
            method: "POST",
            url: 'api/get_parents_list',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        });
      }
      
      function getParentPagination(data) {
          return $http({
            method: "POST",
            url: 'api/get_parent_pagination',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        });
      }
      
      function UpdateStudentStatus(Student_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_student_status',
            data: { "Student_id": Student_id, "status":status }
            }).then(function (response) {
            return response.data;
        });
      }
      
      function DeleteParentDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_parent',
            data: {"id":id},
            }).then(function (response) {
                return response.data;
        });
      }
      
    return dataObj;
    }
})();