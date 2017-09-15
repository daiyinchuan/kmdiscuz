<?php exit;?>
<!--{template common/header}-->
<style id="diy_style" type="text/css"></style>
<link href="template/xiaoyu_newmi/style/xiaoyu_p.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="template/xiaoyu_newmi/style/js/comm.js"></script>
<script>var show_per_page = 6; </script>
  <div class="wp"> 
   <!--[diy=diy1]--> 
   <div id="diy1" class="area"></div> 
   <!--[/diy]--> 
  </div> 
  <!-- main start --> 
  <div class="main" style="margin-top:20px;"> 
   <!--[diy=diyxiaoyu]--> 
   <div id="diyxiaoyu" class="area"></div> 
   <!--[/diy]--> 
   <div class="content cl"> 
    <div class="left box"> 
     <!--[diy=diytopLine]--> 
     <div id="diytopLine" class="area"></div> 
     <!--[/diy]--> 
     <ul id="news" class="news">
     <!--[diy=xiaoyunewslist]--> 
     <div id="xiaoyunewslist" class="area"></div> 
     <!--[/diy]-->
     <div id="page_navigation"></div>
      </ul>
      
    </div> 
    <div class="right">
        
     <div class="hot sidebarplate_tab box">
       <h4>
        <!--[diy=xiaoyu_tabportal]--> 
        <div id="xiaoyu_tabportal" class="area"></div> 
        <!--[/diy]--> 
       </h4>
      <div class="tab-content"> 
       <ul style="display: block;"> 
        <!--[diy=diytabbank]--> 
        <div id="diytabbank" class="area"></div> 
        <!--[/diy]--> 
       </ul> 
       <ul style="display:none;"> 
        <!--[diy=diytabbox]--> 
        <div id="diytabbox" class="area"></div> 
        <!--[/diy]--> 
       </ul> 
      </div> 
     </div>
     <div id="midaben_sign"></div>  
     <div class="editorChoice box"> 
      <!--[diy=diyeditorChoice]--> 
      <div id="diyeditorChoice" class="area"></div> 
      <!--[/diy]--> 
     </div> 
     <div class="activities box"> 
      <!--[diy=diyactivities]--> 
      <div id="diyactivities" class="area"></div> 
      <!--[/diy]--> 
     </div> 
     <div class="academy box"> 
      <!--[diy=diyacademy]--> 
      <div id="diyacademy" class="area"></div> 
      <!--[/diy]--> 
     </div> 
     <div class="play box"> 
      <!--[diy=diyplay]--> 
      <div id="diyplay" class="area"></div> 
      <!--[/diy]--> 
     </div> 
     <div class="store with_toggle box" id="picShow"> 
      <!--[diy=diyssp]--> 
      <div id="diyssp" class="area"></div> 
      <!--[/diy]--> 
     </div> 
    </div> 
   </div> 
  </div>


<script>
function xiaoyu_share_show(url, title, pic) {
 window.open("http://v.t.sina.com.cn/share/share.php?url=$_G['siteurl']" + encodeURIComponent(url) + "&title=" + encodeURIComponent(title) + "&pic=$_G['siteurl']" + encodeURIComponent(pic));
}
</script>
<script src="misc.php?mod=diyhelp&action=get&type=index&diy=yes&r={echo random(4)}" type="text/javascript"></script>
<!--小鱼设计团队QQ562828385 -->
<!--{template common/footer}-->

