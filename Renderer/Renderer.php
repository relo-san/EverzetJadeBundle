<?php

namespace Bundle\Everzet\JadeBundle\Renderer;

use Symfony\Component\Templating\Renderer\PhpRenderer;
use Symfony\Component\Templating\Storage\Storage;
use Symfony\Component\Templating\Storage\FileStorage;

use Everzet\Jade\Jade;

/*
* This file is part of the EverzetJadeBundle.
* (c) 2010 Konstantin Kudryashov <ever.zet@gmail.com>
*
* For the full copyright and license information, please view the LICENSE
* file that was distributed with this source code.
*/

/**
 * Jade Renderer. 
 */
class Renderer extends PhpRenderer
{
    protected $jade;

    /**
     * Initialize Jade Renderer. 
     * 
     * @param   Jade    $jade   jade renderer
     */
    public function __construct(Jade $jade)
    {
        $this->jade = $jade;
    }

    /**
     * Evaluates a template.
     *
     * @param Storage $template   The template to render
     * @param array   $parameters An array of parameters to pass to the template
     *
     * @return string|false The evaluated template, or false if the renderer is unable to render the template
     */
    public function evaluate(Storage $template, array $parameters = array())
    {
        $storage = new FileStorage($this->jade->cache($template));

        return parent::evaluate($storage, $parameters);
    }
}
