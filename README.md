# Mexico SAT Catalogs for [DOLIBARR ERP CRM](https://www.dolibarr.org)

## Features

This module creates a collection of dictionaries and extra fields with data of the Mexican Service Tax Administration (SAT) catalogs.
The purpose of this module is to serve as dependency for Dolibarr integrations with Mexican compliance services.

### Dictionaries
- Payment methods (Formas de pago)
- Payment options (Métodos de pago)
- Products and services (Productos y servicios)
- Units of measure (Unidades de medida)

### Extra fields
|        Extra field        |         Object        |            Data source dictionary             |
|---------------------------|-----------------------|-----------------------------------------------|
|    SAT's payment method   |    Customer Invoice   |        Payment methods (Formas de pago)       |
|    SAT's payment option   |    Customer Invoice   |       Payment options (Métodos de pago)       |
|  SAT's product or service |        Product        | Products and services (Productos y servicios) |
|   SAT's unit of measure   |        Product        |     Units of measure (Unidades de medida)     |
|  SAT's product or service | Customer Invoice Line | Products and services (Productos y servicios) |
|   SAT's unit of measure   | Customer Invoice Line |     Units of measure (Unidades de medida)     |


If you think more catalogs or extra fields need to be added, please create a new [issue](https://github.com/TI-Sin-Problemas/dolibarr-mxsatcatalogs/issues). PRs are also welcome.

![Screenshot mxsatcatalogs](img/about1.png?raw=true "MxSatCatalogs")

Other external modules are available on [Dolistore.com](https://www.dolistore.com).

## Translations

Translations can be completed manually by editing files into directories *langs*.

<!--
This module contains also a sample configuration for Transifex, under the hidden directory [.tx](.tx), so it is possible to manage translation using this service.

For more information, see the [translator's documentation](https://wiki.dolibarr.org/index.php/Translator_documentation).

There is a [Transifex project](https://transifex.com/projects/p/dolibarr-module-template) for this module.
-->


## Installation

Prerequisites: You must have the Dolibarr ERP CRM software installed. You can down it from [Dolistore.org](https://www.dolibarr.org).
You can also get a ready to use instance in the cloud from htts://saas.dolibarr.org


### From the ZIP file and GUI interface

If the module is a ready to deploy zip file, so with a name module_xxx-version.zip (like when downloading it from a market place like [Dolistore](https://www.dolistore.com)),
go into menu ```Home - Setup - Modules - Deploy external module``` and upload the zip file.

Note: If this screen tell you that there is no "custom" directory, check that your setup is correct:

<!--

- In your Dolibarr installation directory, edit the ```htdocs/conf/conf.php``` file and check that following lines are not commented:

    ```php
    //$dolibarr_main_url_root_alt ...
    //$dolibarr_main_document_root_alt ...
    ```

- Uncomment them if necessary (delete the leading ```//```) and assign a sensible value according to your Dolibarr installation

    For example :

    - UNIX:
        ```php
        $dolibarr_main_url_root_alt = '/custom';
        $dolibarr_main_document_root_alt = '/var/www/Dolibarr/htdocs/custom';
        ```

    - Windows:
        ```php
        $dolibarr_main_url_root_alt = '/custom';
        $dolibarr_main_document_root_alt = 'C:/My Web Sites/Dolibarr/htdocs/custom';
        ```
-->

<!--

### From a GIT repository

Clone the repository in ```$dolibarr_main_document_root_alt/mxsatcatalogs```

```sh
cd ....../custom
git clone git@github.com:gitlogin/mxsatcatalogs.git mxsatcatalogs
```

-->

### Final steps

From your browser:

  - Log into Dolibarr as a super-administrator
  - Go to "Setup" -> "Modules"
  - You should now be able to find and enable the module



## Licenses

### Main code

GPLv3. See file COPYING for more information.

### Documentation

All texts and readmes are licensed under GFDL.
