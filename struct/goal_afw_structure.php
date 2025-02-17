<?php
class BauGoalAfwStructure
{
	public static $DB_STRUCTURE = array(


		'id' => array(
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => false,
			'TYPE' => 'PK',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'domain_id' => array(
			'FGROUP' => 'prop',
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'TYPE' => 'FK',
			'ANSWER' => 'domain',
			'ANSMODULE' => 'pag',
			'RELATION' => 'OneToMany',
			'WHERE' => "",
			'QEDIT' => true,
			'MANDATORY' => true,
			'SIZE' => 40,
			'DEPENDENT_OFME' => array(
				0 => 'module_id',
				1 => 'jobrole_id',
			),
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'goal_code' => array(
			'FGROUP' => 'prop',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 40,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'MANDATORY' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'SHORTNAME' => 'code',
			'CHAR_TEMPLATE' => 'LOOKUP_CODE',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'goal_type_id' => array(
			'FGROUP' => 'prop',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 40,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'goal_type',
			'ANSMODULE' => 'bau',
			'MANDATORY' => true,
			'SHORTNAME' => 'type',
			'DEPENDENT_OFME' => array(
				0 => 'parent_goal_id',
			),
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'system_id' => array(
			'FGROUP' => 'prop',
			'IMPORTANT' => 'IN',
			'SEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'SIZE' => 40,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'module',
			'ANSMODULE' => 'ums',
			'MANDATORY' => true,
			'WHERE' => "id_module_type in (4,7) ",
			'QEDIT' => true,
			'SHORTNAME' => 'system',
			'SEARCH-BY-ONE' => true,
			'DEPENDENT_OFME' => array(
				0 => 'module_id',
			),
			'DEFAUT' => 1,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'module_id' => array(
			'FGROUP' => 'prop',
			'IMPORTANT' => 'IN',
			'SEARCH' => false,
			'SHOW' => true,
			'MANDATORY' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'SIZE' => 40,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'module',
			'ANSMODULE' => 'ums',
			'RELATION' => 'OneToMany',
			//'WHERE' => "id_pm = §domain_id§ and id_module_type = 5 and id_system = §system_id§",

			'DEPENDENCIES' => array(0 => 'domain_id', 1 => 'system_id',),
			'DEPENDENT_OFME' => array(0 => 'parent_goal_id',),
			'QEDIT' => true,
			'SHORTNAME' => 'module',
			'SEARCH-BY-ONE' => true,
			'DEFAUT' => 0,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'parent_goal_id' => array(
			'FGROUP' => 'prop',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 40,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'goal',
			'ANSMODULE' => 'bau',
			'WHERE' => "module_id = §module_id§ and id != '§id§' and goal_type_id < §goal_type_id§",

			'DEPENDENCIES' => array(
				0 => 'module_id',
				1 => 'goal_type_id',
			),
			'DEFAUT' => 0,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'jobrole_id' => array(
			'FGROUP' => 'prop',
			'IMPORTANT' => 'IN',
			'SEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 40,
			'UTF8' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'jobrole',
			'ANSMODULE' => 'pag',
			'MANDATORY' => true,
			'SHORTNAME' => 'resp',
			'WHERE' => "id_domain in (1,§domain_id§)",

			'DEPENDENCIES' => array(
				0 => 'domain_id',
			),
			'RELATION' => 'OneToMany',
			'DEFAUT' => 0,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'atable_mfk' => array(
			'FGROUP' => 'prop',
			'SHORTNAME' => 'tables',
			'SEARCH' => false,
			'QSEARCH' => false,
			'SHOW' => true,
			'RETRIEVE' => true,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 40,
			'MANDATORY' => true,
			'UTF8' => false,
			'AUTOCOMPLETE' => true,
			'WHERE' => "id_module = §module_id§ and is_entity='Y' and avail = 'Y'",

			'DEPENDENCIES' => array(
				0 => 'module_id',
			),
			'TYPE' => 'MFK',
			'ANSWER' => 'atable',
			'ANSMODULE' => 'pag',
			'SEARCH-BY-ONE' => false,
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'avail' => array(
			'FGROUP' => 'prop',
			'SHOW-ADMIN' => true,
			'RETRIEVE' => false,
			'EDIT' => true,
			'DEFAUT' => 'Y',
			'QEDIT' => true,
			'TYPE' => 'YN',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => '',
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_name_ar' => array(
			'FGROUP' => 'text',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE-AR' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 64,
			'MIN-SIZE' => 6,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'CHAR_TEMPLATE' => 'TEXT_AR',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_name_en' => array(
			'FGROUP' => 'text',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE-EN' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 64,
			'MIN-SIZE' => 6,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'CHAR_TEMPLATE' => 'TEXT_EN',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_desc_ar' => array(
			'FGROUP' => 'text',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE-AR' => false,
			'EDIT' => true,
			'QEDIT' => true,
			'SIZE' => 196,
			'MIN-SIZE' => 16,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'UTF8' => true,
			'TYPE' => 'TEXT',
			'CHAR_TEMPLATE' => 'ALL',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_desc_en' => array(
			'FGROUP' => 'text',
			'IMPORTANT' => 'IN',
			'SEARCH' => true,
			'SHOW' => true,
			'RETRIEVE-EN' => false,
			'EDIT' => true,
			'QEDIT' => false,
			'SIZE' => 196,
			'MIN-SIZE' => 16,
			'SEARCH-ADMIN' => true,
			'SHOW-ADMIN' => true,
			'EDIT-ADMIN' => true,
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'CHAR_TEMPLATE' => 'ALL',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_html_ar' => array(
			'FGROUP' => 'text',
			'SHOW' => true,
			'RETRIEVE-AR' => true,
			'SIZE' => 'AREA',
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'CATEGORY' => 'FORMULA',
			'PHP_FORMULA' => 'paragraph.goal_name_ar.goal_desc_ar',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goal_html_en' => array(
			'FGROUP' => 'text',
			'SHOW' => true,
			'RETRIEVE-EN' => true,
			'SIZE' => 'AREA',
			'UTF8' => false,
			'TYPE' => 'TEXT',
			'CATEGORY' => 'FORMULA',
			'PHP_FORMULA' => 'paragraph.goal_name_en.goal_desc_en',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'STEP' => 1,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'goalConcernList' => array(
			'STEP' => 2,
			'TYPE' => 'FK',
			'ANSWER' => 'goal_concern',
			'ANSMODULE' => 'bau',
			'CATEGORY' => 'ITEMS',
			'ITEM' => 'goal_id',
			'WHERE' => "",
			'SHOW' => true,
			'FORMAT' => 'retrieve',
			'EDIT' => false,
			'ICONS' => true,
			'DELETE-ICON' => true,
			'BUTTONS' => true,
			'NO-LABEL' => false,
			'MANDATORY' => true,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
			'ERROR-CHECK' => true,
		),

		'goalList' => array(
			'STEP' => 2,
			'TYPE' => 'FK',
			'ANSWER' => 'goal',
			'ANSMODULE' => 'bau',
			'CATEGORY' => 'ITEMS',
			'ITEM' => 'parent_goal_id',
			'WHERE' => "",
			'SHOW' => true,
			'FORMAT' => 'retrieve',
			'EDIT' => false,
			'ICONS' => true,
			'DELETE-ICON' => false,
			'BUTTONS' => true,
			'NO-LABEL' => false,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'jobroleList' => array(
			'STEP' => 2,
			'TYPE' => 'MFK',
			'ANSWER' => 'jobrole',
			'ANSMODULE' => 'pag',
			'CATEGORY' => 'FORMULA',
			'SHOW' => true,
			'RETRIEVE' => false,
			'EDIT' => false,
			'QEDIT' => false,
			'READONLY' => true,
			'PHP_FORMULA' => 'list_extract.goalConcernList.jobrole_id.',
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'userStoryList' => array(
			'STEP' => 3,
			'TYPE' => 'FK',
			'ANSWER' => 'user_story',
			'ANSMODULE' => 'bau',
			'CATEGORY' => 'ITEMS',
			'ITEM' => 'user_story_goal_id',
			'WHERE' => "",
			'SHOW' => true,
			'FORMAT' => 'retrieve',
			'EDIT' => false,
			'ICONS' => true,
			'DELETE-ICON' => false,
			'BUTTONS' => true,
			'NO-LABEL' => false,
			'SEARCH-BY-ONE' => '',
			'DISPLAY' => true,
			'DISPLAY-UGROUPS' => '',
			'EDIT-UGROUPS' => '',
		),

		'id_aut'         => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'date_aut'            => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'id_mod'           => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'date_mod'              => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'TECH_FIELDS-RETRIEVE' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		'id_valid'       => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'FK',
			'ANSWER' => 'auser',
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'date_valid'          => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'GDAT',
			'FGROUP' => 'tech_fields'
		),

		/* 'avail'                   => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
                                                                'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),*/

		'version'                  => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'INT',
			'FGROUP' => 'tech_fields'
		),

		// 'draft'                         => array('STEP' => 99, 'HIDE_IF_NEW' => true, 'SHOW' => true, 'RETRIEVE' => false, 'EDIT' => false, 
		//                                        'QEDIT' => false, "DEFAULT" => 'Y', 'TYPE' => 'YN', 'FGROUP' => 'tech_fields'),

		'update_groups_mfk'             => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'delete_groups_mfk'             => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'display_groups_mfk'            => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'ANSWER' => 'ugroup',
			'ANSMODULE' => 'ums',
			'TYPE' => 'MFK',
			'FGROUP' => 'tech_fields'
		),

		'sci_id'                        => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'SHOW' => true,
			'RETRIEVE' => false,
			'QEDIT' => false,
			'TYPE' => 'INT', /*stepnum-not-the-object*/
			'ANSMODULE' => 'ums',
			'FGROUP' => 'tech_fields'
		),

		'tech_notes' 	                => array(
			'STEP' => 99,
			'HIDE_IF_NEW' => true,
			'TYPE' => 'TEXT',
			'CATEGORY' => 'FORMULA',
			"SHOW-ADMIN" => true,
			'TOKEN_SEP' => "§",
			'READONLY' => true,
			"NO-ERROR-CHECK" => true,
			'FGROUP' => 'tech_fields'
		),
	);
}
