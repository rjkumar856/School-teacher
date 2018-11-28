(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('TeacherDetails', TeacherDetails)
        .directive("tabClick",tabClick)
        .factory('StudentService', StudentService);
        
        TeacherDetails.$inject = ['$rootScope','$scope', '$http', '$filter','StudentService'];
        function TeacherDetails($rootScope,$scope, $http, $filter,StudentService) {
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
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            
            vm.deleteStudent = deleteStudent;
            vm.SetDeleteStudentID = SetDeleteStudentID;
            vm.deleteStudentCancel = deleteStudentCancel;
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
        vm.student_search["page"] = vm.currentPage;
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
        vm.student_search["page"] = vm.currentPage;
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
      
      function deleteStudent(id){
          if(id !== ''){
              vm.isLoading = true;
              StudentService.DeleteTeacherDetails(id).then(function (resp) {
                    vm.DeleteID = '';
                    vm.isLoading = false;
                    getStudentPagination();
                    getStudentList();
                }.bind());
          }else{
              alert("Select a Valid Student");
          }
      }
    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            getStudentList: getStudentList,
            getStudentPagination: getStudentPagination,
            UpdateStudentStatus:UpdateStudentStatus,
            DeleteTeacherDetails : DeleteTeacherDetails
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
      
      function UpdateStudentStatus(Student_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_student_status',
            data: { "Student_id": Student_id, "status":status }
            }).then(function (response) {
            return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function DeleteTeacherDetails(id){
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
    
    
    function tabClick(){
        return {
        restrict: 'A',
        controller: 'TeacherDetails',
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