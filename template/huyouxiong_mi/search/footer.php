<?php echo '忽悠兄分享　禁止进行二次倒卖';exit;?> 
<!--{eval $focusid = getfocus_rand($_G[basescript]);}-->
<!--{if $focusid !== null}-->
	<!--{eval $focus = $_G['cache']['focus']['data'][$focusid];}-->
	<div class="focus" id="focus">
		<div class="bm">
			<div class="bm_h cl">
				<a href="javascript:;" onclick="setcookie('nofocus_$focusid', 1, $_G['cache']['focus']['cookie']*3600);$('focus').style.display='none'" class="y" title="{lang close}">{lang close}</a>
				<h2><!--{if $_G['cache']['focus']['title']}-->{$_G['cache']['focus']['title']}<!--{else}-->{lang focus_hottopics}<!--{/if}--></h2>
			</div>
			<div class="bm_c">
				<dl class="xld cl bbda">
					<dt><a href="{$focus['url']}" class="xi2" target="_blank">$focus['subject']</a></dt>
					<!--{if $focus[image]}-->
					<dd class="m"><a href="{$focus['url']}" target="_blank"><img src="{$focus['image']}" alt="$focus['subject']" /></a></dd>
					<!--{/if}-->
					<dd>$focus['summary']</dd>
				</dl>
				<p class="ptn hm"><a href="{$focus['url']}" class="xi2" target="_blank">{lang focus_show} &raquo;</a></p>
			</div>
		</div>
	</div>
<!--{/if}-->
<!--{ad/footerbanner/wp a_f hm/1}--><!--{ad/footerbanner/wp a_f hm/2}--><!--{ad/footerbanner/wp a_f hm/3}-->
<!--{ad/float/a_fl/1}--><!--{ad/float/a_fr/2}-->
<!--{ad/couplebanner/a_fl a_cb/1}--><!--{ad/couplebanner/a_fr a_cb/2}-->
<!--{hook/global_footer}-->
<!--{template common/footer_comiis}-->
<!--{eval updatesession();}-->
<!--{if $_G[uid] && !isset($_G['cookie']['checkpm'])}-->
<script language="javascript"  type="text/javascript" src="home.php?mod=spacecp&ac=pm&op=checknewpm&rand=$_G[timestamp]"></script>
<!--{/if}-->
<!--{eval output();}-->
</body>
</html>


