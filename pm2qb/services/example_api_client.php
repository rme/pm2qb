<?php

/**
 * 
 * 
 * @package QuickBooks
 * @subpackage Documentation
 */

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

if (function_exists('date_default_timezone_set'))
{
	date_default_timezone_set('America/New_York');
}

ini_set('include_path', ini_get('include_path') . PATH_SEPARATOR . '/Users/keithpalmerjr/Projects/QuickBooks');

require_once 'QuickBooks.php';

//$user = 'api';
$user = 'quickbooks';
$source_type = QUICKBOOKS_API_SOURCE_WEB;
//$api_driver_dsn = 'mysql://root:123456y@localhost/quickbooks_api';
$api_driver_dsn = 'mysql://root:123456y@localhost/wf_workflow';
//$api_driver_dsn = 'pgsql://pgsql@localhost/quickbooks';
$source_dsn = 'http://quickbooks:password@localhost/qb/HSU/example_api_server.php';
$api_options = array();
$source_options = array();
$driver_options = array();

if (!QuickBooks_Utilities::initialized($api_driver_dsn))
{
	QuickBooks_Utilities::initialize($api_driver_dsn);
	QuickBooks_Utilities::createUser($api_driver_dsn, 'api', 'password');
}

$API = new QuickBooks_API($api_driver_dsn, $user, $source_type, $source_dsn, $api_options, $source_options, $driver_options);


$dac = $REQUEST["dac"];
$dam = $REQUEST["dam"];
$cac = $REQUEST["cac"];
$cam = $REQUEST["cam"];


//-------------------------------------------------------------------------------------------------------------------------------
// Journal entry
$JournalEntry = new QuickBooks_Object_JournalEntry();

$dDate = date("F d, Y");
//$JournalEntry->setTransactionDate('July 23, 2012');
$JournalEntry->setTransactionDate($dDate);

$DebitLine = new QuickBooks_Object_JournalEntry_JournalDebitLine();
//$DebitLine->setAccountName('Travel Expense');
//$JournalEntry->addDebitLine($DebitLine);
$DebitLine->setAccountName($dac);
$DebitLine->setAmount($dam);
$JournalEntry->addDebitLine($DebitLine);

$CreditLine = new QuickBooks_Object_JournalEntry_JournalCreditLine();
//$CreditLine->setAccountName('Bank Account XYZ');
//$JournalEntry->addCreditLine($CreditLine);
$CreditLine->setAccountName($cac);
$CreditLine->setAmount($cam);
$JournalEntry->addCreditLine($CreditLine);

if ($API->addJournalEntry(
	$JournalEntry, 
	'_quickbooks_ca_journalentry_add_callback'))
{
	print('Queued up an add journal entry request to QuickBooks!' . "\n");
}




