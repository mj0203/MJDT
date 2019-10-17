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
<table>
  <tr><th>属性</th><th>值</th><th>描述</th></tr>
  <tr><td>first_control_columns</td><td>true或false</td><td>是否开启控制列</td></tr>
<tr><td>repeat_page</td><td>true或false</td><td>是否允许重复翻页</td></tr>
<tr><td>onJumpPage</td><td>true或false</td><td>是否启用跳页</td></tr>
<tr><td>title</td><td>false或 title标题</td><td>文档标题</td></tr>
<tr><td>showPageList</td><td>true或false</td><td>是否启用翻页功能</td></tr>
<tr><td>overflowX</td><td>true或false</td><td>是否允许横向滚动</td></tr>
<tr><td>contros</td><td>[{'ysort':false, 'search':true}, {'ysort':false, 'search':false}]</td><td>控制对象</td></tr>
<tr><td>orderColumn</td><td>{}</td><td>需要排序字段</tr>
<tr><td>page_default_list</td><td>10</td><td>默认首页显示页码</tr>
<tr><td>page_gap </td><td> 5</td><td>页码间隙</tr>
<tr><td>page </td><td>1</td><td>页码</tr>
<tr><td>page_size</td><td>10</td><td>每页条数</tr>
<tr><td>page_select</td><td>[10,20,40,60,80,100]</td><td>页码选择</td></tr>
<tr><td>server_url</td><td>request URL</td><td>请求数据url</tr>
<tr><td>paramData</td><td>requestData</td><td>请求参数</tr>
<tr><td>method</td><td>POST</td><td>方法</tr>
<tr><td>next_btn_name</td><td>下一页</td><td>配置文案</tr>
<tr><td>prev_btn_name</td><td>上一页</td><td>配置文案</tr>
<tr><td>end_btn_name</td><td>末页</td><td>配置文案</tr>
<tr><td>columns</td><td>{}</td><td>字段列表排序</tr>
<tr><td>tableNode</td><td>.tableNodeClassName</td><td>table节点名称</tr>
<tr><td>globalStyle</td><td>{}| 全局样式容器</tr>
<tr><td>onReturnSubmit</td><td>true或false</td><td>是否启用回车搜索</tr>
<tr><td>maskTable</td><td>true或false</td><td>查询数据时是否启用遮罩</tr>
</table>