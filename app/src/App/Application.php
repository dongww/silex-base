<?php
/**
 * User: dongww
 * Date: 14-5-3
 * Time: 下午12:39
 */

namespace App;

use Dongww\SilexBase\Core\Application as baseApp;
use Silex\Application as coreApp;

class Application extends baseApp
{
    use coreApp\TwigTrait;
//    use coreApp\SecurityTrait;
    use coreApp\FormTrait;
    use coreApp\UrlGeneratorTrait;
//    use coreApp\SwiftmailerTrait;
//    use coreApp\MonologTrait;
    use coreApp\TranslationTrait;
} 