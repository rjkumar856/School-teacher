(function() {
    'use strict';
    angular
        .module('schoolApp')
        .filter('propsFilter', propsFilter)
        .controller('StudentDetails', StudentDetails)
        .directive('fileUpload',fileUpload)
        .directive("tabClick",tabClick)
        .factory('StudentService', StudentService)
        
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

        StudentDetails.$inject = ['$scope', '$http','$window','$filter','StudentService','$mdDateLocale'];
        function StudentDetails($scope, $http,$window,$filter,StudentService,$mdDateLocale) {
            var vm = $scope;
            vm.StudentService = StudentService;
            vm.rowCollectionStudet = [];
            vm.student_add = {};
            vm.parent_add = {};
            vm.formValidation = false;
            vm.isLoading = false;
            vm.AjaxRequestStatus = '';
            vm.AjaxRequestCode = '';
            vm.student_add.admission_date = '';
            vm.today = new Date();
            vm.addNewStudentSubmission = addNewStudentSubmission;
            vm.student_add.customs = {};
            vm.student_add.country = '';
            vm.student_add.student_category = '1';
            vm.student_add.first_name = '';
            vm.student_add.middle_name = '';
            vm.student_add.last_name = '';
            vm.student_add.roll_number = '';
            vm.student_add.class = '';
            vm.student_add.dob = '';
            vm.student_add.gender = '';
            vm.student_add.blood_group = '';
            vm.student_add.birth_place = '';
            vm.student_add.language = '';
            vm.student_add.religion = '';
            vm.student_add.nationality = '';
            vm.student_add.is_handicapped = 'No';
            vm.student_add.password = 'Welcome@123';
            vm.student_add.address = '';
            vm.student_add.state = '';
            vm.student_add.city = '';
            vm.student_add.pincode = '';
            vm.student_add.mobile = '';
            vm.student_add.email = '';
            
            vm.getStates = getStates;
            vm.getCities = getCities;
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
            vm.search_parent_list = {};
            
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
            
            vm.$watch('student_add.admission_date',function(newVal,oldVal){
                if(newVal !== oldVal){
                    //vm.student_add.admission_date = $filter('date')(vm.student_add.admission_date,"mediumDate");
                }
            });
            
            function addNewStudentSubmission(){
                vm.formValidation = true;
                vm.AjaxRequestStatus = '';
                vm.AjaxRequestCode = '';
                
                if(vm.addStudentForm.$valid){
                    try{
                        vm.isLoading = true;
                        var file = $scope.studentPhoto;
                        var dob = new Date(vm.student_add.dob);
                        vm.student_add.dob = $filter('date')(dob,'yyyy-MM-dd');
                        var admission_date = new Date(vm.student_add.admission_date);
                        vm.student_add.admission_date = $filter('date')(admission_date,'yyyy-MM-dd');
                        
                        StudentService.AddNewStudent(vm.student_add,file).then(function (resp) {
                            vm.isLoading = false;
                            vm.AjaxRequestStatus = resp.message;
                            vm.AjaxRequestCode = resp.code;
                            if(resp.code == '200'){
                                $window.location.href = 'edit-student/parent/'+resp.items;
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
                    StudentService.getStates(vm.student_add.country).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_add.state = '';
                        vm.student_add.city = '';
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
                    StudentService.getCities(vm.student_add.state).then(function (resp) {
                        vm.isLoading = false;
                        vm.student_add.city = '';
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
            AddNewStudent : AddNewStudent,
        };
        
        function AddNewStudent(data,file) {
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
                url: 'api/add-student',
                data: file_data,
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined,'Process-Data': false}
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
