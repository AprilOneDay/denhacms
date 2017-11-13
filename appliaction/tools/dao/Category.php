<?php
/**
 * 分类模块管理
 */
namespace app\tools\dao;

class Category
{
    /**
     * 获取分类数组
     * @date   2017-09-18T10:17:39+0800
     * @author ChenMingjiang
     * @param  integer                  $id [description]
     * @return [type]                       [description]
     */
    public function getList($id = 0)
    {

        static $_category = array();

        if (!isset($_category[$id])) {
            $map['parentid'] = $id;
            $list            = table('Category')->where($map)->field('id,name')->order('name asc,sort asc')->find('array');

            $_category[$id] = null;

            foreach ($list as $key => $value) {
                $_category[$id][$value['id']] = $value['name'];
            }

        }

        return $_category[$id];
    }

    /**
     * 通过id获取分类名称
     * @date   2017-09-18T10:17:21+0800
     * @author ChenMingjiang
     * @param  [type]                   $id [description]
     * @return [type]                       [description]
     */
    public function getName($id)
    {
        if (stripos(',', $id) !== false) {
            $map['id'] = array('in', $id);
        } elseif (is_array($id)) {
            $map['id'] = array('in', $id);
        } else {
            $map['id'] = $id;
        }

        $name = table('Category')->where($map)->field('name')->find('one', true);
        if (count($name) == 1) {
            return (string) $name[0];
        }

        return (array) $name;
    }

}
