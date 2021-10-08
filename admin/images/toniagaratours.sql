-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 16, 2018 at 08:34 PM
-- Server version: 10.1.29-MariaDB
-- PHP Version: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toniagaratours`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tours`
--

CREATE TABLE `tbl_tours` (
  `ID` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `slug` varchar(250) NOT NULL,
  `sub_title` varchar(250) NOT NULL,
  `description` mediumtext NOT NULL,
  `location` varchar(200) NOT NULL,
  `duration` varchar(200) NOT NULL,
  `no_reviews` varchar(200) NOT NULL,
  `currency` varchar(50) NOT NULL,
  `adults_price` float NOT NULL,
  `seniors_price` float NOT NULL,
  `children_price` float NOT NULL,
  `infants_price` float NOT NULL,
  `tour_schedule` mediumtext NOT NULL,
  `tour_map` text NOT NULL,
  `tour_reviews` mediumtext NOT NULL,
  `tour_inclusions` text NOT NULL,
  `pickup_information` mediumtext NOT NULL,
  `cancellation_policy` mediumtext NOT NULL,
  `frequently_asked_questions` mediumtext NOT NULL,
  `banner_image` varchar(250) NOT NULL,
  `youtube_link` varchar(250) NOT NULL,
  `xola_code` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_tours`
--

INSERT INTO `tbl_tours` (`ID`, `title`, `slug`, `sub_title`, `description`, `location`, `duration`, `no_reviews`, `currency`, `adults_price`, `seniors_price`, `children_price`, `infants_price`, `tour_schedule`, `tour_map`, `tour_reviews`, `tour_inclusions`, `pickup_information`, `cancellation_policy`, `frequently_asked_questions`, `banner_image`, `youtube_link`, `xola_code`, `status`, `created_on`) VALUES
(4, 'Toronto To Niagara Falls Day Tour', 'toronto-to-niagara-falls-day-tour', 'Niagara Falls: Daily Toronto to Niagara Falls Bus Tours', '<p><strong>There is so much to see and do in Niagara Falls!  On our ToNiagaraTours Toronto to Niagara Falls Full Day Tour you will discover the Niagara Region with us!</strong></p>          <p>ToNiagaraTours offers free pickup from most downtown Toronto and Airport hotels (see our FAQ sections for a list of hotel pickup destinations), if you not staying in a hotel, we also have main pickup areas which are usually a short walk or taxi ride away.</p>           <p class=\"read-more\" style=\"display: none;\"> After pickup we drive to Niagara Falls, for you to experience one of the World\'s most beautiful natural wonders.  Ride the legendary Hornblower Boat Cruise (seasonal) which takes you right up to the base of the Great Horseshoe Falls.  Visit the Victorian era town of Niagara-on-the-Lake and learn about it\'s rich history.  You will visit one of the many famous wineries in the Niagara region for a wine tasting.  Join us and you will have a great time!</p><button id=\"read-more-action\" class=\"r_more\">Read More...</button>', 'Niagara Falls', '9.5 Hours', '199', 'CA', 139, 129, 109, 0, '<h2 class=\"heading4\">Tour Itinerary</h2>\r\n<ul class=\"schedule_list\">\r\n                    <li>\r\n                    <span>1.</span>\r\n                    <h3>Day Tour Begins</h3>\r\n                    <p>Free pick up from your hotel lobby in Toronto, Mississauga, Brampton and Etobicoke Hotels*, including Hotels near the Toronto Pearson International Airport. 1.5 Hours (90 minutes) drive from Toronto to Niagara Falls.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Downtown, Toronto, ON, Canada  <i class=\"fa fa-clock-o\"></i> 8:30 - 9:30 am</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>2.</span>\r\n                    <h3>Arrive at Canadian side of Niagara Falls.</h3>\r\n                    <p>Your day tour begins with the main attraction, the majestic Canadian Niagara Falls.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Downtown, Toronto, ON, Canada  <i class=\"fa fa-clock-o\"></i> 11 am</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>3.</span>\r\n                    <h3>Hornblower Niagara Cruise (Seasonal)</h3>\r\n                    <p>FREE Admission and no waiting in line (VIP treatment) for the Niagara Falls boat tour called the HORNBLOWER NIAGARA CRUISES (seasonal). If the Hornblower cruise is not available then you will experience either the Journey Behind the Falls attraction, where you travel around in the tunnels behind the Niagara Falls or see the panoramic view of the Niagara Falls from the Skylon Tower (the attraction visited depends on availability).</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i>  Hornblower Niagara Cruises, Niagara Falls, ON, Canada  <i class=\"fa fa-clock-o\"></i> 11:15 am</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>4.</span>\r\n                    <h3>Explore Niagara Falls</h3>\r\n                    <p>Your free time begins now! You can explore the Niagara Falls and surrounding areas on your own. Do not worry about getting lost! You will have the free Niagara Falls lanyard with our contact information with you. This is especially liked by tourists travelling with young children.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Niagara Falls, ON, Canada  <i class=\"fa fa-clock-o\"></i> 12 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>5.</span>\r\n                    <h3>Full Canadian Buffet Lunch at Sheraton Fallsview Restaurant (Optional Add On)</h3>\r\n                    <p>Enjoy a full Canadian Buffet Lunch. A fresh, healthy and delicious buffet lunch at the Sheraton Fallsview Restaurant, on the penthouse level of the Sheraton Hotel. You will enjoy a tasty meal with a lot to choose from while enjoying the spectacular view of the Canadian Horseshoe Falls and American Falls. This is an awesome photo opportunity!</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Sheraton on the Falls Hotel, Falls Avenue, Niagara Falls, ON, Canada  <i class=\"fa fa-clock-o\"></i> 1:30 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>6.</span>\r\n                    <h3>Scenic drive on Niagara Parkway</h3>\r\n                    <p>Winston Churchill has famously called the Niagara Parkway \"The Prettiest Sunday Afternoon Drive in the World,\" see for yourself! The Niagara Parkway is a spectacular drive along the Niagara River. You can admire the views and the recreational trail is used by pedestrians and is also wheelchair accessible.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Niagara Parkway, Niagara Falls, ON, Canada  <i class=\"fa fa-clock-o\"></i> 2:30 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>7.</span>\r\n                    <h3>Whirlpool Rapids</h3>\r\n                    <p>Experience the natural phenomenon of the Niagara River. You will witness the power of the Niagara River and watch the white waters of the rapids in the Niagara Gorge. The waters of the rapids converge, causing them to spin in counterclockwise motion.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Niagara Falls, ON, Canada  <i class=\"fa fa-clock-o\"></i> 3:15 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>8.</span>\r\n                    <h3>The Floral Clock</h3>\r\n                    <p>Between the Botanical Gardens and Queenston Heights Park stands one of the most popular sights to view in Niagara. The Floral Clock is a 12.2-m (40-ft.) diameter working clock that is one of the largest in the world. Once you have taken all you photos with the colourful clock you can take time to go souvenir shopping.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Queenston Heights Park, Niagara Parkway, Niagara-on-the-Lake, ON, Canada  <i class=\"fa fa-clock-o\"></i> 3:30 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>9.</span>\r\n                    <h3>Queenston Heights Stopover</h3>\r\n                    <p>Stopover at Queenston Heights, which borders Canada and the United States with only the Niagara River separating them. Are you a history buff? Come with us and learn about the famous Battle of Queenston Heights. Queenston Heights Park is the site of a War of 1812 battle in which Sir Isaac Brock was killed. A 50-m. (150-ft.) monument, that is perched above the Niagara Escarpment, was built in his honour. 4:00 pm: Stop at the Smallest Chapel in the World! Nobody takes you there, except us, this is a unique destination and a perfect place for more pictures! 4:15 pm: Stopover in Niagara-on-the-lake for 60-75 MINUTES. You will appreciate the quaint shops and boutiques that line Queen Street, the main drag of Niagara-on-the-Lake, as well as the proximity of wineries, brew pubs and even a chocolate factory!</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Queenston Heights Park, Niagara Parkway, Niagara-on-the-Lake, ON, Canada  <i class=\"fa fa-clock-o\"></i> 3:45 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>10.</span>\r\n                    <h3>Winery Tour</h3>\r\n                    <p>Complimentary wine and grape juice tasting is available. Be treated as a wine connoisseur at a world-class winery. Buy local-made wines of your choice. World famous Canadian Ice Wines are available here.</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Niagara-on-the-Lake, ON, Canada  <i class=\"fa fa-clock-o\"></i> 5:30 pm</div>\r\n                    </li>\r\n                    <li>\r\n                    <span>11.</span>\r\n                    <h3>Back to Downtown Toronto and Airport Hotels</h3>\r\n                    <p>The tour ends back where it started, your camera will be full of memories that will last forever!</p>\r\n                    <div class=\"address-time\"><i class=\"fa fa-map-marker\"></i> Toronto, ON, Canada <i class=\"fa fa-clock-o\"></i> 7:00- 7.30 pm</div>\r\n                    </li>\r\n                    \r\n                    \r\n                    \r\n                    \r\n                    \r\n                    \r\n                  </ul>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d30672.187539133367!2d-79.08484078498661!3d43.08244017522306!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d3445eec824db9%3A0x46d2c56156bda288!2sNiagara+Falls%2C+ON%2C+Canada!5e0!3m2!1sen!2sin!4v1527861561120\" width=\"100%\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen=\"\"></iframe>', '<div class=\"heading5\">119 Reviews</div>\r\n<ul class=\"review_list\">\r\n                <li>\r\n                  <h3 class=\"name\">MARY-ANNE M</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i>  11:50 am - May 6, 2018.</div>\r\n                  <p>Wonderful tour to see the Falls. Very informative tour guide as well as driver. Lots of time to wander and view, plus couple of stops on the way home. Relaxed, every enjoyable day. Thanks to everyone. The staff who answered my queries, efficient booking, phone call on the morning to advise anticipated collection time. Excellent</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">JARED S C</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 6:22 pm - May 2, 2018.</div>\r\n                  <p>We had a great time, would definitely do this trip again. Would like to see in summer next time. Thanks</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">REKYAN KI</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i>  12:20 pm - April 26, 2018. </div>\r\n                  <p>Good Tour!</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">A MITCHELL</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 1:40 am - April 22, 2018.</div>\r\n                  <p>Packed alot into the day trip! We left our apartment at 8.35am, picked up at 9.14am and headed to wonderful Niagara, arriving at 11.15am. Plenty of time on our own till lunch at 1.45pm in the Sheraton with great views over the falls. I would recommend lunch only because choice elsewhere is poor. It was unfortunate the boat trip was cancelled as the weather was bad but we enjoyed the trip up the tower instead. Superb views! The helicopter tour was advertised on the trip for an extra cost but unfortunately it was very busy so we were unable to take advantage of that which was disappointing. Enjoyed the drive down the Niagara River. Really beautiful, with a few stops on the way. Particularly enjoyed the wine tasting and learnt a lot about ice wine! Finally arrived back in Toronto at 8.15pm so a long, exciting day!</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">KYLA C.</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 4:34 pm - April 13, 2018.</div>\r\n                  <p>Went on the trip yesterday and had a fabulous day.</p>\r\n<p>Was advised pick up would be between 8:45-9:15 and as advised at approx 9am the big green bus appeared.</p>\r\n<p>The driver/tour guide, Haroon, was very friendly and knowledgable and enjoyable to spend the day with.</p>\r\n<p>Bottles of water were offered and we were able to take them throughout the trip if required.</p>\r\n<p>Sadly the hornblower boat trip had to be switched to a trip behind the falls due to the snow/ice but this is out of toniagara\'s control and we were advised of this change beforehand.</p>\r\n<p>Niagara on the lake was stunning and we loved wandering around the shops.</p>\r\n<p>All in all a great trip, well worth the money and well organised so thank you for a great day</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">C HINKSON</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 3:29 am - March 28, 2018. </div>\r\n                  <p>It was an amazing trip to the Niagara Falls.</p>\r\n<p>Haroom was an excellent tour guide and took care of all our needs. Lunch was excellent as well.\r\nI would definitely recommend this company to anyone who travels to Niagara Falls.</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">A NAUTIYAL</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i>  1:10 am - March 22, 2018. </div>\r\n                  <p>It was super amazing especially being the first time. worth the money and time.</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">ARPANA N</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 12:48 am - March 12, 2018. </div>\r\n                  <p>It was super awesome! It was our our very first experience and worth the money and time.</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                <li>\r\n                  <h3 class=\"name\">JANE T</h3>\r\n                  <div class=\"time\"><i class=\"fa fa-clock-o\"></i> 3:29 am - January 5, 2018.</div>\r\n                  <p>Great Day â€“ good value for manyâ€¦.company took our late booking and all arrangements were clear and easy to follow.</p>\r\n                  <div class=\"review_star\">\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  <i class=\"fa fa-star\"></i>\r\n                  </div>\r\n                </li>\r\n                   \r\n                </ul>', '<ul class=\"inclu_list\">\r\n            <li>Hornblower Cruise (seasonal) </li>\r\n            <li>Hotel pickup and drop-off </li>\r\n            <li>Wine Tasting At A Local Winery </li>\r\n            <li>Niagara-On-The-Lake Tour </li>\r\n            <li>Tour Guide </li>\r\n            <li>Unlimited Free Bottled Water </li>\r\n            <li>Wheelchair Access On Request* </li>\r\n            <li>Free Lanyards</li>\r\n          </ul>\r\n<div class=\"heading_add\"><i class=\"fa fa-plus-circle\"></i> Add-Ons</div>\r\n<ul class=\"addon_list\">\r\n            <li>Helicopter Ride (Add On) \r\n			</li><li>Buffet Lunch or Dinner (Add On) </li>\r\n            <li>Airport Drop-Off (Add On) </li>\r\n			<li>Next Day Pick Up (Add On) </li>\r\n          </ul>', '<p>We pickup and drop-off from most hotels in Toronto, Airport area hotels and Mississauga Hotels*</p>\r\n<p>You will be requested to enter the pickup location in the last step of online booking. Your pick up time will be mentioned in the booking confirmation.</p>', '<p>To change/cancel Niagara Falls Day/Evening/Private Tour dates please call or email us.<br>\r\nCustomers will receive a FULL REFUND if they call at least 24 hours ahead to cancel.<br>\r\nIf a Day or Evening Tour is cancelled less than 24 hours ahead NO REFUND will be provided.</p>\r\n<ul class=\"cencel\">\r\n<li>You are responsible for arriving on time to your Niagara Falls Bus Tour. The pickup vehicle will usually wait for a few minutes; however, if you arrive late and miss the tour, NO REFUND will be provided. ToNiagara will specify your pickup time and location through email.</li>\r\n\r\n<li>If, for any reason your tour is cancelled (due to inclement weather or other unforeseen circumstances), you will be notified as soon as possible and receive a FULL REFUND to your credit card or any other method of payment as applicable.</li>\r\n\r\n<li>Rescheduling your tour to another date is free of charge.</li>\r\n\r\n<li>To switch your tour from day tour to evening tour, custom tour or vice versa, you will have to pay the difference in the tour fee. There are no additional processing fees. If you are switching to a less expensive tour, ToNiagara will refund the difference to your credit card.</li>\r\n\r\n<li>In the rare event of a bus/vehicle breakdown all efforts will be made to continue the tour (another vehicle or vehicles may be sent to pick you up.) NO REFUND will be provided for any time lost on the tour or change in passenger vehicle. If the tour is cancelled due to bus/vehicle breakdown ToNiagara will be provide a full refund.</li>\r\n</ul>', '<p><br></p>', '20180816045121.jpg', '', '32132132132132132134163sd5fasdfasdfd', 1, '2018-08-16 14:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `ID` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(200) NOT NULL,
  `token` varchar(100) NOT NULL,
  `profile_image` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`ID`, `email`, `password`, `name`, `token`, `profile_image`, `status`, `created_on`) VALUES
(1, 'ashutosh2801@gmail.com', '123456', 'Ashutosh', '1234567899876543210', '20180816082248.jpg', 1, '2018-08-15 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_tours`
--
ALTER TABLE `tbl_tours`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `title` (`title`),
  ADD KEY `slug` (`slug`),
  ADD KEY `location` (`location`),
  ADD KEY `sub_title` (`sub_title`),
  ADD KEY `duration` (`duration`),
  ADD KEY `no_reviews` (`no_reviews`),
  ADD KEY `adults_price` (`adults_price`),
  ADD KEY `seniors_price` (`seniors_price`),
  ADD KEY `children_price` (`children_price`),
  ADD KEY `infants_price` (`infants_price`),
  ADD KEY `xola_code` (`xola_code`),
  ADD KEY `status` (`status`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `currency` (`currency`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `email` (`email`),
  ADD KEY `password` (`password`),
  ADD KEY `name` (`name`),
  ADD KEY `token` (`token`),
  ADD KEY `status` (`status`),
  ADD KEY `created_on` (`created_on`),
  ADD KEY `profile_image` (`profile_image`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_tours`
--
ALTER TABLE `tbl_tours`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
