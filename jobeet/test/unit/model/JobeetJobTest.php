<?php
require_once(dirname(__FILE__). '/../../bootstrap/Doctrine.php');

$test = new lime_test(3);

//	GetCompanySlug()

$test->comment('->getCompanySlug()');

$job = Doctrine_Core::getTable('JobeetJob')->createQuery()->fetchOne();

$test->is(
	$job->getCompanySlug(),
	Jobeet::slugify($job->getCompany()),
	'->getCompanySlug() return the slug for company'
);

//	Save()
$test->comment('->save()');

//	Without expires at
$job = create_job();
$job->save();

$expiresAt = date('Y-m-d', time() + 86400 * sfConfig::get('app_active_days'));

$test->is(
	$job->getDateTimeObject('expires_at')->format('Y-m-d'),
	$expiresAt,
	'->save() updates expires_at if not set'
);

//	With expires at

$job = create_job(array('expires_at' => '2016-08-08'));
$job->save();

$test->is(
	$job->getDateTimeObject('expires_at')->format('Y-m-d'),
	'2016-08-08',
	'->save() doesnt update expires_at if set'
);

//	Function create job
function create_job($defaults = array()){
	static $category = null;

	if(is_null($category))
		$category = Doctrine_Core::getTable('JobeetCategory')
			->createQuery()
			->limit(1)
			->fetchOne();

	$job = new JobeetJob();
	$job->fromArray(
		array_merge(
			array(
				'category_id'	=>	$category->getId(),
				'company'		=>	'Arweb',
				'position'		=>	'Senior Tester',
				'location'		=>	'Cordoba, Argentina',
				'description'	=>	'Testing',
				'how_to_apply'	=>	'Send e-Mail',
				'email'			=>	'job@example.com',
				'token'			=>	rand(1111, 9999),
				'is_activated'	=>	true
			),
			$defaults
		)
	);

	return $job;
}

?>