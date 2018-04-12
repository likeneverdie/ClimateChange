from sense_hat import SenseHat
from time import sleep
import MySQLdb
import datetime
db = MySQLdb.connect("140.116.100.80","root","ron","myDB")
db2 = MySQLdb.connect("localhost","readyornot","ron","myDB")
curs = db.cursor()
curs2 = db2.cursor()
sense = SenseHat()
number = 1
y = (255, 255, 0)
e = (0, 0, 0)
b = (0, 0, 255)
r = (255, 0, 0)
steps=0
frame1 = [e,e,y,y,y,y,e,e,e,y,y,y,y,y,y,e,y,y,b,y,y,b,y,y,y,y,y,y,y,y,y,y,y,r,y,y,y,y,r,y,y,y,b,y,y,b,y,y,e,y,y,b,b,y,y,e,e,e,y,y,y,y,e,e]
def stop():
        for i in range(2):
                sense.set_pixels(frame1)
                sense.set_rotation(180)                
sense.clear()
while True:
    x,y,z = sense.get_accelerometer_raw().values()
    if  z>0.3:
        steps=steps+1
        sense.show_message(str(steps) , text_colour=[255,255,255], scroll_speed=0.04)
        with db:
                curs.execute("TRUNCATE TABLE test1")
                curs.execute("INSERT INTO test1 VALUES(%s,%s,CURRENT_DATE(),NOW())",[number,steps])
        with db2:
                curs2.execute("TRUNCATE TABLE myTable")
                curs2.execute("INSERT INTO myTable VALUES(%s,%s,CURRENT_DATE(),NOW())",[number,steps])
    elif x<0.3:
        stop()
sense.set_pixels(frame1)
sleep(10)
sense.clear()
