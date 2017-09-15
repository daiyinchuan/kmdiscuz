<?php exit;?>
<!--{template common/header}-->

<script type="text/javascript">var fid = parseInt('$_G[fid]'), tid = parseInt('$_G[tid]');</script>
<!--{if $modmenu['thread'] || $modmenu['post']}-->
	<script type="text/javascript" src="{$_G['setting']['jspath']}forum_moderate.js?{VERHASH}"></script>
<!--{/if}-->

<script type="text/javascript" src="{$_G['setting']['jspath']}forum_viewthread.js?{VERHASH}"></script>
<script type="text/javascript">zoomstatus = parseInt($_G['setting']['zoomstatus']);var imagemaxwidth = '{$_G['setting']['imagemaxwidth']}';var aimgcount = new Array();</script>

<style id="diy_style" type="text/css"></style>
<!--[diy=diynavtop]--><div id="diynavtop" class="area"></div><!--[/diy]-->

<div id="pt" class="bm xiaoyu_view_pt cl">
	<div class="z">
		$navigation
	</div>
    <div class="y">
             <!--{if !$_G['forum_thread']['is_archived']}-->
            <a id="newspecialtmp" class="xiaoyu_post_btn sendtheme" onmouseover="$('newspecial').id = 'newspecialtmp';this.id = 'newspecial';showMenu({'ctrlid':this.id})"{if !$_G['forum']['allowspecialonly'] && empty($_G['forum']['picstyle']) && !$_G['forum']['threadsorts']['required']} onclick="showWindow('newthread', 'forum.php?mod=post&action=newthread&fid=$_G[fid]')"{else} onclick="location.href='forum.php?mod=post&action=newthread&fid=$_G[fid]';return false;"{/if} href="javascript:;" title="{lang send_posts}">+ 发表新主题</a>
         <!--{/if}-->
    </div>
</div>


<!--{hook/viewthread_top}-->
<!--{ad/text/wp a_t}-->

<style id="diy_style" type="text/css"></style>
<div class="wp">
	<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>
 <!--{if $modmenu['thread']}-->
	<div id="modmenu" class="xi2 pbm">
		<!--{eval $modopt=0;}-->
		<!--{if $_G['forum']['ismoderator']}-->
			<!--{if $_G['group']['allowdelpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(3, 'delete')">{lang modmenu_deletethread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowbumpthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(3, 'bump')">{lang modmenu_updown}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstickthread'] && ($_G['forum_thread']['displayorder'] <= 3 || $_G['adminid'] == 1) && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'stick')">{lang modmenu_stickthread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowlivethread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('live')">{lang modmenu_live}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowhighlightthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'highlight')">{lang modmenu_highlight}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowdigestthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'digest')">{lang modmenu_digestpost}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowrecommendthread'] && !empty($_G['forum']['modrecommend']['open']) && $_G['forum']['modrecommend']['sort'] != 1 && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(1, 'recommend')">{lang modmenu_recommend}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstampthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('stamp')">{lang modmenu_stamp}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowstamplist'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('stamplist')">{lang modmenu_icon}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowclosethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(4)"><!--{if !$_G['forum_thread']['closed']}-->{lang modmenu_switch_off}<!--{else}-->{lang modmenu_switch_on}<!--{/if}--></a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowmovethread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(2, 'move')">{lang modmenu_move}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowedittypethread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modthreads(2, 'type')">{lang modmenu_type}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if !$_G['forum_thread']['special'] && !$_G['forum_thread']['is_archived']}-->
				<!--{if $_G['group']['allowcopythread'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('copy')">{lang modmenu_copy}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowmergethread'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('merge')">{lang modmenu_merge}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowrefund'] && $_G['forum_thread']['price'] > 0}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('refund')">{lang modmenu_restore}</a><span class="pipe">|</span><!--{/if}-->
			<!--{/if}-->
			<!--{if $_G['group']['allowsplitthread'] && !$_G['forum_thread']['is_archived'] && $_G['forum']['status'] != 3}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('split')">{lang modmenu_split}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowrepairthread'] && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('repair')">{lang modmenu_repair}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum_thread']['is_archived'] && $_G['adminid'] == 1}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('restore', '', 'archiveid={$_G[forum_thread][archiveid]}')">{lang modmenu_archive}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum_firstpid']}-->
				<!--{if $_G['group']['allowwarnpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('warn', '$_G[forum_firstpid]')">{lang modmenu_warn}</a><span class="pipe">|</span><!--{/if}-->
				<!--{if $_G['group']['allowbanpost']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('banpost', '$_G[forum_firstpid]')">{lang modmenu_banthread}</a><span class="pipe">|</span><!--{/if}-->
			<!--{/if}-->
			<!--{if $_G['group']['allowremovereward'] && $_G['forum_thread']['special'] == 3 && !$_G['forum_thread']['is_archived']}--><!--{eval $modopt++}--><a href="javascript:;" onclick="modaction('removereward')">{lang modmenu_removereward}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['forum']['status'] == 3 && in_array($_G['adminid'], array('1','2')) && $_G['forum_thread']['closed'] < 1}--><a href="javascript:;" onclick="modthreads(5, 'recommend_group');return false;">{lang modmenu_grouprecommend}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['allowmanagetag']}--><a href="javascript:;" onclick="showWindow('mods', 'forum.php?mod=tag&op=manage&tid=$_G[tid]', 'get', 0)">{lang post_tag}</a><span class="pipe">|</span><!--{/if}-->
			<!--{if $_G['group']['alloweditusertag']}--><a href="javascript:;" onclick="showWindow('usertag', 'forum.php?mod=misc&action=usertag&tid=$_G[tid]', 'get', 0)">{lang usertag}</a><span class="pipe">|</span><!--{/if}-->
		<!--{/if}-->
		<!--{if $allowpusharticle && $allowpostarticle}--><!--{eval $modopt++}--><a href="portal.php?mod=portalcp&ac=article&from_idtype=tid&from_id=$_G['tid']">{lang modmenu_pusharticle}</a><span class="pipe">|</span><!--{/if}-->
		<!--{hook/viewthread_modoption}-->
	</div>
<!--{/if}-->
<div id="ct" class="wp cl ct2 xm_ct2">


<div class="mn xm_mn">
<!--{if $modmenu['post']}-->
	<div id="mdly" class="fwinmask" style="display:none;z-index:350;">
		<table cellspacing="0" cellpadding="0" class="fwin">
			<tr>
				<td class="t_l"></td>
				<td class="t_c"></td>
				<td class="t_r"></td>
			</tr>
			<tr>
				<td class="m_l">&nbsp;&nbsp;</td>
				<td class="m_c">
					<div class="f_c">
						<div class="c">
							<h3>{lang admin_select}&nbsp;<strong id="mdct" class="xi1"></strong>&nbsp;{lang piece}: </h3>
							<!--{if $_G['forum']['ismoderator']}-->
								<!--{if $_G['group']['allowwarnpost']}--><a href="javascript:;" onclick="modaction('warn')">{lang modmenu_warn}</a><span class="pipe">|</span><!--{/if}-->
								<!--{if $_G['group']['allowbanpost']}--><a href="javascript:;" onclick="modaction('banpost')">{lang modmenu_banpost}</a><span class="pipe">|</span><!--{/if}-->
								<!--{if $_G['group']['allowdelpost'] && !$rushreply}--><a href="javascript:;" onclick="modaction('delpost')">{lang modmenu_deletepost}</a><span class="pipe">|</span><!--{/if}-->
							<!--{/if}--><!--小.鱼.设计.团.队.Q.Q5628.2838.5 -->
							<!--{if $_G['forum']['ismoderator'] && $_G['group']['allowstickreply'] || $_G['forum_thread']['authorid'] == $_G['uid']}--><a href="javascript:;" onclick="modaction('stickreply')">{lang modmenu_stickpost}</a><span class="pipe">|</span><!--{/if}-->
							<!--{if $_G['forum_thread']['pushedaid'] && $allowpostarticle}--><a href="javascript:;" onclick="modaction('pushplus', '', 'aid=$_G[forum_thread][pushedaid]', 'portal.php?mod=portalcp&ac=article&op=pushplus')">{lang modmenu_pushplus}</a><span class="pipe">|</span><!--{/if}-->
						</div>
					</div>
				</td>
				<td class="m_r"></td>
			</tr>
			<tr>
				<td class="b_l"></td>
				<td class="b_c"></td>
				<td class="b_r"></td>
			</tr>
		</table>
	</div>
<!--{/if}-->


<!--{hook/viewthread_beginline}-->
<div id="postlist" class="pl kym_postlist_bm">

	<!--{eval $postcount = 0;}-->
    
	<!--{loop $postlist $post}-->
		<!--{if $rushreply && $_GET['checkrush'] && $post['rewardfloor'] != 1}-->
			<!--{eval continue;}-->
		<!--{/if}-->
        <!--{if $post['first']}--><div class="xiaoyu_list_vier">
		<div id="post_$post[pid]" {if $_G['blockedpids'] && $post['inblacklist']}style="display:none;"{/if}>
        <!--{subtemplate forum/viewthread_node}-->
		</div></div>
        <!--{/if}-->
		<!--{eval $postcount++;}-->
	<!--{/loop}-->
    <!--{if $_G[forum_thread][allreplies] !=0}--><style></style><!--{else}--><style></style><!--{/if}-->
    <div class="xiaoyu_post_reply">
    
    <div class="reply_con"><!--{if !$post['first']}-->
    <div class="reply_title cl"><h3>精彩评论</h3>
    <span class="replay_num">$_G[forum_thread][allreplies]</span>
    <div class="nonstop">
    <label class="z">{lang thread_redirect_postno}:</label><input type="text" class="px p_fre z nonstop_num" size="2" onkeyup="$('fj_btn').href='forum.php?mod=redirect&ptid=$_G[tid]&authorid=$_GET[authorid]&postno='+this.value" onkeydown="if(event.keyCode==13) {window.location=$('fj_btn').href;return false;}" title="{lang thread_redirect_postno_tips}" />
    <a href="javascript:;" id="fj_btn" class="z" title="{lang thread_redirect_postno_tips}"><img src="{IMGDIR}/fj_btn.png" alt="{lang thread_redirect_postno_tips}" class="vm" /></a>
    </div>
    </div><!--{/if}-->
    </div>
    	<!--{loop $postlist $post}-->
		<!--{if $rushreply && $_GET['checkrush'] && $post['rewardfloor'] != 1}-->
			<!--{eval continue;}-->
		<!--{/if}-->
        <!--{if !$post['first']}-->
        <div id="post_$post[pid]" {if $_G['blockedpids'] && $post['inblacklist']}style="display:none;"{/if}>
        <!--{subtemplate forum/viewthread_node}-->
		</div>
        <!--{/if}-->
		<!--{eval $postcount++;}-->
	<!--{/loop}-->
    <div id="postlistreply" class="pl"><div id="post_new" class="viewthread_table" style="display: none"></div></div>
	<!--{if $_G['blockedpids']}-->
		<div id='hiddenpoststip'><a href='javascript:display_blocked_post();'>{lang other_reply_hide}</a></div>
		<div id="hiddenposts"></div>
	<!--{/if}-->
    <div class="pgs xiaoyu_pgs cl">$multipage</div>	
	</div>
    
</div>

<!--{if $modmenu['thread']}-->
	<div class="xi2 mbm pbm bbs xiaoyu_edit">
	<script type="text/javascript">
		$('modmenu').lastChild.style.visibility = 'hidden';
		document.write($('modmenu').innerHTML);
	</script>
	</div>
<!--{/if}-->

<form method="post" autocomplete="off" name="modactions" id="modactions">
	<input type="hidden" name="formhash" value="{FORMHASH}" />
	<input type="hidden" name="optgroup" />
	<input type="hidden" name="operation" />
	<input type="hidden" name="listextra" value="$_GET[extra]" />
	<input type="hidden" name="page" value="$page" />
</form>

$_G['forum_tagscript']



<!--{hook/viewthread_middle}-->
<!--[diy=diyfastposttop]--><div id="diyfastposttop" class="area"></div><!--[/diy]-->
<!--{if $fastpost}-->
	<!--{subtemplate forum/viewthread_fastpost}-->
<!--{/if}-->

<!--{hook/viewthread_bottom}-->

<!--{if ($_G['setting']['visitedforums']) && $_G['forum']['status'] != 3}-->
	<div id="visitedforums_menu" class="p_pop blk cl" style="display: none;">
		<table cellspacing="0" cellpadding="0">
			<tr>
				<td id="v_forums">
					<h3 class="mbn pbn bbda xg1">{lang viewed_forums}</h3>
					<ul class="xl xl1">
						$_G['setting']['visitedforums']
					</ul>
				</td>
			</tr>
		</table>
	</div>
<!--{/if}-->
<!--{if $_G['medal_list']}-->
<!--{loop $_G['medal_list'] $medalid $medal}-->
	<div id="md_{$medalid}_menu" class="tip tip_4" style="display: none;">
		<div class="tip_horn"></div>
		<div class="tip_c">
			<h4>$medal[name]</h4>
			<p>$medal[description]</p>
		</div>
	</div>
<!--{/loop}-->
<!--{/if}-->

<!--{if !IS_ROBOT && !empty($_G[setting][lazyload])}-->
	<script type="text/javascript">
	new lazyload();
	</script>
<!--{/if}-->

<!--{if !IS_ROBOT && $_G['setting']['threadmaxpages'] > 1}-->
	<script type="text/javascript">document.onkeyup = function(e){keyPageScroll(e, <!--{if $page > 1}-->1<!--{else}-->0<!--{/if}-->, <!--{if $page < $_G['setting']['threadmaxpages'] && $page < $_G['page_next']}-->1<!--{else}-->0<!--{/if}-->, 'forum.php?mod=viewthread&tid=$_G[tid]<!--{if $_GET[authorid]}-->&authorid=$_GET[authorid]<!--{/if}-->', $page);}</script>
<!--{/if}-->
</div>
<div class="sd xm_sd">
    <!--{loop $postlist $post}-->
    <!--{if $post['first'] }-->
    <div class="left_wrap personLayer" id="xiaoyu_infofixed">
    <div class="con">
    <div class="personLayer_msg">
    <a class="user_head" href="home.php?mod=space&uid=$thread['authorid']">
    <!--{avatar($thread['authorid'],small)}-->
    </a>
    <div class="user_msg">
    <span><a href="home.php?mod=space&uid=$post[authorid]" target="_blank" class="user_name">$post[author]</a>$authorverifys</span>
    <p><span class="txt">$post[authortitle]</span></p>
    </div>
    </div>
    
    <div class="xiaoyu_profile">{eval viewthread_profile_node('left', $post);}</div>
    <!--{if $post[authorid] != $_G[uid]}-->
    <a target="_blank" href="home.php?mod=space&uid=$thread['authorid']" class="btn">Ta的主页</a>
    <span class="btn btn-blue J_sendmsg"><a href="home.php?mod=spacecp&ac=pm&op=showmsg&handlekey=showmsg_$post[authorid]&touid=$post[authorid]&pmid=0&daterange=2&pid=$post[pid]&tid=$post[tid]" onclick="showWindow('sendpm', this.href);" title="{lang viewthread_left_sendpm}">{lang viewthread_left_sendpm}</a></span><!--{/if}-->
    </div>
	</div>
    <!--{/if}-->
    <!--{/loop}-->
  <div class="left_wrap"> 
   <div class="con">
   <!--{if !$subforumonly}-->
    <ul class="xm_index_info">
     <li><span class="num">$_G[forum][threads]</span><span class="txt">今日版块主题数</span></li> 
     <li><span class="num">$_G[forum][todayposts]</span><span class="txt">今日版块发帖数</span></li> 
     <li><span class="num">$_G[forum][yesterdayposts]</span><span class="txt">昨日版块发帖数</span></li> 
     <li><span class="num">$_G[forum][posts]</span><span class="txt">版块总发帖数</span></li> 
    </ul>
    <!--{/if}-->
    <!--[diy=xiiaoyuonlybottom]--><div id="xiiaoyuonlybottom" class="area"></div><!--[/diy]-->  
   </div> 
  </div>
<div class="left_wrap "> 
   <div class="con">
   <div class="xiaoyu_adshow">
    <!--[diy=diy_jiaoc]--> 
    <div id="diy_jiaoc" class="area"></div> 
    <!--[/diy]--> 
    </div>
   </div> 
  </div>
</div>
</div>

<div class="wp mtn">
	<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<!--{if $_G['relatedlinks'] || $_GET['highlight']}-->
	<script type="text/javascript">
		var relatedlink = [];
		<!--{loop $_G['relatedlinks'] $key $link}-->
		relatedlink[$key] = {'sname':'$link[name]', 'surl':'$link[url]'};
		<!--{/loop}-->
		{eval $highlights = explode(' ', str_replace(array('\'', chr(125)), array('&#039;', '&#125;'), dhtmlspecialchars($_GET['highlight'])));}
		<!--{loop $highlights $word}-->
		{eval $key++;}
		relatedlink[$key] = {'sname':'$word', 'surl':''};
		<!--{/loop}-->
		relatedlinks('postmessage_$_G[forum_firstpid]');
	</script>
<!--{/if}-->

<!--{if !empty($_G['cookie']['clearUserdata']) && $_G['cookie']['clearUserdata'] == 'forum'}-->
	<script type="text/javascript">saveUserdata('forum_'+discuz_uid, '')</script>
<!--{/if}-->

<script type="text/javascript">
<!--{if $_G['forum']['picstyle'] && ($_G['forum']['ismoderator'] || $_G['uid'] == $_G['thread']['authorid'])}-->
function showsetcover(obj) {
	if(obj.parentNode.id == 'postmessage_$_G[forum_firstpid]') {
		var defheight = $_G['setting']['forumpicstyle']['thumbheight'];
		var defwidth = $_G['setting']['forumpicstyle']['thumbwidth'];
		var newimgid = 'showcoverimg';
		var imgsrc = obj.src ? obj.src : obj.file;
		if(!imgsrc) return;

		var tempimg=new Image();
		tempimg.src=imgsrc;
		if(tempimg.complete) {
			if(tempimg.width < defwidth || tempimg.height < defheight) return;
		} else {
			return;
		}
		if($(newimgid) && obj.id != newimgid) {
			$(newimgid).id = 'img'+Math.random();
		}
		if($(newimgid+'_menu')) {
			var menudiv = $(newimgid+'_menu');
		} else {
			var menudiv = document.createElement('div');
			menudiv.className = 'tip tip_4 aimg_tip';
			menudiv.id = newimgid+'_menu';
			menudiv.style.position = 'absolute';
			menudiv.style.display = 'none';
			obj.parentNode.appendChild(menudiv);
		}
		menudiv.innerHTML = '<div class="tip_c xs0"><a onclick="showWindow(\'setcover_'+newimgid+'\', this.href)" href="forum.php?mod=ajax&amp;action=setthreadcover&amp;tid=$_G[tid]&amp;pid=$_G[forum_firstpid]&amp;fid=$_G[fid]&imgurl='+imgsrc+'">{lang set_cover}</a></div>';
		obj.id = newimgid;
		showMenu({'ctrlid':newimgid,'pos':'12'});
	}
	return;
}
<!--{/if}-->
function succeedhandle_followmod(url, msg, values) {
	var fObj = $('followmod_'+values['fuid']);
	if(values['type'] == 'add') {
		fObj.innerHTML = '{lang nofollow}';
		fObj.href = 'home.php?mod=spacecp&ac=follow&op=del&fuid='+values['fuid'];
	} else if(values['type'] == 'del') {
		fObj.innerHTML = '{lang follow}';
		fObj.href = 'home.php?mod=spacecp&ac=follow&op=add&hash={FORMHASH}&fuid='+values['fuid'];
	}
}
<!--{if $_G['blockedpids']}-->
var blockedPIDs = [<!--{echo implode(',', $_G['blockedpids'])}-->];
<!--{/if}-->
<!--{if $postlist && empty($_G['setting']['disfixedavatar'])}-->
fixed_avatar([<!--{echo implode(',', array_keys($postlist))}-->], {if empty($_G['setting']['disfixednv_viewthread']) }1{else}0{/if});
<!--{elseif empty($_G['setting']['disfixednv_viewthread'])}-->
fixed_top_nv();
<!--{/if}-->
</script>
<!--{template common/footer}-->

