#Import python package
from linebot import LineBotApi
import time
import sys

#Receive token and file path from PHP
access_token=sys.argv[1]
id_message=sys.argv[2]
file_path=sys.argv[3]

#Connect to Line API
line_bot_api = LineBotApi(access_token)

#Get image data
message_content = line_bot_api.get_message_content(id_message)

#Get image type
image_type = message_content.content_type

#Create new file name
x = image_type.split("/")
if x[1]=='jpeg':
	ext = 'jpg'
else:
	ext = x[1]    
file_name = str(time.time()) + '.' + ext

#Create full path
full_file_pth = file_path + file_name

#Save file
with open(full_file_pth, 'wb') as fd:
    for chunk in message_content.iter_content():
        fd.write(chunk)

#Return message
print(file_name)