<?php declare(strict_types=1);

namespace Space48\MouseOverImage\Plugin\Catalog\Product;

use Magento\Catalog\Block\Product\Image as ImageBlock;
use Magento\Catalog\Block\Product\ImageFactory;
use Magento\Catalog\Model\Product;

class ImageFactoryPlugin
{
    const IMAGE_BLOCK_URL_KEY = 'mouseover_image_url';
    const PRODUCT_IMAGE_KEY = 'mouseover_image';
    const LISTING_IMAGE_ID = 'category_page_grid';

    /** @var \Magento\Catalog\Helper\Image */
    private $imageHelper;

    public function __construct(\Magento\Catalog\Helper\Image $imageHelper)
    {
        $this->imageHelper = $imageHelper;
    }

    /**
     * @param ImageFactory $subject
     * @param ImageBlock   $result
     * @param Product      $product
     *
     * @return ImageBlock
     */
    public function afterCreate(ImageFactory $subject, ImageBlock $result, Product $product): ImageBlock
    {
        $result->setData(self::IMAGE_BLOCK_URL_KEY, $this->getMouseOverImageUrl($product));
        $result->setTemplate($this->transformTemplate($result->getTemplate()));

        return $result;
    }

    /**
     * @param Product $product
     *
     * @return string
     */
    private function getMouseOverImageUrl(Product $product)
    {
        if ($mouseOverImage = $product->getData(self::PRODUCT_IMAGE_KEY)) {
            return $this->imageHelper
                ->init($product, self::LISTING_IMAGE_ID)
                ->setImageFile($mouseOverImage)
                ->getUrl();
        }

        return '';
    }

    /**
     * @param string|null $currentTemplate
     *
     * @return string
     */
    private function transformTemplate($currentTemplate): string
    {
        return str_replace('Magento_Catalog::', 'Space48_MouseOverImage::', $currentTemplate);
    }
}
