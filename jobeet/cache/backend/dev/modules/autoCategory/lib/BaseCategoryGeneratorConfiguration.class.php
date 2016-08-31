<?php

/**
 * category module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage category
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCategoryGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%name%% - %%created_at%% - %%updated_at%% - %%slug%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Category List';
  }

  public function getEditTitle()
  {
    return 'Edit Category';
  }

  public function getNewTitle()
  {
    return 'New Category';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'name',  2 => 'created_at',  3 => 'updated_at',  4 => 'slug',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'slug' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'jobeet_affiliates_list' => array(  'is_link' => false,  'is_real' => false,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'name' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'slug' => array(),
      'jobeet_affiliates_list' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'name' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'slug' => array(),
      'jobeet_affiliates_list' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'name' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'slug' => array(),
      'jobeet_affiliates_list' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'name' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'slug' => array(),
      'jobeet_affiliates_list' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'name' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'slug' => array(),
      'jobeet_affiliates_list' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'JobeetCategoryForm';
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
    return 'JobeetCategoryFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfDoctrinePager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getTableMethod()
  {
    return '';
  }

  public function getTableCountMethod()
  {
    return '';
  }
}
