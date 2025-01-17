<?php

namespace yiicod\easyimage\tools;

use Exception;
use Imagine\Image\Box;
use Imagine\Image\ManipulatorInterface;
use Imagine\Image\Point;
use yiicod\easyimage\base\ToolInterface;

/**
 * Class Crop
 * Crop tool
 *
 * @author Virchenko Maksim <muslim1992@gmail.com>
 * @package yiicod\easyimage\tools
 */
class Crop implements ToolInterface
{
    /**
     * Handle image
     *
     * @param ManipulatorInterface $image
     * @param array $params
     *
     * @return ManipulatorInterface
     * @throws Exception
     */
    public static function handle($image, array $params = [])
    {
        if (false === isset($params['width']) || false === isset($params['height'])) {
            throw new Exception('Params "width" and "height" is required for action "Crop"');
        }
         //    $x = $param['offset_x'] > 0 ? $params['offset_x'] : 0;  
         //    $y = $param['offset_y'] > 0 ? $params['offset_y'] : 0; 
        return $image->crop(new Point(
            $params['offset_x'] ?? 0,
            $params['offset_y'] ?? 0
                
         //   $x,
          //  $y    
        ), new Box($params['width'], $params['height']));
    }
}