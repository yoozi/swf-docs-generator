# -*- coding:utf-8 -*-

"""
    @author: Yusong Cui <yusongcui@gmail.com>
    @copyright: This is free software, under the New BSD License
"""

import urllib2
import urllib

class httpsqs:
    host = "127.0.0.1"
    port = '1218'
    charset = 'utf-8'
    name = ''
    
    #初始化参数,地址，端口，队列名称，字符编码
    def __init__(self, host, port, name, charset='utf-8'):
        self.host = host
        self.port = port
        self.name = name
        self.charset = charset
    
    def request(self, opt, data=None, name=None, method='GET', charset=None):
        if name is None:
            name = self.name
        if charset is None:
            charset = self.charset
        param = {'charset':charset, 'name':name, 'opt':opt}
        if data :
           param.update(data)
             
        url = 'http://' + self.host + ':' + self.port + '/?'
        param_str = urllib.urlencode(param)
        getString = url + param_str
        req = urllib2.Request(getString)
        try:
            handle = urllib2.urlopen(req)
        except:
            return False
        
        return handle
        
    #获取队首一个元素及位置信息
    def gets(self, q_name=None):
        result = {}
        handle = self.request('get',name=q_name)
        try:
            result['pos'] = self.pos(handle)
        except:
            return False
        result['data'] = handle.read()

        if result['data'] == 'HTTPSQS_GET_END':
            return False
        else:
            return result
    
    #获取一个队列元素
    def get(self, q_name=None):
        result = self.request('get',name=q_name).read()
        if result != 'HTTPSQS_GET_END':
            return result
        else:
            return False
        
    #向队尾增加一个元素
    def put(self, data, q_name=None):
        result = {}
        handle =  self.request('put', {'data':data}, q_name)
        result['data'] = handle.read()
        if result['data'] == 'HTTPSQS_PUT_OK':
            return True
        else:
            return False
        
    #重置队列
    def reset(self, q_name=None):
        handle = self.request('reset', name=q_name)
        str = handle.read()
        if str == 'HTTPSQS_RESET_OK':
            return True
        else:
            return False
    
    #设置队列最大值
    def maxqueue(self, num, q_name=None):
        if not num:
            return False
        
        str = self.request('maxqueue', {'num':num}, q_name).read()
        if str == 'HTTPSQS_MAXQUEUE_OK':
            return True
        else:
            return False
        
    #以json格式返回队列状态等信息
    def status_json(self, q_name=None):
        str = self.request('status_json',  name=q_name).read()
        if str != 'HTTPSQS_ERROR' and str:
            return str
        else:
            return False
        
    #设置同步时间间隔
    def synctime(self, num, q_name=None):
        if not num:
            return False
        str = self.request('synctime', {'num':num}, q_name).read()
        if str == 'HTTPSQS_SYNCTIME_OK':
            return True
        else:
            return False
    
    #获取队列状态信息    
    def status(self, q_name=None):
        str = self.request('status', name=q_name).read()
        if str != 'HTTPSQS_ERROR' and str:
            return str
        else:
            return False
        
    #根据队列位置查看状态
    def view(self, pos, q_name=None):
        str = self.request('view', {'pos':pos}, q_name).read()
        if str != 'HTTPSQS_ERROR' and str:
            return str
        else:
            return False
        
    #根据request句柄获取header部分的pos   
    def pos(self, handle):
        pos = int(handle.info().headers[2].replace('\r\n', '').split(':')[1])
        return pos
        
