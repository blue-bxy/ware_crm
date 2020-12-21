/*
 Navicat Premium Data Transfer

 Source Server         : bxy
 Source Server Type    : MySQL
 Source Server Version : 80017
 Source Host           : localhost:3306
 Source Schema         : warehousemanagement

 Target Server Type    : MySQL
 Target Server Version : 80017
 File Encoding         : 65001

 Date: 17/02/2020 13:14:38
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for bus_customer
-- ----------------------------
DROP TABLE IF EXISTS `bus_customer`;
CREATE TABLE `bus_customer`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `customerphone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `connectionperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bankaccountnumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '银行卡账号',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `available` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_customer
-- ----------------------------
INSERT INTO `bus_customer` VALUES (1, '小张超市', '102627', '武汉', '027-9123131', '张大明', '18255944522', '中国银行', '654431331343413', '213123@sina.com', '430000', 1);
INSERT INTO `bus_customer` VALUES (2, '小明超市', '222', '深圳', '0755-9123131', '张小明', '13157118620', '中国银行', '654431331343413', '213123@sina.com', '430000', 1);
INSERT INTO `bus_customer` VALUES (3, '快七超市', '430000', '武汉', '027-11011011', '雷生', '18800325965', '招商银行', '6543123341334133', '6666@66.com', '545341', 1);

-- ----------------------------
-- Table structure for bus_goods
-- ----------------------------
DROP TABLE IF EXISTS `bus_goods`;
CREATE TABLE `bus_goods`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `goodsname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `produceplace` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `size` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `goodspackage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `productcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `promitcode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` double NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  `dangernum` int(11) NULL DEFAULT 0,
  `goodsimg` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `available` int(11) NULL DEFAULT NULL,
  `providerid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_sq0btr2v2lq8gt8b4gb8tlk0i`(`providerid`) USING BTREE,
  CONSTRAINT `bus_goods_ibfk_1` FOREIGN KEY (`providerid`) REFERENCES `bus_provider` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_goods
-- ----------------------------
INSERT INTO `bus_goods` VALUES (1, 'AD钙奶', '武汉', '120ML', '瓶', 'PH12345', 'PZ1234', '小孩子都爱的', 2, 488, 488, '2020020879ae5f737c82732adefd37c36ebcd99c.jpg', 1, 3);
INSERT INTO `bus_goods` VALUES (2, '旺旺雪饼', '仙桃', '包', '袋', 'PH12312312', 'PZ12312', '好吃不上火', 15, 1200, 1200, '202002029e6d39a8457ec04f22e8577d08f01a3b.jpg', 1, 1);
INSERT INTO `bus_goods` VALUES (3, '旺旺大礼包', '仙桃', '盒', '盒', 'VDFS322', 'FDVDFN32313', '过年必备', 28, 1021, 1021, '2020020255db4bbd6f4067dfd2e17293a23c25ad.jpg', 1, 1);
INSERT INTO `bus_goods` VALUES (4, '橙汁', '武汉', '200ML', '瓶', 'VFDSN238', 'VNDVN1230', '橙汁饮品', 3, 1100, 1100, '20200208301d001faab15a3b9083b625c6839eea.jpg', 1, 3);
INSERT INTO `bus_goods` VALUES (5, '娃哈哈矿泉水', '武汉', '300ML', '瓶', 'VDFVD319', 'SJSVL325', '2元矿泉水', 2, 1001, 1001, '202002083ba911b5a183ce983967713787244fcd.jpg', 1, 3);
INSERT INTO `bus_goods` VALUES (8, '铜锣烧', '上海', '箱', '箱', 'ASDCJ3545', ' LCXKFDV3344235', '一口一个', 200, 550, 550, '20200202522380a70e003104e5f47c14129c8457.png', 1, 2);
INSERT INTO `bus_goods` VALUES (10, '鸡蛋面包', '杭州', '50包/盒', '盒', 'FDVKDSK32-0', 'VDFMK3209', '浓浓鸡蛋味', 30, 200, 200, '20200202c43bc506a87819db84c3b723014ad41c.jpg', 1, 2);
INSERT INTO `bus_goods` VALUES (11, '达利园.派', '浙江', '30包', '袋', 'VFDVFV12367', 'SDVFDSB2324877', '好吃不腻', 20, 1000, 0, '202002082ccf4991e086bc3ef6774a5b9991b18a.jpg', 1, 2);

-- ----------------------------
-- Table structure for bus_inport
-- ----------------------------
DROP TABLE IF EXISTS `bus_inport`;
CREATE TABLE `bus_inport`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `paytype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inporttime` datetime(0) NULL DEFAULT NULL,
  `operateperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `inportprice` double NULL DEFAULT NULL,
  `providerid` int(11) NULL DEFAULT NULL,
  `goodsid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_1o4bujsyd2kl4iqw48fie224v`(`providerid`) USING BTREE,
  INDEX `FK_ho29poeu4o2dxu4rg1ammeaql`(`goodsid`) USING BTREE,
  CONSTRAINT `bus_inport_ibfk_1` FOREIGN KEY (`providerid`) REFERENCES `bus_provider` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `bus_inport_ibfk_2` FOREIGN KEY (`goodsid`) REFERENCES `bus_goods` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 15 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_inport
-- ----------------------------
INSERT INTO `bus_inport` VALUES (1, '微信', '2018-05-07 00:00:00', '张三', 100, '备注', 3000, 3, 1);
INSERT INTO `bus_inport` VALUES (2, '支付宝', '2018-05-07 00:00:00', '张三', 1000, '无', 2000, 1, 3);
INSERT INTO `bus_inport` VALUES (3, '银联', '2018-05-07 00:00:00', '张三', 100, '1231', 30000, 1, 3);
INSERT INTO `bus_inport` VALUES (4, '银联', '2018-05-07 00:00:00', '张三', 1000, '无', 20000, 3, 1);
INSERT INTO `bus_inport` VALUES (5, '银联', '2018-05-07 00:00:00', '张三', 100, '无', 10020, 3, 1);
INSERT INTO `bus_inport` VALUES (6, '银联', '2018-05-07 00:00:00', '张三', 100, '1231', 30000, 1, 2);
INSERT INTO `bus_inport` VALUES (8, '支付宝', '2018-05-07 00:00:00', '张三', 100, '', 3000, 3, 1);
INSERT INTO `bus_inport` VALUES (10, '支付宝', '2018-08-07 17:17:57', '超级管理员', 100, 'sadfasfdsa', 12900, 3, 1);
INSERT INTO `bus_inport` VALUES (11, '支付宝', '2018-09-17 16:12:25', '超级管理员', 21, '21', 23900, 1, 3);
INSERT INTO `bus_inport` VALUES (12, '微信', '2018-12-25 16:48:24', '超级管理员', 90, '好喝', 2900, 3, 1);
INSERT INTO `bus_inport` VALUES (14, '银联', '2020-02-01 00:00:00', '超级管理员', 50, '一口一个', 1000, 2, 8);

-- ----------------------------
-- Table structure for bus_outport
-- ----------------------------
DROP TABLE IF EXISTS `bus_outport`;
CREATE TABLE `bus_outport`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `providerid` int(11) NULL DEFAULT NULL,
  `paytype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `outputtime` datetime(0) NULL DEFAULT NULL,
  `operateperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `outportprice` double(10, 2) NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `goodsid` int(11) NULL DEFAULT NULL,
  `inportid` int(11) NULL DEFAULT NULL COMMENT '进货单id',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_outport
-- ----------------------------
INSERT INTO `bus_outport` VALUES (3, 2, '银联', '2020-02-01 16:49:09', '超级管理员', 500.00, 50, '商品过期', 8, 14);
INSERT INTO `bus_outport` VALUES (5, 3, '微信', '2020-02-01 17:11:12', '超级管理员', 290.00, 10, '质量不行', 1, 12);

-- ----------------------------
-- Table structure for bus_provider
-- ----------------------------
DROP TABLE IF EXISTS `bus_provider`;
CREATE TABLE `bus_provider`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `providername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `zip` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `providerphone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `connectionperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bank` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `bankaccountnumber` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `fax` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `available` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_provider
-- ----------------------------
INSERT INTO `bus_provider` VALUES (1, '旺旺食品', '434000', '仙桃', '0728-4124312', '小明', '13413441141', '中国农业银行', '654124345131', '12312321@sina.com', '5123123', 1);
INSERT INTO `bus_provider` VALUES (2, '达利园食品', '430000', '汉川', '0728-4124312', '大明', '13413441141', '中国农业银行', '654124345131', '12312321@sina.com', '5123123', 1);
INSERT INTO `bus_provider` VALUES (3, '娃哈哈集团', '513131', '杭州', '21312', '小晨', '12312', '建设银行', '512314141541', '123131', '312312', 1);

-- ----------------------------
-- Table structure for bus_sales
-- ----------------------------
DROP TABLE IF EXISTS `bus_sales`;
CREATE TABLE `bus_sales`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NULL DEFAULT NULL,
  `paytype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `salestime` datetime(0) NULL DEFAULT NULL,
  `operateperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `saleprice` decimal(10, 2) NULL DEFAULT NULL,
  `goodsid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_sales
-- ----------------------------
INSERT INTO `bus_sales` VALUES (1, 1, '微信', '2020-02-01 00:00:00', '超级管理员', 97, '销售100瓶', 2000.00, 1);

-- ----------------------------
-- Table structure for bus_salesback
-- ----------------------------
DROP TABLE IF EXISTS `bus_salesback`;
CREATE TABLE `bus_salesback`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerid` int(11) NULL DEFAULT NULL,
  `paytype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `salesbacktime` datetime(0) NULL DEFAULT NULL,
  `salebackprice` double(10, 2) NULL DEFAULT NULL,
  `operateperson` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `number` int(11) NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `goodsid` int(11) NULL DEFAULT NULL,
  `saleid` int(11) NULL DEFAULT NULL COMMENT '销售单ID',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of bus_salesback
-- ----------------------------
INSERT INTO `bus_salesback` VALUES (3, 1, '微信', '2020-02-02 11:26:41', 20.41, '超级管理员', 1, '质量存在问题', 1, 1);

-- ----------------------------
-- Table structure for sys_dept
-- ----------------------------
DROP TABLE IF EXISTS `sys_dept`;
CREATE TABLE `sys_dept`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NULL DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `open` int(11) NULL DEFAULT NULL,
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `available` int(11) NULL DEFAULT NULL COMMENT '状态【0不可用1可用】',
  `ordernum` int(11) NULL DEFAULT NULL COMMENT '排序码【为了调事显示顺序】',
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_dept
-- ----------------------------
INSERT INTO `sys_dept` VALUES (1, 0, '总经办', 1, '大BOSS', '深圳', 1, 1, 1575291349, 1580049705);
INSERT INTO `sys_dept` VALUES (2, 0, '销售部', 1, '程序员屌丝', '武汉', 1, 2, 1575291349, 1580269632);
INSERT INTO `sys_dept` VALUES (3, 1, '运营部', 0, '无', '武汉', 1, 3, 1575291349, 1575635505);
INSERT INTO `sys_dept` VALUES (4, 1, '生产部', 0, '无', '武汉', 1, 4, 1575291349, 1575635505);
INSERT INTO `sys_dept` VALUES (5, 2, '销售一部', 0, '销售一部', '武汉', 1, 5, 1575291349, 1575635505);
INSERT INTO `sys_dept` VALUES (6, 2, '销售二部', 0, '销售二部', '武汉', 1, 6, 1575291349, 1575635505);
INSERT INTO `sys_dept` VALUES (7, 3, '运营一部', 0, '运营一部', '武汉', 1, 7, 1575291349, 1575635505);
INSERT INTO `sys_dept` VALUES (18, 4, '生产一部', 0, '生产食品', '武汉', 1, 11, 1575291349, 1575635505);

-- ----------------------------
-- Table structure for sys_loginfo
-- ----------------------------
DROP TABLE IF EXISTS `sys_loginfo`;
CREATE TABLE `sys_loginfo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NULL DEFAULT NULL COMMENT '用户ID',
  `admin_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户姓名',
  `description` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '描述',
  `ip` char(60) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'IP地址',
  `status` int(3) NULL DEFAULT NULL COMMENT '200 成功 100 失败',
  `add_time` int(11) NULL DEFAULT NULL COMMENT '添加时间',
  `ipaddr` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'ip地区信息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 4962 CHARACTER SET = utf8 COLLATE = utf8_general_ci COMMENT = '日志表' ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_loginfo
-- ----------------------------
INSERT INTO `sys_loginfo` VALUES (4637, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1574420221, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4638, 1, 'admin', '管理员【kevin】禁用成功', '127.0.0.1', 200, 1574421291, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4639, 1, 'admin', '管理员【kevin】启用成功', '127.0.0.1', 200, 1574421292, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4640, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1574503089, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4641, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1574750792, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4642, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1576466029, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4643, 1, 'admin', '角色【系统测试员】禁用成功', '127.0.0.1', 200, 1576466231, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4644, 1, 'admin', '角色【系统测试员】启用成功', '127.0.0.1', 200, 1576466232, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4645, 1, 'admin', '角色【系统测试员】禁用成功', '127.0.0.1', 200, 1576466233, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4646, 1, 'admin', '角色【系统测试员】启用成功', '127.0.0.1', 200, 1576466234, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4647, 1, 'admin', '角色【系统测试员】禁用成功', '127.0.0.1', 200, 1576466237, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4648, 1, 'admin', '角色【系统测试员】启用成功', '127.0.0.1', 200, 1576466237, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4649, 1, 'admin', '批量禁用角色成功', '127.0.0.1', 200, 1576466293, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4650, 1, 'admin', '批量启用角色成功', '127.0.0.1', 200, 1576466299, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4651, 1, 'admin', '用户【admin】修复【think_admin】表成功', '127.0.0.1', 200, 1576466500, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4652, 1, 'admin', '用户【admin】修复【think_admin】表成功', '127.0.0.1', 200, 1576466503, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4653, 1, 'admin', '用户【admin】修复【think_area】表成功', '127.0.0.1', 200, 1576466505, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4654, 1, 'admin', '用户【admin】优化【think_admin】表成功', '127.0.0.1', 200, 1576466509, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4655, 1, 'admin', '用户【admin】优化【think_admin】表成功', '127.0.0.1', 200, 1576466514, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4656, 1, 'admin', '用户【admin】优化数据库成功', '127.0.0.1', 200, 1576466527, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4657, 1, 'admin', '用户【admin】优化数据库成功', '127.0.0.1', 200, 1576466539, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4658, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466553, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4659, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466553, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4660, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466553, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4661, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466554, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4662, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466554, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4663, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466554, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4664, 1, 'admin', '用户【admin】修复数据库成功', '127.0.0.1', 200, 1576466554, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4678, 1, 'admin', '日志【ID=4665】删除成功', '127.0.0.1', 200, 1579014646, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4679, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1579059782, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4686, 1, 'admin', '公告【ID=1】删除成功', '127.0.0.1', 200, 1579083769, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4687, 1, 'admin', '公告【关于系统V1.4更新公告1】更新成功', '127.0.0.1', 200, 1579086313, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4688, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1579086979, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4683, 1, 'admin', '日志批量删除成功', '127.0.0.1', 200, 1579083355, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4684, 1, 'admin', '日志批量删除成功', '127.0.0.1', 200, 1579083394, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4685, 1, 'admin', '公告批量删除成功', '127.0.0.1', 200, 1579083484, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4677, 1, 'admin', '日志【ID=4676】删除成功', '127.0.0.1', 200, 1579014635, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4689, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1579087069, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4690, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1579171299, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4691, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1579232734, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4735, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046210, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4734, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046141, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4733, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046091, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4732, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046010, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4731, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580045941, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4726, 1, 'admin', '日志【ID=4725】删除成功', '127.0.0.1', 200, 1580039879, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4719, 1, 'admin', '部门批量删除成功', '127.0.0.1', 200, 1580039604, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4720, 1, 'admin', '用户【admin】添加公告成功', '127.0.0.1', 200, 1580039640, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4721, 1, 'admin', '公告【ID=16】删除成功', '127.0.0.1', 200, 1580039647, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4727, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580045236, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4728, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580045367, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4729, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580045600, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4730, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580045692, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4736, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046455, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4737, 1, 'admin', '菜单批量删除成功', '127.0.0.1', 200, 1580046581, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4738, 1, 'admin', '菜单批量删除成功', '127.0.0.1', 200, 1580046638, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4739, 1, 'admin', '菜单批量删除成功', '127.0.0.1', 200, 1580046744, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4718, 1, 'admin', '日志批量删除成功', '127.0.0.1', 200, 1580039538, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4740, 1, 'admin', '菜单批量删除成功', '127.0.0.1', 200, 1580046766, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4741, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046814, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4742, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580046980, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4743, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580047035, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4744, 1, 'admin', '部门【基础管理1】更新成功', '127.0.0.1', 200, 1580048173, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4745, 1, 'admin', '部门【基础管理1】更新成功', '127.0.0.1', 200, 1580048401, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4746, 1, 'admin', '部门【基础管理1】更新成功', '127.0.0.1', 200, 1580048426, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4750, 1, 'admin', '菜单【基础管理】更新成功', '127.0.0.1', 200, 1580048706, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4749, 1, 'admin', '日志批量删除成功', '127.0.0.1', 200, 1580048637, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4751, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580048800, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4752, 1, 'admin', '菜单【基础管理2】更新成功', '127.0.0.1', 200, 1580048877, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4753, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580048933, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4754, 1, 'admin', '菜单【基础管理2】更新成功', '127.0.0.1', 200, 1580048993, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4755, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580049013, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4756, 1, 'admin', '菜单【基础管理2】更新成功', '127.0.0.1', 200, 1580049042, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4757, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580049097, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4758, 1, 'admin', '菜单【基础管理2】更新成功', '127.0.0.1', 200, 1580049142, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4759, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580049204, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4760, 1, 'admin', '菜单【基础管理2】更新成功', '127.0.0.1', 200, 1580049335, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4761, 1, 'admin', '菜单【基础管理】更新成功', '127.0.0.1', 200, 1580049391, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4762, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580049530, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4763, 1, 'admin', '菜单【基础管理】更新成功', '127.0.0.1', 200, 1580049561, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4764, 1, 'admin', '部门【总经办1】更新成功', '127.0.0.1', 200, 1580049645, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4765, 1, 'admin', '部门【总经办】更新成功', '127.0.0.1', 200, 1580049705, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4766, 1, 'admin', '公告【关于系统V1.3更新公告1】更新成功', '127.0.0.1', 200, 1580049730, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4767, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1580049775, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4768, 1, 'admin', '菜单【基础管理1】更新成功', '127.0.0.1', 200, 1580049789, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4769, 1, 'admin', '公告【关于系统V1.3更新公告1】更新成功', '127.0.0.1', 200, 1580049898, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4770, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1580050012, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4771, 1, 'admin', '公告【关于系统V1.3更新公告1】更新成功', '127.0.0.1', 200, 1580050051, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4772, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1580050110, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4773, 1, 'admin', '公告【关于系统V1.3更新公告1】更新成功', '127.0.0.1', 200, 1580050171, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4774, 1, 'admin', '公告【关于系统V1.3更新公告】更新成功', '127.0.0.1', 200, 1580050179, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4775, 1, 'admin', '菜单【基础管理】更新成功', '127.0.0.1', 200, 1580050193, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4776, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580050210, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4777, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580050415, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4778, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580050527, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4779, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580095269, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4780, 1, 'admin', '用户【admin】添加菜单成功', '127.0.0.1', 200, 1580095321, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4781, 1, 'admin', '权限批量删除成功', '127.0.0.1', 200, 1580101812, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4782, 1, 'admin', '权限【ID=30】删除成功', '127.0.0.1', 200, 1580101842, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4783, 1, 'admin', '用户【admin】添加权限成功', '127.0.0.1', 200, 1580102732, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4784, 1, 'admin', '权限【询问客户1】更新成功', '127.0.0.1', 200, 1580103394, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4785, 1, 'admin', '权限【询问客户1】更新成功', '127.0.0.1', 200, 1580103410, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4786, 1, 'admin', '用户【admin】添加角色成功', '127.0.0.1', 200, 1580113121, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4787, 1, 'admin', '角色【角色管理员1】更新成功', '127.0.0.1', 200, 1580113946, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4788, 1, 'admin', '角色【角色管理员1】更新成功', '127.0.0.1', 200, 1580113976, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4789, 1, 'admin', '角色【角色管理员1】更新成功', '127.0.0.1', 200, 1580114004, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4790, 1, 'admin', '角色【角色管理员1】更新成功', '127.0.0.1', 200, 1580114017, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4791, 1, 'admin', '角色批量删除成功', '127.0.0.1', 200, 1580114332, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4792, 1, 'admin', '用户【admin】添加角色成功', '127.0.0.1', 200, 1580114532, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4813, 4, 'zl', '管理员【zl】登录成功', '127.0.0.1', 200, 1580304609, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4812, 3, 'ww', '管理员【ww】登录成功', '127.0.0.1', 200, 1580304400, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4811, 2, 'ls', '管理员【ls】登录成功', '127.0.0.1', 200, 1580304032, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4810, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580302477, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4809, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580286327, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4808, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580283113, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4807, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580282620, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4806, 1, 'admin', '部门【销售部】更新成功', '127.0.0.1', 200, 1580269632, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4805, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580265026, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4804, 1, 'admin', '日志批量删除成功', '127.0.0.1', 200, 1580219078, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4814, 5, 'sq', '管理员【sq】登录成功', '127.0.0.1', 200, 1580304679, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4815, 6, 'lb', '管理员【lb】登录成功', '127.0.0.1', 200, 1580304771, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4816, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580304843, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4817, 1, 'admin', '用户【admin】添加用户成功', '127.0.0.1', 200, 1580355557, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4818, 7, '无枝可依', '管理员【无枝可依】登录成功', '127.0.0.1', 200, 1580355778, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4819, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580355827, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4820, 1, 'admin', '用户【Bob】更新成功', '127.0.0.1', 200, 1580359516, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4821, 1, 'admin', '用户【Bob】更新成功', '127.0.0.1', 200, 1580363849, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4822, 1, 'admin', '用户批量删除成功', '127.0.0.1', 200, 1580367768, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4823, 1, 'admin', '用户【admin】添加1用户成功', '127.0.0.1', 200, 1580373360, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4824, 1, 'admin', '用户【ID=8】删除成功', '127.0.0.1', 200, 1580373374, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4825, 2, 'ls', '管理员【ls】登录成功', '127.0.0.1', 200, 1580373724, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4826, 2, 'ls', '用户【ID=2】删除成功', '127.0.0.1', 200, 1580373749, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4827, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580373814, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4828, 1, 'admin', '管理员【超级管理员】修改密码失败', '127.0.0.1', 100, 1580384064, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4829, 1, 'admin', '管理员【超级管理员】修改密码失败', '127.0.0.1', 100, 1580384241, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4830, 1, 'admin', '管理员【超级管理员】修改密码成功', '127.0.0.1', 200, 1580384347, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4831, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580384373, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4832, 1, 'admin', '管理员【超级管理员】修改密码成功', '127.0.0.1', 200, 1580384503, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4833, 1, 'admin', '管理员【admin】登录成功', '127.0.0.1', 200, 1580384571, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4834, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580442948, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4835, 1, 'admin', '客户【小张超市】禁用成功', '127.0.0.1', 200, 1580442995, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4836, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580443005, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4837, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580443072, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4838, 1, 'admin', '客户【小张超市】禁用成功', '127.0.0.1', 200, 1580443077, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4839, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580443086, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4840, 1, 'admin', '客户【小张超市】禁用成功', '127.0.0.1', 200, 1580444247, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4841, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580444250, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4842, 1, 'admin', '客户【小明超市】禁用成功', '127.0.0.1', 200, 1580444256, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4843, 1, 'admin', '客户【小明超市】启用成功', '127.0.0.1', 200, 1580444262, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4844, 1, 'admin', '用户【admin】添加客户成功', '127.0.0.1', 200, 1580448609, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4845, 1, 'admin', '用户【admin】添加客户成功', '127.0.0.1', 200, 1580448855, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4846, 1, 'admin', '客户【小张超市】更新成功', '127.0.0.1', 200, 1580449423, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4847, 1, 'admin', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580449436, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4848, 1, 'admin', '客户【12】更新成功', '127.0.0.1', 200, 1580449475, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4849, 1, 'admin', '客户批量删除成功', '127.0.0.1', 200, 1580449638, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4850, 1, 'admin', '客户【ID=4】删除成功', '127.0.0.1', 200, 1580449782, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4851, 1, 'admin', '供应商【旺旺食品】禁用成功', '127.0.0.1', 200, 1580451351, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4852, 1, 'admin', '供应商【旺旺食品】启用成功', '127.0.0.1', 200, 1580451354, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4853, 1, 'admin', '用户【admin】添加供应商成功', '127.0.0.1', 200, 1580451399, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4854, 1, 'admin', '供应商【1】更新成功', '127.0.0.1', 200, 1580451429, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4855, 1, 'admin', '供应商【2】更新成功', '127.0.0.1', 200, 1580451443, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4856, 1, 'admin', '供应商【2】启用成功', '127.0.0.1', 200, 1580451448, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4857, 1, 'admin', '用户【admin】添加供应商成功', '127.0.0.1', 200, 1580451489, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4858, 1, 'admin', '用户【admin】添加供应商成功', '127.0.0.1', 200, 1580451525, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4859, 1, 'admin', '供应商【ID=6】删除成功', '127.0.0.1', 200, 1580451601, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4860, 1, 'admin', '供应商批量删除成功', '127.0.0.1', 200, 1580451610, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4861, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580452959, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4862, 1, '超级管理员', '管理员【超级管理员】修改密码成功', '127.0.0.1', 200, 1580457158, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4863, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580457172, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4864, 1, '超级管理员', '商品【娃哈哈】禁用成功', '127.0.0.1', 200, 1580465521, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4865, 1, '超级管理员', '商品【娃哈哈】启用成功', '127.0.0.1', 200, 1580465524, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4866, 1, '超级管理员', '商品【10】更新成功', '127.0.0.1', 200, 1580468547, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4867, 1, '超级管理员', '商品【2】启用成功', '127.0.0.1', 200, 1580468592, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4868, 1, '超级管理员', '商品【ID=7】删除成功', '127.0.0.1', 200, 1580468603, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4869, 1, '超级管理员', '商品批量删除成功', '127.0.0.1', 200, 1580468613, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4870, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580526742, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4871, 1, '超级管理员', '商品【娃哈哈】禁用成功', '127.0.0.1', 200, 1580526790, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4872, 1, '超级管理员', '商品【娃哈哈】启用成功', '127.0.0.1', 200, 1580526793, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4873, 1, '超级管理员', '用户【admin】添加商品进货成功', '127.0.0.1', 200, 1580538544, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4874, 1, '超级管理员', '用户【admin】添加商品成功', '127.0.0.1', 200, 1580538945, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4875, 1, '超级管理员', '用户【admin】添加商品进货成功', '127.0.0.1', 200, 1580539002, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4876, 1, '超级管理员', '商品进货信息【】更新成功', '127.0.0.1', 200, 1580540919, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4877, 1, '超级管理员', '商品进货信息【12】更新成功', '127.0.0.1', 200, 1580540983, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4878, 1, '超级管理员', '商品进货信息【14】更新成功', '127.0.0.1', 200, 1580541467, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4879, 1, '超级管理员', '用户【admin】添加商品进货成功', '127.0.0.1', 200, 1580541797, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4880, 1, '超级管理员', '商品进货【ID=15】删除成功', '127.0.0.1', 200, 1580541813, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4881, 1, '超级管理员', '商品进货批量删除成功', '127.0.0.1', 200, 1580541822, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4882, 1, '超级管理员', '商品进货信息【3】更新成功', '127.0.0.1', 200, 1580542595, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4883, 1, '超级管理员', '商品进货信息【2】更新成功', '127.0.0.1', 200, 1580542614, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4884, 1, '超级管理员', '商品进货信息【1】更新成功', '127.0.0.1', 200, 1580542628, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4885, 1, '超级管理员', '商品【铜锣烧】退货成功', '127.0.0.1', 200, 1580546949, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4886, 1, '超级管理员', '商品【铜锣烧】退货成功', '127.0.0.1', 200, 1580547439, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4887, 1, '超级管理员', '商品进货信息【14】更新成功', '127.0.0.1', 200, 1580548237, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4888, 1, '超级管理员', '商品【娃哈哈小瓶】退货成功', '127.0.0.1', 200, 1580548272, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4889, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580551642, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4890, 1, '超级管理员', '用户【admin】添加商品销售成功', '127.0.0.1', 200, 1580555761, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4891, 1, '超级管理员', '商品销售信息【1】更新成功', '127.0.0.1', 200, 1580556912, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4892, 1, '超级管理员', '商品销售信息【1】更新成功', '127.0.0.1', 200, 1580557169, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4893, 1, '超级管理员', '商品销售信息【1】更新成功', '127.0.0.1', 200, 1580557179, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4894, 1, '超级管理员', '用户【admin】添加商品销售成功', '127.0.0.1', 200, 1580557430, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4895, 1, '超级管理员', '用户【admin】添加商品销售成功', '127.0.0.1', 200, 1580557444, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4896, 1, '超级管理员', '商品销售【ID=3】删除成功', '127.0.0.1', 200, 1580557451, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4897, 1, '超级管理员', '商品销售批量删除成功', '127.0.0.1', 200, 1580557459, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4898, 1, '超级管理员', '销售商品【娃哈哈小瓶】退货成功', '127.0.0.1', 200, 1580558781, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4899, 1, '超级管理员', '销售商品【娃哈哈小瓶】退货成功', '127.0.0.1', 200, 1580558921, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4900, 1, '超级管理员', '商品销售退还信息批量删除成功', '127.0.0.1', 200, 1580560967, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4901, 1, '超级管理员', '商品退还信息批量删除成功', '127.0.0.1', 200, 1580560978, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4902, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580613053, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4903, 1, '超级管理员', '商品销售退还信息批量删除成功', '127.0.0.1', 200, 1580613968, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4904, 1, '超级管理员', '销售商品【娃哈哈小瓶】退货成功', '127.0.0.1', 200, 1580614001, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4905, 1, '超级管理员', '用户【admin】添加商品成功', '127.0.0.1', 200, 1580634006, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4906, 1, '超级管理员', '用户【admin】添加商品成功', '127.0.0.1', 200, 1580634244, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4907, 1, '超级管理员', '商品【鸡蛋面包】更新成功', '127.0.0.1', 200, 1580637449, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4908, 1, '超级管理员', '商品【娃哈哈小瓶】更新成功', '127.0.0.1', 200, 1580637771, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4909, 1, '超级管理员', '商品【旺旺雪饼[小包]】更新成功', '127.0.0.1', 200, 1580637803, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4910, 1, '超级管理员', '商品【旺旺大礼包】更新成功', '127.0.0.1', 200, 1580637823, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4911, 1, '超级管理员', '商品【娃哈哈大瓶】更新成功', '127.0.0.1', 200, 1580637857, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4912, 1, '超级管理员', '商品【娃哈哈中瓶】更新成功', '127.0.0.1', 200, 1580637886, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4913, 1, '超级管理员', '商品【铜锣烧】更新成功', '127.0.0.1', 200, 1580637908, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4914, 1, '超级管理员', '商品【鸡蛋面包】更新成功', '127.0.0.1', 200, 1580637929, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4915, 1, '超级管理员', '商品【娃哈哈大瓶】更新成功', '127.0.0.1', 200, 1580646886, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4916, 1, '超级管理员', '商品【橙汁】更新成功', '127.0.0.1', 200, 1580647221, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4917, 1, '超级管理员', '商品【AD钙奶】更新成功', '127.0.0.1', 200, 1580647331, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4918, 1, '超级管理员', '商品【旺旺雪饼】更新成功', '127.0.0.1', 200, 1580647356, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4919, 1, '超级管理员', '商品【娃哈哈矿泉水】更新成功', '127.0.0.1', 200, 1580647394, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4920, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580702011, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4921, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580702664, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4922, 1, '超级管理员', '商品【旺旺大礼包】更新成功', '127.0.0.1', 200, 1580707422, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4923, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580783532, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4924, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580785473, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4941, 4, '赵六', '管理员【zl】登录成功', '127.0.0.1', 200, 1580793918, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4940, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580793893, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4939, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580793594, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4938, 4, '赵六', '用户【Bob】更新成功', '127.0.0.1', 200, 1580788644, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4937, 4, '赵六', '用户【Bob】更新成功', '127.0.0.1', 200, 1580788637, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4936, 4, '赵六', '管理员【zl】登录成功', '127.0.0.1', 200, 1580788583, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4935, 1, '超级管理员', '日志批量删除成功', '127.0.0.1', 200, 1580787487, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4942, 4, '赵六', '角色【系统管理员】分配权限成功', '127.0.0.1', 200, 1580793963, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4943, 4, '赵六', '管理员【zl】登录成功', '127.0.0.1', 200, 1580793992, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4944, 1, '超级管理员', '角色【销售管理员】更新成功', '127.0.0.1', 200, 1580813076, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4945, 1, '超级管理员', '角色【销售管理员】更新成功', '127.0.0.1', 200, 1580814801, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4946, 1, '超级管理员', '角色【销售管理员】更新成功', '127.0.0.1', 200, 1580815192, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4947, 1, '超级管理员', '角色【销售管理员】更新成功', '127.0.0.1', 200, 1580815215, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4948, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580887109, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4949, 1, '超级管理员', '客户【小张超市】禁用成功', '127.0.0.1', 200, 1580900241, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4950, 1, '超级管理员', '客户【小张超市】启用成功', '127.0.0.1', 200, 1580900244, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4951, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1580960966, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4952, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1581050911, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4953, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1581086494, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4954, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1581155305, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4955, 1, '超级管理员', '商品【橙汁】更新成功', '127.0.0.1', 200, 1581155400, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4956, 1, '超级管理员', '商品【娃哈哈矿泉水】更新成功', '127.0.0.1', 200, 1581155451, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4957, 1, '超级管理员', '用户【admin】添加商品成功', '127.0.0.1', 200, 1581166206, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4958, 1, '超级管理员', '商品【AD钙奶】更新成功', '127.0.0.1', 200, 1581166404, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4959, 1, '超级管理员', '商品【AD钙奶】更新成功', '127.0.0.1', 200, 1581166444, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4960, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1581234224, '内网IP');
INSERT INTO `sys_loginfo` VALUES (4961, 1, '超级管理员', '管理员【admin】登录成功', '127.0.0.1', 200, 1581841131, '内网IP');

-- ----------------------------
-- Table structure for sys_notice
-- ----------------------------
DROP TABLE IF EXISTS `sys_notice`;
CREATE TABLE `sys_notice`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `opername` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_notice
-- ----------------------------
INSERT INTO `sys_notice` VALUES (11, '关于系统V1.1更新公告', '21321321321<img src=\"/resources/layui/images/face/18.gif\" alt=\"[右哼哼]\">', '超级管理员', 1575045926, 1575535566);
INSERT INTO `sys_notice` VALUES (12, '关于系统V1.3更新公告', '<p><br/></p><ul style=\"padding: 5px 0px 5px 15px; -webkit-tap-highlight-color: rgba(232, 230, 227, 0); color: rgb(195, 191, 182); font-family: &quot;Helvetica Neue&quot;, Helvetica, &quot;PingFang SC&quot;, Tahoma, Arial, sans-serif; font-size: 14px; white-space: normal; background-color: rgb(24, 26, 27);\" class=\" list-paddingleft-2\"><li><p>[优化] layui.use() 方法，以支持加载非内置模块的合并请求（如您在线上环境采用「非模块化加载」的方式，那么最多可以只加载两个文件，即：layui.all.js、main.js(你的扩展模块的合并文件)。这将大幅度减少文件请求）&nbsp;<a href=\"https://www.layui.com/doc/#allmodules\" target=\"_blank\" style=\"color: rgb(62, 200, 254); text-decoration-line: none;\">#详见文档</a></p></li><li><p>[新增] layui.url() 底层方法，用于将 url 中的 pathname、search、hash 属性进行对象化获取&nbsp;<a href=\"https://www.layui.com/doc/base/infrastructure.html#other\" target=\"_blank\" style=\"color: rgb(62, 200, 254); text-decoration-line: none;\">#详见文档</a></p></li><li><p>[优化] 栅格的列间隔类 .layui-col-space，支持 1-30 区间所有双数间隔，并支持 1、5、15、25 单数间隔</p></li><li><p>[优化] table 组件的合计行，若接口直接返回了合计行数据，则优先读取，否则由前端自动合计当前行数据&nbsp;<a href=\"https://www.layui.com/doc/modules/table.html#totalRow\" target=\"_blank\" style=\"color: rgb(62, 200, 254); text-decoration-line: none;\">#详见文档</a></p></li><li><p>[修复] upload 组件因上个版本的 progress（进度条） 功能导致的部分情况无法跨域上传的问题</p></li><li><p>[优化] upload 组件 progress 回调，在第二个参数中返回了当前触发的元素对象</p></li><li><p>[修复] form 模块的 select 组件在 lay-disabled 和 lay-search 共用时出现可编辑问题</p></li><li><p>[修复] flow.load() 多次执行时的重复加载的问题</p></li><li><p>[修复] util 组件的 event 方法重复绑定事件的问题</p></li></ul><p><br/></p>', 'admin', 1579082117, 1580050179);

-- ----------------------------
-- Table structure for sys_permission
-- ----------------------------
DROP TABLE IF EXISTS `sys_permission`;
CREATE TABLE `sys_permission`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NULL DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权限类型[menu/permission]',
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `percode` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '权限编码[只有type= permission才有  user:view]',
  `icon` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `href` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `open` int(11) NULL DEFAULT NULL,
  `ordernum` int(11) NULL DEFAULT NULL,
  `available` int(11) NULL DEFAULT NULL COMMENT '状态【0不可用1可用】',
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  `delete_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 112 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_permission
-- ----------------------------
INSERT INTO `sys_permission` VALUES (2, 0, 'menu', '基础管理', NULL, 'layui-icon-slider', '#', 1, 2, 1, 1446535750, 1580050193, NULL);
INSERT INTO `sys_permission` VALUES (3, 0, 'menu', '进货管理', NULL, 'layui-icon-gift', '#', 0, 3, 1, 1446535750, 1540544544, NULL);
INSERT INTO `sys_permission` VALUES (4, 0, 'menu', '销售管理', NULL, 'layui-icon-service', '#', 0, 4, 1, 1446535750, 1540434868, NULL);
INSERT INTO `sys_permission` VALUES (5, 0, 'menu', '系统管理', NULL, 'layui-icon-set', '#', 0, 5, 1, 1446535750, 1540434958, NULL);
INSERT INTO `sys_permission` VALUES (6, 0, 'menu', '其它管理', NULL, 'layui-icon-engine', '#', 0, 6, 1, 1446535750, 1477312169, NULL);
INSERT INTO `sys_permission` VALUES (7, 2, 'menu', '客户管理', NULL, 'layui-icon-username', 'admin/customer/customer', 0, 7, 1, 1446535750, 1540435124, NULL);
INSERT INTO `sys_permission` VALUES (8, 2, 'menu', '供应商管理', NULL, 'layui-icon-rate-solid', 'admin/provider/provider', 0, 8, 1, 1477312169, 1540435130, NULL);
INSERT INTO `sys_permission` VALUES (9, 2, 'menu', '商品管理', NULL, 'layui-icon-app', 'admin/goods/goods', 0, 9, 1, 1477312169, 1540435138, NULL);
INSERT INTO `sys_permission` VALUES (10, 3, 'menu', '商品进货', NULL, 'layui-icon-cart-simple', 'admin/inport/inport', 0, 10, 1, 1477312169, 1540434790, NULL);
INSERT INTO `sys_permission` VALUES (11, 3, 'menu', '商品退货查询', NULL, 'layui-icon-survey', 'admin/outport/outport', 0, 11, 1, 1477312169, 1540434808, NULL);
INSERT INTO `sys_permission` VALUES (12, 4, 'menu', '商品销售', NULL, 'layui-icon-component', 'admin/sale/sale', 0, 12, 1, 1477312169, 1540434818, NULL);
INSERT INTO `sys_permission` VALUES (13, 4, 'menu', '销售退货查询', NULL, 'layui-icon-search', 'admin/SaleBack/saleback', 0, 13, 1, 1477312169, 1540434834, NULL);
INSERT INTO `sys_permission` VALUES (14, 5, 'menu', '部门管理', NULL, 'layui-icon-group', 'admin/dept/dept', 0, 14, 1, 1477312169, 1477312169, NULL);
INSERT INTO `sys_permission` VALUES (15, 5, 'menu', '菜单管理', NULL, 'layui-icon-template\r\n ', 'admin/menu/menu', 0, 15, 1, 1477312169, 1540435216, NULL);
INSERT INTO `sys_permission` VALUES (16, 5, 'menu', '权限管理', '', 'layui-icon-senior', 'admin/permission/permission', 0, 16, 1, 1477312169, 1540435224, NULL);
INSERT INTO `sys_permission` VALUES (17, 5, 'menu', '角色管理', '', 'layui-icon-face-smile-fine', 'admin/role/role', 0, 17, 1, 1477312169, 1477312169, NULL);
INSERT INTO `sys_permission` VALUES (18, 5, 'menu', '用户管理', '', 'layui-icon-friends', 'admin/user/user', 0, 18, 1, 1477312333, 1477312333, NULL);
INSERT INTO `sys_permission` VALUES (21, 6, 'menu', '行为日志', NULL, 'layui-icon-log', 'admin/OperateLog/operate_log', 0, 21, 1, 1477639870, 1540435152, NULL);
INSERT INTO `sys_permission` VALUES (22, 6, 'menu', '系统公告', NULL, 'layui-icon-list', 'admin/Notice/show_notice', 0, 22, 1, 1477639972, 1540435166, NULL);
INSERT INTO `sys_permission` VALUES (23, 6, 'menu', '图标管理', NULL, 'layui-icon-water', 'admin/icon/icon', 0, 23, 1, 1477640011, 1540435179, NULL);
INSERT INTO `sys_permission` VALUES (30, 14, 'permission', '添加部门', 'dept:create', '', NULL, 0, 24, 1, 1477640011, 1580101842, NULL);
INSERT INTO `sys_permission` VALUES (31, 14, 'permission', '修改部门', 'dept:update', '', NULL, 0, 26, 1, 1477640011, 1580101812, NULL);
INSERT INTO `sys_permission` VALUES (32, 14, 'permission', '删除部门', 'dept:delete', '', NULL, 0, 27, 1, 1477640011, 1540434901, NULL);
INSERT INTO `sys_permission` VALUES (34, 15, 'permission', '添加菜单', 'menu:create', '', '', 0, 29, 1, 1477640011, 1540434918, NULL);
INSERT INTO `sys_permission` VALUES (35, 15, 'permission', '修改菜单', 'menu:update', '', NULL, 0, 30, 1, 1477640011, 1540434950, NULL);
INSERT INTO `sys_permission` VALUES (36, 15, 'permission', '删除菜单', 'menu:delete', '', NULL, 0, 31, 1, 1477640011, 1540434966, NULL);
INSERT INTO `sys_permission` VALUES (38, 16, 'permission', '添加权限', 'permission:create', '', NULL, 0, 33, 1, 1477640011, 1540434982, NULL);
INSERT INTO `sys_permission` VALUES (39, 16, 'permission', '修改权限', 'permission:update', '', NULL, 0, 34, 1, 1477640011, 1540434991, NULL);
INSERT INTO `sys_permission` VALUES (40, 16, 'permission', '删除权限', 'permission:delete', '', NULL, 0, 35, 1, 1477640011, 1540435007, NULL);
INSERT INTO `sys_permission` VALUES (42, 17, 'permission', '添加角色', 'role:create', '', NULL, 0, 37, 1, 1477640011, 1540435014, NULL);
INSERT INTO `sys_permission` VALUES (43, 17, 'permission', '修改角色', 'role:update', '', NULL, 0, 38, 1, 1477640011, 1477640011, NULL);
INSERT INTO `sys_permission` VALUES (44, 17, 'permission', '角色删除', 'role:delete', '', NULL, 0, 39, 1, 1477640011, 1477640011, NULL);
INSERT INTO `sys_permission` VALUES (46, 17, 'permission', '分配权限', 'role:selectPermission', '', NULL, 0, 41, 1, 1477640011, 1477640011, NULL);
INSERT INTO `sys_permission` VALUES (47, 18, 'permission', '添加用户', 'user:create', '', NULL, 0, 42, 1, 1477640011, 1477640011, NULL);
INSERT INTO `sys_permission` VALUES (48, 18, 'permission', '修改用户', 'user:update', '', NULL, 0, 43, 1, 1479908607, 1540435030, NULL);
INSERT INTO `sys_permission` VALUES (49, 18, 'permission', '删除用户', 'user:delete', '', NULL, 0, 44, 1, 1479908607, 1540435036, NULL);
INSERT INTO `sys_permission` VALUES (51, 18, 'permission', '用户分配角色', 'user:selectRole', '', NULL, 0, 46, 1, 1479908607, 1540435042, NULL);
INSERT INTO `sys_permission` VALUES (52, 18, 'permission', '重置密码', 'user:resetPwd', NULL, NULL, 0, 47, 1, 1479908607, 1540435049, NULL);
INSERT INTO `sys_permission` VALUES (53, 14, 'permission', '部门查询', 'dept:view', NULL, NULL, 0, 48, 1, 1479908607, 1540435066, NULL);
INSERT INTO `sys_permission` VALUES (54, 15, 'permission', '菜单查询', 'menu:view', NULL, NULL, 0, 49, 1, 1480316438, 1540435096, NULL);
INSERT INTO `sys_permission` VALUES (55, 16, 'permission', '权限查询', 'permission:view', NULL, NULL, 0, 50, 1, 1522485859, 1540435103, NULL);
INSERT INTO `sys_permission` VALUES (56, 17, 'permission', '角色查询', 'role:view', NULL, NULL, 0, 51, 1, 1522824567, 1540435110, NULL);
INSERT INTO `sys_permission` VALUES (57, 18, 'permission', '用户查询', 'user:view', NULL, NULL, 0, 52, 1, 1523161011, 1540435145, NULL);
INSERT INTO `sys_permission` VALUES (68, 7, 'permission', '客户查询', 'customer:view', NULL, NULL, NULL, 60, 1, 1524645295, 1540434827, NULL);
INSERT INTO `sys_permission` VALUES (69, 7, 'permission', '客户添加', 'customer:create', NULL, NULL, NULL, 61, 1, 1524648181, 1540434911, NULL);
INSERT INTO `sys_permission` VALUES (70, 7, 'permission', '客户修改', 'customer:update', NULL, NULL, NULL, 62, 1, 1524653771, 1540434997, NULL);
INSERT INTO `sys_permission` VALUES (71, 7, 'permission', '客户删除', 'customer:delete', NULL, NULL, NULL, 63, 1, 1524653826, 1540435059, NULL);
INSERT INTO `sys_permission` VALUES (73, 21, 'permission', '日志查询', 'info:view', NULL, NULL, NULL, 65, 1, 1524654090, 1530680741, NULL);
INSERT INTO `sys_permission` VALUES (74, 21, 'permission', '日志删除', 'info:delete', NULL, NULL, NULL, 66, 1, 1524654233, 1540435231, NULL);
INSERT INTO `sys_permission` VALUES (75, 21, 'permission', '日志批量删除', 'info:batchdelete', NULL, NULL, NULL, 67, 1, 1524805218, 1540435185, NULL);
INSERT INTO `sys_permission` VALUES (76, 22, 'permission', '公告查询', 'notice:view', NULL, NULL, NULL, 68, 1, 1524876437, 1542268663, NULL);
INSERT INTO `sys_permission` VALUES (77, 22, 'permission', '公告添加', 'notice:create', NULL, NULL, NULL, 69, 1, 1524879234, 1542268679, NULL);
INSERT INTO `sys_permission` VALUES (78, 22, 'permission', '公告修改', 'notice:update', NULL, NULL, NULL, 70, 1, 1524879401, 1525252090, NULL);
INSERT INTO `sys_permission` VALUES (79, 22, 'permission', '公告删除', 'notice:delete', NULL, NULL, NULL, 71, 1, 1524883447, 1524887249, NULL);
INSERT INTO `sys_permission` VALUES (81, 8, 'permission', '供应商查询', 'provider:view', NULL, NULL, NULL, 73, 1, 1524883471, 1524887260, NULL);
INSERT INTO `sys_permission` VALUES (82, 8, 'permission', '供应商添加', 'provider:create', NULL, NULL, NULL, 74, 1, 1524883489, 1524887285, NULL);
INSERT INTO `sys_permission` VALUES (83, 8, 'permission', '供应商修改', 'provider:update', NULL, NULL, NULL, 75, 1, 1524886031, 1524887304, NULL);
INSERT INTO `sys_permission` VALUES (84, 8, 'permission', '供应商删除', 'provider:delete', NULL, NULL, NULL, 76, 1, 1524886803, 1542267144, NULL);
INSERT INTO `sys_permission` VALUES (86, 22, 'permission', '公告查看', 'notice:viewnotice', NULL, NULL, NULL, 78, 1, 1526277389, 1542267155, NULL);
INSERT INTO `sys_permission` VALUES (91, 9, 'permission', '商品查询', 'goods:view', NULL, NULL, 0, 79, 1, 1529631518, 1540519615, NULL);
INSERT INTO `sys_permission` VALUES (92, 9, 'permission', '商品添加', 'goods:create', NULL, NULL, 0, 80, 1, 1530238799, 1540434840, NULL);

-- ----------------------------
-- Table structure for sys_role
-- ----------------------------
DROP TABLE IF EXISTS `sys_role`;
CREATE TABLE `sys_role`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `rules` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '角色权限   SUPERAUTH：超级权限',
  `remark` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '备注',
  `available` int(11) NULL DEFAULT NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_role
-- ----------------------------
INSERT INTO `sys_role` VALUES (1, '超级管理员', 'SUPERAUTH', '拥有所有菜单权限', 1, 1446535750, 1446535750);
INSERT INTO `sys_role` VALUES (4, '系统管理员', '5,14,30,31,32,53,15,34,35,36,54,16,38,39,40,55,17,42,43,44,46,56,18,47,48,49,51,57,6,21,73,74,75,22,76,77,78,79,86,23', '管理系统管理', 1, 1477312169, 1580793962);
INSERT INTO `sys_role` VALUES (5, '仓库管理员', '2,7,68,69,70,71,8,81,82,83,84,9,91,92,3,10,11', '仓库管理员', 1, 1446535750, 1580218628);
INSERT INTO `sys_role` VALUES (6, '销售管理员', '4,12,13', '销售管理员', 1, 1446535750, 1580815215);

-- ----------------------------
-- Table structure for sys_role_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_role_user`;
CREATE TABLE `sys_role_user`  (
  `rid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  PRIMARY KEY (`uid`, `rid`) USING BTREE,
  INDEX `FK_203gdpkwgtow7nxlo2oap5jru`(`rid`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_role_user
-- ----------------------------
INSERT INTO `sys_role_user` VALUES (1, 1);
INSERT INTO `sys_role_user` VALUES (4, 4);
INSERT INTO `sys_role_user` VALUES (5, 3);
INSERT INTO `sys_role_user` VALUES (5, 7);
INSERT INTO `sys_role_user` VALUES (6, 6);

-- ----------------------------
-- Table structure for sys_user
-- ----------------------------
DROP TABLE IF EXISTS `sys_user`;
CREATE TABLE `sys_user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `loginname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sex` int(11) NULL DEFAULT NULL COMMENT '0：男 1：女',
  `remark` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `deptid` int(11) NULL DEFAULT NULL,
  `pid` int(11) NULL DEFAULT NULL COMMENT '直属领导id',
  `available` int(11) NULL DEFAULT 1,
  `ordernum` int(11) NULL DEFAULT NULL,
  `type` int(255) NULL DEFAULT NULL COMMENT '用户类型[0超级管理员1，管理员，2普通用户]',
  `imgpath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '头像地址',
  `hiredate` datetime(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `FK_3rrcpvho2w1mx1sfiuuyir1h`(`deptid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of sys_user
-- ----------------------------
INSERT INTO `sys_user` VALUES (1, '超级管理员', 'admin', '系统深处的男人', 0, '超级管理员', 'e10adc3949ba59abbe56e057f20f883e', 1, NULL, 1, 1, 0, '/uploads/face/20200129/4090aeef97eba1a25f871a45ce2792d7.png', '2020-01-29 16:23:50');
INSERT INTO `sys_user` VALUES (3, '王五', 'ww', '武汉', 1, '仓库管理员', 'e10adc3949ba59abbe56e057f20f883e', 3, 1, 0, 3, 1, '/uploads/face/20200129/197efd66199f8935d98cee93ae6c84f4.png', '2020-01-27 16:23:58');
INSERT INTO `sys_user` VALUES (4, '赵六', 'zl', '武汉', 1, '系统管理员', 'e10adc3949ba59abbe56e057f20f883e', 4, 3, 1, 4, 1, '/uploads/face/20200129/a345fb2cd86054f8dbe9c335a7fec115.png', '2020-01-21 16:24:01');
INSERT INTO `sys_user` VALUES (6, '刘八', 'lb', '深圳', 1, '销售管理员', 'e10adc3949ba59abbe56e057f20f883e', 4, 3, 1, 6, 1, '/uploads/face/20200129/6a01d0c7fe5e7290014c6808a3643231.png', '2020-01-20 16:24:10');
INSERT INTO `sys_user` VALUES (7, 'Bob', '无枝可依', '海南', 0, '海外技术支持人员', 'd41d8cd98f00b204e9800998ecf8427e', 2, 1, 1, 7, NULL, '/uploads/face/20200130/3ef43a58a8bd5bf6281c3e63987cbdfb.png', '2020-01-30 00:00:00');

SET FOREIGN_KEY_CHECKS = 1;
