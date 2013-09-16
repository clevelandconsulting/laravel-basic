//service to handle authentication
angular.module("myApp").factory("AuthenticationService", function($http, flash, SessionService) {
	var cacheSession = function() {
		SessionService.set('authenticated',true);
	};
	var unCacheSession = function() {
		SessionService.unset('authenticated');
	};
	var checkSession = function() {
		return SessionService.get('authenticated') == "true";
	}
	
	return {
		login: function(credentials) {
			var p = $http.post('api/v1/auth/login',credentials)
			.success(function(data) {
				cacheSession();
				flash.success = data.flash;
			})
			.error(function(data) {
				flash.error = data.flash;
				
			});
			return p;
		},
		logout: function() {
			
			var p = $http.get('api/v1/auth/logout')
			.success(unCacheSession);
			
			return p;
		},
		isLoggedIn: function() {
			return checkSession();
		}
	}
});