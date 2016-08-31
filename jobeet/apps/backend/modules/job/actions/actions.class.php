<?php

require_once dirname(__FILE__).'/../lib/jobGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/jobGeneratorHelper.class.php';

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends autoJobActions
{
	public function executeBatchExtend(sfWebRequest $request){
		$ids = $request->getParameter('ids');

		$query = Doctrine_Query::create()
			->from('JobeetJob j')
			->whereIn('j.id', $ids);

		foreach ($query->execute() as $job){
			$job->extend(true);
		}

		$this->getUser()->setFlash('notice', 'The selected jobs has been extended successfully.');
		$this->redirect('jobeetjob');
	}

	//	Defino el action ListExtend para la accion sobre Job
	public function executeListExtend(sfWebRequest $request){
		$job = $this->getRoute()->getObject();
		$job->extend(true);
		$this->getUser()->setFlash('notice', 'The selected job have been extended successfully.');
		$this->redirect('jobeetjob');
	}

	//	Borra todos los jobs que no fueron activados por mas de 60 dias
	public function executeListDeleteNeverActivated(sfWebRequest $request){
		$nb = Doctrine::getTable('JobeetJob')->cleanup(60);

		$this->getUser()->setFlash(
			'notice',
			$nb ? sprintf('%d never activated jobs have been deleted successfully.', $nb) : 'No job to delete'
		);

		$this->redirect('jobeetjob');
	}
}
