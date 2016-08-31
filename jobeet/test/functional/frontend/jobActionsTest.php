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

//	Verificando la existencia del registro anterior
$browser->setTester('doctrine', 'sfTesterDoctrine');
$browser->with('doctrine')
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

//	Probando en caso de enviar datos no validos
$browser->info('	3.2 - Submit a Job with invalid values')
	->get('/job/new')
	->click('Preview your job', array(
		'job' => array(
			'company'      => 'Sensio Labs',
    		'position'     => 'Developer',
    		'location'     => 'Atlanta, USA',
    		'email'        => 'not.an.email',
		)
	))
	->with('form')
		->begin()
		->hasErrors(3)
		->isError('description', 'required')
		->isError('how_to_apply', 'required')
		->isError('email', 'invalid')
	->end();

//	Probando publish
$browser->info('	3.3 - On the preview page, you can publish the job')
	->createJob(array('position' => 'F001'))
	->click('Publish', array(), array(
		'method' => 'put',
		'_with_csrf' => true
	))
	->with('doctrine')
		->begin()
		->check('JobeetJob', array(
			'position' => 'F001',
			'is_activated' => true
		))
		->end();

//	Probando delete
$browser->info('	3.4 - On the preview page, you can delete the job')
	->createJob(array('position' => 'F002'))
	->click('Delete', array(), array(
		'method' 		=> 	'delete',
		'_with_csrf' 	=>	true
	))
	->with('doctrine')
		->begin()
		->check('JobeetJob', array(
			'position' => 'F002'
		), false)
	->end();

//	Cuando es publicado no se puede editar
$browser->info('	3.5 - When a job is published it cannot be edited anymore')
	->createJob(array('position' => 'F003'), true)
	->get(
		sprintf(
			'/job/%s/edit',
			$browser->getJobByPosition('F003')
		)
	)
	->with('response')
		->begin()
			->isStatusCode(404)
		->end();

//	
$browser->info('  3.6 - A job validity cannot be extended before the job expires soon')
	->createJob(array('position' => 'FOO4'), true)
  	->call(
  		sprintf(
  			'/job/%s/extend',
  			$browser->getJobByPosition('FOO4')->getToken()
  		),
  		'put',
  		array('_with_csrf' => true)
  	)
  	->with('response')
  		->begin()
  		->isStatusCode(404)
  	->end();
 
$browser->info('  3.7 - A job validity can be extended when the job expires soon')
	->createJob(array('position' => 'FOO5'), true);
 
$job = $browser->getJobByPosition('FOO5');
$job->setExpiresAt(date('Y-m-d'));
$job->save();
 
/*$browser->call(
		sprintf(
			'/job/%s/extend', 
			$job->getToken()
		),
		'put',
		array('_with_csrf' => true)
	)
	->with('response')
	->isRedirected();
 
$job->refresh();
$browser->test()
	->is(
  		$job->getDateTimeObject('expires_at')->format('y/m/d'),
  		date('y/m/d', time() + 86400 * sfConfig::get('app_active_days'))
	);*/

//	Simulacion de cambio de columna prohibida
$browser->
	get('/job/new')
	->click(
		'Preview your job',
		array(
			'job' => array(
				'token' => 'fake_token'
			)
		)
	)
	->with('form')
		->begin()
		->hasErrors(7)
			->hasGlobalError('extra_fields')
	->end();