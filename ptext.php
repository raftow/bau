<?php
$file_dir_name = dirname(__FILE__); 
/*
ptext_type :
+----+-----------------------+
| id | titre_short           |
+----+-----------------------+
|  9 | جملة                  |
|  8 | فقرة                 |
|  7 | موضوع                |
|  6 | محور                  |
|  5 | مستند               |
+----+-----------------------+

ptext_cat :

+--------------+----+-----------------------------+
| ptext_type_id | id | titre_short        |
+---------------+----+-----------------------------+
|             3 |  3 | جزء من فقرة                 |
|             3 |  4 | سؤال                        |
|             3 |  5 | عنوان                       |
|             4 |  6 | إجابة عن سؤال               |
|             4 |  7 | بيان مسألة                  |
|             5 |  8 | متطلبات النظام              |
|             6 |  9 | تعريف النظام                |
+---------------+----+----------------------------*/

                
// old include of afw.php


class Ptext extends AFWObject{

        public static $COMPTAGE_BEFORE_LOAD_MANY = true;

	public static $DATABASE		= ""; public static $MODULE		    = "bau"; public static $TABLE			= ""; public static $DB_STRUCTURE = null; /* array(
		"id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "PK"),
                "ptext_type_id" => array(SHOW => true, RETRIEVE => true, SEARCH => true, QSEARCH => true, "EDIT" => true, TYPE => FK, ANSWER => ptext_type, ANSMODULE => bau, "QEDIT" => false, "SIZE" => 40, "DEFAULT" => 0, READONLY=>true),
		"ptext_cat_id" => array(SHOW => true, RETRIEVE => true, QSEARCH => true, "EDIT" => true, TYPE => FK, ANSWER => ptext_cat, ANSMODULE => bau, "QEDIT" => false, "SIZE" => 40, "DEFAULT" => 0, "WHERE"=>"(ptext_type_id=§ptext_type_id§ or §ptext_type_id§=0)"),
	
                "stakeholder_id" => array("SHOW" => true, SEARCH => true, QSEARCH => true, "EDIT" => true, TYPE => FK, 
                                    ANSWER => orgunit, ANSMODULE => hrm, WHERE=>"", 
                                    SIZE => 40, "QEDIT" => false, "DEFAULT" => 5, "IMPORTANT"=>"CM"),

                orgunit_id => array("SHOW" => true, SEARCH => true, QSEARCH => true, "EDIT" => true, "QEDIT" => false, "SIZE" => 40, "UTF8" => false, 
                                    "TYPE" => "FK", "ANSWER" => orgunit, "ANSMODULE" => hrm, "DEFAULT" => 0),

		"module_id" => array(SHOW => true, RETRIEVE => false, EDIT => true, 
                                    TYPE => FK, ANSWER => module, ANSMODULE => ums, 
                                    SIZE => 40, "DEFAULT" => 0, "QEDIT" => false, 
                                    WHERE=>"(id_main_sh=§orgunit_id§ or §orgunit_id§=0) and (§ptext_type_id§ != 5 or id_module_type in (5,7)) and id_module_status in (3,4,5,6)", 
                                    "IMPORTANT"=>"CM", 'STEP' =>2),

                "id_theme" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "SEARCH" => false, "QEDIT" => false, 
                       TYPE => FK, ANSWER => theme, "SIZE" => 40, "DEFAULT" => 0),

		"author_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, 
                                 TYPE => FK, ANSWER => auser, ANSMODULE => ums,
                                 WHERE => "id in (select auser_id from c0hrm.employee where id_sh_div = §stakeholder_id§)", // @todo : here normally we should have system of rules of relation between 
                                                                                                            // ptext_types and orgunits who can do what (edit/delete/display) 
                                 QEDIT => false, "SIZE" => 40, "DEFAULT" => 0, 'STEP' =>2),

                "authors_mfk" => array("SHOW" => true, "SEARCH" => false, "RETRIEVE" => false, "EDIT" => false, "QEDIT" => false, "EDIT-ADMIN" => true, 
                                        TYPE => MFK, ANSWER => auser, ANSMODULE => ums,
                                        WHERE => "id != §author_id§ and id in (select auser_id from c0hrm.employee where id_sh_div = §stakeholder_id§)", // @todo : here normally we should have system of rules of relation between 
                                                                                                                   // ptext_types and orgunits who can do what (edit/delete/display)
                                        STEP=>2),
                                        
                "id_atable" => array(SHOW => true, SEARCH => true, EDIT => true, QEDIT => false, 
                       TYPE => FK, ANSWER => "atable", "ANSMODULE" => "pag", 
                       SIZE => 40, "DEFAULT" => 0, 'STEP' =>2),
                
                 
                "pdocument_id" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, 
                                   TYPE => FK, ANSWER => ptext, ANSMODULE => bau, 
                                   SIZE => 40, "QEDIT" => true, "DEFAULT" => 0, 
                                   WHERE=>"ptext_type_id=5", 'STEP' =>2),
                
                "parent_ptext_id" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, 
                                             TYPE => FK, ANSWER => ptext, ANSMODULE => bau, 
                                             SIZE => 40, "QEDIT" => false, "DEFAULT" => 0, 
                                             WHERE=>"ptext_type_id=6 and id != '§id§'", 'STEP' =>2),

                "related_ptext_id" => array("SHOW" => true, "RETRIEVE" => false, "SEARCH" => false, "EDIT" => true, "QEDIT" => false, 
                      TYPE => FK, ANSWER => ptext, ANSMODULE => bau, 
                      SIZE => 40, "DEFAULT" => 0, 
                      WHERE=>"ptext_type_id = 3 and id != '§id§'", 'STEP' =>2),

                 
		
                
		"titre_short" => array("SHOW" => true, "RETRIEVE" => true, "EDIT" => true, "QEDIT" => true, SEARCH => true, QSEARCH => true, "UTF8" => true, "SIZE" => 80, "TYPE" => "TEXT", 'STEP' =>3),
		"ntext" => array("SHOW" => true, "RETRIEVE" => false, "EDIT" => true, "QEDIT" => true, "TYPE" => "TEXT", "UTF8" => true, SEARCH => true, QSEARCH => true, 
                                  SIZE => AREA, ROWS => 12, COLS => 100, "INPUT-STYLE"=>"height:220px !important;overflow:auto;", "FORMAT" => "PARAGRAPH-TOHTML", 'STEP' =>3, ),
                
                "pnum" => array("IMPORTANT" => "IN", "SHOW" => true, "SEARCH" => false, "QEDIT" => false, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "INT", 'STEP' =>3),
                
                "spcount" => array("SHOW" => true, "SEARCH" => false, "QEDIT" => false, "RETRIEVE" => true, "EDIT" => true, "TYPE" => "INT", 
                                    STEP=>3, 
                                    "CAN-BE-SETTED"=>true, 
                                    "DIRECT_ACCESS"=>true,
                                    "CATEGORY" => "FORMULA", "PHP_FORMULA"=>"count.itemList"),

		"ptext_status_id" => array("SHOW" => true, "RETRIEVE" => true, SEARCH => true, "EDIT" => false, "QEDIT" => false, "EDIT-STATUS" => true, TYPE => FK, ANSWER => ptext_status, ANSMODULE => bau, "SIZE" => 40, "DEFAULT" => 1, 'STEP' =>4),
		"ptext_status_comment" => array("SHOW" => true, "RETRIEVE" => false, SEARCH => true, "EDIT" => false, "QEDIT" => false, "EDIT-STATUS" => true, "TYPE" => "TEXT", "UTF8" => true, "SIZE" => "AREA", 'STEP' =>4),
                
                itemList => array(TYPE => FK, ANSWER => ptext, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'parent_ptext_id', WHERE=>'', SHOW => true, FORMAT=>retrieve, EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, BUTTONS=>true, "NO-LABEL"=>true, 'STEP' =>5),
                relatedList => array(TYPE => FK, ANSWER => ptext, ANSMODULE => bau, CATEGORY => ITEMS, ITEM => 'related_ptext_id', WHERE=>'', SHOW => true, FORMAT=>retrieve, EDIT => false, ICONS=>true, 'DELETE-ICON'=>false, BUTTONS=>true, "NO-LABEL"=>true, 'STEP' =>6),


		"id_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_aut" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
		"id_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_mod" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATETIME"),
		"id_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "auser", "ANSMODULE" => "ums", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0),
		"date_valid" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "DATE"),
		"avail" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "DEFAULT" => "Y", "TYPE" => "YN"),
		"version" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "TYPE" => "INT"),
		"update_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"delete_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"display_groups_mfk" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "ugroup", "ANSMODULE" => "ums", "TYPE" => "MFK"),
		"sci_id" => array("SHOW-ADMIN" => true, "RETRIEVE" => false, "EDIT" => false, "ANSWER" => "scenario_item", "ANSMODULE" => "pag", "TYPE" => "FK", "SIZE" => 40, "DEFAULT" => 0)
	);
        
        
        public $details = array();
        
	*/ public function __construct($tablename="ptext"){
		parent::__construct($tablename,"id","bau");
                $this->DISPLAY_FIELD = "titre_short";
                $this->SubTypesField = "ptext_type_id";
                $this->editByStep = true;
                $this->editNbSteps = 6;
                $this->ORDER_BY_FIELDS = "parent_ptext_id, pnum";                
	}

        public function loadDetails($recur=true)
        {
                unset($this->details);
                
                $det = new Ptext();
                $det->select("module_id",$this->getVal("module_id"));
                $det->select("stakeholder_id",$this->getVal("stakeholder_id"));
                $det->select("pdocument_id",$this->getVal("pdocument_id"));
                $det->select("parent_ptext_id",$this->getVal("parent_ptext_id"));
                $det->select("related_ptext_id",$this->getId());
                
                $this->details =& $det->loadMany();
                
                if($recur)
                {
                       $keys_details = array_keys($this->details);
                       
                       foreach($keys_details as $ptxt_id) 
                       {
                              $this->details[$ptxt_id]->loadDetails(true);  
                       }
                }
        }
        
        public static function genereDoc($p_text_arr)
        {
             $html = "";
             $keys_details = array_keys($p_text_arr);
             
             foreach($keys_details as $key)
             {
                  $html .= $p_text_arr[$key]->genereParagraphHTML() ."<br>";
             }
             
             return $html;
        }          
        
        public function genereParagraphHTML()
        {
             $html = "";
             $p_text = $this->getVal("ntext");
             $p_titre = $this->getVal("titre_short");
             $p_cat = $this->getVal("ptext_cat_id");
             
             if(($p_cat==4) or ($p_cat==5))
             {
                $html .= "<p class='page_title'>$p_titre</p><br>";
                //$html .= "<p class='page_paragraph'>count = ".count($this->details)."</p><br>";;
             }
             if(($p_cat==3) or ($p_cat==6) or ($p_cat==7))
             {
                 $p_text_html = AfwFormatHelper::toHtml($p_text); 
                 $html .= "<p class='page_paragraph'>$p_text_html</p><br>";
                 
                 
             }
             $keys_details = array_keys($this->details);
             foreach($keys_details as $ptxt_id) 
             {
                 $html .= $this->details[$ptxt_id]->genereParagraphHTML();  
             }       
        
        
             return $html;   
        }        
        
        protected function getOtherLinksArray($mode, $genereLog = false, $step="all")
        {
           global $lang;
             $objme = AfwSession::getUserConnected();
             $me = $objme ? $objme->id : 0;
             $ptextType = $this->het("ptext_type_id");
             $displ = $this->getDisplay($lang);
             $otherLinksArray = array();   
             if($mode=="display")
             {
                
                
                if($this->getVal("ptext_cat_id")==4)
                {
                   $link = array();
                   $title_short = "إجابة ". $objme->valNomcomplet() ." على سؤال رقم "."§id§"; 
                   
                   $link["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_titre_short=${title_short}&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_related_ptext_id=§id§&sel_ptext_type_id=4&sel_ptext_cat_id=6&sel_author_id=$me";
                   $link["TITLE"] = "إجابة عن هذا السؤال";
                   $link["UGROUPS"] = array();
                   
                   $otherLinksArray[] = $link;
                }   
                
                $link_2 = array();   
                 
                // $link_2["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_ptext_type_id=3&sel_ptext_cat_id=4&sel_author_id=$me";
                // $link_2["TITLE"] = "سؤال آخر في نفس السياق";
                // $link_2["UGROUPS"] = array();
                
                // $otherLinksArray[] = $link_2;

                $link_3 = array();
                
                $link_3["URL"] = "main.php?Main_Page=afw_mode_edit.php&cl=Ptext&sel_stakeholder_id=§stakeholder_id§&sel_module_id=§module_id§&sel_pdocument_id=§pdocument_id§&sel_parent_ptext_id=§parent_ptext_id§&sel_ptext_type_id=§ptext_type_id§&sel_ptext_cat_id=§ptext_cat_id§&sel_author_id=$me";
                $link_3["TITLE"] = "تحرير في نفس السياق";
                $link_3["UGROUPS"] = array();

                
                $otherLinksArray[] = $link_3;
                
             }
             
                
             if($ptextType and $ptextType->getId()==5) $pdocument_id = $this->getId();
             else $pdocument_id = $this->getVal("pdocument_id");             
             
             if($mode=="mode_itemList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة الفقرات الفرعية ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=Ptext&currmod=bau&id_origin=$my_id&class_origin=Ptext&module_origin=bau&newo=3&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=parent_ptext_id=$my_id,pdocument_id=$pdocument_id&sel_parent_ptext_id=$my_id&sel_pdocument_id=$pdocument_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             if($mode=="mode_relatedList")
             {
                   unset($link);
                   $my_id = $this->getId();
                   $link = array();
                   $title = "إدارة الفقرات ذات الصلة ";
                   $title_detailed = $title ."لـ : ". $displ;
                   $link["URL"] = "main.php?Main_Page=afw_mode_qedit.php&cl=Ptext&currmod=bau&id_origin=$my_id&class_origin=Ptext&module_origin=bau&newo=3&limit=30&ids=all&fixmtit=$title_detailed&fixmdisable=1&fixm=related_ptext_id=$my_id,pdocument_id=$pdocument_id&sel_related_ptext_id=$my_id&sel_pdocument_id=$pdocument_id";
                   $link["TITLE"] = $title;
                   $link["UGROUPS"] = array();
                   $otherLinksArray[] = $link;
             }
             
             
             
             
             
             
             //echo var_export($otherLinksArray,true); 
             return $otherLinksArray;          
        }
        
        public function getDisplay($lang="ar") 
        {
                return $this->valTitre_Short();   

	}
        
        public function getOrderByFields($join = true)
	{
		return "stakeholder_id,module_id,pdocument_id,parent_ptext_id,pnum,id";
	}
        
        public function attributeIsApplicable($attribute)
        {
              if($attribute=="id_atable")
              {
                  return false; 
              }
              
              if($attribute=="id_atable")
              {
                  return false; 
              }
              
              if($attribute=="pdocument_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6))); 
              }
              
              if($attribute=="parent_ptext_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6)));
              }
              
              if($attribute=="pnum")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9,8,6)));
              }
              
              if($attribute=="related_ptext_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9)));
              }
              
              if($attribute=="stakeholder_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="orgunit_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="module_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="id_theme")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="author_id")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5,9)));
              }
              
              if($attribute=="authors_mfk")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5)));
              }
              
              if($attribute=="relatedList")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(9)));
              }
              
              if($attribute=="itemList")
              {
                  return (in_array($this->getVal("ptext_type_id"), array(5,6,7,8)));
              }
              
              

              return true;
         }
         
         public function beforeMAJ($id, $fields_updated) 
         {
		return true;
	 }
         
         public function newChild($pnum)
         {
	        $child = null;
                $ptextChildType = null;
                
                
                $ptextType = $this->het("ptext_type_id");
                
                if($ptextType and $ptextType->getId()==5) 
                {
                      $pdocument_id = $this->getId();
                      $parent_ptext_id = 0;
                }        
                else
                {
                      $pdocument_id = $this->getVal("pdocument_id");
                      $parent_ptext_id = $this->getId();
                } 
                
                if($ptextType) $ptextChildType = $ptextType->het("default_child_type_id");
                if($ptextChildType)
                {
                        $child = new Ptext();
                        $child->set("ptext_type_id",$ptextChildType->getId());
                        $child->set("ptext_cat_id",$ptextChildType->getVal("default_child_cat_id"));
                        $child->set("pdocument_id",$pdocument_id);
                        $child->set("parent_ptext_id",$parent_ptext_id);
                        $child->set("titre_short","عنوان نص $pnum");
                        $child->set("ntext","نص $pnum");
                        $child->set("pnum",$pnum);
                        $child->set("ptext_status_id",1);
                        $child->insert();
                }
                        
                return $child;
	 }
         
         protected function afterSetAttribute($attribute)
         {
                $spcount = $this->valSpcount();
                $itemList =  $this->get("itemList");
                $i=0;
                foreach($itemList as $itemId => $itemObj)
                {
                     if($i<$spcount)
                     {
                         $itemObj->set("pnum",$i*10+10);
                         $itemObj->activate();
                     }
                     else
                     {
                         $itemObj->logicDelete();
                     }
                     $i++;
                }
                
                while($i<$spcount)
                {
                    $this->newChild($i*10+10);
                    $i++;
                }
         }
   
      
                
       
         
}
?>