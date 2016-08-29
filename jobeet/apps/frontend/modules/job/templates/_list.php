<table class="jobs">
	<?php foreach ($jobs as $job): ?>
		<tr>
			<td class="location">
				<?php echo $job->getLocation() ?>
			</td>
			<td class="position">
				<?php echo link_to($job->getPosition(), 'job_show_user', $job) ?>
			</td>
			<td class="company">
				<?php echo $job->getCompany() ?>
			</td>
		</tr>
	<?php endforeach; ?>
</table>