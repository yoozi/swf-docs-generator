# 文档自动转换

### 项目目的

> office/pdf/txt/html等文档上传，自动转换成swf格式，在线直接浏览。

> 项目本身并不算复杂，不过目前网上并没有一个完整的转换整体流程，只是笼统的讲是用什么什么软件云云，本项目所有代码公布，希望给大家有个更具体的参考。

> 本方案全程采用开源免费软件，零成本。

### 依赖软件

> [OpenOffice](http://www.openoffice.org/) 或 [LibreOffice](http://www.libreoffice.org/) 
> 
> [swftools](http://www.swftools.org/)(with xpdf)
>
> [Python](www.python.org), [Python MySQLdb](http://sourceforge.net/projects/mysql-python/)
>
> [PyODConverter](https://github.com/mirkonasato/pyodconverter)
>
> [supervisor](http://supervisord.org)
>
> [httpsqs](http://code.google.com/p/httpsqs/)
>
> [FlexPaper](http://flexpaper.devaldi.com/)

### 项目开发测试环境

> [Kubuntu12.10](www.kubuntu.org)

> [LAMPStack5.4.8.0 Dev](http://bitnami.org/stack/lampstack)

### 演示程序开发框架

> [CodeIgniter](http://codeigniter.org.cn/) 2.1.3

> [jQuery](http://jquery.com)

> [Backbone.js](http://backbonejs.org/)

> [Underscore.js](http://underscorejs.org/)

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

## 项目说明

> 项目只是实现了简单上传和自动转换，若要用在实际项目中，还需考虑更多的因素，在此不一一列举，有问题大家直接issue，感谢。


# 演示截图

 ![截图1](https://github.com/yoozi/document-converter/blob/master/install/screencast-1.png)

 ![截图2](https://github.com/yoozi/document-converter/blob/master/install/screencast-2.png)

# PS: 有时间会写整个项目软件的安装过程。

