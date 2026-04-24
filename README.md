<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# API de Productos 2026 - Programación III

Este repositorio está dedicado a la enseñanza de **Laravel** dentro de la cátedra de **Programación III** de la *Tecnicatura en Análisis y Desarrollo de Software*.

El objetivo del proyecto es desarrollar una API para una Tienda Online, comenzando por los dos modelos fundamentales: **Productos** y **Categorías**. A través de este proyecto, aprenderán los conceptos básicos y avanzados del framework, incluyendo migraciones, modelos Eloquent, controladores, rutas y autenticación.

## 📚 Dinámica de trabajo

El código de este repositorio evolucionará semana a semana. Cada **commit** corresponde al contenido desarrollado en una clase específica.

---

## 🚀 Configuración del Proyecto

Para poner en funcionamiento este repositorio de forma local, sigue estos pasos:

### 1. Clonar el repositorio
```bash
git clone https://github.com/profebrianvanegas/api_productos_2026.git
cd api_productos_2026
```

### 2. Instalar dependencias de PHP
```bash
composer install
```

### 3. Configurar el archivo de entorno
Copia el archivo `.env.example` para crear tu `.env`:
```bash
cp .env.example .env
```

### 4. Generar la clave de la aplicación
```bash
php artisan key:generate
```

### 5. Configurar la Base de Datos
Asegúrate de configurar las credenciales de tu base de datos en el archivo `.env`. Luego, ejecuta las migraciones para crear las tablas necesarias:
```bash
php artisan migrate
```
*(Opcional) Si existen seeders:* `php artisan migrate --seed`

### 6. Iniciar el servidor de desarrollo
```bash
php artisan serve
```

---

## 🛠️ Tecnologías Utilizadas

- **PHP 8.3+**
- **Laravel 13**
- **MySQL/MariaDB**
- **Composer**

## 📄 Licencia

Este proyecto es de código abierto bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
