<?php

/***************************************************************
 * Extension Manager/Repository config file for ext "myflat".
 *
 * Auto generated 27-07-2021 10:15
 *
 * Manual updates:
 * Only the data in the array - everything else is removed by next
 * writing. "version" and "dependencies" must not be touched!
 ***************************************************************/

$EM_CONF[$_EXTKEY] = array (
  'title' => 'MyFlat',
  'description' => 'Flat manager, shows bookings of holiday flats in calendars, availability check included.',
  'category' => 'plugin',
  'author' => 'Joachim Ruhs',
  'author_email' => 'postmaster@joachim-ruhs.de',
  'state' => 'beta',
  'uploadfolder' => true,
  'clearCacheOnLoad' => 0,
  'version' => '0.7.5',
  'constraints' => 
  array (
    'depends' => 
    array (
      'typo3' => '10.4.18-11.5.99',
      'vhs' => '6.0.5',
    ),
    'conflicts' => 
    array (
    ),
    'suggests' => 
    array (
    ),
  ),
  'clearcacheonload' => false,
  'author_company' => NULL,
);

