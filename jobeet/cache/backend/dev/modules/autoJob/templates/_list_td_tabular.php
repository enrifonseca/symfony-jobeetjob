<td class="sf_admin_text sf_admin_list_td_company">
  <?php echo $jobeetjob->getCompany() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_position">
  <?php echo link_to($jobeetjob->getPosition(), 'jobeetjob_edit', $jobeetjob) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_location">
  <?php echo $jobeetjob->getLocation() ?>
</td>
<td class="sf_admin_text sf_admin_list_td_url">
  <?php echo $jobeetjob->getUrl() ?>
</td>
<td class="sf_admin_boolean sf_admin_list_td_is_activated">
  <?php echo get_partial('job/list_field_boolean', array('value' => $jobeetjob->getIsActivated())) ?>
</td>
<td class="sf_admin_text sf_admin_list_td_email">
  <?php echo $jobeetjob->getEmail() ?>
</td>
