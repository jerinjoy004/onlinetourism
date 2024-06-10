-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2024 at 01:24 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `updationDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', '2017-05-13 11:18:49');

-- --------------------------------------------------------

--
-- Table structure for table `Stay`
--

CREATE TABLE `Stay` (
  `stay_id` int(11) NOT NULL,
  `hotel_name` varchar(255) DEFAULT NULL,
  `nearest_landmark` varchar(255) DEFAULT NULL,
  `rate_1_bedroom` decimal(10,2) DEFAULT NULL,
  `rate_2_bedroom` decimal(10,2) DEFAULT NULL,
  `rate_3_bedroom` decimal(10,2) DEFAULT NULL,
  `hotel_image_url` varchar(255) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `Stay`
--

INSERT INTO `Stay` (`stay_id`, `hotel_name`, `nearest_landmark`, `rate_1_bedroom`, `rate_2_bedroom`, `rate_3_bedroom`, `hotel_image_url`, `package_id`) VALUES
(1, 'Taj Mahal Palace', 'Mumbai', 11250.00, 18750.00, 26250.00, 'http://www.cfmedia.vfmleonardo.com/imageRepo/1/0/27/641/10/001_Exterior-_O.jpg', 1),
(2, 'Leela Palace', 'Bangalore', 15000.00, 22500.00, 30000.00, 'https://www.luxurylink.com/images/sho_549d59b9/8384_01-2048/The%2BLeela%2BPalace%2BBangalore.jpg', 2),
(3, 'The Oberoi Grand', 'Kolkata', 13500.00, 21000.00, 28500.00, 'https://res-4.cloudinary.com/enchanting/images/w_1600,h_700,c_fill,f_auto/et-web/2015/05/Enchanting-Travels-India-Tours-Calcutta-Hotels-The-Oberoi-Grand-Kolkata/hotel-the-oberoi-grand-east-india.jpg', 3),
(4, 'ITC Grand Chola', 'Chennai', 16500.00, 24000.00, 31500.00, 'https://images.trvl-media.com/hotels/5000000/4950000/4942800/4942760/116d9887_z.jpg', 4),
(5, 'The Lalit', 'New Delhi', 14250.00, 21750.00, 29250.00, 'https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/06/31/5f/facade.jpg?w=900&h=-1&s=1', 5),
(6, 'JW Marriott', 'Goa', 18000.00, 25500.00, 33000.00, 'https://cf.bstatic.com/xdata/images/hotel/max1024x768/433681098.jpg?k=9be82e6a3c0d222a87ff3061b53b5082244147bd878969f4ef934fb419ee0cba&o=&hp=1', 1),
(7, 'Hyatt Regency', 'Mumbai', 15750.00, 23250.00, 30750.00, 'https://assets.hyatt.com/content/dam/hyatt/hyattdam/images/2014/09/21/1452/PERTH-P106-Exterior-Hero.jpg/PERTH-P106-Exterior-Hero.16x9.jpg?imwidth=1920', 2),
(8, 'Radisson Blu', 'Jaipur', 12750.00, 20250.00, 27750.00, 'https://tks.net/fileadmin/user_upload/99427594_10159452249807439_7864125895395508224_o.jpg', 3),
(9, 'Taj Exotica Resort & Spa', 'Goa', 19500.00, 27000.00, 34500.00, 'https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fwww.themilliardaire.co%2Fwp-content%2Fuploads%2F2014%2F08%2Ftaj-exotica-maldives-14.jpg&f=1&nofb=1&ipt=209c52b24937414d76a958123b8db891b482ac4ceee39acb738f8102805d1e74&ipo=images', 4),
(10, 'The Leela Palace', 'Udaipur', 17250.00, 24750.00, 32250.00, 'https://images.trvl-media.com/hotels/4000000/3860000/3851700/3851663/713529d0_z.jpg', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `BookingId` int(11) NOT NULL,
  `PackageId` int(11) DEFAULT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `FromDate` varchar(100) DEFAULT NULL,
  `ToDate` varchar(100) DEFAULT NULL,
  `Comment` mediumtext DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL,
  `CancelledBy` varchar(5) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`BookingId`, `PackageId`, `UserEmail`, `FromDate`, `ToDate`, `Comment`, `RegDate`, `status`, `CancelledBy`, `UpdationDate`) VALUES
(12, 3, 'dem@gmail.com', '2024-06-13', '2024-06-25', 'jnj', '2024-06-09 06:26:18', 2, 'u', '2024-06-09 07:24:41'),
(13, 2, 'dem@gmail.com', '2024-06-12', NULL, 'hi', '2024-06-09 07:41:58', 1, NULL, '2024-06-09 07:43:50');

-- --------------------------------------------------------

--
-- Table structure for table `tblenquiry`
--

CREATE TABLE `tblenquiry` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `EmailId` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `Status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblissues`
--

CREATE TABLE `tblissues` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) DEFAULT NULL,
  `Issue` varchar(100) DEFAULT NULL,
  `Description` mediumtext DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `AdminRemark` mediumtext DEFAULT NULL,
  `AdminremarkDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblissues`
--

INSERT INTO `tblissues` (`id`, `UserEmail`, `Issue`, `Description`, `PostingDate`, `AdminRemark`, `AdminremarkDate`) VALUES
(8, NULL, NULL, NULL, '2024-06-09 06:25:32', NULL, NULL),
(9, 'dem@gmail.com', 'Booking Issues', 'nn', '2024-06-09 07:42:10', 'ok', '2024-06-09 07:43:58');

-- --------------------------------------------------------

--
-- Table structure for table `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `type` varchar(255) DEFAULT '',
  `detail` longtext DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblpages`
--

INSERT INTO `tblpages` (`id`, `type`, `detail`) VALUES
(1, 'terms', '<p><strong>Effective Date: 01/05/2024<br></strong></p><p>Welcome to Travel Management System&nbsp; (the \"Website\"). By accessing or using our Website, you agree to comply with and be bound by the following terms and conditions (the \"Terms\"). Please read them carefully.</p><p><strong>1. Acceptance of Terms</strong></p><p>By accessing or using the Website, you agree to be legally bound by these Terms and all terms incorporated by reference. If you do not agree to these Terms, please do not use the Website.</p><p><strong>2. Use of the Website</strong></p><p>2.1 <strong>Eligibility:</strong> You must be at least 18 years old to use our services. By using the Website, you represent and warrant that you are at least 18 years of age.</p><p>2.2 <strong>User Responsibilities:</strong> You agree to use the Website in accordance with these Terms and applicable laws and regulations. You are responsible for maintaining the confidentiality of your account information and for all activities that occur under your account.</p><p><strong>3. Services</strong></p><p>3.1 <strong>Travel Information:</strong> The Website provides information about various travel destinations, including attractions, accommodations, and transportation options. This information is for general informational purposes only.</p><p>3.2 <strong>Booking Services:</strong> Users may have the option to book travel services through the Website. These bookings are subject to the terms and conditions of the respective service providers.</p><p><strong>4. User Content</strong></p><p>4.1 <strong>Submission:</strong> You may have the ability to submit reviews, comments, or other content (\"User Content\") to the Website. By submitting User Content, you grant us a non-exclusive, worldwide, royalty-free, perpetual, and irrevocable right to use, reproduce, modify, adapt, publish, and display such content.</p><p>4.2 <strong>Prohibited Content:</strong> You agree not to submit any User Content that is unlawful, harmful, defamatory, obscene, infringing, or otherwise objectionable.</p><p><strong>5. Intellectual Property</strong></p><p>5.1 <strong>Ownership:</strong> All content and materials on the Website, including text, graphics, logos, and images, are the property of [Website Name] or its content suppliers and are protected by intellectual property laws.</p><p>5.2 <strong>License:</strong> You are granted a limited, non-exclusive, non-transferable license to access and use the Website for personal and non-commercial purposes. Any unauthorized use of the Website or its content is prohibited.</p><p><strong>6. Disclaimers and Limitation of Liability</strong></p><p>6.1 <strong>Disclaimer of Warranties:</strong> The Website and its content are provided \"as is\" without any warranties of any kind, either express or implied. We do not warrant that the Website will be uninterrupted or error-free.</p><p>6.2 <strong>Limitation of Liability:</strong> In no event shall [Website Name] be liable for any direct, indirect, incidental, special, or consequential damages arising out of or in connection with your use of the Website.</p><p><strong>7. Indemnification</strong></p><p>You agree to indemnify, defend, and hold harmless [Website Name], its officers, directors, employees, and agents from and against any claims, liabilities, damages, losses, and expenses arising out of or in connection with your use of the Website or violation of these Terms.</p><p><strong>8. Privacy Policy</strong></p><p>Our Privacy Policy explains how we collect, use, and disclose your personal information. By using the Website, you consent to the collection and use of your information as described in our Privacy Policy.</p><p><strong>9. Changes to Terms</strong></p><p>We reserve the right to modify these Terms at any time. Any changes will be effective immediately upon posting on the Website. Your continued use of the Website after any changes signifies your acceptance of the modified Terms.</p><p><strong>10. Governing Law</strong></p><p>These Terms are governed by and construed in accordance with the laws of [Your Country/State], without regard to its conflict of law principles.</p>'),
(2, 'privacy', '										<p><strong>Last Updated: 01/05/24<br></strong></p><p><strong>1. Introduction</strong></p><p>Welcome to Travel Management System (\"we,\" \"our,\" \"us\"). We are committed to protecting and respecting your privacy. This Privacy Policy explains how we collect, use, disclose, and safeguard your information when you visit our website [website URL], use our services, or interact with us in other ways. Please read this Privacy Policy carefully. If you do not agree with the terms of this Privacy Policy, please do not access the site or use our services.</p><p><strong>2. Information We Collect</strong></p><p>We may collect and process the following data about you:</p><p><strong>a. Personal Identification Information:</strong></p><ul><li>Name</li><li>Email address</li><li>Phone number</li><li>Address</li><li>Date of birth</li></ul><p><strong>b. Technical Data:</strong></p><ul><li>IP address</li><li>Browser type and version</li><li>Time zone setting and location</li><li>Browser plug-in types and versions</li><li>Operating system and platform</li><li>Other technology on the devices you use to access this website</li></ul><p><strong>c. Usage Data:</strong></p><ul><li>Information about how you use our website, products, and services.</li></ul><p><strong>d. Marketing and Communications Data:</strong></p><ul><li>Your preferences in receiving marketing from us and your communication preferences.</li></ul><p><strong>3. How We Use Your Information</strong></p><p>We use the information we collect in the following ways:</p><p><strong>a. To Provide and Improve Our Services:</strong></p><ul><li>To create and manage your account</li><li>To process your transactions and bookings</li><li>To provide customer support</li><li>To improve our website, products, and services</li></ul><p><strong>b. Communication:</strong></p><ul><li>To send you updates, marketing communications, and promotional offers</li><li>To respond to your inquiries and requests</li></ul><p><strong>c. Legal and Compliance:</strong></p><ul><li>To comply with legal obligations</li><li>To protect our rights and interests and those of our users and others</li></ul><p><strong>4. Sharing Your Information</strong></p><p>We may share your information with third parties in the following circumstances:</p><p><strong>a. Service Providers:</strong></p><ul><li>We may share your information with third-party vendors, service providers, contractors, or agents who perform services on our behalf.</li></ul><p><strong>b. Business Transfers:</strong></p><ul><li>If we are involved in a merger, acquisition, or sale of all or a portion of our assets, your information may be transferred as part of that transaction.</li></ul><p><strong>c. Legal Requirements:</strong></p><ul><li>We may disclose your information if required to do so by law or in response to valid requests by public authorities.</li></ul><p><strong>5. Data Security</strong></p><p>We implement appropriate technical and organizational measures to protect your personal data against accidental or unlawful destruction, loss, alteration, unauthorized disclosure, or access. However, no internet or email transmission is ever fully secure or error-free, so please take special care in deciding what information you send to us in this way.</p><p><strong>6. Data Retention</strong></p><p>We will only retain your personal data for as long as necessary to fulfill the purposes we collected it for, including for the purposes of satisfying any legal, accounting, or reporting requirements.</p><p><strong>7. Your Rights</strong></p><p>Depending on your location, you may have the following rights regarding your personal data:</p><p><strong>a. Access:</strong></p><ul><li>The right to request access to the personal data we hold about you.</li></ul><p><strong>b. Correction:</strong></p><ul><li>The right to request that we correct any inaccuracies in your personal data.</li></ul><p><strong>c. Deletion:</strong></p><ul><li>The right to request the deletion of your personal data under certain circumstances.</li></ul><p><strong>d. Restriction:</strong></p><ul><li>The right to request the restriction of processing your personal data under certain circumstances.</li></ul><p><strong>e. Data Portability:</strong></p><ul><li>The right to request the transfer of your personal data to another party.</li></ul><p><strong>f. Objection:</strong></p><ul><li>The right to object to the processing of your personal data under certain circumstances.</li></ul><p><strong>8. Changes to This Privacy Policy</strong></p><p>We may update this Privacy Policy from time to time. If we make material changes, we will notify you by email (if you have provided your email address) or by means of a notice on this website prior to the change becoming effective. We encourage you to review this Privacy Policy periodically to stay informed about how we are protecting your information.</p>\r\n										'),
(3, 'aboutus', '																				<p>Welcome to [Travel Management System], your premier destination for seamless and enriching travel experiences. Whether you are planning a relaxing vacation, a thrilling adventure, or a business trip, we are here to ensure every detail is meticulously handled, so you can focus on enjoying your journey.</p><h3><span style=\"font-weight: normal;\">Who We Are</span></h3><p>At Travel Management System, we are passionate travelers and dedicated professionals who understand that travel is not just about reaching a destination, but about creating memorable experiences along the way. Our team comprises experienced travel experts, customer service specialists, and technology enthusiasts committed to delivering top-notch services to our clients.</p><h3>Our Mission</h3><p>Our mission is to simplify travel planning and make every journey an unforgettable experience. We aim to provide our clients with the best travel options, tailored to their preferences and needs, through innovative technology and exceptional customer service.</p><h3>What We Offer</h3><p><strong>Personalized Travel Planning:</strong>\r\nWe offer personalized travel planning services to ensure your trip matches your interests, budget, and schedule. Our experts are always ready to provide recommendations and assist you in creating the perfect itinerary.</p><p><strong>Comprehensive Travel Services:</strong>\r\nFrom flights and accommodation to car rentals and travel insurance, we provide a wide range of services to cover all your travel needs. Our partnerships with top travel providers guarantee that you receive the best deals and quality services.</p><p><strong>24/7 Customer Support:</strong>\r\nTravel can be unpredictable, and we are here to help you navigate any challenges. Our customer support team is available 24/7 to assist with any queries or issues you may encounter during your trip.</p><p><strong>Secure and Easy Booking:</strong>\r\nOur user-friendly platform allows you to book your travel services with ease and confidence. We prioritize your security and ensure that your personal information is protected throughout the booking process.</p><h3>Why Choose Us?</h3><p><strong>Expertise:</strong>\r\nWith years of experience in the travel industry, our team has the knowledge and skills to provide you with the best travel solutions.</p><p><strong>Customer-Centric Approach:</strong>\r\nWe put our customers at the heart of everything we do. Your satisfaction and happiness are our top priorities, and we strive to exceed your expectations at every turn.</p><p><strong>Innovation:</strong>\r\nWe leverage the latest technology to offer innovative solutions that enhance your travel experience. Our platform is designed to be intuitive and efficient, making travel planning a breeze.</p><p><strong>Reliability:</strong>\r\nYou can count on us for reliable and trustworthy services. We are committed to transparency and integrity in all our dealings.</p><h3>Join Us on Your Next Adventure</h3><p>Whether you are exploring a new city, embarking on a cross-country road trip, or attending an important business meeting, [Travel Management System] is your trusted partner in travel. Let us handle the details while you create lasting memories.</p><p>Thank you for choosing [Travel Management System]. We look forward to being a part of your travel journey!</p>\r\n										'),
(11, 'contact', '																				<p>If you have any queries, please contact us at:</p><p>Travel Management System,</p><p>Ernakulam, Kerala<br></p><p>&nbsp;tms00@gmail.com</p><p>+91 9632875310<br></p>\r\n										');

-- --------------------------------------------------------

--
-- Table structure for table `tbltourpackages`
--

CREATE TABLE `tbltourpackages` (
  `PackageId` int(11) NOT NULL,
  `PackageName` varchar(200) DEFAULT NULL,
  `PackageType` varchar(150) DEFAULT NULL,
  `PackageLocation` varchar(100) DEFAULT NULL,
  `PackagePrice` int(11) DEFAULT NULL,
  `PackageFeatures` varchar(255) DEFAULT NULL,
  `PackageDetails` mediumtext DEFAULT NULL,
  `PackageImage` varchar(100) DEFAULT NULL,
  `Creationdate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbltourpackages`
--

INSERT INTO `tbltourpackages` (`PackageId`, `PackageName`, `PackageType`, `PackageLocation`, `PackagePrice`, `PackageFeatures`, `PackageDetails`, `PackageImage`, `Creationdate`, `UpdationDate`) VALUES
(1, 'Golden Triangle', 'Cultural', 'Delhi, Agra, Jaipur', 25000, 'Hotel stay in 3-star hotels, guided tours of Red Fort, Qutub Minar, and Taj Mahal, daily breakfast and dinner, airport transfers, monument entry fees', 'Explore Indias rich history and architecture in this 5-day package', 'golden-triangle-tour-main.jpg', '2017-05-13 14:23:44', '2017-05-13 17:51:01'),
(2, 'Beach Getaway', 'Relaxation', 'Goa', 18000, '3-night stay in a beach resort, daily breakfast and dinner, water sports activities (parasailing, jet-skiing), seafood dinner at a local restaurant, airport transfers', 'Unwind in Goas beautiful beaches and vibrant nightlife', 'beach-goa.jpg', '2017-05-13 15:24:26', '2017-05-13 17:51:57'),
(3, 'Himalayan Adventure', 'Trekking', 'Ladakh', 40000, '7-day guided trek with experienced guides, camping equipment and meals, acclimatization in Leh, visit to Pangong Lake and Nubra Valley, airport transfers', 'Experience the breathtaking beauty of the Himalayas on this 7-day trek', 'trekking.webp', '2017-05-13 16:00:58', '2019-07-20 20:12:41'),
(4, 'Wildlife Safari', 'Adventure', 'Ranthambore, Rajasthan', 30000, '2 jungle safaris with wildlife expert guide, 2-night stay in a jungle lodge, daily breakfast and dinner, visit to Ranthambore Fort, airport transfers', 'Spot majestic tigers and other wildlife in their natural habitat', 'wildlife.jpg', '2017-05-13 22:39:37', '0000-00-00 00:00:00'),
(5, 'Backwaters Cruise', 'Relaxation', 'Alleppey, Kerala', 22000, '2-night stay on a traditional Kerala houseboat, daily breakfast, lunch, and dinner, village tour, fishing, and sunset cruise, airport transfers', 'Cruise through Keralas serene backwaters and experience local culture', 'backwater.jpg', '2017-05-13 22:42:10', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `MobileNumber` char(10) DEFAULT NULL,
  `EmailId` varchar(70) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tblusers`
--

INSERT INTO `tblusers` (`id`, `FullName`, `MobileNumber`, `EmailId`, `Password`, `RegDate`, `UpdationDate`) VALUES
(12, 'jerin', '1256498999', 'dem@gmail.com', 'fe01ce2a7fbac8fafaed7c982a04e229', '2024-06-09 06:25:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Stay`
--
ALTER TABLE `Stay`
  ADD PRIMARY KEY (`stay_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`BookingId`);

--
-- Indexes for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissues`
--
ALTER TABLE `tblissues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  ADD PRIMARY KEY (`PackageId`);

--
-- Indexes for table `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`),
  ADD KEY `EmailId_2` (`EmailId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Stay`
--
ALTER TABLE `Stay`
  MODIFY `stay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `BookingId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tblenquiry`
--
ALTER TABLE `tblenquiry`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblissues`
--
ALTER TABLE `tblissues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tbltourpackages`
--
ALTER TABLE `tbltourpackages`
  MODIFY `PackageId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Stay`
--
ALTER TABLE `Stay`
  ADD CONSTRAINT `Stay_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tbltourpackages` (`PackageId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
