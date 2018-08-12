
<?php
  require 'Database.php';
   
  $db = new Database('yoda');

foreach($db->query('SELECT * FROM YDA_CLIENT') as $config):?>

<h2><?=$config->CLI_NOM?></h2>



<?php endforeach; ?>

