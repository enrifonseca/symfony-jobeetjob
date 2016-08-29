<?php use_stylesheet('jobs.css') ?>

<?php
slot(
  'title',
  'Jobeet Test - Enri'
)
?>

<h1>Jobeet jobs List</h1>

<table class="list">
  <thead>
    <tr>
      <th>Position</th>
      <th>Company</th>
      <th>Location</th>
      <th>Go!</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($jobs as $job): ?>
    <tr>
      <td><?php echo $job->getPosition() ?></td>
      <td><?php echo $job->getCompany() ?></td>
      <td>
        <?php echo $job->getLocation() ?>
      </td>
      <td>
        <!--<a href="<?php echo url_for(
          'job/show?id='.$job->getId().
          '&company=' .$job->getCompany().
          '&location=' .$job->getLocation().
          '&position=' .$job->getPosition()
        ) ?>">
          Ejemplo de link #1
        </a>-->

        <!--<a href="<?php echo url_for(array(
          'module'    =>  'job',
          'action'    =>  'show',
          'id'        =>  $job->getId(),
          'company'   =>  $job->getCompany(),
          'location'  =>  $job->getLocation(),
          'position'  =>  $job->getPosition()
        )) ?>">
          Ejemplo de link #2
        </a>-->

        <!--<a href="<?php echo url_for(array(
          'sf_route'    =>  'job_show_user',
          'sf_subject'  =>  $job
        )) ?>">
          Ejemplo de link #3
        </a>-->

        <!--<a href="<?php echo url_for('job_show_user', $job) ?>">
          Go this job!
        </a>-->

        <!-- otro ejemplo -->
        <!-- pasando como 4 parametro true genera la url absoluta -->
        <?php echo link_to('Go this job!', 'job_show_user', $job) ?>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<!--<a class="btn pull-right" href="<?php echo url_for('job/new') ?>">
  New
</a>-->