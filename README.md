# Termite
***Composer Dev Vendor Loader***

[![Latest Stable Version](https://poser.pugx.org/jrsaunders/termite/v/stable)](https://packagist.org/packages/jrsaunders/termite)
[![Total Downloads](https://poser.pugx.org/jrsaunders/termite/downloads)](https://packagist.org/packages/jrsaunders/termite)
[![Latest Unstable Version](https://poser.pugx.org/jrsaunders/termite/v/unstable)](https://packagist.org/packages/jrsaunders/termite)
[![License](https://poser.pugx.org/jrsaunders/termite/license)](https://packagist.org/packages/jrsaunders/termite)

Make symlinks to your package repositories on you computer.

Example ```$ ln -s ~/Projects/MyPackage/ ~/Projects/my-new-web-site/dev_vendor/```

Call after your composer autoloader.

```<?php new \Termite\Autoloader(ENVIRONMENT, BASEPATH . '../dev_vendor/');```

