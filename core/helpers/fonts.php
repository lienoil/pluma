<?php

if (! function_exists('font_link_tags')) {
    /**
     * Gets the HTML link tags specified
     * in config/editor.php:`fonts.links`
     *
     * @param  array  $fonts
     * @return HTML|string
     */
    function font_link_tags($fonts = [])
    {
        $tags = config('editor.fonts.links', $fonts);
        return implode("\n\r", $tags);
    }
}
