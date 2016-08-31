<?xml version="1.0" encoding="utf-8"?>
<feed xmlns="http://www.w3.org/2005/Atom">
	<title>Jobeet</title>
	<subtitle>Latest Jobs</subtitle>
	<link href="<?php echo url_for('job', array('sf_format' => 'atom'), true) ?>" rel="self"/>
	<link href="<?php echo url_for('homepage', true) ?>"/>
	<updated>
		<?php echo gmstrftime(
			'%Y-%m-%dT%H:%M:%SZ',
			Doctrine_Core::getTable('JobeetJob')->getLastestPost()->getDataTimeObject('created_at')->format('U')
		) ?>
	</updated>
	<author>
		<name>Jobeet</name>
	</author>
	<id>
		<?php echo sha1(url_for('job', array('sf_format' => 'atom'), true)) ?>
	</id>

	<?php use_helper('Text') ?>
	<?php foreach ($categories as $category): ?>
		<?php foreach ($category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')) as $job): ?>
			<entry>
				<title>
					<?php echo $job->getPosition() ?> (<?php echo $job->getLocation() ?>)
				</title>
				<link href="<?php echo url_for('job_show_user', $job, true) ?>" />
				<id><?php echo sha1($job->getId()) ?></id>
				<updated><?php echo gmstrftime('%Y-%m-%dT%H:%M:%SZ', $job->getDateTimeObject('created_at')->format('U')) ?></updated>
				<summary type="xhtml">
					<div xmlns="http://www.w3.org/1999/xhtml">
						<?php if ($job->getLogo()): ?>
							<div>
								<a href="<?php echo $job->getUrl() ?>">
									<img src="http://<?php echo $sf_request->getHost().'/uploads/jobs/'.$job->getLogo() ?>" alt="<?php echo $job->getCompany() ?> logo" />
								</a>
							</div>
						<?php endif ?>
						
						<div><?php echo simple_format_text($job->getDescription()) ?></div>

						<h4>How to apply?</h4>
						<p><?php echo $job->getHowToApply() ?></p>
					</div>
				</summary>
				<author>
					<name><?php echo $job->getCompany() ?></name>
				</author>
			</entry>
		<?php endforeach ?>
	<?php endforeach ?>
</feed>