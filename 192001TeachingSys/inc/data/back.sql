use cait_school;
create table cait_back(
    uid int auto_increment primary key,
    uname char(10) not null,
    upa char(32) not null
);

insert into cait_back
    (uname,upa)
    values
    ('cait',md5('123456')),
    ('admin',md5('123456'));

--管理员头像
alter table cait_back add adminpic char(41) default "admin.png";