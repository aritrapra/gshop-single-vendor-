<?php
namespace App\monero;

class mymonero{

    function __construct(
        $wallet_file = "C:\\Users\\Cursedman\\PycharmProjects\\monero\\MoneroGUIWallet\\monero-wallet-cli.exe ",
        $demon = "--daemon-host node.monero.net:18081 --trusted-daemon "

        )
    {
        $this->wallet_file = $wallet_file;
        $key_path = storage_path('a');
        $wallet = "--wallet-file ".$key_path." --password pappu1998 ";
        $this->demon = $demon;
        $this->wallet = $wallet;
    }


    function new_add($name = ''){
        $a = shell_exec($this->wallet_file.$this->demon.$this->wallet." address new ".$name." 2>&1");
        $data = explode('**********************************************************************',$a);
        $add_data = $data[count($data)-1];
        $org_data = explode(' ',$add_data);
        #var_dump($org_data);
        $json_data = [];
        $json_data['id'] = $org_data[0];
        $json_data['add'] = $org_data[2];
        return $json_data;
    }

    function all_balance(){
        $a = shell_exec($this->wallet_file.$this->demon.$this->wallet."balance detail");
        $b = explode('**********************************************************************',$a);
        $b = $b[count($b)-1];
        #var_dump($b);
        try {
            $all_bal = trim(nl2br(explode('Primary account',$b)[2]));
            $all_data = explode(' ',$this->cleen($all_bal));
            $balence_array = array_values(array_filter($all_data));
            #var_dump($balence_array);
            $json_data = [];
            for ($i=0; $i < count($balence_array)/6; $i++) {
                $new = [];
                $new['index'] = $balence_array[6 * $i];
                $new['add'] = $balence_array[(6 * $i)+1];
                $new['balance'] = $balence_array[(6 * $i)+2];
                $new['unlocked_balance'] = $balence_array[(6 * $i)+3];
                $new['txs'] = $balence_array[(6 * $i)+4];
                $new['label'] = $this->cleen($balence_array[(6 * $i)+5]);
                array_push($json_data,$new);
            }
            return $json_data;
        } catch (\Throwable $th) {
            return [];
        }
    }

    function refresh(){
        try {
            shell_exec($this->wallet_file.$this->demon.$this->wallet."refresh");
            return 1;
        } catch (\Throwable $th) {
            return 0;
        }

    }

    function cleen($string){
        $string = nl2br($string);
        $string = strip_tags($string);
        return trim($string);
    }

    function find_transaction($all_bal,$key){
        for ($i=0; $i < count($all_bal); $i++) {
            $index = $all_bal[$i]['index'];
            if($index == $key){
                return $all_bal[$i];
            }
        }
        return null;

    }

    static function initialize(){
        $c = new mymonero();
    }
}

?>
