<?php
// Copyright 2004-present Facebook. All Rights Reserved.
//
// Licensed under the Apache License, Version 2.0 (the "License");
// you may not use this file except in compliance with the License.
// You may obtain a copy of the License at
//
//     http://www.apache.org/licenses/LICENSE-2.0
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.

// An example of using php-webdriver.
// Do not forget to run composer install before and also have Selenium server started and listening on port 4444.

namespace Facebook\WebDriver;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;

require_once('vendor/autoload.php');

// start Chrome with 5 second timeout
$host = 'http://35.225.149.118:4444/wd/hub'; // this is the default
$capabilities = DesiredCapabilities::chrome();

$capabilities = [
	"platform"=>"Windows 7", "browserName"=>"chrome", "enableVNC" => true
];
$driver = RemoteWebDriver::create($host, $capabilities, 5000);

// navigate to 'http://www.seleniumhq.org/'
$driver->get('https://gsviec.com/');

// adding cookie
$driver->manage()->deleteAllCookies();

$cookie = new Cookie('cookie_name', 'guest');
$driver->manage()->addCookie($cookie);

$cookies = $driver->manage()->getCookies();
print_r($cookies);

// click the link 'About'
// $link = $driver->findElement(
//     WebDriverBy::id('contnet')
// );
// $link->click();

$driver->get('https://gsviec.com/playlist/khoa-hoc-php-can-ban');

$confirmBtn = $driver->wait()->until(
        WebDriverExpectedCondition::elementToBeClickable(
            //WebDriverBy::xpath('//*[@id="userCommand"]/div[2]/div[2]/button')
            WebDriverBy::className('js-hide-modal-subscribe')
        )
    );

   $confirmBtn->click();
	// $link = $driver->findElement(
	//     WebDriverBy::className('js-hide-modal-subscribe')
	// );
	// var_dump($link);
	// $link->click();

// using the browser shortcut to create a new tab
//$driver->getKeyboard()->sendKeys(array(WebDriverKeys::CONTROL, 't'));
// navigate to 'http://www.seleniumhq.org/'
$driver->get('https://gsviec.com/watch?v=wo1&list=khoa-hoc-phalcon-can-ban');
$driver->getKeyboard()->sendKeys(array(WebDriverKeys::CONTROL, 't'));
$els = $driver->findElements(WebDriverBy::xpath("//a[contains(@href,'watch')]"));
// foreach ($els as $key => $el) {
// 	$el->click();
// 	# code...
// }
$el[0]->click();
$el[2]->click();

// //click the link 'About'
// $link = $driver->findElement(
//     WebDriverBy::className('adblock')
// );
// var_dump($link);

// $my_frame = $driver->findElement(WebDriverBy::id('google_ads_frame1'));

// var_dump($my_frame);

// $link->click();

$handles = $driver->getWindowHandles();
$driver->switchTo()->window(end($handles));
sleep(30);

//$elements = $driver->findElements(WebDriverBy::cssSelector('ul.popular-articles > li'));
// $elements = $driver->findElements(WebDriverBy::xpath("//a[contains(@href,'watch')]"));

// // $elements is now array - containing instances of RemoteWebElement (or empty, if no element is found)
// $link = [];
// foreach ($elements as $element) {
// 	//$d = $element->findElement(WebDriverBy::cssSelector('.article-thumbnail'));

// 	//echo $element->getAttribute('href') . "\n";
// 	echo $element->getAttribute('href');

// 	//$driver = RemoteWebDriver::create($host, $capabilities, 5000);
// 		// adding cookie
// 		//$driver->manage()->deleteAllCookies();
// 		//$driver->manage()->addCookie($cookie);
// 			$driver->get($element->getAttribute('href'));
// 			sleep(60);


// 	//$driver->get('https://lackky.com/read-blog/58_ta-i-sao-google-chi-cho-phe-p-di-la-m-mang-theo-cu-n.html');


// }

//var_dump( array_unique($link));

// // wait until the page is loaded
// $driver->wait()->until(
//     WebDriverExpectedCondition::titleContains('About')
// );

// // print the title of the current page
// echo "The title is '" . $driver->getTitle() . "'\n";

// // print the URI of the current page
// echo "The current URI is '" . $driver->getCurrentURL() . "'\n";

// // write 'php' in the search box
// $driver->findElement(WebDriverBy::id('q'))
//     ->sendKeys('php') // fill the search box
//     ->submit(); // submit the whole form

// // wait at most 10 seconds until at least one result is shown
// $driver->wait(10)->until(
//     WebDriverExpectedCondition::presenceOfAllElementsLocatedBy(
//         WebDriverBy::className('gsc-result')
//     )
// );

// close the browser
$driver->quit();
