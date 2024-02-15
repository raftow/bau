<?php
// ------------------------------------------------------------------------------------
// 6/7/2021 :
//  ALTER TABLE `goal` CHANGE `atable_mfk` `atable_mfk` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT ','; 
// ------------------------------------------------------------------------------------

                
$file_dir_name = dirname(__FILE__); 
                
// old include of afw.php

class Goal extends AFWObject{

        // lookup Value List codes 
                
        // ADMINISTRATIONGOAL - هدف إدارة  
        public static $GOAL_TYPE_ADMINISTRATION_GOAL = 1; 
 
        // COMMONADMINISTRATIONGOAL - هدف إدارة مشترك  
        public static $GOAL_TYPE_COMMON_ADMINISTRATION_GOAL = 2; 
 
        // JOBRESPONSIBILITYGOAL - هدف مسؤولية وظيفية  
        public static $GOAL_TYPE_JOB_RESPONSIBILITY_GOAL = 3;
        

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
                id => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => false, "TYPE" => "PK"),

                domain_id => array(FGROUP=>prop, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "FK", "ANSWER" => "domain", "ANSMODULE" => "pag", 
                                  RELATION => OneToMany, "WHERE"=>"", "QEDIT" => true,  MANDATORY=>true, "SIZE" => 40, 
                                  DEPENDENT_OFME=>array("module_id", "jobrole_id", ),
                                  ), 

                goal_code => array(FGROUP=>prop, "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40, "SEARCH-ADMIN" => true, 
                                     "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "MANDATORY" => true, "UTF8" => true, "TYPE" => "TEXT",
                                     SHORTNAME=>code, CHAR_TEMPLATE=>"LOOKUP_CODE"),
		
		goal_type_id => array(FGROUP=>prop, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, "SIZE" => 40,
                                         "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => false, 
                                         TYPE => FK, ANSWER => goal_type, ANSMODULE => bau, MANDATORY=>true, SHORTNAME=>"type",
                                         DEPENDENT_OFME=>array("parent_goal_id", ),  
                                         ),
                                         
                system_id => array(FGROUP=>prop, "IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "SIZE" => 40, "UTF8" => false, 
                                      "TYPE" => "FK", "ANSWER" => module, "ANSMODULE" => ums, MANDATORY=>true, 
                                      WHERE => "id_module_type in (4,7) ",  //and ('§CONTEXT_ID§'='' or id = '§CONTEXT_ID§')
                                      QEDIT=>false, QEDIT_FGROUP => false, "SHORTNAME"=>"system", "SEARCH-BY-ONE"=>true,
                                      DEPENDENT_OFME=>array("module_id", ),
                                      "DEFAULT" => 1),

		module_id => array(FGROUP=>prop, "IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "SIZE" => 40, "UTF8" => false, 
                                      "TYPE" => "FK", "ANSWER" => module, "ANSMODULE" => ums, RELATION => OneToMany, MANDATORY=>true, 
                                      WHERE => "id_pm = §domain_id§ and id_module_type = 5 and ((§system_id§='' and id_system = '§CONTEXT_ID§') or (id_system = §system_id§))",
                                      DEPENDENCIES=>array("domain_id","system_id"), 
                                      DEPENDENT_OFME=>array("parent_goal_id", ),  
                                      QEDIT=>false, QEDIT_FGROUP => false, "SHORTNAME"=>"module", "SEARCH-BY-ONE"=>true,
                                      "DEFAULT" => 0),

                parent_goal_id => array(FGROUP=>prop, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE" => false, 
                                         EDIT => true, QEDIT => false, SIZE => 40, "UTF8" => false, 
                                         TYPE => FK, ANSWER => goal, ANSMODULE => bau, 
                                         WHERE =>"module_id = §module_id§ and id != '§id§' and goal_type_id < §goal_type_id§",
                                         DEPENDENCIES=>array("module_id","goal_type_id"),  
                                         "DEFAULT" => 0),
                

                jobrole_id => array(FGROUP=>prop, "IMPORTANT" => "IN", "SEARCH" => false, "SHOW" => true, "RETRIEVE" => true, 
                                       "EDIT" => true, "QEDIT" => false, "SIZE" => 40, "UTF8" => false, 
                                       "TYPE" => "FK", "ANSWER" => jobrole, "ANSMODULE" => pag,  MANDATORY=>true, SHORTNAME=>"resp",
                                       WHERE => "id_domain in (1,§domain_id§)",
                                       DEPENDENCIES=>array("domain_id",), 
                                       RELATION => OneToMany, 
                                       "DEFAULT" => 0),

		atable_mfk => array(FGROUP=>prop, SHORTNAME => tables, "SEARCH" => false, "QSEARCH" => false, "SHOW" => true, 
                                         RETRIEVE => true, EDIT => true, QEDIT => false, SIZE => 40, MANDATORY => true, UTF8 => false, 
                                         AUTOCOMPLETE=>true, WHERE=>"id_module = §module_id§ and is_entity='Y' and avail = 'Y'",
                                         DEPENDENCIES=>array("module_id",),
                                         TYPE => MFK, ANSWER => atable, "ANSMODULE" => pag),

                avail => array(FGROUP=>prop, "SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => true, "DEFAULT" => "Y", QEDIT=>true, "TYPE" => "YN"),
                
		goal_name_ar => array(FGROUP=>text, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE-AR" => false, "EDIT" => true, "QEDIT" => true , "SIZE" => 64 , "MIN-SIZE" => 6 , "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => true, "TYPE" => "TEXT", CHAR_TEMPLATE=>"TEXT_AR"),
		goal_name_en => array(FGROUP=>text, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE-EN" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 64 , "MIN-SIZE" => 6 , "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => false, "TYPE" => "TEXT", CHAR_TEMPLATE=>"TEXT_EN"),
		goal_desc_ar => array(FGROUP=>text, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE-AR" => false, "EDIT" => true, "QEDIT" => true, "SIZE" => 196, "MIN-SIZE" => 16, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => true, "TYPE" => "TEXT", CHAR_TEMPLATE=>"ALL"),
		goal_desc_en => array(FGROUP=>text, "IMPORTANT" => "IN", "SEARCH" => true, "SHOW" => true, "RETRIEVE-EN" => false, "EDIT" => true, "QEDIT" => false, "SIZE" => 196, "MIN-SIZE" => 16, "SEARCH-ADMIN" => true, "SHOW-ADMIN" => true, "EDIT-ADMIN" => true, "UTF8" => false, "TYPE" => "TEXT", CHAR_TEMPLATE=>"ALL"),
                
                goal_html_ar => array(FGROUP=>text, "SHOW" => true, "RETRIEVE-AR" => true,  "SIZE" => "AREA", "UTF8" => false, 
                                    "TYPE" => "TEXT", CATEGORY => "FORMULA", "PHP_FORMULA"=>"paragraph.goal_name_ar.goal_desc_ar", ),
                goal_html_en => array(FGROUP=>text, "SHOW" => true, "RETRIEVE-EN" => true,  "SIZE" => "AREA", "UTF8" => false, 
                                    "TYPE" => "TEXT", CATEGORY => "FORMULA", "PHP_FORMULA"=>"paragraph.goal_name_en.goal_desc_en", ),


                goalConcernList => array(STEP=>2,TYPE => FK, ANSWER => goal_concern, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'goal_id', WHERE=>'', SHOW => true, FORMAT=>retrieve, EDIT => false, ICONS=>true, 'DELETE-ICON'=>true, BUTTONS=>true, "NO-LABEL"=>false, MANDATORY => true),
                

                goalList => array(STEP=>2,TYPE => FK, ANSWER => goal, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'parent_goal_id', WHERE=>'', SHOW => true, FORMAT=>retrieve, EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, BUTTONS=>true, "NO-LABEL"=>false),
                
                {*
                orgunitList 	   => array(TYPE => MFK, ANSWER => orgunit, ANSMODULE => bau, CATEGORY => "FORMULA", "SHOW" => true, "RETRIEVE"=>false, "EDIT" => true, "QEDIT" => false, "READONLY"=>true, 
                                             "PHP_FORMULA"=>"list_extract.goalConcernList.orgunit_id.", ),
                                             
                jobsddList 	   => array(TYPE => MFK, ANSWER => jobsdd, ANSMODULE => bau, CATEGORY => "FORMULA", "SHOW" => true, "RETRIEVE"=>false, "EDIT" => true, "QEDIT" => false, "READONLY"=>true, 
                                             "PHP_FORMULA"=>"list_extract.goalConcernList.jobsdd_id.", ),
                *}                            
                
                jobroleList 	   => array(STEP=>2,TYPE => MFK, ANSWER => jobrole, ANSMODULE => pag, CATEGORY => "FORMULA", "SHOW" => true, "RETRIEVE"=>false, "EDIT" => false, "QEDIT" => false, "READONLY"=>true, 
                                             "PHP_FORMULA"=>"list_extract.goalConcernList.jobrole_id.", ),                                                          

                userStoryList => array(STEP=>3,TYPE => FK, ANSWER => user_story, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'user_story_goal_id', WHERE=>'', SHOW => true, FORMAT=>retrieve, EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, BUTTONS=>true, "NO-LABEL"=>false),
                
                

                id_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_aut => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_mod => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                id_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "auser", "ANSMODULE" => "ums"),
                date_valid => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
                version => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
                update_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                delete_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                display_groups_mfk => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
                sci_id => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "FK", "ANSWER" => "scenario_item", "ANSMODULE" => "pag"),
                tech_notes 	    => array(TYPE => TEXT, CATEGORY => FORMULA, "SHOW-ADMIN" => true, 'STEP' =>"all", TOKEN_SEP=>"§", READONLY=>true, "NO-ERROR-CHECK"=>true),
	);
	
	*/ public function __construct(){
		parent::__construct("goal","id","bau");
                $this->QEDIT_MODE_NEW_OBJECTS_DEFAULT_NUMBER = 15;
                $this->DISPLAY_FIELD = "goal_name_ar";
                $this->ORDER_BY_FIELDS = "goal_name_ar";
                $this->editByStep = true;
                $this->editNbSteps = 3; 
                $this->showQeditErrors = true;
                $this->ENABLE_DISPLAY_MODE_IN_QEDIT=true;
                $this->showRetrieveErrors = true;
                $this->general_check_errors = true;
                // $this->qedit_minibox = true;
                
                $this->UNIQUE_KEY = array('system_id','module_id','goal_code');
                
	}
        
        public static function loadByMainIndex($system_id, $module_id, $goal_code,$create_obj_if_not_found=false)
        {
           $obj = new Goal();
           if(!$system_id) throw new AfwRuntimeException("loadByMainIndex : system_id is mandatory field");
           if(!$module_id) throw new AfwRuntimeException("loadByMainIndex : module_id is mandatory field");
           if(!$goal_code) throw new AfwRuntimeException("loadByMainIndex : goal_code is mandatory field");
 
 
           $obj->select("system_id",$system_id);
           $obj->select("module_id",$module_id);
           $obj->select("goal_code",$goal_code);
 
           if($obj->load())
           {
                if($create_obj_if_not_found) $obj->activate();
                return $obj;
           }
           elseif($create_obj_if_not_found)
           {
                $obj->set("system_id",$system_id);
                $obj->set("module_id",$module_id);
                $obj->set("goal_code",$goal_code);
 
                $obj->insert();
                $obj->is_new = true;
                return $obj;
           }
           else return null;
 
        }
        
        public function getWideDisplay($lang="ar")
        {
               return $this->getVal("goal_desc_$lang");
        }
        
        public function getDisplay($lang="ar")
        {
               /*
               $resp = $this->het("resp");
               if($resp) $resp_disp = $resp->getDisplay($lang);
               else $resp_disp = "empty jobrole";
               
               $resp_disp." ".;*/
               
               return $this->getVal("goal_name_$lang")." [".$this->getWideDisplay($lang)."]";
        }
        
        public function getShortDisplay($lang="ar")
        {
               return $this->getVal("goal_name_$lang");
        }
        
        
        public static function loadById($id)
        {
                   $obj = new Goal();
                   $obj->select_visibilite_horizontale();
                   if($obj->load($id))
                   {
                        return $obj;
                   }
                   else return null;
        }
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")      
        {
             global $me, $objme, $lang;
             $otherLinksArray = $this->getOtherLinksArrayStandard($mode, false, $step);
             $my_id = $this->getId();
             $displ = $this->getDisplay($lang);
             
             if($mode=="mode_goalList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة الأهداف  الفرعية";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=Goal&currmod=bau&id_origin=$my_id&class_origin=Goal&module_origin=bau&newo=10&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=parent_goal_id=$my_id&sel_parent_goal_id=$my_id&return_mode=1&popup=";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             if($mode=="mode_userStoryList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة قصص المستخدم  التي تحقق الهدف";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=UserStory&currmod=bau&id_origin=$my_id&class_origin=Goal&module_origin=bau&newo=10&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=goal_id=$my_id&sel_goal_id=$my_id&return_mode=1&popup=";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             if($mode=="mode_goalConcernList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة السعي على تحقيق الهدف";
                   $title_detailed = $title ." : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=GoalConcern&currmod=bau&id_origin=$my_id&class_origin=Goal&module_origin=bau&newo=1&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=goal_id=$my_id&sel_goal_id=$my_id&return_mode=1&popup=";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             
             
             return $otherLinksArray;
        }
        
        
        protected function initObject()
        {
               if((!$this->getVal("system_id")) and (!$this->getVal("module_id"))) 
               {
                      $resp = $this->het("resp");
                      if($resp and (!$resp->isEmpty()))
                      {
                         $app = $resp->het("mainApplication");
                         
                         if($app and (!$app->isEmpty()))
                         {
                             $this->set("system_id",$app->getVal("id_system"));
                             $this->set("module_id",$app->getId());
                         }
                         else
                         {
                             $this->set("system_id",1);
                         }
                      }
               }
               
               return true;
        }
        
        
        
        public function beforeMAJ($id, $fields_updated) 
        {
              global $lang;  
                
              if(!$this->getVal("domain_id")) 
              {
                   $resp = $this->hetResp();
                   if($resp) $this->set("domain_id", $resp->getVal("id_domain"));
              }  

                
                
                
		return true;
	}
        
        
        
        
        public function beforeDelete($id,$id_replace) 
        {
            
                $server_db_prefix = AfwSession::config("db_prefix","c0");
            if($id)
            {   
               if($id_replace==0)
               {
                   // FK part of me - not deletable 
                       // bau.goal-الهدف الأم	parent_goal_id  أنا تفاصيل لها-OneToMany
                        // require_once "../bau/goal.php";
                        $obj = new Goal();
                        $obj->where("parent_goal_id = '$id'");
                        $nbRecords = $obj->count();
                        if($nbRecords>0)
                        {
                            $this->deleteNotAllowedReason = "Used in some Goals(s) as parent goal";
                            return false;
                        }

                        
                   $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK part of me - deletable 
                       // bau.user_story-الهدف	user_story_goal_id  أنا تفاصيل لها-OneToMany
                        $this->execQuery("delete from ${server_db_prefix}bau.user_story where user_story_goal_id = '$id' ");
                       // bau.user_story-الهدف	my_goal_id  جزء مني ولا يعمل إلا بي-OneToOneBidirectional
                        $this->execQuery("delete from ${server_db_prefix}bau.user_story where my_goal_id = '$id' ");

                   
                   // FK not part of me - replaceable 

                        
                   
                   // MFK

               }
               else
               {
                        $server_db_prefix = AfwSession::config("db_prefix","c0"); // FK on me 
                       // bau.goal-الهدف الأم	parent_goal_id  أنا تفاصيل لها-OneToMany
                        $this->execQuery("update ${server_db_prefix}bau.goal set parent_goal_id='$id_replace' where parent_goal_id='$id' ");
                       // bau.user_story-الهدف	user_story_goal_id  أنا تفاصيل لها-OneToMany
                        $this->execQuery("update ${server_db_prefix}bau.user_story set user_story_goal_id='$id_replace' where user_story_goal_id='$id' ");
                       // bau.user_story-الهدف	my_goal_id  جزء مني ولا يعمل إلا بي-OneToOneBidirectional
                        $this->execQuery("update ${server_db_prefix}bau.user_story set my_goal_id='$id_replace' where my_goal_id='$id' ");

                        
                        // MFK

                   
               } 
               return true;
            }    
	}
        
        public function getOrCreateAssociatedArole() 
        {
               $file_dir_name = dirname(__FILE__); 
               // 
               
               $jobGoalId = $this->getId();
               $jobGoalCode = $this->valCode();
               
               if(!$jobGoalId) throw new AfwRuntimeException("Can't create associated Arole for empty goal");
               
               $parentGoal = $this->het("parent_goal_id");
               if($parentGoal)
               {
                     $parentArole = $parentGoal->getOrCreateAssociatedArole();
                     if($parentArole) $parent_arole_id = $parentArole->getId();
                     else $parent_arole_id = 0;
               }
               else
               {
                     $parent_arole_id = 0;
               } 
               
               $role_code = "goal-$jobGoalId";
               $ar = Arole::loadByMainIndex($this->getVal("module_id"), $role_code,$create_obj_if_not_found=false);
               $role_code = "goal-$jobGoalCode";
               if(!$ar)
               {
                    $ar = Arole::loadByMainIndex($this->getVal("module_id"), $role_code,$create_obj_if_not_found=true);
               }
               
               if($ar)
               {
                   $ar->set("parent_arole_id",$parent_arole_id);
                   $ar->set("role_code",$role_code);
                   $ar->set("titre_short",$this->getVal("goal_name_ar"));
                   $ar->set("titre_short_en",$this->getVal("goal_name_en"));
                   $ar->set("titre",$this->getVal("goal_desc_ar"));
                   $ar->set("titre_en",$this->getVal("goal_desc_en"));
                   
                   if($parent_arole_id==0) $arole_type_id = 10;
                   else $arole_type_id = 20;
                   
                   $ar->set("arole_type_id",$arole_type_id);
                   $ar->set("avail","Y");
                   
                   
                   $ar->update();
               }
               
               return $ar;
        }
        
        
        public function getRAMObjectData()
        {
                  $category_id = 12;

                  $file_dir_name = dirname(__FILE__); 
                  // require_once("$file_dir_name/../bau/r_a_m_object_type.php");
                  
                  $goalTypeObj = $this->getType();
                  if(!$goalTypeObj)
                  {
                      throw new AfwRuntimeException("getRAMObjectData error goalType not defined for this goal");
                  }
                  $lookup_code = $goalTypeObj->getVal("lookup_code");
                  
                  $typeObj = RAMObjectType::loadByMainIndex($lookup_code);
                  if(!$typeObj)
                  {
                      throw new AfwRuntimeException("getRAMObjectData error goalType lookup code [$lookup_code] not found as RAMObjectType");
                  }
                  $type_id = $typeObj->getId();
                  
                  $code = $this->getVal("goal_code");
                  if(!$code) $code = "goal-".$this->getId(); 
                  
                  $name_ar = $this->getVal("goal_name_ar");
                  $name_en = $this->getVal("goal_name_en");
                  $specification = $this->getVal("goal_name_ar")."\n------- english : ---------\n".$this->getVal("goal_name_en");
                  
                  $childs = array();
                  //$childs[1] =  $this->get("orgunitList");
                  //$childs[2] =  $this->get("jobsddList");
                  //$childs[3] =  $this->get("jobroleList");
                  //$childs[11] =  $this->get("userStoryList");
                  $childs[12] =  $this->get("goalList");
                  $childs[14] =  $this->get("goalConcernList");
                  

                  
                    
                  
                  return array($category_id, $type_id, $code, $name_ar, $name_en, $specification, $childs);
        
        }
        
        
        public function genereConcernedGoals($lang="ar", $regen=false, $operation_men=",1,2,3,")
        {
                $this_id = $this->getId();
                
                $jobrole_id = $this->getVal("jobrole_id");
                $application_id = $this->getVal("module_id");
                $domainObj = $this->het("domain_id");
                $atable_mfk = $this->getVal("atable_mfk");
                $atableList = $this->get("atable_mfk");
                
                $jobrole_arr = array();
                
                $file_dir_name = dirname(__FILE__); 
                // require_once("$file_dir_name/../bau/goal_concern.php");
                
                GoalConcern::resetAutoGeneratedConcernsOfGoal($this_id);                
                
                $error = "";
                $info = "";
                
                
                if(($jobrole_id) and $this->isResponsibilityGoal())
                {
                       $jobrole_arr[] = $jobrole_id;
                } 
                elseif($domainObj)
                {
                       
                       //$applicationObj = $this->het("module_id");
                       //$orgUnitList = $applicationObj->get("orgUnitList");
                       
                       if($this->isAdministrationGoal())
                       {
                               $jobroleList = $domainObj->get("jobroleList");
                               
                               foreach($jobroleList as $jobroleObj)
                               {
                                    $jobrole_arr[] = $jobroleObj->getId();
                               }
                               
                               /*
                               foreach($orgUnitList as $orgUnitObj)
                               {
                                        $orgUnitId = $orgUnitObj->getId();
                                        $gc = GoalConcern::loadByMainIndex($this_id, $orgUnitId, 0, 0, $create_obj_if_not_found=true);
                                        if($gc)
                                        {
                                              if($gc->is_new) $info .= "\ngoal concern ($this_id, $orgUnitId, 0, 0) created";
                                              else $info .= "\ngoal concern ($this_id, $orgUnitId, 0, 0) exists";
                                              
                                              if($application_id) 
                                              {
                                                   if($application_id) $gc->set("application_id",$application_id);
                                                   if($atable_mfk) $gc->set("atable_mfk",$atable_mfk);
                                              
                                                   $gc->update();
                                              }
                                                       
                                        } 
                                        else $error .= "\nerror goal concern ($this_id, $orgUnitId, 0, 0) has not been created";
                               }*/
                               
                               
                               
                               
                       }
                       elseif($this->isCommonGoal())
                       {
                               $jrCommon = $domainObj->getCommonJobResp();
                               $jobrole_arr[] = $jrCommon->getId();
                       }
                       else
                       {
                               $goal_type_id = $this->getVal("goal_type_id");
                               $error .= "\n<br>error check if this goal type is implemented to generate concerned goals : goal_type_id=[$goal_type_id]"; 
                       }
                       
                       /*elseif($this->isJobGoal())
                       {
                               foreach($orgUnitList as $orgUnitObj)
                               {
                                        $domainObj = $orgUnitObj->hetDomain();
                                        if($domainObj)
                                        {
                                             $jobsddList  = $domainObj->get("jobsddList");
                                             foreach($jobsddList as $jobsddItem)
                                             {
                                                        $jobsddID = $jobsddItem->getId();
                                                        $gc = GoalConcern::loadByMainIndex($this_id, 0, $jobsddID, 0, $create_obj_if_not_found=true);
                                                        if($gc)
                                                        {
                                                              if($gc->is_new) $info .= "\ngoal concern ($this_id, 0, $jobsddID, 0) created";
                                                              else $info .= "\ngoal concern ($this_id, 0, $jobsddID, 0) exists";
                                                              
                                                              if($application_id) $gc->set("application_id",$application_id);
                                                              if($atable_mfk) $gc->set("atable_mfk",$atable_mfk);
                                                              
                                                              $gc->update();
                                                                       
                                                        } 
                                                        else $error .= "\nerror goal concern ($this_id, 0, $jobsddID, 0) has not been created";
                                                     
                                             }
                                        }
                               }
                       }*/
                       
                }
                else
                {
                        $error .= "\n<br>error no goal concern created because missing goal/job responsibility/ application";    
                }
                
                if($this_id and (count($jobrole_arr)>0))
                {
                             // $this->set("goal_type_id",self::$GOAL_TYPE_JOBRESPONSIBILITYGOAL);
                             // $this->update();
                             foreach($jobrole_arr as $jobrole_id)
                             {
                                        $gc = GoalConcern::loadByMainIndex($this_id, $jobrole_id,$create_obj_if_not_found=true);
                                        if($gc)
                                        {
                                              if($gc->is_new) $info .= "\n<br>goal concern ($this_id, $jobrole_id) created";
                                              else $info .= "\n<br>goal concern ($this_id, $jobrole_id) exists";
                                              
                                              reset($atableList);
                                              
                                              $atable_id_arr = array();
                                              
                                              foreach($atableList as $atableObj)
                                              {
                                                    $jrList = $atableObj->getEntityManagerJobroles();
                                                    if($jrList[$jobrole_id])  $atable_id_arr[] = $atableObj->getId();
                                              }
                                              
                                              $atable_mfk = implode(",",$atable_id_arr);
                                              if($atable_mfk) $atable_mfk = ",$atable_mfk,";
                                               
                                              if($application_id) $gc->set("application_id",$application_id);
                                              if($atable_mfk) $gc->set("atable_mfk",$atable_mfk);
                                              $gc->set("operation_men",$operation_men);
                                              if($gc->is_new) 
                                              {
                                                    $gc->set("comment","AUTO-GENERATED");
                                              }
                                              $gc->update();
                                                       
                                        } 
                                        else $error .= "\n<br>error goal concern ($this_id, $jobrole_id) has not been created";
                             }          
                }
                
                
                
                return array($error, $info);
        
        }
        
        
        
        protected function getPublicMethods()
        {
            
            $pbms = array();
            
            $color = "green";
            $title_ar = "توليد تفاصيل الهدف"; 
            $pbms["xca9aB"] = array("METHOD"=>"genereConcernedGoals","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            $color = "yellow";
            $title_ar = "إعادة تحديث القصص"; 
            $pbms["x2Uhab"] = array("METHOD"=>"resetUserStories","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            $color = "blue";
            $title_ar = "إعادة تحديث الوظائف المرتبطة بهذا الهدف"; 
            $pbms["xhab1B"] = array("METHOD"=>"resetUserBFs","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            
            $color = "red";
            $title_ar = "مسح القصص"; 
            $pbms["xh01Aa"] = array("METHOD"=>"deleteUserStories","COLOR"=>$color, "LABEL_AR"=>$title_ar, "ADMIN-ONLY"=>true, "BF-ID"=>"");
            
            return $pbms;
        }
        
        public function resetUserStories($lang="ar")
        {
                $error="";
                $info="";
                
                $userStoryList = $this->get("userStoryList");
                
                foreach($userStoryList as $userStoryItem)
                {
                      $userStoryItem->resetGoalAndRole($lang);
                      $userStoryItem->putGoalIfNeeded($lang);
                }
                
                $us_count = count($userStoryList);
                
                if($us_count>0) $info = "$us_count user story(ies) has been updated";
                else $info = "No user story has been generated, please genere it before by (re)generating User Business Functions";
                
                return array($error, $info);
        
        }
        
        public function resetUserBFs($lang="ar")
        {
                $error="";
                $info="";
                
                $atList = $this->get("atable_mfk");
                
                foreach($atList as $atableItem)
                {
                      list($err,$inf) = $atableItem->genereUserBFs($lang);
                      if($err) $error .= "for table $atableItem : $err \n<br>\n";
                      if($inf) $info .= "for table $atableItem : $inf \n<br>\n";
                }
                
                return array($error, $info);
        
        }
        
        
        
        public function deleteUserStories($lang="ar")
        {
                $error="";
                $info="";
                
                $userStoryList = $this->get("userStoryList");
                
                foreach($userStoryList as $userStoryItem)
                {
                      $userStoryItem->delete();
                }
                
                return array($error, $info);
        
        }
        
        public function isTodoGoal()
        {
                $goal_code = $this->getVal("goal_code");
        
                return(se_termine_par($goal_code,"-@todo")); 
        }
        
        
        public function isAdministrationGoal()
        {
                $goal_type_id = $this->getVal("goal_type_id");
        
                return($goal_type_id==self::$GOAL_TYPE_ADMINISTRATION_GOAL); 
        }
        
        public function isCommonGoal()
        {
                $goal_type_id = $this->getVal("goal_type_id");
        
                return($goal_type_id==self::$GOAL_TYPE_COMMON_ADMINISTRATION_GOAL); 
        }
        
        public function isResponsibilityGoal()
        {
                $goal_type_id = $this->getVal("goal_type_id");
        
                return($goal_type_id==self::$GOAL_TYPE_JOB_RESPONSIBILITY_GOAL); 
        }
        
        
        public function attributeIsApplicable($attribute)
        {
              if($attribute=="atable_mfk") return (!$this->isTodoGoal());
              if($attribute=="goalConcernList") return (!$this->isTodoGoal());
              
              // even if it is department goal there is a jobrole that will work to reach this goal
              // if($attribute=="jobrole_id") return ($this->isResponsibilityGoal());
              
              return true;
        }

         public function myShortNameToAttributeName($attribute){
                if($attribute=="code") return "goal_code";
                if($attribute=="type") return "goal_type_id";
                if($attribute=="system") return "system_id";
                if($attribute=="module") return "module_id";
                if($attribute=="resp") return "jobrole_id";
                if($attribute=="tables") return "atable_mfk";
                return $attribute;
        }
        
             
}
?>