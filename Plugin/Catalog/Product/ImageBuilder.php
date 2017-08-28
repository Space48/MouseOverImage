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
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;

class ImageBuilder
{
    const CURRENT_PRODUCT_KEY = 'mouseover_current_product';
    const IMAGE_URL           = 'mouseover_image_url';
    const IMAGE_SIZE_ID       = 'category_page_grid';

    /**
     * @var Registry
     */
    protected $registry;

    /**
     * @var Image
     */
    private $imageHelper;

    public function __construct(
        Registry $registry,
        Image $imageHelper
    )
    {
        $this->registry = $registry;
        $this->imageHelper = $imageHelper;
    }

    /**
     * @param CoreImageBuilder $subject
     * @param \Magento\Catalog\Block\Product\Image $result
     *
     * @return mixed
     */
    public function afterCreate(CoreImageBuilder $subject, $result)
    {
        $product = $this->registry->registry(self::CURRENT_PRODUCT_KEY);

        $result->setData(self::IMAGE_URL, $this->getMouseOverImageUrl($product));
        $result->setTemplate($this->getTemplate($result->getTemplate()));

        return $result;
    }

    /**
     * @param $product
     *
     * @return string
     */
    private function getMouseOverImageUrl($product)
    {
        $mouseOverImageUrl = '';

        if ($mouseOverImage = $product->getData('mouseover_image')) {
            $mouseOverImageUrl = $this->imageHelper->init($product, self::IMAGE_SIZE_ID)
                ->setImageFile($mouseOverImage)
                ->getUrl();
        }

        return $mouseOverImageUrl;
    }

    /**
     * @param CoreImageBuilder $subject
     * @param Closure $proceed
     * @param Product $product
     *
     * @return CoreImageBuilder
     * @throws \RuntimeException
     */
    public function aroundSetProduct(CoreImageBuilder $subject, Closure $proceed, Product $product)
    {
        $result = $proceed($product);

        $this->registry->unregister(self::CURRENT_PRODUCT_KEY);
        $this->registry->register(self::CURRENT_PRODUCT_KEY, $product);

        return $result;
    }

    private function getTemplate($currentTemplate)
    {
        return str_replace('Magento_Catalog::', 'Space48_MouseOverImage::', $currentTemplate);
    }
}
