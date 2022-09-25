
import sys
import requests
from bitcoin import *

if(len(sys.argv) > 0):
    my_key1 = "d529f8a4da7ef659bf6c5dd1ad256a3cb43bbb2475d89cbb40ec00abb4a664b2"
    my_key2 = "6ad1a84d6a86ded8401267cacd5edc4b1a3a397f24be01a25f9c4a252c9eaee9"
    my_public_key1 = privtopub(my_key1)
    my_public_key2 = privtopub(my_key2)
    my_public_key3 = sys.argv[1]
    my_multi_sig = mk_multisig_script(my_public_key1, my_public_key2, my_public_key3, 2, 3)
    add = scriptaddr(my_multi_sig)
    unspentData = unspent(add)
    inputs = unspentData[0]['output']
    spendSats = unspentData[0]['value']
    url = 'https://mempool.space/api/v1/fees/recommended'
    r = requests.get(url).json()
    midfees = r['hourFee']
    spendSats = spendSats - (439 * midfees)
    addSpend = sys.argv[2]
    ctx =  mktx(inputs, addSpend+':'+str(spendSats))
    #print(ctx)
    sig1 =  multisign (ctx, 0, my_multi_sig, my_key1)
    sig2 =  multisign (ctx, 0, my_multi_sig, my_key2)

    tx2 =  apply_multisignatures (ctx, 0, my_multi_sig, [sig1, sig2])
    pushtx(tx2)
    print(tx2)
