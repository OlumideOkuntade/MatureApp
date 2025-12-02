/**
 * Created by jephthah.efereyan on 10/27/2017.
 */
app
    .controller("RoleCtrl", function ($scope, myService) {
        $scope.role = {};
        $scope.form = {heading: 'Add'};
        let url;
        const $form = $('#roleForm');

        $scope.save = function(event) {
            event.currentTarget.innerHTML = 'Saving...';
            url = $form.attr('action');
            myService.sendPostRequest(url, $scope.role)
                .then(function (response) {
                    $scope.role = response.data.data;
                    $scope.errors = null;
                    $scope.success = {message: response.data.message};
                    reload_page();
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                }).finally(function () {
                event.currentTarget.innerHTML = 'Save';
            });
        };

        $scope.edit = function(event) {
            $scope.form = {heading: 'Edit'};
            url = event.currentTarget.getAttribute('data-edit-url');
            myService.sendGetRequest(url, $scope.role)
                .then(function (response) {
                    $scope.role = response.data.data;
                    $form.attr('action', response.data.update_url);
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                });
        };

        //plant editing function
        $scope.edit_plant = function(event) {
            url = event.currentTarget.getAttribute('data-edit-url');
            myService.sendGetRequest(url, $scope.plant)
                .then(function (response) {
                    $scope.plant = response.data.data;
                    const $form = $('#editForm')
                    $form.attr('action', response.data.update_url);
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                });
        };

        //plant toggling function
        $scope.plant_toggle = function(event) {
            event.currentTarget.innerHTML = 'Toggling...';
            url = event.target.getAttribute('data-toggle-url');
            myService.sendGetRequest(url, $scope.plant)
                .then(function (response) {
                    $scope.plant = response.data.data;
                    reload_page();
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                });
        };


        $scope.toggle = function(event) {
            event.currentTarget.innerHTML = 'Toggling...';
            url = event.target.getAttribute('data-toggle-url');
            myService.sendGetRequest(url, $scope.role)
                .then(function (response) {
                    $scope.role = response.data.data;
                    reload_page();
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                });
        };
    })
    .controller("UserCtrl", function ($scope, myService) {
        let url;
        $scope.roles = [];
        $scope.form = {heading: 'Add', edit:false};

        $scope.user = {
            password: '',
            password_confirmation: ''
        };
        const $userForm = $('#userForm');

        function resetUser() {
            $scope.user = {
                password: '',
                password_confirmation: ''
            };
        }

        url = $('#userList').attr('data-requisites-url');
        myService.sendGetRequest(url)
            .then(function (response) {
                $scope.roles = response.data.data.roles;
                $scope.errors = null;
            }, function (error) {
                $scope.success = null;
                $scope.errors = error.data.errors;
            });

        $scope.save = function(event) {
            event.currentTarget.innerHTML = 'Saving...';
            url = $userForm.attr('action');
            myService.sendPostRequest(url, $scope.user)
                .then(function (response) {
                    $scope.user = response.data;
                    $scope.errors = null;
                    $scope.success = {message: response.data.message};

                    reload_page();
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                }).finally(function () {
                    event.currentTarget.innerHTML = 'Save';
            });
        };

        $scope.create = function() {
            resetUser();
        };

        $scope.edit = function(event) {
            $scope.form = {heading: 'Edit', edit: true};
            url = event.target.getAttribute('data-edit-url');
            myService.sendGetRequest(url, $scope.user)
                .then(function (response) {
                    $scope.user = response.data.data;
                    $userForm.attr('action', response.data.update_url);
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                });
        };

        $scope.toggle = function(event) {
            event.currentTarget.innerHTML = 'Toggling...';
            url = event.target.getAttribute('data-toggle-url');
            myService.sendGetRequest(url, $scope.user)
                .then(function (response) {
                    $scope.user = response.data;
                    reload_page();
                }, function (error) {
                    $scope.success = null;
                    $scope.errors = error.data.errors;
                }).finally(function () {
                    event.currentTarget.innerHTML = 'Toggle';
            });
        };
    })
    .controller("ProfileCtrl", function ($scope, myService, $window) {
        $scope.validatePassword = function () {
            if (!$scope.user.password || !$scope.user.password_confirmation) {
                $scope.errors = {message: 'Passwords cannot be empty'};
                $scope.success = null;
                return false;
            }

            if ($scope.user.password !== $scope.user.password_confirmation) {
                $scope.errors = {message: "Passwords don't not match"};
                $scope.success = null;
                return false;
            }

            return true;
        };

        $scope.submitPassword = function () {
            if (!$scope.validatePassword()) return;

            myService.sendPostRequest('/profile/update', $scope.user)
                .then(function (response) {
                    $scope.success = {message : response.data.message};
                    $scope.errors = null;

                    setTimeout(function () {
                        $window.location.href = response.data.redirect;
                    }, 500);

                    $scope.user.password = '';
                    $scope.user.password_confirmation = '';
                })
                .catch(function (error) {
                    $scope.errors = ['Error: ' + error.data.errors.password];
                    $scope.success = null;
                });
        };
    });
