<?php 

//sub

$nsq_lookupd = new NsqLookupd("101.200.220.194:4161"); //the nsqlookupd http addr
$nsq = new Nsq();

$config = array(
    "topic" => "test",
    "channel" => "struggle",
    "rdy" => 1,
    "connect_num" => 1, 
    "retry_delay_time" => 5000,  // after 5000 msec, message will be retried
    "auto_finish" => true,
);

echo '1';
$nsq->subscribe($nsq_lookupd, $config, function($msg,$bev){
    for($i=0 ;$i <1000000000;$i++){
        if($i%10000== 0){
            echo $msg->payload . " " . "attempts:".$msg->attempts."\n";
            $msg->touch($bev,$msg->message_id);
        
        }
    }

    //$msg->touch($bev,$msg->message_id); //if you callback run long time ,you can use this function 
});
