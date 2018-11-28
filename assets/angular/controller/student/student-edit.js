(function() {
    'use strict';
    angular
        .module('schoolApp')
        .filter('propsFilter', propsFilter)
        .controller('StudentDetails', StudentDetails)
        .directive('fileUpload',fileUpload)
        .directive("tabClick",tabClick)
        .factory('StudentService', StudentService)
        .factory('ParentService', ParentService);
        
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
                  // Let the output be the input untouched
                  out = items;
                }

                return out;
            };
        }
        
        angular.module('schoolApp').requires.push('ui.select');

        StudentDetails.$inject = ['$scope', '$http', '$filter','StudentService','$mdDateLocale','ParentService','$modalStack','$element'];
        function StudentDetails($scope, $http, $filter,StudentService,$mdDateLocale,ParentService,$modalStack,$element) {
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.ParentService = ParentService;
            vm.rowCollectionStudet = [];
            vm.student_edit = {};
            vm.student_edit = ParentService.edit_student_details;
            vm.parent_add = {};
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
   
            vm.today = new Date();
            vm.UpdateStudentSubmission = UpdateStudentSubmission;
            vm.addNewParentSubmission = addNewParentSubmission;
            vm.AddPreviousFormSubmission = AddPreviousFormSubmission;
            vm.AddStudentDocFormSubmission = AddStudentDocFormSubmission;
            vm.EditPreviousFormSubmission = EditPreviousFormSubmission;
            vm.EditStudentDocFormSubmission = EditStudentDocFormSubmission;
            vm.SetStudentDocumentStatusApproved = SetStudentDocumentStatusApproved;
            vm.SetStudentDocumentStatusDisapproved = SetStudentDocumentStatusDisapproved;
            
            vm.getStates = getStates;
            vm.getCities = getCities;
            vm.getPStates = getPStates;
            vm.getPCities = getPCities;
            vm.getStatesForStdEdit = getStatesForStdEdit;
            vm.getCitiesForStdEdit = getCitiesForStdEdit;
            vm.form = {};
            vm.form.states = [];
            vm.form.cities = [];
            vm.form.p_states = [];
            vm.form.p_cities = [];
            vm.form.relation = ['Father','Mother','Others'];
            vm.parent_search = {};
            vm.parent_search.sibiling = {};
            vm.parent_search.sibiling.selected = '';
            vm.parent_search.name = {};
            vm.parent_search.name.selected = '';
            vm.parent_search.email = {};
            vm.parent_search.email.selected = '';
            vm.parent_search.name = {};
            vm.parent_search.name.selected = '';
            vm.isSearchLoading = false;
            vm.parent_assign = {};
            vm.parent_assign.select_all = false;
            vm.AjaxRequestStatusAssign = '';
            vm.AjaxRequestCodeAssign = '';
            
            vm.student_name = [];
            vm.parent_name = [];
            vm.parent_mobile = [];
            vm.parent_email = [];
            vm.search_parent_list = [];
            
            vm.parent_add.country = '';
            vm.parent_add.first_name = '';
            vm.parent_add.last_name = '';
            vm.parent_add.dob = '';
            vm.parent_add.gender = '';
            vm.parent_add.password = 'Welcome@123';
            vm.parent_add.address = '';
            vm.parent_add.state = '';
            vm.parent_add.city = '';
            vm.parent_add.pincode = '';
            vm.parent_add.mobile = '';
            vm.parent_add.email = '';
            vm.AjaxRequestCodeDelete = '';
            vm.AjaxRequestStatusDelete = '';
            vm.set_delete_assigned_id = '';
            vm.SetDeleteAssignedID = SetDeleteAssignedID;
            vm.deleteAssignedIDCancel = deleteAssignedIDCancel;
            vm.deleteAssignedID = deleteAssignedID;
            
            vm.previous_add = {};
            vm.set_delete_previous_id = '';
            vm.SetDeletePreviousID = SetDeletePreviousID;
            vm.deletePreviousIDCancel = deletePreviousIDCancel;
            vm.deletePreviousID = deletePreviousID;
            vm.document_add = {};
            vm.set_delete_document_id = '';
            vm.SetDeleteDocumentID = SetDeleteDocumentID;
            vm.deleteDocumentIDCancel = deleteDocumentIDCancel;
            vm.deleteDocumentID = deleteDocumentID;
            vm.deleteStudentPhoto = deleteStudentPhoto;
            vm.previous_edit = {};
            vm.isLoadingEdit = false;
            vm.AjaxRequestStatusEdit = '';
            vm.AjaxRequestCodeEdit = '';
            vm.SetUpdatePreviousID = SetUpdatePreviousID;
            vm.SetUpdatePreviousIDCancel = SetUpdatePreviousIDCancel;
            vm.document_edit = {};
            vm.SetUpdateDocumentID = SetUpdateDocumentID;
            vm.SetUpdateDocumentIDCancel = SetUpdateDocumentIDCancel;
            
            function SetUpdatePreviousID(id){
                angular.forEach(vm.ParentService.assigned_previous_list,function(value,key){
                    if(value.id == id){
                        vm.previous_edit = angular.copy(vm.ParentService.assigned_previous_list[key]);
                        return true;
                    }
                });
            }
            
            function SetUpdatePreviousIDCancel(){
                vm.previous_edit = {};
            }
            
            function SetUpdateDocumentID(id){
                angular.forEach(vm.ParentService.assigned_student_doc_list,function(value,key){
                    if(value.id == id){
                        vm.document_edit = angular.copy(vm.ParentService.assigned_student_doc_list[key]);
                        return true;
                    }
                });
            }
            
            function SetUpdateDocumentIDCancel(){
                vm.document_edit = {};
            }
            
            function SetDeleteAssignedID(id){
                vm.set_delete_assigned_id = id;
            }
            
            function deleteAssignedIDCancel(){
                vm.set_delete_assigned_id = '';
            }
            
            function deleteStudentPhoto(){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestCode = '';
                        vm.AjaxRequestStatus = '';
                            StudentService.DeleteStudentPhoto({'id':vm.student_edit.student_id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatus = resp.message;
                                vm.AjaxRequestCode = resp.code;
                                if(resp.code == '200'){
                                vm.student_edit.photo = '';
                                vm.ParentService.edit_student_details.photo = '';
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
            
            function deleteAssignedID(){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(vm.set_delete_assigned_id != ''){
                            StudentService.DeleteAssignedID({'id':vm.set_delete_assigned_id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.ParentService.assigned_parent_list,function(itm,index){
                                    if(itm.assingned_id === vm.set_delete_assigned_id){
                                        vm.ParentService.assigned_parent_list.splice(index,1);
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
            
            function SetDeletePreviousID(id){
                vm.set_delete_previous_id = id;
            }
            
            function deletePreviousIDCancel(){
                vm.set_delete_previous_id = '';
            }
            
            function deletePreviousID(){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(vm.set_delete_previous_id != ''){
                            StudentService.DeletePreviousID({'id':vm.set_delete_previous_id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.ParentService.assigned_previous_list,function(itm,index){
                                    if(itm.id === vm.set_delete_previous_id){
                                        vm.ParentService.assigned_previous_list.splice(index,1);
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
            
            function SetDeleteDocumentID(id){
                vm.set_delete_document_id = id;
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
                            StudentService.DeleteDocumentID({'id':vm.set_delete_document_id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.ParentService.assigned_student_doc_list,function(itm,index){
                                    if(itm.id === vm.set_delete_document_id){
                                        vm.ParentService.assigned_student_doc_list.splice(index,1);
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
            
            vm.selecetedSibiling = function() {
                if(typeof(vm.parent_search.sibiling.selected) != 'undefined'){
                    vm.isSearchLoading = true;
                    try{
                    var params = { id: vm.parent_search.sibiling.selected.id };
                    vm.AjaxRequestStatusAssign = '';
                    vm.AjaxRequestCodeAssign = '';
                    return StudentService.getParentFromSibiling(params).then(function (resp) {
                            vm.search_parent_list = resp.items;
                            vm.isSearchLoading = false;
                            vm.parent_assign.select_all = false;
                            vm.AjaxRequestStatusAssign = resp.message;
                            vm.AjaxRequestCodeAssign = resp.code;
                        },function (resp) {
                        vm.search_parent_list = [];
                        vm.isSearchLoading = false;
                        console.log(resp);
                            });
                    }catch(err){
                        vm.search_parent_list = [];
                        vm.isSearchLoading = false;
                        console.log(err);
                    }
                }
            };
            
            vm.selecetedParentName = function() {
                if(typeof(vm.parent_search.name.selected) != 'undefined'){
                    vm.isSearchLoading = false;
                    try{
                    vm.search_parent_list = [];
                    var params = { id: vm.parent_search.name.selected.id };
                    vm.AjaxRequestStatusAssign = '';
                    vm.AjaxRequestCodeAssign = '';
                    vm.search_parent_list.push(vm.parent_search.name.selected);
                    }catch(err){
                        vm.search_parent_list = [];
                        vm.isSearchLoading = false;
                        console.log(err);
                    }
                }
            };
            
            vm.selecetedParentMobile = function() {
                if(typeof(vm.parent_search.mobile.selected) != 'undefined'){
                    vm.isSearchLoading = false;
                    try{
                    vm.AjaxRequestStatusAssign = '';
                    vm.AjaxRequestCodeAssign = '';
                    vm.search_parent_list = [];
                    vm.search_parent_list.push(vm.parent_search.mobile.selected);
                
                    }catch(err){
                        vm.search_parent_list = [];
                        vm.isSearchLoading = false;
                        console.log(err);
                    }
                }
            };
            
            vm.selecetedParentEmail = function() {
                if(typeof(vm.parent_search.email.selected) != 'undefined'){
                    vm.isSearchLoading = false;
                    try{
                    var params = { id: vm.parent_search.email.selected.id };
                    vm.AjaxRequestStatusAssign = '';
                    vm.AjaxRequestCodeAssign = '';
                    vm.search_parent_list = [];
                    vm.search_parent_list.push(vm.parent_search.email.selected);
                    }catch(err){
                        vm.search_parent_list = [];
                        vm.isSearchLoading = false;
                        console.log(err);
                    }
                }
            };
            
            vm.toggleAllParent = function() {
                var toggleStatus = vm.parent_assign.select_all;
                angular.forEach(vm.search_parent_list, function(itm){ itm.selected = toggleStatus; });
            }
            
            vm.optionToggledParent = function(){
                vm.parent_assign.select_all = vm.search_parent_list.every(function(itm){ return itm.selected; });
            }
            
            vm.assignParentsToStudent = function(){
                try{
                if(vm.search_parent_list.length > 0 ){
                    var parent_id = [];
                    angular.forEach(vm.search_parent_list, function(itm){
                        if(itm.selected){ parent_id.push(itm.id);}
                    });
                    
                    if(parent_id.length > 0){
                        return StudentService.assignParent({'student_id':vm.student_edit.student_id,'parent_id':parent_id}).then(function (resp) {
                            vm.search_parent_list = resp.items;
                            vm.isSearchLoading = false;
                            vm.parent_assign.select_all = false;
                            vm.AjaxRequestStatusAssign = resp.message;
                            vm.AjaxRequestCodeAssign = resp.code;
                            if(resp.code == '200'){
                            vm.getAssignedParentList();
                            }
                        },function (resp) {
                            vm.AjaxRequestStatusAssign = "Error Occured";
                            vm.AjaxRequestCodeAssign = "211";
                            console.log(resp);
                        });
                    }else{
                        alert("Pls be Select atleast one Parent1");
                    }
                    console.log(parent_id);
                }
                }catch(err){
                    alert("Pls be Select atleast one Parent2");
                    console.log(err);
                }
            }
            
            vm.refreshSibilings = function(name) {
                try{
                var params = {name: name};
                return StudentService.getStudentList(params).then(function (resp) {
                        vm.student_name = resp.items;
                    });
                }catch(err){
                    vm.student_name = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentName = function(name) {
                try{
                var params = {name: name};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_name = resp.items;
                    });
                }catch(err){
                    vm.parent_name = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentMobile = function(mobile) {
                try{
                var params = {mobile: mobile};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_mobile = resp.items;
                    });
                }catch(err){
                    vm.parent_mobile = [];
                    console.log(err);
                }
            };
            
            vm.refreshParentEmail = function(email) {
                try{
                var params = {email: email};
                return StudentService.getParentsList(params).then(function (resp) {
                        vm.parent_email = resp.items;
                    });
                }catch(err){
                    vm.parent_email = [];
                    console.log(err);
                }
            };
            
            vm.getAssignedParentList = function() {
                try{
                var params = {'id':vm.student_edit.student_id};
                return StudentService.getParentFromSibiling(params).then(function (resp) {
                        vm.ParentService.assigned_parent_list = resp.items;
                    },function (resp) {
                        console.log(resp);
                        });
                }catch(err){
                    console.log(err);
                }
            };
            
            function UpdateStudentSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.EditStudentForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.studentPhoto;
                        var dob = new Date(vm.student_edit.dob);
                        vm.student_edit.dob = $filter('date')(dob,'yyyy-MM-dd');
                        var doj = new Date(vm.student_edit.doj);
                        vm.student_edit.doj = $filter('date')(doj,'yyyy-MM-dd');
                        StudentService.UpdateStudent(vm.student_edit,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                if(resp.items){
                                    vm.student_edit = resp.items;
                                    vm.ParentService.edit_student_details = resp.items;
                                }
                                vm.EditStudentForm.$setPristine();
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
            
            function addNewParentSubmission(){
                vm.formValidation = true;
                if(vm.AddParentForm.$valid){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        StudentService.addNewParent(vm.parent_add).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                            vm.AddParentForm.$setPristine();
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
            
            var AddPreviousForm_Org = angular.copy(vm.previous_add);
            function AddPreviousFormSubmission(){
                vm.formValidation = true;
                if(vm.AddPreviousForm.$valid){
                    try{
                        vm.isLoading = true;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        vm.previous_add.student_id = vm.student_edit.student_id;
                        StudentService.AddPrevious(vm.previous_add).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            
                            if(resp.code == '200'){
                                if(resp.items){
                                    vm.ParentService.assigned_previous_list.unshift({'id':resp.items,'institue_name':vm.previous_add.institue_name,'institue_address':vm.previous_add.institue_address,'course':vm.previous_add.course,'year':vm.previous_add.year,'total_mark':vm.previous_add.total_mark,'reason_for_change':vm.previous_add.reason_for_change})
                                }
                                vm.previous_add = angular.copy(AddPreviousForm_Org);
                                vm.AddPreviousForm.$setPristine();
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
                return true;
            }
            
            function EditPreviousFormSubmission(){
                vm.AjaxRequestStatusEdit = '';
                vm.AjaxRequestCodeEdit = '';
                if(vm.EditPreviousForm.$valid){
                    try{
                        if(vm.previous_edit.id){
                        vm.isLoadingEdit = true;
                        vm.previous_edit.student_id = vm.student_edit.student_id;
                        StudentService.UpdatePrevious(vm.previous_edit).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            
                            if(resp.code == '200'){
                                if(resp.items){
                                    angular.forEach(vm.ParentService.assigned_previous_list,function(value,key){
                                        if(value.id == vm.previous_edit.id){
                                            vm.ParentService.assigned_previous_list[key] = angular.copy(vm.previous_edit);
                                            return true;
                                        }
                                    });
                                }
                                $('#UpdateStudentPreviousModal').modal('hide');
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
            
            var AddStudentDocForm_org = angular.copy(vm.document_add);
            function AddStudentDocFormSubmission(){
                vm.formValidation = true;
                if(vm.AddStudentDocForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.studentDocument;
                        vm.AjaxRequestStatus = '';
                        vm.AjaxRequestCode = '';
                        vm.document_add.student_id = vm.student_edit.student_id;
                        vm.document_add.status = "Approved";
                        StudentService.AddStudentDocument(vm.document_add,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                if(resp.items){
                                vm.ParentService.assigned_student_doc_list.unshift({'id':resp.items.id,'doc_name':resp.items.doc_name,'url':resp.items.url,'status':resp.items.status})
                                }
                                vm.document_add = angular.copy(AddStudentDocForm_org);
                                vm.AddStudentDocForm.$setPristine();
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
            
            function EditStudentDocFormSubmission(){
                vm.AjaxRequestStatusEdit = '';
                vm.AjaxRequestCodeEdit = '';
                if(vm.EditStudentDocForm.$valid){
                    try{
                        if(vm.document_edit.id){
                        vm.isLoadingEdit = true;
                        vm.document_edit.student_id = vm.student_edit.student_id;
                        StudentService.UpdateStudentDocs(vm.document_edit).then(function (resp) {
                            vm.isLoadingEdit = false;
                            vm.AjaxRequestStatusEdit = resp.message;
                            vm.AjaxRequestCodeEdit = resp.code;
                            
                            if(resp.code == '200'){
                                if(resp.items){
                                    angular.forEach(vm.ParentService.assigned_student_doc_list,function(value,key){
                                        if(value.id == vm.document_edit.id){
                                            vm.ParentService.assigned_student_doc_list[key]['doc_name'] = angular.copy(vm.document_edit.doc_name);
                                            return true;
                                        }
                                    });
                                }
                                $('#UpdateStudentDocsModal').modal('hide');
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

            function SetStudentDocumentStatusApproved(id){
                try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(id){
                            StudentService.UpdateDocumentStatusApproved({'id':id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.ParentService.assigned_student_doc_list,function(itm,index){
                                    if(itm.id == id){
                                        vm.ParentService.assigned_student_doc_list[index]['status'] = resp.items.status;
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
            
            function SetStudentDocumentStatusDisapproved(id){
                try{
                        vm.isLoading = true;
                        vm.AjaxRequestCodeDelete = '';
                        vm.AjaxRequestStatusDelete = '';
                        if(id){
                            StudentService.UpdateDocumentStatusDisapproved({'id':id}).then(function (resp) {
                                vm.isLoading = false;
                                vm.AjaxRequestStatusDelete = resp.message;
                                vm.AjaxRequestCodeDelete = resp.code;
                                if(resp.code == '200'){
                                angular.forEach(vm.ParentService.assigned_student_doc_list,function(itm,index){
                                    if(itm.id == id){
                                        vm.ParentService.assigned_student_doc_list[index]['status'] = resp.items.status;
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
                    StudentService.getStates(vm.student_edit.country_id).then(function (resp) {
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCitiesForStdEdit(){
                try{
                    StudentService.getCities(vm.student_edit.state_id).then(function (resp) {
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getStates(){
                try{
                    StudentService.getStates(vm.student_edit.country_id).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_edit.state_id = '';
                        vm.student_edit.city_id = '';
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
                    StudentService.getCities(vm.student_edit.state_id).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_edit.city_id = '';
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getPStates(){
                try{
                    StudentService.getStates(vm.parent_add.country).then(function (resp) {
                        vm.isLoading = false;
                        vm.parent_add.state = '';
                        vm.parent_add.city = '';
                        vm.form.states = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getPCities(){
                try{
                    StudentService.getCities(vm.parent_add.state).then(function (resp) {
                        vm.isLoading = false;
                        vm.parent_add.city = '';
                        vm.form.cities = resp.items;
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getStatusVal(data,Student_id) {
                StudentService.UpdateStudentStatus(Student_id,data).then(function (resp) {
                    vm.isLoading = false;
                }.bind());
            };

    }
        
    function StudentService($http,$rootScope) {
        var dataObj = {
            getStates: getStates,
            getCities: getCities,
            UpdateStudentStatus:UpdateStudentStatus,
            DeleteStudentDetails : DeleteStudentDetails,
            getStudentList : getStudentList,
            getParentsList : getParentsList,
            getParentsListByID: getParentsListByID,
            addNewParent : addNewParent,
            AddPrevious : AddPrevious,
            AddStudentDocument:AddStudentDocument,
            UpdatePrevious : UpdatePrevious,
            UpdateStudent : UpdateStudent,
            UpdateStudentDocs : UpdateStudentDocs,
            UpdateDocumentStatusApproved : UpdateDocumentStatusApproved,
            UpdateDocumentStatusDisapproved : UpdateDocumentStatusDisapproved,
            getParentFromSibiling : getParentFromSibiling,
            assignParent : assignParent,
            DeleteAssignedID : DeleteAssignedID,
            DeletePreviousID :DeletePreviousID,
            DeleteDocumentID : DeleteDocumentID,
            DeleteStudentPhoto : DeleteStudentPhoto,
        };
        
        function UpdateStudent(data,file) {
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
                url: 'api/update-student',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
    function addNewParent(data) {
            return $http({
                method: "POST",
                url: 'api/add-parent',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function AddPrevious(data) {
            return $http({
                method: "POST",
                url: 'api/add-student-previous',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdatePrevious(data) {
            return $http({
                method: "POST",
                url: 'api/update-student-previous',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateStudentDocs(data) {
            return $http({
                method: "POST",
                url: 'api/update-student-document',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateDocumentStatusApproved(data) {
            return $http({
                method: "POST",
                url: 'api/update-student-document-status-approved',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function UpdateDocumentStatusDisapproved(data) {
            return $http({
                method: "POST",
                url: 'api/update-student-document-status-disapproved',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
      
      function AddStudentDocument(data,file) {
            var file_data = new FormData();
            file_data.append('file', file);
            angular.forEach(data, function(value, key) {
              file_data.append(key, value);
            });
            return $http({
                method: "POST",
                url: 'api/add-student-document',
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
                url: 'api/get-parent-from-student',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
    
    function assignParent(data) {
            return $http({
                method: "POST",
                url: 'api/assign-parent',
                data: data,
                }).then(function (response) {
                    console.log(response);
                    return response.data;
            });
      }
        
    function getStudentList(data) {
        return $http({
            method: "POST",
            url: 'api/get_all_student',
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
      
      function DeletePreviousID(data) {
        return $http({
            method: "POST",
            url: 'api/delete_previous_id',
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
            url: 'api/delete_document_id',
            data: data
            }).then(function (response) {
                console.log(response);
                return response.data;
        }, function(response) {
            console.log(response);
        });
      }
      
      function DeleteStudentPhoto(data) {
        return $http({
            method: "POST",
            url: 'api/delete_student_photo',
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
