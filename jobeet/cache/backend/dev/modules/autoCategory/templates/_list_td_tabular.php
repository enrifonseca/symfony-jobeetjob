<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($jobeet_category->getId(), 'jobeet_category_edit', $jobeet_category) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_name">
  <?php echo $jobeet_category->getName() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($jobeet_category->getCreatedAt()) ? format_date($jobeet_category->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($jobeet_category->getUpdatedAt()) ? format_date($jobeet_category->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_text sf_admin_list_td_slug">
  <?php echo $jobeet_category->getSlug() ?>
</td>
