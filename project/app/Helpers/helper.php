<?php

use Morilog\Jalali\Jalalian;

function jalaliDate($date,$format='%A, %d %B %y')
{
   return $date = Jalalian::forge($date)->format($format);
}
