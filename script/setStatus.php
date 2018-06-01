<?php

function setStatus($x,$y){
  $x=$x;
  $y=$y;

  if($x == $y || $x > $y && $x !=0 && $y!=0){
    echo '<span class="text-success">'.'Completed'.'<span>';
  }

  else if($x ==0 && $y==0){
    echo '<span class="text-warning">'.'Ongoing'.'<span>';
  }

  else if($x < $y){
    echo '<span class="text-danger">'.'Behind Schedule'.'<span>';
  }
}

?>
