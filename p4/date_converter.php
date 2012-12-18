<?php

class static function epoch_converter($timestamp){

	return Time::display($timestamp, null, "America/New_York");

}