<?php

$selectAll = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1');
$selectAllSite = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1');

$selectV6 = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_VERSION = "v6"');
$selectV6Site = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_VERSION = "v6"');
 
$selectV7 = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_VERSION = "v7"');
$selectV7Site = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_VERSION = "v7"');
 
$selectV8 = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_VERSION = "v8"');
$selectV8Site = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_VERSION = "v8"');
 
$selectRis = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_RIS = 1 AND CLI_PACS = 0');
$selectRisSite = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_RIS = 1 AND CLI_PACS = 0');
 
$selectPacs = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_RIS = 0 AND CLI_PACS = 1');
$selectPacsSite = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_RIS = 0 AND CLI_PACS = 1');
 
$selectRisPacs = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_RIS = 1 AND CLI_PACS = 1');
$selectRisPacsSite = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_RIS = 1 AND CLI_PACS = 1');
 
$selectNone = $bdd->queryobj('SELECT count(*) as Nb FROM YDA_CLIENT WHERE CLI_VALID = 1 AND CLI_RIS = 0 AND CLI_PACS = 0');
$selectNoneSite = $bdd->queryobj('SELECT count(PHO_ID) as Nb FROM YDA_PHONE JOIN YDA_CLIENT ON CLI_ID = PHO_ID_CLI WHERE CLI_VALID = 1 AND PHO_VALID = 1 AND CLI_RIS = 0 AND CLI_PACS = 0');
 