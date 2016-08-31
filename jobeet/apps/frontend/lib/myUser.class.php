<?php

class myUser extends sfBasicSecurityUser
{
	public function addJobToHistory(JobeetJob $job){
		$jobs = $this->getAttribute('job_historys', array());

		if(!in_array($job, $jobs)){
			array_unshift($jobs, $job);
			$this->setAttribute('job_historys', array_slice($jobs, 0, 3));
		}
	}

	public function getJobsHistory(){
		return $this->getAttribute('job_historys', array());
	}
}
