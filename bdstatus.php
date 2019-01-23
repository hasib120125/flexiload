<?php
$con = mysql_connect('localhost','eclicksa_etopup','zkqVci#oTwc5');
$db = mysql_select_db('eclicksa_etopup',$con);
$query = "select * from transaction";
$result = mysql_query($query);

while($rows = mysql_fetch_array($result))
{    
    if($rows['order_id'] != NULL)
    {
        $apihost = 'www.easyclicksasia.com';
        $order_id = $rows['order_id']; # Retrieve Order ID from your database
        $req_url = 'http://'.$apihost.'/?ng=api/stsf/'.$order_id;
        $output = file_get_contents($req_url);
        $data = base64_decode($output);
        $data = json_decode($data);
        $status =  $data->{'status'};
        $transactionid =  $data->{'transactionid'};

        $query = "UPDATE transaction SET status=".$status.", transactionid = ".$transactionid." where order_id=".$order_id;
        $update = mysql_query($query);
    }
}

?>