<?php
/**
 * class.pm2qb.php
 *  
 */

  class pm2qbClass extends PMPlugin {
    function __construct() {
      set_include_path(
        PATH_PLUGINS . 'pm2qb' . PATH_SEPARATOR .
        get_include_path()
      );
    }

    function setup()
    {
    }

    function getFieldsForPageSetup()
    {
    }

    function updateFieldsForPageSetup()
    {
    }

  }
?>