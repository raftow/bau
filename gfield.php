<?php
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Gfield extends AFWObject{
        public static $COMPTAGE_BEFORE_LOAD_MANY = true;
        
	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
		"id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),
		"parent_module_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "FK", 
                      "ANSWER" => "module", ANSMODULE => ums, "IMPORTANT"=>"CM", "WHERE"=>"id_module_type in (5,4)"),
		"titre_short" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true  , "UTF8" => true, "TYPE" => "TEXT"),
		"titre" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "UTF8" => true, "TYPE" => "TEXT"),
		
                "id_atable" => array("IMPORTANT" => "IN", "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "SEARCH" => false, "QEDIT" => false, "TYPE" => "FK", "ANSWER" => "atable", "SIZE" => 40, "DEFAULT" => 0),
                "atable_mfk" => array("TYPE"  => "MFK", ANSMODULE => pag , "ANSWER" => "atable", "SHOW" => true, "FORMAT"=>"", "RETRIEVE"=>false, "EDIT" => true, "QEDIT" => false, "WHERE"=>"id_module = 16 and real_table = 'N'"),
		"id_theme" => array("IMPORTANT" => "IN", "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "SEARCH" => false, "QEDIT" => false, "TYPE" => "FK", "ANSWER" => "theme", "SIZE" => 40, "DEFAULT" => 0),
                
                "gfield_type_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "FK", "ANSWER" => "gfield_type"),
		"gfield_cat_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "FK", "ANSWER" => "gfield_cat"),
                "gfield_aprio_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "TYPE" => "FK", "ANSWER" => "aprio"),
                
		"stakeholder1_id" => array("SHOW" => false, "RETRIEVE" => false, "EDIT" => false, TYPE => FK, ANSWER => orgunit, ANSMODULE => hrm, ),
		"stakeholder2_id" => array("SHOW" => false, "RETRIEVE" => false, "EDIT" => false, TYPE => FK, ANSWER => orgunit, ANSMODULE => hrm, ),
		"stakeholder_id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "QEDIT-ADMIN" => true, TYPE => FK, ANSWER => orgunit, ANSMODULE => hrm, ),
		"module_id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "QEDIT-ADMIN" => true, 
                                     "TYPE" => "FK", "ANSWER" => "module", ANSMODULE => ums, "IMPORTANT"=>"CM", 
                                     "WHERE"=>"id_module_type = 5 and (§stakeholder_id§ = 0 or id_main_sh=§stakeholder_id§ or id in (select id_module from module_orgunit where id_orgunit = §stakeholder_id§))"),  // ou bien parent de stakeholder_id aussi 
		"owner_id" => array("SHOW" => true, "SEARCH" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "QEDIT-ADMIN" => true, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums", "DISTINCT-FOR-LIST"=>true, "WHERE"=>"(§stakeholder_id§=0 or id_sh_div in (§stakeholder_id§, 33) or id_sh_dep in (select id_main_sh from module where id = §parent_module_id§))"), //
                "date_last_comm" => array("SHOW" => true, "SEARCH" => false, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "TYPE" => "DATE", "SHORTNAME"=>"sentdate"),
                "termcount" 	=> array("TYPE" => "INT", "CATEGORY" => "FORMULA", "SHOW"=>true, "RETRIEVE"=>true, ),
                "validtermcount" 	=> array("TYPE" => "INT", "CATEGORY" => "FORMULA", "SHOW"=>true, "RETRIEVE"=>true, ),

		"other_smo" => array("SHOW" => true, "SEARCH" => false, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => false, "TYPE" => "TEXT", "UTF8" => true, "SIZE" => "AREA", "ROWS"=>30,"COLS"=>200,"COLSPAN"=>3, "PRE"=>true),
		"gf_status" => array("TYPE" => "TEXT",  "EDIT" => false, "QEDIT" => false, "SHOW" => true, "RETRIEVE" => true, "SEARCH" => false, "CATEGORY" => "FORMULA"),
                

                
                
                "id_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"id_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
		"date_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"avail" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
		"version" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
		"update_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"delete_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"display_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "TYPE" => "MFK", "ANSMODULE" => "ums"),
		"sci_id" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item"),
                
                "comm_list" 	=> array("TYPE" => "FK", 	"ANSWER" => "comm", "CATEGORY" => "ITEMS", "ITEM" => "ident_record", "WHERE"=>"avail='Y' and id_atable = 6", "SHOW" => true, "UGROUPS"=>""),
                "terms" 	=> array("TYPE" => "FK", "ANSWER" => "gfield_term", "CATEGORY" => "ITEMS", "ITEM" => "gfield_id", "WHERE"=>"", "SHOW" => true, "ROLES"=>"", "FORMAT"=>"retrieve", "EDIT" => false),
	);
	
	*/ public function __construct($tablename="gfield"){
		parent::__construct($tablename,"id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 10;
                $this->DISPLAY_FIELD = "titre";
	}
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")
        {
           global $me, $objme;
           
             
             $otherLinksArray = array();   
             if($mode=="display")
             {
                           $parent_gfield_id = $this->getId();
                           $link = array();
                           $title = "المصطلحات ";
                           $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=GfieldTerm&currmod=pag&id_origin=$parent_gfield_id&class_origin=Gfield&module_origin=pag&newo=3&limit=30&ids=all&fixmtit=$title&fixmdisable=1&fixm=gfield_id=$parent_gfield_id&sel_gfield_id=$parent_gfield_id";
                           $link["TITLE"] = $title;
                           $link["UGROUPS"] = array();
                           $otherLinksArray[] = $link;  
             }
             return $otherLinksArray;          
        }
        
        public function getTermCount($only_defined=true)
        {
               $file_dir_name = dirname(__FILE__); 
               require_once("$file_dir_name/gfield_term.php");
               
               $af = new GfieldTerm();
               
               $af->select("gfield_id", $this->getId());
               $af->select("avail", 'Y');
               if($only_defined) $af->select("term_definition_valid", 'Y');
               
               return $af->count();
               
        }
        
        public function getFormuleResult($attribute, $what='value') 
        {
	       switch($attribute) 
               {
                    case "validtermcount" :
                        $fn = $this->getTermCount(true);
                        
			return $fn;
		    break;
                    case "termcount" :
                        $fn = $this->getTermCount(false);
                        
			return $fn;
		    break;
        
                    case "gf_status" :
                        $gf_status_label = array();
                        $gf_status_label[5] = "تمت";
                        $gf_status_label[21] = "انتظار";
                        $gf_status_label[22] = "جاهزة";
                        $gf_status_label[58] = "يدويا";
                        if($this->getVal("module_id")<=0) return "";
                        $gf_status = "";
                        $id_module_parent = 58;//$this->get("module_id")->getVal("id_module_parent");
                        $gf_status = "<img src='../lib/images/gfp_$id_module_parent.png' style='width: 16px !important; height: 16px !important;'>".$gf_status_label[$id_module_parent];
                        
			return $gf_status;
		    break;


               }
        }
        
}
?>