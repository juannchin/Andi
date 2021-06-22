angular.module('testing',['djds4rce.angular-socialshare'])
.run(function($FB){
  $FB.init('386469651480295');
});

angular.module('testing').controller('temp',function($scope,$timeout){

  $timeout(function(){
    $scope.url = 'http://google.com';
    $scope.text = 'testing share';
    $scope.title = 'title1'
  },1000)
  $timeout(function(){
    $scope.url = 'http://twitter.com';
    $scope.text = 'testing second share';
    $scope.title = 'title2';
  },10000)
}); 

'use strict';

/*
 *  * angular-socialshare v0.0.2
 *   * ? CopyHeart 2014 by Dayanand Prabhu http://djds4rce.github.io
 *    * Copying is an act of love. Please copy.
 *     */

angular.module('djds4rce.angular-socialshare', [])
	.factory('$FB', ['$window', function($window) {
		return {
			init: function(fbId) {
				if (fbId) {
					this.fbId = fbId;
					$window.fbAsyncInit = function() {
						FB.init({
							appId: fbId,
							channelUrl: 'app/channel.html',
							status: true,
							xfbml: true
						});
					};
					(function(d) {
						var js,
							id = 'facebook-jssdk',
							ref = d.getElementsByTagName('script')[0];
						if (d.getElementById(id)) {
							return;
						}

						js = d.createElement('script');
						js.id = id;
						js.async = true;
						js.src = "//connect.facebook.net/en_US/all.js";

						ref.parentNode.insertBefore(js, ref);

					}(document));
				} else {
					throw ("FB App Id Cannot be blank");
				}
			}
		};

	}]).directive('facebook', ['$http', function($http) {
		return {
			scope: {
				shares: '='
			},
			transclude: true,
			template: '<span ng-transclude></span>',
			link: function(scope, element, attr) {
				attr.$observe('url', function() {
					if (attr.shares && attr.url) {
						$http.get('https://api.facebook.com/method/links.getStats?urls=' + attr.url + '&format=json').success(function(res) {
							var count = res[0] ? res[0].total_count.toString() : 0;
							var decimal = '';
							if (count.length > 6) {
								if (count.slice(-6, -5) != "0") {
									decimal = '.' + count.slice(-6, -5);
								}
								count = count.slice(0, -6);
								count = count + decimal + 'M';
							} else if (count.length > 3) {
								if (count.slice(-3, -2) != "0") {
									decimal = '.' + count.slice(-3, -2);
								}
								count = count.slice(0, -3);
								count = count + decimal + 'k';
							}
							scope.shares = count;
						}).error(function() {
							scope.shares = 0;
						});
					}
					element.unbind();
					element.bind('click', function(e) {
						FB.ui({
							method: 'share',
							href: attr.url
						});
						e.preventDefault();
					});
				});
			}
		};
	}]);
//Simple Debounce Implementation
//http://davidwalsh.name/javascript-debounce-function
function debounce(func, wait, immediate) {
	var timeout;
	return function() {
		var context = this,
			args = arguments;
		var later = function() {
			timeout = null;
			if (!immediate) func.apply(context, args);
		};
		var callNow = immediate && !timeout;
		clearTimeout(timeout);
		timeout = setTimeout(later, wait);
		if (callNow) func.apply(context, args);
	};
};
//http://stackoverflow.com/questions/1349404/generate-a-string-of-5-random-characters-in-javascript
/**
 * RANDOM STRING GENERATOR
 *
 * Info:      http://stackoverflow.com/a/27872144/383904
 * Use:       randomString(length [,"A"] [,"N"] );
 * Default:   return a random alpha-numeric string
 * Arguments: If you use the optional "A", "N" flags:
 *            "A" (Alpha flag)   return random a-Z string
 *            "N" (Numeric flag) return random 0-9 string
 */
function randomString(len, an){
    an = an&&an.toLowerCase();
    var str="", i=0, min=an=="a"?10:0, max=an=="n"?10:62;
    for(;i++<len;){
      var r = Math.random()*(max-min)+min <<0;
      str += String.fromCharCode(r+=r>9?r<36?55:61:48);
    }
    return str;
}