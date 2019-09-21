<?php
	function dump_basic($variable, $label = "") {
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

	function dump_indexed_array ($variable, $label = "") {
		$label .= (strlen($label)) ? " - " : "";

		$array_length = count($variable);

		$array_dump = 
		"<table class='php-dump indexed-array'>
			<thead>
				<tr>
					<th class='indexed-array' colspan='2'> $label array</th>
				</tr>
			</thead>
			<tbody>";

		// Loop through array and append tr to array_dump
		for ($i = 0; $i < $array_length; $i++) {
			$array_dump .= 
			"<tr>
				<td class='indexed-array key'>$i</td>
				<td class='indexed-array'>" . get_php_dump_html($variable[$i]) . "</td>
			</tr>";
		}

		$array_dump .= "
			</tbody>
		</table>";

		return $array_dump;
	}

	function dump_associative_array ($variable, $label = "") {
		$label .= (strlen($label)) ? " - " : "";

		$array_dump = 
		"<table class='php-dump associative-array'>
			<thead>
				<tr>
					<th class='associative-array' colspan='2'> $label array</th>
				</tr>
			</thead>
		<tbody>";

		$array_dump .= "
			</tbody>
		</table>";

		return $array_dump;
	}

	function get_php_dump_html($variable, $label = "") {

		switch (gettype($variable)) {
			//Basic dumps
			case 'string':
			case 'integer':
			case 'float':
			case 'boolean':
				$dump = dump_basic($variable, $label);
				break;
			case 'array':
				if (count($variable) > 0) {
					if (array_keys($variable)[0] === 0) {
						// Indexed array
						$dump = dump_indexed_array($variable, $label);
					} else {
						// Associative array
						$dump = dump_associative_array($variable, $label);
					}
				} else {
					// Make default array type an indexed array
					$dump = dump_indexed_array($variable, $label);
				}
				break;
			default:
				break;
		}

		return $dump;
	}

	function php_dump($variable, $label = "") {
		echo get_php_dump_html($variable, $label);
	}
?>