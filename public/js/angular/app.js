/**
 * Created by jephthah.efereyan on 4/27/2016.
 */
/*(function () {*/

var app = angular.module('App', []);

app.directive('fileModel', ['$parse', function ($parse) {
    return {
        restrict: 'A',
        link: function (scope, element, attrs) {
            var model = $parse(attrs.fileModel);
            var modelSetter = model.assign;

            element.bind('change', function () {
                scope.$apply(function () {
                    modelSetter(scope, element[0].files[0]);
                });
            });
        }
    };
}]);

var app_url = window.BASE_URL + '/';

function getUrl(url) {
    let _url;
    try {
        // If url is a valid absolute URL, this won't throw
        new URL(url);
        _url = url;
    } catch {
        // If url is relative, concatenate with app_url
        _url = app_url + url;
    }

    return _url;
}

app.factory('myService', function ($http) {
    return {
        sendGetRequest: function (url) {
            url = getUrl(url);
            return $http.get(url).then(function (response) {
                return response;
            });
        },

        sendPostRequest: function (url, params, method = 'post') {
            url = getUrl(url);
            if (method === 'post') {
                return $http.post(url, params).then(function (response) {
                    return response;
                });
            } else if (method === 'put') {
                return $http.put(url, params).then(function (response) {
                    return response;
                });
            } else if (method === 'delete') {
                return $http.delete(url, params).then(function (response) {
                    return response;
                });
            }
        },

        sendPutRequest: function (url, params) {
            url = getUrl(url);
            return $http.put(url, params).then(function (response) {
                return response;
            });
        },

        sendDeleteRequest: function (url) {
            url = getUrl(url);
            return $http.delete(url).then(function (response) {
                return response;
            });
        },

        uploadFile: function (file, uploadUrl) {
            var fd = new FormData();
            fd.append('file', file);

            url = getUrl(uploadUrl);
            return $http.post(url, fd, {
                transformRequest: angular.identity,
                headers: { 'Content-Type': undefined }
            })
                .then(function (response) {
                    return response;
                });
        }
    }
});

function reload_page(delay = 500) {
    setTimeout(function () {
        location.reload();
    }, delay);
}

app.run(function ($http) {
    $http.defaults.headers.common['X-CSRF-TOKEN'] = $('meta[name="csrf-token"]').attr('content');
});

app.directive('stringToNumber', function () {
    return {
        require: 'ngModel',
        link: function (scope, element, attrs, ngModel) {
            ngModel.$parsers.push(function (value) {
                return '' + value;
            });
            ngModel.$formatters.push(function (value) {
                return parseFloat(value, 10);
            });
        }
    };
});
/*
 }());*/
