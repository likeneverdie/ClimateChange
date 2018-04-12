from sense_hat import SenseHat
from time import sleep
import pygal
import MySQLdb
bar_chart = pygal.Line()
sense = SenseHat()
#db = MySQLdb.connect("140.116.100.80","root","")
db2 = MySQLdb.connect("localhost","readyornot","ron","myDB")
curs2 = db2.cursor()
curs2.execute("TRUNCATE TABLE ptest")
i = 0
for i in range(1,102):
        sleep(0.1)
        acceleration = sense.get_accelerometer_raw()
        gyroscope = sense.get_gyroscope_raw()
        magnetometer = sense.get_compass_raw()
        a = gyroscope['x']
        b = gyroscope['y']
        c = gyroscope['z']
        a = round(a,3)
        b = round(b,3)
        c = round(c,3)
        x = acceleration['x']
        y = acceleration['y']
        z = acceleration['z']
        x = round(x,3)
        y = round(y,3)
        z = round(z,3)
        p = magnetometer['x']
        q = magnetometer['y']
        r = magnetometer['z']
        p = round(p,3)
        q = round(q,3)
        r = round(r,3)
        i += 1
        with db2:
             curs2.execute("INSERT INTO ptest values(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",[i,a,b,c,x,y,z,p,q,r])

xlabel=list()
ax=list()
ay=list()
az=list()
gx=list()
gy=list()
gz=list()
mx=list()
my=list()
mz=list()
i=0
for row in range(1,102):
    i+=1
    print(xlabel)
    xlabel.append(i)
db3 = MySQLdb.connect("localhost","readyornot","ron","myDB")
curs3 = db3.cursor()
line_chart = pygal.Line()
curs3.execute("select*from ptest order by ID desc limit 0,100")

for row in curs3.fetchall():
    xlabel.append(row[0])
    ax.append(row[1])
    ay.append(row[2])
    az.append(row[3])
    gx.append(row[4])
    gy.append(row[5])
    gz.append(row[6])
    mx.append(row[7])
    my.append(row[8])
    mz.append(row[9])

line_chart.x_labels = xlabel
line_chart.add('Accelerometer_x',ax)
line_chart.add('Accelerometer_y',ay)
line_chart.add('Accelerometer_z',az)
line_chart.add('Gyroscope_x',gx)
line_chart.add('Gyroscope_y',gy)
line_chart.add('Gyroscope_z',gz)
line_chart.add('Magnetometer_x',mx)
line_chart.add('Magnetometer_y',my)
line_chart.add('Magnetometer_z',mz)
line_chart.render_to_file('lab6.svg')
