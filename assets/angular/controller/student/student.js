(function() {
    'use strict';
    angular.module('schoolApp').requires.push('xeditable');
    angular
        .module('schoolApp')
        .controller('StudentDetails', StudentDetails).factory('StudentService', StudentService);
        
        StudentDetails.$inject = ['$rootScope','$scope', '$http', '$filter','StudentService','editableOptions','editableThemes'];
        function StudentDetails($rootScope,$scope, $http, $filter,StudentService,editableOptions,editableThemes){
            editableOptions.theme = 'bs3';
            editableOptions.icon_set = 'font-awesome';
            editableThemes.bs3.inputClass = 'form-control-sm';
            editableThemes.bs3.buttonsClass = 'btn-sm';
            editableThemes.bs3.submitTpl='<button type="submit" class="btn btn-primary" ng-click="getStatusVal($data,user.id)"><span></span></button>';
            
            var base_url = $rootScope.base_api_url;
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.rowCollectionStudet = [];
            vm.getStudentList = getStudentList;
            vm.getStudentPagination = getStudentPagination;
            vm.getStudentsBySearch = getStudentsBySearch;
            vm.selectPage = selectPage;
            vm.Student_details = {};
            vm.student_search = {};
            vm.currentPage = 0;
            vm.totalPost = 0;
            vm.numberOfPages = 1;
            vm.paginationPages = [];
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
            
            vm.deleteStudent = deleteStudent;
            vm.SetDeleteStudentID = SetDeleteStudentID;
            vm.deleteStudentCancel = deleteStudentCancel;
            vm.DeleteID = '';
            vm.rowsPerPage = [1,10,20,25,50,75,100,150,200,500];
            
            vm.statuses = [
              {value: 'Active', text: 'Active'},
              {value: 'Deactive', text: 'Deactive'},
              {value: 'Terminated', text: 'Terminated'},
              {value: 'Transfered', text: 'Transfered'}
            ];
            vm.showStatus = showStatus;
            vm.getStatusVal = getStatusVal;
            //pagination
            if(!vm.itemsByPage || vm.itemsByPage < 1 || vm.itemsByPage > 100){
                vm.itemsByPage = parseInt(vm.rowsPerPage[2]);
            }
            
            getStudentPagination();
            getStudentList();
            
            function getStatusVal(data,student_id) {
                try{
                    StudentService.UpdateStudentStatus(student_id,data).then(function (resp) {
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
            getStudentPagination();
            getStudentList();
          }
        });

        function getStudentsBySearch(){
                vm.currentPage = 0;
                vm.isFilterApplied = true;
                getStudentList();
                getStudentPagination();
      };
      
      //getStudentList();
      function getStudentList(){
        vm.isLoading = true;
        vm.student_search["page"] = vm.currentPage + 1;
        vm.student_search["limit"] = vm.itemsByPage;
        StudentService.getStudentList(vm.student_search).then(function (resp) {
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
          getStudentList();
      };
      
      function getStudentPagination(){
        vm.student_search["page"] = vm.currentPage + 1;
        vm.student_search["limit"] = vm.itemsByPage;
        StudentService.getStudentPagination(vm.student_search).then(function (resp) {
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
      
      function SetDeleteStudentID(id){
          vm.DeleteID = id;
      }
      function deleteStudentCancel(){
          vm.DeleteID = '';
      }
      
      function deleteStudent(){
          try{
            vm.AjaxRequestStatusDelete = '';
            vm.AjaxRequestCodeDelete = '';
          if(vm.DeleteID !== ''){
              vm.isLoading = true;
              StudentService.DeleteStudentDetails(vm.DeleteID).then(function (resp) {
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
              alert("Select a Valid Student");
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
            getStudentList: getStudentList,
            getStudentPagination: getStudentPagination,
            UpdateStudentStatus:UpdateStudentStatus,
            DeleteStudentDetails : DeleteStudentDetails
        };
        
      function getStudentList(data) {
        return $http({
            method: "POST",
            url: 'api/get_student',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function getStudentPagination(data) {
          return $http({
            method: "POST",
            url: 'api/get_student_pagination',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function UpdateStudentStatus(student_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_student_status',
            data: { "id": student_id, "status":status }
            }).then(function (response) {
            return response.data;
        });
      }
      
      function DeleteStudentDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_student',
            data: {"id":id},
            }).then(function (response) {
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
    return dataObj;
    }
})();