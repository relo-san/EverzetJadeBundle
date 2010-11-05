<?php

namespace Bundle\Everzet\JadeBundle;

use Symfony\Component\Templating\Storage\Storage;
use Symfony\Component\Templating\Storage\FileStorage;

use Everzet\Jade\Jade as BaseJade;
use Everzet\Jade\Parser;
use Everzet\Jade\Dumper\DumperInterface;

/*
* This file is part of the EverzetJadeBundle.
* (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

/**
 * Jade.
 */
class Jade extends BaseJade
{
    /**
     * Initialize parser. 
     * 
     * @param   LexerInterface  $lexer  jade lexer
     */
    public function __construct(Parser $parser, DumperInterface $dumper, $cache = null)
    {
        if (null !== $cache && !is_dir($cache)) {
            mkdir($cache, 0777, true);
        }

        parent::__construct($parser, $dumper, $cache);
    }
    
    /**
     * Return source from input (Jade template). 
     * 
     * @param   string  $input  input string or file path
     *
     * @return  string
     */
    protected function getInputSource($input)
    {
        if ($input instanceof Storage) {
            return $input->getContent();
        }

        throw new \InvalidArgumentException(sprintf('The template "%s" does not exist.', $input));
    }

    /**
     * Return caching key for input. 
     * 
     * @param   string  $input  input string or file path
     *
     * @return  string
     */
    protected function getInputCacheKey($input)
    {
        if ($input instanceof Storage) {
            return (string) $input;
        }

        throw new \InvalidArgumentException(sprintf('The template "%s" does not exist.', $input));
    }

    /**
     * Return true if cache, created at specified time is fresh enough for provided input. 
     * 
     * @param   string  $input      input string or file
     * @param   srting  $cacheTime  cache key
     *
     * @return  boolean             true if fresh, false otherways
     */
    protected function isCacheFresh($input, $cacheTime)
    {
        if ($input instanceof Storage) {
            if ($input instanceof FileStorage) {
                return filemtime((string) $input) < $cacheTime;
            }
        }

        return false;
    }

    /**
     * Cache rendered input at provided key. 
     * 
     * @param   string  $cacheKey   new cache key
     * @param   string  $rendered   rendered input
     *
     * @return  string              new cache path
     */
    protected function cacheInput($cacheKey, $rendered)
    {
        $path   = $this->getCachePath($cacheKey);
        $dir    = dirname($path);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($path, $rendered);

        return $path;
    }
}
