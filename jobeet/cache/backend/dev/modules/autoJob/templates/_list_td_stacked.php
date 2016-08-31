<td colspan="6">
  <?php echo __('%%is_activated%% <small>%%jobeet_category%%</small> - %%company%%(<em>%%email%%</em>) is looking for a %%position%% (%%location%%))', array('%%is_activated%%' => get_partial('job/list_field_boolean', array('value' => $jobeetjob->getIsActivated())), '%%jobeet_category%%' => $jobeetjob->getJobeetCategory(), '%%company%%' => $jobeetjob->getCompany(), '%%email%%' => $jobeetjob->getEmail(), '%%position%%' => link_to($jobeetjob->getPosition(), 'jobeetjob_edit', $jobeetjob), '%%location%%' => $jobeetjob->getLocation()), 'messages') ?>
</td>
