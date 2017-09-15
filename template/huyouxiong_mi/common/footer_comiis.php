<?php echo '忽悠兄分享　禁止进行二次倒卖';exit;?> 
<div style="clear:both;"></div>
<div class="comiis_footer cl">
<div id="ft" class="wp comiis_bottom cl ">
		<div class="comiis_demail">
			<p><em>意见反馈</em></p><a href="mailto:admin@admin.com?subject=意见反馈" rel="nofollow">admin@admin.com</a>
		</div>
		<div class="comiis_dico">
			<a href="#" target="_blank" title="关注官方微信"><img src="{$_G['style']['styleimgdir']}/comiis_dico01.jpg" height="36"></a>
			<a href="#" target="_blank" title="关注新浪微博"><img src="{$_G['style']['styleimgdir']}/comiis_dico02.jpg" height="36"></a>
			<a href="#" target="_blank" title="关注QQ空间"><img src="{$_G['style']['styleimgdir']}/comiis_dico03.jpg" height="36"></a>
		</div>
	<div id="frt">
		<a href="$_G['setting']['siteurl']" rel="nofollow" class="comiis_dlogo" target="_blank"><img src="{$_G['style']['styleimgdir']}/comiis_dlogo.jpg" height="45"></a>
		<p>
			<!--{loop $_G['setting']['footernavs'] $nav}--><!--{if $nav['available'] && ($nav['type'] && (!$nav['level'] || ($nav['level'] == 1 && $_G['uid']) || ($nav['level'] == 2 && $_G['adminid'] > 0) || ($nav['level'] == 3 && $_G['adminid'] == 1)) ||
					!$nav['type'] && ($nav['id'] == 'stat' && $_G['group']['allowstatdata'] || $nav['id'] == 'report' && $_G['uid'] || $nav['id'] == 'archiver' || $nav['id'] == 'mobile' || $nav['id'] == 'darkroom'))}-->$nav[code]<span class="pipe">|</span><!--{/if}--><!--{/loop}-->			
			<!--{if $_G['setting']['statcode']}-->$_G['setting']['statcode']<!--{/if}--> <!--{hook/global_footerlink}--> <!--{if $_G['setting']['site_qq']}--><span class="pipe">|</span><a href="http://wpa.qq.com/msgrd?V=3&uin=$_G['setting']['site_qq']&Site=$_G['setting']['bbname']&Menu=yes&from=discuz" target="_blank" title="QQ">客服QQ：{$_G['setting']['site_qq']}</a><!--{/if}-->
		</p>
		<p>Copyright &copy; 2008-2015 <a href="$_G['setting']['siteurl']" rel="nofollow" target="_blank">$_G['setting']['sitename']</a> $_G['setting']['siteurl'] 版权所有 All Rights Reserved.</p>
	</div>
</div>
	<div style="clear:both;"></div>
	<div class="comiis_copy">
			Powered by <a href="http://www.veool.com" target="_blank">lbw3!</a> $_G['setting']['version']&nbsp;
			<!---*感谢你对忽悠兄的支持, 为获得更多忽悠兄的技术支持和服务, 建议保留下面忽悠兄的版权连接，谢谢!*--->
			技术支持: <A href="http://huyouxiong.com" target="_blank" rel="nofollow" title="忽悠兄">忽悠兄</A> <!--{if $_G['setting']['icp']}--><a href="http://www.miitbeian.gov.cn/" target="_blank">$_G['setting']['icp']</a><!--{/if}-->
	</div>
</div>


