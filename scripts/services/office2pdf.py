import sys, os, subprocess, json, MySQLdb, time
service_root = os.path.dirname(__file__)
if service_root != '':
    service_root = service_root + '/'  
sys.path.insert(0, os.path.join(service_root, '../httpsqs'))
from httpsqs_client import httpsqs
converter = "python "+service_root+"../pyConverter.py %s %s"

def convert():
    while True:
        try:
            sqs = httpsqs('127.0.0.1', '1218', 'office2pdf')
            result = sqs.gets('office2pdf')
            if result:
                data = result['data']
                if data != False and data != 'HTTPSQS_ERROR':
                    op = json.loads(data)
                    input_file = service_root + '../../data/' + op['folder'] + op['name']
                    output_file = service_root + '../../data/' + op['folder']+ op['raw_name']+'.pdf'
                    status = subprocess.call(converter % (input_file, output_file), shell = True)
                    flag = False
                    if status == 0:
                        op['name'] = op['raw_name'] + '.pdf'
                        flag = sqs.put(json.dumps(op), 'pdf2swf')
                    if not flag:
                        sql = "UPDATE docs SET path = '%s', status = '%s' WHERE id=%d"
                        sql = sql % ('', 'fail', op['id'])
                        db = MySQLdb.connect(host='localhost',user='office2pdf',passwd='SDVVArzGBLu5bWX8',db='wenku-demo', read_default_file="/data/lampstack/mysql/my.cnf")
                        cursor = db.cursor()
                        cursor.execute(sql)
                        cursor.close()
                        db.close()
        except Exception, e:
            print e
  	
        time.sleep(1)
  		 
if __name__ == "__main__":
    convert()
