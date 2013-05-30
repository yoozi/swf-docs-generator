# Swf Doc Generator 部署文档

## 不知不觉，这个项目已经发布六个多月了，当初承诺的安装文档一直没有时间写出，好了，解释的话不多说，多谢大家的支持。安装开始！

## 约定

* 本文以64位最小化安装的CentOS6.2系统作为演示说明基础. 
* 本文约定所有wget下来的目录都放到/data/downloads目录下.
* 本文使用LibreOffice3.6作为文档转换到PDF，也可自行替换成OpenOffice.
* 本文以root用户进行安装，如果你不是root用户，相关地方请注意转换权限.
* 对于你自己的服务器，有些软件包都是存在了，可自行选择跳过安装.

# 安装过程

## 安装开发基础软件，类库等。

```
yum groupinstall "Development Tools"
```

## 安装GNOME

> LibreOffice依赖

```
yum -y groupinstall "Desktop" "Desktop Platform" "X Window System" "Fonts"
```

## 安装Java环境
    
> LibreOffice依赖

```
yum groupinstall "Java Platform"
```

## 下载并安装LibreOffice3.6.6

### 使用RPM包安装

> 安装完成后LibreOffice将被安装到/opt/libreoffice3.6/

```
wget wget http://download.documentfoundation.org/libreoffice/stable/3.6.6/rpm/x86_64/LibO_3.6.6_Linux_x86-64_install-rpm_en-US.tar.gz

tar zxvf LibO_3.6.6_Linux_x86-64_install-rpm_en-US.tar.gz
cd LibO_3.6.6.2_Linux_x86-64_install-rpm_en-US/RPMS/
rpm -ivh *.rpm
cd ../../
```
设置环境变量
```
export set URE_BOOTSTRAP="vnd.sun.star.pathname:/opt/libreoffice3.6/program/fundamentalrc"

```


## 安装bzip2

> HttpSQS中TokyoCabinet依赖

```
yum install bzip2 bzip2-devel zlib-devel
```

## 安装HttpSQS

> 此安装过程来自[张宴的博客](http://www.s135.com/httpsqs/)

```
wget http://httpsqs.googlecode.com/files/libevent-2.0.12-stable.tar.gz
tar zxvf libevent-2.0.12-stable.tar.gz
cd libevent-2.0.12-stable/
./configure --prefix=/usr/local/libevent-2.0.12-stable/
make
make install
cd ../

wget http://httpsqs.googlecode.com/files/tokyocabinet-1.4.47.tar.gz
tar zxvf tokyocabinet-1.4.47.tar.gz
cd tokyocabinet-1.4.47/
./configure --prefix=/usr/local/tokyocabinet-1.4.47/
make
make install
cd ../

wget http://httpsqs.googlecode.com/files/httpsqs-1.7.tar.gz
tar zxvf httpsqs-1.7.tar.gz
cd httpsqs-1.7/
make
make install
cd ../
```

## 安装Python2.7.5

> 本文档时候写的时候Python2.7系列是到2.7.5啦，当然，2.5,2.6也都是可以的，不过后面的setuptools要跟着变一下。

```
wget http://python.org/ftp/python/2.7.5/Python-2.7.5.tar.bz2
tar jxvf Python-2.7.5.tar.bz2 
cd Python-2.7.5
./configure
make
make install 
cd ../
```

## 安装Python Setuptools

> 这里是按照Python2.7来的，如果你不是2.7不要直接Copy & Run!
    
```
wget https://pypi.python.org/packages/2.7/s/setuptools/setuptools-0.6c11-py2.7.egg
sh setuptools-0.6c11-py2.7.egg
```

## 安装Supervisor

```
easy_install supervisor
```

## 安装Nginx, PHP, MySQL
    
> 这里使用第三方源进行安装.
    
```
rpm -ivh http://nginx.org/packages/centos/6/noarch/RPMS/nginx-release-centos-6-0.el6.ngx.noarch.rpm
rpm -ivh ftp://ftp.muug.mb.ca/mirror/fedora/epel/beta/6/x86_64/epel-release-6-5.noarch.rpm
rpm -ivh http://rpms.famillecollet.com/enterprise/remi-release-6.rpm
vi /etc/yum.repos.d/remi.repo
# [remi] 下 enable = 0 修改为 enable = 1
yum -y install nginx mysql-server mysql-devel  php-fpm php-cli php-pdo php-mysql php-mcrypt php-mbstring php-gd php-tidy php-xml php-xmlrpc php-pear php-pecl-memcache
```

## 安装python-mysql

```
easy_install mysql-python
```

## 安装perl-devel

> Git依赖

```
yum -y install perl-devel
```


## 安装Git

```
wget https://git-core.googlecode.com/files/git-1.8.3.tar.gz
tar zxvf git-1.8.3.tar.gz 
cd git-1.8.3
./configure
make
make install
cd ../
```

## 安装freetype

> swftools依赖

```
wget http://download.savannah.gnu.org/releases/freetype/freetype-2.4.12.tar.gz
tar zxvf freetype-2.4.12.tar.gz 
cd freetype-2.4.12
./configure
make 
make install
cd ../
```

## 安装jpeg

> swftools依赖

```
wget http://www.ijg.org/files/jpegsrc.v9.tar.gz
tar zxvf jpegsrc.v9.tar.gz 
cd jpeg-9/
./configure
make
make install 
cd ../
```

## 安装swftools

```
ldconfig /usr/local/lib
wget http://www.swftools.org/swftools-0.9.2.tar.gz
tar swftools-0.9.2.tar.gz
cd swftools-0.9.2/lib/pdf
wget wget ftp://ftp.foolabs.com/pub/xpdf/xpdf-3.03.tar.gz
cd ../../
./configure
make 
make install
# (PS:install后面会包rm -o的错误，无视即可)
cd ../
```

## 下载 xpdf-chinese-simplified

    为了支持中文，如果需要支持其他文字，还需下载其他的语言支持，这里仅下载简体中文

```
wget ftp://ftp.foolabs.com/pub/xpdf/xpdf-chinese-simplified.tar.gz
tar zxvf xpdf-chinese-simplified.tar.gz
mv xpdf-chinese-simplified /data/xpdf-chinese-simplified
```

# 下载源代码

```
mkdir -p /data/www
cd /data/www
git clone git://github.com/yoozi/swf-docs-generator.git ./
```

# 配置

## 配置数据库

    默认安装的root是没有密码的，这里不做安全性和调优配置，PHP等配置也一样.
    
```
service mysqld start
mysql -uroot -p
mysql> source /data/www/install/db.sql
```

## 配置nginx

### 设置/etc/hosts

```
vi /etc/hosts
# 加入一行 
# 127.0.0.1 demo.wenku.io    
```

### 建立conf文件

```
vi /etc/nginx/conf.d/demo.wenku.io.conf
```

将下面的代码放入其中并保存

```
server {
    listen 80;
    root /data/www/public/;
    index index.php;
    server_name demo.wenku.io;

    location / {
        if ($request_uri ~* index/?$)
        {
            rewrite ^/(.*)/index/?$ /$1 permanent;
        }
        if (!-d $request_filename)
        {
            rewrite ^/(.+)/$ /$1 permanent;
        }
        if (!-e $request_filename) {
            rewrite ^/(.*)$ /index.php?/$1 last;
            break;
        }
    }
    
    location ~ \.php$ {             
        fastcgi_pass 127.0.0.1:9000;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME /data/www/public$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

启动php-fpm和nginx

```
service php-fpm start
service nginx start
```


## 配置数据库连接文件

> 数据库连接帐号是root,密码为空，名称为wenku-demo

> 一共三处，大家可以尽情吐嘈作者不负责任连简单的封装都不写，嘿嘿，其实这个项目也只是仅仅是个demo的.

```
vi /data/www/application/config/database.php
vi /data/www/scripts/services/office2pdf.py
vi /data/www/scripts/services/pdf2swf.py
```

## 创建存放上传文件的存放目录和存放转换后文件的目录

```
mkdir -p /data/www/data/
mkdir -p /data/www/public/attachments/
chown -R nginx:nginx /data/www
```

## 修改scripts/pyConverter.py,已支持uno

```
vi /data/www/scripts/pyConverter.py
# import uno 前 加上两行
# import sys
# sys.path.append('/opt/libreoffice3.6/program')
```

## 

## 配置supervisor

```
vi /etc/supervisord.conf
```

将下面的代码保存进去

```
[unix_http_server]
file=/tmp/supervisor.sock   ; (the path to the socket file)

[inet_http_server]         ; inet (TCP) server disabled by default
port=127.0.0.1:9001        ; (ip_address:port specifier, *:port for all iface)

[supervisord]
logfile=/tmp/supervisord.log ; (main log file;default $CWD/supervisord.log)
logfile_maxbytes=50MB        ; (max main logfile bytes b4 rotation;default 50MB)
logfile_backups=10           ; (num of main logfile rotation backups;default 10)
loglevel=info                ; (log level;default info; others: debug,warn,trace)
pidfile=/tmp/supervisord.pid ; (supervisord pidfile;default supervisord.pid)
nodaemon=false               ; (start in foreground if true;default false)
minfds=1024                  ; (min. avail startup file descriptors;default 1024)
minprocs=200                 ; (min. avail process descriptors;default 200)

[rpcinterface:supervisor]
supervisor.rpcinterface_factory = supervisor.rpcinterface:make_main_rpcinterface

[supervisorctl]
serverurl=unix:///tmp/supervisor.sock ; 


[program:httpsqs]
command=httpsqs -p 1218 -x /data/queue
[program:soffice]
command=/opt/libreoffice3.6/program/soffice --headless --accept="socket,host=127.0.0.1,port=8100;urp;" --nofirststartwizard
[program:office2pdf]
command=python /data/www/scripts/services/office2pdf.py
user=nginx
[program:pdf2swf]
command=python /data/www/scripts/services/pdf2swf.py
user=nginx
```

开机启动supervisord

```
vi /etc/rc.local
# 加入一行
# supervisord -c /data/supervisord.conf
``` 

启动supervisord

```
supervisord -c /etc/supervisord.conf
```

# 全剧终

有任何问题，欢迎随时发 [issues](https://github.com/yoozi/swf-docs-generator/issues)，cheers。