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

namespace Space48\MouseOverImage\Setup;

use Magento\Catalog\Model\Product;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{

    /**
     * @var EavSetupFactory
     */
    private $eavSetupFactory;

    /**
     * InstallData constructor.
     */
    public function __construct(
        EavSetupFactory $eavSetupFactory
    )
    {
        $this->eavSetupFactory = $eavSetupFactory;
    }

    /**
     * Installs data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface   $context
     *
     * @return void
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        /** @var \Magento\Eav\Setup\EavSetup $eavSetup */
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);

        $eavSetup->addAttribute(
            Product::ENTITY,
            'mouseover_image',
            [
                'type'                    => 'varchar',
                'label'                   => 'Mouseover',
                'input'                   => 'media_image',
                'frontend'                => 'Magento\Catalog\Model\Product\Attribute\Frontend\Image',
                'required'                => false,
                'global'                  => ScopedAttributeInterface::SCOPE_STORE,
                'used_in_product_listing' => true,
            ]);
    }


}