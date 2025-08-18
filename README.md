# Laravel e-commerce


## Описание
Pet-проект интернет-магазина.  
Состоит из двух частей: **Laravel backend** (с админкой на Blade) и **Vue.js frontend** (SPA для покупателей).  
Цель проекта — отработать полный цикл: аутентификация, работа с API, роли пользователей и корзина покупателя.

---


### Backend (Laravel + Blade)
- Панель администратора:
    - Управление товарами, категориями, заказами и пользователями
- Многоуровневые роли пользователей (админ, редактор, покупатель)
- Аутентификация
- API для фронтенда (REST)

### Frontend (Vue 3 + Vite + TailwindCSS)
- Каталог товаров с фильтрацией по категориям и цене
- Добавление/удаление товаров в корзину
- Взаимодействие с API (Axios)
- Корзина и оформление заказа

---

## Технологии
- **Backend**: PHP, Laravel, Blade, MySQL
- **Frontend**: Vue 3, Vite, TailwindCSS, Axios, PrimeVue
- **Другое**: Docker, Nginx

---

## Установка

```bash
git clone git@github.com:g-gol/laravel-ecommerce.git
cd backend
cp .env.example .env
cd ..
```

```bash
cd docker
docker compose up -d
docker exec -it ecommerce-app bash
composer install
php artisan key:generate
php artisan migrate --seed
php artisan vendor:publish --tag=laravel-pagination
npm install && npm run build
exit
cd ..
```

Админ панель будет доступна на http://localhost:8005/admin/
#### админ-пользователь
```
email: qwe@qwe.com
password: qwerty123
```
### Frontend
```bash
cd frontend
cp .env.example .env
npm install
npm run dev
```
Frontend будет доступен на http://localhost:5173
