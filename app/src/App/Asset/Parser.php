<?php
/**
 * User: dongww
 * Date: 14-7-29
 * Time: 下午4:03
 */

namespace App\Asset;


use Assetic\Asset\AssetCollection;
use Assetic\AssetManager;
use Symfony\Component\Yaml\Yaml;

class Parser
{ //todo 需要完善，比如 filter 等
    protected static $typeMap = [
        'file' => 'FileAsset',
        'glob' => 'GlobAsset',
    ];

    /**
     * @param $fileName
     * @return AssetManager
     */
    public static function parseFromYaml($fileName)
    {
        $data = Yaml::parse($fileName);
        $am   = new AssetManager();

        foreach ($data as $k => $v) {
            if (isset($v['assets'])) {
                $assets = [];

                foreach ((array)$v['assets'] as $asset) {
                    $source = $asset['source'];

                    if (!file_exists($source)) {
                        continue;
                    }

                    $type = null;

                    if (isset($asset['type']) && in_array($asset['type'], self::$typeMap)) {
                        $type = self::$typeMap[$asset['type']];
                    } else {
                        $type = self::$typeMap['glob'];
                    }

                    $assets[] = new $type($source);
                }

                $assetCollection = new AssetCollection($assets);
                $am->set($k, $assetCollection);
            }
        }

        return $am;
    }
}
