<?php

header("Content-type: application/tgz");
header("Content-disposition: attachment; filename=cmswiki.tgz");

passthru("tar cvf - pages | gzip -c");

?>
