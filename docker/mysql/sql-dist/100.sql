drop table if exists users;

set time_zone = 'Europe/Moscow';

create table users (
    id      bigint      unsigned not null auto_increment primary key,
    days    integer     not null default 0,
    dt      timestamp   null,
    coins   double      not null default 0
);

insert into users
    (id, days, dt, coins)
values
    (1,0, null, 0),
    (2,1, now(), 10),
    (3,6, now() - INTERVAL 1 DAY, 150),
    (4,9, now() - INTERVAL 1 DAY, 275),
    (5,5, now() - INTERVAL 7 DAY, 100);