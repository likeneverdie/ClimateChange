import requests
from bs4 import BeautifulSoup

import MySQLdb

list_local = []
list_internet = []

#Connect to SQL
host = "localhost"
account = "root"
password = "b960203960203"
db_name = "Account"
db = MySQLdb.connect(host, account, password, db_name)

cursor = db.cursor()
cursor.execute("SELECT * FROM RecordBackup")
##cursor.execute("TRUNCATE TABLE RecordBackup")

## Read data from certain table
results = cursor.fetchall()
##print(type(results))
##print(results)
for data in results:
	list_local.append(data[1])	
	list_local.append(data[2])
	list_local.append(data[3])
	list_local.append(data[4])
	list_local.append(data[5])
	list_local.append(data[6])
	list_local.append(data[7])
	list_local.append(data[8])

##print(len(list_local))
##print(list_local)

## Crawler
url = "http://140.116.54.153/TransactionRecord.php"

res = requests.get(url)

soup = BeautifulSoup(res.text, 'html.parser')

tag_name = 'div#container td'

articles = soup.select(tag_name)

##print(type(articles))

for art in articles:
	list_internet.append(art.text)
	##print(art.text)
	##print(type(art.text))
	##print("--------------------------")

##print(len(list_internet))
##print(list_internet)

def backup():
	cursor.execute("TRUNCATE TABLE RecordBackup")
	length = len(articles)
	count = 0
	for i in range(length):
	
		if i%8 == 0:

			ID = articles[i].text
			count += 1
		if i%8 == 1:
			prev_hash = articles[i].text
			count += 1
		if i%8 == 2:
			timestamp = articles[i].text
			count += 1
		if i%8 == 3:
			buyer = articles[i].text
			count += 1
		if i%8 == 4:
			seller = articles[i].text
			count += 1
		if i%8 == 5:
			kg = articles[i].text
			count += 1
		if i%8 == 6:
			price = articles[i].text
			count += 1
		if i%8 == 7:
			hash_value = articles[i].text
			count += 1
		if count == 8:
			cursor.execute("INSERT INTO Account.RecordBackup VALUES (NULL, %s, %s, %s, %s, %s, %s, %s, %s)", [ID, prev_hash, timestamp, buyer, seller, kg, price, hash_value])
			db.commit()
			count = 0
# To compare two list


i_list = 0
for i in range(len(list_local)):
	#print(list_local[i])
	#print(list_internet[i])
	#print(str(list_local[i]) == str(list_internet[i]))
	if str(list_local[i]) == str(list_internet[i]):
		i_list += 1

#print(i_list)

if i_list == len(list_local):
	print("資料正確!!!開始備份....")
	backup()
else:
	print("資料有誤!!!請確認!!!")

