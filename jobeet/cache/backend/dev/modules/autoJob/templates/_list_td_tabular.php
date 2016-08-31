<td class="sf_admin_text sf_admin_list_td_id">
  <?php echo link_to($jobeetjob->getId(), 'jobeetjob_edit', $jobeetjob) ?>
</td>
<td class="sf_admin_foreignkey sf_admin_list_td_category_id">
  <?php echo $jobeetjob->getCategoryId() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_type">
  <?php echo $jobeetjob->getType() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_company">
  <?php echo $jobeetjob->getCompany() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_logo">
  <?php echo $jobeetjob->getLogo() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_url">
  <?php echo $jobeetjob->getUrl() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_position">
  <?php echo $jobeetjob->getPosition() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_location">
  <?php echo $jobeetjob->getLocation() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_description">
  <?php echo $jobeetjob->getDescription() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_how_to_apply">
  <?php echo $jobeetjob->getHowToApply() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_token">
  <?php echo $jobeetjob->getToken() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_public">
  <?php echo get_partial('job/list_field_boolean', array('value' => $jobeetjob->getIsPublic())) ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_activated">
  <?php echo get_partial('job/list_field_boolean', array('value' => $jobeetjob->getIsActivated())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $jobeetjob->getEmail() ?>
</td>
<td class="sf_admin_date sf_admin_list_td_expires_at">
  <?php echo false !== strtotime($jobeetjob->getExpiresAt()) ? format_date($jobeetjob->getExpiresAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_created_at">
  <?php echo false !== strtotime($jobeetjob->getCreatedAt()) ? format_date($jobeetjob->getCreatedAt(), "f") : '&nbsp;' ?>
</td>
<td class="sf_admin_date sf_admin_list_td_updated_at">
  <?php echo false !== strtotime($jobeetjob->getUpdatedAt()) ? format_date($jobeetjob->getUpdatedAt(), "f") : '&nbsp;' ?>
</td>
