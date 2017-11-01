<?php
/**
 * 文章内容管理
 */
namespace app\admin\controller\content;

use denha;

class ArticleEdit extends \app\admin\controller\Init
{
    //模型ID
    private static $modelId;
    //当前模型数据库
    private static $dataTable;
    //模板视图地址
    private static $tpl;
    //模型数据库类型
    public function edit()
    {
        $columnId = get('column_id', 'intval', 0);
        $modelId  = table('Column')->where('id', $columnId)->field('model_id')->find('one');
        $isEdit   = table('Column')->where('parentid', $columnId)->field('id')->find('one');

        $modelTable = getVar('model_table', 'admin.article');

        self::$modelId   = $modelId;
        self::$dataTable = $modelTable[self::$modelId];
        self::$tpl       = 'article_edit/edit_' . $modelId;

        if (!self::$dataTable) {
            denha\Log::error('模型库尚未创建....');
        }

        if ($isEdit) {
            denha\Log::error('存在子级栏目,不可创建文章');
        }

        switch (self::$modelId) {
            case '1':
                $this->edit_1();
                break;
            case '2':
                $this->edit_2();
                break;
            case '3':
                $this->edit_3();
                break;
            default:
                # code...
                break;
        }

    }

    //保存主表信息
    public function defaults()
    {
        $id = get('id', 'intval', 0);

        $data['title']          = post('title', 'text', '');
        $data['btitle']         = post('btitle', 'text', '');
        $data['description']    = post('description', 'text', '');
        $data['description_en'] = post('description_en', 'text', '');
        $data['thumb']          = post('thumb', 'img', '');
        $data['origin']         = post('origin', 'text', '');

        $data['tag']          = max(post('tag', 'intval', 0), 1);
        $data['is_review']    = post('is_show', 'intval', 1);
        $data['is_recommend'] = post('is_recommend', 'intval', 1);
        $data['column_id']    = post('column_id', 'intval', 1);
        $data['uid']          = post('uid', 'intval', '');

        $data['model_id'] = self::$modelId;

        //var_dump($data);die;

        $modelId = table('Column')->where('id', $data['column_id'])->field('model_id')->find('one');
        if ($modelId != self::$modelId) {
            $this->ajaxReturn(['status' => false, 'msg' => '栏目模型不一致,不可保存']);
        }

        if (!$data['title']) {
            $this->ajaxReturn(['status' => false, 'msg' => '请填写标题']);
        }

        //编辑
        if ($id) {
            $result = table('Article')->where(array('id' => $id))->save($data);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }
        //添加
        else {
            $data['created'] = TIME;
            $result          = table('Article')->add($data);
            if ($result) {
                return $result;
            } else {
                return false;
            }
        }

    }

    //图文模型
    public function edit_1()
    {
        $id       = get('id', 'intval', 0);
        $columnId = get('column_id', 'intval', 0);
        if (IS_POST) {
            $data['content']    = post('content', 'text', '');
            $data['content_en'] = post('content_en', 'text', '');

            //开启事务
            table('Article')->startTrans();
            $dataId = $this->defaults(); //保存主表

            //编辑
            if ($dataId && $id) {
                $resultData = table('Article' . self::$dataTable)->where(array('id' => $id))->save($data);
                $dataId     = $id;
            } else {
                $data['id'] = $dataId;
                $resultData = table('Article' . self::$dataTable)->add($data);
            }

            if (!$resultData) {
                table('Article')->rollback();
                $this->ajaxReturn(array('status' => false, 'msg' => '操作失败,请重新尝试'));
            }

            table('Article')->commit();
            $this->ajaxReturn(array('status' => true, 'msg' => '操作成功'));

        } else {
            if ($id) {
                $rs = $this->getEditConent($id);
            } else {
                $rs              = array('is_show' => 1, 'is_recommend' => 0, 'created' => date('Y-m-d', TIME), 'model_id' => self::$modelId);
                $rs['column_id'] = $columnId;
            }

            $other = array(
                'tag'            => getVar('tags', 'console.article'),
                'columnListCopy' => dao('Column', 'admin')->columnList(),
            );

            $this->assign('data', $rs);
            $this->assign('other', $other);
            $this->show(self::$tpl);
        }
    }

    //教师
    public function edit_2()
    {
        $id       = get('id', 'intval', 0);
        $columnId = get('column_id', 'intval', 0);

        if (IS_POST) {
            $data['teacher_uid'] = post('teacher_uid', 'intval', 0);

            $data['position']    = post('position', 'text', '');
            $data['position_en'] = post('position_en', 'text', '');

            //开启事务
            table('Article')->startTrans();
            $dataId = $this->defaults(); //保存主表

            //编辑
            if ($dataId && $id) {
                $resultData = table('Article' . self::$dataTable)->where(array('id' => $id))->save($data);
                $dataId     = $id;
            } else {
                $data['id'] = $dataId;
                $resultData = table('Article' . self::$dataTable)->add($data);
            }

            if (!$resultData) {
                table('Article')->rollback();
                $this->ajaxReturn(array('status' => false, 'msg' => '操作失败,请重新尝试'));
            }

            table('Article')->commit();
            $this->ajaxReturn(array('status' => true, 'msg' => '操作成功'));

        } else {
            if ($id) {
                $rs = $this->getEditConent($id);
            } else {
                $rs              = array('is_show' => 1, 'is_recommend' => 0, 'created' => date('Y-m-d', TIME), 'model_id' => self::$modelId);
                $rs['column_id'] = $columnId;
            }

            $other = array(
                'tag'            => getVar('tags', 'console.article'),
                'columnListCopy' => dao('Column', 'admin')->columnList(),
            );

            $this->assign('data', $rs);
            $this->assign('other', $other);
            $this->show(self::$tpl);
        }
    }

    //课程
    public function edit_3()
    {
        $id       = get('id', 'intval', 0);
        $columnId = get('column_id', 'intval', 0);

        if (IS_POST) {

            $data               = post('info');
            $data['start_time'] = post('info.start_time', 'time');
            $data['end_time']   = post('info.end_time', 'time');

            if (!$data['sale_price']) {
                $this->ajaxReturn(array('status' => false, 'msg' => '请输入售卖价格'));
            }

            if (!$data['sale_price']) {
                $this->ajaxReturn(array('status' => false, 'msg' => '请输入售卖价格'));
            }

            if (!$data['teacher_id']) {
                $this->ajaxReturn(array('status' => false, 'msg' => '请关联老师'));
            }

            if ($data['start_time'] > $data['end_time']) {
                $this->ajaxReturn(array('status' => false, 'msg' => '开始时间大于结束时间'));
            }

            //开启事务
            table('Article')->startTrans();

            $dataId = $this->defaults(); //保存主表
            //编辑
            if ($dataId && $id) {
                $resultData = table('Article' . self::$dataTable)->where(array('id' => $id))->save($data);
                $dataId     = $id;
            } else {
                $data['id'] = $dataId;
                $resultData = table('Article' . self::$dataTable)->add($data);
            }

            if (!$resultData) {
                table('Article')->rollback();
                $this->ajaxReturn(array('status' => false, 'msg' => '操作失败,请重新尝试'));
            }

            //保存课程表
            $schedule['syllabus'] = post('syllabus');
            $schedule['credit']   = post('credit');
            if ($schedule) {
                //删除 课程表
                table('Article' . self::$dataTable . 'Schedule')->where('id', $dataId)->delete();

                if (count($schedule['syllabus']) != count(array_unique($schedule['syllabus']))) {
                    $this->ajaxReturn(array('status' => false, 'msg' => '课程时间存在相同时间，请修改'));
                }

                foreach ($schedule['syllabus'] as $key => $value) {
                    if ($value) {
                        $data           = array();
                        $data           = array('id' => $dataId, 'time' => strtotime($value), 'credit' => $schedule['credit'][$key]);
                        $resultSchedule = table('Article' . self::$dataTable . 'Schedule')->add($data);
                        if (!$resultSchedule) {
                            table('Article')->rollback();
                            $this->ajaxReturn(array('status' => false, 'msg' => '课程信息保存失败,请重新尝试'));
                        }
                    }
                }
            }

            table('Article')->commit();
            $this->ajaxReturn(array('status' => true, 'msg' => '操作成功'));

        } else {
            if ($id) {
                $rs = $this->getEditConent($id);
                //获取课程信息
                $schedule = table('Article' . self::$dataTable . 'Schedule')->where('id', $id)->field('time,credit')->find('array');

            } else {
                $rs = array(
                    'is_show'      => 1,
                    'is_recommend' => 0,
                    'created'      => date('Y-m-d', TIME),
                    'model_id'     => self::$modelId,
                    'sale_price'   => 0.00,
                    'dis_price'    => 0.00,
                    'credit'       => 0,
                    'num'          => 0,
                    'base_orders'  => 0,
                    'class_type'   => 1,
                );
                $rs['column_id'] = $columnId;
            }

            $other = array(
                'featuredCopy'   => dao('Category')->getList(34),
                'columnListCopy' => dao('Column', 'admin')->columnList(),
                'schedule'       => isset($schedule) ? $schedule : array(),
            );

            $this->assign('data', $rs);
            $this->assign('other', $other);
            $this->show(self::$tpl);
        }
    }

    public function delArticle()
    {
        $id = post('id', 'intval', 0);
        if (!$id) {
           $this->ajaxReturn(array('status'=>false,'msg'=>'参数错误'))
        }

        $modelId = table('Article')->where('id', $id)->field('id')->find();
        if (!$modelId) {
            $this->ajaxReturn(array('status'=>false,'msg'=>'信息不存在'));
        }

        $result = 
    }

    private function getEditConent($id = 0)
    {
        if (!$id) {
            return '';
        }

        $article     = table('Article')->tableName();
        $articleData = table('Article' . self::$dataTable)->tableName();

        $map[$article . '.id']     = $id;
        $map[$articleData . '.id'] = $id;

        $rs = table('Article')->join($articleData)->where($map)->find();
        if (!$rs) {
            denha\Log::error('附属表异常');
        }

        $rs['created'] = date('Y-m-d', $rs['created']);
        $rs['thumb']   = json_encode((array) imgUrl($rs['thumb'], 'article'));

        return $rs;
    }
}
