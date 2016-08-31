<?php

class myUser extends sfBasicSecurityUser
{
	public function addJobToHistory(JobeetJob $job){
		$jobs = $this->getAttribute('job_history', array());

		if(!in_array($job, $jobs)){
			array_unshift($jobs, $job);
			$this->setAttribute('job_history', array_slice($jobs, 0, 3));
		}
	}

	public function getJobsHistory(){
		return $this->getAttribute('job_history', array());
	}

	public function resetJobHistory(){
		$this->getAttributeHolder()->remove('job_history');
	}
}
