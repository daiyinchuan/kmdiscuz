<?php
if (!defined('IN_DISCUZ')) {
    exit('Access Denied');
}
function get_article_num($aid, $type) {
    $aid = intval($aid);
    $type = trim($type);
    $typearray = array(
        'viewnum',
        'commentnum',
        'favtimes',
        'sharetimes'
    );
    if ($aid == 0 || !in_array($type, $typearray)) {
        return false;
    } else {
        return DB::result_first("SELECT $type FROM " . DB::table('portal_article_count') . " WHERE aid = '$aid'");
    }
}
?>
