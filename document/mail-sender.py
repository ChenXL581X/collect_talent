# -*- coding: utf-8 -*-

from email.mime.text import MIMEText
from email.mime.multipart import MIMEMultipart
import smtplib
import sys,time

if __name__=="__main__":

    msg = MIMEMultipart()
    trans_text = sys.argv[1]
    msg['to'] = sys.argv[2]
    txt = MIMEText("格式"+trans_text,'plain','utf-8') 
    msg.attach(txt)
    #print sys.argv[1]
    #print sys.argv[2]
    #att1 = MIMEText(open('d:\\drcom.rar', 'rb').read(), 'base64', 'gb2312')
    #att1["Content-Type"] = 'application/octet-stream'
    #att1["Content-Disposition"] = 'attachment; filename="drcom.rar"'
    #msg.attach(att1)

    msg['from'] = ''
    msg['subject'] = "注册验证"

    #send
    try:
        server = smtplib.SMTP()
        server.connect('smtp.host.com')
        server.starttls()
        server.login('username','password')
        server.sendmail(msg['from'], msg['to'],msg.as_string())
        server.quit()
        print 'right'
    except Exception, e: 
        print str(e)
