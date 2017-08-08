# MouseOverImage

[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/Space48/MouseOverImage/badges/quality-score.png?b=master&s=986facce0d5ea9e46ed1249d5d8857ae3d2d9cfb)](https://scrutinizer-ci.com/g/Space48/MouseOverImage/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/Space48/MouseOverImage/badges/build.png?b=master&s=c7e441ea1e92ab0502a6788e39caca51e7b46f6c)](https://scrutinizer-ci.com/g/Space48/MouseOverImage/build-status/master)
[![Code Coverage](https://scrutinizer-ci.com/g/Space48/MouseOverImage/badges/coverage.png?b=master&s=fd6591d20cd1dfb98aed4fdbcce46986ef1e4bd4)](https://scrutinizer-ci.com/g/Space48/MouseOverImage/?branch=master)

Simple Magento2 extension to show `mouseover_image` in product list.

![plp-image-mouseover-states](https://cloud.githubusercontent.com/assets/14164128/23297878/28a5370e-fa73-11e6-8692-da5fc6138a18.png)

## Installation

**Manually:**

To install this module copy the code from this repo to `app/code/Space48/MouseOverImage` folder of your Magento 2 instance, then you need to run php `bin/magento setup:upgrade`

**Via composer:**

From the terminal execute the following:

`composer config repositories.space48-quick-view vcs git@github.com:Space48/MouseOverImage.git`

then

`composer require "space48/mouseoverimage:dev-master"`

**Using Modman:**

From the terminal execute the following:

`modman clone git@github.com:Space48/MouseOverImage.git`

## How to use it

Once installed...

1. Execute the indexer `bin/magento indexer:reindex`
2. Go to the `Admin Penel -> Products -> Catalog` and edit a product.
3. Under `Images and Videos` section, select an image and assign the Role `Mouse Over`
4. Save changes.
