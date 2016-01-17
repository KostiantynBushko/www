<?php

$f = fopen('/home/rinalds/Desktop/Options_B8ZE72BH66.csv', 'r');
$out = fopen('/tmp/variations.csv', 'w');

while (!feof($f))
{
	$csv = fgetcsv($f);

	if (!$csv[1] || (10 != $csv[1]))
	{
		continue;
	}

	$id = $csv[0];
	$color = $csv[2];

	foreach (explode(',', $csv[5]) as $sku)
	{
		$childSku = $sku . '-' . $id . 'T';
		fputcsv($out, array($sku, null, 'Color'));
		fputcsv($out, array($childSku, $sku, $color, 'options/' . $childSku . '.jpg'));
	}
}

fclose($f);
fclose($out);

?>