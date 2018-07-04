<?php

/**
 * casehistory short summary.
 *
 * casehistory description.
 *
 * @version 1.0
 * @author MoronO
 */
class PluginProcessmakerCasehistory extends CommonDBTM {
   static function displayTabContentForItem(CommonGLPI $case, $tabnum=1, $withtemplate=0) {
      global $CFG_GLPI, $PM_SOAP;

      $config = $PM_SOAP->config;
      $rand = rand();

      $proj = new PluginProcessmakerProcess;
      $proj->getFromDB($case->fields['plugin_processmaker_processes_id']);

      $caseHistoryURL = $PM_SOAP->serverURL
         ."/cases/ajaxListener?action=caseHistory&rand=$rand&glpi_domain={$config->fields['domain']}&GLPI_APP_UID={$case->fields['case_guid']}&GLPI_PRO_UID={$proj->fields['process_guid']}";

      echo "<script type='text/javascript' src='".$CFG_GLPI["root_doc"]."/plugins/processmaker/js/cases.js'></script>"; 

      echo "<iframe id='caseiframe-caseHistory' style='border: none;' width='100%' src='$caseHistoryURL'
            onload=\"onOtherFrameLoad( 'caseHistory', 'caseiframe-caseHistory', 'body', 0 );\"></iframe>";
   }

   function getTabNameForItem(CommonGLPI $case, $withtemplate = 0){
      global $LANG;
      return $LANG['processmaker']['item']['case']['viewcasehistory'];
   }
}