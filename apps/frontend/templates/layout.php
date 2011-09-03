<html>
    <head>
        <?php include_javascript('test.js'); ?>
        <?php include_stylesheet('test.css'); ?>
    </head>
    <body>
        <h3>Body</h3>
       
        <?php include_partial('global/header'); ?>
        
        <div class="content">
            <?php echo $content; ?>
        </div>
        
        <?php include_partial('global/footer'); ?>
    </body>
</html>