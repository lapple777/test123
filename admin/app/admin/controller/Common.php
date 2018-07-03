<?php 
namespace app\admin\controller;
use think\Controller;
use think\Request;
use think\auth\Auth;//权限控制类
use think\Nx\Data;//数据处理类（获取权限数）
use think\Db;
class Common extends Controller{
	public function __construct(){
		parent::__construct();
		if(!session('adminUser')){
			$this->redirect('admin/Login/index');
		}
        $request = Request::instance();
        $model = $request->module();//模块
        $controller = $request->controller();//控制器
        $action = $request->action();//方法
        $auth = new Auth();
        // 第一个参数是规则名称,第二个参数是用户UID
//        if (!$auth->check($model.'/'.$controller.'/'.$action, session('adminUserId')) && $action != 'index') {
//            $this->error('你没有权限');
//        }
        // 分配菜单数据
        $data = Db::name('admin_nav')->order('id asc')->select();
        $data= Data::channelLevel($data,0,'&nbsp;','id');
        // 显示有权限的菜单
        foreach ($data as $k => $v) {
            if ($auth->check($v['navUrl'],session('adminUserId'))) {
                foreach ($v['_data'] as $m => $n) {
                    if(!$auth->check($n['navUrl'],session('adminUserId'))){
                        unset($data[$k]['_data'][$m]);
                    }
                }
            }else{
                // 删除无权限的菜单
                unset($data[$k]);
            }
        }
        $assign=array(
            'nav_data'=>$data
        );
        $this->assign($assign);
    }
}
