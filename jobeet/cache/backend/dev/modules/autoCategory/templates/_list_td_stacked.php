<td colspan="5">
  <?php echo __('%%id%% - %%name%% - %%created_at%% - %%updated_at%% - %%slug%%', array('%%id%%' => link_to($jobeet_category->getId(), 'jobeet_category_edit', $jobeet_category), '%%name%%' => $jobeet_category->getName(), '%%created_at%%' => false !== strtotime($jobeet_category->getCreatedAt()) ? format_date($jobeet_category->getCreatedAt(), "f") : '&nbsp;', '%%updated_at%%' => false !== strtotime($jobeet_category->getUpdatedAt()) ? format_date($jobeet_category->getUpdatedAt(), "f") : '&nbsp;', '%%slug%%' => $jobeet_category->getSlug()), 'messages') ?>
</td>
