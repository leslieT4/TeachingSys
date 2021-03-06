-- 添加记录
-- 3个学院
insert into cait_dep 
	values
	('计算机学院'),
	('软件学院'),
	('电子通信学院'),
	('财经学院'),
	('应用外语学院'),
	('公共教学部');
-- 3个专业
insert into cait_major
	values
	('计算机应用技术专业',3,'计算机学院'),
	('网络技术专业',3,'计算机学院'),
	('信息安全专业',3,'计算机学院');
-- 添加一个专业
insert into cait_major
	values
	('软件技术专业',3,'软件学院');

-- 添加班级
insert into cait_class
	values
	('18计算机应用技术3-1班',3,'计算机应用技术专业'),
	('18计算机应用技术3-2班',3,'计算机应用技术专业'),
	('18计算机应用技术3-3班',3,'计算机应用技术专业');
-- 添加班级
insert into cait_class
	values
	('17计算机应用技术3-1班',3,'计算机应用技术专业'),
	('17计算机应用技术3-2班',3,'计算机应用技术专业'),
	('17计算机应用技术3-3班',3,'计算机应用技术专业'),
	('18信息安全3-1班',3,'信息安全专业'),
	('18信息安全3-2班',3,'信息安全专业'),
	('18信息安全3-3班',3,'信息安全专业'),
	('18网络技术3-1班',3,'网络技术专业'),
	('18网络技术3-2班',3,'网络技术专业'),
	('18网络技术3-3班',3,'网络技术专业'),
	('18软件技术3-1班',3,'软件技术专业');
insert into cait_class
	values
	('18软件技术3-1班',3,'软件技术专业');

insert into cait_class
	values
	('18旅游英语3-1班',3,'应用外语专业');
-- 添加学生
insert into cait_stu
	values
	('5组','蔡彤',md5('sz123456'),'18计算机应用技术3-2班'),
	('1803010222','林秋金',md5('sz1234567'),'18计算机应用技术3-2班'),
	('1803010239','许艳清',md5('sz1234568'),'18计算机应用技术3-2班');

-- 添加老师
insert into cait_te
	values
	('2007300024','桂荣枝',md5('te123456'),'计算机学院'),
	('2008400035','王秀兰',md5('te123456'),'软件学院'),
	('2009500046','彭程',md5('te123456'),'财经学院'),
	('2005100046','王焕军',md5('te123456'),'应用外语学院'),
	('2006100057','黄智',md5('te123456'),'公共教学部'),
	('2016100221','李丹',md5('te123456'),'计算机学院');
	('2003100047','秦文',md5('te123456'),'计算机学院','te.png');
-- 课程编码    课程名称         适用年级    专业名称            学期（1~6）  学分       周学时  起止周     总学时    课程类型      考试类型
insert into cait_course
	(ccode,    cname,           cgrade,    majorname,         cterm,      cpoint,    cweekh, cweek,    ctotalh,  ctype,       cexam  )
	values
	(31630031,'web项目应用',     2018,     '计算机应用技术专业', 4,          3,         4,      '01-14',  56,      '专业核心课', '集中考试'),
	(31630032,'Linux服务器管理', 2018,     '计算机应用技术专业', 4,          3,         4,      '01-14',  56,      '专业核心课', '过程性考试'),
	(31602891,'形势与政策1',     2018,     '计算机应用技术专业', 1,          1,         2,      '01-18',  36,      '公共必修课', '考查'),
	(31602145,'大学英语1',       2018,     '计算机应用技术专业', 1,          3,         4,      '01-18',  72,      '公共必修课', '集中考试');
-- 老师工号     课程自动编码    授课班级                授课学年学期
insert into cait_task
	(teid,       cid,        stuclass,              taskterm)
	values
	(2016100221, 1,          '18计算机应用技术3-1班', 192002),
	(2016100221, 1,          '18计算机应用技术3-2班', 192002),
	(2016100221, 1,          '18计算机应用技术3-3班', 192002),
	(2008400035, 2,          '18计算机应用技术3-1班', 192002),
	(2008400035, 2,          '18计算机应用技术3-2班', 192002),
	(2008400035, 2,          '18计算机应用技术3-3班', 192002),
	(2006100057, 3,          '18计算机应用技术3-1班', 192002),
	(2006100057, 3,          '18计算机应用技术3-2班', 192002),
	(2006100057, 3,          '18计算机应用技术3-3班', 192002),
	(2005100046, 4,          '18计算机应用技术3-1班', 192002),
	(2005100046, 4,          '18计算机应用技术3-2班', 192002),
	(2005100046, 4,          '18计算机应用技术3-3班', 192002);