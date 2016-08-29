<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<form action="..." ...>
<?php if (!$form->getObject()->isNew()): ?>
  <input type="hidden" name="sf_method" value="PUT" />
<?php endif; ?>
 
<?php echo link_to(
  'Delete',
  'job/delete?id='.$form->getObject()->getId(),
  array('method' => 'delete', 'confirm' => 'Are you sure?')
) ?>