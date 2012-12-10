# Swf 文档生成和展示解决方案（类百度文库）

这是一个[类百度文库 swf 格式在线浏览的完整解决方案](http://blog.yoozi.cn/opensource/swf-docs-generator/)：支持 office/pdf/txt/html 等多格式文档上传。本解决方案全程采用开源免费软件，零成本。项目目前实现了简单上传和自动转换，若要用在实际项目中，还需考虑更多的因素，在此不一一列举。有问题大家直接 [issue](https://github.com/yoozi/swf-docs-generator/issues/new)、或提交 [pull request](https://github.com/yoozi/swf-docs-generator/pulls) 共同完善，感谢。

### 软件演示截图

![操作面板](https://raw.github.com/yoozi/swf-docs-generator/master/install/screencast-1.png)

![文档展示效果](https://raw.github.com/yoozi/swf-docs-generator/master/install/screencast-2.png)

### 开发团队

* [chekun](https://github.com/chekun)

### 依赖软件

* [OpenOffice](http://www.openoffice.org/) 或 [LibreOffice](http://www.libreoffice.org/) 
* [swftools](http://www.swftools.org/)(with xpdf)
* [Python](www.python.org), [Python MySQLdb](http://sourceforge.net/projects/mysql-python/)
* [PyODConverter](https://github.com/mirkonasato/pyodconverter)
* [supervisor](http://supervisord.org)
* [httpsqs](http://code.google.com/p/httpsqs/)
* [FlexPaper](http://flexpaper.devaldi.com/)

### 项目开发/测试环境

* [Kubuntu12.10](www.kubuntu.org)
* [LAMPStack5.4.8.0 Dev](http://bitnami.org/stack/lampstack)

### 演示程序开发框架

* [CodeIgniter](http://codeigniter.org.cn/) 2.1.3
* [jQuery](http://jquery.com)
* [Backbone.js](http://backbonejs.org/)
* [Underscore.js](http://underscorejs.org/)

### 项目文件夹说明

#### application

> CodeIgniter 项目文件夹

#### conf

> rc.local lamp开机自启动    
> supervisord.conf supervisord配置

#### data

> 用户上传文件存储文件夹，用户没有权限直接访问该文件夹

#### public

> 网站根目录

#### scripts

> 转换脚本存放目录

#### system

> CodeIgnier 框架系统目录

#### install

> db.sql 数据库结构

### LICENSE

Copyright (c) 2012 Yoozi Inc., [http://www.yoozi.cn](http://www.yoozi.cn).

# PS: 有时间会写整个项目软件的安装过程。