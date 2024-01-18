<?php
      $file_dir_name = dirname(__FILE__); 
      
      
      require_once("$file_dir_name/../lib/afw/afw_displayer_factory.php");

      $uri_items = explode("/",$_SERVER[REQUEST_URI]);
      if($uri_items[0]) $module = $uri_items[0];
        else $module = $uri_items[1];

       //throw new AfwRuntimeException("chnia 7keya");
       /*
       if($objme)
       {
          if(!$objme->isAdmin()) throw new AfwRuntimeException("I am not admin");
       }
       else die("I am not here");*/

       if(($objme) and ($objme->popup))
       {
            $target = "target='popup'";
            $popup_t = "on";  
       }
       else
       {
            $target = "";
            $popup_t = ""; 
       }
        
      // here was old const php
      
      $nummenu = 1;
      $numtheme = 0;
      $numsubtheme = 0;
      $numfrontclass = 4;
      
      $theme[$numtheme] = "إدارة البيانات";
      $subtheme_class[$numtheme][$numsubtheme] = "front";
      $subtheme_title_class[$numtheme][$numsubtheme] = "database"; 
      $subtheme[$numtheme][$numsubtheme] = "إدارة بياناتي الشخصية";
      
      if($mySemplObj)
      {
              $sempl_me = $mySemplObj->getId();   
              $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_edit.php&cl=Sempl&id=$sempl_me&currmod=sdd", "png"=>"../lib/images/emprofile.png", "titre"=>"إدارة سيرتي الذاتية", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0);
              $numfrontclass = ($numfrontclass + 1) % 15;  
      }
      $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"afw_my_files.php?popup=$popup_t", "target"=>"$target", "png"=>"../lib/images/attachements.png", "titre"=>"إدارة المرفقات", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0);
      $numfrontclass = ($numfrontclass + 1) % 15;

      $numsubtheme++;
      $subtheme_class[$numtheme][$numsubtheme] = "front";
      $subtheme_title_class[$numtheme][$numsubtheme] = "database"; 
      $subtheme[$numtheme][$numsubtheme] = "إدارة الموظفين";
      
      $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_search.php&cl=Sempl&currmod=sdd", "png"=>"../lib/images/emsearch.png", "titre"=>"البحث في الموظفين", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0, 
                                                         "afw"=>"Sempl", "mod"=>"sdd", "operation"=>"search");
      $numfrontclass = ($numfrontclass + 1) % 15;
      
      $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=job-elig.php", "png"=>"../lib/images/career.png", "titre"=>"السلم الوظيفي", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0, "afw"=>"Sempl", "mod"=>"sdd", "operation"=>"search");
      $numfrontclass = ($numfrontclass + 1) % 15;

      $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=sempl_need_ppp.php", "png"=>"../lib/images/profile.png", "titre"=>"إستكمال الصفات الشخصية للموظفين", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0, "afw"=>"Sempl", "mod"=>"sdd", "operation"=>"search");
      $numfrontclass = ($numfrontclass + 1) % 15;
      
      $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_qedit.php&ids=all&cl=Jobsdd&currmod=sdd&fixm=id_domain=3,id_sh_org=3,id_sh_div=33&sel_id_domain=3&sel_id_sh_org=3&sel_id_sh_div=33&fixmdisable=1", "png"=>"../lib/images/profile.png", "titre"=>"الوظائف", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0, "afw"=>"Jobsdd", "mod"=>"sdd", "operation"=>"edit");
      $numfrontclass = ($numfrontclass + 1) % 15;
      
      
      
      
      $module_id = 1233;
      $module_obj = new Module();
      $module_obj->load($module_id);
      $currmod = $module_obj->getVal("module_code");
      
      $sub_modules = $module_obj->get("smd");
      
      $numtheme++;
      $theme[$numtheme] = "وحدات نظام ".$module_obj->getDisplay();
      foreach($sub_modules as $sub_module_id => $submodule_obj) 
      {
                $at = new Atable();
                $at->select("id_module",$module_id);
                $at->select("id_sub_module",$sub_module_id);
                $at->select("avail",'Y');
                $at_list = $at->loadMany($limit = "", $order_by = "id_sub_module asc");
                if(is_array($at_list) and count($at_list)) 
                {
                        $subtheme[$numtheme][$numsubtheme] = $submodule_obj->getDisplay();                
                        foreach($at_list as $atb_id => $atb_obj)
                        {
                                     $atb_obj_class = $atb_obj->getTableClass();
                                     $atb_obj_desc =  $atb_obj->getVal("titre_short");
                                     $atb_obj_name =  $atb_obj->getVal("titre_u");  
                                     
                                     $can_search = false;
                                     $can_edit = false;
                                     
                                     if($atb_obj_class)
                                     {
                                                if($atb_obj_class)
                                                {
                                                        $myObjClass = new $atb_obj_class();
                                                        list($can_search,$bf_id, $reason_search) = $myObjClass->userCan($objme, $currmod,"search");
                                                        if(!$can_search)  die(" can't search on ($atb_obj_class)[".$atb_obj_class."] bf_id=$bf_id, reason_search=$reason_search");
                                                        list($can_edit,$bf_id, $reason_edit) = $myObjClass->userCan($objme, $currmod,"edit");
                                                }
                                                else die("failed to load afw class $atb_obj_class from module $currmod");
                                     }
                                        
                                        
                                     if($atb_obj->isOriginal() and $atb_obj->_isEntity()) 
                                     {
                                             if(($atb_obj->getRowCount()<= 30) and ($atb_obj->_isLookup()) and ($can_edit))
                                             {
                                                     $fixmtit = "إدارة ".$atb_obj_desc;
                                                     $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_qedit.php&cl=$atb_obj_class&currmod=$currmod&ids=all&newo=3&fixmtit=$fixmtit", "png"=>"../lib/images/profile.png", "titre"=>"$fixmtit", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0);
                                                     $numfrontclass = ($numfrontclass + 1) % 15; 
                                                     
                                             }
                                             elseif($can_search)
                                             {
                                                     $tit = "الاستعلام عن ".$atb_obj_name;
                                                     $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_qsearch.php&cl=$atb_obj_class&currmod=$currmod", "png"=>"../lib/images/profile.png", "titre"=>"$tit", "id"=>"", "class"=>"${"front_$numfrontclass"}", "subtheme"=>0);
                                                     $numfrontclass = ($numfrontclass + 1) % 15; 
                                             }
                                             else
                                             {
                                                     $tit = "الاستعلام عن ".$atb_obj_name." ممنوع : $reason_search";
                                                     $menu[$numtheme][$numsubtheme][$nummenu++] = array("page"=>"main.php?Main_Page=afw_mode_qsearch.php&cl=$atb_obj_class&currmod=$currmod", "png"=>"../lib/images/profile.png", "titre"=>"$tit", "id"=>"", "class"=>$front_14, "subtheme"=>0);
                                             }
                                     }
                                                
                        }
                        $numsubtheme++;
                        
                 }       
      }
      $numtheme++;
      
      
      include "../pag/menu_constructor.php";
      
       
      
      


?>

