function toggle_values_display () {
	var sibling = this.nextElementSibling;
	var class_names_sibling = sibling.className;
	var sibling_first_child = sibling.firstElementChild;

	// check for no-display in first child of the sibling
	var class_names_sibling_child = sibling_first_child.className;
	var no_display_pos = class_names_sibling_child.indexOf("no-display");
	if (no_display_pos === -1) {
		// add no-display class if absent
		sibling_first_child.className += " no-display";
		//colorize the field with the color of the key
		sibling.className += " " + this.className;
	} else {
		// remove no-display css class
		sibling_first_child.className = class_names_sibling_child.replace("no-display", "");
		// remove coloration
		sibling.className = class_names_sibling.replace(this.className, "");
	}
}

function load_CSS() {
	var head = document.getElementsByTagName('head')[0];
	var css_link = document.createElement('link');
	css_link.rel = "stylesheet";
	css_link.type = "text/css";
	css_link.href = "../assets/css/main.css";
	head.append(css_link);
}

(function start_js() {
	if (typeof window.notfirstdumpcall === "undefined") {
		load_CSS();
		var all_keys = document.querySelectorAll("td[class$='key']");
		var all_keys_length = all_keys.length;
		
		// add click event to all keys
		for (let i = 0; i < all_keys_length; i++) {
			all_keys[i].onclick = toggle_values_display;
		}
		window.notfirstdumpcall = true;
	}
})();