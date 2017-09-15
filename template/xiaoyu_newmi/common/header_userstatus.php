<?php exit;?>
<!--{if $_G['uid']}-->
<div class="user_wrap">
    <div id="login" class="topbar-info J_userInfo ">
        <a href="home.php?mod=space&do=pm" class="header_msg_wrap"><span class="headerbtn header_msg">{lang pm_center}</span><!--{if $_G[member][newpm]}--><span class="msgnum" style=" color:#FF0000">($_G[member][newpm])</span><!--{/if}--></a>
        <a class="user clearfix" href="home.php?mod=space&uid=$_G[uid]"><!--{avatar($_G[uid],small)}--><span class="user_name">{$_G[member][username]}</span></a>
        <div class="user_con" style="display: none;">
            <p>{lang credits}: $_G[member][credits]<br>
                {lang usergroup}: $_G[group][grouptitle]<!--{if $_G[member]['freeze']}--><span class="xi1">({lang freeze})</span><!--{/if}-->
            </p>
            <div class="xiaoyu_hook_user cl" style="padding:0; margin:0"><!--{hook/global_usernav_extra1}--></div>
            <div class="cl">
                <a href="home.php?mod=space&do=notice">{lang remind}
                <!--{if $_G[member][newprompt]}--><span style="color:#FF0000; display:inline">($_G[member][newprompt])</span><!--{/if}--></a>
                <!--{if check_diy_perm($topic)}-->
                <a href="javascript:openDiy();" >DIY设置</a>
                <!--{/if}-->
                <a href="home.php?mod=space&uid=$_G[uid]&do=thread&view=me&from=space">我的帖子</a>
                <a href="home.php?mod=space&do=favorite&view=me">我的收藏</a>
                <a href="home.php?mod=spacecp">个人设置</a>
                
                <!--{if ($_G['group']['allowmanagearticle'] || $_G['group']['allowpostarticle'] || $_G['group']['allowdiy'] || getstatus($_G['member']['allowadmincp'], 4) || getstatus($_G['member']['allowadmincp'], 6) || getstatus($_G['member']['allowadmincp'], 2) || getstatus($_G['member']['allowadmincp'], 3))}-->
                <a href="portal.php?mod=portalcp"><!--{if $_G['setting']['portalstatus'] }-->{lang portal_manage}<!--{else}-->{lang portal_block_manage}<!--{/if}--></a>
                <!--{/if}-->
                <!--{if $_G['uid'] && $_G['group']['radminid'] > 1}-->
                <a href="forum.php?mod=modcp&fid=$_G[fid]" target="_blank">{lang forum_manager}</a>
                <!--{/if}-->
                <!--{if $_G['uid'] && $_G['adminid'] == 1 && $_G['setting']['cloud_status']}-->
                <a href="admin.php?frames=yes&action=cloud&operation=applist" target="_blank">{lang cloudcp}</a>
                <!--{/if}-->
                <!--{if $_G['uid'] && getstatus($_G['member']['allowadmincp'], 1)}-->
                <a href="admin.php" target="_blank">{lang admincp}</a>
                <!--{/if}-->
                
                <a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
                
            </div>
            
        </div>
    </div>
						
					</div>
<!--{elseif !empty($_G['cookie']['loginuser'])}-->
<p>
	<strong><a id="loginuser" class="noborder"><!--{echo dhtmlspecialchars($_G['cookie']['loginuser'])}--></a></strong>
	<span class="pipe">|</span><a href="member.php?mod=logging&action=login" onclick="showWindow('login', this.href)">{lang activation}</a>
	<span class="pipe">|</span><a href="member.php?mod=logging&action=logout&formhash={FORMHASH}">{lang logout}</a>
</p>
<!--{elseif !$_G[connectguest]}-->
<div class="user_wrap">
    <div class="topbar-info J_userInfo" id="login">
        <a onclick="showWindow('login', this.href)" href="member.php?mod=logging&action=login" class="loginbtn">登 录</a>
        <a href="member.php?mod=register" class="registerbtn">&nbsp;注册</a>
    </div>
</div>	
<!--{else}-->
<div class="user_wrap">
    <div class="topbar-info J_userInfo" id="login">
        <a class="loginbtn">{$_G[member][username]}</a>
        <a href="member.php?mod=logging&action=logout&formhash={FORMHASH}" class="registerbtn">{lang logout}</a>
    </div>
</div>

<!--{/if}-->
