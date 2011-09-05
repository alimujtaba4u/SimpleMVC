<?php start_slot('title'); ?>
<title>MVC Template System Owerview !</title>
<?php end_slot(); ?>
<h3>Content </h3>
<div>
    <?php echo $text; ?>
    <a href="<?php echo url_for('home/features'); ?>">Features</a>
</div>
<div style="float: left;width: 50%">
    <h3>Partials</h3>
    <?php include_partial('home/box',array('no' => 1)); ?>
    <?php include_partial('home/box',array('no' => 2)); ?>
</div>
<div style="float: left;width: 50%;direction: rtl">
    <h3>Components</h3>
    <?php include_component('home','box2',array('no' => 1)); ?>
    <?php include_component('home','box2',array('no' => 2)); ?>
</div>
<div style="clear: both;"></div>
<div>Soon i'll provide some more good examples !</div>
