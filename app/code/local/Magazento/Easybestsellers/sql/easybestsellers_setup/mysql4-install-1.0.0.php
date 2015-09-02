<?php
/*
* Created on Dec 6, 2012
*  Author Ivan Proskuryakov - volgodark@gmail.com - Magazento.com
*  Copyright Proskuryakov Ivan. Magazento.com © 2012. All Rights Reserved.
*  Single Use, Limited Licence and Single Use No Resale Licence ["Single Use"]
*/
?>
<?php

$installer = $this;
$installer->startSetup();
$installer->run("


--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item')}` (
  `item_id` smallint(6) NOT NULL AUTO_INCREMENT,
  `count` tinyint(4) NOT NULL DEFAULT '5',
  `colcount` tinyint(4) NOT NULL DEFAULT '5',
  `order` varchar(25) NOT NULL,
  `layout` varchar(50) NOT NULL,
  `assign_categories` tinyint(4) NOT NULL DEFAULT '0',
  `assign_pages` tinyint(4) NOT NULL DEFAULT '0',
  `assign_products` tinyint(4) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `position` tinyint(10) NOT NULL DEFAULT '0',
  `from_time` datetime DEFAULT NULL,
  `to_time` datetime DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `content_top` text NOT NULL,
  `content_bottom` text NOT NULL,
  `bestseller_type` varchar(25) NOT NULL,
  `on_checkout` tinyint(1) NOT NULL,
  `css` text NOT NULL,
  `bestsellercategory` int(11) NOT NULL,
  `display_type` smallint(6) NOT NULL DEFAULT '1',
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;


INSERT INTO `{$this->getTable('magazento_easybestsellers_item')}` (`item_id`, `count`, `colcount`, `order`, `layout`, `assign_categories`, `assign_pages`, `assign_products`, `title`, `url`, `position`, `from_time`, `to_time`, `is_active`, `content_top`, `content_bottom`, `bestseller_type`, `on_checkout`, `css`, `bestsellercategory`, `display_type`) VALUES
(48, 4, 4, 'before', 'content', 0, 0, 0, 'BestSellers', '', 1, '2012-12-06 12:47:38', NULL, 1, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta vel sagittis ipsum ultrices. Vestibulum blandit odio at risus euismod adipiscing feugiat nunc suscipit. Proin id dui massa, eget rutrum quam. Pellentesque fringilla nulla ac sem dictum eget lobortis ante iaculis. Etiam aliquam molestie massa quis porta. Proin euismod ipsum sed augue ultrices viverra.</p>', 'bestseller', 1, '', 0, 1),
(49, 5, 5, 'after', 'content', 0, 0, 0, 'TopRated', '', 0, '2012-12-06 09:29:18', NULL, 1, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta vel sagittis ipsum ultrices. Vestibulum blandit odio at risus euismod adipiscing feugiat nunc suscipit. Proin id dui massa, eget rutrum quam. Pellentesque&nbsp;</p>', 'toprated', 1, '', 0, 1),
(50, 5, 5, 'before', 'left', 0, 0, 0, 'New Products', '', 1, '2012-12-06 09:29:18', NULL, 1, '', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta vel sagittis ipsum ultrices. Vestibulum blandit odio at risus euismod adipiscing feugiat nunc suscipit. Proin id dui massa, eget rutrum quam. Pellentesque fr</p>', 'new', 1, '', 0, 1),
(51, 5, 5, 'after', 'content', 0, 0, 0, 'Reviews', '', 1, '2012-12-06 09:29:18', NULL, 1, '', '<p>nsectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta vel sagittis ipsum ultrices. Vestibulum blandit odio at risus euismod adipiscing feugiat nunc suscipit. Proin id dui massa, eget rutrum quam. Pellentesque frnsectetur adipisc</p>', 'review', 1, '', 0, 1),
(52, 5, 5, 'after', 'right', 0, 0, 0, 'Popular', '', 20, '2012-12-06 09:29:18', NULL, 1, '', '<p>nsectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta vel sagittis ipsum ultrices. Vestibulum blandit odio at risus euismod adipiscing feugiat nunc suscipit. Proin id dui massa, eget rutrum quam. Pellentesque fr</p>', 'popular', 1, '', 0, 1),
(53, 3, 3, 'before', 'content', 0, 0, 0, 'New in category', '', 1, '2012-12-06 09:29:18', NULL, 1, '<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum facilisis nisi tempus purus porta blandit. Maecenas condimentum ante nec mi sodales suscipit. Cras pharetra ullamcorper libero in fringilla. Quisque convallis leo vitae dolor luctus et elementum neque tempor. In quis sollicitudin metus. Vivamus id massa a risus tincidunt congue vitae eu dui. In elementum leo purus, a iaculis libero. Suspendisse pharetra lorem vel lorem adipiscing pellentesque. Duis iaculis porta sem, a tristique erat imperdiet quis. Vivamus risus dui, consectetur quis tincidunt ut, venenatis eget leo. Curabitur at arcu velit, non tempus libero. Aenean sit amet risus at quam varius aliquam vel suscipit tellus. Curabitur lacus velit, blandit quis semper id, aliquet sit amet dolor.</em></p>', '<p><em>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum facilisis nisi tempus purus porta blandit. Maecenas condimentum ante nec mi sodales suscipit. Cras pharetra ullamcorper libero in fringilla. Quisque convallis leo vitae dolor luctus et elementum neque tempor. In quis sollicitudin metus. Vivamus id massa a risus tincidunt congue vitae eu dui. In elementum leo purus, a iaculis libero. Suspendisse pharetra lorem vel lorem adipiscing pellentesque. Duis iaculis porta sem, a tristique erat imperdiet quis. Vivamus risus dui, consectetur quis tincidunt ut, venenatis eget leo. Curabitur at arcu velit, non tempus libero. Aenean sit amet risus at quam varius aliquam vel suscipit tellus. Curabitur lacus velit, blandit quis semper id, aliquet sit amet dolor.</em></p>', 'new', 0, '', 0, 0),
(54, 4, 4, 'before', 'content', 0, 0, 0, 'Top Rated', '', 1, '2012-12-06 13:59:04', NULL, 1, '<p>Item: #54 content top:&nbsp;<span>met, consectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta</span></p>', '<p>Item: #54 content bottom:&nbsp;<span>met, consectetur adipiscing elit. Integer euismod purus quis tellus pulvinar non tempor nisi scelerisque. Nunc vitae ligula ligula. Curabitur tincidunt arcu sed erat porta</span></p>', 'toprated', 0, '', 0, 1);

-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_assignedproduct')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `assignedproduct_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `{$this->getTable('magazento_easybestsellers_item_assignedproduct')}` (`item_id`, `assignedproduct_id`) VALUES
(50, 162),
(50, 163),
(50, 164),
(50, 165),
(50, 166),
(49, 158),
(49, 160),
(49, 162),
(49, 163),
(49, 164),
(49, 165),
(49, 166),
(52, 161),
(52, 162),
(52, 163),
(52, 164),
(52, 165),
(52, 166),
(48, 16),
(48, 17),
(54, 16),
(54, 17),
(54, 18),
(54, 19),
(54, 20),
(54, 25),
(54, 26),
(54, 27),
(54, 28);

-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_category')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `category_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `{$this->getTable('magazento_easybestsellers_item_category')}` (`item_id`, `category_id`) VALUES
(53, 10),
(53, 13),
(53, 18);

-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_page')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `page_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--

INSERT INTO `{$this->getTable('magazento_easybestsellers_item_page')}` (`item_id`, `page_id`) VALUES
(49, 3),
(50, 3),
(51, 3),
(52, 3),
(48, 2),
(48, 3),
(48, 5),
(54, 2);

-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_product')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `product_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_review')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `review_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `{$this->getTable('magazento_easybestsellers_item_review')}` (`item_id`, `review_id`) VALUES
(NULL, NULL);

-- --------------------------------------------------------

--
--

CREATE TABLE IF NOT EXISTS `{$this->getTable('magazento_easybestsellers_item_store')}` (
  `item_id` smallint(6) unsigned DEFAULT NULL,
  `store_id` smallint(6) unsigned DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `{$this->getTable('magazento_easybestsellers_item_store')}` (`item_id`, `store_id`) VALUES
(49, 0),
(50, 0),
(51, 0),
(52, 0),
(53, 0),
(48, 0),
(54, 0);



");

$installer->endSetup();
?>