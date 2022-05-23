drop table if exists users;

create table users (
    id      bigint unsigned not null auto_increment primary key,
    days    timestamp,
    dt      integer,
    coins   double default 0
);