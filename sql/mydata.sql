-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for cs_alumni
CREATE DATABASE IF NOT EXISTS `cs_alumni` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `cs_alumni`;

-- Dumping structure for table cs_alumni.career
CREATE TABLE IF NOT EXISTS `career` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `std_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `career` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.career: ~0 rows (approximately)
/*!40000 ALTER TABLE `career` DISABLE KEYS */;
REPLACE INTO `career` (`id`, `std_id`, `career`) VALUES
	(10, '1', 'teacher');
/*!40000 ALTER TABLE `career` ENABLE KEYS */;

-- Dumping structure for table cs_alumni.category
CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.category: ~3 rows (approximately)
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
REPLACE INTO `category` (`id`, `name`) VALUES
	(1, 'news'),
	(2, 'sportnew'),
	(3, 'publicrelations');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

-- Dumping structure for table cs_alumni.classify
CREATE TABLE IF NOT EXISTS `classify` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cate_id` int(10) unsigned NOT NULL,
  `news_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_classify_category` (`cate_id`),
  KEY `FK_classify_news` (`news_id`),
  CONSTRAINT `FK_classify_category` FOREIGN KEY (`cate_id`) REFERENCES `category` (`id`),
  CONSTRAINT `FK_classify_news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.classify: ~4 rows (approximately)
/*!40000 ALTER TABLE `classify` DISABLE KEYS */;
REPLACE INTO `classify` (`id`, `cate_id`, `news_id`) VALUES
	(15, 1, 15),
	(16, 1, 16),
	(17, 1, 17),
	(18, 1, 18);
/*!40000 ALTER TABLE `classify` ENABLE KEYS */;

-- Dumping structure for table cs_alumni.news
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `title` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` varchar(1000) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'normal',
  `picture` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `conclusion` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_news_user` (`user_id`),
  CONSTRAINT `FK_news_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.news: ~4 rows (approximately)
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
REPLACE INTO `news` (`id`, `user_id`, `title`, `content`, `date`, `status`, `picture`, `conclusion`) VALUES
	(15, 3, '"ศิริราช" ขาดแคลนเลือดสำรอง ขอรับบริจาคทุกกรุ๊ป โดยเฉพาะ A B และ O', 'โรงพยาบาลศิริราช เชิญชวนบริจาคเลือดทุกกรุ๊ป โดยเฉพาะ A B และ O หลังพบว่าปริมาณเลือดสำรองไม่เพียงพอ \r\n\r\nวันที่ 22 ส.ค.62 ผู้สื่อข่าวรายงานว่า แฟนเพจ ธนาคารเลือดโรงพยาบาลศิริราช รายงานสถานะเลือดสำรองประจำวันที่ 21 ส.ค. พบว่า กรุ๊ป A B และ O มีปริมาณเลือดสำรองไม่เพียงพอ ขณะที่ กรุ๊ป AB มีเลือดสำรองเพียงพอ\r\n\r\nสำหรับผู้บริจาคเลือด สามารถติดต่อบริจาคเลือด ได้ที่ธนาคารเลือด โรงพยาบาลศิริราช ตึก 72 ปี ชั้น 3 ทุกวันไม่เว้นวันหยุดราชการ เวลา 08.30-18.30 น. ปิดรับลงทะเบียน 18.00 น. วันหยุดราชการ เวลา 08.30-16.30 น. ปิดรับลงทะเบียน 16.00 น. สอบถามเพิ่มเติม หมายเลขโทรศัพท์ 0 2419 8081 ต่อ 123, 128.', '2019-08-1', 'normal', 'img_5d63e3b542a3f.jpg', ''),
	(16, 2, 'ราชทัณฑ์หางานหลังพ้นโทษ ลดหย่อนภาษีผู้ประกอบการ', 'ปัญหานักโทษเรือนจำเมื่อพ้นโทษออกมาแล้ว ทำไมถึงไปกระทำความผิดซ้ำอีก เป็นคำถามที่รัฐบาลเองพยายามหาทางแก้ไขปัญหานี้มาต่อเนื่อง แต่ไม่มีใครแก้ไขได้ ความผิดอยู่ที่ตัวนักโทษที่กระทำผิดซ้ำซากหรือสังคมเองที่ยังไม่พร้อมให้อภัยผู้ที่พ้นโทษกลับไปใช้ชีวิตอยู่ร่วมกับคนอื่น\r\n\r\nหนีไม่พ้นความรับผิดชอบร่วมกันของทุกฝ่าย จะโทษผู้ที่พ้นโทษออกมาแล้วทำผิดอีกฝ่ายเดียวไม่ได้ เมื่อออกมาแล้วไม่มีนายจ้างรับทำงาน ไม่มีใครอยากจ้างทำงาน ดูถูกเหยียดหยาม ทำให้นักโทษต้องกลับไปสู่ “วังวนเดิม” ออกไปเจอแต่ปัญหา เจอแต่ความเครียด สุดท้ายหนีไม่พ้นการกลับไปกระทำผิด ซ้ำขึ้นมาอีกเพื่อความอยู่รอด\r\n\r\nบางรายต้องกลับไปเสพยาเสพติด ค้ายาหรือลักขโมย เพื่อให้ได้เงินมา หรือที่เป็นข่าวบางรายต้องการทำผิดเพื่อที่จะได้เข้าไปอยู่ในเรือนจำ อย่างน้อยได้รับการดูแลดีกว่าอยู่ในสังคมที่ถูกตราหน้าว่า “โจร” ไม่มีใครรับทำงานไม่มีใครคบค้าสมาคม และเป็นภาระของคนที่อยู่ในครอบครัว', '2019-08-5', 'normal', 'img_5d63ebf2adfa5.jpg', ''),
	(17, 2, 'เศรษฐกิจไทยเริ่มจับไข้แล้ว ต้องเร่งลดดอกเบี้ยแก้ไข้', 'ผมไม่แปลกใจที่ คุณทศพร ศิริสัมพันธ์ เลขาธิการสภาพัฒนาเศรษฐกิจฯ แถลง ตัวเลขผลิตภัณฑ์มวลรวมในประเทศ (GDP) ไตรมาส 2 ของปีนี้ ขยายตัวเพียงร้อยละ 2.3 ต่ำที่สุดในรอบ 19 ไตรมาส หรือ ต่ำที่สุดในรอบ 4 ปีครึ่ง นับตั้งแต่ไตรมาส 4 ปี 2557 ต่ำกว่าไตรมาสแรกปี 62 ที่ขยายตัวร้อยละ 2.8 แต่ถ้าปรับผลของฤดูกาลออกไปแล้ว เศรษฐกิจไตรมาส 2 ขยายตัวเพียงร้อยละ 0.6 เท่านั้นเอง ส่งผลให้เศรษฐกิจครึ่งปีแรกขยายตัวเพียงร้อยละ 2.6 ต่ำกว่าเป้าที่ตั้งไว้ร้อยละ 4 แต่ของจริงลดลงทุกไตรมาสล่าสุด คุณทศพร เลขาสภาพัฒน์ ฟันธง จีดีพีปี 62 จะเหลือ 3% ต่ำกว่าเป้า 1%\r\n\r\nแสดงว่า เศรษฐกิจไทยวันนี้มีไข้ตัวร้อน แน่นอน\r\n\r\nสาเหตุที่เศรษฐกิจไตรมาส 2 ทรุดลงต่ำสุดในรอบเกือบ 5 ปี คุณทศพร เปิดเผยว่า เป็นเพราะ การส่งออกไตรมาส 2 ติดลบไป 4.2% การส่งออกไตรมาสแรกก็ติดลบ 4% ส่งผลให้การส่งออกครึ่งปีแรกติดลบ 4.1% คาดว่าทั้งปีการส่งออกจะติดลบ 1.2% จากเดิมที่คาดว่าจะโต 2.2% แต่มีข้อแม้ว่าการส่งออกครึ่งปีหลังต้องขยายตัว 3% ถ้าขยายตัวต่ำกว่านี้ ยอดส่งออกติดลบก็จะสูงกว่านี้\r\n\r\nดูแล้วก็น่าเป็นห่วงจริงๆ เศรษฐกิจไทยพึ่งการส่งออกถึง 70% ของจีดีพี แต่ ครึ่งปีแ', '2019-08-15', 'normal', 'img_5d63ec45f3516.jpg', ''),
	(18, 2, 'อย่าให้เหมือนกรุงโคลัมโบ', 'จันทร์ 19 สิงหาคม 2562 สภารัฐกิจหรือคณะรัฐมนตรีจีนออกแถลงการณ์ถึงร่างแผนยุทธศาสตร์ 19 ข้อที่ให้เซินเจิ้นมีความแข็งแกร่งและมั่นคงทางเศรษฐกิจและการพัฒนา โดยกำหนดเป้าหมายที่จะให้เซินเจิ้นอยู่ในอันดับต้นของเมืองดีที่สุดในโลกภายใน พ.ศ.2568 หรืออีก 6 ปีต่อจากนี้ นอกจากนั้น จีนยังต้องการใช้เซินเจิ้นเป็นหนึ่งในเมืองที่เป็นมาตรฐานอ้างอิงด้านความเจริญทางเศรษฐกิจในกลางศตวรรษที่ 21 ด้วย\r\n\r\nเท่าที่อ่านข่าวจากหลายแหล่ง จีนไม่ได้คิดปั้นเฉพาะเซินเจิ้นให้แทนฮ่องกงแต่อย่างเดียว แต่จีนมองถึงกว่างตงที่มีประชากรเกิน 80 ล้านคนด้วย เครือข่ายของคนจากกว่างตงมีอยู่ทั่วโลก โดยเฉพาะอย่างยิ่งในเอเชียตะวันออกเฉียงใต้ แม้คนไทยเชื้อสายจีนก็มีจำนวนไม่น้อยที่มีบรรพบุรุษมาจากกว่างตงและฝูเจี้ยน พื้นที่ของกว่างตงมีเพียง 1.8 แสนตารางกิโลเมตร แต่ที่กว่างตงเจริญมากเพราะมีชายฝั่งทะเลยาวที่สุดในสาธารณรัฐประชาชนจีน\r\n\r\nด้านการท่องเที่ยว กว่างตงก็มีศักยภาพไม่แพ้ฮ่องกงหรือมณฑลอื่น กว่างตงมีแหล่งท่องเที่ยวที่เป็นภูเขา เช่นภูเขาเหม่ย์หลิงที่กั้นกว่างตงกับกว่างซีและหูหนาน ภูเขาหนานหลิงที่กั้นกว่างตงจากหูหนานและเจียงซี เมืองที่อยู่บนท', '2019-08-26', 'normal', 'img_5d63edc77d051.jpg', '');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;

-- Dumping structure for table cs_alumni.report
CREATE TABLE IF NOT EXISTS `report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `comment` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK__news` (`news_id`),
  KEY `FK__user` (`user_id`),
  CONSTRAINT `FK__news` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  CONSTRAINT `FK__user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.report: ~0 rows (approximately)
/*!40000 ALTER TABLE `report` DISABLE KEYS */;
REPLACE INTO `report` (`id`, `news_id`, `user_id`, `comment`, `status`) VALUES
	(2, 15, 1, '1231321', NULL);
/*!40000 ALTER TABLE `report` ENABLE KEYS */;

-- Dumping structure for table cs_alumni.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `std_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `firstname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `career` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gen` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table cs_alumni.user: ~13 rows (approximately)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
REPLACE INTO `user` (`id`, `std_id`, `username`, `password`, `firstname`, `lastname`, `email`, `status`, `career`, `gen`) VALUES
	(1, '6010450586', 'folkdogfk', '$2y$10$J6LzFHw7XAeZvsM0FNuR4O8GTnestQ5uAgs5AWjuuqT5E8VHta.X2', 'Pattarapon', 'poltakhu', 'folk@folk.com', 'admin', 'student', NULL),
	(2, '1', 'zelos', '$2y$10$J6LzFHw7XAeZvsM0FNuR4O8GTnestQ5uAgs5AWjuuqT5E8VHta.X2', 'zelos', 'zelos', 'zelos', 'officer', 'student', NULL),
	(3, '1', 'mark', '$2y$10$J6LzFHw7XAeZvsM0FNuR4O8GTnestQ5uAgs5AWjuuqT5E8VHta.X2', 'mark', 'mark', 'mark', 'alumni', 'teacher', NULL),
	(24, '5010450713', NULL, NULL, 'sikharin', 'kadeeroj', 'sikarin.k@ku.th', 'alumni', 'Java Developer', '22'),
	(25, '5510450012', NULL, NULL, 'korrakot', 'traivichien', 'korrakot.t@ku.th', 'alumni', 'Java Developer', '27'),
	(26, '5110450497', NULL, NULL, 'piettipong', 'onsud', 'piettipong.o@ku.th', 'alumni', 'Web Developer', '23'),
	(27, '5010450555', NULL, NULL, 'itsales', 'singtaveesak', 'itsales.s@ku.th', 'alumni', 'Web Developer', '22'),
	(28, '5010456453', NULL, NULL, 'kajagy', 'pontaku', 'kajagy.p@ku.th', 'alumni', 'Data Sciencist', '22'),
	(29, '5916565565', NULL, NULL, 'pattalapon', 'pontaku', 'pattalapon.p@ku.th', 'alumni', 'Mobile Developer', '31'),
	(30, '5816545454', NULL, NULL, 'Jody', 'onsud', 'jody.o@ku.th', 'alumni', 'System Admin', '30'),
	(31, '5954545485', NULL, NULL, 'steven', 'gerrard', 'steven.g@ku.th', 'alumni', 'Java Developer', '31'),
	(32, '5845454112', NULL, NULL, 'john', 'terry', 'john.t@ku.th', 'alumni', 'IoT/Web developer', '30'),
	(33, '5010450586', NULL, NULL, 'tanya', 'pontaku', 'tanya.p@ku.th', 'alumni', 'Web developer', '22'),
	(34, '22222', 'markza', '123456', 'puet', ' oon', 'puettipong@hotmail.com', 'alumni', 'student', NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
user