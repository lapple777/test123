<?php
namespace app\admin\controller;
use think\Nx\Data;//数据处理类（获取彩单数）
use app\admin\model\AdminMenu;
//菜单管理
class Menu extends Common{
    private $menu;
    public function __construct(){
        parent::__construct();
        $this->menu = new AdminMenu();
    }

    //菜单列表
    public function menu_list(){
        $menuList = $this->menu->order('id asc')->select();
        $res=Data::tree($menuList,'name','id','pid');
        $data = [
            'menuList'=>$res
        ];

        $this->assign($data);
        return $this->fetch('menu-list');
    }
    //添加菜单
    public function add_menu(){
        if(request()->isPost()){
            $input = input();
            $valiadte = new \app\common\validate\AdminMenuVerify();
            $result = $valiadte->scene('menuVerify')->check($input);
            if(!$result){
                $this->error($valiadte->getError());
            }else{
                $name = $input['menuname'];
                $url = $input['navurl'];
                $res = $this->menu->where('name = "'.$name.'" or navUrl = "'.$url.'"')->find();
                if($res){
                    $this->error('菜单名或菜单标识已存在');
                }
                $data = [
                    'name'=>$name,
                    'navUrl'=>$url,
                    'addTime'=>time()
                ];
                $res = $this->menu->insert($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->success('添加失败');
                }
            }
        }
        return $this->fetch('menu-add');
    }
    //添加子菜单
    public function add_child_menu(){
        if(request()->isPost()){
            $input = input();
            $valiadte = new \app\common\validate\AdminMenuVerify();
            $result = $valiadte->scene('menuVerify')->check($input);
            if(!$result){
                $this->error($valiadte->getError());
            }else{
                $pid = $input['pid'];
                $name = $input['menuname'];
                $url = $input['navurl'];
                $res = $this->menu->where('name = "'.$name.'" or navUrl = "'.$url.'"')->find();
                if($res){
                    $this->error('菜单名或菜单标识已存在');
                }
                $data = [
                    'pid'=>$pid,
                    'name'=>$name,
                    'navUrl'=>$url,
                    'addTime'=>time()
                ];
                $res = $this->menu->insert($data);
                if($res){
                    $this->success('添加成功');
                }else{
                    $this->error('添加失败');
                }
            }
        }
        $input = input();
        $data = [
            'pid'=>$input['id']
        ];
        $this->assign($data);
       return $this->fetch('menu-child-add');
    }
    //编辑菜单
    public function edit_menu(){
        if(request()->isPost()){
            $input = input();
            $valiadte = new \app\common\validate\AdminMenuVerify();
            $result = $valiadte->scene('menuVerify')->check($input);
            if(!$result){
                $this->error($valiadte->getError());
            }else{
                $id = $input['mid'];
                $name = $input['menuname'];
                $url = $input['navurl'];
                $res = $this->menu->where('(name = "'.$name.'" or navUrl = "'.$url.'") and id != '.$id)->find();
                if($res){
                    $this->error('菜单名或菜单标识已存在');
                }
                $data = [
                    'name'=>$name,
                    'navUrl'=>$url
                ];
                $res = $this->menu->where(['id'=>$id])->update($data);
                if($res){
                    $this->success('修改成功');
                }else{
                    $this->success('修改失败');
                }
            }

        }
        $input = input();
        $id = $input['id'];
        $res = $this->menu->where(['id'=>$id])->find();
        $data = [
            'menu'=>$res
        ];
        $this->assign($data);
        return $this->fetch('menu-edit');
    }
    //删除菜单
    public function del_menu(){
        $input = input();
        $id = $input['id'];
        $result = $this->menu->where(['pid'=>$id])->find();
        if($result){
            $this->error('请先删除所有子菜单，再删除此菜单');
        }else{
            $res = $this->menu->where(['id'=>$id])->delete();
            if($res){
                $this->success('删除成功');
            }else{
                $this->error('删除失败');
            }
        }

    }

}