/*
MySQL Data Transfer
Source Host: localhost
Source Database: paylater
Target Host: localhost
Target Database: paylater
Date: 1/16/2014 9:26:24 AM
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for users
-- ----------------------------
CREATE TABLE `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `dateofbirth` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `homeaddress` varchar(255) DEFAULT NULL,
  `telephonenumber` varchar(255) DEFAULT NULL,
  `alternativecontactnumber` varchar(255) DEFAULT NULL,
  `employmenttype` varchar(255) DEFAULT NULL,
  `nameofemployer` varchar(255) DEFAULT NULL,
  `officeaddress` varchar(255) DEFAULT NULL,
  `monthlyincome` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `link` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `users` VALUES ('2', 'Mr', 'Femi', 'Olanipekun', 'Male', '', 'iolufemi@ymail.com', 'skvlbhaksfva', '08045446378', '34567900', 'Self-Employed', 'ghcgjcgj', 'dgbrsdbgsr', '10000 - 50000', 'pending', 'http://www.paylater.com/users/updateuser/Femi/Olanipekun/iolufemi%40ymail.com/skvlbhaksfva/08045446378');
INSERT INTO `users` VALUES ('4', 'Miss', 'sdgbhsrgbs', 'sdbsdgbds', 'Male', '2014-01-14', 'xdbdsgbds@dsfbd.com', 'shdryhrhn', '02565452354', '02356545585', 'Self-Employed', 'dxhbdfxgbs', 'zdbdsbsdbs', '10000 - 50000', 'pending', 'http://www.paylater.com/users/updateuser/sdgbhsrgbs/sdbsdgbds/xdbdsgbds%40dsfbd.com/shdryhrhn/02565452354');
INSERT INTO `users` VALUES ('5', null, 'aewgrw', 'egegtr', null, null, 'awgrwe@sdrfse.com', 'segtwtehwry', '02565458796', null, null, null, null, null, 'pending', 'http://www.paylater.com/users/updateuser/aewgrw/egegtr/awgrwe%40sdrfse.com/segtwtehwry/02565458796');
INSERT INTO `users` VALUES ('6', 'Miss', 'Femi', 'Olanipekun', 'Female', '2014-01-16', 'olufemi@kvpafrica.com', 'asfrawfmabkrvaergarg', '2348056552980', '02565898785', 'Unemployed', '', 'sdbsebsebewr', '1000000 and Above', 'Active', 'http://www.paylater.com/users/updateuser');
