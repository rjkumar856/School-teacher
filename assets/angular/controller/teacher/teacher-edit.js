(function() {
    'use strict';
    angular
        .module('schoolApp')
        .filter('propsFilter', propsFilter)
        .controller('TeacherDetails', TeacherDetails)
        .directive('fileUpload',fileUpload)
        .directive("tabClick",tabClick)
        .factory('TeacherService', TeacherService)
        .factory('DetailsService', DetailsService);
        
        function propsFilter() {
            return filter;
            function filter(items, props) {
                var out = [];
                if (angular.isArray(items)) {
                  items.forEach(function(item) {
                    var itemMatches = false;
                    var keys = Object.keys(props);
                    for (var i = 0; i < keys.length; i++) {
                      var prop = keys[i];
                      var text = props[prop].toLowerCase();
                      if (item[prop].toString().toLowerCase().indexOf(text) !== -1) {
                        itemMatches = true;
                        break;
                      }
                    }
                    if (itemMatches) {
                        out.push(item);
                    }
                  });
                }else {
                  out = items;
                }
                return out;
            };
        }
        angular.module('schoolApp').requires.push('ui.select');
        TeacherDetails.$inject = ['$scope', '$http', '$filter','TeacherService','$mdDateLocale','DetailsService','$modalStack','$element'];
        function TeacherDetails($scope, $http, $filter,TeacherService,$mdDateLocale,DetailsService,$modalStack,$element) {
            var vm = $scope;
            vm.TeacherService = TeacherService;
            vm.DetailsService = DetailsService;
            vm.teacher_edit = {};
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.AjaxRequestCodeDelete = '';
            vm.AjaxRequestStatusDelete = '';
   
            vm.today = new Date();
            vm.deleteTeacherPhoto = deleteTeacherPhoto;
            vm.UpdateTeacherSubmission = UpdateTeacherSubmission;
            vm.AddTeacherDocFormSubmission = AddTeacherDocFormSubmission;
            vm.getStates = getStates;
            vm.getCities = getCities;
            vm.getStatesForStdEdit = getStatesForStdEdit;
            vm.getCitiesForStdEdit = getCitiesForStdEdit;

            vm.form = {};
            vm.form.states = [];
            vm.form.cities = [];
            vm.form.relation = ['Father','Mother','Others'];
            vm.form.teacher_class_list = DetailsService.teacher_class_list;
            vm.teacher_edit.teacher_class_id = angular.copy(vm.DetailsService.edit_teacher_details.teacher_class_id);
            vm.teacher_edit.customs = {};
            vm.teacher_edit = angular.copy(vm.DetailsService.edit_teacher_details);
            vm.assigned_teacher_doc_list = angular.copy(DetailsService.assigned_teacher_doc_list);
            vm.SetUpdateDocumentID = SetUpdateDocumentID;
            vm.SetUpdateDocumentIDCancel = SetUpdateDocumentIDCancel;
            vm.EditTeacherDocFormSubmission = EditTeacherDocFormSubmission;
            vm.AjaxRequestStatusEdit = '';
            vm.AjaxRequestCodeEdit = '';
            vm.SetTeacherDocumentStatusApproved = SetTeacherDocumentStatusApproved;
            vm.SetTeacherDocumentStatusDisapproved = SetTeacherDocumentStatusDisapproved;
            vm.SetDeleteDocumentID = SetDeleteDocumentID;
            vm.deleteDocumentIDCancel = deleteDocumentIDCancel;
            vm.deleteDocumentID = deleteDocumentID;
            vm.set_delete_document_id = '';
            
            function deleteTeacherPhoto(){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestCode = '';
                        vm.AjaxRequestStatus = '';
                            TeacherService.DeleteTeacherPhoto({'id':vm.teacher_edit.id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatus = resp.message;
                                vm.AjaxRequestCode = resp.code;
                                if(resp.code == '200'){
                                vm.teacher_edit.photo = '';
                                vm.DetailsService.edit_teacher_details.photo = '';
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
                        vm.AjaxRequestCode = '213';
                        console.log(err);
                    }
            }
            
            function UpdateTeacherSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.EditTeacherForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.teacherPhoto;
                        var dob = new Date(vm.teacher_edit.dob);
                        vm.teacher_edit.dob = $filter('date')(dob,'yyyy-MM-dd');
                        var doj = new Date(vm.teacher_edit.doj);
                        vm.teacher_edit.doj = $filter('date')(doj,'yyyy-MM-dd');
                        if(vm.teacher_edit.teacher_class_id && Array.isArray(vm.teacher_edit.teacher_class_id)){
                            var temp_class_id = '';
                            angular.forEach(vm.teacher_edit.teacher_class_id,function(value){
                                if(temp_class_id != ''){
                                    temp_class_id += ','+value.id;
                                }else{
                                    temp_class_id += value.id;
                                }
                            });
                            if(temp_class_id){
                                vm.teacher_edit.class_id = temp_class_id;
                            }
                        }
                        TeacherService.UpdateTeacher(vm.teacher_edit,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                if(resp.items){
                                    vm.teacher_edit = resp.items;
                                    vm.DetailsService.edit_teacher_details = resp.items;
                                }
                                vm.EditTeacherForm.$setPristine();
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
            
            var AddTeacherDocForm_org = angular.copy(vm.document_add);
            function AddTeacherDocFormSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.AddTeacherDocForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.teacherDocument;
                        vm.document_add.teacher_id = vm.teacher_edit.id;
                        vm.document_add.status = "Approved";
                        TeacherService.AddTeacherDocument(vm.document_add,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                if(resp.items){
                                    vm.DetailsService.assigned_teacher_doc_list.unshift({'id':resp.items.id,'doc_name':resp.items.doc_name,'url':resp.items.url,'status':resp.items.status})
                                }
                                    vm.document_add = angular.copy(AddTeacherDocForm_org);
                                    vm.AddTeacherDocForm.$setPristine();
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
            
            function EditTeacherDocFormSubmission(){
                vm.AjaxRequestStatusEdit = '';
                vm.AjaxRequestCodeEdit = '';
                if(vm.EditTeacherDocForm.$valid){
                    try{
                        if(vm.document_edit.id){
                        vm.isLoadingEdit = true;
                        vm.document_edit.teacher_id = vm.teacher_edit.id;
                        TeacherService.UpdateTeacherDocs(vm.document_edit).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            
                            if(resp.code == '200'){
                                if(resp.items){
                                    angular.forEach(vm.DetailsService.assigned_teacher_doc_list,function(value,key){
                                        if(value.id == vm.document_edit.id){
                                            vm.DetailsService.assigned_teacher_doc_list[key]['doc_name'] = angular.copy(vm.document_edit.doc_name);
                                            return true;
                                        }
                                    });
                                }
                                $('#UpdateTeacherDocsModal').modal('hide');
                            }
                        },function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = "Error Occured";
                            vm.AjaxRequestCodeEdit = "211";
                            console.log(resp);
                        });
                    }else{
                        vm.isLoadingEdit = false;
                        vm.AjaxRequestStatusEdit = "Select valid Item from List";
                        vm.AjaxRequestCodeEdit = "212";
                    }
                    }catch(err){
                        vm.isLoadingEdit = false;
                        vm.AjaxRequestStatusEdit = '';
                        vm.AjaxRequestCodeEdit = '';
                        console.log(err);
                    }
                vm.formValidation = false;
                }
                return true;
            }
            
            function SetDeleteDocumentID(id){
                if(id){
                    vm.set_delete_document_id = id;
                }else{
                    vm.AjaxRequestCodeDelete = '205';
                    vm.AjaxRequestStatusDelete = 'Select a Valid Document!';
                }
            }
            
            function deleteDocumentIDCancel(){
                vm.set_delete_document_id = '';
            }
            
            function deleteDocumentID(){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(vm.set_delete_document_id != ''){
                            TeacherService.DeleteDocumentID({'id':vm.set_delete_document_id}).then(function (resp) {
                                vm.isLoading = false;
                                if(resp.message){
                                    vm.AjaxRequestStatusDelete = resp.message;
                                    vm.AjaxRequestCodeDelete = resp.code;
                                }else{
                                    throw "API Error";
                                }
                                
                                if(resp.code == '200'){
                                angular.forEach(vm.DetailsService.assigned_teacher_doc_list,function(itm,index){
                                    if(itm.id === vm.set_delete_document_id){
                                        vm.DetailsService.assigned_teacher_doc_list.splice(index,1);
                                        vm.set_delete_document_id = '';
                                        return true;
                                    }
                                })
                                }
                            },function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = "Error Occured";
                                vm.AjaxRequestCodeDelete = "211";
                                console.log(resp);
                            });
                        }else{
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = 'Select a Valid Item from List';
                            vm.AjaxRequestCodeDelete = '212';
                        }
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatusDelete = 'Error Occured';
                        vm.AjaxRequestCodeDelete = '213';
                        console.log(err);
                    }
            }
            
            function SetUpdateDocumentID(id){
                angular.forEach(vm.DetailsService.assigned_teacher_doc_list,function(value,key){
                    if(value.id == id){
                        vm.document_edit = angular.copy(vm.DetailsService.assigned_teacher_doc_list[key]);
                        return true;
                    }else{
                        return false;
                    }
                });
            }
            
            function SetUpdateDocumentIDCancel(){
                vm.document_edit = {};
            }

            function SetTeacherDocumentStatusApproved(id){
                try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(id){
                            TeacherService.UpdateDocumentStatusApproved({'id':id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.DetailsService.assigned_teacher_doc_list,function(itm,index){
                                    if(itm.id == id){
                                        vm.DetailsService.assigned_teacher_doc_list[index]['status'] = resp.items.status;
                                        return true;
                                    }
                                })
                                }
                            },function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = "Error Occured";
                                vm.AjaxRequestCodeDelete = "211";
                                console.log(resp);
                            });
                        }else{
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = 'Select a Valid Item from List';
                            vm.AjaxRequestCodeDelete = '212';
                        }
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatusDelete = 'Error Occured';
                        vm.AjaxRequestCodeDelete = '213';
                        console.log(err);
                    }
            }
            
            function SetTeacherDocumentStatusDisapproved(id){
                try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(id){
                            TeacherService.UpdateDocumentStatusDisapproved({'id':id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.DetailsService.assigned_teacher_doc_list,function(itm,index){
                                    if(itm.id == id){
                                        vm.DetailsService.assigned_teacher_doc_list[index]['status'] = resp.items.status;
                                        return true;
                                    }
                                })
                                }
                            },function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = "Error Occured";
                                vm.AjaxRequestCodeDelete = "211";
                                console.log(resp);
                            });
                        }else{
                            vm.isLoading = false;
                            vm.AjaxRequestStatusDelete = 'Select a Valid Item from List';
                            vm.AjaxRequestCodeDelete = '212';
                        }
                    }catch(err){
                        vm.isLoading = false;
                        vm.AjaxRequestStatusDelete = 'Error Occured';
                        vm.AjaxRequestCodeDelete = '213';
                        console.log(err);
                    }
            }
            
            function getStatesForStdEdit(){
                try{
                    TeacherService.getStates(vm.teacher_edit.country_id).then(function (resp) {
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCitiesForStdEdit(){
                try{
                    TeacherService.getCities(vm.teacher_edit.state_id).then(function (resp) {
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getStates(){
                try{
                    TeacherService.getStates(vm.teacher_edit.country_id).then(function (resp) {
                        vm.isLoading = false;
                        vm.teacher_edit.state_id = '';
                        vm.teacher_edit.city_id = '';
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCities(){
                try{
                    TeacherService.getCities(vm.teacher_edit.state_id).then(function (resp) {
                        vm.isLoading = false;
                        vm.teacher_edit.city_id = '';
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
    }
        
    function TeacherService($http,$rootScope) {
        var dataObj = {
            getStates : getStates,
            getCities : getCities,
            UpdateTeacherStatus : UpdateTeacherStatus,
            DeleteTeacherDetails : DeleteTeacherDetails,
            getTeacherList : getTeacherList,
            getParentsList : getParentsList,
            AddTeacherDocument : AddTeacherDocument,
            UpdateTeacher : UpdateTeacher,
            UpdateTeacherDocs : UpdateTeacherDocs,
            UpdateDocumentStatusApproved : UpdateDocumentStatusApproved,
            UpdateDocumentStatusDisapproved : UpdateDocumentStatusDisapproved,
            DeleteDocumentID : DeleteDocumentID,
            DeleteTeacherPhoto : DeleteTeacherPhoto,
        };
        
        function UpdateTeacher(data,file) {
            var file_data = new FormData();
            file_data.append('file', file);
            angular.forEach(data, function(value, key) {
                if(angular.isObject(value) && key == 'customs'){
                    angular.forEach(value, function(valueSub, keySub) {
                    file_data.append('customs['+keySub+']', valueSub);
                    });
                }else{
                    file_data.append(key, value);
                }
            });
            return $http({
                method: "POST",
                url: 'api/update-teacher',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateTeacherDocs(data) {
            return $http({
                method: "POST",
                url: 'api/update-teacher-document',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateDocumentStatusApproved(data) {
            return $http({
                method: "POST",
                url: 'api/update-teacher-document-status-approved',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateDocumentStatusDisapproved(data) {
            return $http({
                method: "POST",
                url: 'api/update-teacher-document-status-disapproved',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function AddTeacherDocument(data,file) {
            var file_data = new FormData();
            file_data.append('file', file);
            angular.forEach(data, function(value, key) {
              file_data.append(key, value);
            });
            return $http({
                method: "POST",
                url: 'api/add-teacher-document',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function getParentFromSibiling(data) {
            return $http({
                method: "POST",
                url: 'api/get-parent-from-teacher',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
    
    function getTeacherList(data) {
        return $http({
            method: "POST",
            url: 'api/get_all_teacher',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function getParentsList(data) {
        return $http({
            method: "POST",
            url: 'api/get_parents_list',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function getParentsListByID(data) {
        return $http({
            method: "POST",
            url: 'api/get_parents_details',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function DeleteAssignedID(data) {
        return $http({
            method: "POST",
            url: 'api/delete_asssigned_id',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function DeleteDocumentID(data) {
        return $http({
            method: "POST",
            url: 'api/delete_teacher_document',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function DeleteTeacherPhoto(data) {
        return $http({
            method: "POST",
            url: 'api/delete_teacher_photo',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
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
      
      function UpdateTeacherStatus(Teacher_id,status) {
        return $http({
            method: "POST",
            url: 'api/update_teacher_status',
            data: { "Teacher_id": Teacher_id, "status":status }
            }).then(function (response) {
            return response.data;
        }, function(response) {
            console.log(response);   
        });
      }
      
      function DeleteTeacherDetails(id){
          return $http({
            method: "POST",
            url: 'api/delete_teacher',
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
                scope.formValidation = false;
                scope.$apply(function () {
                    scope.tabs = attrs.tabClick;
                });
            });
        }
    }
    }
    
    function fileUpload($parse){
         return {
            require:'ngModel',
            restrict: 'A',
            link: function(scope, element, attrs,ngModel) {
                var model = $parse(attrs.fileUpload);
                var modelSetter = model.assign;
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                        ngModel.$setViewValue(element.val());
                        ngModel.$render();
                    });
                });
            }
        };
    }
    
})();
