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

declare(strict_types=1);

namespace Space48\MouseOverImage\Plugin\Catalog\Product;

use Closure;
use Magento\Catalog\Block\Product\ImageBuilder as CoreImageBuilder;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Helper\ImageFactory;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;

class ImageBuilder
{

    /**
     * @var Image
     */
    private $imageHelper;
    /**
     * @var ImageFactory
     */
    private $imageFactory;

    public function __construct(
        Registry $registry,
        Image $imageHelper,
        ImageFactory $imageFactory
    )
    {
        $this->registry = $registry;
        $this->imageHelper = $imageHelper;
        $this->imageFactory = $imageFactory;
    }

    /**
     * @param CoreImageBuilder $subject
     * @param                  $result
     *
     * @return mixed
     */
    public function afterCreate(CoreImageBuilder $subject, $result)
    {
        $product = $this->registry->registry('mouseoverimage_current_product');
        $mouseOverImage = $product->getData('mouseover_image');
        $result->setData('mouse_over_image_url', $this->getMouseOverImageUrl($product, $mouseOverImage));
        // TODO Find the way to rewrite core template from here
//        $result->setTemplate($this->getTemplate($product));

        return $result;
    }

    /**
     * @param $product
     * @param $mouseOverImage
     *
     * @return string
     */
    private function getMouseOverImageUrl($product, $mouseOverImage): string
    {
        $mouseOverImageUrl = '';
        if ($mouseOverImage){
            $mouseOverImageUrl = $this->imageHelper->init($product, 'product_page_image_large')
                ->setImageFile($mouseOverImage)
                ->getUrl();
        }

        return $mouseOverImageUrl;
    }

    /**
     * @param CoreImageBuilder $subject
     * @param Closure          $proceed
     * @param Product          $product
     *
     * @return CoreImageBuilder
     */
    public function aroundSetProduct(CoreImageBuilder $subject, Closure $proceed, Product $product)
    {
        $result = $proceed($product);
        $this->registry->unregister('mouseoverimage_current_product');
        $this->registry->register('mouseoverimage_current_product', $product);

        return $result;
    }

    private function getTemplate($product)
    {
        $helper = $this->imageFactory->create()
            ->init($product, 'category_page_grid');

        return $helper->getFrame()
            ? 'Space48_MouseOverImage::product/image.phtml'
            : 'Space48_MouseOverImage::product/image_with_borders.phtml';
    }
}