<td colspan="2">
  <?php echo __('%%name%% - %%slug%%', array('%%name%%' => link_to($jobeet_category->getName(), 'jobeet_category_edit', $jobeet_category), '%%slug%%' => $jobeet_category->getSlug()), 'messages') ?>
</td>
