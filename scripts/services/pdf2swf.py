import sys, os, subprocess, json, MySQLdb, time
service_root = os.path.dirname(__file__)
if service_root != '':
    service_root = service_root + '/'    
sys.path.insert(0, os.path.join(service_root, '../httpsqs'))
from httpsqs_client import httpsqs
converter = "pdf2swf %s -o %s -s /data/xpdf-chinese-simplified/"
def convert():
    while True:
        try:
            sqs = httpsqs('127.0.0.1', '1218', 'pdf2swf')
            result = sqs.gets('pdf2swf')
            if result:
                data = result['data']
                if data != False and data != 'HTTPSQS_ERROR':
                    op = json.loads(data)
                    input_file = service_root + '../../data/' + op['folder'] + op['name']
                    output_file_folder = service_root + '../../public/attachments/' + op['folder']
                    output_file = output_file_folder + op['raw_name'] + '.swf'
                    try:
                        if not os.path.exists(output_file_folder):
                            os.makedirs(output_file_folder)
                        status = subprocess.call(converter % (input_file, output_file), shell = True)
                        sql = "UPDATE docs SET path = '%s', status = '%s' WHERE id=%d"
                        if status == 0:
                            sql = sql % (op['folder'] + op['raw_name'] + '.swf', 'success', op['id'])
                        else:
                            sql = sql % ('', 'fail', op['id'])
                        db = MySQLdb.connect(host='localhost',user='pdf2swf',passwd='VMeHUf5zS5XnKWh4',db='wenku-demo', read_default_file="/data/lampstack/mysql/my.cnf")
                        cursor = db.cursor()
                        cursor.execute(sql)
                        cursor.close()
                        db.close()
                    except Exception, e:
                        print e
        except Exception, e:
            print e
  	time.sleep(1)
  		 

if __name__ == "__main__":
    convert()
