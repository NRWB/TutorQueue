<?php

/**
 * HUGE project
 * @description User auth web service solution framework.
 *
 * @link https://github.com/panique/huge
 * @license http://opensource.org/licenses/MIT MIT License
 */

/**
 * Auto loads the classes.
 * Currently only from applications or libraries with tool
 * 'Composer' PSR-4 automatic loader.
 * @TODO Create namespace.
 */
require '../vendor/autoload.php';

// Start Application
new Application();
