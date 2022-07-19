var app = angular.module("mainApp", ['ui.router']);

app.config(
    ['$stateProvider', '$urlRouterProvider', function($stateProvider, $urlRouterProvider) {
        $urlRouterProvider.otherwise('/');
        $stateProvider.state('viewItems', {
            url:'/viewItems',
            templateUrl: 'viewItems.php'
        }
        )
        .state('addItem', {
            url:'/addItem',
            templateUrl: 'addItem.php'
        }
        )
        .state('home', {
            url:'/home',
            templateUrl: 'home.php'
        }
        )
    }]
);

app.controller("CRUDController", function($scope) {
    
    
})