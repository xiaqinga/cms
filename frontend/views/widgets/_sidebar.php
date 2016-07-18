<?php
/**
 * Created by PhpStorm.
 * User: f
 * Date: 16/6/21
 * Time: 下午2:26
 */
use frontend\controllers\components\Article;
use yii\helpers\Url;
?>
<aside class="sidebar">
    <div class="widget widget_text">
        <div class="textwidget">
            <div class="social">
                <a href="http://www.weibo.com/feeppp" rel="external nofollow" title="" target="_blank" data-original-title="新浪微博"><i class="sinaweibo fa fa-weibo"></i></a>
                <a href="http://www.facebook.com/feeppp" rel="external nofollow" title="" target="_blank" data-original-title="Facebook"><i class="facebook fa fa-facebook"></i></a>
                <a class="weixin" data-original-title="" title=""><i class="weixins fa fa-weixin"></i>
                    <div class="weixin-popover">
                        <div class="popover bottom in">
                            <div class="arrow"></div>
                            <div class="popover-title">订阅号“feeflying”</div>
                            <div class="popover-content"><img src="/static/images/weixin.jpg"></div></div>
                    </div>
                </a>
                <a href="mailto:admin@feehi.com" rel="external nofollow" title="" target="_blank" data-original-title="Email"><i class="email fa fa-envelope-o"></i></a>
                <a href="http://wpa.qq.com/msgrd?v=3&amp;uin=1838889850&amp;site=qq&amp;menu=yes" rel="external nofollow" title="" target="_blank" data-original-title="联系QQ"><i class="qq fa fa-qq"></i></a>
                <a href="/" rel="external nofollow" target="_blank" title="" data-original-title="订阅本站"><i class="rss fa fa-rss"></i></a>
            </div>
        </div>
    </div>
    <div class="widget d_textbanner">
        <a class="style03" target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=3693ea25b07705069bc9210c5272830f2b00bd891b14bb6f60ce7bb070570aa9">
            <strong>加群啦</strong>
            <h2>官方QQ群-主群</h2>
            <p>飞嗨官方QQ群-主群 群号：258780872，欢迎大家！
                <br>
                <br>
                <img border="0" src="/static/images/group.png" alt="feehi cms" title="feehi cms">
            </p>
        </a>
    </div>

    <div class="widget d_textbanner">
        <a class="style01" href="http://cms.feehi.com">
            <strong>Feehi cms 新一代内容管理系统</strong><h2>吐血推荐</h2>
            <p>Feehi cms是一款机遇优秀php框架yii2开发的新一代cms系统，使用了php最新版本(php7)带来的新特性，会让网站显得内涵而出色...</p>
        </a>
    </div>

    <div class="widget d_banner">
        <div class="d_banner_inner">
            <a href="/" target="_blank" title="垂直自媒体wordpress博客主题：Geek">
                <img src="/static/images/2016050208553249.jpg" alt="棕红色响应式垂直自媒体wordpress博客主题：Geek"><span></span>
            </a>
        </div>
    </div>

    <div class="widget d_postlist">
        <div class="title"><h2><sapn class="title_span">热门推荐</sapn></h2></div>
        <ul>
            <?php
            $articles = Article::getArticleLists(['flag_roll'=>1], 8);
            foreach ($articles as $article){
                $url = Url::to(['article/view', 'id'=>$article->id]);
                $article->created_at = yii::$app->formatter->asDate($article->created_at);
                echo
                "<li>
                    <a href=\"{$url}\" title=\"{$article->title}\">
                        <span class=\"thumbnail\"><img src=\"/timthumb.php?w=125&h=86&zc=0&src={$article->thumb}\" alt=\"{$article->title}\"></span>
                        <span class=\"text\">{$article->title}</span>
                        <span class=\"muted\">{$article->created_at}</span><span class=\"muted_1\">{$article->comment_count}评论</span>
                    </a>
                </li>";
            }
            ?>
        </ul>
    </div>

    <div class="widget d_banner">
        <div class="d_banner_inner">
            <img class="alignnone size-full wp-image-516" src="/static/images/t01605ab9200e1b43f8.jpg" alt="ddy" width="308">
        </div>
    </div>
    <div class="widget d_tag">
        <div class="title"><h2><sapn class="title_span">标签云</sapn></h2></div>
        <div class="d_tags">
            <?php
            $tags = Article::getTags(12);
            foreach($tags as $k => $v){
                echo    "<a title='' href='".Url::to(['search/index', 'q'=>$k])."' data-original-title='{$v}个话题'>{$k} ({$v})</a>";
            }
            ?>
        </div>
    </div>

    <div class="widget d_subscribe">
        <div class="title"><h2><sapn class="title_span">邮件订阅</sapn></h2></div>
        <form action="http://list.qq.com/cgi-bin/qf_compose_send" target="_blank" method="post">
            <p>订阅精彩内容</p>
            <input type="hidden" name="t" value="qf_booked_feedback">
            <input type="hidden" name="id" value="">
            <input type="email" name="to" class="rsstxt" placeholder="your@email.com" value="" required="">
            <input type="submit" class="rssbutton" value="订阅">
        </form>
    </div>
    <div class="widget d_comment">
        <div class="title">
            <h2><sapn class="title_span">最新评论</sapn></h2>
        </div>
        <ul>
            <?php
            $comments = common\models\Comment::find()->orderBy("id desc")->limit(5)->asArray()->all();
            foreach ($comments as $v){
            ?>
            <li>
                <a href="<?=Url::to(['article/view', 'id'=>$v['aid'], '#'=>'comment-'.$v['id']])?>" title="">
                    <img data-original="/static/images/comment-user-avatar.png" class="avatar avatar-72" height="50" width="50" src="" style="display: block;">
                    <div class="muted"><i><?=$v['nickname']?></i>&nbsp;&nbsp;1天前 (<?=yii::$app->formatter->asTime($v['created_at'])?>)说：<br><?=$v['content']?></div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
    <div class="widget widget_text">
        <div class="title"><h2><sapn class="title_span">友情链接</sapn></h2></div>
        <div class="textwidget">
            <div class="d_tags_1">
                <?php
                    $links = \frontend\models\FriendLink::find()->asArray()->all();
                    foreach ($links as $v){
                        echo "<a target='_blank' href='{$v['url']}'>{$v['name']}</a>";
                    }
                ?>
            </div>
        </div>
    </div>
</aside>