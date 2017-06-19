<?php

// Get array of submodules, if any.
$submodules = submodules("Pluma", true);

include_files($submodules, "routes/api.php");