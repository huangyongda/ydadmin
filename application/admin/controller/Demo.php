<?php
/**
 * Created by PhpStorm.
 * User: huangyongda
 * Date: 2017/8/16
 * Time: 15:30
 */

namespace app\admin\controller;


use app\common\builder\conlumnsBtn\conlumnsBtn;
use app\common\builder\DataSource;
use app\common\builder\form;
use app\common\builder\htmlTag;
use app\common\builder\table;
use app\common\builder\tableHeaderBtn\addBtn;
use app\common\builder\tree;
use app\common\builder\ViewBuilder;
use app\index\validate\test\User;
use app\Lib\Api\Demo\Dow;
use app\Lib\TopClient;
use think\Url;

class Demo
{
    private function treeDataSource()
    {
        $data_list=[
            [
                "id"=>"1",
                "name"=>"张三1".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()

                        .(new conlumnsBtn())
                            ->setTempletName("admin")
                            ->setBtnName("禁用")
                            ->setUrl(Url::build("update",['id'=>'1']))
                            ->setDisabled()->fetch()

                    ),
                "pid"=>"0",
            ],
            [
                "id"=>"2",
                "name"=>"张三2".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"1",
            ],
            [
                "id"=>"2.1",
                "name"=>"张三2.1".htmlTag::red("红"),
                "op"=>
                    (
                    (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"1",
            ],
            [
                "id"=>"3",
                "name"=>"张三3".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"2",
            ],
            [
                "id"=>"4",
                "name"=>"张三4".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"2",
            ],
            [
                "id"=>"5",
                "name"=>"张三5".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"0",
            ],
            [
                "id"=>"6",
                "name"=>"张三6".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"2",
            ],
            [
                "id"=>"100",
                "name"=>"张三7".htmlTag::red("红"),
                "op"=>
                    (
                        (new conlumnsBtn())
                        ->setTempletName("admin")
                        ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                        ->setStyleBlue()
                        ->setUrl(Url::build("update",['id'=>'1']))->fetch()
                    ),
                "pid"=>"99",
            ],

        ];

        return $data_list;
    }
    public function tree(){
        $tree=new tree();

        $tree->setTitle("树列表demo3");
        $tree->setRemark("这个是备注信息！！");
        $tree->setTreePrimaryKey("id");
        $tree->setTreePidName("pid","0");//树的父节点名称 和起始值
        $tree->setTreeField("name");//展示树效果的字段
        $tree->setTreeOpen(false);//设置树展开  如果为false 则不展开 true 则全部展开
        $tree->setTreeOpenLevel(1);//设置默认树展开层级
        $tree->setShowTreeOpenOrCloseBtn(false);//显示树展开或不展开按钮
        $tree->dataSource($this->treeDataSource() ); //数据源地址


        $tree->addColumns([ // 批量添加数据列
            ['id', '姓名'],
            ['name', '树名称'],
            ['op', '操作'],
        ]);
        return $tree->fetch();
    }
    public function treeOpen(){
        $tree=new tree();
        $tree->setTitle("树列表demo3");
        $tree->setTreePrimaryKey("id");
        $tree->setTreePidName("pid","0");//树的父节点名称 和起始值
        $tree->setTreeField("name");//展示树效果的字段
        $tree->setTreeOpen(false);//设置树展开  如果为false 则不展开 true 则全部展开
        //$tree->setTreeOpenLevel(0);//设置默认树展开层级
        $tree->setShowTreeOpenOrCloseBtn(true);//显示树展开或不展开按钮
        $tree->setSearchInput(true);//是否进行展示字段搜索
        $tree->dataSource($this->treeDataSource() ); //数据源地址
        $tree->addColumns([ // 批量添加数据列
            ['id', '姓名'],
            ['name', '树名称'],
            ['op', '操作'],
        ]);
        return $tree->fetch();
    }
    public function treeOpenAll(){
        $tree=new tree();
        $tree->setTitle("树列表demo3");
        $tree->setTreePrimaryKey("id");
        $tree->setTreePidName("pid","0");//树的父节点名称 和起始值
        $tree->setTreeField("name");//展示树效果的字段
        $tree->setTreeOpen(true);//设置树展开  如果为false 则不展开 true 则全部展开
        $tree->setTreeOpenLevel(0);//设置默认树展开层级 不设置默认全部打开
        $tree->dataSource($this->treeDataSource() ); //数据源地址
        $tree->addBatchBtn( //添加批量处理按钮
            (new addBtn())->setBtnName("批量操作")
                ->setOpenTypeAjax()
                ->setStyleDanger()
                ->setIcoName("fa-minus-circle") //图标
                ->confirm("是否批批量删除?") //询问框提示
                ->setUrl(url("admin/demo/batch"))
        );
        $tree->addColumns([ // 批量添加数据列
            ['id', '姓名'],
            ['name', '树名称'],
            ['op', '操作'],
        ]);
        return $tree->fetch();
    }
    public function index2(){
        $table=new table();
        $table->setTitle("列表demo2")
            ->setPageSize(10)
            ->dataSourceUrl(url('dataSource2')) //数据源地址
            ->addColumns([ // 批量添加数据列
                ['id', '姓名'],
                ['name', '备注'],
                ['module', '模块'],
                ['remark', '状态']
            ]);

        $content=$table->fetch();

        return $content;
    }
    public function index()
    {
        $table=new table();
        $table->setTitle("列表demo")
            ->setPageSize(10)
            ->setRemark("这个是备注信息！！")
            ->addHeaderBtn(
                (new addBtn())->setBtnName("禁用")
                    ->setDisabled()
            )
            ->addHeaderBtn(
                (new addBtn())->setBtnName("新增按钮")
//                    ->setOpenTypeNewTab() //打开方式
//                  ->confirm("是否打开新增页面")
                        ->setIcoName() //设置图标 默认是+号图标
                    ->setUrl(url("admin/demo/add"))
            )
            ->addHeaderBtn(
                (new addBtn())->setBtnName("询问框提示")
                  ->confirm("是否打开新增页面") //询问框提示
                    ->setStyleBlue()
                    ->setIcoName("fa-times") //设置图标
                    ->setUrl(url("admin/demo/add"))
            )
            ->addHeaderBtn(
                (new addBtn())->setBtnName("询问框提示")
                  ->confirm("是否打开新增页面") //询问框提示
                    ->setStyleDanger()
                    ->setIcoName("fa-window-close-o") //设置图标
                    ->setUrl(url("admin/demo/add"))
            )
            ->setBatchKey("id") //设置批量处理的key
            ->addBatchBtn( //添加批量处理按钮
                (new addBtn())->setBtnName("批量操作")
                    ->setOpenTypeAjax()
                    ->setIcoName("fa-check-circle")//设置图标
                  ->confirm("是否批批量删除?") //询问框提示
                    ->setUrl(url("admin/demo/batch"))
            )
            ->addBatchBtn( //添加批量处理按钮
                (new addBtn())->setBtnName("批量操作")
                    ->setOpenTypeAjax()
                    ->setStyleBlue()
                  ->confirm("是否批批量删除?") //询问框提示
                    ->setUrl(url("admin/demo/batch"))
            )
            ->addBatchBtn( //添加批量处理按钮
                (new addBtn())->setBtnName("批量操作")
                    ->setOpenTypeAjax()
                    ->setStyleDanger()
                    ->setIcoName("fa-minus-circle") //图标
                  ->confirm("是否批批量删除?") //询问框提示
                    ->setUrl(url("admin/demo/batch"))
            )
            ->addBatchBtn( //添加批量处理按钮
                (new addBtn())->setBtnName("禁用")
                    ->setDisabled()
            )
            ->addHeaderBtn(
                (new addBtn())->setBtnName("导出")
                    ->setOpenTypeAjax() //打开方式
//                  ->confirm("是否打开新增页面")
                    ->getFromData('search_box')
                    ->setIcoName() //设置图标 默认是+号图标
                    ->setUrl(url("dow"))
            )

            ->dataSourceUrl(url('dataSource')) //数据源地址
            ->addColumns([ // 批量添加数据列
                ['id', '姓名'],
                ['name', '备注'],
                ['module', '模块'],
                ['remark', '状态']
            ])
            ->search(// 批量添加数据列
                [
                    ['name', '搜索',"hidden","张三"],
                    ['name', '搜索',"text","张三",'placeholder'],
                    ['sex', '性别',"radio",["男"=>1,"女"=>0,"其他"=>-1],"1"],
                    ['city', '城市',"select",["广东"=>1,"龙岗"=>2],2],
                    ['city_group', '城市联动',"select_group",[
                        "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(19),
                        "max_level"=>3,//最大深度
                        "min_level"=>2,//最小深度
                        "data_url"=>url("admin/city/getCity") //获取数据的路径
                    ],"这是备注"],
                    ['city_group_1', '城市联动2',"select_group",[
                        "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(19),
                        "max_level"=>5,//最大深度
                        "min_level"=>2,//最小深度
                        "data_url"=>url("admin/city/getCity") //获取数据的路径
                    ],"这是备注"],
                    ['other', '缺点',"checkbox",["高"=>1,"富"=>2,"帅"=>3],'1,2'],
                    ['like', '爱好',"checkbox_origin",["打球"=>1,"看书"=>2,"睡觉"=>3],[2,3]],
                    ['begintime', '时间到天',"date_day","2017-08-14"],
                    ['begintime2', '时间到秒',"date_second","2017-08-14 00:00:00"],
                ]
            );
        $table
            ->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("禁用")->setDisabled()

            );
        $table->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("新窗口打开")->setOpenTypeNewTab()
                    ->setStyleBlue()
                    ->setUrl(Url::build("update",['id'=>'{{ item.id }}']))
            )
        ;
        $table
            ->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("当前页面打开")->setOpenTypeNewPage()
                    ->setStyleBlue()
                    ->setUrl(Url::build("update",['id'=>'{{ item.id }}']))
            )
            ->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("弹窗打开")->setOpenTypePop()
                    ->setStyleBlue()
                    ->setUrl(Url::build("update",['id'=>'{{ item.id }}']))
            )
            ->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("异步请求打开")->setOpenTypeAjax()
                    ->setStyleBlue()
                    ->setUrl(Url::build("delete",['id'=>'{{ item.id }}']))
            );

        $table->addConlumnsBtn(
            (new conlumnsBtn())
                ->setBtnName("编辑")
                ->setStyleGreen()
                ->setIcoName("fa-wrench") //图标
                ->setUrl(Url::build("update",['id'=>'{{ item.id }}']))
        )
            ->addConlumnsBtn(
                (new conlumnsBtn())
                    ->setBtnName("添加询问")->setOpenTypeAjax()
                    ->setStyleDanger()
                    ->setIcoName("fa-close") //图标
                    ->confirm("是否打开新增页面")
                    ->setUrl(Url::build("update",['id'=>'{{ item.id }}']))
            );


        $content=$table->fetch();

        return $content;

    }

    public function batch()
    {
        $data=[];
        $post= request()->post()?request()->post()["id"]:[];
        if($post)
        {
            return table::returnSuccess($data, '成功处理'.implode(",",$post));
        }
        else{
            return table::returnError($data, "数据不规范");
        }
    }

    public function add()
    {
        if(request()->isAjax() ){
            $data=[];
            $validate=new User(); //验证类
            if($validate->scene("add")->check(request()->param()))
            {
//                return table::returnSuccessAndToUrl('更新成功',Url::build("Demo/index"));
                return table::returnSuccessAndCloseWindow('操作成功');
            }
            else{
                $data["error_field"]=$validate->getErrorField();
                return table::returnError($data, $validate->getError());
            }

        }
        else{
            return $this->showAdd();
        }
    }
    public function showAdd()
    {
        $form=new form();
        $form->setRemark("这个是备注信息！！");
        $form->setData(
            [
                ['name', '名称',"text","","这是备注"],
                ['mima', '密码',"password","","这是备注"],
                ['address', '地址',"text","","这是备注"],
                ['sex', '性别',"radio",["男"=>1,"女"=>2,"其他"=>-1],"","这是备注"],
                ['city', '城市',"select",["广东"=>1,"龙岗"=>2],"","这是备注"],
                ['city_group', '城市联动',"select_group",[
                    "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(0),
                    "max_level"=>3,//最大深度
                    "min_level"=>2,//最小深度
                    "data_url"=>url("admin/city/getCity") //获取数据的路径
                ],"这是备注"],
                ['city_group_1', '城市联动2',"select_group",[
                    "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(0),
                    "max_level"=>5,//最大深度
                    "min_level"=>2,//最小深度
                    "data_url"=>url("admin/city/getCity") //获取数据的路径
                ],"这是备注"],

                ['other', '缺点',"checkbox",["高"=>1,"富"=>2,"帅"=>3],2,"这是备注"],
                ['like', '爱好',"checkbox",["打球"=>1,"看书"=>2,"睡觉"=>3],[2,3],"这是备注"],
                ['begintime', '时间到天',"date_day","2017-08-14","这是备注"],
                ['begintime2', '时间到秒',"date_second","2017-08-14 00:00:00","这是备注"],
                ['image3', '图片2',"image",
                    [
                        'default'=>[],
                        'max-height'=>'180px',
                        'max-width'=>'150px',
                        'max-upload-num'=>'3' //最大上传数量
                    ],
                    "这个是提示"

                ],
                ['image4', '图片2',"image",
                    [
                        'default'=>[],
                        'max-height'=>'180px',
                        'max-width'=>'150px',
                        'max-upload-num'=>'3' //最大上传数量
                    ],
                    "这个是提示"

                ],
                ['remark', '备注',"textarea","","这是备注"],
                ['remark_origin', '备注2',"textarea_origin","","这是备注2"],
            ]
        );

        $form->setSubmitUrl(\url("add"));

        return $form->fetch();
    }

    public function delete()
    {
        return table::returnSuccess();
    }



    public function update()
    {
        if(request()->isAjax() ){
            $data=[];
            $validate=new User(); //验证类
            if($validate->scene("edit")->check(request()->param()))
            {
//                return table::returnSuccess($data, '更新成功');
                return table::returnSuccessAndToUrl('更新成功',Url::build("Demo/index"));
//                return table::returnSuccessAndCloseWindow('更新成功');
            }
            else{
                $data["error_field"]=$validate->getErrorField();
                return table::returnError($data, $validate->getError());
            }

        }
        else{
            return $this->showUpdate();
        }
    }

    public function city()
    {
        $data=[];
        if(!request()->post("id")){
            return table::returnError($data, "参数不规范");
        }
        $data=["深圳"=>3,"广州"=>4];
        return table::returnSuccess($data, '更新成功');
    }

    public function     showUpdate()
    {
        $form=new form();
        $form->setData(
            [
                ['id', '搜索',"hidden",1],
                ['name', '名称',"text","张三","这是备注"],
                ['name2|readonly', '名称只读',"text","张三","这是备注"],
                ['mima', '密码',"password","123456","这是备注"],
                ['mima2|readonly', '密码只读',"password","123456","这是备注"],
                ['address', '地址',"text","张三","这是备注"],
                ['sex', '性别',"radio",["男"=>1,"女"=>0,"其他"=>-1],"-1","这是备注"],
                ['like|readonly', '爱好只读',"radio",["男"=>1,"女"=>0,"其他"=>-1],"-1","这是备注"],
                ['city', '城市',"select",["广东"=>1,"龙岗"=>2],2,"这是备注"],
                ['city2|readonly', '城市只读',"select",["广东"=>1,"龙岗"=>2],2,"这是备注"],
                ['city2', '城市只读部分只读',"select",
                    ["广东"=>1,"龙岗"=>2,'北京'=>3,'上海'=>4],['noReadonly'=>'2,3','default'=>4],"这是备注"],
                ['city_group', '城市联动',"select_group",[
                    "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(513701),
                    "max_level"=>3,//最大深度
                    "min_level"=>2,//最小深度
                    "data_url"=>url("admin/city/getCity") //获取数据的路径
                ],"这是备注"],
                ['city_groupzhidu|readonly', '城市联动只读',"select_group",[
                    "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(513701),
                    "max_level"=>3,//最大深度
                    "min_level"=>2,//最小深度
                    "data_url"=>url("admin/city/getCity") //获取数据的路径
                ],"这是备注"],
                ['city_group2', '城市联动2',"select_group",[
                    "list"=>(new \app\Lib\Model\OrderToots\City())->getCitySelectData(513701),
                    "max_level"=>5,//最大深度
                    "min_level"=>2,//最小深度
                    "data_url"=>url("admin/city/getCity") //获取数据的路径
                ],"这是备注"],
                ['readonly_checkbox_tree|readonly|isopen', '多选树(只读)',"checkbox_tree",
                    [
                        ["title"=>"节点1","value"=>"1","data"=>
                            [[
                                    "title"=>"节点1.1","value"=>"1.1","data"=>
                                    [[
                                        "title"=>"节点1.1.1","value"=>"1.1.1"
                                    ],[
                                        "title"=>"节点1.1.2","value"=>"1.1.2","data"=>[]
                                    ]]
                                ],
                                [
                                    "title"=>"节点1.2","value"=>"1.2","data"=>
                                    [
                                        "title"=>"节点1.2.1","value"=>"1.2.1","data"=>[]
                                    ]
                                ]]
                        ],
                        ["title"=>"节点2","value"=>"2","data"=>
                            [
                                [
                                    "title"=>"节点2.1","value"=>"2.1","data"=>
                                    [
                                        "title"=>"节点2.1.1","value"=>"2.1.1","data"=>[],
                                    ]
                                ],
                                [
                                    "title"=>"节点2.1","value"=>"2.1","data"=>[],
                                ]
                            ]
                        ],
                        [
                            "title"=>"节点3","value"=>"3","data"=>[],
                        ],
                    ],
                    ["1.1.1","1.2"],//默认选择的值
                    "这是备注"],
                ['checkbox_tree|isopen', '多选树(部分只读)',"checkbox_tree",
                    [
                        ["title"=>"节点1","value"=>"1","data"=>
                            [[
                                    "title"=>"节点1.1","value"=>"1.1","readonly"=>1,"data"=>
                                    [[
                                        "title"=>"节点1.1.1","value"=>"1.1.1","readonly"=>1,"data"=>[]
                                    ],[
                                        "title"=>"节点1.1.2","value"=>"1.1.2","readonly"=>0,"data"=>[]
                                    ]]
                                ],
                                [
                                    "title"=>"节点1.2","value"=>"1.2","data"=>
                                    [
                                        "title"=>"节点1.2.1","value"=>"1.2.1","data"=>[]
                                    ]
                                ]]
                        ],
                        ["title"=>"节点2","value"=>"2","data"=>
                            [
                                [
                                    "title"=>"节点2.1","value"=>"2.1","data"=>
                                    [
                                        "title"=>"节点2.1.1","value"=>"2.1.1","data"=>[],
                                    ]
                                ],
                                [
                                    "title"=>"节点2.1","value"=>"2.1","data"=>[],
                                ]
                            ]
                        ],
                        [
                            "title"=>"节点3","value"=>"3","data"=>[],
                        ],
                    ],
                    ["1.1.1","1.2"],//默认选择的值
                    "这是备注"],

                ['other', '缺点',"checkbox",["高"=>1,"富"=>2,"帅"=>3],2,"这是备注"],
                ['other2|readonly', '缺点只读',"checkbox",["高"=>1,"富"=>2,"帅"=>3],2,"这是备注"],
                ['other_origin', '原始多选',"checkbox_origin",["高"=>1,"富"=>2,"帅"=>3],2,"这是备注"],
                ['other_origin2|readonly', '原始多选只读',"checkbox_origin",["高"=>1,"富"=>2,"帅"=>3],2,"这是备注"],
                ['like', '爱好',"checkbox",["打球"=>1,"看书"=>2,"睡觉"=>3],[2,3],"这是备注"],
                ['begintime', '时间到天',"date_day","2017-08-14","这是备注"],
                ['begintimezhidu|readonly', '时间到天只读',"date_day","2017-08-14","这是备注"],
                ['begintime2', '时间到秒',"date_second","2017-08-14 00:00:00","这是备注"],
                ['begintime2zhidu|readonly', '时间到秒只读',"date_second","2017-08-14 00:00:00","这是备注"],
                ['image3', '图片2',"image",
                    [
                        'default'=>[
                            //图片Id=>图片url
                            1=>"http://192.168.10.253/~huangyd/5.0/public/Uploads/20170815/6e774338a21a85fa4ec3e1a3113a6395.png",
                            2=>"http://192.168.10.253/~huangyd/5.0/public/Uploads/20170815/6e774338a21a85fa4ec3e1a3113a6395.png",
                        ],
                        'max-height'=>'180px',
                        'max-width'=>'150px',
                        'max-upload-num'=>'3' //最大上传数量

                    ],
                    "这个是提示"

                ],
                ['image2', '图片2',"image",
                    [
                        'default'=>[
                            //图片Id=>图片url
                            1=>"http://192.168.10.253/~huangyd/5.0/public/Uploads/20170815/6e774338a21a85fa4ec3e1a3113a6395.png",
                            2=>"http://192.168.10.253/~huangyd/5.0/public/Uploads/20170815/6e774338a21a85fa4ec3e1a3113a6395.png",
                        ],
                        'max-height'=>'180px',
                        'max-width'=>'150px',
                        'max-upload-num'=>'3' //最大上传数量

                    ],
                    "这个是提示"

                ],
                ['remark', '备注',"textarea","这个是默认值","这是备注"],
                ['remark2|readonly', '备注只读',"textarea","这个是默认值<b>可以加html标签</b>","这是备注"],
                ['remark_origin', '备注2',"textarea_origin","这个是默认值2","这是备注2"],
                ['remark_origin2|readonly', '备注2只读',"textarea_origin","这个是默认值2","这是备注2"],
            ]
        );

        $form->setSubmitUrl(\url("admin/demo/update"));

        return $form->fetch();
    }

    public function dataSource()
    {
        sleep(1);
        $data_list=[
            [
                "id"=>"1",
                "name"=>"张三"
                    .htmlTag::red("红")
                    .htmlTag::orange("橙")
                    .htmlTag::green("绿")
                    .htmlTag::cyan("青")
                    .htmlTag::blue("蓝")
                    .htmlTag::black("黑")
                    .htmlTag::gray("灰")
                ,
                "area"=>"1",
                "remark"=>"人生就像是一场修行",
                "module"=>"1",
                "status"=>"1",
                "time"=>time(),
            ]
        ];
        $pageSize=request()->param("pageSize");
        for($i=1;$i<$pageSize;$i++){
            $array=$data_list[0];
            $array["id"]=$i;
            $data_list[]=$array;
        }
        return ViewBuilder::returnSuccess($data_list,$msg="获取成功");
    }

    public function dataSource2()
    {
        sleep(1);
        $data_list=[
            [
                "id"=>"1",
                "name"=>"张三"
                    .htmlTag::red("红")
                    .htmlTag::orange("橙")
                    .htmlTag::green("绿")
                    .htmlTag::cyan("青")
                    .htmlTag::blue("蓝")
                    .htmlTag::black("黑")
                    .htmlTag::gray("灰")
                ,
                "area"=>"1",
                "remark"=>"人生就像是一场修行",
                "module"=>"1",
                "status"=>"1",
                "time"=>time(),
            ]
        ];
        $pageSize=request()->param("pageSize");
        for($i=1;$i<$pageSize;$i++){
            $array=$data_list[0];
            $array["id"]=$i;
            $data_list[]=$array;
        }
        $dataSource=new DataSource();
        $dataSource->setDataSource($data_list);
        $dataSource->setOtherData("total","总数100");
        $dataSource->setOtherData("test",array(1,2));
        $dataSource->setOtherData("page","10");
        return ViewBuilder::returnSuccess($dataSource,$msg="获取成功");
    }

    public function dow(){
//        sleep(3);
        if(request()->isAjax()){
//            $model = new Dow();
//            $model->setArgs('uid',1);
//            $result =  (new TopClient($model))->getSuccessData();
            $data =  ['dow'=>true];
            return $data;
        }
    }
}