# WebCrime

### Данный репозиторий является бекапом моего курсового проекта на 3 курсе по базам данных.

Все сущности (кроме сущности "Статьи") базы данных были полностью очищены во избежание проблем, которые может создать мне 
Федеральный закон "О персональных данных" от 27.07.2006 N 152-ФЗ
Так же была оставлена ровно одна строка в таблице Администрация.Пользователи с логином s1l2p4 (Администратор данной базы).
Для успешного первого логирования в GUI следует восстановить базу из бекапа на своем postgresql сервере и ввести следующую команду

```
create user s1l2p4 with password '12345' SUPERUSER
```

При изменени пароля следует так же изменить его в таблице Администрация.Пользователи

```
update Администрация.Пользователи set Пароль = ('Ваш пароль', gen_salt('md5'));
```

С техническим заданием и примерами работы вы можете ознакомиться в приложенном файле с оформленной курсовой.
