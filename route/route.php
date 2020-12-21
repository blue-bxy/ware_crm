<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

Route::rule('/login','admin/login/login','get|post');
Route::rule('/index','admin/index/index','get|post');
Route::rule('/log','admin/OperateLog/operate_log','get|post');//行为日志

Route::rule('/notice','admin/Notice/show_notice','get|post');//系统公告
Route::rule('/Addnotice','admin/Notice/add_notice','get|post');//添加系统公告
Route::rule('/Updatenotice','admin/Notice/edit_notice','get|post');//更新公告
Route::rule('/Seenotice','admin/Notice/see_notice','get');//查看公告

Route::rule('/icon','admin/icon/icon','get|post');//图标管理

Route::rule('/dept','admin/dept/dept','get|post');//部门管理
Route::rule('/dept_left','admin/dept/dept_left','get|post');//部门管理左边区域
Route::rule('/dept_right','admin/dept/dept_right','get|post');//部门管理右边区域
Route::rule('/Adddept','admin/Dept/add_dept','get|post');//添加部门
Route::rule('/Updatedept','admin/Dept/edit_dept','get|post');//编辑部门

Route::rule('/menu','admin/menu/menu','get|post');//菜单管理
Route::rule('/menu_left','admin/menu/menu_left','get|post');//菜单管理左边区域
Route::rule('/menu_right','admin/menu/menu_right','get|post');//菜单管理右边区域
Route::rule('/AddMenu','admin/Menu/add_menu','get|post');//添加菜单
Route::rule('/UpdateMenu','admin/Menu/edit_menu','get|post');//编辑菜单
Route::rule('/DeleteMenu','admin/Menu/del_menu','get|post');//删除菜单

Route::rule('/permission','admin/permission/permission','get|post');//权限管理
Route::rule('/permission_left','admin/permission/permission_left','get|post');//权限管理左边区域
Route::rule('/permission_right','admin/permission/permission_right','get|post');//权限管理右边区域
Route::rule('/AddPermission','admin/Permission/add_permission','get|post');//添加权限
Route::rule('/UpdatePermission','admin/Permission/edit_permission','get|post');//编辑权限
Route::rule('/DeletePermission','admin/Permission/del_permission','get|post');//删除权限

Route::rule('/role','admin/Role/role','get|post');//角色管理
Route::rule('/AddRole','admin/Role/add_role','get|post');//添加角色
Route::rule('/UpdateRole','admin/Role/edit_role','get|post');//更新角色
Route::rule('/Assign_authority','admin/Role/assign_authority','get|post');//分配权限

Route::rule('/user','admin/User/user','get|post');//用户管理
Route::rule('/AddUser','admin/User/add_user','get|post');//添加用户
Route::rule('/UpdateUser','admin/User/edit_user','get|post');//更新用户
Route::rule('/giveRole','admin/User/giveRole','get|post');//分配角色

Route::rule('/customer','admin/Customer/customer','get|post');//客户管理
Route::rule('/AddCustomer','admin/Customer/add_customer','get|post');//添加客户
Route::rule('/UpdateCustomer','admin/Customer/edit_customer','get|post');//更新客户信息

Route::rule('/provider','admin/provider/provider','get|post');//供应商管理
Route::rule('/AddProvider','admin/provider/add_provider','get|post');//添加供应商
Route::rule('/UpdateProvider','admin/provider/edit_provider','get|post');//更新供应商信息

Route::rule('/goods','admin/goods/goods','get|post');//商品管理
Route::rule('/AddGoods','admin/goods/add_goods','get|post');//添加商品
Route::rule('/UpdateGoods','admin/goods/edit_goods','get|post');//更新商品信息

Route::rule('/inport','admin/inport/inport','get|post');//商品进货管理
Route::rule('/AddInport','admin/inport/add_inport','get|post');//添加商品进货
Route::rule('/UpdateInport','admin/inport/edit_inport','get|post');//更新商品进货信息

Route::rule('/outport','admin/outport/outport','get|post');//商品退货管理

Route::rule('/sale','admin/sale/sale','get|post');//商品销售管理
Route::rule('/AddSale','admin/sale/add_sale','get|post');//添加商品销售
Route::rule('/UpdateSale','admin/sale/edit_sale','get|post');//更新商品销售信息

Route::rule('/saleback','admin/SaleBack/saleback','get|post');//销售商品退货管理