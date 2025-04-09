# PokeApi 

API REST desarrollada como prueba técnica para la Universidad CUN. Permite obtener información de Pokémon a través de su ID o nombre, utilizando datos en tiempo real desde la [PokeAPI](https://pokeapi.co/).

---

## 🚀 Endpoint disponible

### `GET /pokemon/{id}`

Consulta los datos de un Pokémon específico.

#### Ejemplo:
```
GET http://localhost:8000/pokemon/1
```

#### 🧾 Respuesta:
```json
{
  "id": 1,
  "name": "bulbasaur",
  "types": ["grass", "poison"],
  "abilities": ["overgrow", "chlorophyll"],
  "sprite_url": "https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png"
}
```

## 🧠 Arquitectura del proyecto

El proyecto sigue una estructura modular inspirada en los principios de Clean Architecture, separando claramente las responsabilidades.

```
app/
├── Controllers/         # Reciben y procesan peticiones HTTP
├── Core/                # Router propio que gestiona rutas y métodos HTTP
├── Models/              # Clases que representan la estructura de datos
├── Services/            # Lógica de negocio e integración con PokeAPI
public/
├── index.php            # Punto de entrada de la app
├── .htaccess            # Redirección de rutas amigables a index.php
tests/
├── PokemonServiceTest.php # Pruebas unitarias para el servicio principal
vendor/                  # Dependencias instaladas con Composer
Dockerfile               # Entorno PHP + Apache listo para producción
composer.json            # Configuración de namespaces y dependencias
README.md                # Documentación del proyecto
```

## 📁 ¿Para qué sirve cada parte?

### Controllers/
Encapsula los controladores que responden a las rutas. Ej: PokemonController se encarga de procesar la petición al endpoint /pokemon/{id}.

### Services/
Contiene la lógica de negocio. PokemonService se comunica con la API externa (PokeAPI), transforma los datos y los devuelve al controlador.

### Models/
Define las entidades del sistema. Pokemon.php representa un Pokémon como objeto con atributos como id, name, types, etc.

### Core/
Contiene herramientas centrales. Router.php es un router HTTP personalizado para mapear rutas a funciones (similar a microframeworks como Slim o Lumen).

### public/index.php
El punto de entrada de la aplicación. Configura cabeceras, rutas, y lanza el router.

### .htaccess
Habilita la reescritura de URLs para soportar rutas limpias sin index.php en la URL.

### tests/
Incluye pruebas unitarias usando PHPUnit. Asegura que la lógica del PokemonService funcione correctamente.

## 🐳 Docker

El Dockerfile permite levantar el proyecto en cualquier entorno de forma consistente.

### 🔧 Construcción de imagen
```bash
docker build -t pokeapi-backend .
```

### ▶️ Ejecución del contenedor
```bash
docker run -p 8000:80 pokeapi-backend
```

Accede luego a: http://localhost:8000/pokemon/25

## 🧪 Testing

Este proyecto incluye pruebas unitarias con PHPUnit. Para ejecutarlas:

```bash
vendor/bin/phpunit tests
```

## 📦 Dependencias

- PHP 8.2
- Apache
- Composer
- PHPUnit ^10
- PokeAPI (consumo externo)

## 👨‍💻 Autor

Desarrollado por Alejandro Sanmiguel  
📧 alejandrosanmiguel0222@gmail.com