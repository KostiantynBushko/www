<?php

$f = fopen('/home/rinalds/Desktop/OptionCategories_KG9NGBKSFE.csv', 'r');
$categories = array();
while (!feof($f))
{
	$csv = fgetcsv($f);

	if ($csv[1])
	{
		$csv[2] = $csv[1] . ' - ' . $csv[2];
	}

	$categories[$csv[0]] = array('name' => $csv[2], 'isRequired' => (int)($csv[3] == 'Y'), 'position' => $csv[5]);
}
fclose($f);

$f = fopen('/home/rinalds/Desktop/Options_B8ZE72BH66.csv', 'r');
fgetcsv($f);
$options = array();
while (!feof($f))
{
	$csv = fgetcsv($f);

	if (!$csv[1] || (10 == $csv[1]))
	{
		continue;
	}

	$id = $csv[0];
	$color = $csv[2];

	foreach (explode(',', $csv[5]) as $sku)
	{
		$options[$sku][$csv[1]][] = $csv[2];
	}
}

fclose($f);

$out = fopen('/tmp/options.csv', 'w');

foreach ($options as $sku => $opts)
{
	$productOpts = array();
	foreach ($opts as $optionID => $values)
	{
		$opt = $categories[$optionID];
		$productOpts[$opt['position']] = $opt['name'] . ': ' . implode(',', $values);
	}

	ksort($productOpts);

	fputcsv($out, array($sku, implode('; ', $productOpts)));
}

fclose($out);

?>