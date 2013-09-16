angular.module("myApp").controller('ProfileController', function($scope, $location, $http, flash, user) {
  $scope.title = "Login";
  $scope.user = user.data;
  
  $scope.update = function(user) {

  	  // START HACK 
  	  // to handle the browser autocompletes (angularjs doesn't read these into the scope's model)
  	  
  	  if ( user.first_name === '' ) {
  	    var un = document.querySelector('#firstname');
  	  	user.first_name = angular.element(un).val();
  	  }
  	  if ( user.last_name === '' ) {
  	  	var pw = document.querySelector('#lastname');
  	  	user.last_name = angular.element(pw).val();
  	  }
  	  
  	  // END HACK
  	  
  	  if ( ( user.email !== '' && user.email !== undefined ) ) {

		  var r = $http.put('api/v1/user',user);
	  
		  r.success(function(data){
		  	$scope.flashHeader = 'Yeah!';
		  	flash.success = data.flash;
			//$location.path('/home');
		  });
		  r.error(function(data) {
		  	$scope.flashHeader = 'Doh!';
		  	flash.error = data.flash;
		  });
		  return r;
		  
	  } else {

	  	  $scope.flashHeader = 'Hey!';
		  flash.error = "You must have an email address.";
		  return null;
		  
	  }
	  
  }
});