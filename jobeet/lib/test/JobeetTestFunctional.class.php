<?php
class JobeetTestFunctional extends sfTestFunctional{
	public function loadData(){
		Doctrine_Core::loadData(sfConfig::get('sf_test_dir') .'/fixtures');

		return $this;
	}

	public function getMostRecentProgrammingJob(){
		$query = Doctrine_Query::create()
			->select('j.*')
			->from('JobeetJob j')
			->leftJoin('j.JobeetCategory c')
			->where('c.slug = ?', 'programming');
		$query = Doctrine_Core::getTable('JobeetJob')
			->addActiveJobsQuery($q);

		return $query->fetchOne();
	}

	public function getExpiredJob(){
		$query = Doctrine_Query::create()
			->from('JobeetJob j')
			->where('j.expires_at < ?', date('Y-m-d', time()));

		return $query->fetchOne();
	}

	public function createJob($values = array(), $publish = false){
		$this->get('/job/new')
			->click('Preview your job', array(
				'job' => array_merge(
					array(
						'company'      => 'Sensio Labs',
				        'url'          => 'http://www.sensio.com/',
				        'position'     => 'Developer',
				        'location'     => 'Atlanta, USA',
				        'description'  => 'You will work with symfony to develop websites for our customers.',
				        'how_to_apply' => 'Send me an email',
				        'email'        => 'for.a.job@example.com',
				        'is_public'    => false,
					),
					$values
				)
			))
			->followRedirect();

		if($publish){
			$this->click('Publish', array(), array(
				'method' 		=> 	'put',
				'_with_csrf' 	=>	true
			))
			->followRedirect();
		}

		return $this;
	}

	public function getJobByPosition($position){
		return Doctrine_Query::create()
			->from('JobeetJob j')
			->where('j.position = ?', $position)
			->fetchOne();
	}
}
?>