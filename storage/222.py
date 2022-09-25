import os
import sys


class mymonero:
    def __init__(self):
        self.module_url = "C:\\Users\\Cursedman\\PycharmProjects\\monero\\MoneroGUIWallet\\monero-wallet-cli.exe "
        self.load_wallet = "--wallet-file hello1 --password hello "
        self.deamon = "--daemon-host node.monero.net:18081 --trusted-daemon "

    def create(self):
        data = os.popen("C:\\Users\\Cursedman\\PycharmProjects\\monero\\MoneroGUIWallet\\monero-wallet-cli.exe --generate-new-wallet hello1 --password hello --mnemonic-language English").read()
        return data

    def exicute(self,argument):
        if(argument == 'all_balance'):
            return self.all_bal()
        elif(argument == 'new_add'):
            return self.new_add(sys.argv[2])

    def all_bal(self):
        data = os.popen(self.module_url + self.load_wallet + self.deamon + 'balance detail').read()
        data = data.split('Balance per address:')
        data = data[len(data)-1].split('\n')
        a = 2
        retdata = []
        while (a < len(data) - 1):
            json = {}
            part = data[a].split('        ')
            index = part[0].split(' ')
            index = index[len(index) - 2]
            balence = part[1]
            json['balence'] = balence
            json['index'] = index
            retdata.append(json)
            a = a + 1
        return retdata



    def all_add(self):
        data = os.popen(self.module_url + self.load_wallet + self.deamon + 'address all').read()
        return data

    def refresh(self):
        try:
            data = os.popen(self.module_url + self.load_wallet + self.deamon + 'refresh').read()
            return data
        except:
            return 0
    def new_add(self,name):
        data = os.popen(self.module_url + self.load_wallet + 'address new ' + name).read()
        return data
        #add_data = data.split('\n')
        #addline = add_data[len(add_data) - 2]
        #index = addline.split()[0]
        #add = addline.split()[1]
        #json = {}
        #json['address'] = add
        #json['index'] = index
        #return json

    def balence(self,index):
        data = os.popen(
            self.module_url + self.load_wallet + self.deamon + 'show_transfers in index=' + str(index)).read()
        try:

            balence = data.split('**********************************************************************')
            # data = os.popen(self.module_url + self.load_wallet + self.deamon + 'help').read()
            t_data = {}
            transaction = balence[len(balence) - 1].split('    ')
            if(transaction[1] == 'pool'):
                transaction = transaction[4].split(' ')
                t_data['status'] = 'pending'
                t_data['id'] = transaction[4]
                t_data['value'] = transaction[3]
            else:
                transaction = transaction[3].split(' ')
                t_data['status'] = 'confirm'
                t_data['id'] = transaction[4]
                t_data['value'] = transaction[3]


            return t_data

        except:
            return 0


new_wallet = 'C:\\Users\\Cursedman\\PycharmProjects\\monero\\MoneroGUIWallet\\monero-wallet-cli.exe --generate-from-view-key 1b80b3a555a57106a3b52ff27a728950c9d9730dc903928dc02a4607e38e9a07'


c = mymonero()
#print(c.exicute(sys.argv[1]))
print(c.create())

#index,add = c.new_add('start_add1')
#print(c.new_add('checkadd_4'))
#print(c.refresh())
#print(c.all_add())
#print(c.all_bal())
#print(c.balence(36))

