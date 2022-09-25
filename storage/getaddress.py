from bitcoin import *






# Generate QR code



my_private_key3 = random_key()

my_public_key1 = '0468a5a2a1ec22f6de39fb3fcf245907960bf948d1f01a66f0097a59dd2120362d5745154215a1183c1d49d0008ee0118551971a7a9f2e56ff436842ecde5e4e18'
my_public_key2 = '04618080c97bf7f9980f0215eafa211814afaf9b867099564c1682032c28f079a6770ae99ce3dea76225d2bea76a8a8fe11065c4b876d538bb3f88dd2bd99d57e3'
my_public_key3 = privtopub(my_private_key3)

my_multi_sig = mk_multisig_script(my_public_key1, my_public_key2, my_public_key3, 2, 3)
my_multi_address = scriptaddr(my_multi_sig)
# Generate QR code
#url = pyqrcode.create("bitcoin:"+my_multi_address)
#path = os.getcwd() + "\\assets\\temppayimage\\" + my_multi_address + '.png'
#url.png(path, scale = 6)


print(my_multi_address+"*#portal#*"+my_public_key3)
