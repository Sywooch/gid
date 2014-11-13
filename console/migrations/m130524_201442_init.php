<?php

use yii\db\Schema;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
    {
        // Настройки MySql таблицы
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';

        // Таблица пользователей
        $this->createTable('{{%users}}', [
            'id_user'    => Schema::TYPE_PK . " COMMENT 'ID пользователя'",
            'username'   => Schema::TYPE_STRING . "(45) NOT NULL COMMENT 'Логин'",
            'email'      => Schema::TYPE_STRING . "(45) NOT NULL COMMENT 'Почта'",
            'pass'       => Schema::TYPE_STRING . " NOT NULL COMMENT 'Пароль-хэш'",
            'role'       => "TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Роль'",
            'status'     => "TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Статус'",
            'gender'     => "TINYINT(1) UNSIGNED COMMENT 'Пол'",
            'birthday'   => Schema::TYPE_DATE . " COMMENT 'Дата рождения'",
            'created'    => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата регистрации'",
            'updated'    => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата обновления'",
            'last_visit' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата последнего посещения'",
        ], $tableOptions);

        // Добавление demo пользователя
        $this->insert('{{%users}}', [
            'id_user'    => 1,
            'username'   => 'demo',
            'email'      => 'demo@mail.ru',
            'pass'       => '$2y$13$v2nVZsRIB9tKWTyk2EdNB.2NrGQxoNMI4.JuG8f3u.kDEiIOhyGVK',
            'role'       => 1,
            'status'     => 1,
            'gender'     => null,
            'birthday'   => null,
            'created'    => 123345,
            'updated'    => 123456,
            'last_visit' => 123456,
        ]);

        // Обратная связь
        $this->createTable('{{%user_feedback}}', [
            'id_message' => Schema::TYPE_PK. " COMMENT 'ID сообщения'",
            'email'      => Schema::TYPE_STRING . "(45) NOT NULL COMMENT 'Почта'",
            'id_user'    => Schema::TYPE_INTEGER . " COMMENT 'ID пользователя'",
            'subject'    => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Тема'",
            'text'       => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
            'url'        => Schema::TYPE_STRING . " COMMENT 'Url'",
            'viewed'     => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT FALSE COMMENT 'Просмотрено'",
            'date'       => Schema::TYPE_INTEGER . " COMMENT 'Дата отправки'",
        ], $tableOptions);

        $this->addForeignKey('fk_user_feedback', '{{%user_feedback}}', 'id_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');

        // Таблица уникальных параметров
        $this->createTable('{{%params_unique}}', [
            'id_param' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'name'     => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_params_unique', '{{%params_unique}}', 'id_param');

        // Добавление уникальных параметров
        $this->batchInsert('{{%params_unique}}', ['id_param', 'name'], [
            ['id_param' => 1, 'name' => 'Период записи'],//'recorded'
            ['id_param' => 2, 'name' => 'Мета-тег description'],//'meta_desc
            ['id_param' => 3, 'name' => 'Дополнительное название'],//'add_name'
            ['id_param' => 4, 'name' => 'Так же известны']//'also_known'
        ]);

        // Таблица предустановленных параметров (Entity–attribute–value model)
        $this->createTable('{{%params_attr}}', [
            'id_attr' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'name'    => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название параметра'",
            'type'    => Schema::TYPE_STRING . "(10) NOT NULL COMMENT 'Тип параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_params', '{{%params_attr}}', 'id_attr');

        // Добавление предустановленных параметров
        $this->batchInsert('{{%params_attr}}', ['id_attr', 'name', 'type'], [
            ['id_attr' => 1, 'name' => 'Номерной', 'type' => ''],//'number'
            ['id_attr' => 2, 'name' => 'Сотрудничество', 'type' => ''],//'relation'
            ['id_attr' => 3, 'name' => 'Временные особенности', 'type' => ''],//'times
            ['id_attr' => 4, 'name' => 'Посмертный', 'type' => ''],//'dead'
            ['id_attr' => 5, 'name' => 'Саундтрек', 'type' => ''],//'ost'
            ['id_attr' => 6, 'name' => 'Интро-аутро', 'type' => ''],//'inoutro'
            ['id_attr' => 7, 'name' => 'Расположение трека', 'type' => ''],//'location'
            ['id_attr' => 8, 'name' => 'Мета-тег robots', 'type' => ''],//'meta_robots'
            //['id_attr' => 9, 'name' => 'Составная композиция'],  отдельно TODO band members
        ]);

        // Значения предустановленных параметров
        $this->createTable('{{%params_attr_value}}', [
            'id_attr_value' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'Id значения параметра'",
            'id_attr'       => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'description'   => Schema::TYPE_STRING . " NOT NULL COMMENT 'Описание значения'",
            'value'         => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Значение'",//нужно ли?
        ], $tableOptions);

        $this->addPrimaryKey('pk_params_attr_value', '{{%params_attr_value}}', 'id_attr_value');
        $this->addForeignKey('fk_params_attr_value', '{{%params_attr_value}}', 'id_attr', '{{%params_attr}}', 'id_attr', 'CASCADE', 'CASCADE');

        $this->batchInsert('{{%params_attr_value}}', ['id_attr', 'id_attr_value', 'description', 'value'], [
            ['id_attr' => 1, 'id_attr_value' => 1, 'description' => 'Номерной', 'value' => 1],
            ['id_attr' => 2, 'id_attr_value' => 2, 'description' => 'Совместный', 'value' => 0],
            ['id_attr' => 2, 'id_attr_value' => 3, 'description' => 'Сплит', 'value' => 1],
            ['id_attr' => 3, 'id_attr_value' => 4, 'description' => 'Дебютный', 'value' => 0],
            ['id_attr' => 3, 'id_attr_value' => 5, 'description' => 'Последний', 'value' => 1],
            ['id_attr' => 4, 'id_attr_value' => 6, 'description' => 'Посмертный', 'value' => 1],
            ['id_attr' => 5, 'id_attr_value' => 7, 'description' => 'Саундтрек', 'value' => 1],
            ['id_attr' => 6, 'id_attr_value' => 8, 'description' => 'Intro', 'value' => 0],
            ['id_attr' => 6, 'id_attr_value' => 9, 'description' => 'Outro', 'value' => 1],
            ['id_attr' => 7, 'id_attr_value' => 10, 'description' => 'Скрытый', 'value' => 0],
            ['id_attr' => 7, 'id_attr_value' => 11, 'description' => 'Бонус', 'value' => 1],
            ['id_attr' => 8, 'id_attr_value' => 12, 'description' => 'index, follow', 'value' => 0],
            ['id_attr' => 8, 'id_attr_value' => 13, 'description' => 'index, no follow', 'value' => 1],
            ['id_attr' => 8, 'id_attr_value' => 14, 'description' => 'no index, follow', 'value' => 2],
            ['id_attr' => 8, 'id_attr_value' => 15, 'description' => 'no index, no follow', 'value' => 3],
        ]);

        // Таблица жанров
        $this->createTable('{{%param_genres}}', [
            'id_genre'   => Schema::TYPE_SMALLINT . " COMMENT 'ID жанра'",
            'name_genre' => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название жанра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_genres', '{{%param_genres}}', 'id_genre');

        // Таблица языков
        $this->createTable('{{%param_languages}}', [
            'id_language'   => Schema::TYPE_PK . " COMMENT 'ID языка'",
            'name_language' => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название языка'",
        ], $tableOptions);

        // Таблица лейблов
        $this->createTable('{{%param_labels}}', [
            'id_label'    => Schema::TYPE_SMALLINT . " COMMENT 'ID лейбла'",
            'name_label'  => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название лейбла'",
            'description' => Schema::TYPE_TEXT . " COMMENT 'Описание лейбла'",
            'founded'     => "YEAR NOT NULL COMMENT 'Год основания'",
            'defunct'     => "YEAR NULL COMMENT 'Год закрытия'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_labels', '{{%param_labels}}', 'id_label');

        // Таблица сертификационных агенств
        $this->createTable('{{%param_certification}}', [
            'id_agency'   => Schema::TYPE_SMALLINT . " COMMENT 'ID агенства'",
            'name_agency' => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название агенства'",
            'description' => Schema::TYPE_TEXT . " COMMENT 'Описание агенства'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_certification', '{{%param_certification}}', 'id_agency');

        // Таблица рецензий
        $this->createTable('{{%param_reviews}}', [
            'id_review' => Schema::TYPE_BIGPK . " COMMENT 'ID рецензии'",
            'id_user'   => Schema::TYPE_INTEGER . " COMMENT 'ID пользователя'",
            'title'     => Schema::TYPE_STRING . " NULL COMMENT 'Заголовок'",
            'text'      => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
            'rate'      => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Оценка'",
            'created'   => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата'",
            'status'    => "TINYINT(1) UNSIGNED DEFAULT 0 NOT NULL COMMENT 'Статус'",
        ], $tableOptions);

        $this->addForeignKey('fk_user_review', '{{%param_reviews}}', 'id_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');

        // Таблица фактов
        $this->createTable('{{%param_fact}}', [
            'id_fact' => Schema::TYPE_BIGPK . " COMMENT 'ID факта'",
            'text'    => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
        ], $tableOptions);

        // Таблица альбомов
        $this->createTable('{{%albums}}', [
            'id_album'        => Schema::TYPE_PK . " COMMENT 'ID альбома'",
            'name'            => Schema::TYPE_STRING . " NOT NULL COMMENT 'Официальное название'",
            'released'        => Schema::TYPE_DATE . " COMMENT 'Дата релиза'",
            'year'            => "YEAR NOT NULL COMMENT 'Год выпуска'",
            'length'          => Schema::TYPE_TIME . " NOT NULL COMMENT 'Длительность композиций'",
            'template'        => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Шаблон для артистов'",
            'type'            => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'LP EP сингл или бокс-сет'",
            'device'          => "TINYINT UNSIGNED NOT NULL COMMENT 'Носитель'",
            'size'            => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Количество дисков'",
            'sound'           => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Звук'",
            'count_artists'   => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Число исполнителей в названии'",
            'status'          => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Статус'",
            'repeated'        => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Повторы'",
            'changed'         => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Изменения'",
            'created'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Создано'",
            'id_created_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем создано'",
            'updated'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Обновлено'",
            'id_updated_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем обновлено'",
            //блокировка
        ], $tableOptions);

        $this->addForeignKey('fk_created_album', '{{%albums}}', 'id_created_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_updated_album', '{{%albums}}', 'id_updated_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');

        $this->createIndex('idx_album_name', '{{%albums}}', 'name');
        $this->createIndex('idx_album_year', '{{%albums}}', 'year');
        $this->createIndex('idx_album_type', '{{%albums}}', 'type');
        $this->createIndex('idx_album_size', '{{%albums}}', 'size');
        $this->createIndex('idx_album_sound', '{{%albums}}', 'sound');
        $this->createIndex('idx_album_count_artists', '{{%albums}}', 'count_artists');
        $this->createIndex('idx_album_status', '{{%albums}}', 'status');
        $this->createIndex('idx_album_repeated', '{{%albums}}', 'repeated');
        $this->createIndex('idx_album_count_changed', '{{%albums}}', 'changed');

        // Таблица параметров альбома
        $this->createTable('{{%album_params}}', [
            'id_album' => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_param' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'value'    => Schema::TYPE_STRING . " NOT NULL COMMENT 'Значение параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_params', '{{%album_params}}', ['id_album', 'id_param']);
        $this->addForeignKey('fk_album_params_val', '{{%album_params}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_album_params_rel', '{{%album_params}}', 'id_param', '{{%params_unique}}', 'id_param', 'CASCADE', 'CASCADE');

        // Таблица параметров альбома
        $this->createTable('{{%album_attr}}', [
            'id_album'      => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_attr_value' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_attr', '{{%album_attr}}', ['id_album', 'id_attr_value']);
        $this->addForeignKey('fk_album_attr_val', '{{%album_attr}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_album_attr_rel', '{{%album_attr}}', 'id_attr_value', '{{%params_attr_value}}', 'id_attr_value', 'CASCADE', 'CASCADE');

        // Таблица жанров альбома
        $this->createTable('{{%album_genres}}', [
            'id_album' => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_genre' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID жанра'",
            'main'     => Schema::TYPE_BOOLEAN . " NOT NULL COMMENT 'Основной ли жанр'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_genre', '{{%album_genres}}', ['id_album', 'id_genre']);
        $this->addForeignKey('fk_album_genre', '{{%album_genres}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_genre_album', '{{%album_genres}}', 'id_genre', '{{%param_genres}}', 'id_genre', 'CASCADE', 'CASCADE');

        // Таблица языков альбома
        $this->createTable('{{%album_languages}}', [
            'id_album'    => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_language' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID языка'",
            'main'        => Schema::TYPE_BOOLEAN . " NOT NULL COMMENT 'Основной ли язык'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_language', '{{%album_languages}}', ['id_album', 'id_language']);
        $this->addForeignKey('fk_album_language', '{{%album_languages}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_language_album', '{{%album_languages}}', 'id_language', '{{%param_languages}}', 'id_language', 'CASCADE', 'CASCADE');

        // Таблица лейблов альбома
        $this->createTable('{{%album_labels}}', [
            'id_album' => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_label' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID лейбла'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_label', '{{%album_labels}}', ['id_album', 'id_label']);
        $this->addForeignKey('fk_album_label', '{{%album_labels}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_label', '{{%album_labels}}', 'id_label', '{{%param_labels}}', 'id_label', 'CASCADE', 'CASCADE');

        // Таблица сертификаций альбома
        $this->createTable('{{%album_certification}}', [
            'id_album'  => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID альбома'",
            'id_agency' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID агенства'",
            'sales'     => Schema::TYPE_SMALLINT . " UNSIGNED NOT NULL COMMENT 'Продажи (тыс.)'",
            'date'      => Schema::TYPE_DATE . " NULL COMMENT 'Дата сертификации'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_certification', '{{%album_certification}}', ['id_album', 'id_agency']);
        $this->addForeignKey('fk_album_certification', '{{%album_certification}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_certification', '{{%album_certification}}', 'id_agency', '{{%param_certification}}', 'id_agency', 'CASCADE', 'CASCADE');

        // Таблица рецензий альбома
        $this->createTable('{{%album_reviews}}', [
            'id_album'  => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_review' => Schema::TYPE_BIGINT . " NOT NULL COMMENT 'ID рецензии'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_review', '{{%album_reviews}}', ['id_album', 'id_review']);
        $this->addForeignKey('fk_album_review', '{{%album_reviews}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_review_album', '{{%album_reviews}}', 'id_review', '{{%param_reviews}}', 'id_review', 'CASCADE', 'CASCADE');

        // Таблица фактов о альбоме
        $this->createTable('{{%album_facts}}', [
            'id_album' => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_fact'  => Schema::TYPE_BIGINT . " NOT NULL COMMENT 'ID факта'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_fact', '{{%album_facts}}', ['id_album', 'id_fact']);
        $this->addForeignKey('fk_album_fact', '{{%album_facts}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_fact_album', '{{%album_facts}}', 'id_fact', '{{%param_fact}}', 'id_fact', 'CASCADE', 'CASCADE');

        // Таблица синглов
        $this->createTable('{{%album_singles}}', [
            'id_album'  => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_single' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID альбома-сингла'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_single', '{{%album_singles}}', ['id_album', 'id_single']);
        $this->addForeignKey('fk_single', '{{%album_singles}}', 'id_single', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');

        // Таблица переизданий
        $this->createTable('{{%album_reissues}}', [
            'id_album'   => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_reissue' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID альбома-переиздания'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_album_reissue', '{{%album_reissues}}', ['id_album', 'id_reissue']);
        $this->addForeignKey('fk_album_reissue', '{{%album_reissues}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_reissue', '{{%album_reissues}}', 'id_reissue', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');


        // Оценки альбомов пользователями
        $this->createTable('{{%user_album_vote}}', [
            'id_album' => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'id_user'  => Schema::TYPE_INTEGER . " COMMENT 'ID пользователя'",
            'rate'     => Schema::TYPE_DECIMAL . "(4,1) UNSIGNED NOT NULL COMMENT 'Оценка'",
            'date'     => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_user_album_vote', '{{%user_album_vote}}', ['id_album', 'id_user']);
        $this->addForeignKey('fk_album_user_vote', '{{%user_album_vote}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_album_vote', '{{%user_album_vote}}', 'id_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');


        // Таблица песен
        $this->createTable('{{%songs}}', [
            'id_song'         => Schema::TYPE_BIGPK . " COMMENT 'ID песни'",
            'name'            => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название'",
            'year'            => "YEAR NOT NULL COMMENT 'Год выпуска'",
            'template'        => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Шаблон для артистов'",
            'sound'           => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Звук'",
            'count_artists'   => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Число исполнителей в названии'",
            'original'        => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Оригинал'",
            'version'         => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Версии'",
            'created'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Создано'",
            'id_created_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем создано'",
            'updated'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Обновлено'",
            'id_updated_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем обновлено'",
        ], $tableOptions);

        $this->addForeignKey('fk_created_song', '{{%songs}}', 'id_created_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_updated_song', '{{%songs}}', 'id_updated_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');

        $this->createIndex('idx_song_name', '{{%songs}}', 'name');
        $this->createIndex('idx_song_year', '{{%songs}}', 'year');
        $this->createIndex('idx_song_sound', '{{%songs}}', 'sound');
        $this->createIndex('idx_song_count_artists', '{{%songs}}', 'count_artists');
        $this->createIndex('idx_song_original', '{{%songs}}', 'original');
        $this->createIndex('idx_song_version', '{{%songs}}', 'version');

        // Таблица параметров песен
        $this->createTable('{{%song_params}}', [
            'id_song'  => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_param' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'value'    => Schema::TYPE_STRING . " NOT NULL COMMENT 'Значение параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_params', '{{%song_params}}', ['id_song', 'id_param']);
        $this->addForeignKey('fk_song_params_val', '{{%song_params}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_song_params_rel', '{{%song_params}}', 'id_param', '{{%params_unique}}', 'id_param', 'CASCADE', 'CASCADE');

        // Таблица атрибутов песен
        $this->createTable('{{%song_attr}}', [
            'id_song'      => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_attr_value' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_attr', '{{%song_attr}}', ['id_song', 'id_attr_value']);
        $this->addForeignKey('fk_song_attr_val', '{{%song_attr}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_song_attr_rel', '{{%song_attr}}', 'id_attr_value', '{{%params_attr_value}}', 'id_attr_value', 'CASCADE', 'CASCADE');

        // Таблица жанров песни
        $this->createTable('{{%song_genres}}', [
            'id_song'  => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_genre' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID жанра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_genre', '{{%song_genres}}', ['id_song', 'id_genre']);
        $this->addForeignKey('fk_song_genre', '{{%song_genres}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_genre_song', '{{%song_genres}}', 'id_genre', '{{%param_genres}}', 'id_genre', 'CASCADE', 'CASCADE');

        // Таблица языков песни
        $this->createTable('{{%song_languages}}', [
            'id_song'     => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_language' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID языка'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_language', '{{%song_languages}}', ['id_song', 'id_language']);
        $this->addForeignKey('fk_song_language', '{{%song_languages}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_language_song', '{{%song_languages}}', 'id_language', '{{%param_languages}}', 'id_language', 'CASCADE', 'CASCADE');

        // Таблица текстов песни
        $this->createTable('{{%song_text}}', [
            'id_song' => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'text'    => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_text', '{{%song_text}}', 'id_song');
        $this->addForeignKey('fk_song_text', '{{%song_text}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');

        // Таблица текстов песни
        $this->createTable('{{%song_album}}', [
            'id_song'       => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_album'      => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'number'        => Schema::TYPE_SMALLINT . " UNSIGNED NOT NULL COMMENT 'Номер'",
            'length'        => Schema::TYPE_TIME . " NOT NULL COMMENT 'Длительность'",//возможно вынести в параметры
            'disk'          => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Номер диска'",
            'first_mention' => Schema::TYPE_BOOLEAN . " NOT NULL COMMENT 'Упоминание'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_album', '{{%song_album}}', ['id_song', 'id_album']);
        $this->addForeignKey('fk_song_album', '{{%song_album}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_album_song', '{{%song_album}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');

        // Таблица оригиналов песен
        $this->createTable('{{%song_original}}', [
            'id_song'     => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_original' => Schema::TYPE_BIGINT . " COMMENT 'ID оригинальной песни'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_original', '{{%song_original}}', ['id_song', 'id_original']);
        $this->addForeignKey('fk_song_original', '{{%song_original}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_original', '{{%song_original}}', 'id_original', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');

        // Оценки песен пользователями
        $this->createTable('{{%user_song_vote}}', [
            'id_song' => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'id_user' => Schema::TYPE_INTEGER . " COMMENT 'ID пользователя'",
            'rate'    => Schema::TYPE_DECIMAL . "(4,1) UNSIGNED NOT NULL COMMENT 'Оценка'",
            'date'    => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Дата'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_user_song_vote', '{{%user_song_vote}}', ['id_song', 'id_user']);
        $this->addForeignKey('fk_song_user_vote', '{{%user_song_vote}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_user_song_vote', '{{%user_song_vote}}', 'id_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');



        // Таблица стран
        $this->createTable('{{%territory_country}}', [
            'id_country'   => Schema::TYPE_PK . " COMMENT 'ID страны'",
            'name_country' => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название страны'",
        ], $tableOptions);

        // Таблица штатов, краев, крупных городов
        $this->createTable('{{%territory_area}}', [
            'id_area'    => Schema::TYPE_PK . " COMMENT 'ID области'",
            'name_area'  => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название области'",
            'id_country' => Schema::TYPE_INTEGER . " COMMENT 'ID страны'",
        ], $tableOptions);

        $this->addForeignKey('fk_area_country', '{{%territory_area}}', 'id_country', '{{%territory_country}}', 'id_country', 'CASCADE', 'CASCADE');

        // Таблица городов
        $this->createTable('{{%territory_city}}', [
            'id_city'   => Schema::TYPE_PK . " COMMENT 'ID города'",
            'name_city' => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название города'",
            'id_area'   => Schema::TYPE_INTEGER . " COMMENT 'ID области'",
        ], $tableOptions);

        $this->addForeignKey('fk_city_area', '{{%territory_city}}', 'id_area', '{{%territory_area}}', 'id_area', 'CASCADE', 'CASCADE');

        //Таблица артистов
        $this->createTable('{{%artists}}', [
            'id_artist'    => Schema::TYPE_PK . " COMMENT 'ID артиста/группы'",
            'name_artist'  => Schema::TYPE_STRING . " NOT NULL COMMENT 'Имя'",
            'type'         => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Человек или группа'",
            'birthday'     => Schema::TYPE_DATE . " COMMENT 'Дата создания'",
            'death_day'    => Schema::TYPE_DATE . " COMMENT 'Дата распада'",
            'birthplace'   => Schema::TYPE_INTEGER . " COMMENT 'Место создания'",
            'death_place'  => Schema::TYPE_INTEGER . " COMMENT 'Место распада'",
            'resident'     => Schema::TYPE_INTEGER . " COMMENT 'Резиденция'",
            'years_active' => Schema::TYPE_STRING . " COMMENT 'Годы активности'",
        ], $tableOptions);

        $this->addForeignKey('fk_birthplace', '{{%artists}}', 'birthplace', '{{%territory_city}}', 'id_city', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_resident', '{{%artists}}', 'resident', '{{%territory_city}}', 'id_city', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_death_place', '{{%artists}}', 'death_place', '{{%territory_city}}', 'id_city', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_artist_name', '{{%artists}}', 'name_artist');

        //Таблица альтернативных имен артистов
        $this->createTable('{{%artist_add_names}}', [
            'id_add_artist' => Schema::TYPE_PK . " COMMENT 'ID дополнительного имени'",
            'id_artist'     => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID артиста/группы'",
            'name'          => Schema::TYPE_STRING . " NOT NULL COMMENT 'Дополнительное имя'",
            'main'          => Schema::TYPE_BOOLEAN . " NOT NULL COMMENT 'Самостоятельная единица'",
        ], $tableOptions);

        $this->addForeignKey('fk_add_names', '{{%artist_add_names}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');

        // Таблица параметров артиста
        $this->createTable('{{%artist_params}}', [
            'id_artist' => Schema::TYPE_INTEGER . " COMMENT 'ID артиста'",
            'id_param'  => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID параметра'",
            'value'     => Schema::TYPE_STRING . " NOT NULL COMMENT 'Значение параметра'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_artist_params', '{{%artist_params}}', ['id_artist', 'id_param']);
        $this->addForeignKey('fk_artist_params_val', '{{%artist_params}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_artist_params_rel', '{{%artist_params}}', 'id_param', '{{%params_unique}}', 'id_param', 'CASCADE', 'CASCADE');

        //Таблица артисты альбома
        $this->createTable('{{%artist_album}}', [
            'id_artist'     => Schema::TYPE_INTEGER . " COMMENT 'ID артиста/группы'",
            'id_album'      => Schema::TYPE_INTEGER . " COMMENT 'ID альбома'",
            'number'        => "TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Очерёдность'",
            'role'          => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Роль'",
            'id_add_artist' => Schema::TYPE_INTEGER . " COMMENT 'Имя артиста'",
            'description'   => Schema::TYPE_STRING . " COMMENT 'Описание'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_artist_album', '{{%artist_album}}', ['id_artist', 'id_album']);
        $this->addForeignKey('fk_artist_album', '{{%artist_album}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_album_artist', '{{%artist_album}}', 'id_album', '{{%albums}}', 'id_album', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_album_add', '{{%artist_album}}', 'id_add_artist', '{{%artist_add_names}}', 'id_add_artist', 'CASCADE', 'CASCADE');

        //Таблица артисты песен
        $this->createTable('{{%artist_song}}', [
            'id_artist'     => Schema::TYPE_INTEGER . " COMMENT 'ID артиста/группы'",
            'id_song'       => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
            'number'        => "TINYINT(2) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Очерёдность'",
            'role'          => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Роль'",
            'id_add_artist' => Schema::TYPE_INTEGER . " COMMENT 'Имя артиста'",
            'description'   => Schema::TYPE_STRING . " COMMENT 'Описание'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_artist_song', '{{%artist_song}}', ['id_artist', 'id_song']);
        $this->addForeignKey('fk_artist_song', '{{%artist_song}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_song_artist', '{{%artist_song}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_song_add', '{{%artist_song}}', 'id_add_artist', '{{%artist_add_names}}', 'id_add_artist', 'CASCADE', 'CASCADE');

        //Таблица артисты песен
        $this->createTable('{{%song_writers}}', [
            'id_artist' => Schema::TYPE_INTEGER . " COMMENT 'ID артиста/группы'",
            'id_song'   => Schema::TYPE_BIGINT . " COMMENT 'ID песни'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_song_writers', '{{%song_writers}}', ['id_artist', 'id_song']);
        $this->addForeignKey('fk_song_writers', '{{%song_writers}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_writers_song', '{{%song_writers}}', 'id_song', '{{%songs}}', 'id_song', 'CASCADE', 'CASCADE');

        //Таблица сайтов артистов
        $this->createTable('{{%artist_sites}}', [
            'id_artist' => Schema::TYPE_INTEGER . " COMMENT 'ID артиста/группы'",
            'site'      => Schema::TYPE_STRING . " NOT NULL COMMENT 'Url'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_artist_sites', '{{%artist_sites}}', ['id_artist', 'site']);
        $this->addForeignKey('fk_artist_sites', '{{%artist_sites}}', 'id_artist', '{{%artists}}', 'id_artist', 'CASCADE', 'CASCADE');


        $this->createTable('{{%list_resource}}', [
            'id_resource' => Schema::TYPE_SMALLINT . " COMMENT 'ID ресурса'",
            'name'        => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название ресурса'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_list_resource', '{{%list_resource}}', 'id_resource');

        //Списки критиков
        $this->createTable('{{%lists}}', [
            'id_list'     => Schema::TYPE_PK . " COMMENT 'ID списка'",
            'name'        => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название списка'",
            'year'        => "YEAR COMMENT 'Год'",
            'type'        => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Тип'",
            'id_resource' => Schema::TYPE_SMALLINT . " NOT NULL COMMENT 'ID ресурса'",
        ], $tableOptions);

        $this->addForeignKey('fk_list_resource', '{{%lists}}', 'id_resource', '{{%list_resource}}', 'id_resource', 'CASCADE', 'CASCADE');

        //Списки критиков
        $this->createTable('{{%list_position}}', [
            'id_list'  => Schema::TYPE_INTEGER . " COMMENT 'ID списка'",
            'id'       => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID элемента'",
            'position' => "SMALLINT(4) UNSIGNED NOT NULL COMMENT 'Позиция'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_list_position', '{{%list_position}}', ['id_list', 'id']);

        //series
        $this->createTable('{{%series}}', [
            'id_series' => "MEDIUMINT UNSIGNED NOT NULL COMMENT 'ID серии'",
            'name'      => Schema::TYPE_STRING . " NULL COMMENT 'Название серии'",
            'type'      => "TINYINT(1) UNSIGNED NOT NULL COMMENT 'Тип'",
        ], $tableOptions);

        $this->addPrimaryKey('pk_series', '{{%series}}', 'id_series');

        $this->createTable('{{%series_number}}', [
            'id_series' => "MEDIUMINT UNSIGNED NOT NULL COMMENT 'ID серии'",
            'id'        => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID элемента'",
            'number'    => "TINYINT(2) UNSIGNED NOT NULL COMMENT 'Позиция'",
        ], $tableOptions);

        $this->addForeignKey('fk_series_number', '{{%series_number}}', 'id_series', '{{%series}}', 'id_series', 'CASCADE', 'CASCADE');

        $this->createTable('{{%article_category}}', [
            'id_category' => "TINYINT(3) PRIMARY KEY AUTO_INCREMENT NOT NULL COMMENT 'ID категории'",
            'name'        => Schema::TYPE_STRING . " NOT NULL COMMENT 'Название'",
            'id_parent'   => "TINYINT(3) COMMENT 'ID родительской категории'",
        ], $tableOptions);

        $this->addForeignKey('fk_category_parent', '{{%article_category}}', 'id_parent', '{{%article_category}}', 'id_category', 'CASCADE', 'CASCADE');

        $this->createTable('{{%articles}}', [
            'id_article'      => Schema::TYPE_PK . " COMMENT 'ID статьи'",
            'id_category'     => "TINYINT(3) NOT NULL COMMENT 'ID категории'",
            'title'           => Schema::TYPE_STRING . " NOT NULL COMMENT 'Заголовок'",
            'alias'           => Schema::TYPE_STRING . " NOT NULL COMMENT 'Алиас'",
            'preview'         => Schema::TYPE_TEXT . " COMMENT 'Превью'",
            'text'            => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
            'status'          => "TINYINT(1) UNSIGNED NOT NULL DEFAULT 0 COMMENT 'Статус'",
            'active'          => Schema::TYPE_BOOLEAN . " NOT NULL DEFAULT TRUE COMMENT 'Активно'",
            'publication'     => Schema::TYPE_INTEGER . " NULL COMMENT 'Дата публикации'",
            'end'             => Schema::TYPE_INTEGER . " NULL COMMENT 'Дата завершения'",
            'views'           => Schema::TYPE_INTEGER . " NOT NULL DEFAULT 0 COMMENT 'Просмотры'",
            'created'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Создано'",
            'id_created_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем создано'",
            'updated'         => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Обновлено'",
            'id_updated_user' => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Кем обновлено'",
        ], $tableOptions);

        $this->addForeignKey('fk_articles_categories', '{{%articles}}', 'id_category', '{{%article_category}}', 'id_category', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_articles_created', '{{%articles}}', 'id_created_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_articles_updated', '{{%articles}}', 'id_updated_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');
        $this->createIndex('idx_article_title', '{{%articles}}', 'title');

        $this->createTable('{{%article_comments}}', [
            'id_comment' => Schema::TYPE_BIGPK . " COMMENT 'ID комментария'",
            'id_parent'  => Schema::TYPE_BIGINT . " COMMENT 'ID родительского комментария'",
            'id_article' => Schema::TYPE_INTEGER . " COMMENT 'ID статьи'",
            'id_user'    => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'ID пользователя'",
            'title'      => Schema::TYPE_STRING . " COMMENT 'Заголовок'",
            'text'       => Schema::TYPE_TEXT . " NOT NULL COMMENT 'Текст'",
            'status'     => "TINYINT(1) UNSIGNED NOT NULL DEFAULT 1 COMMENT 'Статус'",
            'created'    => Schema::TYPE_INTEGER . " NOT NULL COMMENT 'Создано'",
        ], $tableOptions);

        $this->addForeignKey('fk_article_comments', '{{%article_comments}}', 'id_article', '{{%articles}}', 'id_article', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_user', '{{%article_comments}}', 'id_user', '{{%users}}', 'id_user', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk_comment_parent', '{{%article_comments}}', 'id_parent', '{{%article_comments}}', 'id_comment', 'CASCADE', 'CASCADE');

    }


    /*
        DROP VIEW IF EXISTS `jhh_song_rating`;
        CREATE VIEW `jhh_song_rating` AS
        SELECT id_song, COUNT(rate) AS votes, ROUND(SUM(rate) / COUNT(rate), 3) AS rating
        FROM jhh_user_song_vote
        GROUP BY id_song;

        DROP TABLE IF EXISTS `jhh_song_archive_rating`;
        CREATE TABLE `jhh_song_archive_rating` AS
        SELECT * FROM `jhh_song_rating`;

        DROP VIEW IF EXISTS `jhh_album_rating`;
        CREATE VIEW `jhh_album_rating` AS
        SELECT id_album, COUNT(rate) AS votes, ROUND(SUM(rate) / COUNT(rate), 3) AS rating
        FROM jhh_user_album_vote
        GROUP BY id_album;

        DROP TABLE IF EXISTS `jhh_album_archive_rating`;
        CREATE TABLE `jhh_album_archive_rating` AS
        SELECT * FROM `jhh_album_rating`;
    */


    public function safeDown()
    {
        $this->dropTable('{{%album_params}}');
        $this->dropTable('{{%albums}}');
        $this->dropTable('{{%params}}');
    }
}