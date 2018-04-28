<?php
if (! function_exists('lb_view')) {
    /**
     * Shortcut for generating view path with theme.
     *
     * @param  string  $view
     * @return string
     */
    function lb_view($view)
    {
        return config('letsblog.app.theme') . '.' . $view;
    }
}
