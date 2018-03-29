<?php
function instancePackage($vcpu, $ram){
	$packageString = array(
		"t1.micro-1-0.613", "t2.nano-1-0.5", "t2.micro-1-1", "t2.small-1-2", "t2.medium-2-4", "t2.large-2-8", "t2.xlarge-4-16", "t2.2xlarge-8-32",
		"m4.large-2-8", "m4.xlarge-4-16", "m4.2xlarge-8-32", "m4.4xlarge-16-64", "m4.10xlarge-40-160", "m4.16xlarge-64-256", "m3.medium-1-3.75", "m3.large-2-7.5", "m3.xlarge-4-15", "m3.2xlarge-8-30", "m1.small-1-1.7", "m1.medium-1-3.7", "m1.large-2-7.5", "m1.xlarge-4-15",
		"c4.large-2-3.75", "c4.xlarge-4-7.5", "c4.2xlarge-8-15", "c4.4xlarge-16-30", "c4.8xlarge-36-60", "c3.large-2-3.75", "c3.xlarge-4-7.5", "c3.2xlarge-8-15", "c3.4xlarge-16-30", "c3.8xlarge-32-60", "c1.medium-2-1.7", "c1.xlarge-8-7", "cc2.8xlarge-32-60.5", "cc1.4xlarge-16-23",
		"f1.2xlarge-8-122", "f1.16xlarge-64-976",
		"g3.4xlarge-16-122", "g3.8xlarge-32-244", "g3.16xlarge-64-488", "g2.2xlarge-8-15", "g2.8xlarge-32-60", "cg1.4xlarge-16-22",
		"p2.xlarge-4-61", "p2.8xlarge-32-488", "p2.16xlarge-64-732",
		"r4.large-2-15.25", "r4.xlarge-4-30.5", "r4.2xlarge-8-61", "r4.4xlarge-16-122", "r4.8xlarge-32-244", "r4.16xlarge-64-488", "r3.large-2-15", "r3.xlarge-4-30.5", "r3.2xlarge-8-61", "r3.4xlarge-16-122", "r3.8xlarge-32-244",
		"x1.16xlarge-64-976", "x1e.32xlarge-128-3904", "x1.32xlarge-128-1952",
		"m2.xlarge-2-17.1", "m2.2xlarge-4-34.2", "m2.4xlarge-8-68.4",
		"cr1.8xlarge-32-244", "d2.xlarge-4-30.5", "d2.2xlarge-8-61", "d2.4xlarge-16-122", "d2.8xlarge-36-244",
		"i2.xlarge-4-30.5", "i2.2xlarge-8-61", "i2.4xlarge-16-122", "i2.8xlarge-32-244", "i3.large-2-15.25", "i3.xlarge-4-30.5", "i3.2xlarge-8-61", "i3.4xlarge-16-122", "i3.8xlarge-32-244", "i3.16xlarge-64-488", "hi1.4xlarge-16-60.5", "hs1.8xlarge-16-117"
	);
	$packagelist = array();
	foreach($packageString as $val) {
		$temp = explode("-", $val);
		if($temp[1] == $vcpu && $temp[2] == $ram) {
			$packagelist [] = $temp[0];
		}
	}
	
	return $packagelist;
}

$list = instancePackage(2, 4);

var_dump($list)
?>