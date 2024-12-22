create table if not exists artist
(
    id    int auto_increment
    primary key,
    name  varchar(255) not null,
    genre varchar(255) not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists album
(
    id         int auto_increment
    primary key,
    artist_id  int          not null,
    artists_id int          not null,
    title      varchar(255) not null,
    year       int          not null,
    constraint FK_39986E4354A05007
    foreign key (artists_id) references artist (id),
    constraint FK_39986E43B7970CF8
    foreign key (artist_id) references artist (id)
    )
    collate = utf8mb4_unicode_ci;

create index IDX_39986E4354A05007
    on album (artists_id);

create index IDX_39986E43B7970CF8
    on album (artist_id);

create table if not exists messenger_messages
(
    id           bigint auto_increment
    primary key,
    body         longtext     not null,
    headers      longtext     not null,
    queue_name   varchar(190) not null,
    created_at   datetime     not null comment '(DC2Type:datetime_immutable)',
    available_at datetime     not null comment '(DC2Type:datetime_immutable)',
    delivered_at datetime     null comment '(DC2Type:datetime_immutable)'
    )
    collate = utf8mb4_unicode_ci;

create index IDX_75EA56E016BA31DB
    on messenger_messages (delivered_at);

create index IDX_75EA56E0E3BD61CE
    on messenger_messages (available_at);

create index IDX_75EA56E0FB7336F0
    on messenger_messages (queue_name);

create table if not exists playlist
(
    id    int auto_increment
    primary key,
    title varchar(255) not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists playlist_album
(
    playlist_id int not null,
    album_id    int not null,
    primary key (playlist_id, album_id),
    constraint FK_9A8477001137ABCF
    foreign key (album_id) references album (id)
    on delete cascade,
    constraint FK_9A8477006BBD148
    foreign key (playlist_id) references playlist (id)
    on delete cascade
    )
    collate = utf8mb4_unicode_ci;

create index IDX_9A8477001137ABCF
    on playlist_album (album_id);

create index IDX_9A8477006BBD148
    on playlist_album (playlist_id);

create table if not exists user
(
    id       int auto_increment
    primary key,
    login    varchar(255) not null,
    password varchar(255) not null,
    role     varchar(10)  not null
    )
    collate = utf8mb4_unicode_ci;

create table if not exists comment
(
    id         int auto_increment
    primary key,
    album_id   int      not null,
    albums_id  int      not null,
    user_id    int      not null,
    content    longtext not null,
    created_at datetime not null comment '(DC2Type:datetime_immutable)',
    constraint FK_9474526C1137ABCF
    foreign key (album_id) references album (id),
    constraint FK_9474526CA76ED395
    foreign key (user_id) references user (id),
    constraint FK_9474526CECBB55AF
    foreign key (albums_id) references album (id)
    )
    collate = utf8mb4_unicode_ci;

create index IDX_9474526C1137ABCF
    on comment (album_id);

create index IDX_9474526CA76ED395
    on comment (user_id);

create index IDX_9474526CECBB55AF
    on comment (albums_id);

