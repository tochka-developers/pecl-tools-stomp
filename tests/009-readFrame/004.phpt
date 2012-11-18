--TEST--
Test stomp::readFrame() - Test the body binary safety
--SKIPIF--
<?php
    if (!extension_loaded("stomp")) print "skip"; 
    if (!stomp_connect()) print "skip";
?>
--FILE--
<?php 
$s = new Stomp();
$s->send('/queue/test-09', "A test Message\0Foo");
$s->subscribe('/queue/test-09', array('ack' => 'auto'));
var_dump($s->readFrame()->body);

?>
--EXPECTF--
string(18) "A test Message Foo"
