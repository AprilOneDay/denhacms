<?php
/**
 * 高中部
 */
namespace app\study\controller\index;

class HightSchool extends \app\study\controller\Init
{
    /**
     * 单页模块
     * @date   2017-11-09T10:33:49+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function about()
    {
        $map['column_id'] = get('cid', 'intval', 0);
        $data             = dao('Article')->getRowContent($map, 'thumb,description,description_en,content,content_en', 1);

        $columnList = table('Column')->where('parentid', $this->parentColumn['id'])->field('id,name,bname,jump_url')->find('array');

        $this->assign('data', $data);
        $this->assign('columnList', $columnList);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    public function lession()
    {
        $map['column_id'] = get('cid', 'intval', 0);
        $list             = dao('Article')->getList($map, 'id,thumb,num,class_type,characteristics', 3, 6);

        $columnList = table('Column')->where('parentid', $this->parentColumn['id'])->field('id,name,bname,jump_url')->find('array');

        $this->assign('list', $list);
        $this->assign('columnList', $columnList);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    public function lessionMore()
    {
        $pageNo   = max(get('pageNo', 'intval', 0), 2);
        $pageSize = 6;

        $map['column_id'] = get('cid', 'intval', 0);
        $list             = dao('Article')->getList($map, 'id,thumb,num,class_type,characteristics', 3, $pageSize, $pageNo);

        $this->assign('list', $list);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    /**
     * 学校团队模块
     * @date   2017-11-09T10:33:38+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function team()
    {
        $map['column_id'] = get('cid', 'intval', 0);
        $list             = dao('Article')->getList($map, '', 2);

        $columnList = table('Column')->where('parentid', $this->parentColumn['id'])->field('id,name,bname,jump_url')->find('array');

        $this->assign('columnList', $columnList);
        $this->assign('list', $list);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }

    /** 老师详情 */
    public function teacherInfo()
    {
        $teacherUid = get('teacher_uid', 'intval', 0);
        $id         = get('id', 'intval', 0);

        $data = dao('Article')->getRowContent(array('id' => $id), '', 2);

        //获取老师资质荣誉
        $map['teacher_uid'] = $teacherUid;
        $map['column_id']   = 27;
        $data['honorList']  = dao('Article')->getList($map, 'title,btitle,thumb', 2);

        //获取老师课件
        $map                 = array();
        $map['teacher_uid']  = $teacherUid;
        $data['lessionList'] = dao('Article')->getList($map, 'id,title,btitle,thumb,base_orders', 3);

        $this->assign('data', $data);
        $this->show(CONTROLLER . '/' . ACTION . $this->lg);
    }
}
