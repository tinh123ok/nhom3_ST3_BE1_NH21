-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 21, 2021 lúc 03:55 AM
-- Phiên bản máy phục vụ: 10.4.22-MariaDB
-- Phiên bản PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `nhom3`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `adminname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`admin_id`, `adminname`, `password`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70'),
(3, 'admin1', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bill`
--

CREATE TABLE `bill` (
  `bill_id` int(11) NOT NULL,
  `Barcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ordernotes` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `bill`
--

INSERT INTO `bill` (`bill_id`, `Barcode`, `fullname`, `username`, `address`, `phone`, `ordernotes`) VALUES
(22, '8447', 'banhom', 'nhom3', 'pg-bd-Việt Nam-(80000)', '98765432', 'goi khi giiao');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailsbill`
--

CREATE TABLE `detailsbill` (
  `bill_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantily` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `detailsbill`
--

INSERT INTO `detailsbill` (`bill_id`, `product_id`, `quantily`) VALUES
(22, 3, 1),
(22, 8, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `manufactures`
--

CREATE TABLE `manufactures` (
  `manu_id` int(11) NOT NULL,
  `manu_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `manufactures`
--

INSERT INTO `manufactures` (`manu_id`, `manu_name`) VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Dell'),
(4, 'Acer'),
(5, 'Logitech'),
(6, 'Akko'),
(7, 'Xiaomi'),
(8, 'Razer'),
(12, 'nhomba');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `manu_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `feature` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`ID`, `Name`, `manu_id`, `type_id`, `price`, `image`, `description`, `feature`, `created_at`) VALUES
(1, 'Acer Nitro 5 Gaming AN515 57 54AF', 4, 2, 27990000, 'acer-nitro-5-an515-57-54af-i5-11400h-16gb-512gb-600x600.jpg', 'Máy tính xách tay Acer Nitro 5 được trang bị bộ vi xử lý Intel Core i5 với 6 nhân 12 luồng mang đến tốc độ cơ bản 2.70 GHz và đạt tối đa lên đến 4.5 GHz nhờ Turbo Boost, mang đến hiệu suất công việc đáng kinh ngạc, cho bạn thoải mái xử lý các tác vụ văn phòng cùng bộ ứng dụng nhà Microsoft Office, đồng thời cho bạn tận hưởng các trận chiến game một cách mượt mà và thỏa mãn nhất.', 0, '2021-10-18 02:23:23'),
(2, 'Dell XPS 13 9310 i7 1165G7 (JGNH62)', 3, 2, 59490000, 'dell-xps-13-9310-i7-jgnh62-600x600.jpg', 'Laptop Dell XPS 13 9310 i7 1165G7 (JGNH62), sự kết hợp hoàn mỹ giữa hiệu năng, khả năng phản hồi cùng hình ảnh ảnh sắc nét cho một dòng máy tính xách tay thời trang đầy sang trọng.', 1, '2021-08-08 12:23:23'),
(3, 'iPhone 12 64GB', 1, 1, 20490000, 'iphone-12-xanh-duong-new-2-600x600.jpg', 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 12 64GB.', 1, '2020-01-17 20:23:23'),
(4, 'Samsung Galaxy Z Fold3 5G 512GB', 2, 1, 43990000, 'samsung-galaxy-z-fold-3-green-1-600x600.jpg', 'Galaxy Z Fold3 5G đánh dấu bước tiến mới của Samsung trong phân khúc điện thoại gập cao cấp khi được cải tiến về độ bền cùng những nâng cấp đáng giá về cấu hình hiệu năng, hứa hẹn sẽ mang đến trải nghiệm sử dụng đột phá cho người dùng.', 1, '2021-03-08 12:23:00'),
(5, 'Samsung Galaxy S20 FE (8GB/256GB)', 2, 1, 12900000, 'samsung-galaxy-s20-fan-edition-090320-040338-600x600.jpg', 'Samsung đã giới thiệu đến người dùng thành viên mới của dòng điện thoại thông minh S20 Series đó chính là Samsung Galaxy S20 FE. Đây là mẫu flagship cao cấp quy tụ nhiều tính năng mà Samfan yêu thích, hứa hẹn sẽ mang lại trải nghiệm cao cấp của dòng Galaxy S với mức giá dễ tiếp cận hơn', 0, '2021-06-27 20:23:23'),
(6, 'Samsung Galaxy S20 FE (8GB/256GB)', 2, 1, 12900000, 'samsung-galaxy-s20-fan-edition-090320-040338-600x600.jpg', 'Samsung đã giới thiệu đến người dùng thành viên mới của dòng điện thoại thông minh S20 Series đó chính là Samsung Galaxy S20 FE. Đây là mẫu flagship cao cấp quy tụ nhiều tính năng mà Samfan yêu thích, hứa hẹn sẽ mang lại trải nghiệm cao cấp của dòng Galaxy S với mức giá dễ tiếp cận hơn', 0, '2021-06-27 20:23:23'),
(7, 'Bàn phím Apple Magic Keyboard 2 ', 1, 3, 2850000, 'keyboard-macbook-gen-2.jpg', 'Bàn phím Apple Magic Keyboard 2 – Thiết kế nhỏ gọn, cảm giác gõ êm ái\r\nNếu bạn là một người hay soạn thảo bằng trên iPad và gặp vấn đề khó khăn khi gõ chữ thì bàn phím bluetooth Apple Magic Keyboard 2 chính là sản phẩm không thể thiếu. Phụ kiện Apple Magic Keyboard 2 sở hữu một thiết kế nhỏ gọn, tinh tế với phím bấm êm ái, hứa hẹn sẽ đáp ứng tốt nhu cầu của mọi người dùng.', 0, '2020-10-22 12:23:23'),
(8, 'Bàn phím Smart Keyboard iPad Pro 11 2020', 1, 3, 4850000, 'mu8g2ll_2.jpg', 'Bàn phím Smart Keyboard iPad Pro 11 2020 – Hỗ trợ công việc văn phòng chuyên nghiệp\r\nChắc hẳn bạn cũng đã biết, chiếc iPad Pro 11 2020 mới vừa được ra mắt cũng sở hữu khả năng biến thành một chiếc laptop nhờ vào hỗ trợ bàn phím rời. Do đó, để công việc của bạn được hoàn thành nhanh chóng hãy sở hữu ngay bàn phím không dây bluetooth Smart Keyboard iPad Pro 11 2020.\r\n\r\nChất lượng cao cấp: độ nảy cao, hành trình phím vừa đủ, tích hợp nhiều phím tắt\r\nMặc dù bàn phím Smart Keyboard iPad Pro 11 2020 mang vẻ ngoài khá mỏng và gọn nhưng nó vẫn được tích hợp đầy đủ phím và những phím tắt quan trọng. Bao gồm: khả năng chuyển đổi nhanh giữa các ứng dụng, sao chép nhanh cả một văn bản,…', 1, '2021-02-08 12:23:23'),
(9, 'Apple Magic Keyboard 2 ', 1, 3, 2850000, 'keyboard-macbook-gen-2.jpg', 'Bàn phím Apple Magic Keyboard 2 – Thiết kế nhỏ gọn, cảm giác gõ êm ái\r\nNếu bạn là một người hay soạn thảo bằng trên iPad và gặp vấn đề khó khăn khi gõ chữ thì bàn phím bluetooth Apple Magic Keyboard 2 chính là sản phẩm không thể thiếu. Phụ kiện Apple Magic Keyboard 2 sở hữu một thiết kế nhỏ gọn, tinh tế với phím bấm êm ái, hứa hẹn sẽ đáp ứng tốt nhu cầu của mọi người dùng.', 0, '2020-10-22 12:23:23'),
(10, 'Smart Keyboard iPad Pro 11 2020', 1, 3, 4850000, 'mu8g2ll_2.jpg', 'Bàn phím Smart Keyboard iPad Pro 11 2020 – Hỗ trợ công việc văn phòng chuyên nghiệp\r\nChắc hẳn bạn cũng đã biết, chiếc iPad Pro 11 2020 mới vừa được ra mắt cũng sở hữu khả năng biến thành một chiếc laptop nhờ vào hỗ trợ bàn phím rời. Do đó, để công việc của bạn được hoàn thành nhanh chóng hãy sở hữu ngay bàn phím không dây bluetooth Smart Keyboard iPad Pro 11 2020.\r\n\r\nChất lượng cao cấp: độ nảy cao, hành trình phím vừa đủ, tích hợp nhiều phím tắt\r\nMặc dù bàn phím Smart Keyboard iPad Pro 11 2020 mang vẻ ngoài khá mỏng và gọn nhưng nó vẫn được tích hợp đầy đủ phím và những phím tắt quan trọng. Bao gồm: khả năng chuyển đổi nhanh giữa các ứng dụng, sao chép nhanh cả một văn bản,…', 1, '2021-02-08 12:23:23'),
(11, 'Apple Magic Mouse 2', 1, 4, 1900000, 'chuot-apple-magic-mouse-2.jpg', 'Chuột Apple Magic Mouse 2: Tối giản, liền mạch, thanh lịch và bền bỉ\r\nTrong các thao tác công việc hằng ngày, đặc biệt là khi làm việc trên laptop hay trên chiếc máy iMac, thì chiếc chuột máy tính không dây Apple Magic Mouse 2 là một điều cần thiết để các thao tác được nhanh nhẹn hơn và linh hoạt hơn.\r\n\r\nThiết kế bằng kim lại kết hợp nhựa cao cấp cùng khả năng kết nối không dây\r\nApple Magic Mouse 2 mang trong mình một thiết kế bằng kim loại phần khung và thân chuột, giúp chúng có một độ sang trọng và cao cấp nhất định. Cùng với đó, phần thao tác bằng nhựa cao cấp, bền bỉ ở bên trên giúp cho bạn có thể có được những thao tác gọn nhẹ, linh hoạt và thoải mái nhất có thể. Thiết kế này của chuột Magic Mouse 2 giúp đồng bộ và hài hoà khi bạn sử dụng với thiết bị Apple.', 0, '2021-10-22 12:33:05'),
(12, 'Mouse Gaming Logitech G502 Hero KDA ', 5, 4, 1900000, 'image_1024.jpg', 'G502 HERO K/DA - Vẻ đẹp cùng sự vượt trội trong dòng chuột gaming\r\nG502 HERO K/DA là một trong những dòng chuột gaming mới nhất đến từ Logitech. Được trang bị đến 11 nút có thể tùy chỉnh giúp bạn dễ dàng chỉ định các lệnh cá nhân, cùng cảm biến quang học tiên tiến cho độ chính xác theo dõi tối đa, tính năng chiếu sáng RGB có thể tùy chỉnh, cảm biến trò chơi từ 200 cho tới 25.600 DPI.', 1, '2021-07-05 23:33:05'),
(13, 'Keyboard Logitech G913 TKL WIRELESS RGB', 5, 3, 4850000, 'g913-tkl-wireless_d797df2d3e01485ab3baad39a1040cd3.png', 'Kích thước 368 x 150 x 22 ( mm ) ( Dài x Rộng x Cao ) Trọng lượng 810g Chiều dài dây cáp 1.8 Loại Switch GL Switch Pin 40 giờ đồng hồ liên tục ( 100% độ sáng cao nhất ) Kết nối Bluetooth/ LightSpeed/ Có dây Đèn LED hiển thị Lightsync RGB 16.7 triệu màu Cụm phím media Có\r\nThiết kế đột phá ,hiện đại\r\nĐược chế tạo tỉ mỉ từ các vật liệu cao cấp, G913 TKL có thiết kế tinh xảo với vẻ đẹp, sức mạnh và hiệu suất vô song. G913 TKL có các công nghệ tiên tiến tương tự như G915 ,nhưng nhỏ gọn hơn, phù hợp với những người có bàn làm việc nhỏ ,phải di chuyển nhiều hay đơn giản là chỉ thích sự nhỏ gọn.Thiết kế cực kỳ mỏng nhưng có độ bền cao cùng với sự thoải mái ,G913 TKL luôn sẵn sàng cho những màn chơi game cường độ cao, G913 TKL thực sự là thế hệ bàn phím cơ chơi game của tương lai.', 0, '2021-03-18 04:33:05'),
(14, 'AKKO 3108 Silent (Akko Switch v2)\r\n', 6, 3, 1599000, '3108-Silent-768x768.png', 'Thiết kế bắt mắt ưa nhìn\r\nVới nhiều kiểu dáng đẹp mắt cùng bộ keycaps cực “thời trang”. Mẫu bàn phím Akko 3108 Silent mang đến một tông màu nhẹ nhàng nhưng có phần thu hút nổi bật.\r\n\r\n', 1, '2021-11-17 12:33:05'),
(15, 'Keyboard  AKKO 3087 World Tour – Tokyo Akko Switch', 6, 3, 1299000, '10163-768x768.jpg', 'Đánh giá chi tiết bàn phím cơ AKKO 3087 v2 World Tour Tokyo (Akko switch v2)\r\nBàn phím cơ AKKO 3087 v2 World Tour Tokyo (Akko switch v2) thuộc dòng World Tour Tokyo của Akko. Sở hữu vẻ đẹp thanh tạo, đơn giản nhưng ấn tượng, sản phẩm này đang ngày càng được yêu thích trên thị trường.', 0, '2021-05-29 12:33:05'),
(16, 'Smart phone Xiaomi Mi 11 5G', 7, 1, 1600000, 'xiaomi-mi-11-xanhduong-1-org.jpg', 'Xiaomi Mi 11 một siêu phẩm đến từ Xiaomi, máy cho trải nghiệm hiệu năng hàng đầu với vi xử lý Qualcomm Snapdragon 888, cùng loạt công nghệ đỉnh cao, khiến bất kỳ ai cũng sẽ choáng ngợp về smartphone này.', 1, '2021-10-22 12:33:05'),
(17, 'Headphone Logitech G431', 5, 5, 1390000, 'tai-nghe-logitech-g431-1_93d140ec10f7491b9e814d3329159945.jpg', 'Âm thanh to rõ ràng\r\nMic lớn được tăng cường 6 mm đảm bảo đồng đội có thể nghe thấy bạn. Cần mic có thể gấp gọn lại để tắt tiếng khi bạn không muốn giọng mình được nghe thấy.\r\n\r\n\r\n\r\nCông nghệ DTS HEADPHONE:X 2.0\r\n\r\nÂm thanh vòm DTS Headphone:X 2.0 thế hệ mới, sử dụng phần mềm G HUB của Logitech, cho phép bạn nghe thấy kẻ thù đang ẩn nấp phía sau, các tín hiệu khả năng đặc biệt và môi trường đắm chìm - tất cả xung quanh bạn. Trải nghiệm âm thanh 3D vượt xa các kênh 7.1 để khiến bạn cảm thấy như đang thực hiện hành động.\r\n\r\n\r\n\r\nKhả năng kết nối đa dạng\r\n\r\nTai nghe hoạt động với máy tính, PlayStation 4, hoặc Nintendo Switch gắn đế thông qua USB DAC. Bạn cũng có thể chơi trên máy chơi game hoặc thiết bị di động thông qua dây 3,5 mm.\r\n\r\n\r\n\r\nĐược thiết kế cho sự thoải mái và bền bỉ\r\n\r\nMọi thứ liên quan đến chiếc tai nghe này đều tạo ra sự thoải mái. Chụp tai và quai đeo giả da có trọng lượng nhẹ cao cấp được thiết kế để giúp đôi tai bạn không bị áp lực. Chụp tai xoay ngược lên 90 độ tạo ra sự thuận tiện. Điều chỉnh âm lượng trên mọi nền tảng với nút xoay âm lượng gắn trên chụp tai.', 1, '2021-06-23 02:32:05'),
(18, 'Headphone Logitech G733 LIGHTSPEED Wireless Black', 5, 5, 2990000, 'gearvn-tai-nghe-logitech-g733-lightspeed-wireless-black-666_2eb1a71d562e4a6d853a0f086723cbe3.png', 'Đánh giá chi tiết tai nghe gaming không dây Logitech G733 LIGHTSPEED Wireless Black\r\nTai nghe không dây gaming Logitech G733 LIGHTSPEED Wireless Black được thiết kế mang đến sự thoải mái cho game thủ. Đây là mẫu tai nghe không dây được trang bị âm thanh lập thể, các bộ lọc âm thanh và tính năng chiếu sáng tiên tiến bạn cần để nhìn, nói và chơi phong cách hơn bao giờ hết.\r\n\r\n\r\n\r\nThiết kế bắt mắt, trọng lượng siêu nhẹ\r\nĐược thiết kế với hình dáng một chiếc tai nghe Over-ear với trọng lượng chỉ 278 gram, nặng hơn nửa pound (250g) một chút. Nó rất nhẹ và dây co dãn được thiết kế để làm giảm và phân phối trọng lượng.\r\n\r\nLogitech G733 LIGHTSPEED Wireless Black với bộ đệm tai được làm từ cao su non hai lớp nhẹ nhàng ôm lấy đầu bạn và lượn vòng quanh khuôn mặt bạn. Nó làm giảm các điểm áp lực và đem lại sự thoải mái dài lâu. Dây đeo quanh đầu co dãn mềm mại và có thể điều chỉnh khiến cho vừa vặn nhất với bạn.\r\n\r\n\r\n\r\nTrang bị công nghệ Lightspeed\r\nCông nghệ LIGHTSPEED không dây đem đến cho bạn thời gian sử dụng pin trên 29 giờ và sự tự do không dây đáng tin cậy lên tới 20 mét. Chơi mà không bị rối dây. Mở ra khả năng và đắm chìm vào trò chơi, âm nhạc, phim ảnh.\r\n\r\n\r\n\r\nNgoài ra Logitech G733 LIGHTSPEED Wireless Black còn có bộ phụ kiện dây băng đô, vỏ bọc mic,... nhiều màu sắc để bạn có thể thay đổi ngoại hình chiếc tai nghe của mình. Lưu ý là trong hộp sản phẩm mới chỉ có sẵn 1 bộ phụ kiện mặc định nhé.\r\n\r\nHỗ trợ đèn LED RGB 16,8 triệu màu\r\nTai nghe Logitech G733 LIGHTSPEED Wireless Black được trang bị hai vùng LED để tùy chỉnh ánh sáng để biến thành của riêng bạn. Cá nhân hóa màu sắc, hình ảnh hóa âm thanh, đưa bạn vào thế giới trò chơi với các hình động tùy chỉnh và thiết lập trước thông qua hệ sinh thái Logitech G Hub của hãng.\r\n\r\n\r\n\r\nÂm thanh sống động với màng loa PRO-G\r\nĐắm chìm vào trò chơi hơn bao giờ hết với âm thanh vòm DTS Headphone X 2.0 thế hệ mới. Ngoài ra Logitech G733 LIGHTSPEED Wireless Black còn được trang bị các tính năng nâng cao như: DTS Headphone:X 2.0, Blue VO!CE, LIGHTSYNC RGB,...\r\n\r\n\r\n\r\nÂm thanh vòm thế hệ mới đem thế giới trò chơi của bạn đến thế giới thật xung quanh bạn. Tận hưởng tất cả các tín hiệu âm thanh tuyệt vời từ môi trường xung quanh mà các trò chơi yêu thích của bạn đem lại - từ mọi hướng. Công nghệ DTS Headphone:X 2.0 mới nhất là âm thanh vòm vượt qua 7.1 kênh.', 1, '2021-07-15 12:33:05'),
(19, 'Headphone Max blue', 1, 5, 13900000, '637431118704995434_tai-nghe-airpods-max-blue-4.png', 'Đặc điểm nổi bật\r\nLà chiếc AirPods đầu tiên trong lịch sử Apple đi theo phong cách thiết kế over-ear chuyên dụng, AirPods Max đem tới sự cân bằng hoàn hảo giữa trải nghiệm âm thanh trung thực và tính tiện dụng đặc trưng của dòng tai nghe đến từ Táo khuyết.\r\n\r\nTai nghe Apple AirPods Max\r\n\r\nChiếc tai nghe over-ear tinh tế nhất\r\nVới AirPods Max, Apple đã định nghĩa lại phong cách over-ear khi đem tới thiết kế tối giản từ chụp tai tới quai đeo headband. Mọi chi tiết trên AirPods Max đều có kích cỡ nhỏ gọn vừa đủ, hướng tới cảm giác thoải mái nhất cho mọi đối tượng khách hàng dù đeo liên tục hàng giờ.\r\n\r\nAirPods Max - Chiếc tai nghe over-ear tinh tế nhất\r\n\r\nTrong đó, phần headband được tích hợp thêm mặt lưới nhẹ nhàng, vừa đem tới cảm giác thông thoáng, vừa giảm thiểu lực tác động từ headband lên người dùng, tránh gây khó chịu bức bí như các dòng tai nghe over-ear khác.\r\n\r\nApple đã bọc một lớp chất liệu mềm bên ngoài khung thép không gỉ để tạo cảm giác linh hoạt, mềm mại mà vẫn đảm bảo tính bền bỉ cứng cáp trong thiết kế tổng thể chung. Ngoài ra, chủ nhân của AirPods Max có thể điều chỉnh độ dài hai bên headband cho tới khi ưng ý và phù hợp với kích cỡ riêng của bản thân.\r\n\r\nAirPods Max - chất liệu mềm bên ngoài khung thép không gỉ\r\n\r\nViệc ứng dụng chất liệu nhôm Anodized khi chế tạo phần chụp tai hai bên giúp cân bằng áp suất bên trong hiệu quả mà vẫn tối ưu hóa tính thẩm mỹ cho AirPods Max.\r\n\r\nAirPods Max - ứng dụng chất liệu nhôm Anodized\r\n\r\nĐệm tai êm ái và thoáng khí tối đa\r\nNhư mọi sản phẩm tai nghe Apple khác, AirPods Max được hoàn thiện tỉ mỉ đến từng chi tiết nhỏ nhất. Nếu những model AirPods tiền nhiệm ghi điểm ở phần driver bám tai mà vẫn thoải mái thì AirPods Max chọn hướng sử dụng đệm tai êm ái nhất.\r\n\r\nApple đã ứng dụng chất liệu bọt hoạt tính chuyên dụng cho các thiết bị âm thanh làm thành phần chính để sản xuất đệm tai. Bọc bên ngoài là một lớp vải lưới đặc biệt, được thiết kế riêng nhằm tạo cảm giác mềm mại mà vẫn thoáng khí.\r\n\r\nAirPods Max - Đệm tai êm ái và thoáng khí tối đa\r\n\r\nĐiều khiển dễ dàng với nút xoay Digital Crown\r\nNhỏ gọn và tinh tế, nút xoay Digital Crown chỉ chiếm diện tích khiêm tốn ở một bên chụp tai nhưng lại hỗ trợ người dùng thực hiện được rất nhiều tác vụ điều khiển AirPods Max. Từ việc tinh chỉnh độ to/nhỏ của âm lượng cho tới các chức năng như chuyển bài, nhận cuộc gọi đến và kích hoạt trợ lý ảo Siri đều rất dễ dàng và tiện dụng.\r\n\r\nAirPods Max - Nhỏ gọn và tinh tế, nút xoay Digital Crown\r\n\r\nÂm thanh cao cấp chưa từng có trên AirPods\r\nHướng tới việc tạo nên một chiếc tai nghe cho chất âm cao cấp vượt qua cả AirPods Pro, Apple không chỉ tối ưu thiết kế AirPods Max mà còn tích hợp công nghệ chống ồn chủ động ANC vào sản phẩm này. Mỗi thành phần cấu tạo nên trình điều khiển âm thanh đều được tinh chỉnh nhằm đem tới chất lượng âm thanh đầu ra có độ trung thực cao nhất.\r\n\r\nBạn sẽ hài lòng với âm bass trầm ấm, dải mid rõ ràng và âm treble sắc sảo mà sản phẩm đem lại. Dù gu của bạn là nhạc trẻ sôi động hay nhạc không lời nhẹ nhàng, AirPods Max cũng sẽ đáp ứng tốt nhu cầu của bạn.\r\n\r\nAirPods Max - Âm thanh cao cấp chưa từng có trên AirPods\r\n\r\nChip H1 hiện đại – trái tim của công nghệ Apple\r\nAirPods Max sở hữu không chỉ một mà tới hai bộ vi xử lý H1 - phân bố ở hai bên tai nghe. Sự góp mặt của chip H1 giúp xử lý tín hiệu âm thanh truyền tới và tạo nên chất âm đầu ra tối ưu nhất. Phần mềm mà các kỹ sư Táo khuyết đưa vào tận dụng hiệu quả cả 10 lõi xử lý âm thanh trong mỗi chip H1, từ đó gia tăng khả năng chống ồn chủ động tối đa. Không chỉ vậy, H1 còn là trái tim công nghệ Apple, vừa đảm bảo khả năng tương tác Siri nhanh nhạy, vừa giúp tiết kiệm năng lượng tốt hơn.\r\n\r\nAirPods Max - Chip H1 hiện đại – trái tim của công nghệ Apple\r\n\r\nTương thích tối ưu với các sản phẩm Apple\r\nAirPods Max thừa hưởng mọi công nghệ hiện đại trước đó của dòng sản phẩm AirPods, từ việc tương tác và ra lệnh cho Siri tới khả năng kết nối linh hoạt với các sản phẩm mang logo Táo khuyết như iPhone, iPad và MacBook. Trải nghiệm kết nối và tương tác giữa các thiết bị diễn ra xuyên suốt mà hoàn toàn không cần tới sự hỗ trợ của bất cứ cáp kết nối vướng víu nào.\r\n\r\nCụ thể, AirPods Max sẽ tự động quét để ghép đôi với iPhone/iPad khi hai thiết bị ở gần nhau. Một thông báo sẽ hiện lên để xác nhận quá trình kết nối trên thiết bị phát tín hiệu. Tất cả những gì bạn cần làm là đồng ý và thưởng thức trải nghiệm âm thanh.\r\n\r\nAirPods Max - Tương thích tối ưu với các sản phẩm Apple\r\n\r\nNgoài ra, cơ chế chuyển thiết bị phát tín hiệu từ iPhone sang iPad hoặc máy Mac sẽ diễn ra rất linh hoạt. Nếu bạn đang phát nhạc bằng máy Mac và bỗng nhiên có cuộc gọi tới trên iPhone, tai nghe AirPods Max sẽ tự ghép nối với iPhone để bạn nghe cuộc gọi đó.\r\n\r\nAirPods Max - chuyển thiết bị phát tín hiệu từ iPhone sang iPad\r\n\r\nChia sẻ âm thanh dễ dàng với một chiếc tai nghe AirPods khác. Trong trường hợp bạn đang nghe nhạc bằng iPhone và muốn chia sẻ bản nhạc thú vị này với một ai khác, hệ thống sẽ cho phép bạn sử dụng một thiết bị duy nhất (iPhone/iPad hoặc Mac) để phát nhạc tới nhiều chiếc AirPods ở gần đó.\r\n\r\nAirPods Max - Chia sẻ âm thanh dễ dàng với một chiếc tai nghe AirPod khác\r\n\r\nLinh hoạt hơn với tính năng phát hiện vị trí\r\nAirPods Max sẽ tạm dừng phát nhạc khi bạn hạ tai nghe xuống cổ để nói chuyện với ai đó nhằm tiết kiệm pin, và sẽ tiếp tục quá trình phát nhạc nếu bạn đeo lại vị trí cũ. Sự linh hoạt này giúp bạn không bỏ lỡ bất cứ tiết tấu nào mà vẫn trò chuyện thoải mái với người cạnh bên.\r\n\r\nNgoài ra, việc sử dụng linh hoạt Siri giúp bạn có thể ra lệnh cho trợ lý ảo đọc tin nhắn tới thành tiếng và phản hồi mà không cần phải chạm tay vào iPhone. Khẩu lệnh quen thuộc “Hey, Siri” sẽ mở ra một trải nghiệm tiện dụng khi tận dụng Siri để thực hiện hàng loạt tác vụ khác như kiểm tra thời tiết, lên lịch họp và nhiều hơn thế nữa.\r\n\r\nAirPods Max - Linh hoạt hơn với khả năng phát hiện vị trí\r\n\r\nKhả năng tiết kiệm pin cực kỳ hiệu quả\r\nKhi được cất trong Smart Case chuyên dụng, tai nghe AirPods Max sẽ tự động chuyển sang trạng thái tiêu thụ năng lượng thấp để tiết kiệm pin tối ưu và kéo dài thời gian sử dụng. Công nghệ sạc nhanh đem tới khả năng sạc 5 phút và đem tới 1,5 giờ nghe nhạc liên tục sau đó. Khi ở trạng thái đầy năng lượng, AirPods Max cho phép bạn đàm thoại, nghe nhạc, xem phim suốt nhiều giờ dù có kích hoạt chống ồn chủ động ANC.', 1, '2021-01-20 12:57:04'),
(78, 'nhomba', 12, 1, 10000, 'atien-linh-khi-niem-tin-tro-lai.jpg', '123123', 1, '2021-12-21 02:49:39');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `protypes`
--

CREATE TABLE `protypes` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Đang đổ dữ liệu cho bảng `protypes`
--

INSERT INTO `protypes` (`type_id`, `type_name`) VALUES
(1, 'Phone'),
(2, 'Laptop'),
(3, 'Keyboard'),
(4, 'Mouse'),
(5, 'Headphone');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `fullname` text COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `fullname`, `phone`, `username`, `password`) VALUES
(1, 'Tính nè', '', 'tinh123ok', '202cb962ac59075b964b07152d234b70'),
(2, 'Lã Tính', '', 'tinh1', '202cb962ac59075b964b07152d234b70'),
(5, 'tinh', '0123456789', 'nhom4', '202cb962ac59075b964b07152d234b70'),
(6, 'tinh', '0123456789', 'nhom3', '202cb962ac59075b964b07152d234b70');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Chỉ mục cho bảng `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`bill_id`);

--
-- Chỉ mục cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  ADD PRIMARY KEY (`manu_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `protypes`
--
ALTER TABLE `protypes`
  ADD PRIMARY KEY (`type_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `bill`
--
ALTER TABLE `bill`
  MODIFY `bill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT cho bảng `manufactures`
--
ALTER TABLE `manufactures`
  MODIFY `manu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT cho bảng `protypes`
--
ALTER TABLE `protypes`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
