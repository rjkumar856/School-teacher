(function() {
    'use strict';
    angular
        .module('schoolApp')
        .filter('propsFilter', propsFilter)
        .controller('TeacherDetails', TeacherDetails)
        .directive('fileUpload',fileUpload)
        .directive("tabClick",tabClick)
        .factory('ClassService',ClassService)
        .factory('TeacherService', TeacherService);
        
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

        TeacherDetails.$inject = ['$scope','$http','$window','$timeout','$filter','TeacherService','$mdDateLocale','ClassService'];
        function TeacherDetails($scope,$http,$window,$timeout,$filter,TeacherService,$mdDateLocale,ClassService) {
            var vm = $scope;
            vm.TeacherService = TeacherService;
            vm.ClassService = ClassService;
            vm.teacher_add = {};
            vm.parent_add = {};
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            
            vm.today = new Date();
            vm.addNewTeacherSubmission = addNewTeacherSubmission;
            vm.teacher_add.customs = {};
            vm.teacher_add.teacher_id = '';
            vm.teacher_add.doj = new Date();
            vm.teacher_add.first_name = '';
            vm.teacher_add.last_name = '';
            vm.teacher_add.department_id = '';
            vm.teacher_add.class_id = [];
            vm.teacher_add.dob = '';
            vm.teacher_add.category_id = '';
            vm.teacher_add.gender = '';
            vm.teacher_add.position = '';
            vm.teacher_add.grade = '';
            vm.teacher_add.job_title = '';
            vm.teacher_add.qualification = '';
            vm.teacher_add.experience = '';
            vm.teacher_add.experience_details = '';
            vm.teacher_add.password = 'Welcome@123';
            vm.teacher_add.marital_status = '';
            vm.teacher_add.blood_group = '';
            vm.teacher_add.is_handicapped = 'No';
            vm.teacher_add.handicap_details = '';
            vm.teacher_add.father_name = '';
            vm.teacher_add.mother_name = '';
            vm.teacher_add.spouse_name = '';
            vm.teacher_add.nationality = '';
            vm.teacher_add.address = '';
            vm.teacher_add.country_id = '';
            vm.teacher_add.state_id = '';
            vm.teacher_add.city_id = '';
            vm.teacher_add.pincode = '';
            vm.teacher_add.email = '';
            vm.teacher_add.mobile = '';
            vm.teacher_add.home_phone = '';
            vm.teacher_add.emergency_contact = '';
            
            vm.availableRoles = ['normal','admin','sales','marketing','executive','all'];
            
            vm.getStates = getStates;
            vm.getCities = getCities;
            vm.form = {};
            vm.form.states = [];
            vm.form.cities = [];
            vm.form.p_states = [];
            vm.form.p_cities = [];
            vm.form.teacher_class_list = ClassService.teacher_class_list;
            vm.form.relation = ['Father','Mother','Others'];
            vm.isSearchLoading = false;
            vm.parent_assign = {};
            vm.parent_assign.select_all = false;
            vm.AjaxRequestStatusAssign = '';
            vm.AjaxRequestCodeAssign = '';
            
            vm.teacher_name = [];
            vm.search_parent_list = {};
            
            vm.$watch('teacher_add.admission_date',function(newVal,oldVal){
                if(newVal !== oldVal){
                    //vm.teacher_add.admission_date = $filter('date')(vm.teacher_add.admission_date,"mediumDate");
                }
            });
            
            function addNewTeacherSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                if(vm.addTeacherForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.teacherPhoto;
                        var dob = new Date(vm.teacher_add.dob);
                        vm.teacher_add.dob = $filter('date')(dob,'yyyy-MM-dd');
                        var admission_date = new Date(vm.teacher_add.doj);
                        vm.teacher_add.doj = $filter('date')(admission_date,'yyyy-MM-dd');
                        
                        var temp_class_id = '';
                        angular.forEach(vm.teacher_add.class_id,function(value){
                            if(temp_class_id != ''){
                                temp_class_id += ','+value.id;
                            }else{
                                temp_class_id += value.id;
                            }
                        });
                        vm.teacher_add.class_id = temp_class_id;
                        vm.TeacherService.AddNewTeacher(vm.teacher_add,file).then(function (resp) {
                            if(resp.code && resp.items){
                                vm.isLoading = false;
                                vm.AjaxRequestStatus = resp.message;
                                vm.AjaxRequestCode = resp.code;
                                if(resp.code == '200'){
                                    $timeout(function () {
                                        $window.location.href = 'edit-teacher/'+resp.items;
                                    }, 2000);
                                }
                            }else{
                                vm.isLoading = false;
                                vm.AjaxRequestStatus = "Error Occured";
                                vm.AjaxRequestCode = "211";
                                console.log(resp);
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
            
            function getStates(){
                try{
                    vm.TeacherService.getStates(vm.teacher_add.country_id).then(function (resp) {
                        if(resp.items){
                            vm.isLoading = false;
                            vm.teacher_add.state_id = '';
                            vm.teacher_add.city_id = '';
                            vm.form.states = resp.items;
                        }else{
                            vm.isLoading = false;
                            vm.form.states = [];
                            console.log(resp);
                        }
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.states = [];
                    console.log(err);
                }
            }
            
            function getCities(){
                try{
                    vm.TeacherService.getCities(vm.teacher_add.state_id).then(function (resp) {
                        if(resp.items){
                            vm.isLoading = false;
                            vm.teacher_add.city_id = '';
                            vm.form.cities = resp.items;
                        }else{
                            vm.isLoading = false;
                            vm.form.cities = [];
                            console.log(resp);
                        }
                        
                    }.bind());
                }catch(err){
                    vm.isLoading = false;
                    vm.form.cities = [];
                    console.log(err);
                }
            }
            
            function getStatusVal(data,Teacher_id) {
                vm.TeacherService.UpdateTeacherStatus(Teacher_id,data).then(function (resp) {
                    vm.isLoading = false;
                }.bind());
            };

    }
        
    function TeacherService($http,$rootScope) {
        var dataObj = {
            getStates: getStates,
            getCities: getCities,
            AddNewTeacher : AddNewTeacher,
        };
        
        function AddNewTeacher(data,file) {
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
                url: 'api/add-teacher',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
                }).then(function (response) {
                    console.log(response);
                    return response.data;
                }, function(response) {
                console.log(response);
                return response;
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
        }, function(response) {
            console.log(response);
            return response;
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
    
    
    function fileUpload($parse){
         return {
            restrict: 'A',
            link: function(scope, element, attrs) {
                var model = $parse(attrs.fileUpload);
                var modelSetter = model.assign;
                element.bind('change', function(){
                    scope.$apply(function(){
                        modelSetter(scope, element[0].files[0]);
                    });
                });
            }
        };
    }
    
})();