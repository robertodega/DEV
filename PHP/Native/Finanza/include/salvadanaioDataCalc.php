<?php
    $startAmount = 1;
    $increment = 1;
    $amount = [];
    $saving = [];
    foreach ($months as $k => $v){
        $weeksInMonth = (int)ceil(date('t', strtotime(date('Y').'-'.$v.'-01')) / 7);
        for($i = 1; $i <= $weeksInMonth; $i++){            
            if($v == '01'){
                $saving["".$v.""] = $startAmount * intval($weeksInMonth);
                $amount["".$v.""] = $startAmount * intval($weeksInMonth);
            }
            else{
                $prev = intval($v) - 1;
                $prev = (strlen($prev) == 1) ? "0".$prev : $prev;
                $saving["".$v.""] = $saving["".$prev.""] + $increment;
                $amount["".$v.""] = $amount["".$prev.""] + $saving["".$v.""];
            }
        }
    }
?>