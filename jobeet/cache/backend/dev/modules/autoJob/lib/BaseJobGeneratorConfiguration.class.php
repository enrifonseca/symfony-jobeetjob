<?php

/**
 * job module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage job
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseJobGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  'extend' => NULL,  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  'deleteNeverActivated' =>   array(    'label' => 'Delete never activated jobs',  ),);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,  'extend' => NULL,);
  }

  public function getListParams()
  {
    return '%%is_activated%% <small>%%jobeet_category%%</small> - %%company%%(<em>%%email%%</em>) is looking for a %%=position%% (%%location%%))';
  }

  public function getListLayout()
  {
    return 'stacked';
  }

  public function getListTitle()
  {
    return 'Job Management';
  }

  public function getEditTitle()
  {
    return 'Editing Job "%%company%%" is looking for a %%position%%';
  }

  public function getNewTitle()
  {
    return 'Job Creation';
  }

  public function getFilterDisplay()
  {
    return array(  0 => 'category_id',  1 => 'type',  2 => 'company',  3 => 'url',  4 => 'is_public',  5 => 'is_activated',  6 => 'email',);
  }

  public function getFormDisplay()
  {
    return array(  'Content' =>   array(    0 => 'category_id',    1 => 'type',    2 => 'company',    3 => 'logo',    4 => 'url',    5 => 'position',    6 => 'location',    7 => 'description',    8 => 'how_to_apply',    9 => 'is_public',    10 => 'email',  ),  'Admin' =>   array(    0 => '_generated_token',    1 => 'is_activated',    2 => 'expires_at',  ),);
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array(  0 => 'category_id',  1 => 'type',  2 => 'company',  3 => 'logo',  4 => 'url',  5 => 'position',  6 => 'location',  7 => 'description',  8 => 'how_to_apply',  9 => 'is_public',  10 => 'email',);
  }

  public function getListDisplay()
  {
    return array(  0 => 'company',  1 => 'position',  2 => 'location',  3 => 'url',  4 => 'is_activated',  5 => 'email',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'category_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'type' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'company' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'logo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'url' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'position' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'location' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'description' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'how_to_apply' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'token' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'is_public' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Public?',  'help' => 'Whether the job can also be published on affiliate websites, or not',),
      'is_activated' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Boolean',  'label' => 'Activated?',  'help' => 'Whether the user has activated the job, or not',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'expires_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'category_id' => array(),
      'type' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'position' => array(),
      'location' => array(),
      'description' => array(),
      'how_to_apply' => array(),
      'token' => array(),
      'is_public' => array(),
      'is_activated' => array(),
      'email' => array(),
      'expires_at' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'category_id' => array(),
      'type' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'position' => array(),
      'location' => array(),
      'description' => array(),
      'how_to_apply' => array(),
      'token' => array(),
      'is_public' => array(),
      'is_activated' => array(),
      'email' => array(),
      'expires_at' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'category_id' => array(),
      'type' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'position' => array(),
      'location' => array(),
      'description' => array(),
      'how_to_apply' => array(),
      'token' => array(),
      'is_public' => array(),
      'is_activated' => array(),
      'email' => array(),
      'expires_at' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'category_id' => array(),
      'type' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'position' => array(),
      'location' => array(),
      'description' => array(),
      'how_to_apply' => array(),
      'token' => array(),
      'is_public' => array(),
      'is_activated' => array(),
      'email' => array(),
      'expires_at' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'category_id' => array(),
      'type' => array(),
      'company' => array(),
      'logo' => array(),
      'url' => array(),
      'position' => array(),
      'location' => array(),
      'description' => array(),
      'how_to_apply' => array(),
      'token' => array(),
      'is_public' => array(),
      'is_activated' => array(),
      'email' => array(),
      'expires_at' => array(),
      'created_at' => array(),
      'updated_at' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'BackendJobeetJobForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'JobeetjobFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 10;
  }

  public function getDefaultSort()
  {
    return array('expires_at', 'desc');
  }

  public function getTableMethod()
  {
    return 'retrieveBackendJobList';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
