from distutils import extension
from operator import not_
from os import close, remove, write
import os
import time  
from datetime import date, datetime, timedelta,timezone
import shutil 
from shutil import copy2, copytree
from shutil import copy
from shutil import move
import glob
from os import remove
import urllib.request

#Establece la hora
espacio="-------------"
now = datetime.now()
fecha1= time.strftime("%Y-%m-%d")
fecha2= time.strftime("%Y-%m-%d-%H%M")
print(fecha1)
print(fecha2)
print(espacio)


urlsEstaciones=['cuajimalpa','iztacalco','cuautepec','miguelhidalgo','juarez','xochimilco','topilejo']
idEstaciones=['STFS','AGOS','CUAUS','LEGS','SGIRPC','TLHS','TPJS']
k=1
for i in range(0,7):
    #URL de l aimagen
    url1 = "http://189.254.33.151/stn/" + urlsEstaciones[i] + "/downld02.txt"
    #Ruta donde se guardara la imagen y nombre
    #file1 = r"C:\\Apache24\\htdocs\\estacionesMet\\files\\" + idEstaciones[i] + ".txt"
    file1 = r"idEstaciones[i]" + ".txt"
    k=k+1
    #Petición de descarga
    r = urllib.request.urlopen(url1)
    f = open(file1,"wb")
    f.write(r.read())
    f.close()



