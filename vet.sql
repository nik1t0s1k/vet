-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 24 2025 г., 21:27
-- Версия сервера: 10.8.4-MariaDB
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vet`
--

-- --------------------------------------------------------

--
-- Структура таблицы `consultation`
--

CREATE TABLE `consultation` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `veterinarian_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `time` time NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'pending',
  `notes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `consultation`
--

INSERT INTO `consultation` (`id`, `user_id`, `pet_id`, `veterinarian_id`, `date`, `time`, `type`, `status`, `notes`, `created_at`) VALUES
(2, 7, 3, 1, '2025-06-20 00:00:00', '12:07:00', 'audio', 'completed', 'уцерцуенцу', 1750313207),
(3, 5, 2, 1, '2025-06-25 00:00:00', '10:30:00', 'audio', 'pending', 'не дает подстригать когти, помогите!', 1750735736),
(4, 5, 2, 3, '2025-06-29 00:00:00', '10:31:00', 'text', 'pending', 'Рана на мордочке', 1750735809),
(5, 7, 5, 1, '2025-06-24 00:00:00', '15:05:00', 'audio', 'pending', 'kuiteiuroitoiut0it', 1750741189);

-- --------------------------------------------------------

--
-- Структура таблицы `knowledge_base`
--

CREATE TABLE `knowledge_base` (
  `id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'article',
  `category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cover_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `views_count` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `knowledge_base`
--

INSERT INTO `knowledge_base` (`id`, `title`, `content`, `type`, `category`, `cover_image`, `video_url`, `created_at`, `updated_at`, `views_count`) VALUES
(1, 'Как правильно ухаживать за шерстью кошек', '<p>Регулярный уход за шерстью кошки - важная часть заботы о здоровье питомца. В этой статье мы расскажем:</p>\n                <ul>\n                    <li>Как выбрать правильную расческу для вашей кошки</li>\n                    <li>Техники расчесывания длинношерстных и короткошерстных пород</li>\n                    <li>Как бороться с колтунами</li>\n                    <li>Частота купания кошек</li>\n                    <li>Средства для ухода за шерстью</li>\n                </ul>\n                <p>Правильный уход предотвращает образование колтунов, уменьшает количество шерсти в доме и позволяет вовремя обнаружить кожные проблемы.</p>', 'article', 'care', 'cat-grooming.jpg', NULL, 1747807508, 1749535508, 2),
(2, 'Основы дрессировки собак: первые шаги', '<p>Дрессировка собаки - это не только выполнение команд, но и установление доверительных отношений. Основные принципы:</p>\n                <ol>\n                    <li>Начинайте дрессировку с раннего возраста</li>\n                    <li>Используйте положительное подкрепление</li>\n                    <li>Тренируйтесь регулярно, но недолго</li>\n                    <li>Будьте последовательны в командах</li>\n                    <li>Учитывайте породные особенности</li>\n                </ol>\n                <p>В статье подробно разберем каждую из этих тем и дадим практические упражнения для первых занятий.</p>', 'article', 'education', 'dog-training.jpg', NULL, 1748239508, 1749967508, 1),
(3, 'Сбалансированное питание для собак крупных пород', '<p>Крупные породы собак имеют особые потребности в питании. Основные рекомендации:</p>\n                <ul>\n                    <li>Оптимальное соотношение белков, жиров и углеводов</li>\n                    <li>Важность кальция и фосфора для развития костей</li>\n                    <li>Контроль веса для профилактики заболеваний суставов</li>\n                    <li>Особенности кормления щенков и взрослых собак</li>\n                    <li>Натуральное питание vs промышленные корма</li>\n                </ul>\n                <p>В статье представлены примерные рационы и рекомендации ветеринарных диетологов.</p>', 'article', 'nutrition', 'dog-food.jpg', NULL, 1748671508, 1750140308, 0),
(4, 'Профилактика сердечно-сосудистых заболеваний у кошек', '<p>Сердечные заболевания у кошек часто протекают незаметно. Как защитить питомца:</p>\n                <ol>\n                    <li>Регулярные ветеринарные осмотры</li>\n                    <li>Контроль веса и физической активности</li>\n                    <li>Признаки, на которые стоит обратить внимание</li>\n                    <li>Породная предрасположенность</li>\n                    <li>Диета для поддержки сердца</li>\n                </ol>\n                <p>Статья поможет распознать ранние симптомы и принять профилактические меры.</p>', 'article', 'health', 'cat-heart.jpg', NULL, 1749103508, 1750226708, 1),
(5, 'Видеоурок: Как чистить уши собаке', '<p>В этом видеоуроке наш ветеринарный врач покажет:</p>\n                <ul>\n                    <li>Как правильно фиксировать собаку</li>\n                    <li>Какие средства использовать для чистки ушей</li>\n                    <li>Технику безопасной чистки</li>\n                    <li>Признаки заболеваний ушей</li>\n                    <li>Частота процедуры для разных пород</li>\n                </ul>\n                <p>Регулярная чистка ушей - важная часть профилактики ушных инфекций.</p>', 'video', 'care', 'dog-ears.jpg', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 1748844308, 1750053908, 0),
(6, 'Обучение команде \"Место\": видеоинструкция', '<p>Пошаговое руководство по обучению собаки команде \"Место\":</p>\n                <ol>\n                    <li>Выбор правильного места</li>\n                    <li>Приучение к лежанке</li>\n                    <li>Введение голосовой команды</li>\n                    <li>Увеличение времени выдержки</li>\n                    <li>Добавление отвлекающих факторов</li>\n                </ol>\n                <p>Видео демонстрирует работу с собаками разного возраста и темперамента.</p>', 'video', 'education', 'dog-place.jpg', 'https://vimeo.com/76979871', 1748498708, 1749794708, 0),
(7, 'Приготовление домашнего корма для кошек', '<p>Практическое руководство по приготовлению сбалансированного домашнего корма:</p>\n                <ul>\n                    <li>Необходимые ингредиенты</li>\n                    <li>Соотношение мяса, овощей и добавок</li>\n                    <li>Техника приготовления и хранения</li>\n                    <li>Витаминные добавки</li>\n                    <li>Переход с промышленного корма</li>\n                </ul>\n                <p>Видео включает рецепты для здоровых кошек и животных с особыми потребностями.</p>', 'video', 'nutrition', 'cat-food.jpg', 'https://www.youtube.com/watch?v=oHg5SJYRHA0', 1749362708, 1750313108, 4),
(8, 'Первая помощь питомцу: видеоинструкция', '<p>Экстренные ситуации, в которых может оказаться любой владелец животного. В видео:</p>\n                <ol>\n                    <li>Как обработать рану</li>\n                    <li>Что делать при отравлении</li>\n                    <li>Помощь при тепловом ударе</li>\n                    <li>Искусственное дыхание для животных</li>\n                    <li>Сбор аптечки первой помощи</li>\n                </ol>\n                <p>Практические навыки, которые могут спасти жизнь вашему питомцу до визита к ветеринару.</p>', 'video', 'health', 'pet-first-aid.jpg', 'https://vimeo.com/148751763', 1749708308, 1750399508, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `medical_record`
--

CREATE TABLE `medical_record` (
  `id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `record_date` date NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `treatment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `veterinarian_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `medical_record`
--

INSERT INTO `medical_record` (`id`, `pet_id`, `record_date`, `description`, `treatment`, `veterinarian_id`, `created_at`) VALUES
(2, 2, '2025-06-14', 'папо', 'оал', 1, NULL),
(3, 3, '2025-06-11', 'drtj', 'rteyert', 1, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1748425773),
('m250528_094829_init_petcare_tables', 1748514323),
('m250529_102151_add_test_data', 1748514324),
('m250602_073445_create_orders_table', 1748849739),
('m250602_083457_add_image_to_service', 1748853348),
('m250620_055549_create_knowledge_base_table', 1750398998),
('m250620_060428_seed_knowledge_base_table', 1750399508),
('m250620_061550_add_views_count_to_knowledge_base', 1750400215);

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `pet_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'new',
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requested_date` date DEFAULT NULL,
  `requested_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order`
--

INSERT INTO `order` (`id`, `user_id`, `service_id`, `pet_id`, `status`, `address`, `requested_date`, `requested_time`, `created_at`, `updated_at`) VALUES
(3, 7, 1, 4, 'new', 'jfufu', '2025-06-26', '10:00', 1750745783, 1750745783);

-- --------------------------------------------------------

--
-- Структура таблицы `pet`
--

CREATE TABLE `pet` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `breed` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `pet`
--

INSERT INTO `pet` (`id`, `user_id`, `name`, `type`, `breed`, `age`, `weight`, `created_at`, `updated_at`) VALUES
(2, 5, 'ыапо', 'кно', 'вапо', 1, 1, 1, 1),
(3, 7, 'оаоа', 'dog', 'аооа', 12, 12, 1750312607, 1750312607),
(4, 7, '12', 'dog', 'аооа', 12, 12, 1750314823, 1750314823),
(5, 7, '134', 'dog', 'weryt', 2, 15, 1750315019, 1750315019),
(6, 1, 'Вова', 'dog', 'Бродячий', 20, 99, 1750407104, 1750407104);

-- --------------------------------------------------------

--
-- Структура таблицы `profile`
--

CREATE TABLE `profile` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `profile`
--

INSERT INTO `profile` (`user_id`, `full_name`, `phone`, `address`) VALUES
(1, 'Иванов Иван Иванович', '+79991234567', NULL),
(2, 'Петрова Мария Сергеевна', '+79997654321', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `service`
--

INSERT INTO `service` (`id`, `name`, `description`, `price`, `category`, `image`) VALUES
(1, 'Выгул собак', 'Прогулка с вашей собакой в парке', '500.00', 'walking', NULL),
(2, 'Груминг', 'Комплексный уход за шерстью', '1500.00', 'grooming', NULL),
(3, 'Передержка', 'Дневная передержка вашего питомца', '1000.00', 'boarding', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT 10,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'vet1', 'vet1@example.com', '$2y$13$jDc9caRYIiKIO8ck5THUM.zatdnoeRScEsjz.ltAD0iMl7MjUFVpa', 10, 1748514324, 1748514324),
(2, 'vet2', 'vet2@example.com', '$2y$13$cyDgj0lWi5us.Gwuq3n1nuIGFaXUdW1bwDRwj9jtrxHmVJikFMS7S', 10, 1748514324, 1748514324),
(5, '1', '1@gmail.com', '$2y$13$lCsE3FbsNIyWlduw.tUm/eACWdyYHsf3j95fXcCvqu2ZbtFbzbDuK', 10, 1749795939, 1749795939),
(7, 'admin', 'admin@gmail.com', '$2y$13$Dz3kRxQeOAVunqHWcMFezuIBHS/yBh/4dteNryHAbJmWOY9nLh0cS', 10, 1750308019, 1750317013),
(8, 'Алексей Александрович', 'Алекс@gmail.com', 'alex', 10, 131, 124);

-- --------------------------------------------------------

--
-- Структура таблицы `veterinarian`
--

CREATE TABLE `veterinarian` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `qualification` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `specialization` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `experience` int(11) DEFAULT NULL,
  `rating` float DEFAULT 0,
  `is_available` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `veterinarian`
--

INSERT INTO `veterinarian` (`id`, `user_id`, `qualification`, `specialization`, `experience`, `rating`, `is_available`) VALUES
(1, 1, 'Доктор ветеринарных наук', 'Хирургия, терапия', 10, 4.8, 1),
(2, 2, 'Ветеринарный врач', 'Дерматология', 5, 4.5, 1),
(3, 8, 'Врач и любитель животных', 'Хирург, дерматолог', 6, 5, 1);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `consultation`
--
ALTER TABLE `consultation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_consultation_user` (`user_id`),
  ADD KEY `fk_consultation_pet` (`pet_id`),
  ADD KEY `fk_consultation_vet` (`veterinarian_id`);

--
-- Индексы таблицы `knowledge_base`
--
ALTER TABLE `knowledge_base`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_knowledge_type` (`type`),
  ADD KEY `idx_knowledge_category` (`category`);

--
-- Индексы таблицы `medical_record`
--
ALTER TABLE `medical_record`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_medical_pet` (`pet_id`),
  ADD KEY `fk_medical_vet` (`veterinarian_id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_user` (`user_id`),
  ADD KEY `fk_order_service` (`service_id`),
  ADD KEY `fk_order_pet` (`pet_id`);

--
-- Индексы таблицы `pet`
--
ALTER TABLE `pet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pet_user` (`user_id`);

--
-- Индексы таблицы `profile`
--
ALTER TABLE `profile`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `veterinarian`
--
ALTER TABLE `veterinarian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_veterinarian_user` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `consultation`
--
ALTER TABLE `consultation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `knowledge_base`
--
ALTER TABLE `knowledge_base`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `medical_record`
--
ALTER TABLE `medical_record`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `pet`
--
ALTER TABLE `pet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `veterinarian`
--
ALTER TABLE `veterinarian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `consultation`
--
ALTER TABLE `consultation`
  ADD CONSTRAINT `fk_consultation_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultation_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_consultation_vet` FOREIGN KEY (`veterinarian_id`) REFERENCES `veterinarian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `medical_record`
--
ALTER TABLE `medical_record`
  ADD CONSTRAINT `fk_medical_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_medical_vet` FOREIGN KEY (`veterinarian_id`) REFERENCES `veterinarian` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `fk_order_pet` FOREIGN KEY (`pet_id`) REFERENCES `pet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_service` FOREIGN KEY (`service_id`) REFERENCES `service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_order_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `pet`
--
ALTER TABLE `pet`
  ADD CONSTRAINT `fk_pet_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `veterinarian`
--
ALTER TABLE `veterinarian`
  ADD CONSTRAINT `fk_veterinarian_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
