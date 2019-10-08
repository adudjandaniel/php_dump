<?php
	namespace PhpDump;

	class Dump {
		
	    private static function dump_basic($variable, $label = "") {
			$label .= (strlen($label)) ? " - " : "";

			// Dump for string int boolean floats
			$basic_dump = 
			"<table class='php-dump'>
				<tbody>
					<tr>
						<td>$variable</td>
					</tr>
				</tbody>
			</table>";

			return $basic_dump;
		}

		private static function dump_indexed_array ($variable, $label = "") {
			$label .= (strlen($label)) ? " - " : "";

			$array_length = count($variable);

			$array_dump = 
			"<table class='php-dump indexed-array'>
				<thead>
					<tr>
						<th class='indexed-array' colspan='2'> $label array (indexed)</th>
					</tr>
				</thead>
				<tbody>";

			// Loop through array and append tr to array_dump
			for ($i = 0; $i < $array_length; $i++) {
				$array_dump .= 
				"<tr>
					<td class='indexed-array num-key'>$i</td>
					<td class='indexed-array'>" . self::get_php_dump_html($variable[$i]) . "</td>
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
			"<table class='php-dump associative-array'>
				<thead>
					<tr>
						<th class='associative-array' colspan='2'> $label array (associative)</th>
					</tr>
				</thead>
			<tbody>";

			foreach ($variable as $key => $value) {
				$array_dump .= 
				"<tr>
					<td class='associative-array text-key'>$key</td>
					<td class='associative-array'>" . self::get_php_dump_html($value) . "</td>
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
			echo self::get_php_dump_html($variable, $label);
			echo "<script type='text/javascript' 
			src='../vendor/adudjandaniel/php_dump/assets/js/main.js' 
			async></script>";
		}
	}	
?>