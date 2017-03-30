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
namespace Space48\MouseOverImage\Plugin\Catalog\Product;

use Closure;
use Magento\Catalog\Block\Product\ImageBuilder as CoreImageBuilder;
use Magento\Catalog\Helper\Image;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;

class ImageBuilder
{

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
     * @param                  $result
     *
     * @return mixed
     */
    public function afterCreate(CoreImageBuilder $subject, $result)
    {
        $result->setProduct($this->registry->registry('mouseoverimage_current_product'));
        $result->setImageHelper($this->imageHelper);

        return $result;
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
}