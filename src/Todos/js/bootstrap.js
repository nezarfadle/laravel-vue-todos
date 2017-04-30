export default (function() {

	const bus = new Vue({});

	Object.defineProperties(Vue.prototype, {
	  $bus: {
	    get: function () {
	      return bus
	    }
	  }
	});

})();