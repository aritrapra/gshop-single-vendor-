

from bs4 import BeautifulSoup
import requests
import json

def update_rate():
    url = "https://www.unitconverters.net/currency/btc-to-nok.htm"
    res = requests.get(url)
    soup = BeautifulSoup(res.text, 'html.parser')
    soup = soup.find_all(True, {"class":["bigtext"]})
    x = soup[4].text
    currrate = x.split('=')[1].split(' ')[1]


    url = "https://exchangerate.guru/xmr/nok/1/"
    res = requests.get(url)
    soup = BeautifulSoup(res.text, 'html.parser')
    soup = soup.find_all(True, {"class":["blockquote-classic"]})[0].text
    data = soup.split(" ")
    orgdata = data[4]
    orgdata = orgdata.replace(',','')

    print(str(currrate) + "*****" + str(orgdata))

update_rate()
