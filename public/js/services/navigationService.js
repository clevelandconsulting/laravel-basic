//service to provide the navigation paths
angular.module("myApp").factory("NavigationService", function($location,AuthenticationService) {
	var LoggedInPaths = [{ name: 'Auth Demo', url: '/home' }, { name: 'Profile', url: '/profile'}];
	var GuestPaths = [{ name: 'Login', url: '/login'} ];
	
	var obj = {
		isActive: function(current) { 
					return ( $location.path() === current ? 'active' : '' ); 
					},
		getPaths: function() {
						return AuthenticationService.isLoggedIn() ? LoggedInPaths : GuestPaths;
					}
	};
	
	return obj;

});