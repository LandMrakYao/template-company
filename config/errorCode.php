<?php
/**
 *
 * User: 梁晓伟  lxw11109@gmail.com
 * Date: 2017-09-19
 * Time: 15:38
 */
return [
    'INVALID_REQ_PARAMS' => [
        'errorCode' => "000400",
        'errorMessage' => '请求参数不合法'
    ],
    'MANAGER_LOGIN_FAILED' => [
        'errorCode' => "11007",
        'errorMessage' => '用户名或密码错误'
    ],
    'PERMISSION_DENY' => [
        'errorCode' => "000403",
        'errorMessage' => '禁止访问'
    ],
    'OLD_PASSWORD_FALSE' => [
        'errorCode' => "11011",
        'errorMessage' => '旧密码输入有误'
    ],
    'ROLE_UPDATE_FAILED' => [
        'errorCode' => "11001",
        'errorMessage' => '角色信息修改失败'
    ],
    'ROLE_ADD_FAILED' => [
        'errorCode' => "11002",
        'errorMessage' => '角色增加失败'
    ],
    'ROLE_DELETE_FAILED' => [
        'errorCode' => "11003",
        'errorMessage' => '角色删除失败，有管理员有此角色'
    ],
    'MANAGER_UPDATE_FAILED' => [
        'errorCode' => "11004",
        'errorMessage' => '管理员信息修改失败'
    ],
    'MANAGER_ADD_FAILED' => [
        'errorCode' => "11005",
        'errorMessage' => '管理员增加失败'
    ],
    'MANAGER_EXISTS_ALREADY' => [
        'errorCode' => "11006",
        'errorMessage' => '管理员登录名占用'
    ],
    'ROLE_NOT_FAILED' => [
        'errorCode' => "11012",
        'errorMessage' => '角色不存在，请正确填写角色'
    ],
    'CATEGORYNAME_ADD_FAILED' => [
        'errorCode' => "12002",
        'errorMessage' => '商品类别已经存在'
    ],
    'CATEGORY_ADD_FAILED' => [
        'errorCode' => "12001",
        'errorMessage' => '商品类别添加失败'
    ],
    'CATEGORY_UPDATE_FAILED' => [
        'errorCode' => "12003",
        'errorMessage' => '商品类别修改失败'
    ],
    'PRODUCT_ADD_FAILED' => [
        'errorCode' => "12004",
        'errorMessage' => '产品添加失败'
    ],
    'PRODUCT_UPDATE_FAILED' => [
        'errorCode' => "12005",
        'errorMessage' => '产品修改失败'
    ],
    'CATEGORY_DELETE_FAILED' => [
        'errorCode' => "12007",
        'errorMessage' => '商品类别删除失败,有商品属于该类别'
    ],
    'CATEGORY_NOR_FAILED' => [
        'errorCode' => "12008",
        'errorMessage' => '商品类别不存在'
    ],
    'PRODUCT_DELETE_FAILED' => [
        'errorCode' => "12009",
        'errorMessage' => '产品删除失败'
    ],
    'DELIVER_FAILED' => [
        'errorCode' => "12010",
        'errorMessage' => '发货失败'
    ],
    'COMMENT_REPLAY_FAILED' => [
        'errorCode' => "12011",
        'errorMessage' => '客服回复失败'
    ],


    'MANAGER_DELETE_ALREADY' => [
        'errorCode' => "11014",
        'errorMessage' => '管理员不存在'
    ],

    'REFUND_REFUSE_FAILED' => [
        'errorCode' => "13001",
        'errorMessage' => '退款请求拒绝失败,参数有误'
    ],

    'ADDRESS_UPDATE_FAILED' => [
        'errorCode' => "21002",
        'errorMessage' => '收货地址修改失败'
    ],
    'DEFAULTADDRESS_SET_FAILED' => [
        'errorCode' => "21003",
        'errorMessage' => '默认收货地址设置失败'
    ],

    'CATE_ADD_FAILED' => [
        'errorCode' => "22001",
        'errorMessage' => '添加购物车失败'
    ],
    'CATE_EXISTS' => [
        'errorCode' => "22002",
        'errorMessage' => '购物车已经存在'
    ],
    'CATE_DELETE_FAILED' => [
        'errorCode' => "22003",
        'errorMessage' => '删除购物车失败'
    ],
    'REGIST_FAILED' => [
        'errorCode' => "24003",
        'errorMessage' => '注册失败'
    ],
    'NAME_PASSWORD_NOT_MATCH' => [
        'errorCode' => "24006",
        'errorMessage' => '用户名或密码错误'
    ],
    'PHONENUMBER_EXISTA' => [
        'errorCode' => "24007",
        'errorMessage' => '手机号码已经注册过，不可重复注册'
    ],
    'ORDER_PAY_FAILED' => [
        'errorCode' => "23002",
        'errorMessage' => '订单支付失败'
    ],
    'ORDER_DELIVER_FAILED' => [
        'errorCode' => "23003",
        'errorMessage' => '确认收货失败'
    ],
    'UPLOAD_ERROR' => [
        'errorCode' => "23004",
        'errorMessage' => '上传文件失败'
    ],
    'UPDATE_ERROR' => [
        'errorCode' => "23004",
        'errorMessage' => '更新失败'
    ],


];