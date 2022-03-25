<?php
function send($data) {
    global $token;
    $data_string = json_encode($data);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_URL,"https://api.telegram.org/bot".$token."/sendMessage");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json; charset=utf-8',
        'Content-Length: ' . strlen($data_string))
    );
    ob_start();
    curl_exec($ch);
    $return_content = ob_get_contents();
    ob_end_clean();
    $return_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $return_content = json_decode($return_content,true);
    return $return_content;
}
function make($chat_id,$text){
$data = array(
        "chat_id" => $chat_id,
        "text" => $text,
        "disable_web_page_preview" => true,
        "reply_to_message_id" => $messageid
            );
    return $data; 
}
?>
