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

//	Job - Agregando un job
$browser->info('3 - Post a Job Page')
	->info(' 3.1 - Submit a job')
	->get('/job/new')
	->with('request')
		->begin()
		->isParameter('module', 'job')
		->isParameter('action', 'new')
	->end()
	->click('Preview your job', array('job' => array(
		'company'	=>	'Company Test',
		'url'	=>	'www.asdasd.com',
		'logo'	=>	'as.png',
		'position'	=>	'Sr',
		'location'	=>	'Cordoba',
		'description'	=>	'asdasdasdas',
		'how_to_apply'	=>	'asdasdasdas',
		'email'	=>	'mail@ejemplo.com',
		'is_public'	=>	false,
	)))
	->with('form')
		->begin()
		->hasErrors(false)
	->end()
	->with('request')
		->begin()
		->isParameter('module', 'job')
		->isParameter('action', 'create')
	->end();

$browser->setTester('doctrine', 'sfTesterDoctrine')
	->with('doctrine')
		->begin()
		->check(
			'JobeetJob',
			array(
				'location'	=>	'Cordoba',
				'is_activated' => false,
				'is_public' => false
			)
		)
	->end();