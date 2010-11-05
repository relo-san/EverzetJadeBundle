Provides Jade.php templates support for your Symfony2 project.
See [Jade.php site](http://everzet.com/jade.php) & [repository](http://github.com/everzet/jade.php) for more info.

## Features

- high performance parser
- great readability
- contextual error reporting at compile &amp; run time
- combine dynamic and static tag classes
- no tag prefix
- clear & beautiful HTML output
- filters
  - :php
  - :cdata
  - :css
  - :javascript
- [TextMate Bundle](http://github.com/miksago/jade-tmbundle)
- [VIM Plugin](http://github.com/vim-scripts/jade.vim.git)

## Installation

### Add Everzet\JadeBundle to your src/Bundle dir

    git submodule add git://github.com/everzet/EverzetJadeBundle.git src/Bundle/Everzet/JadeBundle

### Put Jade.php inside vendors folder

    git submodule add git://github.com/everzet/jade.php src/vendor/jade.php

### Add Jade.php namespace to autoload

    // src/autoload.php
    $loader->registerNamespaces(array(
        // ...
        'Everzet\\Jade' => $vendorDir . '/jade.php/src',
        // ...
    ));

### Add EverzetJadeBundle to your application kernel

    // app/AppKernel.php
    public function registerBundles()
    {
        return array(
            // ...
            new Bundle\Everzet\JadeBundle\EverzetJadeBundle(),
            // ...
        );
    }

### Turn on jade bundle in application config

    # app/config/config.yml
    jade.config: ~

## Write templates

Write jade templates as you do with php, but suffix them with `.jade` extension:

    # Application/HelloBundle/Resources/views/Hello/index.jade
    
    - $view->extend('HelloBundle::layout.jade')

    h2
      | Hello {{ $name }}!!!

    # Application/HelloBundle/Resources/views/layout.jade
    
    !!! strict
    html
      head
        meta( http-equiv:"Content-Type", content="text/html; charset=utf-8" )
        title
          - $view['slots']->output('title', 'Hello Application')
      body
    
        h1 Hello Application

        - $view['slots']->output('_content')

Then you could render them like this:

    return $this->render('HelloBundle:Hello:index.jade', array('name' => $name));

## CREDITS

List of developers who contributed:

- Konstantin Kudryashov (ever.zet@gmail.com)

