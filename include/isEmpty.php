<?php
function isEmpty(array $data): bool
{
	$isEmpty = false;
	foreach ($data as $value) {
		if (empty(trim($value))) {
			$isEmpty = true;
		}
	}
	return $isEmpty;
}
