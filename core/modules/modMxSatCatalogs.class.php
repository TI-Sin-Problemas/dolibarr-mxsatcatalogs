<?php
/* Copyright (C) 2004-2018  Laurent Destailleur     <eldy@users.sourceforge.net>
 * Copyright (C) 2018-2019  Nicolas ZABOURI         <info@inovea-conseil.com>
 * Copyright (C) 2019-2020  Frédéric France         <frederic.france@netlogic.fr>
 * Copyright (C) 2024 Alfredo Altamirano <alfredo.altamirano@tisinproblemas.com>
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <https://www.gnu.org/licenses/>.
 */

/**
 * 	\defgroup   mxsatcatalogs     Module MxSatCatalogs
 *  \brief      MxSatCatalogs module descriptor.
 *
 *  \file       htdocs/mxsatcatalogs/core/modules/modMxSatCatalogs.class.php
 *  \ingroup    mxsatcatalogs
 *  \brief      Description and activation file for module MxSatCatalogs
 */
include_once DOL_DOCUMENT_ROOT . '/core/modules/DolibarrModules.class.php';

/**
 *  Description and activation class for module MxSatCatalogs
 */
class modMxSatCatalogs extends DolibarrModules
{
	/**
	 * Constructor. Define names, constants, directories, boxes, permissions
	 *
	 * @param DoliDB $db Database handler
	 */
	public function __construct($db)
	{
		global $langs, $conf;
		$this->db = $db;

		// Id for module (must be unique).
		// Use here a free id (See in Home -> System information -> Dolibarr for list of used modules id).
		$this->numero = 181000; // TODO Go on page https://wiki.dolibarr.org/index.php/List_of_modules_id to reserve an id number for your module

		// Key text used to identify module (for permissions, menus, etc...)
		$this->rights_class = 'mxsatcatalogs';

		// Family can be 'base' (core modules),'crm','financial','hr','projects','products','ecm','technic' (transverse modules),'interface' (link with external tools),'other','...'
		// It is used to group modules by family in module setup page
		$this->family = "other";

		// Module position in the family on 2 digits ('01', '10', '20', ...)
		$this->module_position = '90';

		// Gives the possibility for the module, to provide his own family info and position of this family (Overwrite $this->family and $this->module_position. Avoid this)
		//$this->familyinfo = array('myownfamily' => array('position' => '01', 'label' => $langs->trans("MyOwnFamily")));
		// Module label (no space allowed), used if translation string 'ModuleMxSatCatalogsName' not found (MxSatCatalogs is name of module).
		$this->name = preg_replace('/^mod/i', '', get_class($this));

		// Module description, used if translation string 'ModuleMxSatCatalogsDesc' not found (MxSatCatalogs is name of module).
		$this->description = 'Dolibarr module to add Mexican SAT Catalogs as dictionaries';
		// Used only if file README.md and README-LL.md not found.
		$this->descriptionlong = "MxSatCatalogsDescription";

		// Author
		$this->editor_name = 'TI Sin Problemas';
		$this->editor_url = 'https://tisinproblemas.com';

		// Possible values for version are: 'development', 'experimental', 'dolibarr', 'dolibarr_deprecated', 'experimental_deprecated' or a version string like 'x.y.z'
		$this->version = '1.1.0';
		// Url to the file with your last numberversion of this module
		$this->url_last_version = 'https://raw.githubusercontent.com/TI-Sin-Problemas/dolibarr-mxsatcatalogs/main/latest_version.txt';

		// Key used in llx_const table to save module status enabled/disabled (where MXSATCATALOGS is value of property name of module in uppercase)
		$this->const_name = 'MAIN_MODULE_' . strtoupper($this->name);

		// Name of image file used for this module.
		// If file is in theme/yourtheme/img directory under name object_pictovalue.png, use this->picto='pictovalue'
		// If file is in module/img directory under name object_pictovalue.png, use this->picto='pictovalue@module'
		// To use a supported fa-xxx css style of font awesome, use this->picto='xxx'
		$this->picto = 'fa-book-open';

		// Define some features supported by module (triggers, login, substitutions, menus, css, etc...)
		$this->module_parts = array(
			// Set this to 1 if module has its own trigger directory (core/triggers)
			'triggers' => 0,
			// Set this to 1 if module has its own login method file (core/login)
			'login' => 0,
			// Set this to 1 if module has its own substitution function file (core/substitutions)
			'substitutions' => 0,
			// Set this to 1 if module has its own menus handler directory (core/menus)
			'menus' => 0,
			// Set this to 1 if module overwrite template dir (core/tpl)
			'tpl' => 0,
			// Set this to 1 if module has its own barcode directory (core/modules/barcode)
			'barcode' => 0,
			// Set this to 1 if module has its own models directory (core/modules/xxx)
			'models' => 0,
			// Set this to 1 if module has its own printing directory (core/modules/printing)
			'printing' => 0,
			// Set this to 1 if module has its own theme directory (theme)
			'theme' => 0,
			// Set this to relative path of css file if module has its own css file
			'css' => array(
				//    '/mxsatcatalogs/css/mxsatcatalogs.css.php',
			),
			// Set this to relative path of js file if module must load a js on all pages
			'js' => array(
				//   '/mxsatcatalogs/js/mxsatcatalogs.js.php',
			),
			// Set here all hooks context managed by module. To find available hook context, make a "grep -r '>initHooks(' *" on source code. You can also set hook context to 'all'
			'hooks' => array(
				//   'data' => array(
				//       'hookcontext1',
				//       'hookcontext2',
				//   ),
				//   'entity' => '0',
			),
			// Set this to 1 if features of module are opened to external users
			'moduleforexternal' => 0,
		);

		// Data directories to create when module is enabled.
		// Example: this->dirs = array("/mxsatcatalogs/temp","/mxsatcatalogs/subdir");
		$this->dirs = array("/mxsatcatalogs/temp");

		// Config pages. Put here list of php page, stored into mxsatcatalogs/admin directory, to use to setup module.
		$this->config_page_url = array("setup.php@mxsatcatalogs");

		// Dependencies
		// A condition to hide module
		$this->hidden = false;
		// List of module class names that must be enabled if this module is enabled. Example: array('always'=>array('modModuleToEnable1','modModuleToEnable2'), 'FR'=>array('modModuleToEnableFR')...)
		$this->depends = array();
		// List of module class names to disable if this one is disabled. Example: array('modModuleToDisable1', ...)
		$this->requiredby = array();
		// List of module class names this module is in conflict with. Example: array('modModuleToDisable1', ...)
		$this->conflictwith = array();

		// The language file dedicated to your module
		$this->langfiles = array("mxsatcatalogs@mxsatcatalogs");

		// Prerequisites
		$this->phpmin = array(8, 2); // Minimum version of PHP required by module
		$this->need_dolibarr_version = array(19, -3); // Minimum version of Dolibarr required by module
		$this->need_javascript_ajax = 0;

		// Messages at activation
		$this->warnings_activation = array(); // Warning to show when we activate module. array('always'='text') or array('FR'='textfr','MX'='textmx'...)
		$this->warnings_activation_ext = array(); // Warning to show when we activate an external module. array('always'='text') or array('FR'='textfr','MX'='textmx'...)
		//$this->automatic_activation = array('FR'=>'MxSatCatalogsWasAutomaticallyActivatedBecauseOfYourCountryChoice');
		//$this->always_enabled = true;								// If true, can't be disabled

		// Constants
		// List of particular constants to add when module is enabled (key, 'chaine', value, desc, visible, 'current' or 'allentities', deleteonunactive)
		// Example: $this->const=array(1 => array('MXSATCATALOGS_MYNEWCONST1', 'chaine', 'myvalue', 'This is a constant to add', 1),
		//                             2 => array('MXSATCATALOGS_MYNEWCONST2', 'chaine', 'myvalue', 'This is another constant to add', 0, 'current', 1)
		// );
		$this->const = array();

		// Some keys to add into the overwriting translation tables
		/*$this->overwrite_translation = array(
			'en_US:ParentCompany'=>'Parent company or reseller',
			'fr_FR:ParentCompany'=>'Maison mère ou revendeur'
		)*/

		if (!isModEnabled("mxsatcatalogs")) {
			$conf->mxsatcatalogs = new stdClass();
			$conf->mxsatcatalogs->enabled = 0;
		}

		// Array to add new pages in new tabs
		$this->tabs = array();
		// Example:
		// $this->tabs[] = array('data'=>'objecttype:+tabname1:Title1:mylangfile@mxsatcatalogs:$user->hasRight('mxsatcatalogs', 'read'):/mxsatcatalogs/mynewtab1.php?id=__ID__');  					// To add a new tab identified by code tabname1
		// $this->tabs[] = array('data'=>'objecttype:+tabname2:SUBSTITUTION_Title2:mylangfile@mxsatcatalogs:$user->hasRight('othermodule', 'read'):/mxsatcatalogs/mynewtab2.php?id=__ID__',  	// To add another new tab identified by code tabname2. Label will be result of calling all substitution functions on 'Title2' key.
		// $this->tabs[] = array('data'=>'objecttype:-tabname:NU:conditiontoremove');                                                     										// To remove an existing tab identified by code tabname
		//
		// Where objecttype can be
		// 'categories_x'	  to add a tab in category view (replace 'x' by type of category (0=product, 1=supplier, 2=customer, 3=member)
		// 'contact'          to add a tab in contact view
		// 'contract'         to add a tab in contract view
		// 'group'            to add a tab in group view
		// 'intervention'     to add a tab in intervention view
		// 'invoice'          to add a tab in customer invoice view
		// 'invoice_supplier' to add a tab in supplier invoice view
		// 'member'           to add a tab in fundation member view
		// 'opensurveypoll'	  to add a tab in opensurvey poll view
		// 'order'            to add a tab in sale order view
		// 'order_supplier'   to add a tab in supplier order view
		// 'payment'		  to add a tab in payment view
		// 'payment_supplier' to add a tab in supplier payment view
		// 'product'          to add a tab in product view
		// 'propal'           to add a tab in propal view
		// 'project'          to add a tab in project view
		// 'stock'            to add a tab in stock view
		// 'thirdparty'       to add a tab in third party view
		// 'user'             to add a tab in user view

		// Dictionaries
		/* BEGIN MODULEBUILDER DICTIONARIES */
		$this->dictionaries = array(
			'langs' => 'mxsatcatalogs@mxsatcatalogs',
			// List of tables we want to see into dictonnary editor
			'tabname' => array(
				'c_mxsatcatalogs_payment_methods',
				'c_mxsatcatalogs_payment_options',
				'c_mxsatcatalogs_products_services',
				'c_mxsatcatalogs_units_of_measure'
			),
			// Label of tables
			'tablib' => array(
				'MxSatCatalogsPaymentMethods',
				'MxSatCatalogsPaymentOptions',
				'MxSatCatalogsProductsServices',
				'MxSatCatalogsUnitsOfMeasure'
			),
			// Request to select fields
			'tabsql' => array(
				'SELECT t.rowid as rowid, t.code, t.label, t.active FROM llx_c_mxsatcatalogs_payment_methods as t',
				'SELECT t.rowid as rowid, t.code, t.label, t.active FROM llx_c_mxsatcatalogs_payment_options as t',
				'SELECT t.rowid as rowid, t.code, t.label, t.active FROM llx_c_mxsatcatalogs_products_services as t',
				'SELECT t.rowid as rowid, t.code, t.label, t.description, t.symbol, t.active FROM llx_c_mxsatcatalogs_units_of_measure as t'
			),
			// Sort order
			'tabsqlsort' => array(
				'label ASC',
				'label ASC',
				'code ASC',
				'label ASC'
			),
			// List of fields (result of select to show dictionary)
			'tabfield' => array(
				'code,label',
				'code,label',
				'code,label',
				'code,label,description,symbol'
			),
			// List of fields (list of fields to edit a record)
			'tabfieldvalue' => array(
				'code,label',
				'code,label',
				'code,label',
				'code,label,description,symbol'
			),
			// List of fields (list of fields for insert)
			'tabfieldinsert' => array(
				'code,label',
				'code,label',
				'code,label',
				'code,label,description,symbol'
			),
			// Name of columns with primary key (try to always name it 'rowid')
			'tabrowid' => array(
				'rowid',
				'rowid',
				'rowid',
				'rowid'
			),
			// Condition to show each dictionary
			'tabcond' => array(
				isModEnabled('mxsatcatalogs'),
				isModEnabled('mxsatcatalogs'),
				isModEnabled('mxsatcatalogs'),
				isModEnabled('mxsatcatalogs')
			),
			// Tooltip for every fields of dictionaries: DO NOT PUT AN EMPTY ARRAY
			'tabhelp' => array(
				array('code' => $langs->trans('MxSatCatalogsPaymentMethodsCodeTooltipHelp')),
				array('code' => $langs->trans('MxSatCatalogsPaymentOptionsCodeTooltipHelp')),
				array('code' => $langs->trans('MxSatCatalogsProductsServicesCodeTooltipHelp')),
				array('code' => $langs->trans('MxSatCatalogsUnitsOfMeasureCodeTooltipHelp'))
			),
		);
		/* END MODULEBUILDER DICTIONARIES */

		// Boxes/Widgets
		// Add here list of php file(s) stored in mxsatcatalogs/core/boxes that contains a class to show a widget.
		/* BEGIN MODULEBUILDER WIDGETS */
		$this->boxes = array(
			//  0 => array(
			//      'file' => 'mxsatcatalogswidget1.php@mxsatcatalogs',
			//      'note' => 'Widget provided by MxSatCatalogs',
			//      'enabledbydefaulton' => 'Home',
			//  ),
			//  ...
		);
		/* END MODULEBUILDER WIDGETS */

		// Cronjobs (List of cron jobs entries to add when module is enabled)
		// unit_frequency must be 60 for minute, 3600 for hour, 86400 for day, 604800 for week
		/* BEGIN MODULEBUILDER CRON */
		$this->cronjobs = array(
			//  0 => array(
			//      'label' => 'MyJob label',
			//      'jobtype' => 'method',
			//      'class' => '/mxsatcatalogs/class/myobject.class.php',
			//      'objectname' => 'MyObject',
			//      'method' => 'doScheduledJob',
			//      'parameters' => '',
			//      'comment' => 'Comment',
			//      'frequency' => 2,
			//      'unitfrequency' => 3600,
			//      'status' => 0,
			//      'test' => 'isModEnabled("mxsatcatalogs")',
			//      'priority' => 50,
			//  ),
		);
		/* END MODULEBUILDER CRON */
		// Example: $this->cronjobs=array(
		//    0=>array('label'=>'My label', 'jobtype'=>'method', 'class'=>'/dir/class/file.class.php', 'objectname'=>'MyClass', 'method'=>'myMethod', 'parameters'=>'param1, param2', 'comment'=>'Comment', 'frequency'=>2, 'unitfrequency'=>3600, 'status'=>0, 'test'=>'isModEnabled("mxsatcatalogs")', 'priority'=>50),
		//    1=>array('label'=>'My label', 'jobtype'=>'command', 'command'=>'', 'parameters'=>'param1, param2', 'comment'=>'Comment', 'frequency'=>1, 'unitfrequency'=>3600*24, 'status'=>0, 'test'=>'isModEnabled("mxsatcatalogs")', 'priority'=>50)
		// );

		// Permissions provided by this module
		$this->rights = array();
		$r = 0;
		// Add here entries to declare new permissions
		/* BEGIN MODULEBUILDER PERMISSIONS */
		/*
		$o = 1;
		$this->rights[$r][0] = $this->numero . sprintf("%02d", ($o * 10) + 1); // Permission id (must not be already used)
		$this->rights[$r][1] = 'Read objects of MxSatCatalogs'; // Permission label
		$this->rights[$r][4] = 'myobject';
		$this->rights[$r][5] = 'read'; // In php code, permission will be checked by test if ($user->hasRight('mxsatcatalogs', 'myobject', 'read'))
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf("%02d", ($o * 10) + 2); // Permission id (must not be already used)
		$this->rights[$r][1] = 'Create/Update objects of MxSatCatalogs'; // Permission label
		$this->rights[$r][4] = 'myobject';
		$this->rights[$r][5] = 'write'; // In php code, permission will be checked by test if ($user->hasRight('mxsatcatalogs', 'myobject', 'write'))
		$r++;
		$this->rights[$r][0] = $this->numero . sprintf("%02d", ($o * 10) + 3); // Permission id (must not be already used)
		$this->rights[$r][1] = 'Delete objects of MxSatCatalogs'; // Permission label
		$this->rights[$r][4] = 'myobject';
		$this->rights[$r][5] = 'delete'; // In php code, permission will be checked by test if ($user->hasRight('mxsatcatalogs', 'myobject', 'delete'))
		$r++;
		*/
		/* END MODULEBUILDER PERMISSIONS */

		// Main menu entries to add
		$this->menu = array();
		$r = 0;
		// Add here entries to declare new menus
		/* BEGIN MODULEBUILDER TOPMENU */
		$this->menu[$r++] = array(
			'fk_menu' => '', // '' if this is a top menu. For left menu, use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode
			'type' => 'top', // This is a Top menu entry
			'titre' => 'ModuleMxSatCatalogsName',
			'prefix' => img_picto('', $this->picto, 'class="pictofixedwidth valignmiddle"'),
			'mainmenu' => 'mxsatcatalogs',
			'leftmenu' => '',
			'url' => '/mxsatcatalogs/mxsatcatalogsindex.php',
			'langs' => 'mxsatcatalogs@mxsatcatalogs', // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
			'position' => 1000 + $r,
			'enabled' => 'false', // Define condition to show or hide menu entry. Use 'isModEnabled("mxsatcatalogs")' if entry must be visible if module is enabled.
			'perms' => '1', // Use 'perms'=>'$user->hasRight("mxsatcatalogs", "myobject", "read")' if you want your menu with a permission rules
			'target' => '',
			'user' => 2, // 0=Menu for internal users, 1=external users, 2=both
		);
		/* END MODULEBUILDER TOPMENU */
		/* BEGIN MODULEBUILDER LEFTMENU MYOBJECT */
		/*$this->menu[$r++]=array(
			'fk_menu'=>'fk_mainmenu=mxsatcatalogs',      // '' if this is a top menu. For left menu, use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode
			'type'=>'left',                          // This is a Left menu entry
			'titre'=>'MyObject',
			'prefix' => img_picto('', $this->picto, 'class="pictofixedwidth valignmiddle paddingright"'),
			'mainmenu'=>'mxsatcatalogs',
			'leftmenu'=>'myobject',
			'url'=>'/mxsatcatalogs/mxsatcatalogsindex.php',
			'langs'=>'mxsatcatalogs@mxsatcatalogs',	        // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
			'position'=>1000+$r,
			'enabled'=>'isModEnabled("mxsatcatalogs")', // Define condition to show or hide menu entry. Use 'isModEnabled("mxsatcatalogs")' if entry must be visible if module is enabled.
			'perms'=>'$user->hasRight("mxsatcatalogs", "myobject", "read")',
			'target'=>'',
			'user'=>2,				                // 0=Menu for internal users, 1=external users, 2=both
		);
		$this->menu[$r++]=array(
			'fk_menu'=>'fk_mainmenu=mxsatcatalogs,fk_leftmenu=myobject',	    // '' if this is a top menu. For left menu, use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode
			'type'=>'left',			                // This is a Left menu entry
			'titre'=>'List_MyObject',
			'mainmenu'=>'mxsatcatalogs',
			'leftmenu'=>'mxsatcatalogs_myobject_list',
			'url'=>'/mxsatcatalogs/myobject_list.php',
			'langs'=>'mxsatcatalogs@mxsatcatalogs',	        // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
			'position'=>1000+$r,
			'enabled'=>'isModEnabled("mxsatcatalogs")', // Define condition to show or hide menu entry. Use 'isModEnabled("mxsatcatalogs")' if entry must be visible if module is enabled.
			'perms'=>'$user->hasRight("mxsatcatalogs", "myobject", "read")'
			'target'=>'',
			'user'=>2,				                // 0=Menu for internal users, 1=external users, 2=both
		);
		$this->menu[$r++]=array(
			'fk_menu'=>'fk_mainmenu=mxsatcatalogs,fk_leftmenu=myobject',	    // '' if this is a top menu. For left menu, use 'fk_mainmenu=xxx' or 'fk_mainmenu=xxx,fk_leftmenu=yyy' where xxx is mainmenucode and yyy is a leftmenucode
			'type'=>'left',			                // This is a Left menu entry
			'titre'=>'New_MyObject',
			'mainmenu'=>'mxsatcatalogs',
			'leftmenu'=>'mxsatcatalogs_myobject_new',
			'url'=>'/mxsatcatalogs/myobject_card.php?action=create',
			'langs'=>'mxsatcatalogs@mxsatcatalogs',	        // Lang file to use (without .lang) by module. File must be in langs/code_CODE/ directory.
			'position'=>1000+$r,
			'enabled'=>'isModEnabled("mxsatcatalogs")', // Define condition to show or hide menu entry. Use 'isModEnabled("mxsatcatalogs")' if entry must be visible if module is enabled. Use '$leftmenu==\'system\'' to show if leftmenu system is selected.
			'perms'=>'$user->hasRight("mxsatcatalogs", "myobject", "write")'
			'target'=>'',
			'user'=>2,				                // 0=Menu for internal users, 1=external users, 2=both
		);*/
		/* END MODULEBUILDER LEFTMENU MYOBJECT */
		// Exports profiles provided by this module
		$r = 1;
		/* BEGIN MODULEBUILDER EXPORT MYOBJECT */
		/*
		$langs->load("mxsatcatalogs@mxsatcatalogs");
		$this->export_code[$r]=$this->rights_class.'_'.$r;
		$this->export_label[$r]='MyObjectLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
		$this->export_icon[$r]='myobject@mxsatcatalogs';
		// Define $this->export_fields_array, $this->export_TypeFields_array and $this->export_entities_array
		$keyforclass = 'MyObject'; $keyforclassfile='/mxsatcatalogs/class/myobject.class.php'; $keyforelement='myobject@mxsatcatalogs';
		include DOL_DOCUMENT_ROOT.'/core/commonfieldsinexport.inc.php';
		//$this->export_fields_array[$r]['t.fieldtoadd']='FieldToAdd'; $this->export_TypeFields_array[$r]['t.fieldtoadd']='Text';
		//unset($this->export_fields_array[$r]['t.fieldtoremove']);
		//$keyforclass = 'MyObjectLine'; $keyforclassfile='/mxsatcatalogs/class/myobject.class.php'; $keyforelement='myobjectline@mxsatcatalogs'; $keyforalias='tl';
		//include DOL_DOCUMENT_ROOT.'/core/commonfieldsinexport.inc.php';
		$keyforselect='myobject'; $keyforaliasextra='extra'; $keyforelement='myobject@mxsatcatalogs';
		include DOL_DOCUMENT_ROOT.'/core/extrafieldsinexport.inc.php';
		//$keyforselect='myobjectline'; $keyforaliasextra='extraline'; $keyforelement='myobjectline@mxsatcatalogs';
		//include DOL_DOCUMENT_ROOT.'/core/extrafieldsinexport.inc.php';
		//$this->export_dependencies_array[$r] = array('myobjectline'=>array('tl.rowid','tl.ref')); // To force to activate one or several fields if we select some fields that need same (like to select a unique key if we ask a field of a child to avoid the DISTINCT to discard them, or for computed field than need several other fields)
		//$this->export_special_array[$r] = array('t.field'=>'...');
		//$this->export_examplevalues_array[$r] = array('t.field'=>'Example');
		//$this->export_help_array[$r] = array('t.field'=>'FieldDescHelp');
		$this->export_sql_start[$r]='SELECT DISTINCT ';
		$this->export_sql_end[$r]  =' FROM '.MAIN_DB_PREFIX.'myobject as t';
		//$this->export_sql_end[$r]  =' LEFT JOIN '.MAIN_DB_PREFIX.'myobject_line as tl ON tl.fk_myobject = t.rowid';
		$this->export_sql_end[$r] .=' WHERE 1 = 1';
		$this->export_sql_end[$r] .=' AND t.entity IN ('.getEntity('myobject').')';
		$r++; */
		/* END MODULEBUILDER EXPORT MYOBJECT */

		// Imports profiles provided by this module
		$r = 1;
		/* BEGIN MODULEBUILDER IMPORT MYOBJECT */
		/*
		$langs->load("mxsatcatalogs@mxsatcatalogs");
		$this->import_code[$r]=$this->rights_class.'_'.$r;
		$this->import_label[$r]='MyObjectLines';	// Translation key (used only if key ExportDataset_xxx_z not found)
		$this->import_icon[$r]='myobject@mxsatcatalogs';
		$this->import_tables_array[$r] = array('t' => MAIN_DB_PREFIX.'mxsatcatalogs_myobject', 'extra' => MAIN_DB_PREFIX.'mxsatcatalogs_myobject_extrafields');
		$this->import_tables_creator_array[$r] = array('t' => 'fk_user_author'); // Fields to store import user id
		$import_sample = array();
		$keyforclass = 'MyObject'; $keyforclassfile='/mxsatcatalogs/class/myobject.class.php'; $keyforelement='myobject@mxsatcatalogs';
		include DOL_DOCUMENT_ROOT.'/core/commonfieldsinimport.inc.php';
		$import_extrafield_sample = array();
		$keyforselect='myobject'; $keyforaliasextra='extra'; $keyforelement='myobject@mxsatcatalogs';
		include DOL_DOCUMENT_ROOT.'/core/extrafieldsinimport.inc.php';
		$this->import_fieldshidden_array[$r] = array('extra.fk_object' => 'lastrowid-'.MAIN_DB_PREFIX.'mxsatcatalogs_myobject');
		$this->import_regex_array[$r] = array();
		$this->import_examplevalues_array[$r] = array_merge($import_sample, $import_extrafield_sample);
		$this->import_updatekeys_array[$r] = array('t.ref' => 'Ref');
		$this->import_convertvalue_array[$r] = array(
			't.ref' => array(
				'rule'=>'getrefifauto',
				'class'=>(!getDolGlobalString('MXSATCATALOGS_MYOBJECT_ADDON') ? 'mod_myobject_standard' : getDolGlobalString('MXSATCATALOGS_MYOBJECT_ADDON')),
				'path'=>"/core/modules/commande/".(!getDolGlobalString('MXSATCATALOGS_MYOBJECT_ADDON') ? 'mod_myobject_standard' : getDolGlobalString('MXSATCATALOGS_MYOBJECT_ADDON')).'.php'
				'classobject'=>'MyObject',
				'pathobject'=>'/mxsatcatalogs/class/myobject.class.php',
			),
			't.fk_soc' => array('rule' => 'fetchidfromref', 'file' => '/societe/class/societe.class.php', 'class' => 'Societe', 'method' => 'fetch', 'element' => 'ThirdParty'),
			't.fk_user_valid' => array('rule' => 'fetchidfromref', 'file' => '/user/class/user.class.php', 'class' => 'User', 'method' => 'fetch', 'element' => 'user'),
			't.fk_mode_reglement' => array('rule' => 'fetchidfromcodeorlabel', 'file' => '/compta/paiement/class/cpaiement.class.php', 'class' => 'Cpaiement', 'method' => 'fetch', 'element' => 'cpayment'),
		);
		$this->import_run_sql_after_array[$r] = array();
		$r++; */
		/* END MODULEBUILDER IMPORT MYOBJECT */
	}

	/**
	 *  Function called when module is enabled.
	 *  The init function add constants, boxes, permissions and menus (defined in constructor) into Dolibarr database.
	 *  It also creates data directories
	 *
	 *  @param      string  $options    Options when enabling module ('', 'noboxes')
	 *  @return     int             	1 if OK, 0 if KO
	 */
	public function init($options = '')
	{
		global $conf, $langs;

		//$result = $this->_load_tables('/install/mysql/', 'mxsatcatalogs');
		$result = $this->_load_tables('/mxsatcatalogs/sql/');
		if ($result < 0) {
			return -1; // Do not activate module if error 'not allowed' returned when loading module SQL queries (the _load_table run sql with run_sql with the error allowed parameter set to 'default')
		}

		// Create extrafields during init
		include_once DOL_DOCUMENT_ROOT . '/core/class/extrafields.class.php';
		$extrafields = new ExtraFields($this->db);
		$paymentMethodExtraField = $extrafields->addExtraField('mxsatcatalogs_payment_method', 'PaymentMethod', 'sellist', $this->numero, 2, 'facture', 0, 1, '', array('options' => array('c_mxsatcatalogs_payment_methods:label:code::active=1' => null)), 0, '', -1, 'PaymentMethodTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);
		$paymentOptionExtraField = $extrafields->addExtraField('mxsatcatalogs_payment_option', 'PaymentOption', 'sellist', $this->numero, 3, 'facture', 0, 1, '', array('options' => array('c_mxsatcatalogs_payment_options:label:code::active=1' => null)), 0, '', -1, 'PaymentOptionTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);
		$productServiceExtraField = $extrafields->addExtraField('mxsatcatalogs_product_service', 'ProductService', 'sellist', $this->numero, 8, 'product', 0, 1, '', array('options' => array('c_mxsatcatalogs_products_services:label:code::active=1' => null)), 0, '', -1, 'ProductServiceTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);
		$productServiceLineExtraField = $extrafields->addExtraField('mxsatcatalogs_product_service', 'ProductService', 'sellist', $this->numero, 8, 'facturedet', 0, 1, '', array('options' => array('c_mxsatcatalogs_products_services:label:code::active=1' => null)), 0, '', -1, 'ProductServiceTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);
		$unitOfMeasureExtraField = $extrafields->addExtraField('mxsatcatalogs_unit_of_measure', 'UnitOfMeasure', 'sellist', $this->numero, 3, 'product', 0, 1, '', array('options' => array('c_mxsatcatalogs_units_of_measure:label:code::active=1' => null)), 0, '', -1, 'UnitOfMeasureTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);
		$unitOfMeasureLineExtraField = $extrafields->addExtraField('mxsatcatalogs_unit_of_measure', 'UnitOfMeasure', 'sellist', $this->numero, 3, 'facturedet', 0, 1, '', array('options' => array('c_mxsatcatalogs_units_of_measure:label:code::active=1' => null)), 0, '', -1, 'UnitOfMeasureTooltip', '', '', 'mxsatcatalogs@mxsatcatalogs', 'isModEnabled("mxsatcatalogs")', 0, 1);

		// Permissions
		// $this->remove($options);

		$sql = array();

		// Document templates
		$moduledir = dol_sanitizeFileName('mxsatcatalogs');
		$myTmpObjects = array();
		$myTmpObjects['MyObject'] = array('includerefgeneration' => 0, 'includedocgeneration' => 0);

		foreach ($myTmpObjects as $myTmpObjectKey => $myTmpObjectArray) {
			if ($myTmpObjectKey == 'MyObject') {
				continue;
			}
			if ($myTmpObjectArray['includerefgeneration']) {
				$src = DOL_DOCUMENT_ROOT . '/install/doctemplates/' . $moduledir . '/template_myobjects.odt';
				$dirodt = DOL_DATA_ROOT . '/doctemplates/' . $moduledir;
				$dest = $dirodt . '/template_myobjects.odt';

				if (file_exists($src) && !file_exists($dest)) {
					require_once DOL_DOCUMENT_ROOT . '/core/lib/files.lib.php';
					dol_mkdir($dirodt);
					$result = dol_copy($src, $dest, 0, 0);
					if ($result < 0) {
						$langs->load("errors");
						$this->error = $langs->trans('ErrorFailToCopyFile', $src, $dest);
						return 0;
					}
				}

				$sql = array_merge($sql, array(
					"DELETE FROM " . MAIN_DB_PREFIX . "document_model WHERE nom = 'standard_" . strtolower($myTmpObjectKey) . "' AND type = '" . $this->db->escape(strtolower($myTmpObjectKey)) . "' AND entity = " . ((int) $conf->entity),
					"INSERT INTO " . MAIN_DB_PREFIX . "document_model (nom, type, entity) VALUES('standard_" . strtolower($myTmpObjectKey) . "', '" . $this->db->escape(strtolower($myTmpObjectKey)) . "', " . ((int) $conf->entity) . ")",
					"DELETE FROM " . MAIN_DB_PREFIX . "document_model WHERE nom = 'generic_" . strtolower($myTmpObjectKey) . "_odt' AND type = '" . $this->db->escape(strtolower($myTmpObjectKey)) . "' AND entity = " . ((int) $conf->entity),
					"INSERT INTO " . MAIN_DB_PREFIX . "document_model (nom, type, entity) VALUES('generic_" . strtolower($myTmpObjectKey) . "_odt', '" . $this->db->escape(strtolower($myTmpObjectKey)) . "', " . ((int) $conf->entity) . ")"
				));
			}
		}

		return $this->_init($sql, $options);
	}

	/**
	 *  Function called when module is disabled.
	 *  Remove from database constants, boxes and permissions from Dolibarr database.
	 *  Data directories are not deleted
	 *
	 *  @param      string	$options    Options when enabling module ('', 'noboxes')
	 *  @return     int                 1 if OK, 0 if KO
	 */
	public function remove($options = '')
	{
		$sql = array(
			'DROP TABLE ' . MAIN_DB_PREFIX . 'c_mxsatcatalogs_payment_methods',
			'DROP TABLE ' . MAIN_DB_PREFIX . 'c_mxsatcatalogs_payment_options',
			'DROP TABLE ' . MAIN_DB_PREFIX . 'c_mxsatcatalogs_products_services',
			'DROP TABLE ' . MAIN_DB_PREFIX . 'c_mxsatcatalogs_units_of_measure'
		);
		return $this->_remove($sql, $options);
	}
}
