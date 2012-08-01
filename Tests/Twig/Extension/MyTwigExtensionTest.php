<?php

namespace ECnerta\Bundle\TwigExtensionBundle\Tests\Twig\Extension;

use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\Request;

class MyTwigExtensionTest extends \PHPUnit_Framework_TestCase
{
    protected $container;
    protected $twigExtension;

//    public function setUp()
//    {
//        $this->container     = new Container();
//        $this->twigExtension = new MyTwigExtension($this->container);
//
//        $this->container->set('bod', new CommonService($this->container));
//    }
//
//    /**
//     * @dataProvider provideBrowser
//     */
//    public function testBrowser($isBrowserAllowed, $userAgent, $browserName, $browserVersion)
//    {
//        $request = new Request();
//        $request->server->set('HTTP_USER_AGENT', $userAgent);
//        $this->container->set('request', $request);
//
////        $this->twigExtension->getBrowserName();
////        exit;
//
////        echo "<pre> :";
////        var_dump($this->twigExtension->getBrowserName(), $this->twigExtension->getBrowserVersion() );
////        echo "</pre>";
//        //$this->assertEquals($isBrowserAllowed, $this->twigExtension->isBrowserAllowed()); //TODO trouver pour quoi cela ne fonctionne pas
//        $this->assertEquals($browserName, $this->twigExtension->getBrowserName(), "The browser name is correctly matched");
//        $this->assertEquals($browserVersion, $this->twigExtension->getBrowserVersion(), "The browser version is correctly matched");
//    }
//
//    public function provideBrowser()
//    {
//        //http://www.useragentstring.com
//        //http://www.useragentstring.com/pages/Opera/
//        return array(
//            array(FALSE, 'Unknown', '', ''),
//            array(TRUE, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)', 'Internet Explorer', '8.0'),
//            array(TRUE, 'Mozilla/5.0 (X11; Linux x86_64; rv:7.0.1Gecko/20100101 Firefox/7.0.1', 'Mozilla Firefox', '7.0.1'),
//            array(TRUE, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/535.2 (KHTML, like Gecko) Chrome/18.6.872.0 Safari/535.2 UNTRUSTED/1.0 3gpp-gba UNTRUSTED/1.0', 'Google Chrome', '18.6.872.0'),//Chrome
//            array(TRUE, 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/535.7 (KHTML, like Gecko) Chrome/16.0.912.36 Safari/535.7', 'Google Chrome', '16.0.912.36'),//Chrome
//            array(TRUE, 'Mozilla/5.0 (Windows; U; Windows NT 6.1; tr-TR) AppleWebKit/533.20.25 (KHTML, like Gecko) Version/5.0.4 Safari/533.20.27', 'Safari', '5.0.4'),//safari Windows
//            array(TRUE, 'Mozilla/5.0 (Macintosh; U; Intel Mac OS X 10_6_8; de-at) AppleWebKit/533.21.1 (KHTML, like Gecko) Version/5.0.5 Safari/533.21.1', 'Safari', '5.0.5'),//safari Mac
//            array(TRUE, 'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00', 'Opera', '12.00'),//opera
//            array(TRUE, 'Opera/9.80 (Macintosh; Intel Mac OS X 10.6.8; U; fr) Presto/2.9.168 Version/11.52', 'Opera', '11.52'),//opera
//            array(TRUE, 'Opera/9.80 (X11; Linux i686; U; ru) Presto/2.8.131 Version/11.11', 'Opera', '11.11'),//opera
//            array(FALSE, 'Mozilla/5.0 (Windows; U; Win 9x 4.90; SG; rv:1.9.2.4) Gecko/20101104 Netscape/9.1.0285', 'Netscape', '9.1.0285'),//Netscape
//            array(FALSE, 'Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.9.0.8) Gecko/20090327 Galeon/2.0.7', 'Galeon', '2.0.7'),//Galeon
//            array(FALSE, 'Mozilla/5.0 (compatible; Konqueror/4.5; FreeBSD) KHTML/4.5.4 (like Gecko)', 'Konqueror', '4.5'),//Konqueror
//            array(FALSE, 'Lynx/2.8.8dev.3 libwww-FM/2.14 SSL-MM/1.4.1', 'Lynx', '2.8.8')//Lynx
//        );
//    }
//
//    public function testGetName()
//    {
//        $this->assertEquals('bodTwigExt', $this->twigExtension->getName());
//    }
//
//    /**
//     * @depends testGetName
//     */
//    public function testGetFilters()
//    {
//        $filtersname = array("vardump", "printr", "float", "shuffle", "classMethodes");
//        //$this->oKernel->getContainer()->getExtension('web')->twig_float_filter(new \Twig_Environment(), $toReturn);
//
//        foreach ($this->twigExtension->getFilters() as $k => $v) {
//            $this->assertTrue(in_array($k, $filtersname, "Ce filtre ne fonctionne pas : ".$filtersname."\n"));
//            $this->assertInstanceOf('Twig_Filter_Method', $v);
//        }
//    }
//
//    /**
//     * @depends testGetFilters
//     */
//    public function testGetFunctions()
//    {
//        $filtersname = array("title", "form_label_help", "current_route_is", "is_browser_allowed", "is_cookie_active", "get_famille_aliment", "get_famille_materiel", "get_browser_name", "get_browser_version", "get_structure_name", "get_structure_pays_ville_cp", "is_in_the_same_structure_than");
//        //$this->oKernel->getContainer()->getExtension('web')->twig_float_filter(new \Twig_Environment(), $toReturn);
//
//        foreach ($this->twigExtension->getFunctions() as $k => $v) {
//            $this->assertTrue(in_array($k, $filtersname));
//            $this->assertInstanceOf('Twig_Function_Method', $v);
//        }
//    }
//
//    /**
//     * @depends testGetFunctions
//     */
//    public function testRenderLabelHelp() {
//        //TODO test renderLabelHelp
//    }
//
//
//    /**
//     * @depends testRenderLabelHelp
//     */
//    public function testTwig_float_filter() {
//        $vatToTest = array(
//            array('test'=>3, 'res'=> 3),
//            array('test'=>3.1, 'res'=> "3,10"),
//            array('test'=>3.10, 'res'=> "3,10"),
//            array('test'=>3.100, 'res'=> "3,10"),
//            array('test'=>3.1000, 'res'=> "3,10"),
//            array('test'=>3.101, 'res'=> "3,101"),
//            array('test'=>-12, 'res'=> "-12"),
//            array('test'=>-12.32145, 'res'=> "-12,321"),
//            array('test'=>-12.32165, 'res'=> "-12,322"),
//            array('test'=>100000000000, 'res'=> "100000000000"),
//            array('test'=>"12,32165", 'res'=> "12"),
//        );
//
//        foreach($vatToTest as $totest) {
//            $res = $this->twigExtension->twig_float_filter($totest['test']);
//
//            $this->assertEquals($totest['res'], $res);
//        }
//    }
//
//    /**
//     * @depends testTwig_float_filter
//     */
//    public function testTwig_printr_filter() {
//        $res = $this->twigExtension->twig_printr_filter("untext", FALSE);
//        $this->assertEquals("<pre>untext</pre>", $res);
//
//        $res = $this->twigExtension->twig_printr_filter(array("untext"), FALSE);
//        $value = <<<VALUE
//<pre>Array
//(
//    [0] => untext
//)
//</pre>
//VALUE;
//        $this->assertEquals($value, $res);
//    }
//
//    /**
//     * @depends testTwig_printr_filter
//     */
//    public function testTwig_vardump_filter() {
//        $res = $this->twigExtension->twig_vardump_filter("untext", FALSE);
//        $value = <<<VALUE
//<pre>string(6) "untext"
//</pre>
//VALUE;
//
//$this->assertEquals($value, $res);
//
//        $res = $this->twigExtension->twig_vardump_filter(array("untext"), FALSE);
//
//        $value = <<<VALUE
//<pre>array(1) {
//  [0]=>
//  string(6) "untext"
//}
//</pre>
//VALUE;
//        $this->assertEquals($value, $res);
//    }
//
//
//
//    /**
//     * @depends testTwig_vardump_filter
//     */
//    public function testTwig_filtre_shuffle() {
//
//        $arrayTest = array(1,2,3,4,5,6,7,8,9);
//        $res = $this->twigExtension->twig_filtre_shuffle($arrayTest);
//
//        $test = FALSE;
//
//        for($x = 0; $x <= count($res) -1; $x++){
//            if($arrayTest[$x] != $res[$x]) {
//                $test = TRUE;
//            }
//        }
//
//        if($test === FALSE) {
//            $this->assertEquals(0,1);
//        }
//    }
//
//     /**
//     * @depends testTwig_filtre_shuffle
//     */
//    public function testIsCookieActive() {
////        $res = $this->twigExtension->isCookieActive();
////
////        $this->assertFalse($res);
//    }
//
////
////    /**
////     * @depends testIsCookieActive
////     */
////    public function testGetFamilleAliment() {
//////        $em = $this->oKernel->getContainer()->get('doctrine.orm.entity_manager');
//////
//////        $em->getRepository("BOD\ModelBundle\Entity\BOffreDon")->findOneBy;
//////
//////        $res = $this->oKernel->getContainer()->get('twig')->getExtension('bodTwigExt')-> getFamilleAliment();
//////
//////        $this->assertFalse($res);
////    }

}