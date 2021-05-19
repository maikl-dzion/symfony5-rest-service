# symfony5-rest-service
Тестовый проект на symfony5 (автосалон)


REST API Doc
######

/home

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
GET /order/list/all получить все продажи(заказы)
######
POST /order/create создать новую покупку
######
GET /order/list/by_user получить все покупки клиента
######
GET /order/one/{id}  получить 1 покупку по id
######

### User
/user/list/all получить всех пользователей
######
/user/list/clients  получить всех клиентов
######
/user/list/managers получить всех менеджеров
######
/user/create  создать нового пользователя
######
/user/one/{id}  получить пользователя по id
######

