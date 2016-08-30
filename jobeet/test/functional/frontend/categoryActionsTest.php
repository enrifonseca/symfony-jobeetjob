<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

//	Category - Es clickeable Porgramming y tiene los parametros correctos
$browser->info('1 - The category page')
	->info('	1.1 - Categories on homepage are clickeable')
	->get('/')
	->click('Programming')
	->with('request')
		->begin()
		->isParameter('module', 'category')
		->isParameter('action', 'show')
		->isParameter('slug', 'programming')
	->end();

//	Category - Solo las que tienen mas de 10 jobs muestran el link para ver mas
$browser->info('	1.2 - Categories with more than %s jobs also have a "more" link', sfConfig::get('app_max_jobs_on_homepage'))
	->get('/')
	->click('22')
	->with('request')
		->begin()
		->isParameter('module', 'category')
		->isParameter('action', 'show')
		->isParameter('slug', 'programming')
	->end();

//	Category - Que la cantidad listada no supere el limite
$max = sfConfig::get('app_max_jobs_on_category');
$browser->info(sprintf('	1.3 - Only %s jobs are listed', $max))
	->with('response')
	->begin()
		->checkElement('.jobs tr', $max)
	->end();

//	Category - La lista esta paginada
$browser->info('	1.4 - The job listed is paginated')
	->with('response')
	->begin()
		->checkElement('.pagination_desc', '/32 jobs/')
		->checkElement('.pagination_desc', '#page 1/2#')
	->end()
	->click("Last page")
	->with('request')
		->begin()
		->isParameter('page', 2)
	->end()
	->with('response')
		->checkElement('.pagination_desc', '#page 2/2#');