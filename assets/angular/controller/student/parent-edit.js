(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('StudentDetails', StudentDetails)
        .factory('ParentService',ParentService)
        .factory('StudentService', StudentService);
        
        StudentDetails.$inject = ['$rootScope','$scope', '$http', '$filter','StudentService','ParentService'];
        function StudentDetails($rootScope,$scope, $http, $filter,StudentService,ParentService) {
            var base_url = $rootScope.base_api_url;
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.ParentService = ParentService;
            vm.parent_edit = ParentService.edit_parent_details;
            vm.rowCollectionStudet = [];
            vm.Student_details = {};
            vm.parent_search = {};
            vm.currentPage = 0;
            vm.totalPost = 0;
            vm.numberOfPages = 1;
            vm.paginationPages = [];
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.form = {};
            vm.form.relation = ['Father','Mother','Others'];
            vm.EditParentFormSubmission = EditParentFormSubmission;
            vm.getStatesForStdEdit = getStatesForStdEdit;
            vm.getCitiesForStdEdit = getCitiesForStdEdit;
            
            vm.deleteStudent = deleteStudent;
            vm.SetDeleteStudentID = SetDeleteStudentID;
            vm.deleteStudentCancel = deleteStudentCancel;
            vm.DeleteID = '';
            
            function EditParentFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.EditParentForm.$valid){
                    try{
                        vm.isLoading = true;
                        var dob = new Date(vm.parent_edit.dob);
                        vm.parent_edit.dob = $filter('date')(dob,'yyyy-MM-dd');
                        StudentService.UpdateParent(vm.parent_edit).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                            vm.EditParentForm.$setPristine();
                            vm.getAssignedParentList();
                            }
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = "Error Occured";
                            vm.AjaxRequestCode = "211";
                            console.log(resp);
                        });
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        console.log(err);
                    }
                vm.formValidation = false;
                }
                return false;
            }
        
            function getStatesForStdEdit(){
                try{
                    StudentService.getStates(vm.parent_edit.country_id).then(function (resp) {
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCitiesForStdEdit(){
                try{
                    StudentService.getCities(vm.parent_edit.state_id).then(function (resp) {
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.cities = [];
                    console.log(err);
                }
            }

      
      function SetDeleteStudentID(id){
          vm.DeleteID = id;
      }
      function deleteStudentCancel(){
          vm.DeleteID = '';
      }
      
      function deleteStudent(id){
          if(id !== ''){
              vm.isLoading = true;
              StudentService.DeleteStudentDetails(id).then(function (resp) {
                    vm.DeleteID = '';
                    vm.isLoading = false;
                    getParentPagination();
                    getParentList();
                }.bind());
          }else{
              alert("Select a Valid Student");
          }
      }
    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            DeleteStudentDetails : DeleteStudentDetails,
            UpdateParent : UpdateParent,
            getStates: getStates,
            getCities: getCities,
        };
        
    function UpdateParent(data) {
            return $http({
                method: "POST",
                url: 'api/update-parent',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
        
     function getStates(data) {
        return $http({
            method: "POST",
            url: 'api/get_states_by_country',
            data: {'country_id':data},
            }).then(function (response) {
                console.log(response);
                return response.data;
        });
      }
      
      function getCities(data) {
          return $http({
            method: "POST",
            url: 'api/get_cities_by_state',
            data: {"state_id":data},
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function DeleteStudentDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_student',
            data: {"id":id},
            }).then(function (response) {
                return response.data;
        });
      }
      
    return dataObj;
    }
})();