var Loader = function() {

}

Loader.prototype.show = function() {
	$("#loader").fadeIn();
}

Loader.prototype.hide = function() {
	$("#loader").fadeOut();
}