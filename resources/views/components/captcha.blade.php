<?php

    $filepath = storage_path('captcha_data.txt');
    $file = fopen($filepath,"r");
    $conte = fread($file,filesize($filepath));
    $data = explode("92Gpds",$conte);
    $random_number = rand(0,9999);
    $imgdata = $data[$random_number];

    $imgurl = $imgdata.".jpg";




?>

<div class="mb-3">
    @error('captcha')
        <p style="letter-spacing: 0px;font-size: 12px;color: rgb(255,0,0);background: #e9ff00;padding: 6px;font-weight: bold;margin-top:5px;">{{ $message }}</p>
    @enderror
    <input type="hidden" name="captcha_confirm" value="{{ $imgdata }}">
    <label class="form-label" for="password">Captcha</label>
    <img src="{{ asset('assets/captcha/'.$imgurl) }}" style="width: 100px;height: 25px;margin-left: 15px;">
    <input name="captcha" class="form-control" type="text" id="password">
</div>
