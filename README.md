# symfony5-rest-service
Тестовый проект на symfony5 (автосалон)

######
Корневые папки
######
Авторизация сделана по Jwt токену
######
api    / backend
front  / frontend
######


REST API Doc
######

/public  корневая папка

### 

пример запроса 
/public/car/list/all

### Car  
GET /car/list/all   получить все автомобили
######
GET /car/list/showroom/{roomId} получить все авто из конкретного салона
######
POST /car/create добавить новое авто
######
GET /car/one/{id}  получить 1 авто по id
######

### Order
GET /order/list/all получить все покупки(заказы)
######
POST /order/create создать новую покупку
######
GET /order/list/by_client/{user_id} получить все покупки клиента
######
GET /order/one/{id}  получить 1 покупку по id
######

### User
GET /user/list/all получить всех пользователей
######
GET /user/list/clients  получить всех клиентов
######
GET /user/list/managers получить всех менеджеров
######
POST /user/create  создать нового пользователя
######
GET /user/one/{id}  получить пользователя по id
######
POST /user/jwt/auth   JWT авторизация пользователя
######
  email, password
######


###  Автосалоны
GET /showroom/list/all  получить все автосалоны
######
GET /showroom/one/{room_id}  получить 1 автосалон
######



