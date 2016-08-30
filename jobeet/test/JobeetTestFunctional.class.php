<?php
class JobeetTestFunctional extends sfTestFunctional{
	public function createJob($values = array()){
		return $this->get('/job/new')
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
	}
}
?>