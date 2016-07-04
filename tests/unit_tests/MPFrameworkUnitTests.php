<?php
require_once './MPTools/MPTools.php';

class MPToolsTest extends PHPUnit_Framework_TestCase {


public function setUp(){
    $stub = $this->createMock(MP::class);

}

public function tearDown(){}

public function testMustNotSendSponsorIdWhenUserIsTest(){}

public function testMustSendSponsorIdWhenUserIsNotTest(){}

}