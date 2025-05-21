-- Настрока таблицы ᓚᘏᗢ
CREATE TABLE IF NOT EXISTS users (
    id BIGSERIAL NOT NULL PRIMARY KEY,
    username VARCHAR(64) NOT NULL,
    password VARCHAR(64) NOT NULL
);
-- Тестовые пользователи
INSERT INTO users (username, password) VALUES 
('admin', 'secret123'),
('goida', 'ZOVZOVZOV'),
('monkey2004', 'likebanana'),
('Vartum_05', 'V_%');
