<?php 

function translations($route)
{
    if(!file_exists($route)) {
	return [];
    }
    return json_decode(file_get_contents($route), true);
}