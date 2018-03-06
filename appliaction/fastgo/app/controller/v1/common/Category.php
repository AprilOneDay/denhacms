<?php
/**
 * 首页模块
 */
namespace app\fastgo\app\controller\v1\common;

use app\app\controller;
use app\fastgo\app\controller\v1\Init;

class Category extends Init
{

    /**
     * 获取分类
     * @date   2017-09-18T10:16:11+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function getList()
    {
        $id = get('id', 'intval', 0);

        $data = $this->appArray(dao('Category')->getList($id, $this->lg));

        $this->appReturn(array('data' => $data));
    }

    /**
     * 获取分类完整版
     * @date   2017-12-29T10:39:30+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function getAllList()
    {
        $id      = get('id', 'intval', 0);
        $alias_2 = get('alias_2', 'text', '');

        if ($alias_2) {

            $map['parentid'] = $id;
            $map['alias_2']  = $alias_2;

            $field = 'id,thumb,name,bname,bname_2';
            if ($this->lg && $this->lg != 'zh') {
                $field .= ',name_' . $this->lg;
            }

            $field .= $fieldValue ? $fieldValue : '';
            $list = table('Category')->where($map)->field($field)->order('bname asc,sort asc')->find('array');

            foreach ($list as $key => $value) {
                if ($this->lg != 'zh' && $this->lg) {
                    $list[$key]['value'] = $value['name_' . $this->lg];
                } else {
                    $list[$key]['value'] = $value['name'];
                }
            }

            $data = $list ? $list : array();

        } else {
            $data = dao('Category')->getListAllInfo($id, '', $this->lg);
        }
        $this->appReturn(array('data' => $data));
    }

    /**
     * 模糊搜索分类
     * @date   2017-12-29T11:33:43+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function searchAllList()
    {
        $id      = get('id', 'intval', 0);
        $keyword = get('keyword', 'text', '');

        $data = dao('Category')->searchListAllInfo($id, $keyword, $this->lg);
        $this->appReturn(array('data' => $data));
    }

    /**
     * 获取省份/城市/地区
     * @date   2017-12-25T10:30:04+0800
     * @author ChenMingjiang
     * @return [type]                   [description]
     */
    public function getCity()
    {
        $type = get('type', 'intval', 1);
        $id   = get('id', 'intval', 8);

        if ($id == 8 && $type == 1) {
            $id       = 35;
            $this->lg = 'zh';
        }

        if ($type == 2) {
            $this->lg = 'en';
        }

        $data = $this->appArray(dao('Category')->getList($id, $this->lg));

        foreach ($data as $key => $value) {
            $data[$key]['child'] = $this->appArray(dao('Category')->getList($value['id'], $this->lg));
        }

        $this->appReturn(array('data' => $data));

    }

    /** 获取国际区号 */
    public function country()
    {

        $tmpList = dao('Category')->getListAllInfo('1061', '', $this->lg);
        foreach ($tmpList as $key => $value) {
            $list[$value['bname']] = $value['value'];
        }

        $data = $list ? $list : array();
        $this->appReturn(array('data' => $data));
    }

    /** 获取物流类型 */
    public function getLogisticsType()
    {
        $data = array(
            'zh' => array(
                array('id' => 1, 'value' => 'fastgo运单号'),
                array('id' => 2, 'value' => '物流公司运单号'),
            ),
            'en' => array(
                array('id' => 1, 'value' => 'fastgo运单号'),
                array('id' => 2, 'value' => '物流公司运单号'),
            ),
            'jp' => array(
                array('id' => 1, 'value' => 'fastgo运单号'),
                array('id' => 2, 'value' => '物流公司运单号'),
            ),
        );

        $this->appReturn(array('data' => $data[$this->lg]));
    }

    /** 获取支付货币类型 */
    public function getCurrency()
    {
        $data = array(
            'zh' => array(
                array('id' => 'CNY', 'value' => '人民币'),
                array('id' => 'AUD', 'value' => '澳币'),
            ),
            'en' => array(
                array('id' => 'CNY', 'value' => '人民币'),
                array('id' => 'AUD', 'value' => '澳币'),
            ),
            'jp' => array(
                array('id' => 'CNY', 'value' => '人民币'),
                array('id' => 'AUD', 'value' => '澳币'),
            ),
        );

        $this->appReturn(array('data' => $data[$this->lg]));
    }
}
