<?php
/**
 * 教室管理
 */
namespace app\study\controller\teacher;

class Classroom extends \app\study\controller\Init
{

    public function __construct()
    {
        parent::__construct();
        $this->checkIndividual(2);
    }

    /** 一对一 */
    public function vip()
    {
        $map['column_id'] = 10;
        $about            = dao('Article')->getRowContent($map, 'description,description_en', 1);

        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    /** 大厅 */
    public function hall()
    {
        //获取最近的课程
        $map['teacher_uid'] = $this->uid;
        $map['status']      = 1;
        $map['start_time']  = array('>=', TIME);

        $course = table('UserCourseLog')->where($map)->find();
        $goods  = table('Article')->where('id', $course['goods_id'])->field('title')->find();

        if ($goods) {
            $live = dao('YunwuRoom')->getList($goods['title']);
        }

        $user = dao('User')->getInfo($this->uid, 'avatar,real_name');

        $this->assign('live', $live[0]);
        $this->assign('user', $user);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

}
