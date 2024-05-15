-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 15, 2024 lúc 08:34 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `hatbookstore_dt`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(10) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Kỹ năng sống - Phát triển cá nhân'),
(2, 'Manga – Comic'),
(3, 'Nghệ thuật – Văn hóa');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orderdetails`
--

CREATE TABLE `orderdetails` (
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitprice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orderdetails`
--

INSERT INTO `orderdetails` (`order_id`, `product_id`, `quantity`, `unitprice`) VALUES
(29112032, 6, 2, 91800),
(29112032, 7, 1, 67320),
(29112033, 15, 1, 37050),
(29112034, 14, 1, 116350),
(29112034, 13, 1, 109850),
(29112034, 10, 2, 60520),
(29112035, 16, 3, 23750),
(29112035, 15, 1, 37050),
(29112036, 8, 2, 94400),
(29112036, 6, 1, 91800),
(29112037, 9, 1, 151200),
(29112038, 14, 1, 116350),
(29112038, 8, 1, 94400),
(29112038, 2, 1, 53320),
(29112038, 4, 1, 28500),
(29112039, 17, 4, 23750),
(29112039, 18, 1, 60520),
(29112040, 10, 1, 60520),
(29112041, 10, 9, 60520),
(29112042, 2, 1, 53320);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(50) NOT NULL,
  `id_user` int(50) NOT NULL,
  `order_date` date NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `total` double NOT NULL,
  `pay` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `id_user`, `order_date`, `status`, `total`, `pay`) VALUES
(29112032, 20040001, '2024-04-11', 0, 250920, 'COD'),
(29112033, 20040001, '2024-04-13', 0, 37050, 'ATM'),
(29112034, 20040002, '2024-04-15', 0, 347240, 'COD'),
(29112035, 20040002, '2024-04-16', 0, 108300, 'ATM'),
(29112036, 20040003, '2024-04-18', 1, 280600, 'ATM'),
(29112037, 20040003, '2024-04-24', 1, 151200, 'ATM'),
(29112038, 20040004, '2024-05-02', 1, 292570, 'COD'),
(29112039, 20040005, '2024-05-04', 1, 155520, 'ATM'),
(29112040, 20040001, '2024-05-07', 1, 60520, 'ATM'),
(29112041, 20040001, '2024-05-14', 0, 544680, 'ATM'),
(29112042, 20040001, '2024-05-16', 0, 53320, 'COD');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pro_id` int(10) NOT NULL,
  `pro_name` varchar(100) NOT NULL,
  `id_category` int(10) NOT NULL,
  `pro_img1` varchar(100) NOT NULL,
  `pro_img2` varchar(100) NOT NULL,
  `pro_img3` varchar(100) NOT NULL,
  `pro_price` double NOT NULL,
  `pro_author` varchar(100) NOT NULL,
  `pro_publisher` varchar(100) NOT NULL,
  `pro_description` text NOT NULL,
  `pro_quantity` smallint(6) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pro_id`, `pro_name`, `id_category`, `pro_img1`, `pro_img2`, `pro_img3`, `pro_price`, `pro_author`, `pro_publisher`, `pro_description`, `pro_quantity`, `status`) VALUES
(1, 'Chiến tranh tiền tệ', 1, 'Chiến tranh tiền tệ 1.jpg', 'Chiến tranh tiền tệ 2.jpg', 'Chiến tranh tiền tệ 3.jpg', 126750, 'Song Hong Bing', 'NXB Lao Động', 'Chiến tranh Thế giới Thứ hai đã tạo cơ hội lịch sử cho đồng đô la để tiêu diệt đồng bảng Anh. Hiến chương Đại Tây Dương và Đạo luật cho thuê là những con dao sắc bén trong tay Roosevelt nhằm thực hiện mục đích này. Cuối cùng, bằng cách giữ vàng lệnh chư hầu”, Hoa Kỳ đã thành lập một Vương triều Bretton Woods với chế độ đô la làm nhiếp chính.', 1000, 1),
(2, 'Đắc nhân tâm', 1, 'Đắc nhân tâm 1.jpg', 'Đắc nhân tâm 2.jpg', 'Đắc nhân tâm 3.jpg', 53320, 'Dale Carnegie', 'CÔNG TY TNHH PHÁT HÀNH S BOOKS', 'Đắc nhân tâm của Dale Carnegie là quyển sách của mọi thời đại và một hiện tượng đáng kinh ngạc trong ngành xuất bản Hoa Kỳ. Trong suốt nhiều thập kỷ tiếp theo và cho đến tận bây giờ, tác phẩm này vẫn chiếm vị trí số một trong danh mục sách bán chạy nhất và trở thành một sự kiện có một không hai trong lịch sử ngành xuất bản thế giới và được đánh giá là một quyển sách có tầm ảnh hưởng nhất mọi thời đại.', 1000, 1),
(3, 'Dám bị ghét', 1, 'Dám bị ghét 1.jpg', 'Dám bị ghét 2.jpg', 'Dám bị ghét 3.jpg', 83300, 'Kishimi Ichiro, Koga Fumitake', 'Dân Trí', 'TẠI SAO BẠN CỨ PHẢI SỐNG THEO KHUÔN MẪU NGƯỜI KHÁC ĐẶT RA? Dưới hình thức một cuộc đối thoại giữa Chàng thanh niên và Triết gia, cuốn sách trình bày một cách sinh động và hấp dẫn những nét chính trong tư tưởng của nhà tâm lý học Alfred Adler, người được mệnh danh là một trong “ba người khổng lồ của tâm lý học hiện đại”', 1000, 1),
(4, 'Chú thuật hồi chiến', 2, 'Chú thuật hồi chiến 1.jpg', 'Chú thuật hồi chiến 2.jpg', 'Chú thuật hồi chiến 3.jpg', 28500, 'Gege Akutami', 'Kim Đồng', 'Một chú linh bí ẩn đột nhiên xuất hiện tại kết giới Sakurajima! Nó chính là hình dạng sau khi chết và trở thành lời nguyền của kẻ có ân oán sâu nặng với Maki…!! Khi cả Maki và Noritoshi bị chú thai tiến hoá thành chú linh với tốc độ khủng khiếp dồn vào đường cùng, những kẻ xâm nhập mới lại xuất hiện…!?', 1000, 1),
(5, 'Thám tử lừng danh Conan', 2, 'Conan 1.jpg', 'Conan 2.jpg', 'Conan 3.jpg', 23750, 'Gosho Aoyama', 'Kim Đồng', 'Mật mã Akemi Miyano để lại ẩn chứa gợi ý về vị trí chôn chiếc hộp thời gian ở trường tiểu học!? Conan dẽ cùng nhóm Haibara hợp sức giải mã!!', 1000, 1),
(6, 'Giận', 3, 'Giận 1.jpg', 'Giận 2.jpg', 'Giận 3.jpg', 91800, 'Thích Nhất Hạnh', 'Hồng Đức', 'Khi ta giận, khi một ai đó làm cho ta giận, ta phải trở về với thân tâm và chăm sóc cơn giận của mình. Không nên nói gì hết. Không nên làm gì hết. Khi đang giận mà nói năng hay hành động thì chỉ gây thêm đổ vỡ mà thôi… Như thế là không khôn ngoan. Phải trở về dập tắt lửa trước đã… ', 1000, 1),
(7, 'Kiếp nào ta cũng tìm thấy nhau', 3, 'Kiếp nào ta cũng tìm thấy nhau 1.jpg', 'Kiếp nào ta cũng tìm thấy nhau 2.jpg', 'Kiếp nào ta cũng tìm thấy nhau 3.jpg', 67320, 'Brian L Weiss', 'Lao Động', 'Kiếp nào ta cũng tìm thấy nhau là cuốn sách thứ ba của Brain L. Weiss – một nhà tâm thần học có tiếng. Trước đó ông đã viết hai cuốn sách: cuốn đầu tiên là Ám ảnh từ kiếp trước, cuốn sách mô tả câu chuyện có thật về một bệnh nhân trẻ tuổi cùng với những liệu pháp thôi miên về kiếp trước đã làm thay đổi cả cuộc đời tác giả lẫn cô ấy. ', 1000, 1),
(8, 'Lãnh đạo tập sự', 1, 'Lãnh đạo tập sự 1.jpg', 'Lãnh đạo tập sự 2.jpg', 'Lãnh đạo tập sự 3.jpg', 94400, 'Stan Toler', 'Hồng Đức', 'Cuốn sách xoay quanh câu chuyện của Tim - người vừa được bầu làm lãnh đạo ở một bộ phận trong công ty. Trải qua sự phấn khích ban đầu, Tim dần nhận ra mọi thứ không diễn ra theo cách anh muốn. Dù Tim đã khích lệ rất nhiều, nhân viên trong bộ phận vẫn không có nhiệt huyết làm việc và anh dần rơi vào vòng xoáy của sự hoài nghi rằng “liệu mình có đủ năng lực để đảm nhận chức vụ này không?”.', 1000, 1),
(9, 'Những người khốn khổ ', 1, 'Những người khốn khổ 1.jpg', 'Những người khốn khổ 2.jpg', 'Những người khốn khổ 3.jpg', 151200, 'Victor Hugo', 'NXB Văn Học', 'Những người khốn khổ là bộ truyện lớn nhất mà cũng là tác phẩm có giá trị nhất trong sự nghiệp văn chương của Victor Hugo. Ông đã suy nghĩ về tác phẩm này và viết nó trong ngót ba mươi năm. Sau khi hoàn thành bộ tiểu thuyết này, Victor Hugo đã gọi nó là một trái núi.', 1000, 1),
(10, 'Nóng giận là bản năng Tĩnh lặng là bản lĩnh', 1, 'Nóng giận là bản năng tĩnh lặng là bản lĩnh 1.jpg', 'Nóng giận là bản năng tĩnh lặng là bản lĩnh 2.jpg', 'Nóng giận là bản năng tĩnh lặng là bản lĩnh 3.jpg', 60520, 'Tống Mặc', 'NXB Thế Giới', 'Sai lầm lớn nhất của chúng ta là đem những tật xấu, những cảm xúc tiêu cực trút bỏ lên những người xung quanh, càng là người thân càng dễ gây thương tổn. Cái gì cũng nói toạc ra, cái gì cũng bộc lộ hết không phải là thẳng tính, mà là thiếu bản lĩnh. Suy cho cùng, tất cả những cảm xúc tiêu cực của con người đều là sự phẫn nộ dành cho bất lực của bản thân.', 1000, 1),
(11, 'Ổn định hay tự do', 1, 'Ổn định hay tự do 1.jpg', 'Ổn định hay tự do 2.jpg', 'Ổn định hay tự do 3.jpg', 94170, 'Trương Học Vĩ', 'NXB Văn Học', 'Dưới góc nhìn thực tế cùng giọng văn vô cùng thẳng thắn, sắc sảo, nữ nhà văn đã thức tỉnh hàng vạn thanh niên Trung Quốc:\r\n- Mơ mộng viển vông - đơn giản là không có khả năng thực hiện ước mơ\r\n- Nếu như không có đích đến, thì gió phương nào cũng là ngược chiều\r\n- Khi tâm thái thay đổi, áp lực sẽ biến thành động lực\r\n- Thành công chỉ ưu ái cho những người dũng cảm', 1000, 1),
(12, 'Sống thực tế giữa đời thực dụng', 1, 'Sống thực tế giữa đời thực dụng 1.jpg', 'Sống thực tế giữa đời thực dụng 2.jpg', 'Sống thực tế giữa đời thực dụng 3.jpg', 129000, 'Mễ Mông', 'Dân Trí', 'THỰC DỤNG Ư? KHÔNG HỀ, TÔI CHỈ RẤT THỰC TẾ THÔI! Con người muốn trưởng thành đều phải trải qua ba lần lột xác “phá kén hóa bướm”. Lần đầu tiên là khi nhận ra mình không phải trung tâm thế giới. Lần thứ hai là khi phát hiện ra dù cố gắng đến đâu vẫn có những việc cảm thấy thật bất lực. Lần thứ  ba là khi biết rõ có những việc bản thân không thể làm được nhưng vẫn cố tranh đấu đến cùng.', 1000, 1),
(13, 'Sức mạnh của sự tập trung', 1, 'Sức mạnh của sự tập trung 1.jpg', 'Sức mạnh của sự tập trung 2.jpg', 'Sức mạnh của sự tập trung 3.jpg', 109850, 'Jack Canfield, Mark Victor Hansen, Les Hewitt', 'NXB Công Thương', 'Guồng quay liên tục của cuộc sống khiến chúng ta dường như chao đảo và vô cùng căng thẳng. Hàng ngày, luôn có một núi công việc chờ chúng ta giải quyết, từ việc học tập, kinh doanh, nghiên cứu, gặp gỡ,... cho đến những công việc nhỏ lẻ và vụn vặt trong gia đình như rửa bát, dọn nhà cửa, cắt cỏ,... Chúng ta sẽ giải quyết tất cả những việc đó ra sao?', 1000, 1),
(14, 'Chuyện kỳ lạ ở tiệm sách cũ Tanabe', 2, 'Chuyện kỳ lạ ở tiệm sách cũ Tanabe 1.jpg', 'Chuyện kỳ lạ ở tiệm sách cũ Tanabe 2.jpg', 'Chuyện kỳ lạ ở tiệm sách cũ Tanabe 3.jpg', 116350, 'Miyabe Miyuki', 'Thanh Niên', 'Cuốn sách là một tuyển tập những câu truyện “trinh thám” ngắn liên quan đến hành trình phá án hay đi tìm câu trả lời cho những bí ẩn hay “vụ án” xuất phát hoặc liên quan đến tiệm sách Tanabe nơi lão Iwa làm chủ. Trong suốt những hành trình nhỏ ấy, cả lão Iwa và đứa cháu Minoru ', 1000, 1),
(15, 'Doraemon', 2, 'Doraemon 1.jpg', 'Doraemon 2.jpg', 'Doraemon 3.jpg', 37050, 'Fujiko F Fujio', 'Kim Đồng', 'Câu chuyện bắt đầu khi Nobita tìm thấy một hòn đảo hình lưỡi liềm trên trời mây. Ở nơi đó, tất cả đều hoàn hảo… đến mức cậu nhóc mê ngủ ngày như Nobita cũng có thể trở thành một thần đồng toán học, một siêu sao thể thao! Doraemon và nhóm bạn đã cùng sử dụng một món bảo bối độc đáo chưa từng xuất hiện trước đây để đến với vương quốc tuyệt vời này. ', 1000, 1),
(16, 'One piece', 2, 'One piece 1.jpg', 'One piece 2.jpg', 'One piece 3.jpg', 23750, 'Eiichiro Oda', 'Kim Đồng', 'Ngay trước cuộc chinh phạt diễn ra, Kanjuro bất ngờ có động thái lạ... Chưa kể Momono suke còn bị bắt cóc... Trong lúc Kinemon và mọi người đang tuyệt vọng tràn trề, Luffy - Law - Kid bất ngờ xuất trận, mang lại nguồn sáng mới cho cả bọn!! Cả binh đoàn rồng rắn thẳng tiến về đảo Quỷ!!', 1000, 1),
(17, 'Spy x Family', 2, 'SxF 1.jpg', 'SxF 2.jpg', 'SxF 3.jpg', 23750, 'Tatsuya Endo', 'NXB Kim Đồng', 'Cuối cùng thì Twilight cũng tiếp xúc được với mục tiêu Desmond lần đầu tiên bằng cách xen vào cuộc gặp gỡ giữa hắn và cậu con trai thứ Damian!! Liệu thông qua cuộc trò chuyện, Twilight có tìm ra được bản chất của mục tiêu không thể dò xét tâm tư này hay không...!?', 1000, 1),
(18, 'Gieo trồng hạnh phúc', 3, 'Gieo trồng hạnh phúc 1.jpg', 'Gieo trồng hạnh phúc 2.jpg', 'Gieo trồng hạnh phúc 3.jpg', 60520, 'Thích Nhất Hạnh', 'NXB Lao Động', 'Chánh Niệm là nguồn năng lượng tỉnh thức đưa ta trở về với giây phút hiện tại và giúp ta tiếp xúc sâu sắc với sự sống trong mỗi phút giây của đời sống hằng ngày. Chúng ta không cần phải đi đâu xa để thực tập chánh niệm. Chúng ta có thể thực tập chánh niệm ngay trong phòng mình hoặc trên đường đi từ nơi này đến nơi khác. ', 1000, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(4) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user` varchar(20) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT 0,
  `locked` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `name`, `address`, `phone`, `email`, `user`, `pass`, `role`, `locked`) VALUES
(1, NULL, NULL, '', '', 'admin', '123', 1, 0),
(20040001, 'Lê Thị Lan Anh', '2623 Đ. Phạm Thế Hiển, Phường 7, Quận 8, Thành phố Hồ Chí Minh, Vietnam', '0795793509', 'lelananh02@gmail.com', 'hnanal', '11111', 0, 0),
(20040002, 'Trần Thái Hiễn', '28 Lương Thế Vinh, Tân Thới Hoà, Tân Phú, Thành phố Hồ Chí Minh, Vietnam', '0214620641', 'hienxautrai@gmail.com', 'hienne', '22222', 0, 0),
(20040003, 'Nguyễn Văn Tuấn', '59/11 Đ. Phạm Viết Chánh, Phường Nguyễn Cư Trinh, Quận 1, Thành phố Hồ Chí Minh, Vietnam', '0707121028', 'vantuanluoibieng@gmail.com', 'tuantuan', '33333', 0, 0),
(20040004, 'Nguyễn Xuân Tiến Bò', '31 Đ. Sư Vạn Hạnh, Phường 3, Quận 10, Thành phố Hồ Chí Minh, Vietnam', '0215202347', 'boconlonton@gmail.com', 'umbooo', '44444', 0, 0),
(20040005, 'Hồ Kim Sen', '333 Phan Văn Trị, Phường 2, Quận 5, Thành phố Hồ Chí Minh 700000, Vietnam', '0864599783', 'trongdamgidepbangsen@gmail.com', 'bongsen', '55555', 0, 0),
(20040006, 'Lê Thị Mỹ Hương', 'Quận 5', '0795793509', 'auduongtichhaa@gmaiil.com', 'new', 'password', 0, 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_user` (`id_user`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pro_id`),
  ADD KEY `id_category` (`id_category`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29112043;

--
-- AUTO_INCREMENT cho bảng `product`
--
ALTER TABLE `product`
  MODIFY `pro_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20040007;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `product` (`pro_id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
