(function() {
    'use strict';
    angular
        .module('schoolApp')
        .controller('TeacherDetails', TeacherDetails)
        .directive("tabClick",tabClick)
        .factory('CustomService',CustomService)
        .factory('TeacherService', TeacherService)

        TeacherDetails.$inject = ['$scope', '$http', '$filter','TeacherService','CustomService']; 
        function TeacherDetails($scope, $http, $filter,TeacherService,CustomService) {
            var vm = $scope;
            vm.TeacherService = TeacherService;
            vm.CustomService = CustomService;
            vm.custom_settings = CustomService.custom_settings;
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.CustomSettingFormSubmission = CustomSettingFormSubmission;
            vm.AddTeacherCustomFieldFormSubmission = AddTeacherCustomFieldFormSubmission;
            vm.custom_field = {};
            vm.form = {};
            vm.form.types = ['Text','Textarea'];
            vm.form.requires = ['True','False'];
            
            vm.SetDeleteFieldID = SetDeleteFieldID;
            vm.deleteCustomFieldsIDCancel = deleteCustomFieldsIDCancel;
            vm.deleteCustomFieldsID = deleteCustomFieldsID;
            vm.deleteTeacherField_id = '';
            vm.AjaxRequestCodeDelete = '';
            vm.AjaxRequestStatusDelete = '';
            vm.EditTeacherCustomFieldFormSubmission = EditTeacherCustomFieldFormSubmission;
            vm.custom_field_edit = {};
            vm.SetEditFieldID = SetEditFieldID;
            vm.SetEditFieldIDCancel = SetEditFieldIDCancel;
            vm.editTeacherField_id = '';
            vm.AjaxRequestCodeEdit = '';
            vm.AjaxRequestStatusEdit = '';
            vm.isLoadingEdit = false;
            vm.AddTeacherCategoryFormSubmission = AddTeacherCategoryFormSubmission;
            vm.Category = {};
            vm.SetEditCategoryID = SetEditCategoryID;
            vm.SetEditCategoryIDCancel = SetEditCategoryIDCancel;
            vm.editTeacherCategory_id = '';
            vm.SetDeleteCategoryID = SetDeleteCategoryID;
            vm.EditTeacherCategoryFormSubmission = EditTeacherCategoryFormSubmission;
            vm.deleteCustomCategoryIDCancel = deleteCustomCategoryIDCancel;
            vm.deleteTeacherCategoryID = deleteTeacherCategoryID;
            vm.deleteTeacherCategory_id = '';
            
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
              
              function EditTeacherCustomFieldFormSubmission(){
                  try{
                  vm.AjaxRequestStatusEdit = '';
                  vm.AjaxRequestCodeEdit = '';
                  if(vm.EditTeacherCustomFieldForm.$valid){
                        vm.isLoadingEdit = true;
                        TeacherService.UpdateCustomFields(vm.custom_field_edit).then(function (resp) {
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
                    vm.deleteTeacherField_id = id;
                }else{
                    alert("Select a Valid Field");
                }
              }
              function deleteCustomFieldsIDCancel(){
                  vm.deleteTeacherField_id = '';
              }
              
              function deleteCustomFieldsID(){
                  try{
                    vm.AjaxRequestStatusDelete = '';
                    vm.AjaxRequestCodeDelete = '';
                    if(vm.deleteTeacherField_id !== ''){
                      vm.isLoading = true;
                      TeacherService.DeleteCustomFields(vm.deleteTeacherField_id).then(function (resp) {
                            vm.isLoading = false;
                            if(resp.message){
                            vm.AjaxRequestStatusDelete = resp.message;
                            vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.CustomService.custom_fields_list,function(itm,index){
                                    if(itm.id === vm.deleteTeacherField_id){
                                        vm.CustomService.custom_fields_list.splice(index,1);
                                        return true;
                                    }
                                });
                                }
                            }
                        vm.deleteTeacherField_id = '';
                        },function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = "Error Occured";
                            vm.AjaxRequestCodeDelete = "211";
                            console.log(resp);
                        });
                  }else{
                    vm.isLoading = false;
                    vm.AjaxRequestStatusDelete = "Select a Valid Field";
                    vm.AjaxRequestCodeDelete = "212";
                  }
              }catch(err){
                vm.isLoading = false;
                vm.AjaxRequestStatusDelete = 'Error Occured';
                vm.AjaxRequestCodeDelete = '241';
                console.log(err);
            }
            }
            
            function AddTeacherCustomFieldFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddTeacherCustomFieldForm.$valid){
                    try{
                        vm.isLoading = true;
                        TeacherService.AddCustomFields(vm.custom_field).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                vm.CustomService.custom_fields_list.push({'id': resp.items.id,'name':resp.items.name,'title':resp.items.title,
                                    'type':resp.items.type,'used_for':'Teacher','required':resp.items.required,'status':resp.items.status});
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
            
            function AddTeacherCategoryFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddTeacherCategoryForm.$valid){
                    try{
                        vm.isLoading = true;
                        TeacherService.AddTeacherCategory(vm.teacher_category).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                vm.CustomService.category_list.push({'id': resp.items.id,'name':resp.items.name,'status':resp.items.status});
                                vm.teacher_category = {};
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
            
            function EditTeacherCategoryFormSubmission(){
                  try{
                  vm.AjaxRequestStatusEdit = '';
                  vm.AjaxRequestCodeEdit = '';
                  if(vm.EditTeacherCategoryForm.$valid){
                        vm.isLoadingEdit = true;
                        TeacherService.UpdateTeacherCategory(vm.edit_category).then(function (resp) {
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
                    vm.deleteTeacherCategory_id = id;
                }else{
                    alert("Select a Valid Category");
                }
                
              }
              function deleteCustomCategoryIDCancel(){
                  vm.deleteTeacherCategory_id = '';
              }
              
             function deleteTeacherCategoryID(){
                  try{
                    vm.AjaxRequestStatusDelete = '';
                    vm.AjaxRequestCodeDelete = '';
                    if(vm.deleteTeacherCategory_id !== ''){
                      vm.isLoading = true;
                      TeacherService.DeleteTeacherCategory(vm.deleteTeacherCategory_id).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = resp.message;
                            vm.AjaxRequestCodeDelete = resp.code;
                            if(resp.code == '200'){
                            angular.forEach(vm.CustomService.category_list,function(itm,index){
                                if(itm.id === vm.deleteTeacherCategory_id){
                                    vm.CustomService.category_list.splice(index,1);
                                    return true;
                                }
                            });
                            }
                        vm.deleteTeacherCategory_id = '';
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
                        TeacherService.UpdateCustomSetting(vm.custom_settings).then(function (resp) {
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
        
    function TeacherService($http,$rootScope) {
        var dataObj = {
            UpdateCustomSetting:UpdateCustomSetting,
            AddCustomFields : AddCustomFields,
            UpdateCustomFields : UpdateCustomFields,
            DeleteCustomFields : DeleteCustomFields,
            AddTeacherCategory : AddTeacherCategory,
            UpdateTeacherCategory: UpdateTeacherCategory,
            DeleteTeacherCategory : DeleteTeacherCategory,
        };
        
    function UpdateCustomSetting(data) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_custom_settings',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function AddCustomFields(data) {
        return $http({
            method: "POST",
            url: 'api/add_teacher_custom_fields',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function UpdateCustomFields(data) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_custom_fields',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function DeleteCustomFields(id){
          return $http({
            method: "POST",
            url: 'api/delete_teacher_custom_fields',
            data: {"id":id},
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function AddTeacherCategory(data) {
        return $http({
            method: "POST",
            url: 'api/add_teacher_category',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
      
      function UpdateTeacherCategory(data) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_category',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
            return response;
        });
      }
     
     function DeleteTeacherCategory(id) {
        return $http({
            method: "POST",
            url: 'api/delete_teacher_category',
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
    
    function tabClick(){
        return {
        restrict: 'A',
        controller: 'TeacherDetails',
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
