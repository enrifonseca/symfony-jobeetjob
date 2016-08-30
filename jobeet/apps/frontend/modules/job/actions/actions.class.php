<?php

/**
 * job actions.
 *
 * @package    jobeet
 * @subpackage job
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class jobActions extends sfActions
{
  public function executeIndex(sfWebRequest $request)
  {
    $this->categories = Doctrine_Core::getTable('JobeetCategory')->getWithJobs();
    //$this->category = $this->getRoute()->getObject();
  }

  public function executeShow(sfWebRequest $request)
  {
    $this->job = $this->getRoute()->getObject();
  }

  public function executeNew(sfWebRequest $request)
  {
    $job = new JobeetJob();
    $job->setType('full-time');

    $this->form = new JobeetJobForm($job);
  }

  public function executeCreate(sfWebRequest $request)
  {
    //$this->forward404Unless($request->isMethod(sfRequest::POST));
    $this->form = new JobeetJobForm();
    $this->processForm($request, $this->form);
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    /*$this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobeetJobForm($jobeet_job);*/
    $this->form = new JobeetJobForm($this->getRoute()->getObject());
  }

  public function executeUpdate(sfWebRequest $request)
  {
    /*$this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
    $this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
    $this->form = new JobeetJobForm($jobeet_job);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');*/

    $this->form = new JobeetJobForm($this->getRoute()->getObject());
    $this->processForm($request, $this->form);
    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    /*$request->checkCSRFProtection();

    $this->forward404Unless($jobeet_job = Doctrine_Core::getTable('JobeetJob')->find(array($request->getParameter('id'))), sprintf('Object jobeet_job does not exist (%s).', $request->getParameter('id')));
    $jobeet_job->delete();

    $this->redirect('job/index');*/
    $request->checkCSRFProtection();

    $job = $this->getRoute()->getObject();
    $job->delete();
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    /*$form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $jobeet_job = $form->save();

      $this->redirect('job/edit?id='.$jobeet_job->getId());
    }*/
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );

    if($form->isValid()){
      $job = $form->save();
      $this->redirect($this->generateUrl('job_show', $job));
    }
  }
}
