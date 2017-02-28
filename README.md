# Termite
***Composer Dev Vendor Loader***

Make symlinks to your package repositories on you computer.

Example ```$ ln -s ~/Projects/MyPackage/ ~/Projects/my-new-web-site/dev_vendor/```

Call after your composer autoloader.

```<?php new \Termite\Autoloader(ENVIRONMENT, BASEPATH . '../dev_vendor/');```

