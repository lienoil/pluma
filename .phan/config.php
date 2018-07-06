<?php

/**
 * This configuration will be read and overlaid on top of the
 * default configuration. Command line arguments will be applied
 * after this file is read.
 *
 * Taken from https://github.com/phan/phan/wiki/Getting-Started#creating-a-config-file
 */
return [
    // Supported values: '7.0', '7.1', '7.2', null.
    // If this is set to null,
    // then Phan assumes the PHP version which is closest to the minor version
    // of the php executable used to execute phan.
    // TODO: Set this.
    'target_php_version' => null,

    // Backwards Compatibility Checking. This is slow
    // and expensive, but you should consider running
    // it before upgrading your version of PHP to a
    // new version that has backward compatibility
    // breaks. (Also see target_php_version)
    'backward_compatibility_checks' => false,

    // If true, this run a quick version of checks that takes less
    // time at the cost of not running as thorough
    // an analysis. You should consider setting this
    // to true only when you wish you had more **undiagnosed** issues
    // to fix in your code base.
    'quick_mode' => true,

    // A list of directories that should be parsed for class and
    // method information. After excluding the directories
    // defined in exclude_analysis_directory_list, the remaining
    // files will be statically analyzed for errors.
    //
    // Thus, both first-party and third-party code being used by
    // your application should be included in this list.
    'directory_list' => [
        'bootstrap',
        'config',
        'console',
        'core',
        'database',
        'modules',
        'src',
        'tests',
        'themes',
        'vendor/',
    ],

    // A directory list that defines files that will be excluded
    // from static analysis, but whose class and method
    // information should be included.
    //
    // Generally, you'll want to include the directories for
    // third-party code (such as "vendor/") in this list.
    //
    // n.b.: If you'd like to parse but not analyze 3rd
    //       party code, directories containing that code
    //       should be added to both the `directory_list`
    //       and `exclude_analysis_directory_list` arrays.
    "exclude_analysis_directory_list" => [
        'vendor/',
        'storage/',
        'docs/',
    ],
];
