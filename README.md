# MouseOverImage
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
