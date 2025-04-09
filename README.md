# BookingResources API

## Описание
Проект **BookingResources** предоставляет RESTful API для управления ресурсами (например, комнаты, автомобили и т.д.) и их бронирования. API позволяет создавать ресурсы, бронирования, получать их списки и отменять бронирования.

---

## API Эндпоинты

### Ресурсы

#### 1. Создание ресурса
**POST** `/api/resources`

##### Пример запроса:
```json
{
    "name": "Conference Room",
    "type": "room",
    "description": "A large conference room with a projector."
}
```

##### Пример ответа:
```json
{
    "data": {
        "id": 1,
        "name": "Conference Room",
        "type": "room",
        "description": "A large conference room with a projector."
    }
}
```

#### 2. Получение списка ресурсов
**GET** `/api/resources`

##### Пример ответа:
```json
{
    "data": [
        {
            "id": 1,
            "name": "Conference Room",
            "type": "room",
            "description": "A large conference room with a projector."
        }
    ]
}
```

---

### Бронирования

#### 1. Создание бронирования
**POST** `/api/bookings`

##### Пример запроса:
```json
{
    "resource_id": 1,
    "user_id": 1,
    "start_time": "2025-04-10T10:00:00Z",
    "end_time": "2025-04-10T12:00:00Z"
}
```

##### Пример ответа:
```json
{
    "data": {
        "id": 1,
        "resource_id": 1,
        "user_id": 1,
        "start_time": "2025-04-10T10:00:00Z",
        "end_time": "2025-04-10T12:00:00Z"
    }
}
```

#### 2. Получение всех бронирований для ресурса
**GET** `/api/resources/{id}/bookings`

##### Пример ответа:
```json
{
    "data": [
        {
            "id": 1,
            "resource_id": 1,
            "user_id": 1,
            "start_time": "2025-04-10T10:00:00Z",
            "end_time": "2025-04-10T12:00:00Z"
        }
    ]
}
```

#### 3. Отмена бронирования
**DELETE** `/api/bookings/{id}`

##### Пример ответа:
HTTP статус: `204 No Content`

---
