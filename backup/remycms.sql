-- phpMyAdmin SQL Dump
-- version 3.5.0
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Авг 02 2015 г., 11:31
-- Версия сервера: 5.1.62-community
-- Версия PHP: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `remycms`
--

-- --------------------------------------------------------

--
-- Структура таблицы `web_albums`
--

CREATE TABLE IF NOT EXISTS `web_albums` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pic_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `web_items`
--

CREATE TABLE IF NOT EXISTS `web_items` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_cat` int(6) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `old_price` float NOT NULL,
  `weight` float NOT NULL,
  `annotation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `pic_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `active` int(1) NOT NULL,
  `props` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new` int(1) NOT NULL,
  `favorite` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `props` (`props`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `web_items`
--

INSERT INTO `web_items` (`id`, `url`, `id_cat`, `title`, `price`, `old_price`, `weight`, `annotation`, `description`, `pic_url`, `active`, `props`, `new`, `favorite`) VALUES
(5, 'biryuzovyi_komplekt', 1, 'Бирюзовый комплект нижнего белья ', 3500, 5000, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '187448_684310.jpg', 1, '1001_1009 1000_1000', 0, 1),
(6, 'rozovyi_komplekt', 1, 'Розовый комплект нижнего белья', 3500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '559527_529338.jpg', 1, '1001_1009 1000_1000', 0, 0),
(7, 'tsvetnoy_komplekt', 1, 'Цветной комплект нижнего белья', 3500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '663373_bIMG_5668.jpg', 1, '1001_1008 1000_1000', 0, 0),
(8, 'sirenevyi_komplekt', 1, 'Сиреневый комплект нижнего белья', 3500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '982221_large_komplekt-nizhnego-belya-ot-victorias-secret-84918.jpg', 1, '1001_1009 1000_1000', 0, 0),
(9, 'cherno_rozovyi_komplekt', 1, 'Черно-розовый комплект нижнего белья ', 3500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '590129_photo-U17194-P1121841-T1409166917-N1323094.jpeg', 1, '1001_1008 1000_1000', 0, 1),
(10, 'chernyi_komplekt', 1, 'Черный комплект нижнего белья', 3500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '200618_w600+h800+m2+komplekt_niznego_belia_13_enl.jpg', 1, '1001_1009 1000_1000', 0, 0),
(11, 'chernyj-byustgalter', 2, 'Черный бюстгалтер', 1000, 0, 0.3, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '796559_097.jpg', 1, '1001_1009 1000_1005', 0, 0),
(12, 'biryuzovyj-byustgalter', 2, 'Бирюзовый бюстгальтер', 1000, 0, 0.3, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '856655_306781-pic1.jpg', 1, '1001_1009 1000_1001', 1, 1),
(14, 'belyj-byustgalter', 2, 'Белый бюстгальтер', 1000, 0, 0.3, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '321200_foto_setru_ru-29-4315683.jpg', 1, '1001_1009 1000_1001', 0, 1),
(15, 'pushap-byustgalter', 2, 'Пушап бюстгальтер', 3500, 0, 0.3, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '646801_liemenele_gilioms_iskirptems_16334_22535.jpg', 1, '1001_1009 1000_1001', 0, 0),
(16, 'zhenskie-trusiki-001', 3, 'Женские трусики', 500, 0, 0.1, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '907643_tr1685z.jpg', 1, '1000_1003 1001_1009', 0, 1),
(17, 'zhenskie-trusiki-002', 3, 'Женские трусики', 500, 0, 0.1, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '311147_zhenskoe-belyo.jpg', 1, '1000_1003 1001_1009', 0, 0),
(18, 'zhenskie-trusiki-003', 3, 'Женские трусики', 500, 0, 0.1, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '655166_innamore-32002.jpg', 1, '1000_1003 1001_1009', 0, 0),
(19, 'zhenskie-trusiki-005', 3, 'Женские трусики', 500, 0, 0.1, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '271417_776463-1.jpg', 1, '1000_1003 1001_1009', 0, 0),
(20, 'kupalnik-001', 4, 'Купальник', 4500, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '123817_VS-plavky-2009-Alessandra-Ambrosio_h29.jpg', 1, '1000_1007 1001_1008', 1, 0),
(21, 'kupalnik-002', 4, 'Купальник черный', 4000, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '787138_Jolidon.jpg', 1, '1000_1007 1001_1008', 1, 1),
(22, 'kupalnik-003', 4, 'Купальник вязанный', 4000, 0, 0.5, 'This cute red and white polka dotted bikini features a banded halter top and matching bottom with tie sides.', '', '801169_0 (1).jpg', 1, '1000_1007 1001_1008', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_categories`
--

CREATE TABLE IF NOT EXISTS `web_items_categories` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `picture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(5) NOT NULL,
  `is_parent` int(1) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `web_items_categories`
--

INSERT INTO `web_items_categories` (`id`, `title`, `url`, `description`, `picture`, `parent`, `is_parent`, `active`) VALUES
(1, 'Комплекты', 'komplekty', '', '', 0, 0, 1),
(2, 'Бюстгальтеры', 'byustgaltery', '', '', 0, 0, 1),
(3, 'Трусики', 'trusiki', '', '', 0, 0, 1),
(4, 'Купальники', 'kupalniki', '', '', 0, 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_cat_props`
--

CREATE TABLE IF NOT EXISTS `web_items_cat_props` (
  `id_cat` int(6) NOT NULL,
  `pid` int(6) NOT NULL,
  KEY `id_cat` (`id_cat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `web_items_cat_props`
--

INSERT INTO `web_items_cat_props` (`id_cat`, `pid`) VALUES
(2, 1001),
(2, 1000),
(3, 1000),
(4, 1000),
(1, 1001),
(1, 1000),
(3, 1001),
(4, 1001),
(1, 1008);

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_cat_skus`
--

CREATE TABLE IF NOT EXISTS `web_items_cat_skus` (
  `id_cat` int(6) NOT NULL,
  `sid` int(6) NOT NULL,
  PRIMARY KEY (`id_cat`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_images`
--

CREATE TABLE IF NOT EXISTS `web_items_images` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_item` int(11) NOT NULL,
  `pic_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_prop_names`
--

CREATE TABLE IF NOT EXISTS `web_items_prop_names` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1009 ;

--
-- Дамп данных таблицы `web_items_prop_names`
--

INSERT INTO `web_items_prop_names` (`id`, `name`, `sort`) VALUES
(1000, 'Страна производитель', 2),
(1001, 'Марка', 1),
(1008, 'Материал', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_prop_values`
--

CREATE TABLE IF NOT EXISTS `web_items_prop_values` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `pid` int(6) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1015 ;

--
-- Дамп данных таблицы `web_items_prop_values`
--

INSERT INTO `web_items_prop_values` (`id`, `pid`, `name`, `sort`) VALUES
(1000, 1000, 'Россия', 1),
(1001, 1000, 'Китай', 2),
(1002, 1000, 'Италия', 3),
(1003, 1000, 'Испания', 4),
(1004, 1000, 'Австрия', 5),
(1005, 1000, 'Турция', 6),
(1006, 1000, 'Швейцария', 7),
(1007, 1000, 'Ю.Корея', 8),
(1008, 1001, 'Орхидея', 3),
(1009, 1001, 'Виктория', 4),
(1010, 1008, 'Хлопок', 0),
(1011, 1008, 'Синтетика', 0),
(1012, 1008, 'Шерсть', 0),
(1013, 1008, 'Шелк', 0),
(1014, 1008, 'Металл', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_skus`
--

CREATE TABLE IF NOT EXISTS `web_items_skus` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `id_item` int(6) NOT NULL,
  `articul` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` float NOT NULL,
  `old_price` float NOT NULL,
  `weight` float NOT NULL,
  `quantity` int(6) NOT NULL,
  `pic_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `skus` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `skus` (`skus`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Дамп данных таблицы `web_items_skus`
--

INSERT INTO `web_items_skus` (`id`, `id_item`, `articul`, `price`, `old_price`, `weight`, `quantity`, `pic_url`, `skus`) VALUES
(2, 11, '8753345', 1000, 0, 0.3, 100, '', ''),
(3, 12, '5645682', 1000, 0, 0.3, 100, '', ''),
(4, 13, '2356789', 1000, 0, 0.3, 100, '', ''),
(5, 14, '4378789', 1000, 0, 0.3, 100, '', ''),
(6, 15, '9765534', 3500, 0, 0.3, 100, '', ''),
(7, 15, '2346032', 3500, 0, 0.3, 100, '', ''),
(8, 15, '2230912', 3500, 0, 0.3, 100, '', ''),
(9, 6, '5102846', 3500, 0, 0.5, 100, '', ''),
(10, 7, '657438', 3500, 0, 0.5, 100, '', ''),
(11, 8, '544322', 3500, 0, 0.5, 100, '', ''),
(12, 9, '2222444', 3500, 0, 0.5, 100, '', ''),
(13, 10, '5578999', 3500, 0, 0.5, 100, '', ''),
(14, 16, '87764444', 500, 0, 0.1, 100, '', ''),
(15, 17, '44466677', 500, 0, 0.1, 100, '', ''),
(16, 18, '77766000', 500, 0, 0.1, 100, '', ''),
(17, 19, '43434344', 500, 0, 0.1, 100, '', ''),
(18, 20, '5554545', 4500, 0, 0.5, 100, '', ''),
(19, 21, '5656576', 4000, 0, 0.5, 100, '', ''),
(20, 22, '8787878', 4000, 0, 0.5, 100, '', ''),
(21, 5, '1111121', 3500, 5000, 0.5, 100, '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_sku_names`
--

CREATE TABLE IF NOT EXISTS `web_items_sku_names` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1000 ;

-- --------------------------------------------------------

--
-- Структура таблицы `web_items_sku_values`
--

CREATE TABLE IF NOT EXISTS `web_items_sku_values` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `sid` int(6) NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(3) NOT NULL,
  `pic_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1000 ;

-- --------------------------------------------------------

--
-- Структура таблицы `web_modules`
--

CREATE TABLE IF NOT EXISTS `web_modules` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `system` int(1) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `web_modules`
--

INSERT INTO `web_modules` (`id`, `name`, `title`, `version`, `desc`, `author`, `system`, `active`) VALUES
(1, 'news', 'Новостной модуль', '0.1', 'Вставьте //news// если это Контент.', 'Remy Weinstein', 1, 1),
(2, 'gallery', 'Модуль Галерея', '0.1', 'Вставьте //gallery// если это Контент.', 'Remy Weinstein', 1, 1),
(3, 'menus', 'Модуль Меню', '1.0', 'Вывод меню, по умолчанию выводит заголовки родителя', 'Remy Weinstein', 1, 1),
(4, 'catalog', 'Каталог', '0.1', 'Модуль Каталога', 'Remy Weinstein', 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `web_pages`
--

CREATE TABLE IF NOT EXISTS `web_pages` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(5) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `author` int(5) NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `view_menu` int(1) NOT NULL DEFAULT '0',
  `status` int(1) NOT NULL,
  `is_parent` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `web_pages`
--

INSERT INTO `web_pages` (`id`, `title`, `url`, `content`, `parent`, `date`, `author`, `template`, `view_menu`, `status`, `is_parent`) VALUES
(1, 'Lingerine Shop', 'index', '', 0, '2014-09-30 00:00:00', 1, 'default', 0, 1, 0),
(2, 'О нас', 'about', 'о нас', 0, '2015-06-29 09:52:51', 1, 'default', 1, 0, 0),
(3, 'Оплата', 'payment', '          ', 0, '2015-06-29 09:53:08', 1, 'default', 1, 0, 0),
(4, 'Доставка', 'delivery', '          ', 0, '2015-06-29 09:53:24', 1, 'default', 1, 0, 0),
(5, 'Контакты', 'contacts', '   <div class="title"><span>Контакты</span></div>\r\n      <div class="product_box">\r\n        <div id="contact_form">\r\n          <label class="contact_form">Имя:</label>\r\n          <input type="text" name="user" class="contact_input" />\r\n          <div class="cleardiv"></div>\r\n          <label class="contact_form">Email:</label>\r\n          <input type="text" name="payuity"  class="contact_input" />\r\n          <div class="cleardiv"></div>\r\n          <label class="contact_form">Сообщение:</label>\r\n          <textarea name="text" cols="" rows="" class="contact_textarea"></textarea>\r\n          <div class="cleardiv"></div><br><br>\r\n          <div class="button"><a href="#" onClick="submit();">Отправить</a></div>\r\n        </div>\r\n      </div>', 0, '2015-06-29 09:53:42', 1, 'default', 1, 0, 0),
(6, 'Условия доставки', 'terms-delivery', '          ', 0, '2015-06-29 09:54:03', 1, 'default', 1, 0, 0),
(7, 'Условия и правила', 'terms', '          ', 0, '2015-06-29 09:54:24', 1, 'default', 1, 0, 0),
(8, 'Политика безопасности', 'privacy', '          ', 0, '2015-06-29 09:54:46', 1, 'default', 1, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `web_pictures`
--

CREATE TABLE IF NOT EXISTS `web_pictures` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `album` int(5) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `pic_url` varchar(37) COLLATE utf8_unicode_ci NOT NULL,
  `author` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `web_settings`
--

CREATE TABLE IF NOT EXISTS `web_settings` (
  `id` int(2) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lenght` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `web_settings`
--

INSERT INTO `web_settings` (`id`, `title`, `name`, `value`, `category`, `lenght`) VALUES
(1, 'Название сайта', 'main_name', 'Lingerine Shop', 'base', 20),
(2, 'Meta Title', 'var_meta_title', 'Lingerine Shop', 'base', 30),
(3, 'Meta Keys (по умолчанию)', 'var_meta_keys', '', 'base', 30),
(4, 'Meta Desc (по умолчанию)', 'var_meta_desc', '', 'base', 30),
(5, 'Включить регистрацию', 'disable_registration', '1', 'security', 1),
(6, 'Ширина иконок в галерее', 'res_thumb_width_gallery', '140', 'gallery', 3),
(7, 'Высота иконок в галерее', 'res_thumb_height_gallery', '140', 'gallery', 3),
(8, 'Максимальный размер картинки', 'max_size_content_image', '1048576', 'gallery', 7),
(9, 'Шаблон по умолчанию', 'default_template', 'default', 'system', 6),
(10, 'Почта no-reply', 'noreply_email', 'your@mail.box', 'system', 12),
(11, 'Почта поддержки', 'support_email', 'your@mail.box', 'system', 12),
(12, 'Ширина блока иконки', 'block_thumb_width_gallery', '140', 'gallery', 3),
(13, 'Высота блока иконки', 'block_thumb_height_gallery', '140', 'gallery', 3),
(14, 'Сервер IMAP(SSL)', 'mail_imap_server', 'imap.mail.ru', 'mail', 12),
(15, 'Порт IMAP сервера', 'mail_imap_server_port', '993', 'mail', 3),
(16, 'Почтовый ящик', 'mail_address_mail', 'your@mail.box', 'mail', 12),
(17, 'Пароль почтового ящика', 'mail_address_mail_pass', 'your_pass', 'mail', 12),
(18, 'Адрес Веб Интерфейса', 'mail_web_address', 'https://mail.webinterface/', 'mail', 12),
(19, 'Показывать админ панель', 'view_admin_panel', '1', 'system', 2),
(20, 'Адрес хоста', 'main_host', 'http://remy-cms.com/', 'base', 20),
(21, 'Страница не найдена', 'error_page', '404', 'system', 5),
(22, 'Папка с картинками', 'directory_pictures', 'uploads', 'gallery', 16);

-- --------------------------------------------------------

--
-- Структура таблицы `web_templates`
--

CREATE TABLE IF NOT EXISTS `web_templates` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `web_templates`
--

INSERT INTO `web_templates` (`id`, `name`, `title`, `version`, `desc`, `author`) VALUES
(2, 'default', 'Основной шаблон', '1.0', 'Основной шаблон Remy CMS', 'Remy CMS');

-- --------------------------------------------------------

--
-- Структура таблицы `web_users`
--

CREATE TABLE IF NOT EXISTS `web_users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL DEFAULT '0',
  `date_reg` date NOT NULL,
  `date_last` datetime NOT NULL,
  `status` int(1) NOT NULL,
  `picture` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `new` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `password` (`password`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `web_users`
--

INSERT INTO `web_users` (`id`, `email`, `login`, `password`, `name`, `role`, `date_reg`, `date_last`, `status`, `picture`, `new`) VALUES
(1, 'admin@remy-cms.com', 'admin', '$2y$11$299f9e0b9e4e123d15502ucUvgG5vB2W2VjB2o8J62TRzR1wcFYaO', 'Админ', 5, '2014-11-25', '2014-12-31 04:43:00', 3, '', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `web_users_roles`
--

CREATE TABLE IF NOT EXISTS `web_users_roles` (
  `id` int(1) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `web_users_roles`
--

INSERT INTO `web_users_roles` (`id`, `name`) VALUES
(5, 'Администратор');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
