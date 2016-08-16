// Block vs Function level scoping.  Javascript is functionally scoped.  Also variables are "hoisted".
// http://www.adequatelygood.com/JavaScript-Scoping-and-Hoisting.html

(function() {
	console.log(x()); // returns 3 - function declarations are block level scoped.
	console.log(y()); // return "undefined" because var y is what exists at the moment.  
	
	function x() { return 3; };
	var y = function() { return 4; };
})();

// The below is the "effective" function of above
(function() {
	function x() { return 3; };
	var y;
	console.log(x());
	console.log(y());
	
	y = function() { return 4; };
})();

// Variables created inside a function without "var" are global scope
(function cool() {
	x = 3;
}());

console.log(x); // 3