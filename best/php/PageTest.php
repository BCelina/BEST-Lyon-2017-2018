<?php
include_once(__DIR__.'/content/page/Page.php');
include_once(__DIR__.'/content/ContentObject.php');

class PageTest extends PHPUnit_Framework_TestCase
{
	/**
     * @test
     */
    public function testConstruct(){
		$page = new Page("hello", "je suis un contenu", "2016-01-23 13:31:06.00", 1, "Basile");
        $this->assertEquals(1, $page->identifier());
		$this->assertEquals("hello", $page->title);
		$this->assertEquals("je suis un contenu", $page->content);
		$this->assertEquals("Le 23/01/2016 13h31", $page->when());
		$this->assertEquals("Basile", $page->author);
    }
	
	/**
     * @test
     */
    public function testGet(){
		$page = Page::get("hello");
		$page2 = Page::get(2);
        $this->assertEquals(2, $page2->identifier());
		$this->assertEquals("hello", $page->title);
    }
	
	 /**
	 * @test
     * @expectedException InvalidArgumentException
     */
     public function testConstructBadArgument(){
	 	$page = new Page("hello", "je suis un contenu", "2016-400-23 13:31:06.00", 1, "Basile");
	 }
	 
	 
}
?>