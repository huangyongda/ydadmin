# ydadmin
后台通用模板 后端再也不用为了写前端而烦恼了。
这个项目是为了减少开发难度，提高开发速度而做的项目
项目效果：php只需要写php代码就能完成前端样式
##目前已经实现功能
    1，城市自动联动 
    2，分页自动适应（没有记录总数返回时候只显示上一页下一页） 
    3，按钮有多种打开方式（1异步，2弹出层打开，3新窗口打开，4本窗口打开）
    4，按钮批量操作
    5，导出效果
    6，树形列表页实现
    7，表单实现（单选，多选，文本，富文本，图片上传，树形多选 等）
    8，表单树形多选
    9，表单只读模式显示
    .
    .
    .
```
//用法例子
   public function index(){
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
    
    //数据源
    public function dataSource2()
        {
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
 //更多例子请查看 application/admin/controller/Demo.php 文件
```
项目截图

![image](https://github.com/huangyongda/ydadmin/blob/master/4.png)
表单截图
![image](https://github.com/huangyongda/ydadmin/blob/master/3.png)
![image](https://github.com/huangyongda/ydadmin/blob/master/2.png)
![image](https://github.com/huangyongda/ydadmin/blob/master/1.png)
