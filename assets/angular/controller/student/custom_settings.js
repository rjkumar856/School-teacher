(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('StudentDetails', StudentDetails)
        .directive("tabClick",tabClick)
        .factory('CustomService',CustomService)
        .factory('StudentService', StudentService)

        StudentDetails.$inject = ['$scope', '$http', '$filter','StudentService','CustomService'];
        function StudentDetails($scope, $http, $filter,StudentService,CustomService) {
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.CustomService = CustomService;
            vm.custom_settings = CustomService.custom_settings;
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.CustomSettingFormSubmission = CustomSettingFormSubmission;
            vm.AddStudentCustomFieldFormSubmission = AddStudentCustomFieldFormSubmission;
            vm.custom_field = {};
            vm.form = {};
            vm.form.types = ['Text','Textarea'];
            vm.form.requires = ['True','False'];
            
            vm.SetDeleteFieldID = SetDeleteFieldID;
            vm.deleteCustomFieldsIDCancel = deleteCustomFieldsIDCancel;
            vm.deleteCustomFieldsID = deleteCustomFieldsID;
            vm.deleteStudentField_id = '';
            vm.AjaxRequestCodeDelete = '';
            vm.AjaxRequestStatusDelete = '';
            vm.EditStudentCustomFieldFormSubmission = EditStudentCustomFieldFormSubmission;
            vm.custom_field_edit = {};
            vm.SetEditFieldID = SetEditFieldID;
            vm.SetEditFieldIDCancel = SetEditFieldIDCancel;
            vm.editStudentField_id = '';
            vm.AjaxRequestCodeEdit = '';
            vm.AjaxRequestStatusEdit = '';
            vm.isLoadingEdit = false;
            vm.AddStudentCategoryFormSubmission = AddStudentCategoryFormSubmission;
            vm.Category = {};
            vm.SetEditCategoryID = SetEditCategoryID;
            vm.SetEditCategoryIDCancel = SetEditCategoryIDCancel;
            vm.editStudentCategory_id = '';
            vm.SetDeleteCategoryID = SetDeleteCategoryID;
            vm.EditStudentCategoryFormSubmission = EditStudentCategoryFormSubmission;
            vm.deleteCustomCategoryIDCancel = deleteCustomCategoryIDCancel;
            vm.deleteStudentCategoryID = deleteStudentCategoryID;
            vm.deleteStudentCategory_id = '';
            
            function SetEditFieldID(id){
                if(id && !isNaN(id)){
                    angular.forEach(vm.CustomService.custom_fields_list,function(itm,index){
                        if(itm.id == id){
                            vm.custom_field_edit = vm.CustomService.custom_fields_list[index];
                        }
                    });
                }else{
                    alert("Select a Valid Field");
                }
              }
              function SetEditFieldIDCancel(){
                vm.custom_field_edit = {};
              }
              
              function EditStudentCustomFieldFormSubmission(){
                  try{
                  vm.AjaxRequestStatusEdit = '';
                  vm.AjaxRequestCodeEdit = '';
                  if(vm.EditStudentCustomFieldForm.$valid){
                        vm.isLoadingEdit = true;
                        StudentService.UpdateCustomFields(vm.custom_field_edit).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            if(resp.code == '200'){
                                angular.forEach(vm.CustomService.custom_fields_list,function(itm,index){
                                    if(itm.id == vm.custom_field_edit.id){
                                       vm.CustomService.custom_fields_list[index] = vm.custom_field_edit;
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
            
            function SetDeleteFieldID(id){
                if(id && !isNaN(id)){
                    vm.deleteStudentField_id = id;
                }else{
                    alert("Select a Valid Field");
                }
              }
              function deleteCustomFieldsIDCancel(){
                  vm.deleteStudentField_id = '';
              }
              
              function deleteCustomFieldsID(){
                  try{
                    vm.AjaxRequestStatusDelete = '';
                    vm.AjaxRequestCodeDelete = '';
                    if(vm.deleteStudentField_id !== ''){
                      vm.isLoading = true;
                      StudentService.DeleteCustomFields(vm.deleteStudentField_id).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = resp.message;
                            vm.AjaxRequestCodeDelete = resp.code;
                            if(resp.code == '200'){
                            angular.forEach(vm.CustomService.custom_fields_list,function(itm,index){
                                if(itm.id === vm.deleteStudentField_id){
                                    vm.CustomService.custom_fields_list.splice(index,1);
                                    return true;
                                }
                            });
                            }
                        vm.deleteStudentField_id = '';
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = "Error Occured";
                            vm.AjaxRequestCodeDelete = "211";
                            console.log(resp);
                        });
                  }else{
                      alert("Select a Valid Field");
                  }
              }catch(err){
                vm.isLoading = false;
                vm.AjaxRequestStatusDelete = 'Error Occured';
                vm.AjaxRequestCodeDelete = '241';
                console.log(err);
            }
            }
            
            function AddStudentCustomFieldFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddStudentCustomFieldForm.$valid){
                    try{
                        vm.isLoading = true;
                        StudentService.AddCustomFields(vm.custom_field).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                vm.CustomService.custom_fields_list.push({'id': resp.items.id,'name':resp.items.name,'title':resp.items.title,
                                    'type':resp.items.type,'used_for':'Student','required':resp.items.required,'status':resp.items.status});
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
            
            function AddStudentCategoryFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddStudentCategoryForm.$valid){
                    try{
                        vm.isLoading = true;
                        StudentService.AddStudentCategory(vm.student_category).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                vm.CustomService.category_list.push({'id': resp.items.id,'name':resp.items.name,'status':resp.items.status});
                                vm.student_category = {};
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
            
            function SetEditCategoryID(id){
                if(id && !isNaN(id)){
                    angular.forEach(vm.CustomService.category_list,function(itm,index){
                        if(itm.id == id){
                            vm.edit_category = vm.CustomService.category_list[index];
                        }
                    });
                }else{
                    alert("Select a Valid Category");
                }
              }
              function SetEditCategoryIDCancel(){
                vm.edit_category = {};
              }
            
            function EditStudentCategoryFormSubmission(){
                  try{
                  vm.AjaxRequestStatusEdit = '';
                  vm.AjaxRequestCodeEdit = '';
                  if(vm.EditStudentCategoryForm.$valid){
                        vm.isLoadingEdit = true;
                        StudentService.UpdateStudentCategory(vm.edit_category).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            if(resp.code == '200'){
                                angular.forEach(vm.CustomService.category_list,function(itm,index){
                                    if(itm.id == vm.custom_field_edit.id){
                                       vm.CustomService.category_list[index] = vm.custom_field_edit;
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
              
             function SetDeleteCategoryID(id){
                 if(id && !isNaN(id)){
                    vm.deleteStudentCategory_id = id;
                }else{
                    alert("Select a Valid Category");
                }
                
              }
              function deleteCustomCategoryIDCancel(){
                  vm.deleteStudentCategory_id = '';
              }
              
             function deleteStudentCategoryID(){
                  try{
                    vm.AjaxRequestStatusDelete = '';
                    vm.AjaxRequestCodeDelete = '';
                    if(vm.deleteStudentCategory_id !== ''){
                      vm.isLoading = true;
                      StudentService.DeleteStudentCategory(vm.deleteStudentCategory_id).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = resp.message;
                            vm.AjaxRequestCodeDelete = resp.code;
                            if(resp.code == '200'){
                            angular.forEach(vm.CustomService.category_list,function(itm,index){
                                if(itm.id === vm.deleteStudentCategory_id){
                                    vm.CustomService.category_list.splice(index,1);
                                    return true;
                                }
                            });
                            }
                        vm.deleteStudentCategory_id = '';
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = "Error Occured";
                            vm.AjaxRequestCodeDelete = "211";
                            console.log(resp);
                        });
                  }else{
                      alert("Select a Valid Category");
                  }
              }catch(err){
                vm.isLoading = false;
                vm.AjaxRequestStatusDelete = 'Error Occured';
                vm.AjaxRequestCodeDelete = '241';
                console.log(err);
            }
            }
            
            function CustomSettingFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.CustomSettingForm.$valid){
                    try{
                        vm.isLoading = true;
                        StudentService.UpdateCustomSetting(vm.custom_settings).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
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

    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            UpdateCustomSetting:UpdateCustomSetting,
            AddCustomFields : AddCustomFields,
            UpdateCustomFields : UpdateCustomFields,
            DeleteCustomFields : DeleteCustomFields,
            AddStudentCategory : AddStudentCategory,
            UpdateStudentCategory: UpdateStudentCategory,
            DeleteStudentCategory : DeleteStudentCategory,
        };
        
    function UpdateCustomSetting(data) {
        return $http({
            method: "POST",
            url: 'api/update_student_custom_settings',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function AddCustomFields(data) {
        return $http({
            method: "POST",
            url: 'api/add_student_custom_fields',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function UpdateCustomFields(data) {
        return $http({
            method: "POST",
            url: 'api/update_student_custom_fields',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function DeleteCustomFields(id){
          return $http({
            method: "POST",
            url: 'api/delete_student_custom_fields',
            data: {"id":id},
            }).then(function (response) {
                return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function AddStudentCategory(data) {
        return $http({
            method: "POST",
            url: 'api/add_student_category',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function UpdateStudentCategory(data) {
        return $http({
            method: "POST",
            url: 'api/update_student_category',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
     
     function DeleteStudentCategory(id) {
        return $http({
            method: "POST",
            url: 'api/delete_student_category',
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
    
    function tabClick(){
        return {
        restrict: 'A',
        controller: 'StudentDetails',
        link: function postLink(scope, elem, attrs, ctrl) {
            elem.on('click', function (evt) {
                scope.formValidation = false;
                scope.$apply(function () {
                    scope.tabs = attrs.tabClick;
                });
            });
        }
    }
    }
    
})();
