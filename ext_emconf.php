<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "myflat".
 *
 * Auto generated 01-11-2022 19:03
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'MyFlat',
  'description' => 'Flat manager, shows bookings of holiday flats in calendars, availability check included.',
  'category' => 'plugin',
  'version' => '1.0.5',
  'state' => 'beta',
  'uploadfolder' => true,
  'clearcacheonload' => false,
  'author' => 'Joachim Ruhs',
  'author_email' => 'postmaster@joachim-ruhs.de',
  'author_company' => NULL,
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '11.4.0-12.5.99',
//      'vhs' => '6.0.5',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
);

