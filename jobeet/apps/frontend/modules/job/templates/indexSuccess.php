<?php use_stylesheet('jobs.css') ?>

<?php
slot(
  'title',
  'Jobeet Test - Enri'
)
?>

<h1>Jobeet jobs List</h1>

<div id="jobs">
  <?php foreach ($categories as $category): ?>
    <div class="category <?php echo Jobeet::slugify($category->getname()) ?>">
      <div class="category">
        <div class="feed">
          <a href="">Feed</a>
        </div>
        <h1>
          <?php echo link_to($category, 'category', $category) ?>
        </h1>
      </div>
      
      <?php include_partial('job/list', array('jobs' => $category->getActiveJobs(sfConfig::get('app_max_jobs_on_homepage')))); ?>

      <?php if (($count = $category->countActiveJobs() -
          sfConfig::get('app_max_jobs_on_homepage')) > 0): ?>
        <div class="more_jobs">
          and <?php echo link_to($count, 'category', $category) ?>
          more...
        </div>
      <?php endif; ?>

    </div>
  <?php endforeach; ?>
</div>