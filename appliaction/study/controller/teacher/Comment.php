<?php
/**
 * 评论管理
 */
namespace app\study\controller\teacher;

use app\study\controller\Init;

class Comment extends Init
{

    public function __construct()
    {
        parent::__construct();
        $this->checkIndividual(2);
    }

    /** 课程评论 */
    public function lessons()
    {
        $pageNo   = get('pageNo', 'intval', 1);
        $pageSize = get('pageSize', 'intval', 10);

        $offer = max(($pageNo - 1), 0) * $pageSize;

        $map['teacher_uid'] = $this->uid;

        $list  = table('CourseComment')->where($map)->order('created desc')->field('id,content,uid,teacher_uid,created,goods_id')->limit($offer, $pageSize)->order('id desc')->find('array');
        $total = table('CourseComment')->where($map)->count();
        $page  = new \denha\Pages($total, $pageNo, $pageSize, url(''));

        foreach ($list as $key => $value) {
            $list[$key]['goods']          = table('Article')->where('id', $value['goods_id'])->field('title,btitle,thumb')->find();
            $list[$key]['goods']['thumb'] = $this->appImg($list[$key]['goods']['thumb'], 'article');

            $user               = dao('User')->getInfo($value['uid'], 'nickname,avatar,real_name');
            $user['avatar']     = $this->appImg($user['avatar'], 'avatar');
            $list[$key]['user'] = $user;

            $teahcer               = dao('User')->getInfo($value['teacher_uid'], 'nickname,avatar');
            $teahcer['avatar']     = $this->appImg($teahcer['avatar'], 'avatar');
            $list[$key]['teahcer'] = $teahcer;

        }

        $this->assign('list', $list);
        $this->assign('pages', $page->pages());
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    public function delLessonsComment()
    {
        $id         = post('id', 'intval', 0);
        $map['id']  = $id;
        $map['uid'] = $this->uid;

        $result = table('CourseComment')->where($map)->delete();
        if (!$result) {
            $this->appReturn(array('status' => false, 'msg' => '删除失败'));
        }

        $this->appReturn(array('status' => true, 'msg' => '操作成功'));
    }

    /** 论坛评论 */
    public function bbs()
    {
        $pageNo   = get('pageNo', 'intval', 1);
        $pageSize = get('pageSize', 'intval', 10);

        $offer = max(($pageNo - 1), 0) * $pageSize;

        $map['type']       = 5;
        $map['parent_id']  = 0;
        $map['del_status'] = 0;
        $map['uid']        = $this->uid;

        $list  = table('Comment')->where($map)->order('created desc')->field('id,content,uid,created,ablum,goods_id')->limit($offer, $pageSize)->order('id desc')->find('array');
        $total = table('Comment')->where($map)->count();
        $page  = new \denha\Pages($total, $pageNo, $pageSize, url(''));

        foreach ($list as $key => $value) {
            $list[$key]['goods'] = table('Article')->where('id', $value['goods_id'])->field('title,btitle')->find();
            $user                = dao('User')->getInfo($value['uid'], 'nickname,avatar');
            $user['avatar']      = getConfig('config.app', 'imgUrl') . '/uploadfile/avatar/' . $user['avatar'];
            $list[$key]['user']  = $user;

        }

        $this->assign('list', $list);
        $this->assign('pages', $page->pages());
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    /** 我的帖子 */
    public function myArticle()
    {
        $pageNo   = get('pageNo', 'intval', 1);
        $pageSize = get('pageSize', 'intval', 10);

        $offer = max(($pageNo - 1), 0) * $pageSize;

        $map['uid']        = $this->uid;
        $map['column_id']  = array('in', '23,24,25');
        $map['del_status'] = 0;

        $list  = table('Article')->where($map)->field('id,column_id,uid,title,btitle,is_review,publish_time,comment_num,comment_uid,comment_time,hot')->order('is_top desc,id desc')->limit($offer, $pageSize)->find('array');
        $total = table('Article')->where($map)->count();
        $page  = new \denha\Pages($total, $pageNo, $pageSize, url('', array('cid' => $cid)));

        $this->assign('list', $list);
        $this->assign('pages', $page->pages());
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    public function delComment()
    {
        $id = post('id', 'intval', 0);

        if (!$id) {
            $this->appReturn(array('status' => false, 'msg' => '参数错误'));
        }

        $map['uid'] = $this->uid;
        $map['id']  = $id;

        $comment = table('Comment')->where($map)->field('id')->find();
        if (!$comment) {
            $this->appReturn(array('status' => false, 'msg' => '可操作信息不存在'));
        }

        $result = table('Comment')->where('id', $id)->save('del_status', 1);
        if (!$result) {
            $this->appReturn(array('status' => false, 'msg' => '删除失败,请稍后重试'));
        }

        $this->appReturn(array('msg' => '操作成功'));

    }

    /** 删除文章 */
    public function delArticle()
    {
        $id = post('id', 'intval', 0);

        if (!$id) {
            $this->appReturn(array('status' => false, 'msg' => '参数错误'));
        }

        $map['uid'] = $this->uid;
        $map['id']  = $id;

        $article = table('Article')->where($map)->field('id')->find();
        if (!$article) {
            $this->appReturn(array('status' => false, 'msg' => '可操作信息不存在'));
        }

        $result = table('Article')->where('id', $id)->save('del_status', 1);
        if (!$result) {
            $this->appReturn(array('status' => false, 'msg' => '删除失败,请稍后重试'));
        }

        $this->appReturn(array('msg' => '操作成功'));
    }
}
