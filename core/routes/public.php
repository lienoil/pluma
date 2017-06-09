<?php

Route::get('{slug?}', function ($slug)
{
    return $slug;
})