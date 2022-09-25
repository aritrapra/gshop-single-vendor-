import blockcypher
import bitcoin
import mysql.connector
import time

    
while(True):
        
    try:
        connection = mysql.connector.connect(host='localhost',database='newdatabase',user='newuser', password='password', auth_plugin='mysql_native_password')
        cursor = connection.cursor()
        quary = "SELECT * FROM `incometx` WHERE `status` = 'started'"
        cursor.execute(quary)
        res = cursor.fetchall()
        for i in res:
            print('For Address :' + i[1])
            history = blockcypher.get_address_details(i[1].strip())
            if(history['final_balance'] > 0):
                quary = "UPDATE `incometx` SET `ammount`=%s,`status`='pending',`confirmation`='0' WHERE `address`=%s"
                values = (blockcypher.satoshis_to_btc(history['final_balance']),i[1])
                cursor.execute(quary,values)
                connection.commit()
        quary = "SELECT * FROM `incometx` WHERE `status` = 'pending'"
        cursor.execute(quary)
        res = cursor.fetchall()
        for i in res:
            print('For Address :' + i[1])
            history = blockcypher.get_address_details(i[1].strip())
            if(len(history['unconfirmed_txrefs']) > 0):
                confirmation = history['unconfirmed_txrefs'][0]['confirmations']
            else:
                confirmation = history['txrefs'][0]['confirmations']
            
            if(confirmation > int(i[4]) and confirmation > 3):
                quary = "UPDATE `incometx` SET `confirmation`=%s,`status`='confirmed' WHERE `address`=%s"
                values = ('3+',i[1])
                cursor.execute(quary,values)
                connection.commit()
            else:
                quary = "UPDATE `incometx` SET `confirmation`=%s WHERE `address`=%s"
                values = (confirmation,i[1])
                cursor.execute(quary,values)
                connection.commit()
            print('sleeping')
            
    except mysql.connector.Error as error:
        print("Failed to create table in MySQL: {}".format(error))
    time.sleep(60)