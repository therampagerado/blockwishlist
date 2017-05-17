<?php
/**
 * 2007-2016 PrestaShop
 *
 * thirty bees is an extension to the PrestaShop e-commerce software developed by PrestaShop SA
 * Copyright (C) 2017 thirty bees
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License (AFL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/afl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@thirtybees.com so we can send you a copy immediately.
 *
 * @author    thirty bees <modules@thirtybees.com>
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2017 thirty bees
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 * PrestaShop is an internationally registered trademark & property of PrestaShop SA
 */

if (!defined('_TB_VERSION_')) {
    exit;
}

function upgrade_module_1_1_0($object)
{
    $object->registerHook('displayProductListFunctionalButtons');
    $object->registerHook('top');
    $listFields = Db::getInstance()->executeS('SHOW FIELDS FROM `'._DB_PREFIX_.'wishlist`');

    if (is_array($listFields)) {
        foreach ($listFields as $k => $field) {
            $listFields[$k] = $field['Field'];
        }
        if (!in_array('id_shop_group', $listFields)) {
            return (bool) Db::getInstance()->execute('ALTER TABLE `'._DB_PREFIX_.'wishlist` CHANGE `id_group_shop` `id_shop_group` INT( 11 ) NOT NULL DEFAULT "1"');
        }
    }

    return true;
}
