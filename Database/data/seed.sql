INSERT INTO `images` (`id`, `url`) VALUES 
    (NULL, 'IMG-6597ce1d4687f0.45598818.jpg'),
    (NULL, 'IMG-6597ce163b5011.38265888.jpg'),
    (NULL, 'IMG-6597ce2391ce66.45454410.jpg');

INSERT INTO `users` (`username`, `mail`, `password`, `bio`, `image`, `name`, `surname`, `birthday`, `followers`, `follow`) VALUES 
    ('hikaru', 'hikaru@gmail.com', 'password', 'Top 5 al mondo', '1', 'Hikaru', 'Nakamura', '1987-12-09', '0', '0'),
    ('magnus', 'magnus.carlsen@gmail.com', 'password', 'The GOAT', '2', 'Magnus', 'Carlsen', '1990-11-30', '0', '0'),
    ('gothamchess', 'gothamchess@gmail.com', 'password', 'IM ', '3', 'Levy', 'Rozman', '1995-12-05', '0', '0');

INSERT INTO `follows` (`follower`, `followed`) VALUES 
    ('gothamchess', 'hikaru'), 
    ('gothamchess', 'magnus'),
    ('hikaru', 'gothamchess'), 
    ('hikaru', 'magnus'),
    ('magnus', 'hikaru');

INSERT INTO `posts` (`id`, `author`, `publication_date`, `publication_time`, `title`, `game`, `vote`) VALUES 
    (NULL, 'gothamchess', '2024-01-14', '10:10:22', 'Oh no la mia regina ;)', '1. e4 e5 2. Nf3 d6 3. Bc4 Nc6 4. Nc3 Bg4 5. h3 Bh5 6. Nxe5 Bxd1 7. Bxf7+ Ke7 8. Nd5', '0'),
    (NULL, 'hikaru', '2024-01-14', '11:30:00', 'Meh', '1. e4 e5 2. Nf3 Nc6 3. Bc4 Nf6 4. O-O Bc5 5. Re1 a6 6. c3 b5 7. Bb3 Bb7 8. d4 exd4 9. cxd4 Bb6 10. e5 Ng4 11. Ng5 O-O 12. Qxg4 Nxd4 13. Bxf7+ Rxf7 14. Nxf7 Kxf7 15. Nc3 Nc2 16. Qf5+ Kg8 17. Qxc2 Qf8 18. Be3 Bxe3 19. Rxe3 Qf7 20. Qb3 d5 21. Rd1 c6 22. Rf3 Qe6 23. Re1 Qg6 24. Nb1 Kh8 25. Qd3 Qe6 26. Qf5 Qxf5 27. Rxf5 c5 28. e6 Re8 29. e7 d4 30. Rf8+', '0');

INSERT INTO `votes` (`post`, `voter`) VALUES 
    ('1', 'hikaru'), 
    ('1', 'magnus');

INSERT INTO `comments` (`id`, `post`, `author`, `publication_date`, `publication_time`, `text`) VALUES 
    (NULL, '1', 'hikaru', '2024-01-14', '10:20:00', 'Il matto di Legal');

INSERT INTO `notifications` (`id`, `user`, `author`, `date`, `time`, `post`, `comment`, `viewed`) VALUES 
    (NULL, 'magnus', 'gothamchess', '2024-02-01', '09:20:43', NULL, NULL, '0');
