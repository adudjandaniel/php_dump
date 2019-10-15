<?php
	namespace PhpDump;

	class Dump {
		
	    private static function dump_basic($variable, $label = "") {
			$label .= (strlen($label)) ? " - " : "";

			// Dump for string int boolean floats
			$basic_dump = 
			"<table class='php-dump' style='border-collapse: collapse; 
			font-family:verdana, sans-serif; background-color: white; vertical-align: top;'>
				<tbody>
					<tr>
						<td style='border-collapse: collapse;
						font-family: verdana, sans-serif;background-color: white;
						vertical-align: top;padding: 2px 2px;font-size: 9px;'>
							$variable
						</td>
					</tr>
				</tbody>
			</table>";

			return $basic_dump;
		}

		private static function dump_indexed_array ($variable, $label = "") {
			$label .= (strlen($label)) ? " - " : "";

			$array_length = count($variable);

			$array_dump = 
			"<table class='php-dump indexed-array' style='border-collapse: collapse;
			font-family: verdana, sans-serif; background-color: white;
			vertical-align: top;border: 2px solid #135204;'>
				<thead>
					<tr>
						<th class='indexed-array' colspan='2' style='border-collapse: collapse; font-family: verdana, sans-serif;
						background-color: white; vertical-align: top;color: white;
    					padding: 3px 3px; text-align: left; font-size: 8px;font-weight:bold;
    					border: 2px solid #135204;background-color: #1d7907;'> 
    						$label array (indexed)
    					</th>
					</tr>
				</thead>
				<tbody>";

			// Loop through array and append tr to array_dump
			for ($i = 0; $i < $array_length; $i++) {
				$array_dump .= 
				"<tr>
					<td class='indexed-array num-key' style='border-collapse: collapse;
					font-family: verdana, sans-serif; background-color: white;
					vertical-align: top;padding: 2px 2px;font-size: 9px;
					text-align: center;border: 2px solid #135204;
					background-color: #83e66b;'>
						$i
					</td>
					<td class='indexed-array' style='border-collapse: collapse;
					font-family: verdana, sans-serif; background-color: white;
					vertical-align: top; padding: 2px 2px; font-size: 9px;
					border: 2px solid #135204;'>" 
						. self::get_php_dump_html($variable[$i]) . "
					</td>
				</tr>";
			}

			$array_dump .= "
				</tbody>
			</table>";

			return $array_dump;
		}

		private static function dump_associative_array ($variable, $label = "") {
			$label .= (strlen($label)) ? " - " : "";

			$array_dump = 
			"<table class='php-dump associative-array' style='border-collapse: collapse;
			font-family: verdana, sans-serif; background-color: white; vertical-align: top;
			border:  2px solid #0034ce;'>
				<thead>
					<tr>
						<th class='associative-array' colspan='2' style='
						border-collapse: collapse; font-family: verdana, sans-serif;
						background-color: white; vertical-align: top;color: white;
    					padding: 3px 3px; text-align: left; font-size: 8px;
    					font-weight: bold; border:  2px solid #0034ce;
    					background-color: #325ad2;'> 
    						$label array (associative)
    					</th>
					</tr>
				</thead>
			<tbody>";

			foreach ($variable as $key => $value) {
				$array_dump .= 
				"<tr>
					<td class='associative-array text-key' style='border-collapse: collapse;
					font-family: verdana, sans-serif; background-color: white;
					vertical-align: top; padding: 2px 2px; font-size: 9px; 
					text-align: left; border:  2px solid #0034ce;background-color:#aec2ff;'>
						$key
					</td>
					<td class='associative-array' style='border-collapse: collapse;
					font-family: verdana, sans-serif;background-color: white;
					vertical-align: top;padding: 2px 2px;font-size: 9px;
					border:  2px solid #0034ce;'>"
						. self::get_php_dump_html($value) . "
					</td>
				</tr>";
			}

			$array_dump .= "
				</tbody>
			</table>";

			return $array_dump;
		}

		private static function get_php_dump_html($variable, $label = "") {

			switch (gettype($variable)) {
				//Basic dumps
				case 'string':
				case 'integer':
				case 'float':
				case 'boolean':
					$dump = self::dump_basic($variable, $label);
					break;
				case 'array':
					if (count($variable) > 0) {
						if (array_keys($variable)[0] === 0) {
							// Indexed array
							$dump = self::dump_indexed_array($variable, $label);
						} else {
							// Associative array
							$dump = self::dump_associative_array($variable, $label);
						}
					} else {
						// Make default array type an indexed array
						$dump = self::dump_indexed_array($variable, $label);
					}
					break;
				default:
					break;
			}

			return $dump;
		}

		public static function php_dump($variable, $label = "") {

			echo '
			<script type="text/javascript">
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

				(function start_js() {
					if (typeof window.notfirstdumpcall === "undefined") {
						load_CSS();
						var all_keys = document.querySelectorAll("td[class$=\'key\']");
						var all_keys_length = all_keys.length;
						
						// add click event to all keys
						for (let i = 0; i < all_keys_length; i++) {
							all_keys[i].onclick = toggle_values_display;
						}
						window.notfirstdumpcall = true;
					}
				})();
			</script>
			';
			
			// Start dump
			echo self::get_php_dump_html($variable, $label);
		}
	}	
?>