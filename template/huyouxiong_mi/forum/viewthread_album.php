<?php echo '忽悠兄分享　禁止进行二次倒卖';exit;?> 
<!--{template common/header}-->
<style>
	#comment, #scrolltop {display:none;}
</style>
<script type="text/javascript">
	var albumback = 0;
	function changealbumback() {
		if(albumback == 0){
			$('nv_forum').style.background='#444';
			$('nv_forum').className = 'albumback<!--{if $comiis_window_width==1}--> comiis_wide<!--{/if}-->';
			$('albumback_sw').innerHTML = '{lang lightopen}';
			albumback = 1;
		}else{
			$('nv_forum').style.background='#FFF';
			$('nv_forum').className = 'albumback_on<!--{if $comiis_window_width==1}--> comiis_wide<!--{/if}-->';
			$('albumback_sw').innerHTML = '{lang lightclose}';
			albumback = 0;
		}
	}
</script>
<script type="text/javascript">var fid = parseInt('$_G[fid]'), tid = parseInt('$_G[tid]');</script>
<!--{if $_G['forum']['ismoderator']}-->
	<script type="text/javascript" src="{$_G['setting']['jspath']}forum_moderate.js?{VERHASH}"></script>
<!--{/if}-->

<script type="text/javascript" src="{$_G['setting']['jspath']}forum_viewthread.js?{VERHASH}"></script>
<script type="text/javascript">zoomstatus = parseInt($_G['setting']['zoomstatus']);var imagemaxwidth = '{$_G['setting']['imagemaxwidth']}';var aimgcount = new Array();</script>

<div id="pt" class="bm cl">
	<div class="z">
		<a href="./" class="nvhm" title="{lang homepage}">$_G[setting][bbname]</a><em>&raquo;</em><a href="forum.php">{$_G[setting][navs][2][navname]}</a>$navigation <em>&rsaquo;</em> <a href="forum.php?mod=viewthread&tid=$_G[tid]">$_G[forum_thread][short_subject]</a>
	</div>
</div>

<style id="diy_style" type="text/css"></style>
<div class="wp">
	<!--[diy=diy1]--><div id="diy1" class="area"></div><!--[/diy]-->
</div>

<!--{hook/viewthread_beginline}-->

<div id="ct" class="ct2 wp cl">
		<div class="pic_h bm vw pl">
			<div class="h hm cl">
				<div class="img_tit_t cl">				
					<h1 class="ph z">$_G[forum_thread][subject]</h1>
					<div class="ph_r_con xg1 y vm">{lang home_view_num}:<span class="xi1"> $_G[forum_thread][views]</span> <span class="pipe">|</span> {lang comment_num}: <span class="xi1">$_G[forum_thread][replies]</span> <span class="pipe">|</span> <a href="home.php?mod=spacecp&ac=favorite&type=thread&id=$_G[tid]" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' {lang activity_member_unit}{lang thread_favorite}'">{lang thread_favorite} <span id="favoritenumber" class="xi1">{$_G['forum_thread']['favtimes']}</span></a><!--{if (($_G['forum']['ismoderator'] && $_G['group']['alloweditpost'] && (!in_array($post['adminid'], array(1, 2, 3)) || $_G['adminid'] <= $post['adminid'])) || ($_G['forum']['alloweditpost'] && $_G['uid'] && ($post['authorid'] == $_G['uid'] && $_G['forum_thread']['closed'] == 0) && !(!$alloweditpost_status && $edittimelimit && TIMESTAMP - $post['dbdateline'] > $edittimelimit)))}-->
					<span class="pipe">|</span><a href="forum.php?mod=post&action=edit&fid=$_G[fid]&tid=$_G[tid]&pid=$post[pid]{if !empty($_GET[modthreadkey])}&modthreadkey=$_GET[modthreadkey]{/if}&page=$page{if $_GET[from]}&from=$_GET[from]{/if}"><!--{if $_G['forum_thread']['special'] == 2 && !$post['message']}-->{lang post_add_aboutcounter}<!--{else}--><span class="xi2">{lang edit}</span></a><!--{/if}-->
					<!--{/if}--></div>
				</div>
				<div class="xg1 z">
					<a id="albumback_sw" href="javascript:void(0);" onclick="changealbumback();">{lang lightopen}</a>
					<span class="pipe">|</span>
					<span class="keyboard-tip">{lang keyboard_tip}</span>
				</div>
				<div class="xg1 y"><a href="forum.php?mod=viewthread&tid=$_G[tid]" class="thread_mod xg1"><span>{lang thread_mod}</span></a></div>
			</div>
			<div class="d">
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td width="780">
							<div class="photo_pic">
								<div id="photo_pic" style="position: relative; text-align: center;">
									<img alt="" id="pic" style="max-width: 780px;_width: 780px;" src="$imglist['url'][0]">
								</div>
								<div id="imagelist_nav">
									<div class="imagelist_album">
										<a id="goleft" class="left" onclick="imagelist_go('prev');" href="javascript:void(0);"></a>
										<div id="imagelistwarp" class="left">
											<ul id="imagelistthumb" style="width: <!--{echo count($imglist[aid]) * 110;}-->px; left: 0px;"><img src="static/image/common/loading.gif" width="16" height="16" class="vm" /> {lang waitpicloading}......</ul>
											<a id="currentpic" class="mask" href="javascript:void(0)" style="left: 0px;"></a>
										</div>
										<a id="goright" class="right" onclick="imagelist_go('next');" href="javascript:void(0);"></a>
									</div>
								</div>
							</div>
							<!--{if !empty($imglist)}-->
							<script type="text/javascript" reload="1">
								var imagewidth = 110;
								var curnum = 0;
								var imagecount = '<!--{echo count($imglist[aid]);}-->';
								function imagelist_go(type) {
									var width = '<!--{echo count($imglist[aid]) * 110;}-->';
									var left = parseInt($('imagelistthumb').style.left.substr(0, ($('imagelistthumb').style.left.length - 2)));
									var curleft = parseInt($('currentpic').style.left.substr(0, ($('imagelistthumb').style.left.length - 2)));
									if(type == 'next') {
										if(left > -(width - 730)) {
											newleft = imagewidth * 4;
											if(left - newleft < -(width - 730)) {
												newleft = width - 730 - left;
											}
											imagelist_scrolleft('imagelistthumb', left, newleft);
											imagelist_scrolleft('currentpic', curleft, newleft);
										}
									} else {
										if(left < 0) {
											newleft = imagewidth * 4;
											if(left + newleft > 0) {
												newleft = -left;
											}
											imagelist_scrolleft('imagelistthumb', left, newleft, 'add');
											imagelist_scrolleft('currentpic', curleft, newleft, 'add');
										}
									}
								}
								function imagelist_scrolleft(id, left, num, type) {
										if(type == 'add') {
											left += num;
										} else {
											left -= num;
										}
										$(id).style.left = left +'px';
								}
								function current_pic(n) {
									curnum = n;
									var left = parseInt($('imagelistthumb').style.left.substr(0, ($('imagelistthumb').style.left.length - 2)));
									$('pic').src=imglist['url'][n];
									var curleft = imagewidth * n;
									if(imagecount > 7 && n >= 4) {
										if(n < (imagecount - 4)) {
											curleft = imagewidth * 3;
											imagelist_scrolleft('imagelistthumb', 0, imagewidth * (n-3));
										} else {
											curleft = imagewidth * (7 - (imagecount - n));
											imagelist_scrolleft('imagelistthumb', 0, imagewidth * (imagecount-7));
										}
									} else {
										imagelist_scrolleft('imagelistthumb', 0, 0);
									}
									$('currentpic').style.left = curleft+'px';
								}
								<!--{eval $imagelistkey = dsign($_G[tid].'|100|100')}-->
								var imagelistkey = '$imagelistkey';
								var imglist = new Array();
								var imagelist_html = '';
								imglist['aid'] = [<!--{echo dimplode($imglist[aid]);}-->];
								imglist['url'] = [<!--{echo dimplode($imglist[url]);}-->];
								var count = imglist['aid'].length;
								for(i = 0; i < count; i++) {
									imagelist_html += '<li><div class="">' +'<img src="forum.php?mod=image&aid=' + imglist['aid'][i] + '&size=100x100&key=' + imagelistkey + '&atid={$post[tid]}" width="100" height="100" onclick="current_pic('+i+');"/><span>'+(i+1)+'/'+count+'</span></div></li>';
								}
								$('imagelistthumb').innerHTML = imagelist_html;

								function createElem(e){
									var obj = document.createElement(e);
									obj.style.position = 'absolute';
									obj.style.zIndex = '1';
									obj.style.cursor = 'pointer';
									obj.onmouseout = function(){ this.style.background = 'none';}
									return obj;
								}
								function viewPhoto(){
									var divappend = 0;
									if(!$('pic-prev')) {
										var pager = createElem('div');
										var pre = createElem('div');
										var next = createElem('div');
										pager.id='pager';
										pre.id='pic-prev';
										next.id='pic-next';
										divappend = 1;
									} else {
										var pager = $('pager');
										var pre = $('pic-prev');
										var next = $('pic-next');
									}
									var cont = $('photo_pic');
									var tar = $('pic');
									var w = 390;
									var objpos = fetchOffset(tar);
									pager.style.position = 'absolute';
									pager.style.left = '0px';
									pager.style.top = '0px';
									pager.style.width = '780px';
									pager.style.height = tar.height + 'px';
									pre.style.left = 0;
									next.style.right = 0;
									pre.style.width = next.style.width = w + 'px';
									pre.style.height = next.style.height = tar.height + 'px';
									pre.innerHTML = next.innerHTML = '<img src="{IMGDIR}/emp.gif" width="' + w + '" height="' + tar.height + '" />';

									pre.onmouseover = function(){ this.style.background = 'url({IMGDIR}/pic-prev.png) no-repeat 0 50%'; }
									pre.onclick = function(){if(curnum>=1) {$('pic').src=imglist['url'][curnum-1];current_pic(curnum-1);}}
									pre.title = '';

									next.onmouseover = function(){ this.style.background = 'url({IMGDIR}/pic-next.png) no-repeat 100% 50%'; }
									next.onclick = function(){if(curnum < imagecount - 1) {$('pic').src=imglist['url'][curnum+1];current_pic(curnum+1);}}
									next.title = '';

									//cont.style.position = 'relative';
									if(divappend == 1) {
										cont.appendChild(pager);
										pager.appendChild(pre);
										pager.appendChild(next);
									}

								}
								var onopen = 0;
								$('pic').onload = function(){
									viewPhoto();
									if(onopen == 0) {
										onopen = 1;
									} else {
										var imagepos = fetchOffset($('photo_pic'));
										document.documentElement.scrollTop = imagepos['top'];
									}
								}
								document.onkeyup = function(e){
									e = e ? e : window.event;
									var tagname = BROWSER.ie ? e.srcElement.tagName : e.target.tagName;
									if(tagname == 'INPUT' || tagname == 'TEXTAREA') return;
									actualCode = e.keyCode ? e.keyCode : e.charCode;
									if(actualCode == 39) {
										$('pic-next').click();
									}
									if(actualCode == 37) {
										$('pic-prev').click();
									}
								}
							</script>
							<!--{/if}-->

							<!--{if !IS_ROBOT && $post['first'] && !$_G['forum_thread']['archiveid']}-->
								<!--{if !empty($lastmod['modaction'])}--><div class="modact xs1"><a href="forum.php?mod=misc&action=viewthreadmod&tid=$_G[tid]" title="{lang thread_mod}" onclick="showWindow('viewthreadmod', this.href)">{lang thread_mod_by}</a></div><!--{/if}-->
								<!--{if $post['invisible'] == 0}-->
									<div id="p_btn" class="mtw mbm cl xs1" style="display:none;">
										<!--{hook/viewthread_useraction_prefix}-->
										<!--{if helper_access::check_module('share')}-->
											<a href="home.php?mod=spacecp&ac=share&type=thread&id=$_G[tid]" id="k_share" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('sharenumber').innerHTML + ' {lang activity_member_unit}{lang thread_share}'"><i><img src="{IMGDIR}/oshr.png" alt="{lang thread_share}" />{lang thread_share}<span id="sharenumber">{$_G['forum_thread']['sharetimes']}</span></i></a>
										<!--{/if}-->
										<a href="home.php?mod=spacecp&ac=favorite&type=thread&id=$_G[tid]" id="k_favorite" onclick="showWindow(this.id, this.href, 'get', 0);" onmouseover="this.title = $('favoritenumber').innerHTML + ' {lang activity_member_unit}{lang thread_favorite}'"><i><img src="{IMGDIR}/fav.gif" alt="{lang thread_favorite}" />{lang thread_favorite}<span id="favoritenumber">{$_G['forum_thread']['favtimes']}</span></i></a>
										<!--{if ($_G['group']['allowrecommend'] || !$_G['uid']) && $_G['setting']['recommendthread']['status']}-->
											<!--{if !empty($_G['setting']['recommendthread']['addtext'])}-->
											<a id="recommend_add" href="forum.php?mod=misc&action=recommend&do=add&tid=$_G[tid]&hash={FORMHASH}" {if $_G['uid']}onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate({$_G['group']['allowrecommend']})');return false;"{else} onclick="showWindow('login', this.href)"{/if} onmouseover="this.title = $('recommendv_add').innerHTML + ' {lang activity_member_unit}$_G[setting][recommendthread][addtext]'"><i><img src="{IMGDIR}/rec_add.gif" alt="$_G['setting']['recommendthread'][addtext]" />$_G['setting']['recommendthread'][addtext]<span id="recommendv_add">$_G[forum_thread][recommend_add]</span></i></a>
											<!--{/if}-->
											<!--{if !empty($_G['setting']['recommendthread']['subtracttext'])}-->
											<a id="recommend_subtract" href="forum.php?mod=misc&action=recommend&do=subtract&tid=$_G[tid]&hash={FORMHASH}" {if $_G['uid']}onclick="ajaxmenu(this, 3000, 1, 0, '43', 'recommendupdate(-{$_G['group']['allowrecommend']})');return false;"{else} onclick="showWindow('login', this.href)"{/if} onmouseover="this.title = $('recommendv_subtract').innerHTML + ' {lang activity_member_unit}$_G[setting][recommendthread][subtracttext]'"><i><img src="{IMGDIR}/rec_subtract.gif" alt="$_G['setting']['recommendthread'][subtracttext]" />$_G['setting']['recommendthread'][subtracttext]<span id="recommendv_subtract">$_G[forum_thread][recommend_sub]</span></i></a>
											<!--{/if}-->
										<!--{/if}-->
										<!--{if $_G['group']['raterange'] && $post['authorid']}-->
											<a href="javascript:;" id="ak_rate" onclick="showWindow('rate', 'forum.php?mod=misc&action=rate&tid=$_G[tid]&pid=$post[pid]{if $_GET[from]}&from=$_GET[from]{/if}');return false;" title="{echo count($postlist[$post[pid]][totalrate]);} {lang people_score}"><i><img src="{IMGDIR}/agree.gif" alt="{lang rate}" />{lang rate}</i></a>
										<!--{/if}-->
										<!--{if $post['first'] && $_G[uid] && $_G[uid] == $post[authorid]}-->
											<a href="misc.php?mod=invite&action=thread&id=$_G[tid]" onclick="showWindow('invite', this.href, 'get', 0);"><i><img src="{IMGDIR}/activitysmall.gif" alt="{lang invite}" />{lang invite}</i></a>
										<!--{/if}-->
										<!--{hook/viewthread_useraction}-->
									</div>
								<!--{/if}-->
							<!--{/if}-->
						</td>
						<td valign="top" class="album_side_r">
							<div class="album_side">
								<div class="hm mtn mbn">
									<a href="home.php?mod=space&uid=$post[authorid]" target="_blank" class="xi2"><img src="$_G[setting][ucenterurl]/avatar.php?uid=$post[authorid]&size=small" /></a>
									<span class="tit_author">
								<!--{if $_G[forum_thread][author] && $_G[forum_thread][authorid]}-->
									<a href="home.php?mod=space&uid=$_G[forum_thread][authorid]">$_G[forum_thread][author]</a>
									<!--{else}-->
										<!--{if $_G['forum']['ismoderator']}-->
											<a href="home.php?mod=space&uid=$_G[forum_thread][authorid]">{lang anonymous}</a>
										<!--{else}-->
											{lang anonymous}
										<!--{/if}-->
									<!--{/if}-->
									</span>
								</div>
								<div class="date"><span>{lang dateline}:</span> <!--{date($_G[forum_thread][dateline])}--></div>
								<div class="album_info">
									<h3>{lang text_summary}: </h3>
									<p>$post['message']</p>
								</div>
							</div>
						</td>
					</tr>
				</table>
			</div>
		</div>

		<div class="bm vw pl" id="comment">
			<div class="bm_h cl">
				<h2>{lang reply}</h2>
			</div>
			<!--{if $_G['setting']['fastpost'] && $allowpostreply && !$_G['forum_thread']['archiveid']}-->
			<div class="bm_c">
				<!--{subtemplate forum/viewthread_fastpost}-->
			</div>
			<!--{/if}-->
			<div class="bm_c">
			<div id="postlistreply" class="xld xlda mbm"><div id="post_new" class="viewthread_table" style="display: none"></div></div>
			<!--{eval $postcount = 0;}-->
			<!--{loop $postlist $postid $post}-->
				<!--{if $postid && !$post['first']}-->
				<div id="post_$post[pid]" class="xld xlda mbm">
					<!--{subtemplate forum/viewthread_from_node}-->
				</div>
				<!--{/if}-->
				<!--{eval $postcount++;}-->
			<!--{/loop}-->
			</div>
		</div>
</div>

<!--{hook/viewthread_bottom}-->

<!--{if !IS_ROBOT && !empty($_G[setting][lazyload])}-->
	<script type="text/javascript">
	new lazyload();
	</script>
<!--{/if}-->

<div class="wp mtn">
	<!--[diy=diy3]--><div id="diy3" class="area"></div><!--[/diy]-->
</div>
<script>changealbumback();</script>
<!--{template common/footer}-->



