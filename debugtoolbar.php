<?php

require_once 'debugtoolbar.civix.php';
use CRM_DebugToolbar_ExtensionUtil as E;
use DaviAlexandre\DebugToolbar\DependencyInjection\Compiler\ProfilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;

/**
 * Implements hook_civicrm_config().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_config
 */
function debugtoolbar_civicrm_config(&$config) {
  _debugtoolbar_civix_civicrm_config($config);
  $smarty = CRM_Core_Smarty::singleton();
  array_push($smarty->plugins_dir, __DIR__ . '/src/DaviAlexandre/DebugToolbar/Smarty/plugins');
  $profiler = Civi::container()->get('debug_toolbar.profiler');
}

/**
 * Implements hook_civicrm_xmlMenu().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_xmlMenu
 */
function debugtoolbar_civicrm_xmlMenu(&$files) {
  _debugtoolbar_civix_civicrm_xmlMenu($files);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_install
 */
function debugtoolbar_civicrm_install() {
  _debugtoolbar_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_postInstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_postInstall
 */
function debugtoolbar_civicrm_postInstall() {
  _debugtoolbar_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_uninstall
 */
function debugtoolbar_civicrm_uninstall() {
  _debugtoolbar_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_enable
 */
function debugtoolbar_civicrm_enable() {
  _debugtoolbar_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_disable
 */
function debugtoolbar_civicrm_disable() {
  _debugtoolbar_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_upgrade
 */
function debugtoolbar_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _debugtoolbar_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_managed
 */
function debugtoolbar_civicrm_managed(&$entities) {
  _debugtoolbar_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_caseTypes
 */
function debugtoolbar_civicrm_caseTypes(&$caseTypes) {
  _debugtoolbar_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_angularModules
 */
function debugtoolbar_civicrm_angularModules(&$angularModules) {
  _debugtoolbar_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link http://wiki.civicrm.org/confluence/display/CRMDOC/hook_civicrm_alterSettingsFolders
 */
function debugtoolbar_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _debugtoolbar_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

function debugtoolbar_civicrm_container(ContainerBuilder $container) {
  $loader = new XmlFileLoader($container, new FileLocator(__DIR__));
  $loader->load('config/services.xml');
  $container->addCompilerPass(new ProfilerPass());
}

function debugtoolbar_civicrm_pageRun($page) {
  if ($page instanceof \DaviAlexandre\DebugToolbar\Page\Toolbar) {
    return;
  }

  _debugtoolbar_civicrm_addResources();
}

function debugtoolbar_civicrm_buildForm($formName, $form) {
  _debugtoolbar_civicrm_addResources();
}

function _debugtoolbar_civicrm_addResources() {
  if(array_key_exists('snippet', $_REQUEST)) {
    return;
  }

  $profiler = Civi::container()->get('debug_toolbar.profiler');

  Civi::resources()
    ->addStyleFile(E::LONG_NAME, 'css/toolbar.css')
    ->addScriptFile(E::LONG_NAME, 'js/toolbar.js')
    ->addSetting([
      'debug_toolbar_profile_identifier' => $profiler->getProfileIdentifier()
    ]);
}
