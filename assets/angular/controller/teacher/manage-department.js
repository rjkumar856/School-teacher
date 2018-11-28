(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('TeacherDetails', TeacherDetails)
        .factory('DepartmentList', DepartmentList)
        .factory('TeacherService', TeacherService)

        TeacherDetails.$inject = ['$scope', '$http', '$filter','TeacherService','DepartmentList']; 
        function TeacherDetails($scope, $http, $filter,TeacherService,DepartmentList) {
            var vm = $scope;
            vm.TeacherService = TeacherService;
            vm.DepartmentList = DepartmentList;
            vm.department_list = DepartmentList.department_list;
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.AddDepartmentFormSubmission = AddDepartmentFormSubmission;
            vm.form = {};
            vm.form.statuses = ['Active','Deactive'];
            
            vm.deleteTeacherField_id = '';
            vm.AjaxRequestCodeDelete = '';
            vm.AjaxRequestStatusDelete = '';
            vm.edit_department = {};
            vm.AjaxRequestCodeEdit = '';
            vm.AjaxRequestStatusEdit = '';
            vm.isLoadingEdit = false;

            vm.Department = {};
            vm.SetEditDepartmentID = SetEditDepartmentID;
            vm.SetEditDepartmentIDCancel = SetEditDepartmentIDCancel;
            vm.editTeacherDepartment_id = '';
            vm.SetDeleteDepartmentID = SetDeleteDepartmentID;
            vm.EditTeacherDepartmentFormSubmission = EditTeacherDepartmentFormSubmission;
            vm.deleteCustomDepartmentIDCancel = deleteCustomDepartmentIDCancel;
            vm.deleteTeacherDepartmentID = deleteTeacherDepartmentID;
            vm.deleteTeacherDepartment_id = '';
            
            function AddDepartmentFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddDepartmentForm.$valid){
                    try{
                        vm.isLoading = true;
                        TeacherService.AddDepartment(vm.custom_field).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                vm.DepartmentList.department_list.push({'id': resp.items.id,'name':resp.items.name,'code':resp.items.code,'status':resp.items.status});
                                vm.custom_field = {};
                            }
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = "Error Occured";
                            vm.AjaxRequestCode = "211";
                            console.log(resp);
                        });
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatus = 'Error Occured';
                        vm.AjaxRequestCode = '212';
                        console.log(err);
                    }
                vm.formValidation = false;
                }
                return false;
            }
            
            function SetEditDepartmentID(id){
                if(id && !isNaN(id)){
                    angular.forEach(vm.DepartmentList.department_list,function(itm,index){
                        if(itm.id == id){
                            vm.edit_department = vm.DepartmentList.department_list[index];
                        }
                    });
                }else{
                    alert("Select a Valid Department");
                }
              }
              function SetEditDepartmentIDCancel(){
                vm.edit_department = {};
              }
            
            function EditTeacherDepartmentFormSubmission(){
                  try{
                  vm.AjaxRequestStatusEdit = '';
                  vm.AjaxRequestCodeEdit = '';
                  if(vm.EditTeacherDepartmentForm.$valid){
                        vm.isLoadingEdit = true;
                        TeacherService.UpdateDepartment(vm.edit_department).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            if(resp.code == '200'){
                                angular.forEach(vm.DepartmentList.department_list,function(itm,index){
                                    if(itm.id == vm.custom_field_edit.id){
                                       vm.DepartmentList.department_list[index] = vm.custom_field_edit;
                                    }
                                });
                            }
                        },function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = "Error Occured";
                            vm.AjaxRequestCodeEdit = "211";
                            console.log(resp);
                        });
                }
                }catch(err){
                    vm.isLoadingEdit = false;
                    vm.AjaxRequestStatusEdit = 'Error Occured';
                    vm.AjaxRequestCodeEdit = '212';
                    console.log(err);
                }
                return false;
              }
              
             function SetDeleteDepartmentID(id){
                 if(id && !isNaN(id)){
                    vm.deleteTeacherDepartment_id = id;
                }else{
                    alert("Select a Valid Department");
                }
                
              }
              function deleteCustomDepartmentIDCancel(){
                  vm.deleteTeacherDepartment_id = '';
              }
              
             function deleteTeacherDepartmentID(){
                  try{
                    vm.AjaxRequestStatusDelete = '';
                    vm.AjaxRequestCodeDelete = '';
                    if(vm.deleteTeacherDepartment_id !== ''){
                      vm.isLoading = true;
                      TeacherService.DeleteDepartment(vm.deleteTeacherDepartment_id).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = resp.message;
                            vm.AjaxRequestCodeDelete = resp.code;
                            if(resp.code == '200'){
                            angular.forEach(vm.DepartmentList.department_list,function(itm,index){
                                if(itm.id === vm.deleteTeacherDepartment_id){
                                    vm.DepartmentList.department_list.splice(index,1);
                                    return true;
                                }
                            });
                            }
                        vm.deleteTeacherDepartment_id = '';
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = "Error Occured";
                            vm.AjaxRequestCodeDelete = "211";
                            console.log(resp);
                        });
                  }else{
                      alert("Select a Valid Department");
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
            AddDepartment : AddDepartment,
            UpdateDepartment : UpdateDepartment,
            DeleteDepartment : DeleteDepartment,
        };
      
      function AddDepartment(data) {
        return $http({
            method: "POST",
            url: 'api/add_teacher_department',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function UpdateDepartment(data) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_department',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
     
     function DeleteDepartment(id) {
        return $http({
            method: "POST",
            url: 'api/delete_teacher_department',
            data: {"id":id},
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
    return dataObj;
    }
})();
