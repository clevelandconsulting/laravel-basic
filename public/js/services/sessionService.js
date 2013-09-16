//service that handles client side session storage
angular.module("myApp").factory("SessionService", function() {
	return {
		set: function(key,value) {
			return sessionStorage.setItem(key,value);
		},
		get: function(key) {
			return sessionStorage.getItem(key);
		},
		unset: function(key) {
			return sessionStorage.removeItem(key);
		}
	}
});