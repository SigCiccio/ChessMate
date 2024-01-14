INSERT INTO `images` (`id`, `url`) VALUES 
    (NULL, 'IMG-6597ce1d4687f0.45598818.jpg'),
    (NULL, 'IMG-6597ce163b5011.38265888.jpg'),
    (NULL, 'IMG-6597ce2391ce66.45454410.jpg');

INSERT INTO `users` (`username`, `mail`, `password`, `bio`, `image`, `name`, `surname`, `birthday`, `followers`, `follow`) VALUES 
    ('hikaru', 'hikaru@gmail.com', 'password', 'Top 5 al mondo', '2', 'Hikaru', 'Nakamura', '1987-12-09', '0', '0'),
    ('magnus', 'magnus.carlsen@gmail.com', 'password', 'The GOAT', '1', 'Magnus', 'Carlsen', '1990-11-30', '0', '0'),
    ('gothamchess', 'gothamchess@gmail.com', 'password', 'IM ', '3', 'Levy', 'Rozman', '1995-12-05', '0', '0');

INSERT INTO `follows` (`follower`, `followed`) VALUES 
    ('gothamchess', 'hikaru'), 
    ('gothamchess', 'magnus'),
    ('hikaru', 'gothamchess'), 
    ('hikaru', 'magnus'),
    ('magnus', 'hikaru');

INSERT INTO `posts` (`id`, `author`, `publication_date`, `publication_time`, `title`, `game`, `vote`) VALUES 
    (NULL, 'gothamchess', '2024-01-14', '10:10:22', 'Oh no la mia regina ;)', '1. e4 e5 2. Nf3 d6 3. Bc4 Nc6 4. Nc3 Bg4 5. h3 Bh5 6. Nxe5 Bxd1 7. Bxf7+ Ke7 8. Nd5', '0');

INSERT INTO `votes` (`post`, `voter`, `vote`) VALUES 
    ('1', 'hikaru', '1'), 
    ('1', 'magnus', '-1');

INSERT INTO `comments` (`id`, `post`, `author`, `publication_date`, `pubblication_time`, `text`) VALUES 
    (NULL, '1', 'hikaru', '2024-01-14', '10:20:00', 'Il matto di Legal');
