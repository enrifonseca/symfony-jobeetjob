<?php

/**
 * JobeetJob form.
 *
 * @package    jobeet
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormTemplate.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class JobeetJobForm extends BaseJobeetJobForm
{
  public function configure()
  {
  	//	Eliminando campos del formulario
  	unset(
  		$this['created_at'],
  		$this['updated_at'],
  		$this['expires_at'],
  		$this['is_activated'],
  		$this['token']
  	);

  	//	Agregando validacion para el campo email
  	//$this->validatorSchema['email'] = new sfValidatorEmail();

  	//	Para no perder las validaciones que ya trae
  	$this->validatorSchema['email'] = new sfValidatorAnd(
  		array(
  			$this->validatorSchema['email'],
  			new sfValidatorEmail()
  		)
  	);

  	//	Cambiando el elemento (radio) en el que se muestra los types
  	$this->widgetSchema['type'] = new sfWidgetFormChoice(
  		array(
  			'choices'	=>	Doctrine_Core::getTable('JobeetJob')->getTypes(),
  			'expanded'	=>	true
  		)
  	);

  	//	Limitando los valores a solo los que indica el modelo
  	$this->validatorSchema['type'] = new sfValidatorChoice(
  		array(
  			'choices'	=>	array_keys(Doctrine_Core::getTable('JobeetJob')->getTypes())
  		)
  	);

  	//	Cambiando label de logo (se puede hacer asi o con el metodo setLabels())
  	$this->widgetSchema['logo'] = new sfWidgetFormInputFile(
  		array(
  			'label' => 'Company logo'
  		)
  	);

  	//	Cambiando el validador de logo de String a File
  	$this->validatorSchema['logo'] = new sfValidatorFile(
  		array(
  			'required'		=>	false,
  			'path'			=>	sfConfig::get('sf_upload_dir') .'/jobs',
  			'mime_types'	=>	'web_images'
  		)
  	);

  	//	Cambiando el label del campo
  	$this->widgetSchema->setLabels(
  		array(
  			'category_id' 	=>	'Category',
  			'is_public'		=>	'Public?',
  			'how_to_apply'	=>	'How to apply?'
  		)
  	);

  	//	Agregando mensaje de ayuda a "Is public?"
  	$this->widgetSchema->setHelp('is_public', 'Wether the job can also be...');

    //  Cambiando el formato del nombre
    $this->widgetSchema->setNameFormat('job[%s]');
  }
}
