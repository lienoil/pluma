<?php

function blacksmith_path($path)
{
    return realpath(__DIR__."/../$path");
}
