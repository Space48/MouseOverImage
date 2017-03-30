<?php
/**
 * Space48_MouseOverImage
 *
 * @category    Space48
 * @package     Space48_MouseOverImage
 * @Date        03/2017
 * @license     http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * @author      @diazwatson
 */

declare(strict_types = 1);
namespace Space48\MouseOverImage\Block\Catalog\Product;

class Image extends \Magento\Catalog\Block\Product\Image
{

    /**
     * Get MouseOver Image Url
     *
     * @return string
     */
    public function getMouseOverImageUrl()
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->getData('product');
        $imageHelper = $this->getImageHelper();

        $imageUrl = '';
        if ($mouseOverImage = $product->getData('mouseover_image')) {
            $imageUrl = $imageHelper->init($product, 'product_page_image_large')
                ->setImageFile($mouseOverImage)
                ->getUrl();
        }

        return $imageUrl;
    }
}