<?php
/**
 * Created by PhpStorm.
 * User: vinbrave
 * Date: 2017/9/27
 * Time: 10:38
 */

namespace app\admin\controller\postman;

use app\common\controller\Backend;

/**
 * 附件管理
 *
 * @icon fa fa-circle-o
 * @remark 主要用于管理上传到又拍云的数据或上传至本服务的上传数据
 */
class Requests extends Backend
{

    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        //$this->model = model('');
    }

    /**
     * 查看
     */
    public function index()
    {

        return $this->view->fetch();
    }

    /**
     * 选择附件
     */
    public function select()
    {
        if ($this->request->isAjax())
        {
            return $this->index();
        }
        return $this->view->fetch();
    }

    /**
     * 添加
     */
    public function add()
    {
        if ($this->request->isAjax())
        {
            $this->error();
        }
        return $this->view->fetch();
    }

    public function del($ids = "")
    {
        if ($ids)
        {
            $count = $this->model->destroy($ids);
            if ($count)
            {
                \think\Hook::listen("upload_after", $this);
                $this->success();
            }
        }
        $this->error(__('Parameter %s can not be empty', 'ids'));
    }

}
