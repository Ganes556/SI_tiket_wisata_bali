from distutils.util import convert_path
from fileinput import filename
from random import random
import gspread
from google.oauth2 import service_account
import wget
import os
import gdown
from pathlib2 import Path
import time

creds = service_account.Credentials.from_service_account_file("credentials.json")

scoped_creds = creds.with_scopes(
    [
        "https://www.googleapis.com/auth/spreadsheets",
        "https://www.googleapis.com/auth/drive",
    ]
)

gc = gspread.authorize(scoped_creds)

sh = gc.open_by_url(
    "https://docs.google.com/spreadsheets/d/1q0tvetpl1AQ2TNGXDWD3183jVt6EJ5a6FstrhXzt2BM/edit?resourcekey#gid=982634702"
)

worksheet = sh.get_worksheet(0)
# covers = worksheet.get_values("B17:B")
# nama = worksheet.get_values("C17:C")
# galery = worksheet.get_values("E17:E")
deskripsiWisata = worksheet.get_values("D2:D")[:14]
# print(deskripsiWisata)
open("desk.txt","w").write(str(deskripsiWisata))
exit()

converted_covers = []
for i in range(len(covers)):
    convert = covers[i]
    str_convert = "".join(convert).replace("open?", "uc?")
    converted_covers.append(str_convert)

converted_nama = []
for i in range(len(nama)):
    convert = nama[i]
    str_convert = "".join(convert)
    if str_convert[-1] == " ":
        str_convert = str_convert[:-1]
    converted_nama.append(str_convert)


converted_galery = []
for i in range(len(galery)):
    convert = galery[i]
    galery_sublist = "".join(convert).split(", ")

    for j in range(len(galery_sublist)):
        galery_sublist[j] = galery_sublist[j].replace("open?", "uc?")

    converted_galery.append(galery_sublist)

for i in range(len(converted_nama)):
    cover_path = os.path.join(os.getcwd(), "DataWisata", converted_nama[i], "Cover")
    galery_path = os.path.join(os.getcwd(), "DataWisata", converted_nama[i])
    os.makedirs(
        os.path.join(os.getcwd(), "DataWisata", converted_nama[i], "Cover"),
        exist_ok=True,
    )
    wget.download(converted_covers[i], cover_path)
    time.sleep(1)

    for j in range(len(converted_galery[i])):
        wget.download(converted_galery[i][j], galery_path) 
        time.sleep(1) # seconds

# for i in range(len(converted_nama)):
#     # cover_path = os.path.join(os.getcwd(), "Data Wisata", converted_nama[i], "Cover")
#     # galery_path = os.path.join(os.getcwd(), "Data Wisata", converted_nama[i])
#     desk = os.path.join(os.getcwd(), "Data Wisata", converted_nama[i])
#     os.makedirs(
#         os.path.join(os.getcwd(), "Data Wisata", converted_nama[i]),
#         exist_ok=True,
#     )
#     wget.download(converted_covers[i], cover_path)
#     time.sleep(1)

#     for j in range(len(converted_galery[i])):
#         wget.download(converted_galery[i][j], galery_path)
#         time.sleep(1)
