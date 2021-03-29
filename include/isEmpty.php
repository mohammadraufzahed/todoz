<?php
function isEmpty($data): bool
{
	foreach ($data as $value) {
		if (empty(trim($value))) {
			return true;
		}
	}
	return false;
}
