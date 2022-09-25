import sys
import blockcypher
import json
if(len(sys.argv) > 1):
    add = sys.argv[1]
    history = blockcypher.get_address_details(add)
    if (history['final_n_tx'] == 1 and history['final_balance'] > 0):
        if (len(history['unconfirmed_txrefs']) > 0):
            print(blockcypher.satoshis_to_btc(history['unconfirmed_txrefs'][0]['value']))
        else:
            print(blockcypher.satoshis_to_btc(history['txrefs'][0]['value']))
    else:
        print(0)