# MJDT javascript 表格数据渲染
 
## 初始化方法可以查看底部init方法
- 后台翻页数据加载框架

**Example:**

### 1. generate(server_url, callback) 生成列表
> - server_url = request URL (默认支持获取form表单action属性值)
> - callback = 支持回调

###### 1.1 无参数使用
server_url需在init中配置
不需要回调处理
```
MJDT.generate();
```
###### 1.2 参数版
server_url替换掉init中配置的值
使用回调处理
```
MJDT.generate(hostname+/api, function(result){
    #somethings
});
```
使用init配置的server_url
仅仅使用回调处理
```
MJDT.generate(null, function(result){
    #somethings
});
或者
MJDT.generate(function(result){
    #somethings
});
```

### 2. drawSearch(Node, markType, callback) 搜索重绘
> - Node = 搜索表单节点名称
> - markType = 是否立即触发搜索请求并回到首页结果[默认值 true]
> - callback = 支持回调

###### 2.1 简版
触发搜索重绘方法且回到首页
使用init配置的searchNode
默认回到首页搜索
不适用回调处理
```
MJDT.drawSearch();
```
###### 2.2 回调版
搜索class=searchForm的form表单内容 且 替换掉init中配置的searchNode值
true指定回到首页搜索
使用回调
```
MJDT.drawSearch('.searchForm', true, function(list){
    #somethings
});
或
MJDT.drawSearch(function(list){
    #somethings
});
```
###### 2.3 各参数版
搜索class=searchForm的form表单内容 且 替换掉init中配置的searchNode值
不使用回调
```
MJDT.drawSearch('.searchForm');
```
搜索class=searchForm的form表单内容 且 替换掉init中配置的searchNode值
drawSearch仅组织表单数据 & 交给generate刷新 **当前** 页数据
```
MJDT.drawSearch('.searchForm', false).generate();
```
### 3. drawSearch 结合 generate用法
###### 3.1. drawSearch仅组织表单数据不触发立即搜索，交由generate触发请求
```
MJDT.drawSearch('.searchForm', false).generate();
```
###### 3.2. drawSearch仅组织表单数据不触发立即搜索，交由generate触发请求。增加回调使用
```
MJDT.drawSearch('.searchForm', false).generate(function(){
//something
});
```
### 4. controStyle(obj, callback) #控制样式
  * obj = 样式操作对象
  * callback = 支持回调

###### 4.1 参数版
```
var styleObj = {'tr':{'font':'red'}, '.divNode':{'width':'100px', 'height':'100px'}};
MJDT.controStyle(styleObj, function(){
    #somethings
})
```
---
### 5. enableFirstControl() #强制调用第一列控制
###### 5.1 简版
```
MJDT.enableFirstControl()
```
---
### 6. get_first_control_data() #获取控制列数据
###### 6.1 简版
```
MJDT.get_first_control_data()
```
---
### 7. setParamData(key, value) #设置参数
  * key = request key
  * value = request data
###### 7.1 简版
```
MJDT.setParamData('search_name', 'YES');
```
###### 7.2 参数版
drawSearch仅组织表单数据后设置request参数
```
MJDT.drawSearch(null, false).setParamData('is_show', true);
```
[推荐] drawSearch仅组织表单数据后 & 设置request参数 & 交由generate查询数据
```
MJDT.drawSearch(null, false).setParamData('is_show', false).generate();
```
---
### 8. switchDataTable(Node, callback) #切换dataTable
  * Node = 要切换的table节点名称
  * callback = 支持回调
###### 8.1 完整版
```
MJDT.switchDataTable('.tableClassNodeName', function(){
    #somethings
})
```
---
### 9. 自定义设置checkbox第一列数据
```
<set_first_control>&id&</set_first_control>
```
### 10. columns 特殊功法
###### 10.1 默认简版用法
```
columns : ['id', 'name', 'field3', 'field4']
```
###### 10.2 逻辑与字段用法
```
columns : ['id', 'name', 'field3&field4&field5']
```
###### 10.3 逻辑或字段用法
```
columns : ['id', 'name', 'field3|field4', ]
```
###### 10.4 逻辑与连接html标签用法
```
columns : ['id', 'name', '<a href="&field_src&">&type&</a>']
```
###### 10.5 内部保留字段
auto_id 单独使用为当前页自增ID [正序]
auto_id& 和逻辑与使用为全局翻页自增ID [正序]
```
columns : ['auto_id', 'id', 'name']
```
###### 10.6 内部保留标签
设置checkbox控制列值
```
<set_first_control>&id&</set_first_control>
```
###### 10.7 自定义函数
```
columns : '*myCustomFunction()*'
表示需要自定义方法解析
需要在MJ_dataTable中提前定义解析方法
10.7.1 columns : '*myCustomFunction(field1&field2)*'
MJDT.myCustomFunction = function(callbackData, All){
    #something...
    #第一个参数包含填写的字段
    callbackData.field1
    callbackData.field2
    #第二个参数包含所有字段
    All.id
    All.name
    ...
}
10.7.1 columns : '*myCustomFunction()*'
MJDT.myCustomFunction = function(All){
    #默认为所有字段
    All.id
    All.name
    ...
}
```

### 11. init(options) #初始化配置
参数默认值即可维持基础功能

key|value|描述
:-----  |:-----
first_control_columns  | true或false   | 是否开启控制列
repeat_page            | true或false   | 是否允许重复翻页
onJumpPage             | true或false   | 是否启用跳页
title                  | false或 title标题| 文档标题
showPageList           | true或false   | 是否启用翻页功能
overflowX              | true或false   | 是否允许横向滚动
contros                | [{'ysort':false, 'search':true}, {'ysort':false, 'search':false}]  | 控制对象
orderColumn            | {}       | 需要排序字段
page_default_list      | 10       | 默认每页数量
page_gap               | 5        | 页码间隙
page                   | 1        | 页码
page_size              | 10| 每页条数
page_select            | [10,20,40,60,80,100]| 页码选择
server_url             | request URL| 请求数据url
paramData              | requestData| 请求参数
method                 | POST| 方法
next_btn_name          | 下一页 | 配置文案
prev_btn_name          | 上一页| 配置文案
end_btn_name           | 末页| 配置文案
columns                | {}| 字段列表排序
tableNode              | .tableNodeClassName| table节点名称
globalStyle            | {}| 全局样式容器
onReturnSubmit         | true或false| 是否启用回车搜索
maskTable              | true或false| 查询数据时是否启用遮罩