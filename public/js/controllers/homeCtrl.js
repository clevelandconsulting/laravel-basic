angular.module("myApp").controller('HomeController', function($scope, $location, AuthenticationService) {
  $scope.title = "Home";
  
  $scope.logout = function() {
	  AuthenticationService.logout().success( function() {
	  
	  	$location.path('/login');
	  
	  });
  }

});