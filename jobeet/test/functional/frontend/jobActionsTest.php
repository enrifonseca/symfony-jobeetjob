<?php

include(dirname(__FILE__).'/../../bootstrap/functional.php');

$browser = new JobeetTestFunctional(new sfBrowser());
$browser->loadData();

//	Home - Que el modulo sea Job y el action index. No lista jobs expirados
$browser->info('1 - The Homepage')
	->get('/')
	->with('request')
		->begin()
		->isParameter('module', 'job')
		->isParameter('action', 'index')
	->end()
	//	En la respuesta, busco que no exista ningun elemento dentro de .jobs td.position que conicida con "Web Developer Exp" ya que ese es el expirado
	->with('response')
		->begin()
		->info('  1.1 - Expired jobs are not listed')
		->checkElement('.jobs td.position:contains("Web Developer Exp")', false)
	->end();

//	Home - Comprueba que los jobs x category no supere el limite establecido
$browser->info('1 - The Homepage')
	->get('/')
	->info(sprintf('	1.2 - Only %s jobs are listed for a category', sfConfig::get('app_max_jobs_on_homepage')))
	->with('response')
		->checkElement('.category_programming tr', $max);

//	Home - No hay jobs para desing y si para programming
$browser->info('1 - The Homepage')
	->get('/')
	->info('	1.3 - A category has a link to the category page only if too many jobs')
	->with('response')
		->begin()
		->checkElement('.category.design .more_jobs', false)
		->checkElement('.category.programming .more_jobs')
	->end();

//	Home - Jobs ordenados por fecha
$browser->info('1 - The Homepage')
	->get('/')
	->info('	1.4 - Jobs are sorted by date')
	->with('response')
		->begin()
		->checkElement(
			sprintf(
				'.category.programming tr:first a[href*="/%d/"]',
				$browser->getMostRecentProgrammingJob()->getId()
			)
		)
	->end();

//	Job - Que sea clickeable y que se detalle la informacion correcta
$job = $browser->getMostRecentProgrammingJob();
$browser->info('2 - The Job Page')
	->get('/')
	->info('	2.1 Each job on the Homepage is clickeable and give detailed information')
	->click('Web Developer', array(), array('position' => 1))
	->with('request')
		->begin()
		->isParameter('module', 'job')
		->isParameter('action', 'show')
		->isParameter('company_slug', $job->getCompanySlug())
		->isParameter('location_slug', $job->getLocationSlug())
		->isParameter('position_slug', $job->getPositionSlug())
		->isParameter('id', $job->getId())
	->end();

//	Job - Redirige a 404 si no existe el Job
$browser->info('	2.2 - A non existent job formwards the user to a 404')
	->get('/job/company-slug/location-slug/0/position_slug')
	->with('response')
		->isStatusCode(404);

//	Job - Redirige a 404 si el Job expiro
$browser->info('	2.3 - An expired job page forwards the user to a 404')
	->get(
		/*sprintf(
			'/job/company-slug/location-slug/0/position_slug',
			$browser->getExpiredJob()->getId()
		)*/
		link_to('test', 'job_show_user', $browser->getExpiredJob())
	)
	->with('response')
		->isStatusCode(404);