INSERT INTO `images` (`id`, `url`) VALUES 
    (NULL, 'IMG-6597ce1d4687f0.45598818.jpg'),
    (NULL, 'IMG-6597ce163b5011.38265888.jpg'),
    (NULL, 'IMG-6597ce2391ce66.45454410.jpg');


INSERT INTO `users` (`mail`, `username`, `password`, `bio`, `image`, `name`, `surname`, `birthday`, `followers`, `follow`) VALUES 
    ('magnus.carlsen@gmail.com', 'magnus', 'password', 'The GOAT', 2, 'Magnus', 'Carlsen', '1990-11-30', '0', '0'),
    ('hikaru@gmail.com', 'hikaru', 'password', 'Il maestro delle Bullet', 1, 'Hikaru', 'Nakamura', '1987-12-09','0', '0'),
    ('gothamchess@gmail.com', 'gothamchess', 'password', 'Creatore di Chessly', 3, 'Levy', 'Rozman', '1995-12-05', '0', '0');


INSERT INTO `posts` (`id`, `author`, `publication_date`, `time`, `title`, `vote`) VALUES (NULL, 'gothamchess', '2024-01-13', '15:50:00', 'La mia miglior partita di sempre', '0');

INSERT INTO `games` (`id`, `post`, `move`) VALUES (NULL, '1', '1. e4 e5 2. Nf3 d6 3. Bc4 Nc6 4. Nc3 Bg4 5. h3 Bh5 6. Nxe5 Bxd1 7. Bxf7+ Ke7 8. Nd5');

/* INSERT INTO `posts` (`id`, `author`, `publication_date`, `title`, `text`, `vote`, `image`) VALUES 
    (NULL, 'hikaru', '2024-01-07', 'Aperture', 'Farò un corso specifico di tutte le possibili risposte ad 1.e4', '0', '2'),     
    (NULL, 'ale', '2024-01-01', 'Buon Anno!', 'Buon anno a tutti!', NULL, NULL);

INSERT INTO `discussions` (`id`, `post`, `replay_to`, `author`, `publication_date`, `text`, `vote`) VALUES 
    (NULL, '1', NULL, 'gothamchess', '2024-01-07', 'Bianco o nero?', NULL),
    (NULL, '1', '1', 'hikaru', '2024-01-07', 'Bianco', NULL); */