
<?php
    /* para ma automatic na ang active na link based sa route */
    function is_path_match(String $path)
    {
        return (request()->is($path)) ? 'active-link' : 'inactive-link';
    }
?>