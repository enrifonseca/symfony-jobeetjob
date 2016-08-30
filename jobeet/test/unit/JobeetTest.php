<?php
require_once dirname(__FILE__) .'/../bootstrap/unit.php';

$test = new lime_test(9);

$test->is(
	Jobeet::slugify(''),
	'n-a',
	'Empty string'
);

$test->is(
	Jobeet::slugify('CORDOBA'),
	'cordoba',
	'String uppercase'
);

$test->is(
	Jobeet::slugify('CoRdOba'),
	'cordoba',
	'String upper and lowercase'
);

$test->is(
	Jobeet::slugify('  cordoba   argentina'),
	'cordoba-argentina',
	'String with multiple space'
);

$test->is(
	Jobeet::slugify('Córdoba_Argentina, (San Juan, {825}. [test])'),
	'cordoba-argentina-san-juan-825-test',
	'String with char ASCCI (tilde, dot, coma, parentesis, llaves, corchetes, guion bajo)'
);

$test->is(
	Jobeet::slugify('547892 123'),
	'547892-123',
	'String with numbers'
);

$test->is(
	Jobeet::slugify('Abc 123'),
	'abc-123',
	'Numbers and letters'
);

$test->is(
	Jobeet::slugify(' - '),
	'n-a',
	'Only no ASCCI char'
);

if(function_exists('iconv')){
	$test->is(
		Jobeet::slugify('Développeur Web'),
		'developpeur-web',
		'::slugify() removes accents'
	);
}
else
	$test->sckip('::slugify() removes accents - iconv not installed');
?>