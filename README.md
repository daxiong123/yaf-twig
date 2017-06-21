# yaf-twig
Yaf using Twig is template engine

---

- [Installation](#installation)
- [Requirements](#requirements)
- [Quick Start and Examples](#quick-start-and-examples)

---

### Installation

To install Validator, simply:

    $ composer require 5ichong/yaf-twig

For latest commit version:

    $ composer require 5ichong/yaf-twig @dev

### Requirements

Validator works with 7.0, 7.1.

### Quick Start and Examples

Add to `application.ini`:

```ini
[product]

application.view.ext = html

[devel : product]

application.twig.debug = true

```

Add to `index.php`:

```php
require __DIR__ . '/vendor/autoload.php';
```

Add to `Bootstrap.php`

```php

use Yaf\Application;
use Yaf\Dispatcher;

public function _initView(Dispatcher $dispatcher)
{
    $conf = Application::app()->getConfig();

    $options = !empty($conf->twig) ? $conf->twig->toArray() : [];

    $twig = new \Aichong\Twig(APP_PATH . "/views/", $options);

    $dispatcher->setView($twig);
}

```




