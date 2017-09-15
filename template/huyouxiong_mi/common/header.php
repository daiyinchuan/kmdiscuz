<?php echo '忽悠兄分享　禁止进行二次倒卖';exit;?> 
<!--{subtemplate common/header_common}-->
<!--{eval require_once("./template/huyouxiong_mi/huyouxiong_config.php");}-->
	<meta name="application-name" content="$_G['setting']['bbname']" />
	<meta name="msapplication-tooltip" content="$_G['setting']['bbname']" />
	<!--{if $_G['setting']['portalstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][1]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['portal']) ? 'http://'.$_G['setting']['domain']['app']['portal'] : $_G[siteurl].'portal.php'};icon-uri={$_G[siteurl]}{IMGDIR}/portal.ico" /><!--{/if}-->
	<meta name="msapplication-task" content="name=$_G['setting']['navs'][2]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['forum']) ? 'http://'.$_G['setting']['domain']['app']['forum'] : $_G[siteurl].'forum.php'};icon-uri={$_G[siteurl]}{IMGDIR}/bbs.ico" />
	<!--{if $_G['setting']['groupstatus']}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][3]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['group']) ? 'http://'.$_G['setting']['domain']['app']['group'] : $_G[siteurl].'group.php'};icon-uri={$_G[siteurl]}{IMGDIR}/group.ico" /><!--{/if}-->
	<!--{if helper_access::check_module('feed')}--><meta name="msapplication-task" content="name=$_G['setting']['navs'][4]['navname'];action-uri={echo !empty($_G['setting']['domain']['app']['home']) ? 'http://'.$_G['setting']['domain']['app']['home'] : $_G[siteurl].'home.php'};icon-uri={$_G[siteurl]}{IMGDIR}/home.ico" /><!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' && $_G['setting']['archiver']}-->
		<link rel="archives" title="$_G['setting']['bbname']" href="{$_G[siteurl]}archiver/" />
	<!--{/if}-->
	<!--{if !empty($rsshead)}-->$rsshead<!--{/if}-->
	<!--{if widthauto()}-->
		<link rel="stylesheet" id="css_widthauto" type="text/css" href='{$_G['setting']['csspath']}{STYLEID}_widthauto.css?{VERHASH}' />
		<script type="text/javascript">HTMLNODE.className += ' widthauto'</script>
	<!--{/if}-->
	<!--{if $_G['basescript'] == 'forum' || $_G['basescript'] == 'group'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}forum.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'home' || $_G['basescript'] == 'userapp'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}home.js?{VERHASH}"></script>
	<!--{elseif $_G['basescript'] == 'portal'}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
	<!--{if $_G['basescript'] != 'portal' && $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<script type="text/javascript" src="{$_G[setting][jspath]}portal.js?{VERHASH}"></script>
	<!--{/if}-->
	<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
		<link rel="stylesheet" type="text/css" id="diy_common" href="{$_G['setting']['csspath']}{STYLEID}_css_diy.css?{VERHASH}" />
	<!--{/if}-->
<!--{eval $comiis_ff=1;}-->
<!--{if $comiis_window_width==2}-->
<script>
if(screen.width>1210){
	HTMLNODE.className += ' comiis_wide';
}
</script>
<!--{/if}-->
</head>
<body id="nv_{$_G[basescript]}" class="pg_{CURMODULE}{if $_G['basescript'] === 'portal' && CURMODULE === 'list' && !empty($cat)} {$cat['bodycss']}{/if}<!--{if $comiis_window_width==1}--> comiis_wide<!--{/if}--> kmfn" onkeydown="if(event.keyCode==27) return false;">
<div id="append_parent"></div><div id="ajaxwaitid"></div>
<!--{if $_GET['diy'] == 'yes' && check_diy_perm($topic)}-->
	<!--{template common/header_diy}-->
<!--{/if}-->
<!--{if check_diy_perm($topic)}-->
	<!--{template common/header_diynav}-->
<!--{/if}-->
<!--{if CURMODULE == 'topic' && $topic && empty($topic['useheader']) && check_diy_perm($topic)}-->
	$diynav
<!--{/if}-->
<!--{if empty($topic) || $topic['useheader']}-->
	<!--{if $_G['setting']['mobile']['allowmobile'] && (!$_G['setting']['cacheindexlife'] && !$_G['setting']['cachethreadon'] || $_G['uid']) && ($_GET['diy'] != 'yes' || !$_GET['inajax']) && ($_G['mobile'] != '' && $_G['cookie']['mobile'] == '' && $_GET['mobile'] != 'no')}-->
		<div class="xi1 bm bm_c">
			{lang your_mobile_browser}<a href="{$_G['siteurl']}forum.php?mobile=yes">{lang go_to_mobile}</a><span class="xg1">|</span><a href="$_G['setting']['mobile']['nomobileurl']">{lang to_be_continue}</a>
		</div>
	<!--{/if}-->
	<!--{if $_G['setting']['shortcut'] && $_G['member'][credits] >= $_G['setting']['shortcut']}-->
		<div id="shortcut">
			<span><a href="javascript:;" id="shortcutcloseid" title="{lang close}">{lang close}</a></span>
			{lang shortcut_notice}
			<a href="javascript:;" id="shortcuttip">{lang shortcut_add}</a>
		</div>
		<script type="text/javascript">setTimeout(setShortcut, 2000);</script>
	<!--{/if}-->
	<!--{if $comiis_header==1}-->
	<!--{ad/headerbanner/wp a_h}-->
	<div id="hd">
		<div class="comiis_nvdiv mb10">
			<div id="comiis_nv">
				<div class="wp comiis_nvbox cl">
					<div class="y comiis_nvlogin">
						<!--{subtemplate common/comiis_user}-->
					</div>
					<ul>
						<!--{eval $mnid = getcurrentnav();}-->
						<li class="comiis_logo"><a href="./" title="{$_G['setting']['bbname']}"><img src="{$_G['style']['styleimgdir']}/comiis_mini_logo.png" height="50"></a></li>
						<!--{loop $_G['setting']['navs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
						<!--{/loop}-->
					</ul>
					<!--{hook/global_nav_extra}-->
				</div>
			</div>
		</div>
		<!--{if $comiis_dbss==1}-->
		<div id="comiis_sousuo_menu" style="display:none;">
			<div class="comiis_dss cl">
					<!--{if $_G['setting']['search']}-->
					<form id="scform" method="post" autocomplete="off" action="$_G[siteurl]search.php?searchsubmit=yes" target="_blank">
						<input type="hidden" name="formhash" value="{FORMHASH}" />
						<input type="hidden" name="mod" value="forum" />
						<input type="text" name="srchtxt" id="srchtxt" class="z" autocomplete="off" onblur="if (value ==''){value='{lang enter_content}'}" onfocus="if (value =='{lang enter_content}'){value =''}" value="{lang enter_content}" />
						<button id="search_submit" name="searchsubmit" type="submit" value="true">搜索</button>
					</form>
					<!--{/if}-->
			</div>
			<div id="scbar_hot" class="cl">
				<!--{if $_G['setting']['srchhotkeywords']}-->
					<strong class="z">{lang hot_search}: </strong>
					<!--{loop $_G['setting']['srchhotkeywords'] $val}-->
						<!--{if $val=trim($val)}-->
							<!--{eval $valenc=rawurlencode($val);}-->
							<!--{block srchhotkeywords[]}-->
								<!--{if !empty($searchparams[url])}-->
									<a href="$searchparams[url]?q=$valenc&source=hotsearch{$srchotquery}" target="_blank" sc="1">$val</a>
								<!--{else}-->
									<a href="search.php?mod=forum&srchtxt=$valenc&formhash={FORMHASH}&searchsubmit=true&source=hotsearch" target="_blank" sc="1">$val</a>
								<!--{/if}-->
							<!--{/block}-->
						<!--{/if}-->
					<!--{/loop}-->
					<!--{echo implode('', $srchhotkeywords);}-->
				<!--{/if}-->
			</div>
		</div>
		<!--{/if}-->
		<!--{if $_G['uid']}-->
		<div id="comiis_key_menu" style="display:none;">
		<div class="comiis_key_menu_div">
			<div class="comiis_user_info">
				<a href="home.php?mod=spacecp&ac=avatar" target="_blank" class="nvtx" title="修改头像"><!--{avatar($_G[uid],small)}--><em>修改</em></a>
				<!--{if $_G['group']['allowinvisible']}-->
				<span id="loginstatus">
					<a id="loginstatusid" href="member.php?mod=switchstatus" title="{lang login_switch_invisible_mode}" onclick="ajaxget(this.href, 'loginstatus');return false;"></a>
				</span>
				<!--{/if}-->
				<a href="home.php?mod=spacecp" target="_blank">{lang setup}</a>
				<a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
				<br>				
				<a href="home.php?mod=spacecp&ac=credit&showcredit=1" target="_blank">{lang credits}: $_G[member][credits]</a> <a href="home.php?mod=spacecp&ac=usergroup" target="_blank">{lang usergroup}: $_G[group][grouptitle]<!--{if $_G[member]['freeze']}--><span class="xi1">({lang freeze})</span><!--{/if}--></a>
			</div>			
			<div class="comiis_user_txt cl">	
				<span class="comiis_user_qq"><!--{hook/global_usernav_extra1}--></span>
				<!--{hook/global_usernav_extra2}-->
				<!--{hook/global_usernav_extra3}-->
				<!--{hook/global_usernav_extra4}-->
				<a href="forum.php?mod=guide&view=my" target="_blank">我的帖子</a>
				<a href="home.php?mod=space&do=favorite&view=me" target="_blank">我的{lang favorite}</a>
				<a href="home.php?mod=space&do=friend" target="_blank">我的{lang friends}</a>				
				<a href="home.php?mod=space&do=pm" target="_blank"{if $_G[member][newpm]} title="{$_G[member][newpm]}条新{lang pm_center}" class="new"{/if}>{lang pm_center}{if $_G[member][newpm]}<span></span>{/if}</a>
				<a href="home.php?mod=space&do=notice" target="_blank"{if $_G[member][newprompt]} title="{$_G[member][newprompt]}条新{lang remind}" class="new"{/if}>{lang remind}{if $_G[member][newprompt]}<span></span>{/if}</a>
				<!--{if $_G[member][newprompt_num][follower]}-->
				<a href="home.php?mod=follow&do=follower" target="_blank" title="$_G[member][newprompt_num][follower]位{lang notice_interactive_follower}" class="new"><!--{lang notice_interactive_follower}--><span></span></a>
				<!--{/if}-->
				<!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
					<a href="home.php?mod=follow" target="_blank" title="{$_G[member][newprompt_num][follow]}条<!--{lang notice_interactive_follow}-->" class="new"><!--{lang notice_interactive_follow}--><span></span></a>
				<!--{/if}-->
				<!--{if $_G[member][newprompt]}-->
					<!--{loop $_G['member']['category_num'] $key $val}-->
					<a href="home.php?mod=space&do=notice&view=$key" target="_blank" title="{$val}条<!--{echo lang('template', 'notice_'.$key)}-->" class="{$key}"><!--{echo lang('template', 'notice_'.$key)}--><span></span></a>
					<!--{/loop}-->
				<!--{/if}-->				
				<!--{if $_G['setting']['taskon'] && !empty($_G['cookie']['taskdoing_'.$_G['uid']])}--><a href="home.php?mod=task&item=doing" id="task_ntc"  target="_blank" class="new">{lang task_doing}</a><!--{/if}-->
				<!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
					<a href="portal.php?mod=portalcp" target="_blank"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a>
				<!--{/if}-->
				<!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
					<a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a>
				<!--{/if}-->
				<!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
					<a href="admin.php" target="_blank">{lang admincp}</a>
				<!--{/if}-->
				<!--{if check_diy_perm($topic)}--><a href="javascript:openDiy();" title="{lang open_diy}">DIY设置</a><!--{/if}-->
				<!--{if empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']}-->
					<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="{if widthauto()}{lang switch_narrow}{else}{lang switch_wide}{/if}"><!--{if widthauto()}-->{lang switch_narrow}<!--{else}-->{lang switch_wide}<!--{/if}--></a>
				<!--{/if}-->
				<div style="clear:both"></div>
			</div>
			<div class="comiis_nv_qmenu cl"> 
				<div class="qmenu_an" id="qmenu_an">
					<a class="next" href="javascript:qmenu_move('1');"><em></em></a>
					<a class="prev" href="javascript:qmenu_move('0');"><em></em></a>
				</div>				
				<div class="qmenu_ico" id="qmenu_loop">
					<ul class="cl" id="qmenu_loopul">
						<!--{loop $_G['setting']['mynavs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->
								<li>{echo str_replace($nav['navname'], '<span>'. $nav['navname'].'</span>', $nav['code']);}</li>
							<!--{/if}-->
						<!--{/loop}-->
						
					</ul> 
				</div>
			</div>
		</div>
		</div>
		<!--{/if}-->
		<div class="wp comiis_nv_pop">
			<!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
				<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
				<!--{loop $_G['setting']['plugins']['jsmenu'] $module}-->
					<!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
					<li>$module[url]</li>
					<!--{/if}-->
				<!--{/loop}-->
				</ul>
			<!--{/if}-->
			$_G[setting][menunavs]
			<div id="mu" class="cl">
			<!--{if $_G['setting']['subnavs']}-->
				<!--{loop $_G[setting][subnavs] $navid $subnav}-->
					<!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
					<ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
					$subnav
					</ul>
					<!--{/if}-->
				<!--{/loop}-->
			<!--{/if}-->
			</div>
			<!--{ad/subnavbanner/a_mu}-->
		</div>
	</div>
	<!--{else}-->
	<div id="toptb" class="cl comiis_toptb">
		<!--{hook/global_cpnav_top}-->
		<div class="wp">
			<div class="z">
				<!--{loop $_G['setting']['topnavs'][0] $nav}-->
					<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
				<!--{/loop}-->
				<!--{hook/global_cpnav_extra1}-->
			</div>
			<div class="y">
				<a id="switchblind" href="javascript:;" onclick="toggleBlind(this)" title="{lang switch_blind}" class="switchblind">{lang switch_blind}</a>
				<!--{hook/global_cpnav_extra2}-->
				<!--{loop $_G['setting']['topnavs'][1] $nav}-->
					<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}-->$nav[code]<!--{/if}-->
				<!--{/loop}-->
				<!--{if empty($_G['disabledwidthauto']) && $_G['setting']['switchwidthauto']}-->
					<a href="javascript:;" id="switchwidth" onclick="widthauto(this)" title="{if widthauto()}{lang switch_narrow}{else}{lang switch_wide}{/if}" class="switchwidth"><!--{if widthauto()}-->{lang switch_narrow}<!--{else}-->{lang switch_wide}<!--{/if}--></a>
				<!--{/if}-->
				<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}--><a id="sslct" href="javascript:;" onmouseover="delayShow(this, function() {showMenu({'ctrlid':'sslct','pos':'34!'})});">{lang changestyle}</a><!--{/if}-->
				<!--{if check_diy_perm($topic)}-->
					$diynav
				<!--{/if}-->
			</div>
		</div>
	</div>
	<!--{if !IS_ROBOT}-->
		<!--{if $_G['uid']}-->
		<ul id="myprompt_menu" class="p_pop" style="display: none;">
			<li><a href="home.php?mod=space&do=pm" id="pm_ntc" style="background-repeat: no-repeat; background-position: 0 50%;"><em class="prompt_news{if empty($_G[member][newpm])}_0{/if}"></em>{lang pm_center}</a></li>
				<li><a href="home.php?mod=follow&do=follower"><em class="prompt_follower{if empty($_G[member][newprompt_num][follower])}_0{/if}"></em><!--{lang notice_interactive_follower}-->{if $_G[member][newprompt_num][follower]}($_G[member][newprompt_num][follower]){/if}</a></li>
			<!--{if $_G[member][newprompt] && $_G[member][newprompt_num][follow]}-->
				<li><a href="home.php?mod=follow"><em class="prompt_concern"></em><!--{lang notice_interactive_follow}-->($_G[member][newprompt_num][follow])</a></li>
			<!--{/if}-->
			<!--{if $_G[member][newprompt]}-->
				<!--{loop $_G['member']['category_num'] $key $val}-->
					<li><a href="home.php?mod=space&do=notice&view=$key"><em class="notice_$key"></em><!--{echo lang('template', 'notice_'.$key)}-->(<span class="rq">$val</span>)</a></li>
				<!--{/loop}-->
			<!--{/if}-->
			<!--{if empty($_G['cookie']['ignore_notice'])}-->
			<li class="ignore_noticeli"><a href="javascript:;" onclick="setcookie('ignore_notice', 1);hideMenu('myprompt_menu')" title="{lang temporarily_to_remind}"><em class="ignore_notice"></em></a></li>
			<!--{/if}-->
			</ul>
		<!--{/if}-->
		<!--{if $_G['uid'] && !empty($_G['style']['extstyle'])}-->
			<div id="sslct_menu" class="cl p_pop" style="display: none;">
				<!--{if !$_G[style][defaultextstyle]}--><span class="sslct_btn" onclick="extstyle('')" title="{lang default}"><i></i></span><!--{/if}-->
				<!--{loop $_G['style']['extstyle'] $extstyle}-->
					<span class="sslct_btn" onclick="extstyle('$extstyle[0]')" title="$extstyle[1]"><i style='background:$extstyle[2]'></i></span>
				<!--{/loop}-->
			</div>
			<!--{/if}-->
			<!--{if $_G['uid']}-->
				<ul id="myitem_menu" class="p_pop" style="display: none;">
					<li><a href="forum.php?mod=guide&view=my">帖子</a></li>
					<li><a href="home.php?mod=space&do=favorite&view=me">{lang favorite}</a></li>
					<li><a href="home.php?mod=space&do=friend">{lang friends}</a></li>
					<!--{hook/global_myitem_extra}-->
				</ul>
			<!--{/if}-->
			<!--{subtemplate common/header_qmenu}-->	
	<!--{/if}-->
	<!--{ad/headerbanner/wp a_h}-->
	<div id="hd">
		<div class="wp">
			<div class="hdc cl">
				<!--{eval $mnid = getcurrentnav();}-->
				<h2><!--{if !isset($_G['setting']['navlogos'][$mnid])}--><a href="{if $_G['setting']['domain']['app']['default']}http://{$_G['setting']['domain']['app']['default']}/{else}./{/if}" title="$_G['setting']['bbname']">{$_G['style']['boardlogo']}</a><!--{else}-->$_G['setting']['navlogos'][$mnid]<!--{/if}--></h2>
				<!--{template common/header_userstatus}-->
			</div>
			<div class="wimi" style="clear:both;"></div>
		</div>
		<div class="comiis_nvdiv mb10">
			<div id="comiis_nv">
				<div class="wp comiis_nvbox cl">
					<!--{if $comiis_navss==1}-->
					<div id="sckm" class="y">
					<!--{subtemplate common/comiis_navss}-->
					</div>
					<!--{else}-->
					<a href="javascript:;" id="qmenu" onmouseover="delayShow(this, function () {showMenu({'ctrlid':'qmenu','pos':'34!','ctrlclass':'a','duration':2});showForummenu($_G[fid]);})">{lang my_nav}</a>
					<!--{/if}-->
					<ul>
						<!--{loop $_G['setting']['navs'] $nav}-->
							<!--{if $nav['available'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1))}--><li {if $mnid == $nav[navid]}class="a" {/if}$nav[nav]></li><!--{/if}-->
						<!--{/loop}-->
					</ul>
					<!--{hook/global_nav_extra}-->
				</div>
			</div>
		</div>
		<!--{if $comiis_navss==1 && $_G['setting']['search'] && $slist}-->
			<ul id="comiis_twtsc_type_menu" class="p_pop" style="display: none;"><!--{echo implode('', $slist);}--></ul>
			<script type="text/javascript">
				initSearchmenu('comiis_twtsc', '$searchparams[url]');
			</script>
		<!--{/if}-->
		<div class="wp comiis_nv_pop">
			<!--{if !empty($_G['setting']['plugins']['jsmenu'])}-->
				<ul class="p_pop h_pop" id="plugin_menu" style="display: none">
				<!--{loop $_G['setting']['plugins']['jsmenu'] $module}-->
					<!--{if !$module['adminid'] || ($module['adminid'] && $_G['adminid'] > 0 && $module['adminid'] >= $_G['adminid'])}-->
					<li>$module[url]</li>
					<!--{/if}-->
				<!--{/loop}-->
				</ul>
			<!--{/if}-->
			$_G[setting][menunavs]
			<div id="mu" class="cl">
			<!--{if $_G['setting']['subnavs']}-->
				<!--{loop $_G[setting][subnavs] $navid $subnav}-->
					<!--{if $_G['setting']['navsubhover'] || $mnid == $navid}-->
					<ul class="cl {if $mnid == $navid}current{/if}" id="snav_$navid" style="display:{if $mnid != $navid}none{/if}">
					$subnav
					</ul>
					<!--{/if}-->
				<!--{/loop}-->
			<!--{/if}-->
			</div>
			<!--{if $comiis_navss==2}-->
			<!--{subtemplate common/pubsearchform}-->
			<!--{/if}-->
			<!--{ad/subnavbanner/a_mu}-->
		</div>
	</div>
	<!--{/if}-->
	<!--{hook/global_header}-->
<!--{/if}-->
<script src="{$_G['style']['styleimgdir']}/comiis_nv.js" type="text/javascript"></script>
<div id="wp" class="wp">


